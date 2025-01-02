<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use App\Lib\FormProcessor;
use App\Lib\TemplatePrompt;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\GeneralSetting;
use App\Models\History;
use App\Models\Template;
use App\Models\TemplateContent;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;

class TemplateController extends Controller
{

    public function index()
    {
        $pageTitle = 'All Content';
        $contents  = TemplateContent::where('user_id', auth()->id())->orderBy('id', 'desc')->with(['template.category'])->paginate(getPaginate());
        return view('Template::user.templates.index', compact('contents', 'pageTitle'));
    }

    public function list()
    {
        $pageTitle  = 'Templates';
        $categories = Category::active()->with(['templates' => function ($query) {
            $query->active();
        }])->get();
        $user = auth()->user();
        return view('Template::user.templates.list', compact('pageTitle', 'categories', 'user'));
    }

    public function form($code)
    {
        $template     = Template::active()->where('code', $code)->firstOrFail();
        $pageTitle    = 'Template - ' . $template->name;
        $languageList = json_decode(file_get_contents(resource_path('views/partials/language.json')));
        $formData     = $template->form_data;
        return view('Template::user.templates.form', compact('pageTitle', 'template', 'languageList', 'formData'));
    }

    public function generate(Request $request, $code)
    {
        // $setting = GeneralSetting::with('templateModel')->first();
        // dd($setting->templateModel);
        $template = Template::active()->where('code', $code)->first();
        if (!$template) {
            return response()->json(['error' => 'Invalid request for generating template']);
        }

        $formProcessor  = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($template->form_data);
        $data           = [
            'language'        => 'required',
            'words'           => 'required',
            'result_quantity' => 'required|min:1|max:4',
        ];

        $allRequestData = array_merge($validationRule, $data);
        $validator      = Validator::make($request->all(), $allRequestData);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $response = $this->checkLimitValidation($template);

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']]);
        }

        $maxToken = $response;
        $prompt   = TemplatePrompt::templateCode($template->code, $request, $maxToken);

        $content                  = new TemplateContent();
        $content->user_id         = auth()->id();
        $content->template_id     = $template->id;
        $content->language        = $request->language;
        $content->result_quantity = $request->result_quantity;
        $content->content_request = $prompt;
        $content->save();

        return response()->json([
            'template_content_id' => $content->id,
            'maxtoken'            => $maxToken,
        ]);
    }

    private function checkLimitValidation($template)
    {
        $user    = auth()->user();
        $request = request();
        if (!$user->plan_id || $user->expired_date < now()) {
            $error = ['error' => 'You have no such plan, subscribe to get access'];
            return $error;
        }
        if (!@$user->access->ai_template) {
            $error = ['error' => 'Your template feature is not available for your subscription plan'];
            return $error;
        }
        if (!$template->is_free && !@$user->access->premium_template) {
            $error = ['error' => 'You have no access to the premium template'];
            return $error;
        }
        $plan     = $user->plan;
        $maxToken = ($plan->word_limit < $request->words) ? $plan->word_limit : $request->words;
        if ($maxToken > @$user->access->word_limit) {
            $error = ['error' => 'You have no word balance'];
            return $error;
        }
        return $maxToken;
    }

    public function process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'template_content_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $templateContent = TemplateContent::where('id', $request->template_content_id)->where('user_id', auth()->id())->with('template')->first();
        if (!$templateContent) {
            return response()->json(['error' => 'Invalid request for generate content']);
        }

        $setting = GeneralSetting::with('templateModel')->first();

        $url       = 'https://api.openai.com/v1/completions';
        $arrayData = json_encode([
            "model"      => $setting->templateModel->name,
            "prompt"     => $templateContent->content_request,
            "max_tokens" => (int) $request->max_token,
        ]);
        $header = [
            'Content-Type: application/json',
            "Authorization: Bearer $setting->api_key",
        ];
        $response = CurlRequest::curlPostContent($url, $arrayData, $header);
        $data     = json_decode($response);

        if (@$data->error) {
            return response()->json(['error' => @$data->error->message]);
        }

        $words                   = $data->usage->completion_tokens;
        $templateContent->words  = $words;
        $templateContent->tokens = $words;
        $templateContent->result = $data->choices[0]->text;
        $templateContent->save();

        $user         = auth()->user();
        $newWordLimit = $user->access->word_limit - $words;
        $userAccess   = json_decode(json_encode($user->access), true);

        $updateAccessLimit               = collect($userAccess);
        $updateAccessLimit['word_limit'] = $newWordLimit < 0 ? 0 : $newWordLimit;
        $user->access                    = $updateAccessLimit;
        $user->save();

        $history              = new History();
        $history->user_id     = auth()->id();
        $history->title       = @$templateContent->template->name;
        $history->description = @$templateContent->template->description;
        $history->token       = $words;
        $history->save();

        return response()->json(['content' => $data->choices[0]->text]);
    }

    public function download($id)
    {
        $item    = TemplateContent::where('user_id', auth()->id())->findOrFail($id);
        $content = $item->result;
        $pdf     = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Kalpurush']);
        $pdf     = $pdf->loadView('Template::user.download.pdf_content', compact('content'));
        return $pdf->download('document.pdf');
    }

    public function addFavorite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'template_id' => 'required|integer|gt:0',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $template = Template::where('id', $request->template_id)->first();
        if (!$template) {
            return response()->json(['error' => 'Template not found']);
        }

        $exist = Favorite::where('user_id', auth()->id())->where('template_id', $template->template_id)->first();
        if ($exist) {
            return response()->json(['error' => 'Already added favorite list']);
        }

        $favorite              = new Favorite();
        $favorite->user_id     = auth()->id();
        $favorite->template_id = $template->id;
        $favorite->save();
        return response()->json(['success' => 'Template added to favorite list', 'templateId' => $template->id]);
    }

    public function removeFavorite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'template_id' => 'required|integer|gt:0',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        Favorite::where('user_id', auth()->id())->where('template_id', $request->template_id)->delete();
        return response()->json([
            'success'    => ' Removed from favorite list',
            'remark'     => 'remove',
            'templateId' => $request->template_id,
        ]);
    }

    public function favoriteList()
    {
        $pageTitle = 'My Favorite Templates';
        $favorites = Favorite::where('user_id', auth()->id())->orderBy('id', 'desc')->with('template')->paginate(getPaginate());
        $user      = auth()->user();
        return view('Template::user.templates.favorite', compact('pageTitle', 'favorites', 'user'));
    }
}

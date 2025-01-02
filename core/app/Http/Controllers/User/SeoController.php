<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use App\Models\GeneralSetting;
use App\Models\History;
use App\Models\SeoContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;

class SeoController extends Controller {
    public function form() {
        $pageTitle    = 'Generate - SEO';
        return view('Template::user.seo.form', compact('pageTitle'));
    }

    public function generate(Request $request) {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'meta_title_length'       => 'required|integer',
            'meta_description_length'       => 'required|integer',
            'meta_keyword_length'       => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $response = $this->checkLimitValidation();

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']]);
        }

        $maxToken = $response;
        // title
        $prompt   = "\n\n Create SEO meta title for this product with my given information" . "\n\n This is product description : " . $request->description . ". The maximum length of the SEO title must be " . $request->meta_title_length . " words.\n\n";

        $setting = GeneralSetting::with('templateModel')->first();

        $url       = 'https://api.openai.com/v1/completions';
        $arrayData = json_encode([
            "model"      => $setting->templateModel->name,
            "prompt"     => $prompt,
            "max_tokens" => (int) $request->meta_title_length,
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
        
        $title = @$data->choices[0]->text;

        $titleToken        = $data->usage->completion_tokens;
        $user         = auth()->user();
        $newWordLimit = $user->access->word_limit - $titleToken;
        $userAccess   = json_decode(json_encode($user->access), true);

        $updateAccessLimit               = collect($userAccess);
        $updateAccessLimit['word_limit'] = $newWordLimit < 0 ? 0 : $newWordLimit;
        $user->access                    = $updateAccessLimit;
        $user->save();
        
        // description
        $prompt   = "\n\n Create SEO meta description for this product with my give information" . "\n\n This is product description : " . $request->description . ". The maximum length of the SEO description must be " . $request->meta_description_length . " words.\n\n";

        $url       = 'https://api.openai.com/v1/completions';
        $arrayData = json_encode([
            "model"      => $setting->templateModel->name,
            "prompt"     => $prompt,
            "max_tokens" => (int) $request->meta_description_length,
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
        
        $description = @$data->choices[0]->text;

        $descriptionToken        = $data->usage->completion_tokens;
        $user         = auth()->user();
        $newWordLimit = $user->access->word_limit - $descriptionToken;
        $userAccess   = json_decode(json_encode($user->access), true);

        $updateAccessLimit               = collect($userAccess);
        $updateAccessLimit['word_limit'] = $newWordLimit < 0 ? 0 : $newWordLimit;
        $user->access                    = $updateAccessLimit;
        $user->save();
        
         // description
        $prompt   = "\n\n Create SEO meta keywords for this product with my give information" . "\n\n This is product description : " . $request->description . ". The maximum length of the SEO meta keywords must be " . $request->meta_keyword_length . " words.\n\n";

        $url       = 'https://api.openai.com/v1/completions';
        $arrayData = json_encode([
            "model"      => $setting->templateModel->name,
            "prompt"     => $prompt,
            "max_tokens" => (int) $request->meta_keyword_length,
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
        
        $keywords = @$data->choices[0]->text;

        $keywordToken        = $data->usage->completion_tokens;
        
        
        
        
        $user         = auth()->user();
        $newWordLimit = $user->access->word_limit - $keywordToken;
        $userAccess   = json_decode(json_encode($user->access), true);

        $updateAccessLimit               = collect($userAccess);
        $updateAccessLimit['word_limit'] = $newWordLimit < 0 ? 0 : $newWordLimit;
        $user->access                    = $updateAccessLimit;
        $user->save();
        
        $result = '<b>Meta Title</b> : '. $title.'<br><br> <b>Meta Description</b> : '.$description.'<br><br> <b>Meta Keywords </b> : '.$keywords;
        
        $totalToken = $titleToken + $descriptionToken + $keywordToken;

        $seoContent              = new SeoContent();
        $seoContent->user_id     = $user->id;
        $seoContent->description = $request->description;
        $seoContent->result      = $result;
        $seoContent->token       = $totalToken;
        $seoContent->save();

        $history              = new History();
        $history->user_id     = $user->id;
        $history->title       = 'Generated SEO';
        $history->description = $result;
        $history->token       = $totalToken;
        $history->save();

        return response()->json([
            'content' => $result,
        ]);

    }

    private function checkLimitValidation() {
        $user    = auth()->user();
        $request = request();
        if (!$user->plan_id || $user->expired_date < now()) {
            $error = ['error' => 'You have no such plan, subscribe to get access'];
            return $error;
        }

        $plan     = $user->plan;
        
        $totalToken = $request->meta_title_length +  $request->meta_description_length + $request->meta_keyword_length; 
        
        $maxToken = ($plan->word_limit < $totalToken) ? $plan->word_limit : $totalToken;
        if ($maxToken > $user->access->word_limit) {
            $error = ['error' => 'You have no word balance'];
            return $error;
        }
        return $maxToken;
    }

    public function index() {
        $pageTitle = 'All SEO Content';
        $contents  = SeoContent::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(getPaginate());
        return view('Template::user.seo.index', compact('contents', 'pageTitle'));
    }

    public function download($id) {
        $item    = SeoContent::where('user_id', auth()->id())->findOrFail($id);
        $content = $item->result;
        $pdf     = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Kalpurush'])->loadView('Template::user.download.pdf_content', compact('content'));
        return $pdf->download('document.pdf');
    }
}

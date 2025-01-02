<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use App\Models\AiTranslate;
use App\Models\GeneralSetting;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TranslateController extends Controller {
    public function index() {
        $pageTitle    = 'Translate';
        $languageList = json_decode(file_get_contents(resource_path('views/partials/language.json')));
        return view('Template::user.translate.index', compact('pageTitle', 'languageList'));
    }

    public function generate(Request $request) {
        $validator = Validator::make($request->all(), [
            'language' => 'required|string',
            'content'  => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $response = $this->checkLimitValidation();

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']]);
        }

        $general = GeneralSetting::with('chatModel')->first();

        $content = " \n\n .translate the text into $request->language language. \n\n the text is '$request->content'";

        $url       = 'https://api.openai.com/v1/chat/completions';
        $arrayData = json_encode([
            "model"    => $general->chatModel->name,
            "messages" => [
                [
                    "role"    => "system",
                    "content" => "You are a helpful assistant.",
                ],
                [
                    "role"    => "user",
                    "content" => $content,
                ],
            ],
        ]);
        $header = [
            "Content-Type: application/json",
            "Authorization: Bearer $general->api_key",
        ];

        $response = CurlRequest::curlPostContent($url, $arrayData, $header);
        $data     = json_decode($response);

        if (@$data->error) {
            return response()->json(['error' => @$data->error->message]);
        }

        $words = @$data->usage->total_tokens;

        $user         = auth()->user();
        $newWordLimit = $user->access->word_limit - $words;
        $userAccess   = json_decode(json_encode($user->access), true);

        $updateAccessLimit               = collect($userAccess);
        $updateAccessLimit['word_limit'] = $newWordLimit < 0 ? 0 : $newWordLimit;
        $user->access                    = $updateAccessLimit;
        $user->save();

        $translate          = new AiTranslate();
        $translate->user_id = $user->id;
        $translate->content = $request->content;
        $translate->result  = @$data->choices[0]->message->content;
        $translate->language  = $request->language;
        $translate->token   = $words;
        $translate->save();

        $history              = new History();
        $history->user_id     = auth()->id();
        $history->title       = "Translate";
        $history->description = @$request->text;
        $history->token       = $words;
        $history->save();

        return response()->json(['content' => @$data->choices[0]->message->content]);
    }

    private function checkLimitValidation() {
        $user    = auth()->user();
        $request = request();
        if (!$user->plan_id || $user->expired_date < now()) {
            $error = ['error' => 'You have no such plan, subscribe to get access'];
            return $error;
        }

        $plan     = $user->plan;
        $maxToken = ($plan->word_limit < $request->words) ? $plan->word_limit : $request->words;
        if ($maxToken > $user->access->word_limit) {
            $error = ['error' => 'You have no word balance'];
            return $error;
        }
        return $maxToken;
    }

    public function list() {
        $pageTitle  = 'Previous Translate Data';
        $translates = AiTranslate::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(getPaginate());
        return view('Template::user.translate.list', compact('pageTitle', 'translates'));
    }
}

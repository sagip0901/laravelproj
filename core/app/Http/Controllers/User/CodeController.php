<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use App\Models\Code;
use App\Models\GeneralSetting;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;

class CodeController extends Controller
{
    public function list()
    {
        $pageTitle = 'All Code';
        $codes     = Code::where('user_id', auth()->id())->paginate(getPaginate());
        return view('Template::user.code.list', compact('pageTitle', 'codes'));
    }

    public function form()
    {
        $pageTitle    = 'Generate New Code';
        $languageList = json_decode(file_get_contents(resource_path('views/partials/programming_languages.json')));
        return view('Template::user.code.form', compact('pageTitle', 'languageList'));
    }

    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'language'    => 'required|string',
            'instruction' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $response = $this->checkLimitValidation();
        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']]);
        }

        $general       = GeneralSetting::with('chatModel')->first();
        $systemContent = "As a helpful assistant proficient in writing programming code, you can provide me with an excellent example of the programming language specified by $request->language language";
        $url           = 'https://api.openai.com/v1/chat/completions';
        $arrayData     = json_encode([
            "model"      => $general->chatModel->name,
            "messages"   => [
                [
                    "role"    => "system",
                    "content" => $systemContent,
                ],
                [
                    "role"    => "user",
                    "content" => $request->instruction,
                ],
            ],
            "max_tokens" => 1000,
        ]);
        $header = [
            'Content-Type: application/json',
            "Authorization: Bearer $general->api_key",
        ];
        $response = CurlRequest::curlPostContent($url, $arrayData, $header);
        $data     = json_decode($response);
        
        if (@$data->error) {
            return response()->json(['error' => @$data->error->message]);
        }

        $user         = auth()->user();
        $newWordLimit = $user->access->word_limit - @$data->usage->total_tokens;
        $userAccess   = json_decode(json_encode($user->access), true);

        $updateAccessLimit               = collect($userAccess);
        $updateAccessLimit['word_limit'] = $newWordLimit < 0 ? 0 : $newWordLimit;
        $user->access                    = $updateAccessLimit;
        $user->save();

        $code              = new Code();
        $code->user_id     = auth()->id();
        $code->language    = $request->language;
        $code->instruction = $request->instruction;
        $code->token       = @$data->usage->total_tokens;
        $code->result      = $data->choices[0]->message->content;
        $code->save();

        $history = new History();
        $history->user_id = auth()->id();
        $history->title = $request->language;
        $history->description = @$request->instruction;
        $history->token = $code->token;
        $history->save();

        $result = view('Template::user.code.result', compact('code'))->render();
        return response()->json([
            'result' => $result,
        ]);
    }

    private function checkLimitValidation()
    {
        $user    = auth()->user();
        $request = request();
        if (!$user->plan_id || $user->expired_date < now()) {
            $error = ['error' => 'You have no such plan, subscribe to get access'];
            return $error;
        }
        if (!$user->access->ai_code) {
            $error = ['error' => 'Your code feature is not available for your subscription plan'];
            return $error;
        }

        if ($user->access->word_limit < 50) {
            $error = ['error' => 'You have no word balance to proceed'];
            return $error;
        }
        return $request->amount;
    }

    public function download($id)
    {
        $code    = Code::where('user_id', auth()->id())->findOrFail($id);
        $content = $code->result;
        $pdf     = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Kalpurush'])->loadView('Template::user.code.document', compact('code'));
        return $pdf->download('document.pdf');
    }

    public function remove($id)
    {
        $item = Code::where('user_id', auth()->id())->findOrFail($id);
        $item->delete();
        $notify[] = ['success', 'Code remove successfully'];
        return back()->withNotify($notify);
    }
}

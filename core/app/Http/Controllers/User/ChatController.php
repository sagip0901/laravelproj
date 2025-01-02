<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use App\Models\Chat;
use App\Models\ChatBot;
use App\Models\ChatMessage;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller {
    public function index() {
        $pageTitle = 'All Chat Bot';
        $chatBots  = ChatBot::active()->where('show_status', 1)->orderBy('id', 'desc')->get();
        return view('Template::user.chat.index', compact('pageTitle', 'chatBots'));
    }

    public function list($code) {
        $chatBot   = ChatBot::active()->where('code', $code)->firstOrFail();
        $pageTitle = 'Chat Bot - ' . $chatBot->name;
        $chats     = Chat::where('user_id', auth()->id())->where('chat_bot_id', $chatBot->id)->with('lastMessage')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('Template::user.chat.list', compact('pageTitle', 'chatBot', 'chats'));
    }

    public function form(Request $request, $code, $id = 0) {

        $chatBot       = ChatBot::active()->where('code', $code)->firstOrFail();
        $pageTitle     = $chatBot->name;
        $chat          = null;
        $conversations = null;

        if ($id) {
            $chat          = Chat::where('user_id', auth()->id())->with('conversations')->findOrFail($id);
            $conversations = $chat->conversations()->orderBy('id', 'desc')->limit(20)->get();
        }
        $chatList = Chat::where('user_id', auth()->id())->where('chat_bot_id', $chatBot->id)->with('lastMessage')->orderBy('id', 'desc')->get();
        return view('Template::user.chat.form', compact('pageTitle', 'chat', 'chatBot', 'conversations', 'chatList'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'code'    => 'required|string',
            'message' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $chatBot = ChatBot::active()->where('code', $request->code)->first();
        if (!$chatBot) {
            return response()->json(['error' => 'Chat bot not found']);
        }

        $response = $this->checkLimitValidation($chatBot);
        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']]);
        }

        if ($request->id) {
            $chat = Chat::where('user_id', auth()->id())->where('id', $request->id)->first();
            if (!$chat) {
                return response()->json(['error' => 'Invalid Request']);
            }
        } else {
            $chat              = new Chat();
            $chat->chat_bot_id = $chatBot->id;
            $chat->user_id     = auth()->id();
            $chat->save();
        }

        $chatMessage          = new ChatMessage();
        $chatMessage->chat_id = $chat->id;
        $chatMessage->sender  = 'user';
        $chatMessage->message = $request->message;
        $chatMessage->save();

        $messageHtml = view('Template::user.chat.single_message', compact('chatMessage'))->render();
        return response()->json([
            'message' => $messageHtml,
            'code'    => $chatBot->code,
            'chat_id' => $chat->id,
        ]);
    }

    private function checkLimitValidation($chatBot) {
        $user = auth()->user();
        if (!$user->plan_id || $user->expired_date < now()) {
            $error = ['error' => 'You have no such plan, subscribe to get access'];
            return $error;
        }
        if (!$user->access->ai_chat) {
            $error = ['error' => 'Your chat feature is not available for your subscription plan'];
            return $error;
        }
        if (!$chatBot->is_free && !$user->premium_chat) {
            $error = ['error' => 'You have no access to the premium chat'];
            return $error;
        }
        if ($user->access->word_limit < 20) {
            $error = ['error' => 'You have no word balance to proceed'];
            return $error;
        }
        return null;
    }

    public function generate(Request $request) {
        $validator = Validator::make($request->all(), [
            'chat_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $chat = Chat::where('id', $request->chat_id)->where('user_id', auth()->id())->first();
        if (!$chat) {
            return response()->json(['error' => 'Chat not found']);
        }

        $chatBot  = $chat->chatBot;
        $response = $this->checkLimitValidation($chatBot);

        $userMessage = $chat->lastMessage;

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']]);
        }

        $general   = GeneralSetting::with('chatModel')->first();
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
                    "content" => @$userMessage->message,
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

        $chatMessage          = new ChatMessage();
        $chatMessage->chat_id = $chat->id;
        $chatMessage->sender  = 'system';
        $chatMessage->message = $data->choices[0]->message->content;
        $chatMessage->word    = $words;
        $chatMessage->save();

        $messageHtml = view('Template::user.chat.single_message', compact('chatMessage'))->render();
        return response()->json([
            'message' => $messageHtml,
        ]);
    }

    public function financialAdvisor($id = 0) {
        $chatBot       = ChatBot::active()->where('show_status', 0)->where('code', 'X67Z7C')->firstOrFail();
        $pageTitle     = $chatBot->name;
        $chat          = null;
        $conversations = null;
        if ($id) {
            $chat          = Chat::where('user_id', auth()->id())->with('conversations')->findOrFail($id);
            $conversations = $chat->conversations()->orderBy('id', 'desc')->limit(20)->get();
        }
        $chatList = Chat::where('user_id', auth()->id())->where('chat_bot_id', $chatBot->id)->with('lastMessage')->orderBy('id', 'desc')->get();
        return view('Template::user.chat.form', compact('pageTitle', 'chat', 'chatBot', 'conversations', 'chatList'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatBot;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class ChatBotController extends Controller {
    public function index(Request $request) {
        $pageTitle = 'All Chat Bot';
        $chatBots  = ChatBot::where('show_status', 1)->searchable(['name'])->orderBy('name')->paginate(getPaginate());
        return view('admin.chat_bot.index', compact('pageTitle', 'chatBots'));
    }

    public function store(Request $request, $id = 0) {
        $imageValidate = $id ? 'nullable' : 'required';
        $request->validate([
            'name'        => 'required|string|max: 40|unique:chat_bots,name,' . $id,
            'designation' => 'required|string|max:40',
            'is_free'     => 'required|integer|in:0,1',
            'description' => 'required|string|max:255',
            'image'       => [$imageValidate, new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        if ($id) {
            $chatBot      = ChatBot::where('show_status', 1)->findOrFail($id);
            $notification = 'Chatbot updated successfully';
        } else {
            $chatBot      = new ChatBot();
            $notification = 'Chatbot added successfully.';
        }

        if ($request->hasFile('image')) {
            try {
                $chatBot->image = fileUploader($request->image, getFilePath('chat_bot'), getFileSize('chat_bot'), @$chatBot->image);
            } catch (\Exception $e) {
                $notify[] = ['error', 'Image could not be uploaded'];
                return back()->withNotify($notify);
            }
        }

        $chatBot->code        = getTrx(6);
        $chatBot->name        = $request->name;
        $chatBot->designation = $request->designation;
        $chatBot->is_free     = $request->is_free;
        $chatBot->description = $request->description;
        $chatBot->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function status($id) {
        if (!in_array($id, [22, 23])) {
            return ChatBot::changeStatus($id);
        }
    }
}

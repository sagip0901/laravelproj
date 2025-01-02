<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\OpenAIModel;
use Illuminate\Http\Request;

class OpenAIController extends Controller {

    public function setting() {
        $pageTitle      = 'OpenAI setting';
        $chatModels     = OpenAIModel::active()->chatModel()->orderBy('name')->get(['id', 'name']);
        $templateModels = OpenAIModel::active()->templateModel()->orderBy('name')->get(['id', 'name']);
        return view('admin.open-ai.setting.index', compact('pageTitle', 'chatModels', 'templateModels'));
    }

    public function settingUpdate(Request $request) {
        $request->validate([
            'template_model_id' => 'required|integer|exists:open_a_i_models,id',
            'chat_model_id'     => 'required|integer|exists:open_a_i_models,id',
            'api_key'           => 'required|string',
            'max_result_length' => 'required|integer|gte:0',
        ]);

        $general                    = GeneralSetting::first();
        $general->template_model_id = $request->template_model_id;
        $general->chat_model_id     = $request->chat_model_id;
        $general->api_key           = $request->api_key;
        $general->max_result_length = $request->max_result_length;
        $general->save();

        $notify[] = ['success', 'OpenAI setting updated successfully'];
        return back()->withNotify($notify);
    }
}

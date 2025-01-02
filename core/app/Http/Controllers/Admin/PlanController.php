<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller {
    public function index() {
        $pageTitle = 'All Plan';
        $plans     = Plan::searchable(['name'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.plan.index', compact('plans', 'pageTitle'));
    }

    public function add($id = 0) {
        if ($id) {
            $plan      = Plan::findOrFail($id);
            $pageTitle = 'Update Plan - ' . $plan->name;
        } else {
            $pageTitle = 'Add New Plan';
            $plan      = null;
        }
        return view('admin.plan.add', compact('pageTitle', 'plan'));
    }

    public function store(Request $request, $id = 0) {
        $request->validate([
            'type'             => 'required|integer|in:1,2,3',
            'name'             => 'required|string|max:40',
            'price'            => 'required|numeric|gte:0',
            'is_discount'      => 'required|integer|in:0,1',
            'discount_type'    => 'required_if:is_discount,1|nullable|integer|in:1,2',
            'discount_amount'  => 'required_if:is_discount,1|nullable|numeric|gte:0',
            'word_limit'       => 'required_if:ai_template,1|nullable|integer|gte:0',
            'image_limit'      => 'required_if:ai_image,1|nullable|integer|gte:0',
            'minute_limit'     => 'required_if:ai_transcript,1|nullable|integer|gte:0',
            'ai_code'          => 'required|integer|in:0,1',
            'ai_chat'          => 'required|integer|in:0,1',
            'ai_template'      => 'required|integer|in:0,1',
            'ai_image'         => 'required|integer|in:0,1',
            'ai_transcript'    => 'required|integer|in:0,1',
            'premium_template' => 'required|integer|in:0,1',
            'premium_chat'     => 'required|integer|in:0,1',
        ]);
        if ($id) {
            $plan         = Plan::findOrFail($id);
            $notification = 'Plan updated successfully';
        } else {
            $plan         = new Plan();
            $notification = 'Plan added successfully';
        }
        $plan->type             = $request->type;
        $plan->name             = $request->name;
        $plan->price            = $request->price;
        $plan->is_discount      = $request->is_discount;
        $plan->discount_type    = $request->is_discount ? $request->discount_type : 0;
        $plan->discount_amount  = $request->is_discount ? $request->discount_amount : 0;
        $plan->word_limit       = @$request->word_limit ?? 0;
        $plan->image_limit      = @$request->image_limit ?? 0;
        $plan->minute_limit     = @$request->minute_limit ?? 0;
        $plan->ai_template      = $request->ai_template;
        $plan->ai_image         = $request->ai_image;
        $plan->ai_code          = $request->ai_code;
        $plan->ai_chat          = $request->ai_chat;
        $plan->ai_transcript    = $request->ai_transcript;
        $plan->premium_template = $request->premium_template;
        $plan->premium_chat     = $request->premium_chat;
        $plan->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function status($id) {
        return Plan::changeStatus($id);
    }
}

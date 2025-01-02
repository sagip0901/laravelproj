<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\Category;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller {
    public function index() {
        $pageTitle = 'All Templates';
        $templates = Template::orderBy('id', 'desc')->with('category:id,name')->searchable(['category:name', 'code', 'name', 'description'])->paginate(getPaginate());
        return view('admin.template.index', compact('pageTitle', 'templates'));
    }

    public function add($id = 0) {
        $pageTitle = 'Add New Template';
        $template  = null;
        if ($id) {
            $pageTitle = 'Update Template';
            $template  = Template::findOrFail($id);
        }
        $categories = Category::active()->get(['id', 'name']);
        return view('admin.template.add', compact('pageTitle', 'template', 'categories'));
    }

    public function store(Request $request, $id = 0) {

        $validate = [
            'category_id' => 'required|integer|exists:categories,id',
            'name'        => 'required|string|max:40',
            'description' => 'required|string|max:255',
            'icon'        => 'required',
        ];
        $formProcessor       = new FormProcessor();
        $generatorValidation = $formProcessor->generatorValidation();
        $allFields           = array_merge($validate, $generatorValidation['rules']);
        $request->validate($allFields, $generatorValidation['messages']);

        if ($id) {
            $template     = Template::findOrFail($id);
            $notification = 'Template updated successfully';
        } else {
            $template       = new Template();
            $template->code = getTrx(6);
            $notification   = 'Template added successfully';
        }

        $template->category_id = $request->category_id;
        $template->icon        = $request->icon;
        $template->name        = $request->name;
        $template->description = $request->description;
        $template->is_free     = $request->is_free ? Status::YES : Status::NO;

        $forms    = $request->form_generator;
        $formData = [];
        if ($forms) {
            for ($i = 0; $i < count($forms['form_label']); $i++) {
                $extensions = $forms['extensions'][$i];
                if ($extensions != 'null' && $extensions != null) {
                    $extensionsArr = explode(',', $extensions);
                    $notMatchedExt = count(array_diff($extensionsArr, $this->supportedExt()));
                    if ($notMatchedExt > 0) {
                        throw new \Exception("Your selected extensions are invalid");
                    }
                }
                $label            = titleToKey($forms['form_label'][$i]);
                $formData[$label] = [
                    'name'        => $forms['form_label'][$i],
                    'label'       => $label,
                    'is_required' => $forms['is_required'][$i],
                    'extensions'  => $forms['extensions'][$i] == 'null' ? "" : $forms['extensions'][$i],
                    'options'     => $forms['options'][$i] ? explode(",", $forms['options'][$i]) : [],
                    'type'        => $forms['form_type'][$i],
                ];
            }
        }

        $template->form_data = $formData;
        $template->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function status($id) {
        return Template::changeStatus($id);
    }
}

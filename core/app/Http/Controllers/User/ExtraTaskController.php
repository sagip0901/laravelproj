<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Lib\CurlRequest;
use App\Models\Archiver;
use App\Models\ArchiverCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExtraTaskController extends Controller
{

    public function counter()
    {
        $pageTitle = 'Character Counter';
        return view('Template::user.extra.counter', compact('pageTitle'));
    }

    public function letterTogglize()
    {
        $pageTitle = 'Letter Togglize';
        return view('Template::user.extra.letter_togglize', compact('pageTitle'));
    }

    public function archive()
    {
        $pageTitle  = 'Archiver List';
        $user       = auth()->user();
        $categorise = ArchiverCategory::where('user_id', $user->id)->distinct('name')->orderBy('name')->get();
        $archivers  = Archiver::where('user_id', $user->id)->with('archiverCategory')->filter(['archiver_category_id'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('Template::user.extra.archiver_list', compact('pageTitle', 'categorise', 'archivers'));
    }

    public function archiveStore(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'content'    => 'required',
            'identifier' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all()
            ]);
        }
        $user = auth()->user();
        $archiver = Archiver::where('identifier', $request->identifier)->where('user_id', auth()->id())->first();
        if ($archiver) {
            $notify = 'Archiver content updated successfully';
        } else {
            $archiver =    new Archiver();
            $archiver->user_id    = $user->id;
            $archiver->identifier = $request->identifier;
            $notify = 'Archiver content added successfully';
        }

        $category = ArchiverCategory::where('user_id', $user->id)->where('name',  $request->category)->first();
        if ($category) {
            $archiver->archiver_category_id   = $category->id;
        } else {
            $category          = new ArchiverCategory();
            $category->user_id = $user->id;
            $category->name    = $request->category;
            $category->save();
            $archiver->archiver_category_id   = $category->id;
        }
        $archiver->content    = $request->content;
        $archiver->save();

        return response()->json([
            'success' => true,
            'notify' => $notify,
        ]);
    }

    public function newArchiveStore(Request $request, $id = 0)
    {
        $request->validate([
            'content' => 'required'
        ]);
        $user = auth()->user();
        $archiver = Archiver::where('id', @$id)->where('user_id', $user->id)->first();

        if ($archiver) {
            $notify[] = ['success', 'Archiver content updated successfully'];
        } else {
            $archiver             = new Archiver();
            $archiver->user_id    = auth()->id();
            $archiver->identifier = getTrx();
            $notify[]             = ['success', 'Archiver content added successfully'];
        }

        $category = ArchiverCategory::where('user_id', $user->id)->where('id', @$request->archiver_category)->first();
        if ($category) {
            $archiver->archiver_category_id   = $category->id;
        } else {
            $category          = new ArchiverCategory();
            $category->name    = $request->new_archiver_category;
            $category->user_id = $user->id;
            $category->save();
            $archiver->archiver_category_id = $category->id;
        }
        $archiver->content = $request->content;
        $archiver->save();

        return back()->withNotify($notify);
    }

    public function archiveDelete($id)
    {
        $archiver = Archiver::where('id', @$id)->where('user_id', auth()->id())->firstOrFail();
        $archiver->delete();
        $notify[] = ['success', 'Archiver content deleted successfully'];
        return back()->withNotify($notify);
    }

    // public function grammerCheck(Request $request)
    // {

    //     $url = "https://api.sapling.ai/api/v1/spellcheck";
    //     $apiPrivateKey = "UEK20NMKKB3GE849SC0CNSTW307AI4SD";

    //     $data = array(
    //         'key' => $apiPrivateKey,
    //         'text' => $request->text,
    //         'session_id' => 'test session'
    //     );


    //     $response = CurlRequest::curlPostContent($url, json_encode($data), [
    //         'Content-Type: application/json',
    //     ]);

    //     $response = json_decode($response);

    //     dd($response);
    // }
}

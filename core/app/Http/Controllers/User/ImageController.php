<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use App\Lib\FileManager;
use App\Models\AIImage;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function list()
    {
        $pageTitle = 'All Images';
        $data      = AIImage::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(getPaginate());
        $artists   = json_decode(file_get_contents(resource_path('views/partials/artist.json')));
        $user      = auth()->user();
        return view('Template::user.images.list', compact('pageTitle', 'data', 'artists', 'user'));
    }

    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'nullable|string|max:40',
            'artist'      => 'required|string|max:40',
            'description' => 'required|string',
            'amount'      => 'required|integer|min:1|max:10',
            'resolution'  => "required|string|in:256x256,512x512,1024x1024",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $response = $this->checkLimitValidation();
        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']]);
        }


        $prompt = "Hey AI Assistant. I need help. I need " . $request->amount . " image. \n\n Please create images with this description. The description is: " . $request->description . " \n\n Images must be drawn by the artist " . $request->artist . " \n\n Image resolution will be " . $request->resolution . " px";

        $apiKey = gs('api_key');
        $url    = 'https://api.openai.com/v1/images/generations';
        $data   = json_encode([
            "prompt" => $prompt,
            "n"      => (int) $request->amount,
            "size"   => $request->resolution,
        ]);
        $header = [
            'Content-Type: application/json',
            "Authorization: Bearer $apiKey",
        ];

        $response = CurlRequest::curlPostContent($url, $data, $header);

        $data     = json_decode($response);

        if (!$data) {
            return response()->json(['error' => 'Something went wrong']);
        }

        if (@$data->error) {
            return response()->json(['error' => @$data->error->message]);
        }

        $user          = auth()->user();
        $newImageLimit = $user->access->image_limit - $request->amount;
        $userAccess    = json_decode(json_encode($user->access), true);

        $updateAccessLimit                = collect($userAccess);
        $updateAccessLimit['image_limit'] = $newImageLimit < 0 ? 0 : $newImageLimit;
        $user->access                     = $updateAccessLimit;
        $user->save();

        $items = [];

        foreach ($data->data as $image) {
            $url       = $image->url;
            $contents  = file_get_contents($url);
            $extension = $this->getImageExtensionFromUrl($url);
            if (!$extension) {
                $extension = 'png';
            }

            $name = uniqid() . time() . '.' . $extension;
            fileManager()->makeDirectory(getFilePath('ai_image'));
            $path = getFilePath('ai_image') . '/' . $name;
            Storage::put($name, $contents);
            File::move(storage_path('app/' . $name), $path);

            $item              = new AIImage();
            $item->user_id     = auth()->id();
            $item->name        = $request->name ?? 'image';
            $item->artist      = $request->artist;
            $item->description = $request->description;
            $item->resolution  = $request->resolution;
            $item->amount      = $request->amount;
            $item->image       = $name;
            $item->save();

            $items[] = (object)[
                'id'    => $item->id,
                'image' => $item->image,
                'name'  => $item->name,
            ];
        }

        $history              = new History();
        $history->user_id     = auth()->id();
        $history->title       = @$request->name ?? 'Image';
        $history->description = @$request->description;
        $history->token       = $request->amount;
        $history->save();

        $html = view('Template::user.images.image_result', compact('items'))->render();
        return response()->json(['item_id' => $item->id, 'html' => $html]);
    }

    private function checkLimitValidation()
    {
        $user    = auth()->user();
        $request = request();
        if (!$user->plan_id || $user->expired_date < now()) {
            $error = ['error' => 'You have no such plan, subscribe to get access'];
            return $error;
        }
        if (!$user->access->ai_image) {
            $error = ['error' => 'Your image feature is not available for your subscription plan'];
            return $error;
        }

        if ($request->amount > $user->access->image_limit) {
            $error = ['error' => 'You have no image balance'];
            return $error;
        }
        return $request->amount;
    }

    private function getImageExtensionFromUrl($url)
    {
        $queryParams = parse_url($url, PHP_URL_QUERY);
        parse_str($queryParams, $params);
        if (isset($params['rsct'])) {
            $extension = explode('/', $params['rsct']);
            return strtolower($extension[1]);
        } else {
            return null;
        }
    }

    public function remove($id)
    {
        $item = AIImage::where('user_id', auth()->id())->findOrFail($id);
        $path = getFilePath('ai_image') . '/' . $item->image;
        $file = new FileManager;
        $file->removeFile($path);
        $item->delete();
        $notify[] = ['success', 'Image remove successfully'];
        return back()->withNotify($notify);
    }

    public function download($id)
    {
        $item = AIImage::where('user_id', auth()->id())->findOrFail($id);
        $path = getFilePath('ai_image') . '/' . $item->image;
        return response()->download($path);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Transcript;
use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;

class TranscriptController extends Controller
{
    public function form()
    {
        $pageTitle   = 'Transcript File';
        $user        = auth()->user();
        $transcripts = Transcript::where('user_id', $user->id)->searchable(['description'])->paginate(getPaginate());
        return view('Template::user.transcript.form', compact('pageTitle', 'transcripts', 'user'));
    }

    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:mp3,mp4,mpeg,mpag,m4a,wav,webm',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $file  = $request->file('file');
        $bytes = $file->getSize();

        $getID3   = new getID3();
        $fileInfo = $getID3->analyze($file->getRealPath());

        $duration = null;
        if (isset($fileInfo['playtime_seconds'])) {
            $duration = $fileInfo['playtime_seconds'];
        }

        $error = $this->checkLimitValidation($bytes, $duration);

        if ($error) {
            return response()->json(['error' => $error]);
        }

        $user           = auth()->user();
        $newMinuteLimit = $user->access->minute_limit - $duration;
        $userAccess     = json_decode(json_encode($user->access), true);

        $updateAccessLimit                 = collect($userAccess);
        $updateAccessLimit['minute_limit'] = $newMinuteLimit < 0 ? 0 : $newMinuteLimit;
        $user->access                      = $updateAccessLimit;
        $user->save();

        $data = $this->fetchTranscript();
        if (isset($data['error'])) {
            $userAccess['minute_limit'] = $newMinuteLimit + $duration;
            $user->access               = $userAccess;
            $user->save();
            return response()->json(['error' => $data['error']]);
        }

        $transcript = $this->insertTranscript($bytes, $duration, $data);

        if ($transcript['error']) {
            return response()->json(['error' => $transcript['error']]);
        }

        $history = new History();
        $history->user_id = auth()->id();
        $history->title = 'AI Transcript';
        $history->description = 'Converted file to text';
        $history->token = $duration;
        $history->save();

        $result = view('Template::user.transcript.result', compact('transcript'))->render();

        return response()->json(['result' => $result, 'token' => getAmount($newMinuteLimit, 0)]);
    }

    private function fetchTranscript()
    {
        $request = request();
        if ($request->hasFile('file')) {
            try {
                $fileName = fileUploader($request->file('file'), getFilePath('transcript_file'));
            } catch (\Exception $exp) {
                $error = ['error' => 'Couldn\'t upload file'];
                return $error;
            }
        }

        $fileUrl = getFilePath('transcript_file') . '/' . $fileName;
        $file    = new \CURLFile($fileUrl);

        $apiKey = gs('api_key');
        $url    = 'https://api.openai.com/v1/audio/transcriptions';
        $data   = [
            "file"  => $file,
            "model" => 'whisper-1',
        ];
        $header = [
            "Authorization: Bearer $apiKey",
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        if ($response === false) {
            $error = ['error' => curl_error($ch)];
            curl_close($ch);
            return $error;
        }

        curl_close($ch);

        $data = json_decode($response);
        if (isset($data->error)) {
            $error = ['error' => $data->error->message];
            return $error;
        }

        return ['text' => $data->text, 'fileName' => $fileName];
    }

    private function insertTranscript($bytes, $duration, $data)
    {
        $request                 = request();
        $transcript              = new Transcript();
        $transcript->user_id     = auth()->id();
        $transcript->file_format = $request->file->getClientOriginalExtension();
        $transcript->size        = $bytes;
        $transcript->duration    = $duration;
        $transcript->description = $data['text'];
        $transcript->file        = $data['fileName'];
        $transcript->save();
        return $transcript;
    }

    private function checkLimitValidation($bytes, $duration)
    {
        $fileSize = formatFileSize($bytes);
        if ($fileSize['size'] > 25) {
            return 'Maximum upload file size 25 MB';
        }
        $user = auth()->user();
        if (!$user->plan_id || $user->expired_date < now()) {
            return 'You have no such plan, subscribe to get access';
        }
        if (!$user->access->ai_transcript) {
            return 'Your Speech to Text feature is not available for your subscription plan';
        }

        if ($duration > $user->access->minute_limit * 60) {
            return 'Your minute limit is over, subscribe and get more';
        }
        return null;
    }

    public function download($id)
    {
        $transcript = Transcript::where('user_id', auth()->id())->findOrFail($id);
        $content    = $transcript->description;
        $pdf        = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Kalpurush'])->loadView('Template::user.download.pdf_content', compact('content'));
        return $pdf->download('document.pdf');
    }
    public function remove($id)
    {
        $transcript = Transcript::where('user_id', auth()->id())->findOrFail($id);
        $file = getFilePath('transcript_file') . '/' . $transcript->file;
        if ($file) {
            unlink($file);
        }
        $transcript->delete();
        $notify[] = ['success', 'Transcript remove successfully'];
        return back()->withNotify($notify);
    }
}

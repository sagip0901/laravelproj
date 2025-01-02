<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use Illuminate\Http\Request;

class WeatherController extends Controller {
    public function index(Request $request) {
        $pageTitle = 'Weather';
        $search    = getRealIP();

        if ($request->search) {
            $search = $request->search;
        }
        $apiKey   = gs('weather_api_key');
        $response = CurlRequest::curlContent("http://api.weatherapi.com/v1/current.json?key=$apiKey&q=$search&aqi=no");
        $weather  = json_decode($response);
        return view('Template::user.weather.index', compact('pageTitle', 'weather'));
    }
}

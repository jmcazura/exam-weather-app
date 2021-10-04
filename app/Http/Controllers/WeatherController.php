<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q=".$request->city."&units=metric&appid=62280b75bcf6f9a43cc0b60b5d80eae3");
        return $response;
    }
}

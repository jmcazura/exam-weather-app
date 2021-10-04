<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        $response_weather = Http::get("https://api.openweathermap.org/data/2.5/weather?q=".$request->city."&units=metric&appid=".env("OPEN_WEATHER_APP_ID", false));
        $response_city = Http::get("https://api.foursquare.com/v2/venues/search?near=".$request->city.",JP&limit=5&client_id=".env("FOURSQUARE_CLIENT_ID", false)."&client_secret=".env("FOURSQUARE_CLIENT_SECRET", false)."&v=20210101");
        $city = json_decode($response_city, TRUE);

        $locations[] = array_merge(json_decode($response_weather, TRUE), [ "venues" => $city["response"]["venues"] ]);

        $data = collect($locations)->map(function ($location) {
            return [ 
                "city" => $location["name"],
                "weather" => $location["weather"], 
                "main" => [ 
                    "temp" => $location["main"]["temp"],
                    "sunrise" => Carbon::createFromTimestamp($location["sys"]["sunrise"], 'Japan')->format('g:i a'),
                    "sunset" => Carbon::createFromTimestamp($location["sys"]["sunset"], 'Japan')->format('g:i a'),
                ],
                "venues" => collect($location['venues'])->map(function ($venue) {
                    return [ 
                        "name" => $venue["name"],
                        "address" => $venue["location"]["address"] ?? null,
                        "description" => $venue["categories"][0]["name"] ?? null,
                        "map_link" => "https://maps.google.com/maps?z=12&t=m&q=loc:".$venue["location"]["lat"]."+".$venue["location"]["lng"],
                    ];
                })
            ];
        });

        return $data[0];
    }
}

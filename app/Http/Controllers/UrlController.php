<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{

    public function shorten(Request $request)
    {
        $request->validate(['original_url' => ['required', 'url']]);
        $shortenedUrl = Str::random(6);

        Url::create([
            'original_url' => $request->get('original_url'),
            'shortened_url' => $shortenedUrl,
        ]);

        return response()->json([
            'shortUrl' => env('APP_URL') . "/r/$shortenedUrl",
        ]);
    }

    public function reroute($shortUrl){
        $url = Url::where('shortened_url', $shortUrl)->firstOrFail();

        return redirect($url->original_url);
    }
}

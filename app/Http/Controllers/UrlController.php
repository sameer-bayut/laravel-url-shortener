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

        $urlExists = Url::firstWhere('original_url', $request->get('original_url'));

        if(isset($urlExists)){
            return view('400');
        }

        Url::create([
            'original_url' => $request->get('original_url'),
            'shortened_url' => $shortenedUrl,
        ]);

        return view('url', ['shortenedUrl' => "http://localhost:8000" . "/r/$shortenedUrl"]);
    }

    public function reroute($shortUrl){
        $url = Url::where('shortened_url', $shortUrl)->firstOrFail();
        $url->update(['last_visited_at' => now()]);

        error_log(now());

        return redirect($url->original_url);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UrlController extends Controller
{

    public function shorten(Request $request)
    {
        $request->validate(['original_url' => ['required', 'url']]);
        $shortenedUrl = Str::random(6);

        $urlExists = Url::firstWhere('original_url', $request->get('original_url'));

        if(isset($urlExists)){
            throw new BadRequestException('Link already exists');
        }

        Url::create([
            'original_url' => $request->get('original_url'),
            'shortened_url' => $shortenedUrl,
        ]);

        return view('url', ['shortenedUrl' => $shortenedUrl]);
    }

    public function reroute($shortUrl){
        $url = Url::where('shortened_url', $shortUrl)->firstOrFail();

        return redirect($url->original_url);
    }
}

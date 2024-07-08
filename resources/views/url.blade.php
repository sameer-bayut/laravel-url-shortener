<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        <title>Success</title>
    </head>
    <body class="body">
        <div class="container">
            <div style="color: white">
                <h1>Here's your shortened URL</h1>
                {{-- <a href="{{ $shortenedUrl }}">{{ $shortenedUrl }}</a> --}}
                <div class="copyContainer">
                    <a href="{{ $shortenedUrl }}">{{ $shortenedUrl }}</a>
                </div>
            </div>
        </div>
    </body>
</html>

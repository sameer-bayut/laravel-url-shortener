<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        <title>URL Shortener</title>
    </head>
    <body class="body">
        <div class="container">
        <div>
            <h1>Laravel URL Shortener</h1>
            <h3>Yet another useless url shortener....</h3>
        </div>
        </div>
        <div class="container">
            <form class="inputContainer" action="/shorten" method="POST">
                @csrf
                <input
                    class="urlInput"
                    type="text"
                    name="original_url"
                />
                <button type="submit" class="button">Shorten</button>
            </form>
        </div>
    </body>
</html>

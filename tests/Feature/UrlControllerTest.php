<?php

use App\Models\Url;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{get, post, artisan};

uses(RefreshDatabase::class);

it('shortens a valid url', function () {
    $response = post('/shorten', ['original_url' => 'https://www.example.com']);

    $response->assertStatus(200);
    $response->assertViewIs('url');
    $response->assertViewHas('shortenedUrl');

    $shortenedUrl = $response->viewData('shortenedUrl');
    expect(Url::where('original_url', 'https://www.example.com')->exists())->toBeTrue();
    expect($shortenedUrl)->toContain('/r/');
});

it('returns validation error for invalid url', function () {
    $response = post('/shorten', ['original_url' => 'invalid-url']);

    $response->assertSessionHasErrors(['original_url']);
});

it('returns 400 view for already existing url', function () {
    Url::create([
        'original_url' => 'https://www.example.com',
        'shortened_url' => Str::random(6),
    ]);

    $response = post('/shorten', ['original_url' => 'https://www.example.com']);

    $response->assertStatus(200);
    $response->assertViewIs('400');
});

it('redirects to the original url using a valid shortened url', function () {
    $shortenedUrl = Str::random(6);
    $originalUrl = 'https://www.example.com';

    Url::create([
        'original_url' => $originalUrl,
        'shortened_url' => $shortenedUrl,
    ]);

    $response = get("/r/$shortenedUrl");

    $response->assertStatus(302);
    $response->assertRedirect($originalUrl);
});

it('returns 404 for an invalid shortened url', function () {
    $response = get("/r/invalid-url");

    $response->assertStatus(404);
});

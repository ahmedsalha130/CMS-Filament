<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/posts/{slug}', function ($slug) {
    $key = app()->getLocale() === 'ar' ? 'slug_ar' : 'slug_en';
    $post = \App\Models\Post::where($key, $slug)->firstOrFail();

    return view('post.show', compact('post'));
});

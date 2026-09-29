<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/brand-review', fn () => response()
    ->view('brand-review')
    ->header('X-Robots-Tag', 'noindex, nofollow, noarchive, nosnippet, noimageindex'))
    ->name('brand-review');

<?php
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatController;

Route::get('/room/{slug}', function ($slug) {
    $chat = new ChatController;
    $variations = $chat->onlyChatVariations();
    //dd(Auth()->user()->get()->first()->toArray());
    return Inertia::render('Welcome', [
        'variations' => $variations,
        'id' => $chat->show($slug),
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('rooms');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
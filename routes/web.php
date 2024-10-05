<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/home', [ChatController::class, 'index']);
Route::get('chat/{id}', [ChatController::class, 'getChat']);
Route::get('/chats', [ChatController::class, 'fetchChats']);
Route::post('/chats', [ChatController::class, 'createChat']);
Route::get('/messages', [ChatController::class, 'fetchMessages'])->name('fetchMessages');
Route::post('/messages', [ChatController::class, 'sendMessage'])->name('sendMessage');


require __DIR__.'/auth.php';

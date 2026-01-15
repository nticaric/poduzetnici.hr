<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

use App\Http\Controllers\AdController;

Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create')->middleware('auth');
Route::post('/ads', [AdController::class, 'store'])->name('ads.store')->middleware('auth');
Route::get('/ads/{id}', [AdController::class, 'show'])->name('ads.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Tools (Alati)
Route::get('/alati', function () {
    return view('tools.index');
})->name('tools.index');

Route::get('/alati/hub3-generator', function () {
    return view('tools.hub3-generator');
})->name('tools.hub3-generator');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

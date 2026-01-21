<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AdvertisingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\UploadController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/poduzetnici', [PublicProfileController::class, 'index'])->name('profiles.index');
Route::get('/profile/{slug}', [PublicProfileController::class, 'show'])->name('profile.show');

Route::get('/oglasavanje', [AdvertisingController::class, 'index'])->name('advertising.index');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

use Illuminate\Support\Facades\Route;

Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create')->middleware('auth');
Route::post('/ads', [AdController::class, 'store'])->name('ads.store')->middleware('auth');
Route::get('/ads/{id}', [AdController::class, 'show'])->name('ads.show');
Route::get('/ads/{id}/edit', [AdController::class, 'edit'])->name('ads.edit')->middleware('auth');
Route::patch('/ads/{id}', [AdController::class, 'update'])->name('ads.update')->middleware('auth');
Route::delete('/ads/{id}', [AdController::class, 'destroy'])->name('ads.destroy')->middleware('auth');

// Upload signed URL for direct JS upload to DigitalOcean Spaces
Route::post('/upload/signed-url', [UploadController::class, 'signedUrl'])->name('upload.signed-url')->middleware('auth');

Route::get('/dashboard', function () {
    $user           = auth()->user();
    $ads            = $user->ads()->latest()->get();
    $totalViews     = $user->ads()->sum('views_count');
    $activeAds      = $user->ads()->active()->count();
    $expiredAds     = $user->ads()->where('expires_at', '<=', now())->count();
    $unreadMessages = $user->receivedMessages()->unread()->with(['sender', 'ad'])->latest()->take(5)->get();
    $unreadCount    = $user->unreadMessagesCount();

    return view('dashboard', compact('user', 'ads', 'totalViews', 'activeAds', 'expiredAds', 'unreadMessages', 'unreadCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Tools (Alati)
Route::get('/alati', function () {
    return view('tools.index');
})->name('tools.index');

Route::get('/alati/hub3-generator', function () {
    return view('tools.hub3-generator');
})->name('tools.hub3-generator');

Route::get('/alati/hub3-batch-generator', function () {
    return view('tools.hub3-batch-generator');
})->name('tools.hub3-batch-generator');

Route::get('/alati/sepa-pain001-generator', function () {
    return view('tools.sepa-pain001-generator');
})->name('tools.sepa-pain001-generator');

Route::get('/alati/kpd-preglednik', function () {
    return view('tools.kpd-preglednik');
})->name('tools.kpd-preglednik');

Route::get('/alati/kreditni-kalkulator', function () {
    return view('tools.kreditni-kalkulator');
})->name('tools.kreditni-kalkulator');

Route::get('/alati/bruto-neto-kalkulator', function () {
    return view('tools.bruto-neto-kalkulator');
})->name('tools.bruto-neto-kalkulator');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/facebook/data-deletion', function () {
    return view('facebook.data-deletion');
})->name('facebook.data-deletion');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::post('/profile/check-slug', [ProfileController::class, 'checkSlug'])->name('profile.check-slug');
    Route::post('/profile/toggle-public', [ProfileController::class, 'togglePublic'])->name('profile.toggle-public');
    Route::post('/profile/generate-slug', [ProfileController::class, 'generateSlug'])->name('profile.generate-slug');
});

require __DIR__ . '/auth.php';

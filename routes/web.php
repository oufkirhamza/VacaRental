<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DoubleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertieController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// the 2Fa don't work when i its activate : 
Route::get("/doubleAuth/show" , [DoubleAuthController::class , "index"])->name("doubleAuth")->middleware('auth');
Route::put("/doubleAuth/validation" , [DoubleAuthController::class , "validate2fa"])->name("doubleAuth.valide")->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


Route::middleware(['auth'])->group(function () {
    // contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact/create', [ContactController::class, 'store'])->name('contact.store');

    // review
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
    // search
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    // stripe
    // Route::get('/session', [StripeController::class, 'session']);
    Route::get('/success', [StripeController::class, 'success'])->name("success");
    // reservation
    Route::post('/reservation/create/{propertie}', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/reservation/show/{propertie}', [ReservationController::class, 'show'])->name('reservation.show');
    // propertie
    Route::get('/Home', [PropertieController::class, 'index_home'])->name('home');
    Route::get('/propertie', [PropertieController::class, 'index'])->name('propertie.index')->middleware("role:Owner");
    Route::get('/propertie/{propertie}',[PropertieController::class, 'show'])->name('propertie.show'); 
    Route::post('/propertie/create', [PropertieController::class, 'store'])->name('propertie.store');
    // 2fa
    Route::put("/doubleAuth/enable" , [DoubleAuthController::class , "authSwitcher"])->name('doubleAuth.switch');
    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

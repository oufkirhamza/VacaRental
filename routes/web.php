<?php

use App\Http\Controllers\DoubleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertieController;
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

Route::middleware(['auth','2fa'])->group(function () {
    Route::get('/Home', [PropertieController::class, 'index_home'])->name('home');
    Route::get('/propertie', [PropertieController::class, 'index'])->name('propertie.index');
    Route::get('/propertie/{propertie}',[PropertieController::class, 'show'])->name('propertie.show');
    Route::post('/propertie/create', [PropertieController::class, 'store'])->name('propertie.store');
    Route::put("/doubleAuth/enable" , [DoubleAuthController::class , "authSwitcher"])->name('doubleAuth.switch');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

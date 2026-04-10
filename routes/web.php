<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\BurgerController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CommandeController;
use App\Http\Controllers\Dashboard\PaiementController;
use App\Http\Controllers\Client\CommandeClientController;
use App\Http\Controllers\BurgerPublicController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuProposController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [MenuController::class, 'home'])->name('home');
Route::get('/menu', [MenuProposController::class, 'index'])->name('menu');
Route::get('/galerie', [GalerieController::class, 'index'])->name('galerie');
Route::get('/burgers', [BurgerPublicController::class, 'index'])->name('burgers.index');

Route::get('/about_us', function () {
    return view('about_us');
})->name('about');


Route::post('/commandes', [App\Http\Controllers\CommandeController::class, 'store'])
    ->name('commandes.store');


require __DIR__.'/auth.php';


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'is_client'])->prefix('client')->name('client.')->group(function () {
    Route::resource('commandes', CommandeClientController::class)->only([
        'index', 'store', 'show'
    ]);
});




Route::middleware(['auth', 'is_gestionnaire'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('burgers',    BurgerController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('commandes',  CommandeController::class);
    Route::resource('paiements',  PaiementController::class);
});


Route::get('/test-mail', function () {
    \Illuminate\Support\Facades\Mail::raw('Test email ISI Burger', function ($message) {
        $message->to('fatoumatazahra2005@gmail.com')->subject('Test Email Laravel');
    });
    return "Email envoyé !";
});

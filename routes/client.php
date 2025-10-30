<?php

use App\Http\Controllers\AdresseController;
use App\Http\Controllers\Auth\AuthClientController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContacterController;
use App\Http\Controllers\InfoBancaireController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CommandeController;
use Illuminate\Support\Facades\Route;

Route::name('client.')->group(function () {
    Route::controller(WelcomeController::class)->group(function () {
        Route::get('/accueil', '__invoke')->name('accueil');
        Route::get('a-propos', 'showAbout')->name('a-propos');
        Route::get('/', 'showArticles')->name('show-article');
        Route::get('/panier', 'showPanier')->name('show-panier');
        Route::get('/carte-de-visite', 'CarteVisite1')->name('carte-de-visite');
        Route::get('/carte-de-visite-eugenie', 'CarteVisite2')->name('carte-de-visite2');

    });

    Route::controller(BlogController::class)->prefix('blogs')->name('blogs.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{blog}/lire', 'show')->name('show');
    });

    Route::controller(ContacterController::class)->prefix('nous-contacter')->name('contact.')->group(function () {
        Route::get('', 'index')->name('create');
        Route::post('', 'store')->name('store');
    });

    Route::controller(CategoryController::class)->prefix('categorie')->name('categories.')->group(function () {
        Route::get('liste', 'index')->name('index');
        Route::get('{categorie}/articles', 'articlesByCategory')->name('get-articles');
    });

    Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

    Route::controller(AdresseController::class)->group(function () {
        Route::get('/adresses', 'index');
        Route::post('/adresses/store', 'store');
        Route::get('/adresses/{id}/show', 'show');
        Route::put('/adresses/{id}/update', 'update');
        Route::delete('/adresses/{id}/delete', 'destroy');
        Route::post('/adresses/{id}/activer', 'activer');
    });

});
// Routes du panier
Route::prefix('cart')->group(function () {
    Route::get('/', [PanierController::class, 'index'])->name('cart.index');
    Route::post('/add', [PanierController::class, 'add'])->name('cart.add');
    Route::post('/sub', [PanierController::class, 'sub'])->name('cart.sub');
    Route::get('/getPanier', [PanierController::class, 'get'])->name('cart.get');
    Route::put('/update/{rowId}', [PanierController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{rowId}', [PanierController::class, 'remove'])->name('cart.remove');
    Route::delete('/clear', [PanierController::class, 'clear'])->name('cart.clear');

});

Route::controller(AuthClientController::class)->prefix('client')->name('client.')->group(function () {
    Route::post('/log', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::get('/authentification', 'doLogin')->name('dologin');
    Route::get('/register', 'doRegister')->name('doregister');
    Route::delete('/logout', 'logout')->name('logout');
    Route::put('/{user}/update', 'update')->name('update');

});

Route::controller(InfoBancaireController::class)->group(function () {
    Route::get('/info-bancaire', 'index');
});

Route::controller(CommandeController::class)->group(function () {
    Route::post('/commandes', 'store');
    Route::get('/mes-commandes', 'getMyCommand')->name('mes-commandes');
});



// Route::middleware('cart.auth')->group(function () {

//     Route::prefix('cart')->group(function () {
//     Route::put('/update/{rowId}', [PanierController::class, 'update'])->name('cart.update');
//     Route::delete('/remove/{rowId}', [PanierController::class, 'remove'])->name('cart.remove');
//     Route::delete('/clear', [PanierController::class, 'clear'])->name('cart.clear');
// });

// });

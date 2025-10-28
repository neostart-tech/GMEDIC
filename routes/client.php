<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContacterController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::name('client.')->group(function () {
    Route::controller(WelcomeController::class)->group(function () {
        Route::get('/accueil', '__invoke')->name('accueil');
        Route::get('a-propos', 'showAbout')->name('a-propos');
        Route::get('/', 'showArticles')->name('show-article');
        Route::get('/panier', 'showPanier')->name('show-panier');
        Route::get('/carte-de-visite','CarteVisite1')->name('carte-de-visite');
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

});
Route::controller(PanierController::class)->prefix('cart')->group(function () {
    Route::get('/', 'index');
        Route::get('/getPanier', 'get');

    Route::post('/add', 'add');

    Route::put('/update/{rowId}', 'update');
    Route::delete('/remove/{rowId}', 'remove');
    Route::delete('/clear', 'clear');
});

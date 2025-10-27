<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContacterController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::name('client.')->group(function () {
    Route::controller(WelcomeController::class)->group(function () {
        Route::get('','__invoke')->name('accueil');
        Route::get('a-propos', 'showAbout')->name('a-propos');
        Route::get('/liste-des-articles', 'showArticles')->name('show-article');
        Route::get('/panier', 'showPanier')->name('show-panier');
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

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CruiseController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubscriberController;

// Home controller routes for clients
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/contactUS', [HomeController::class, 'contactUS'])->name('contactUs');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/allCruises', [HomeController::class, 'allCruises'])->name('allCruises');
Route::get('/retailService', [HomeController::class, 'retailService'])->name('retailService');

// Contuctus message send ans response
Route::post('/contactUs/send', [HomeController::class, 'contsend'])->name('contsend');

// Auth routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


    // Site settings query
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [HomeController::class, 'settings'])->name('settings.index');
    });

    // All resourse routes
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('subscribers', SubscriberController::class);
    Route::resource('trades', TradeController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('cruises', CruiseController::class);
    // News letters
    Route::group(['prefix' => 'newsletters'], function () {
        Route::get('/', [NewsletterController::class, 'index'])->name('newsletters.index');
        Route::post('/store', [NewsletterController::class, 'store'])->name('newsletters.store');
        Route::get('/show/{newsletter}', [NewsletterController::class, 'show'])->name('newsletters.show');
        Route::post('/send/{newsletter}', [NewsletterController::class, 'send'])->name('newsletters.send');
        Route::delete('/delete/{newsletter}', [NewsletterController::class, 'destroy'])->name('newsletters.destroy');
    });
    // Contuc us query
    Route::group(['prefix' => 'quaries'], function () {
        Route::get('allquaries', [QueryController::class, 'allquaries'])->name('quaries.all');
        Route::get('readed', [QueryController::class, 'readed'])->name('quaries.readed');
        Route::get('unreaded', [QueryController::class, 'unreaded'])->name('quaries.unreaded');
        Route::get('read/{query}', [QueryController::class, 'read'])->name('quaries.read');
        Route::post('replay', [QueryController::class, 'replay'])->name('quaries.replay');
        Route::patch('toggle/{query}', [QueryController::class, 'toggle'])->name('toggleQuery');
        Route::delete('delete/{query}', [QueryController::class, 'destroy'])->name('deleteQuery');
    });

    // Media handeling
    Route::post('/galaryupload', [UploadController::class, 'store']);
    Route::delete('/galleries/{gallery}/media/{media}', [UploadController::class, 'delete'])->name('mediaDelete');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

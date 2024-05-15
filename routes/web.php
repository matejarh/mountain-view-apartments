<?php

use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PropertiesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function() {
    return redirect(app()->getLocale());
});

Route::post('/language-switch', [LanguageController::class, 'switch'])->name('switch.language');
Route::group(['prefix' => '{lang}', 'middleware' => 'web'], function () {
    Route::get('/', [PagesController::class, 'home'])->name('home');
    Route::get('/about-us', [PagesController::class, 'aboutUs'])->name('aboutus');
    Route::name('properties.')->prefix('accomodations')->namespace('accomodations')->group(function () {
        Route::get('/', [PropertiesController::class, 'index'])->name('index');
        Route::get('/{property}', [PropertiesController::class, 'show'])->name('show');
        Route::post('/{property}/like', [PropertiesController::class, 'like'])->name('like');
    });


});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::name('dashboard.')->prefix('dashboard')->namespace('dashboard')->group(function () {
        Route::get('/', function () {
            if (auth()->user()->is_admin)
                return redirect(route('admin.dashboard.show'));
            return Inertia::render('Dashboard');
        })->name('show');
    });

    Route::get('/user/activities', [ActivitiesController::class, 'index'])->name('activities');
});

<?php

use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\InquiriesController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function() {
    return redirect(app()->currentLocale());
});

Route::post('/language-switch', [LanguageController::class, 'switch'])->name('switch.language');
Route::post('/send-inquiry/{property}', [InquiriesController::class, 'create'])->name('inquiry.create');
Route::get('/fetch-properties-for-dropdown', [PropertiesController::class, 'fetch'])->name('properties.fetch');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::name('dashboard.')->prefix('dashboard')->namespace('dashboard')->group(function () {
        Route::get('/', function () {
            if (auth()->user()->is_admin)
                return redirect(route('admin.dashboard.show'));
            else
                return redirect(route('profile.show'));
            // return Inertia::render('Dashboard');
        })->name('show');
    });

    Route::name('properties.')->prefix('accomodations')->namespace('accomodations')->group(function () {
        Route::post('/{property}/like', [PropertiesController::class, 'like'])->name('like');
        Route::post('/{property}/review', [PropertiesController::class, 'review'])->name('review');
    });

    Route::get('/user/activities', [ActivitiesController::class, 'index'])->name('activities');

    /* Route::group(['prefix' => '{lang}', 'middleware' => 'web'], function () {
        Route::get('/profile', [UserProfileController::class, 'show'])->name('auth.profile.show');

    }); */
});

Route::group(['prefix' => '{lang}', 'middleware' => 'web'], function () {
    Route::get('/', [PagesController::class, 'home'])->name('home');
    Route::get('/about-us', [PagesController::class, 'aboutUs'])->name('aboutus');
    Route::name('properties.')->prefix('accomodations')->namespace('accomodations')->group(function () {
        Route::get('/', [PropertiesController::class, 'index'])->name('index');
        Route::get('/{property}', [PropertiesController::class, 'show'])->name('show');
    });

    Route::get('/', [PagesController::class, 'home'])->name('home');

});

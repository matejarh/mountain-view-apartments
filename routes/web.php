<?php

use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\InquiriesController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\StoriesController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function() {
    return redirect(app()->currentLocale()."/home");
});

/**
 * Public routes without $lang prefix
 */
Route::post('/language-switch', [LanguageController::class, 'switch'])->name('switch.language')->middleware('throttle:10');
Route::post('/send-inquiry/{property}', [InquiriesController::class, 'store'])->name('inquiry.store')->middleware(app()->environment() === 'production' ? 'throttle:10' : 'throttle:global');
Route::get('/fetch-properties-for-dropdown', [PropertiesController::class, 'fetch'])->name('properties.fetch')->middleware('throttle:10');


/**
 * Public routes with $lang prefix
 */

Route::group(['prefix' => '{lang}', 'middleware' => 'web'], function () {
    Route::get('/home', [PagesController::class, 'home'])->name('home');

    Route::get('/about-us', [PagesController::class, 'aboutUs'])->name('aboutus');

    Route::name('properties.')->prefix('accomodations')->namespace('accomodations')->group(function () {
        Route::get('/', [PropertiesController::class, 'index'])->name('index');
        Route::get('/{property}', [PropertiesController::class, 'show'])->name('show');
    });

    Route::name('reviews.')->prefix('reviews')->namespace('reviews')->group(function () {
        Route::get('/for/{property}', [ReviewsController::class, 'index'])->name('index');

    });
    Route::get('/offers', [PagesController::class, 'offers'])->name('offers');
    Route::get('/contact', [PagesController::class, 'contact'])->name('contact.show');
    Route::get('/explore/bled', [PagesController::class, 'bled'])->name('explore.bled');
    Route::get('/discover/nassfeld', [PagesController::class, 'nassfeld'])->name('discover.nassfeld');

    Route::name('stories.')->prefix('stories')->namespace('stories')->group(function () {
        Route::get('/', [StoriesController::class, 'index'])->name('index');
        Route::get('/{story}', [StoriesController::class, 'show'])->name('show');
    });

});


/**
 * Authentucated user routes
 */
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
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

        Route::name('reservations.')->prefix('reservations')->namespace('reservations')->group(function () {
            Route::post('/store/for/{property}', [ReservationsController::class, 'store'])->name('store')->middleware([app()->environment() === 'production' ? 'throttle:one-per-hour' : 'throttle:global']);
        });

    });

    Route::get('/user/activities', [ActivitiesController::class, 'index'])->name('activities');

    Route::name('reviews.')->prefix('reviews')->namespace('reviews')->group(function () {
        Route::post('/for/{property}/store', [ReviewsController::class, 'store'])->name('store');

    });

    Route::group(['prefix' => '{lang}', 'middleware' => 'web'], function () {

        Route::name('reviews.')->prefix('my-reviews')->namespace('reviews')->group(function () {
            Route::get('/for/{property}/create', [ReviewsController::class, 'create'])->name('create');
        });

        Route::name('inquiries.')->prefix('my-inquiries')->namespace('inquiries')->group(function () {
            Route::get('/', [InquiriesController::class, 'index'])->name('index');
        });

        Route::name('reservations.')->prefix('my-reservations')->namespace('reservations')->group(function () {
            Route::get('/', [ReservationsController::class, 'index'])->name('index');
        });

    });
});

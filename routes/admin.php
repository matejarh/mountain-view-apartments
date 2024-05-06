<?php
use App\Http\Controllers\Admin\ActivitiesLogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleriesController;
use App\Http\Controllers\Admin\ImagesController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use Laravel\Fortify\RoutePath;



Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
    $authMiddleware = config('jetstream.guard')
        ? 'auth:' . config('jetstream.guard')
        : 'auth';

    $authSessionMiddleware = config('jetstream.auth_session', false)
        ? config('jetstream.auth_session')
        : null;

    Route::group(['middleware' => array_values(array_filter([$authMiddleware, $authSessionMiddleware]))], function () {
        Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard.show');

        Route::name('settings.')->prefix('settings')->namespace('settings')->group(function() {
            Route::get('/', [SettingsController::class, 'index'])->name('index');
            Route::post('/', [SettingsController::class, 'store'])->name('store');
            Route::get('/{setting}', [SettingsController::class, 'show'])->name('show');
            Route::put('/{setting}', [SettingsController::class, 'update'])->name('update');
            Route::delete('/{setting}', [SettingsController::class, 'destroy'])->name('destroy');



            Route::name('settings.')->prefix('settings')->namespace('settings')->group(function() {

            });
        });

        Route::name('properties.')->prefix('properties')->namespace('properties')->group(function() {
            Route::get('/', [PropertiesController::class, 'index'])->name('index');
            Route::post('/', [PropertiesController::class, 'store'])->name('store');
            Route::get('/{property}', [PropertiesController::class, 'show'])->name('show');
            Route::put('/{property}', [PropertiesController::class, 'update'])->name('update');
            Route::delete('/{property}', [PropertiesController::class, 'destroy'])->name('destroy');
            Route::put('attach/{property}/{facility}', [PropertiesController::class, 'attach'])->name('attach');
            Route::put('detach/{property}/{facility}', [PropertiesController::class, 'detach'])->name('detach');
        });

        Route::name('users.')->prefix('users')->namespace('users')->group(function() {

            Route::get('/all', [UsersController::class, 'index'])->name('index');

            Route::put('/all/{user}', [UsersController::class, 'update'])->name('update');

            Route::get('activity-log', [ActivitiesLogController::class, 'index'])->name('activities.index');
            Route::get('activity-log/{skip}/{take}', [ActivitiesLogController::class, 'feed'])->name('activities.index.feed');
        });

        Route::name('galleries.')->prefix('galleries')->namespace('galleries')->group(function() {
            Route::get('/', [GalleriesController::class, 'index'])->name('index');
            Route::post('/', [GalleriesController::class, 'store'])->name('store');
            Route::get('{gallery}', [GalleriesController::class, 'show'])->name('show');
            Route::put('{gallery}', [GalleriesController::class, 'update'])->name('update');
            Route::delete('{gallery}', [GalleriesController::class, 'destroy'])->name('destroy');
            Route::put('attach/{gallery}/{image}', [GalleriesController::class, 'attach'])->name('attach');
            Route::put('detach/{gallery}/{image}', [GalleriesController::class, 'detach'])->name('detach');
        });

        Route::name('images.')->prefix('images')->namespace('images')->group(function() {
            Route::get('/', [ImagesController::class, 'index'])->name('index');
            Route::post('/', [ImagesController::class, 'store'])->name('store');
            Route::get('/fetch-backgrounds', [ImagesController::class, 'fetchBackgrounds'])->name('fetchbackgrounds');
            Route::get('{image}', [ImagesController::class, 'show'])->name('show');
            Route::post('{image}', [ImagesController::class, 'update'])->name('update');
            Route::delete('{image}', [ImagesController::class, 'destroy'])->name('destroy');
            Route::put('attach/{image}/{gallery}', [ImagesController::class, 'attach'])->name('attach');
            Route::put('detach/{image}/{gallery}', [ImagesController::class, 'detach'])->name('detach');
            Route::get('{gallery}/fetch', [ImagesController::class, 'fetch'])->name('fetch');

            // Route::get('search', ['as' => 'search', 'uses' => 'SearchController@search']);
        });
    });

});


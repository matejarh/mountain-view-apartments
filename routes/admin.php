<?php
use App\Http\Controllers\Admin\ActivitiesLogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleriesController;
use App\Http\Controllers\Admin\ImagesController;
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

        Route::name('users.')->prefix('users')->namespace('users')->group(function() {

            Route::get('/', [UsersController::class, 'index'])->name('index');

            Route::put('{user}', [UsersController::class, 'update'])->name('update');

            Route::get('activity-log', [ActivitiesLogController::class, 'index'])->name('activities.index');
            Route::get('activity-log/{skip}/{take}', [ActivitiesLogController::class, 'feed'])->name('activities.index.feed');
        });

        Route::name('galleries.')->prefix('galleries')->namespace('galleries')->group(function() {
            Route::get('/', [GalleriesController::class, 'index'])->name('index');
            Route::post('store', [GalleriesController::class, 'store'])->name('store');
            Route::get('{gallery}', [GalleriesController::class, 'show'])->name('show');
            Route::put('{gallery}', [GalleriesController::class, 'update'])->name('update');
            Route::delete('{gallery}', [GalleriesController::class, 'destroy'])->name('destroy');
            Route::put('attach/{gallery}/{image}', [GalleriesController::class, 'attach'])->name('attach');
            Route::put('detach/{gallery}/{image}', [GalleriesController::class, 'detach'])->name('detach');
        });

        Route::name('images.')->prefix('images')->namespace('images')->group(function() {
            Route::get('/', [ImagesController::class, 'index'])->name('index');
            Route::post('store', [ImagesController::class, 'store'])->name('store');
            Route::get('{image}', [ImagesController::class, 'show'])->name('show');
            Route::post('{image}', [ImagesController::class, 'update'])->name('update');
            Route::delete('{image}', [ImagesController::class, 'destroy'])->name('destroy');
            Route::put('attach/{image}/{gallery}', [ImagesController::class, 'attach'])->name('attach');
            Route::put('detach/{image}/{gallery}', [ImagesController::class, 'detach'])->name('detach');
            Route::get('{gallery}/fetch', [ImagesController::class, 'fetch'])->name('fetch');
        });
    });

});


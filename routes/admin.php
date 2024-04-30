<?php
use App\Http\Controllers\Admin\ActivitiesLogController;
use App\Http\Controllers\Admin\DashboardController;
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

            Route::get('index', [UsersController::class, 'index'])->name('index');

            Route::put('{user}', [UsersController::class, 'update'])->name('update');

            Route::get('activity-log/index', [ActivitiesLogController::class, 'index'])->name('activities.index');
            Route::get('activity-log/index/{skip}/{take}', [ActivitiesLogController::class, 'feed'])->name('activities.index.feed');
        });
    });

});


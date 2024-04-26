<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;



Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
    $authMiddleware = config('jetstream.guard')
        ? 'auth:' . config('jetstream.guard')
        : 'auth';

    $authSessionMiddleware = config('jetstream.auth_session', false)
        ? config('jetstream.auth_session')
        : null;

    Route::group(['middleware' => array_values(array_filter([$authMiddleware, $authSessionMiddleware]))], function () {
        Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard.show');

        Route::get('users', [UsersController::class, 'index'])->name('users.index');
    });

});


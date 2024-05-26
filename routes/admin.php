<?php
use App\Http\Controllers\Admin\ActivitiesLogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilitiesController;
use App\Http\Controllers\Admin\GalleriesController;
use App\Http\Controllers\Admin\ImagesController;
use App\Http\Controllers\Admin\InquiriesController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\Admin\ReservationsController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;





Route::group(['middleware' => config('jetstream.middleware')], function () {
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
        });

        Route::name('properties.')->prefix('properties')->namespace('properties')->group(function() {
            Route::get('/', [PropertiesController::class, 'index'])->name('index');
            Route::post('/', [PropertiesController::class, 'store'])->name('store');
            Route::get('/{property}', [PropertiesController::class, 'show'])->name('show');
            Route::put('/{property}', [PropertiesController::class, 'update'])->name('update');
            Route::delete('/{property}', [PropertiesController::class, 'destroy'])->name('destroy');
            Route::put('attach-facility/{property}/{facility}', [PropertiesController::class, 'attachFacility'])->name('attach.facility');
            Route::put('detach-facility/{property}/{facility}', [PropertiesController::class, 'detachFacility'])->name('detach.facility');
            Route::put('attach-gallery/{property}/{gallery}', [PropertiesController::class, 'attachGallery'])->name('attach.gallery');
            Route::put('detach-gallery/{property}/{gallery}', [PropertiesController::class, 'detachGallery'])->name('detach.gallery');
        });

        Route::name('facilities.')->prefix('facilities')->namespace('facilities')->group(function() {
            Route::post('/', [FacilitiesController::class, 'store'])->name('store');
            Route::put('/{facility}', [FacilitiesController::class, 'update'])->name('update');
            Route::delete('/{facility}', [FacilitiesController::class, 'destroy'])->name('destroy');
        });

        Route::name('users.')->prefix('users')->namespace('users')->group(function() {

            Route::get('/all', [UsersController::class, 'index'])->name('index');
            Route::get('/all/{user}', [UsersController::class, 'show'])->name('show');

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
            Route::put('{gallery}/update-images-order', [GalleriesController::class, 'updateImagesOrder'])->name('update-images-order');
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

        Route::name('pages.')->prefix('pages')->namespace('pages')->group(function() {
            Route::get('/', [PagesController::class, 'index'])->name('index');
            Route::post('/', [PagesController::class, 'store'])->name('store');
            Route::get('{page}', [PagesController::class, 'show'])->name('show');
            Route::put('{page}', [PagesController::class, 'update'])->name('update');
            Route::delete('{page}', [PagesController::class, 'destroy'])->name('destroy');
            Route::put('attach-gallery/{page}/{gallery}', [PagesController::class, 'attachGallery'])->name('attach.gallery');
            Route::put('detach-gallery/{page}/{gallery}', [PagesController::class, 'detachGallery'])->name('detach.gallery');
        });

        Route::name('inquiries.')->prefix('inquiries')->namespace('inquiries')->group(function() {
            Route::get('/', [InquiriesController::class, 'index'])->name('index');
            Route::get('{inquiry}', [InquiriesController::class, 'show'])->name('show');
            Route::put('{inquiry}', [InquiriesController::class, 'update'])->name('update');
            Route::delete('{inquiry}', [InquiriesController::class, 'destroy'])->name('destroy');
            Route::post('/store/{property}', [InquiriesController::class, 'store'])->name('store');
            Route::post('/reply/to/{inquiry}', [InquiriesController::class, 'reply'])->name('reply');
        });

        Route::name('reviews.')->prefix('reviews')->namespace('reviews')->group(function() {
            Route::get('/', [ReviewsController::class, 'index'])->name('index');
            Route::get('{review}', [ReviewsController::class, 'show'])->name('show');
            Route::put('{review}', [ReviewsController::class, 'update'])->name('update');
            Route::delete('{review}', [ReviewsController::class, 'destroy'])->name('destroy');
            Route::post('/property/{property}', [ReviewsController::class, 'store'])->name('store');
            Route::put('/approve/{review}', [ReviewsController::class, 'approve'])->name('approve');
            Route::put('/reject/{review}', [ReviewsController::class, 'reject'])->name('reject');
        });

        Route::name('reservations.')->prefix('reservations')->namespace('reservations')->group(function() {
            Route::get('/', [ReservationsController::class, 'index'])->name('index');
            Route::get('{reservation}', [ReservationsController::class, 'show'])->name('show');
            Route::put('{reservation}', [ReservationsController::class, 'update'])->name('update');
            Route::put('{reservation}/confirm', [ReservationsController::class, 'confirm'])->name('confirm');
            Route::put('{reservation}/reject', [ReservationsController::class, 'reject'])->name('reject');
            Route::put('{reservation}/payment-reject', [ReservationsController::class, 'rejectPayment'])->name('reject.payment');
            Route::put('{reservation}/payment-approve', [ReservationsController::class, 'approvePayment'])->name('approve.payment');
            Route::delete('{reservation}', [ReservationsController::class, 'destroy'])->name('destroy');
        });

        Route::name('notifications.')->prefix('notifications')->namespace('notifications')->group(function() {
            Route::get('/preview/{notification}/{items}', [NotificationsController::class, 'preview'])->name('preview');
            Route::get('{notification}', [NotificationsController::class, 'show'])->name('show');
            Route::get('/', [NotificationsController::class, 'index'])->name('index');
            //Route::put('{notification}', [NotificationsController::class, 'update'])->name('update');
            // Route::delete('{notification}', [NotificationsController::class, 'destroy'])->name('destroy');
            Route::put('/read-all', [NotificationsController::class, 'readAll'])->name('read.all');
            Route::put('/read', [NotificationsController::class, 'read'])->name('read');
            Route::delete('/destroy-all', [NotificationsController::class, 'destroyAll'])->name('destroy.all');
            Route::delete('/destroy', [NotificationsController::class, 'destroy'])->name('destroy');

        });
    });

});


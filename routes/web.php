<?php

use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PagesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::post('/language-switch', [LanguageController::class, 'switch'])->name('switch.language');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::name('dashboard.')->prefix('dashboard')->namespace('dashboard')->group(function() {
        Route::get('/', function () {
            if (auth()->user()->is_admin) return redirect(route('admin.dashboard.show'));
            return Inertia::render('Dashboard');
        })->name('show');
    });

    Route::get('/user/activities', [ActivitiesController::class, 'index'])->name('activities');
});

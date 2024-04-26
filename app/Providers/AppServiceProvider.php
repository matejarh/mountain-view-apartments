<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            \Illuminate\Auth\Events\Login::class,
            \App\Listeners\RecordUserLogin::class,
        );
        Event::listen(
            \Illuminate\Auth\Events\Logout::class,
            \App\Listeners\RecordUserLogout::class,
        );

        RateLimiter::for('global', function (Request $request) {
            $throttleKey = \Str::transliterate(\Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(1000)->by($throttleKey);
            /* return Limit::perMinute(1000)->response(function (Request $request, array $headers) {
                return response(__('Too Many Requests'), 429, $headers);
            }); */
        });

        RateLimiter::for('admins', function (Request $request) {
            return Limit::perMinute(120)->by($request->session()->get('login.id'));
        });
    }
}

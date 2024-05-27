<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;

use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
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
            $throttleKey = str(str($request->input(Fortify::username()))->lower() . '|' . $request->ip())->transliterate();

            return Limit::perMinute(1000)->by($throttleKey);
            /* return Limit::perMinute(1000)->response(function (Request $request, array $headers) {
                return response(__('Too Many Requests'), 429, $headers);
            }); */
        });

        RateLimiter::for('one-per-hour', function (Request $request) {
            $throttleKey = str(str($request->input(Fortify::username()))->lower() . '|' . $request->ip())->transliterate();
            return Limit::perHour(1)->by($throttleKey)->response(function (Request $request, array $headers) {
                return response(__('You can not post another reservation yet'), 429, $headers);
            });
        });

        RateLimiter::for('admins', function (Request $request) {
            return Limit::perMinute(120)->by($request->session()->get('login.id'));
        });

        Cashier::calculateTaxes();

        /**
         * Paginate a standard Laravel Collection.
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') : LengthAwarePaginator
        {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

    }
}

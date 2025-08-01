<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Laravel\Fortify\Features;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            // 'language' => session('language') ?: app()->currentLocale(),
            'locale' => function () {
                return session('language') ?: app()->currentLocale();
            },
            'supported_locales' => config('app.supported_locales'),
            'date_format_pattern' => $this->getCurrentLocaleDateFormatPattern(),
            'translations' => function () {
                return translations(
                    base_path('lang/' . app()->currentLocale() . '.json')
                );
            },
            'canRegister' => Features::enabled(Features::registration()),
            'settings' => cache()->rememberForever('settings', function () {
                return Setting::all();
            }),
            'current_season' => $this->getSeason(),
            'recaptcha_site_key' => config('services.google_recaptcha.site_key'),
            'notifications' => auth()->check() ? auth()->user()->unreadNotifications : null,
        ]);
    }

    private function getSeason(): string
    {
        return now()->isBetween('21.6.' . now()->year, '23.9.' . now()->year) ? 'summer' :
            (now()->isBetween('20.3' . now()->year, '21.6.' . now()->year) ? 'spring' :
                (now()->isBetween('23.9.' . now()->year, '21.12.' . now()->year) ? 'autumn' : 'winter'));
    }

    private function getCurrentLocaleDateFormatPattern(): string
    {
        $formats = [
            "cs" => "d.M.yyyy",
            "de" => "dd.MM.yyyy",
            "en" => "M/d/yyyy",
            "fr" => "dd/MM/yyyy",
            "hu" => "yyyy. MM. dd.",
            "it" => "dd/MM/yyyy",
            "sl" => "d.M.yyyy",
            "es" => "dd/MM/yyyy"
        ];
        return $formats[session('language') ?: app()->currentLocale()];
    }
}

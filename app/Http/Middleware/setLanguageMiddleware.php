<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class setLanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $lang = $request->segment(1); // Assuming language is the first segment of the URL

        if (in_array($lang, config('app.supported_locales'))) {
            app()->setLocale($lang);
            session(['language' => $lang, 'locale' => $lang]);
        } else {
            if (session()->has('locale')) {
                app()->setLocale(session()->get('locale'));
            }
        }

        return $next($request);
    }
}

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
        if (auth()->check()) {
            if ($request->user()->is_admin && $request->segment(1) === 'admin') {
                $language = $request->cookie('language') ?: app()->currentLocale();
                app()->setLocale($language);
                return $next($request);
            }
        }

        $lang = $request->segment(1); // Assuming language is the first segment of the URL

        if (in_array($lang, config('app.supported_locales'))) {
            app()->setLocale($lang);
            session(['language' => $lang, 'locale' => $lang]);
            /*  if($request->missing('lang')) {
                 $request->merge(['lang' => $lang]);
             } */
        }

        return $next($request);

    }
}

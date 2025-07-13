<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Generate a unique nonce for this request
        $nonce = base64_encode(str()->random(16));

        // Inject the nonce into the view
        view()->share('cspNonce', $nonce);

        $appUrl = parse_url(config('app.url'), PHP_URL_HOST);
        $protocol = parse_url(config('app.url'), PHP_URL_SCHEME) . '://';
        $appUrlPattern = "$protocol$appUrl";

        // Base CSP policy
        $csp = "default-src 'self'; img-src *; media-src 'self' $appUrlPattern *.$appUrl; frame-ancestors 'none'";

        // Include nonces for styles and scripts
        $styleSrc = "'self' 'unsafe-inline' https://fonts.bunny.net";
        $csp .= "; style-src $styleSrc 'nonce-{$nonce}'; style-src-elem $styleSrc 'nonce-{$nonce}'";
        $csp .= "; font-src 'self' https://fonts.bunny.net";

        if (app()->environment('local')) {
            $csp .= "; script-src 'self' 'unsafe-eval' 'nonce-{$nonce}' http://localhost:5173 http://[::1]:5173";
            $csp .= "; script-src-elem 'self' 'unsafe-eval' 'nonce-{$nonce}' http://localhost:5173 http://[::1]:5173";
        } else {
            $csp .= "; script-src 'self' 'nonce-{$nonce}'; script-src-elem 'self' 'nonce-{$nonce}'";
        }

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}

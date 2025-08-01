<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XssSanitizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $input = $request->all();

        array_walk_recursive($input, function (&$input) {
            $input = strip_tags($input, [
                '<strong>',
                '<p>',
                '<h2>',
                '<h3>',
                '<h4>',
                '<h5>',
                '<em>',
                '<a>',
                '<ul>',
                '<ol>',
                '<li>',
                '<u>',
            ]);
            $input = trim($input);
        });

        $request->merge($input);

        return $next($request);
    }
}

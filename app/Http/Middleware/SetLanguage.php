<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // First detect the user language.
        preg_match('/en|fr/u', $request->server('HTTP_ACCEPT_LANGUAGE'), $match);
        $match[0] ? \App::setLocale($match[0]) : \App::setLocale('en');
        // Continue using it.
        if ($request->lang) {
            \App::setLocale($request->lang);
        }

        return $next($request);
    }
}

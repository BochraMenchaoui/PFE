<?php

namespace App\Http\Middleware;

use App\Http\Traits\CacheUpdate;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactor
{
    use CacheUpdate;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check()) {
            if (!Auth::user()->password_security?->is_enabled == 1) {
                return $next($request);
            }
            $user = Auth::user();
            if ($user->password_security->two_factor_code) {
                if ($user->password_security->two_factor_expires_at?->lt(now())) {
                    // token expired
                    $user->resetTwoFactorCode();
                    $this->updateCache();
                    auth()->logout();

                    return redirect()->route('admin.login')->with('status', 'Your code has expired, please log in again.');
                }
                if (!$request->routeIs('code.*')) {
                    return redirect()->route('code.index');
                }
            }
            return $next($request);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TwoFactor
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
        $user = Auth::user();
        if (Auth::check() && $user->two_factor_code) {
            if ($user->two_factor_expires_at->lt(now())) {
                $user->resetTwoFactorCode();
                Auth::logout();
                return redirect()->route('login')->withMessage('Le code à deux facteurs a expiré.');
            }
            if (!$request->is('verify*')) {
                return redirect()->route('verify.index');
            }
        }
        return $next($request);
    }
}

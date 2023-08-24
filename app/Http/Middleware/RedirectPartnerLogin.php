<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectPartnerLogin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!$request->session()->has('partner_session_data')) {
            $request->session()->flush();
            $request->session()->regenerate(true);
            return redirect('/ngo');
        }
        return $next($request);
    }

}

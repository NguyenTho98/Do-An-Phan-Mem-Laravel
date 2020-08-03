<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerLoginMiddleware
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
        if (Auth::guard('user')->check()) {
            $user = Auth::guard('user')->user();
            if ($user->is_delete == false) {
                return $next($request);
            }
            return redirect('login')->withErrors(['', 'Email or password is wrong']);
        }
        return redirect('login');
    }
}

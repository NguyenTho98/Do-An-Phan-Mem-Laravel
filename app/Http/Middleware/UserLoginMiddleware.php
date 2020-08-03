<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class UserLoginMiddleware
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
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            if ($user->email_verified_at !== null && $user->is_delete == false) {
                return $next($request);
            }
            return redirect('admin/login')->withErrors(['', 'Your email not active.']);
        }
        return redirect('admin/login');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
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
                return redirect('admin')->with('error', 'Bạn cần phải đăng xuất trước!');
            }
            return $next($request);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!Auth::check()) {
            // Chuyển hướng đến trang đăng nhập
            return redirect()->route('admin.login');
        }

        // Nếu đã đăng nhập, cho phép tiếp tục truy cập
        return $next($request);
    }
}

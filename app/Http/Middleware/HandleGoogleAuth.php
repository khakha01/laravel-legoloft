<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleGoogleAuth
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (\Exception $e) {
            \Log::error('Google Auth Error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Có lỗi xảy ra khi xác thực với Google. Vui lòng thử lại sau.');
        }
    }
} 
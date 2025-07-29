<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class BuyNowSession
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('buyNow')) {
            Session::flash('errorBuyNow', true);
        }
        return $next($request);
    }
}

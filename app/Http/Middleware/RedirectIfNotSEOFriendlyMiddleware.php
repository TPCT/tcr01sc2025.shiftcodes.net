<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotSEOFriendlyMiddleware
{
    // [400, 410],[500, 510]
    protected $unfriendlyStatusRanges = [     ];

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (collect($this->unfriendlyStatusRanges)->map(function ($range) use ($response) {
            if ($response->getStatusCode() >= $range[0] && $response->getStatusCode() <= $range[1]) {
                return 1;
            }
            return 0;
        })->filter()->first()) {
            // return redirect()->route('home')->setStatusCode(308);
        }
        return $response;
    }
}
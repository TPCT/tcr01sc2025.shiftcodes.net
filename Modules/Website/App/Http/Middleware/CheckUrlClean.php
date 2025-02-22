<?php

namespace Modules\Website\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CheckUrlClean
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $currentUrl = url()->full();
        $rejectedEnds = ['#!', '_escaped_fragment_='];
        // dd($currentUrl);
        foreach ($rejectedEnds as $end) {
            if (Str::contains($currentUrl, $end)) {
                abort(404); // Return a 404 response
            }
        }
        return $next($request);
    }
}

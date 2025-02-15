<?php

namespace Modules\Website\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('customers')->check()) {
            return redirect("/?login=true");
        }
        return $next($request);
    }
}

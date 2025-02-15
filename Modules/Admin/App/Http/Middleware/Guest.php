<?php

namespace Modules\Admin\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Guest
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check()) {
            
            return redirect("/admin");
            
        }
        return $next($request);
    }
}

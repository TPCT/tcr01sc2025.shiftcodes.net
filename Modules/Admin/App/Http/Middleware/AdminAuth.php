<?php

namespace Modules\Admin\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->check()) {
            return redirect("/admin/login");
        }
        return $next($request);
    }
}

<?php

namespace Modules\Website\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Currency;

class Currencies
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        app('currencies')->setCurrency(\Cookie::get('currency_id'));
        return $next($request);
    }
}

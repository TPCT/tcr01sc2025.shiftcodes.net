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
        app('currencies')->setCurrency(\Cookie::get('currency_id') ? \Cookie::get('currency_id') : Currency::where('default', 1)->first()->id);
        return $next($request);
    }
}

<?php

namespace Modules\Website\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Country as Countries;

class Country
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        app('country')->setCountry(\Cookie::get('country_id') ? \Cookie::get('country_id') : Countries::where('default', 1)->first()->id);
        app('country')->setCity(\Cookie::get('city_id') ? \Cookie::get('city_id') : 0);
        return $next($request);
    }
}

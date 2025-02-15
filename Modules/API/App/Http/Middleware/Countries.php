<?php

namespace Modules\API\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Country;

class Countries
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // country id from headers

        $countryId = $request->header('X-Country-Id');
        $cityId    = $request->header('X-City-Id');
        app('country')->setCountry($countryId ? $countryId : Country::where('default', 1)->first()->id);
        app('country')->setCity($cityId ? $cityId : 0);
        return $next($request);
    }
}

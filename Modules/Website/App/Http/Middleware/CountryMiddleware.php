<?php

namespace Modules\Website\App\Http\Middleware;

use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class CountryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs('website.switch.*'))
            return $next($request);

        $segments = $request->segments();
        $country = $segments[1] ?? null;
        $city = $segments[2] ?? null;

        if (!$country || !Country::whereSlug($country)->exists()) {
            $country = Country::find(\Cookie::get('country_id')) ?? Country::whereDefault(true)->first();
            $city = $country->cities()->find(Cookie::get('city_id')) ?? $country->cities()->whereDefault(true)->first();
            $segments = array_merge([$segments[0], $country->slug, $city->slug], array_slice($segments, 1));
            $path = implode("/", $segments);
            Cookie::queue('country_id', $country->id, 60 * 60 * 24 * 30);
            Cookie::queue('city_id', $city->id, 60 * 60 * 24 * 30);
            return redirect($path);
        }

        if (!$city || !City::whereSlug($city)->exists()) {
            $country = Country::find(Cookie::get('country_id')) ?? Country::whereDefault(true)->first();
            $city = $country->cities()->find(Cookie::get('city_id')) ?? $country->cities()->whereDefault(true)->first();
            $segments = array_merge([$segments[0], $country->slug, $city->slug], array_slice($segments, 2));
            $path = implode("/", $segments);
            Cookie::queue('country_id', $country->id, 60 * 60 * 24 * 30);
            Cookie::queue('city_id', $city->id, 60 * 60 * 24 * 30);
            return redirect($path);
        }

        $country = Country::whereSlug($country)->first();
        $city = $country->cities()->whereSlug($city)->first();
        app('country')->setCountry($country->id);
        app('country')->setCity($city->id);
        return $next($request);
    }
}

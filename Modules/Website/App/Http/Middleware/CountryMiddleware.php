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

        $route = $request->route();

        $segments = $request->segments();
        $country = Country::whereSlug($segments[1] ?? null)->first();
        $city = City::whereSlug($segments[2] ?? null)->first();

        if (!$country) {
            $country = Country::whereDefault(true)->first();
            $city =  $country->cities()->whereDefault(true)->first();
            Cookie::queue('country_id', $country->id, 60 * 60 * 24 * 30);
            Cookie::queue('city_id', $city->id, 60 * 60 * 24 * 30);
            return redirect()->route($route->getName(), [
                'country' => $country,
                'city' => $city,
            ]);
        }

        if (!$city) {
            $city = $country->cities()->whereDefault(true)->first();
            Cookie::queue('country_id', $country->id, 60 * 60 * 24 * 30);
            Cookie::queue('city_id', $city->id, 60 * 60 * 24 * 30);
            return redirect()->route($route->getName(), [
                'country' => $country,
                'city' => $city,
            ]);
        }

        URL::defaults([
            'locale' => \LaravelLocalization::getCurrentLocale(),
            'country' => $country->slug,
            'city' => $city->slug,
        ]);
        app('country')->setCountry($country->id);
        app('country')->setCity($city->id);
        return $next($request);
    }
}

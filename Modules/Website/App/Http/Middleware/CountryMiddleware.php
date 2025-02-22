<?php

namespace Modules\Website\App\Http\Middleware;

use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use Closure;
use Illuminate\Http\Request;
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

        if (session()->has('set-country') || session()->has('set-city')) {
            $country = null;
            $city = null;
            $segments = array_merge([$segments[0]], array_slice($segments, 3));
        }

        if (!$country || !Country::whereSlug($country)->exists()) {
            $country = Country::find(session('set-country', session('country_id'))) ?? Country::whereDefault(true)->first();
            $city = $country->cities()->whereId(session('set-city', session('city_id')))->first() ?? $country->cities()->whereDefault(true)->first();
            $segments = array_merge([$segments[0], $country->slug, $city->slug], array_slice($segments, 1));
            $path = implode("/", $segments);
            session()->put('country_id', $country->id);
            session()->put('city_id', $city->id);
            app('country')->setCountry(session('country_id'));
            app('country')->setCity(session('city_id'));
            return redirect($path);
        }

        if (!$city || !City::whereSlug($city)->exists()) {
            $country = Country::whereSlug(session('set-country', $country))->first() ?? Country::find(session('country_id')) ?? Country::whereDefault(true)->first();
            $city = $country->cities()->whereId(session('set-city', session('city_id')))->first() ?? $country->cities()->whereDefault(true)->first();
            $segments = array_merge([$segments[0], $country->slug, $city->slug], array_slice($segments, 2));
            $path = implode("/", $segments);
            session()->put('country_id', $country->id);
            session()->put('city_id', $city->id);
            app('country')->setCountry(session('country_id'));
            app('country')->setCity(session('city_id'));
            return redirect($path);
        }

        $country = Country::whereSlug($country)->first();
        $city = $country->cities()->whereSlug($city)->first();
        session()->put('country_id', $country->id);
        session()->put('city_id', $city->id);
        app('country')->setCountry(session('country_id'));
        app('country')->setCity(session('city_id'));
        app('currencies')->setCurrency(session('currency_id', Currency::whereDefault(true)->first()->id));
        URL::defaults(['country' => $country->slug, 'city' => $city->slug]);
        return $next($request);
    }
}

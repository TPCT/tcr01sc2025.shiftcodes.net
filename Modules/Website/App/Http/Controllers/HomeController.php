<?php

namespace Modules\Website\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use \App\Models\Type;
use \App\Models\Section;
use \App\Models\Company;
use \App\Models\Banner;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class HomeController extends Controller
{
    public function reviews() {
        // render and pass data to view
        $gr = view('website::layouts.parts.gr',['src' => app('settings')->get('google_reviews_widget') ])->render();
        $fb = view('website::layouts.parts.fb',['src' => app('settings')->get('facebook_reviews_widget') ])->render();

        return response()->json([
            'gr' => $gr,
            'fb' => $fb
        ]);
    }
    public function index()
    {
        $types = Type::withCount('cars')
        ->orderBy('cars_count', 'desc')
        ->get();
        $sections = Section::with('cars.company')->orderBy('sort', 'asc')->get();
        $companies = Company::with("types")->where(function($query) {
            $query->where('type','default');
            $query->where('status',1);
            $query->where('country_id', session('country_id'));
            $query->whereHas('cities', function($qq) {
                $qq->where('city_id', session('city_id'));
            });
        })->limit(10)->inRandomOrder()->get();
        $banners   = Banner::orderBy('id', 'desc')->get();
        return view('website::index')->with([
            'types' => $types,
            'sections' => $sections,
            'companies' => $companies,
            'banners' => $banners
        ]);
    }

    public function switchLanguage($key) {
        return redirect()->back()->withCookie(cookie()->forever('locale', $key));
    }

    public function switchCountry(Country $country) {
        $city = $country->cities()->whereDefault(true)->first()->id ?? $country->cities()->first()->id;
        return redirect()->back()->withCookies([
            \Cookie::make('country_id', $country->id, 60 * 60 * 24 * 30),
            \Cookie::make('city_id', $city->id, 60 * 60 * 24 * 30),
        ]);
    }

    public function switchCity(?City $city) {
        return redirect()->back()->withCookies([
            \Cookie::make('country_id', $city->country->id, 60 * 60 * 24 * 30),
            \Cookie::make('city_id', $city->id, 60 * 60 * 24 * 30),
        ]);
    }

    public function switchCurrency(Currency $currency) {
        session()->put('currency_id', $currency->id);
        return redirect()->back()->withCookie(cookie('currency_id', $currency->id, 60 * 60 * 24 * 30));
    }

}

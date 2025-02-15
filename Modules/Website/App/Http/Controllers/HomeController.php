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
        // dd( \App\Models\Content::where('type','home')->first()->getTranslations('description')   );
        $types = Type::withCount('cars')
        ->orderBy('cars_count', 'desc')
        ->get();
        $sections = Section::with('cars.company')->orderBy('sort', 'asc')->get();
        $companies = Company::with("types")->where(function($query) {
            $query->where('type','default');
            $query->where('status',1);
            $query->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $query->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
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
        \Cookie::queue(\Cookie::make('locale', $key, 60*24*30));
        return redirect()->back();
    }

    public function switchCountry(?Country $country) {
        \Cookie::queue('country_id', $country?->id ?? 0, 60* 24 * 30);
        \Cookie::queue('city_id', 0, 60* 24 * 30);
        return redirect()->back();
    }

    public function switchCity(?City $city) {
        \Cookie::queue('city_id', $city?->id ?? 0, 60* 24 * 30);
        if($city) {
            \Cookie::queue('country_id', $city->country_id, 60* 24 * 30);
        }
        if(!$city) {
            return redirect()->to(LaravelLocalization::localizeUrl('/'));
        }
        return redirect()->back();
//        $carsController = new CarsController();
//        return $carsController->cities($city->id, $city->slug);
    }

    public function switchCurrency(?Currency $currency) {
        \Cookie::queue('currency_id', $currency?->id ?? null, 60* 24 * 30);
        return redirect()->back();
    }

}

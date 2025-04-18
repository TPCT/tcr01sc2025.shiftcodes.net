<?php

namespace Modules\Website\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Car;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Page;
use \App\Models\Type;
use \App\Models\Section;
use \App\Models\Company;
use \App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class HomeController extends Controller
{
    public function sitemap(){
        $urls = [];
        $urls[] = [
            'loc' => '/faq',
            'lastmod' => Carbon::today()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.9',
            'add_prefix' => false
        ];
        $urls[] = [
            'loc' => '/contact_us',
            'lastmod' => Carbon::today()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.9',
            'add_prefix' => false
        ];
        $urls[] = [
            'loc' => '/list-your-car',
            'lastmod' => Carbon::today()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.9',
            'add_prefix' => false
        ];
        $urls[] = [
            'loc' => '/signup',
            'lastmod' => Carbon::today()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.9',
            'add_prefix' => false
        ];
        $urls[] = [
            'loc' => '/login',
            'lastmod' => Carbon::today()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.9',
            'add_prefix' => false
        ];
        $urls[] = [
            'loc' => '/iframes',
            'lastmod' => Carbon::today()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.9',
            'add_prefix' => false
        ];

        foreach (Type::all() as $type) {
            $urls[] = [
                'loc' => '/types/' . $type->slug,
                'lastmod' => $type->updated_at->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.9',
                'add_prefix' => true
            ];
        }

        foreach (Brand::all() as $brand) {
            $urls[] = [
                'loc' => '/brands/' . $brand->slug,
                'lastmod' => $brand->updated_at->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.9',
                'add_prefix' => true
            ];
        }

        foreach (Car::where(function ($query){
            $query->where('type', 'driver');
            $query->orWhere('type', 'driver');
        }) as $car) {
            $urls[] = [
                'loc' => '/cars/' . $car->slug,
                'lastmod' => $car->updated_at->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.9',
                'add_prefix' => true
            ];
        }

        foreach (Car::where(function ($query){
            $query->where('type', 'yacht');
        }) as $yacht) {
            $urls[] = [
                'loc' => '/yachts/' . $yacht->slug,
                'lastmod' => $yacht->updated_at->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.9',
                'add_prefix' => true
            ];
        }


        foreach (Blog::all() as $blog){
            $urls[] = [
                'loc' => '/blogs/' . $blog->slug,
                'lastmod' => $blog->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.9',
                'add_prefix' => true
            ];
        }

        foreach (Page::all() as $page){
            $urls[] = [
                'loc' => '/' . $page->slug,
                'lastmod' => $page->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.9',
                'add_prefix' => true
            ];
        }

        $xml = $this->generateSitemap($urls);

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }

    private function generateSitemap($urls)
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset/>');
        $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($urls as $url) {
            foreach (LaravelLocalization::getSupportedLocales() as $locale => $data) {
                if ($url['add_prefix']){
                    foreach (Country::all() as $country) {
                        foreach ($country->cities as $city) {
                            $urlTag = $xml->addChild('url');
                            $urlTag->addChild('loc', htmlspecialchars(\URL::to('/' . $locale . '/' . $country->slug . '/' . $city->slug . $url['loc'])));
                            $urlTag->addChild('lastmod', $url['lastmod']);
                            $urlTag->addChild('changefreq', $url['changefreq']);
                            $urlTag->addChild('priority', $url['priority']);
                        }
                    }
                }else{
                    $urlTag = $xml->addChild('url');
                    $urlTag->addChild('loc', htmlspecialchars(\URL::to('/' . $locale . $url['loc'])));
                    $urlTag->addChild('lastmod', $url['lastmod']);
                    $urlTag->addChild('changefreq', $url['changefreq']);
                    $urlTag->addChild('priority', $url['priority']);
                }
            }
        }
        header('Content-Type: application/xml');
        return $xml->asXML();
    }

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
        $previousUrl = url()->previous();
        $previousRequest = request()->create($previousUrl);
        $previousRoute = \Illuminate\Support\Facades\Route::getRoutes()->match($previousRequest);
        $previousRoute->setParameter('country', $country);
        $previousRoute->setParameter('city', $city);

        return redirect()->route($previousRoute->getName(), $previousRoute->parameters)->withCookies([
            \Cookie::make('country_id', $country->id, 60 * 24 * 30),
            \Cookie::make('city_id', $city->id, 60 * 24 * 30),
        ]);
    }

    public function switchCity(?City $city) {
        $previousUrl = url()->previous();
        $previousRequest = request()->create($previousUrl);
        $previousRoute = \Illuminate\Support\Facades\Route::getRoutes()->match($previousRequest);

        $previousRoute->setParameter('country', $city->country);
        $previousRoute->setParameter('city', $city);

        return redirect()->route($previousRoute->getName(), $previousRoute->parameters)->withCookies([
            \Cookie::make('country_id', $city->country->id, 60 * 24 * 30),
            \Cookie::make('city_id', $city->id, 60 * 24 * 30),
        ]);
    }

    public function switchCurrency(Currency $currency) {
        session()->put('currency_id', $currency->id);
        return redirect()->back()->withCookie(\Cookie::make('currency_id', $currency->id, 60 * 60 * 24 * 30));
    }

}

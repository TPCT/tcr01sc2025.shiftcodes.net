<?php

namespace Modules\API\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function types()
    {
        $types = \App\Models\Type::select("id","title","image")->get();
        return response()->json($types);
    }

    public function brands()
    {
        $brands = \App\Models\Brand::select("id","title","image")->get();
        return response()->json($brands);
    }

    public function sections()
    {
        $sections = \App\Models\Section::with("cars")->orderBy('sort', 'asc')->get();
        return response()->json($sections);
    }

    public function companies()
    {
        $companies = \App\Models\Company::select("id","name","image")
        ->with(['types' => function($query) {
            $query->select('types.id', 'types.title', 'types.image');
        }])
        ->where(function($query) {
            $query->where('type','default');
            $query->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $query->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        })
        ->inRandomOrder()->get();
        return response()->json($companies);
    }

    public function banners()
    {
        $banners = \App\Models\Banner::get();
        return response()->json($banners);
    }

    public function faq()
    {
        $faq = \App\Models\Faq::where('type','home')->get();
        return response()->json($faq);
    }

    public function allFaq()
    {
        $faq = \App\Models\Faq::get();
        return response()->json($faq);
    }

    public function homeContent() {
        $content = \App\Models\Content::where('type','home')->first();
        return response()->json($content);
    }


}

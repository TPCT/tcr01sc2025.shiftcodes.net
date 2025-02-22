<?php

namespace Modules\Website\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogsController extends Controller
{
    public function index(){
        $suggested_cars = \App\Models\Car::whereIn("id", \App\Models\BlogCar::pluck("car_id")->toArray())
            ->whereHas('company', function($q) {
                $q->where('status',1);
                $q->where('country_id', app('country')->getCountry()->id);
                if(app('country')->getCity()) {
                    $q->whereHas('cities', function($qq) {
                        $qq->where('city_id', app('country')->getCity()->id);
                    });
                }
            })->get();
        $blogs = \App\Models\Blog::orderBy("id","desc")->paginate(12);
        $breadcrumbs = [
            __('lang.Blogs') => null,
        ];
        return view('website::blogs.index',[
            'suggested_cars' => $suggested_cars,
            'blogs' => $blogs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function show($country, $city, Blog $blog){
        $breadcrumbs = [
            __('lang.Blogs') => route('website.blogs.index'),
            $blog->title => null,
        ];
        return view('website::blogs.show',[
            'blog' => $blog,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}

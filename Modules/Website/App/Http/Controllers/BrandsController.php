<?php

namespace Modules\Website\App\Http\Controllers;

use App\Helpers\HasSuggestedCars;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Models;

class BrandsController extends Controller
{
    use HasSuggestedCars;

    public function index(){
        $brands = Brand::all();
        $seo      = \App\Models\SEO::where('type','brand')->where('resource_id',$resource->id)->first();
        $content  = \App\Models\Content::where('type','brand')->where('resource_id', $resource->id)->first();
        $faq      = \App\Models\Faq::where('type','brand')->where('resource_id', $resource->id)->get();
        $resource_title  = __('lang.Car Brands');
        $models   = $resource->models()->limit(10)->get();
        $breadcrumbs = [
            __('lang.Car Brands') => route('website.cars.brands.index'),
            $brand->title => null,
        ];
        $suggested_cars = $this->getSuggestedCars(__('lang.Brands'), $resource->id);
        return view('website::cars.index')->with([
            'cars'         => $cars,
            'resource'     => $resource,
            'resource_type' => 'brand',
            'resource_sub_type' => 'models',
            'resource_title' => $resource_title,
            'resource_model' => null,
            'models'       => $models,
            'selected_types' => $selected_types,
            'suggested_cars' => $suggested_cars,
            'seo'          => $seo,
            'content'      => $content,
            'faq'          => $faq,
            'canonical'   =>  $brand->slug,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function show($country, $city, Brand $brand){
        $query = $brand->cars()->hasCompany()->where(function ($query){
            $query->where('type', 'default');
        });
        $resource = $brand;
        $selected_types = [];
        $seo      = \App\Models\SEO::where('type','brand')->where('resource_id',$resource->id)->first();
        $content  = \App\Models\Content::where('type','brand')->where('resource_id', $resource->id)->first();
        $faq      = \App\Models\Faq::where('type','brand')->where('resource_id', $resource->id)->get();
        $resource_title  = __('lang.Car Brands');
        $models   = $resource->models()->limit(10)->get();
        $breadcrumbs = [
            __('lang.Car Brands') => route('website.cars.brands.index'),
            $brand->title => null,
        ];
        $suggested_cars = $this->getSuggestedCars(__('lang.Brands'), $resource->id);

        return view('website::cars.index')->with([
            'query'         => $query,
            'resource'     => $resource,
            'resource_type' => 'brand',
            'resource_sub_type' => 'models',
            'resource_title' => $resource_title,
            'resource_model' => null,
            'models'       => $models,
            'selected_types' => $selected_types,
            'suggested_cars' => $suggested_cars,
            'seo'          => $seo,
            'content'      => $content,
            'faq'          => $faq,
            'canonical'   =>  $brand->slug,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function model($country, $city, Brand $brand, Models $model){
        $query = $brand->models()->findOrFail($model->id)->cars()->where(function ($query){
            $query->where('type', 'default');
        });
        $resource = $brand;
        $selected_types = [];
        $seo      = \App\Models\SEO::where('type','brand')->where('resource_id',$resource->id)->first();
        $content  = \App\Models\Content::where('type','brand')->where('resource_id', $resource->id)->first();
        $faq      = \App\Models\Faq::where('type','brand')->where('resource_id', $resource->id)->get();
        $resource_title  = __('lang.Car Brands');
        $models   = $resource->models()->limit(10)->get();
        $breadcrumbs = [
            __('lang.Car Brands') => route('website.cars.brands.index'),
            $brand->title => route('website.cars.brands.show', ['brand' => $brand]),
            $model->title => null,
        ];

        $suggested_cars = $this->getSuggestedCars(__('lang.Brands'), $resource->id);
        return view('website::cars.index')->with([
            'query'         => $query,
            'resource'     => $resource,
            'resource_type' => 'brand',
            'resource_title' => $resource_title,
            'resource_model' => $model,
            'models'       => $models,
            'selected_types' => $selected_types,
            'suggested_cars' => $suggested_cars,
            'seo'          => $seo,
            'content'      => $content,
            'faq'          => $faq,
            'canonical'   =>  $brand->slug,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}

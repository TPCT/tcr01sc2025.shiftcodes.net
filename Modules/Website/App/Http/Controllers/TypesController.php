<?php

namespace Modules\Website\App\Http\Controllers;

use App\Helpers\HasSuggestedCars;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Type;

class TypesController extends Controller
{
    use HasSuggestedCars;

    public function index(){

    }
    public function show($country, $city, Type $type){
        $cars = $type->cars()->hasCompany()->paginate(10);
        $resource = $type;
        $selected_types = [$resource->id];
        $seo      = \App\Models\SEO::where('type','type')->where('resource_id',$resource->id)->first();
        $content  = \App\Models\Content::where('type','type')->where('resource_id', $resource->id)->first();
        $faq      = \App\Models\Faq::where('type','type')->where('resource_id', $resource->id)->get();
        $resource_title  = __('lang.Categories');
        $models = [];

        $suggested_cars = $this->getSuggestedCars(__('lang.Categories'), $resource->id);
        return view('website::cars.index')->with([
            'cars'         => $cars,
            'resource'     => $resource,
            'resource_title' => $resource_title,
            'models'       => $models,
            'selected_types' => $selected_types,
            'suggested_cars' => $suggested_cars,
            'seo'          => $seo,
            'content'      => $content,
            'faq'          => $faq,
            'canonical'   =>  $type->slug
        ]);
    }
}

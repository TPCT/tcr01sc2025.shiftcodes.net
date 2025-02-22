<?php

namespace App\Helpers;

use App\Models\Car;

trait HasSuggestedCars
{
    public function getSuggestedCars($type, $resource_id) {
        $cars = Car::with(['images','brand','model','color','types','company','year']);
        if($type == "types") {
            $cars = $cars->whereHas('types', function($q) use ($resource_id) {
                $q->where('type_id',$resource_id);
            });
        } else if($type == "brands") {
            $cars = $cars->where('brand_id', $resource_id);
        }
        $cars = $cars->whereHas('company', function($q) {
            $q->where('status',1);
            $q->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $q->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        });
        return $cars->where('type','default')->limit(10)->get();
    }
}
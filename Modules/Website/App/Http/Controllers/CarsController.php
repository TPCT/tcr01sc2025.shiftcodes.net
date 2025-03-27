<?php

namespace Modules\Website\App\Http\Controllers;

use App\Helpers\HasSuggestedCars;
use App\Helpers\Utilities;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use \App\Models\Car;
use \App\Models\Company;
use App\Models\Type;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CarsController extends Controller
{
    use HasSuggestedCars;
    public function show($country, $city, Car $car)
    {
        $suggested_cars = Car::hasCompany()->with(['images','brand','model','color','types','company','year'])
        ->where(function($query) use ($car) {
            if($car->brand_id) {
                $query->where('brand_id',$car->brand_id);
            }

            $query->where('type',$car->type);
            $query->where('id','!=',$car->id);
        })
        ->limit(10)->get();

        $car->company->views()->create([
            'car_id' => $car->id,
            'user_id' => \Auth::user()?->id ?? null
        ]);

        if($car->model) {
            $description = \App\Models\Content::where('type','model')->where('resource_id', $car->model->id)->first();
        } else {
            $description = null;
        }
        return view('website::cars.show')->with([
            'car' => $car,
            'suggested_cars' => $suggested_cars,
            'description' => $description
        ]);
    }

    public function filter($country, $city){
        $query = Car::hasCompany()->with(['images','brand','model','color','types','company','year'])
            ->when(request('order_by'), function ($query, $order) {
                $query->orderBy('price_per_day', $order == "price_low" ? "asc" : "desc");
            })
            ->when(request('types'), function ($query, $types) {
                $query->whereHas('types', function ($query) use ($types) {
                    $query->whereIn('slug', $types);
                });
            })
            ->when(request('brand'), function ($query, $brand) {
                $query->whereHas('brand', function ($query) use ($brand) {
                    $query->where('slug', $brand);
                });
            })
            ->when(request('model'), function ($query, $model) {
                $query->whereHas('model', function ($query) use ($model) {
                    $query->where('slug', $model);
                });
            })
            ->when(request('year'), function ($query, $year) {
                $query->whereHas('year', function ($query) use ($year) {
                    $query->where('title', $year);
                });
            })
            ->when(request('color'), function ($query, $color) {
                $query->whereHas('color', function ($query) use ($color) {
                    $query->where('slug', $color);
                });
            })
            ->where('type', 'default');


//        $cars = (clone $query)->when(request('min_price'), function ($query, $min_price) {
//            $query->where('price_per_day', '>=' , app('currencies')->getAedAmount($min_price));
//        })
//        ->when(request('max_price'), function ($query, $max_price) {
//            $query->where('price_per_day', '<=' , app('currencies')->getAedAmount($max_price));
//        })
//        ->paginate(10);
//
        return view('website::cars.search')->with([
            'query'         => $query,
            'models'       => [],
            'selected_types' => request('types', []),
        ]);
    }

    public function with_driver(){
        $cars = Car::hasCompany()->where('type', 'driver')->paginate(10);
        return view('website::cars.cars_with_driver', ['cars' => $cars]);
    }
}

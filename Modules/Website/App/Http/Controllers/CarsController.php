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
        $cars = Utilities::getCarsFilterQuery(true)->paginate(10);
        return view('website::cars.search')->with([
            'cars'         => $cars,
            'models'       => [],
        ]);
    }

    public function with_driver(){
        $cars = Car::hasCompany()->where('type', 'driver')->paginate(10);
        return view('website::cars.cars_with_driver', ['cars' => $cars]);
    }
}

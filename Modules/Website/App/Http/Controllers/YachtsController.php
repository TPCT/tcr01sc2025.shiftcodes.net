<?php

namespace Modules\Website\App\Http\Controllers;

use App\Helpers\HasSuggestedCars;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use \App\Models\Car;
use \App\Models\Company;
use App\Models\Type;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class YachtsController extends Controller
{
    use HasSuggestedCars;
    public function index(){
        $yachts = Car::hasCompany()->where('type', 'yacht')->paginate(10);
        return view("website::yachts.index", ['yachts' => $yachts]);
    }
    public function show($country, $city, Car $yacht)
    {
        if($yacht->model) {
            $description = \App\Models\Content::where('type','model')->where('resource_id', $yacht->model->id)->first();
        } else {
            $description = null;
        }
        return view('website::yachts.show')->with([
            'yacht' => $yacht,
            'suggested_cars' => [],
            'description' => $description
        ]);
    }
}

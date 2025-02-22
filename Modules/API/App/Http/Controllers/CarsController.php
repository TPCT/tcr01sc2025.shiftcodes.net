<?php

namespace Modules\API\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Car;
use App\Models\Company;

class CarsController extends Controller
{

    public function contact($id) {
        $car = Car::findOrFail($id);
        $type = request()->get('type');

        $msg = "Hello, I am interested in your car " . url('/')  .$car->sync_id .'/'. $car->slug;
        if($type == 'whatsapp') {
            $url = "https://wa.me/".$car->company->phone_02 . "?text=" . urlencode($msg);
        } else if($type == 'email') {
            $url = "mailto:".$car->company->email;
        } else if($type == 'phone') {
            $url = "tel:".$car->company->phone_01;
        }
        $car->company->actions()->create([
            'type' => $type,
            'car_id' => $car->id,
            'user_id' => null
        ]);
        return response()->json([
            'url' => $url,
            "msg" => $msg
        ]);
    }

    public function carsByType($id)
    {
        $cars = Car::with(['images','brand','model','color','types','company','year']);
 
        $selected_types  = [$id];

        $content  = \App\Models\Content::where('type','type')->where('resource_id', $id)->first();
        $faq      = \App\Models\Faq::where('type','type')->where('resource_id', $id)->get();

     
        $selected_types = array_unique($selected_types);
        $cars = $cars->whereHas('types', function($q) use ($selected_types) {
            if(count($selected_types) > 0) {
                $q->whereIn('type_id',$selected_types);
            }
        });
        
        $cars = $cars->whereHas('company', function($q) {
            $q->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $q->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        });

        $cars = $cars->where(function($query) {
            if(request()->get('search')) {
                $query->where('name', 'like', '%' . request()->get('search') . '%');
            }
            if(request()->get('brand_id')) {
                $query->where('brand_id',request()->get('brand_id'));
            }
            if(request()->get('model_id')) {
                $query->where('model_id',request()->get('model_id'));
            }
            if(request()->get('year_id')) {
                $query->where('year_id',request()->get('year_id'));
            }
            if(request()->get('color_id')) {
                $query->where('color_id',request()->get('color_id'));
            }
            if(request()->get('min_price')) {
                $query->where('price_per_day','>=',request()->get('min_price'));
            }
            if(request()->get('max_price')) {
                $query->where('price_per_day','<=',request()->get('max_price'));
            }
            if(request()->get('company_id')) {
                $query->where('company_id',request()->get('company_id'));
            }
            $query->where('type','default');
        })->orderBy('is_refresh','desc');

        if(request()->get('order_by') == 'price_low') {
            $cars = $cars->orderBy('price_per_day','asc');
        } else if(request()->get('order_by') == 'price_high') {
            $cars = $cars->orderBy('price_per_day','desc');
        }


        $cars = $cars->paginate(10);

        $suggested_cars = $this->getSuggestedCars('types', $id);

        return response()->json([
            'cars' => $cars,
            'suggested_cars' => $suggested_cars,
            'content' => $content,
            'faq' => $faq
        ]);

    }

    public function carsByBrand($id)
    {

        $cars     = Car::with(['images','brand','model','color','types','company','year']);
        $cars     = $cars->where('brand_id',$id);
        
        $content  = \App\Models\Content::where('type','brand')->where('resource_id', $id)->first();
        $faq      = \App\Models\Faq::where('type','brand')->where('resource_id', $id)->get();
            
        
        $selected_types = [];
        if(request()->get('type_id')) {
            $selected_types[] = request()->get('type_id');
        }
        $selected_types = array_unique($selected_types);

        $cars = $cars->whereHas('types', function($q) use ($selected_types) {
            if(count($selected_types) > 0) {
                $q->whereIn('type_id',$selected_types);
            }
        });

        $cars = $cars->whereHas('company', function($q) {
            $q->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $q->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        });

        $cars = $cars->where(function($query) {
            if(request()->get('search')) {
                $query->where('name', 'like', '%' . request()->get('search') . '%');
            }
            if(request()->get('brand_id')) {
                $query->where('brand_id',request()->get('brand_id'));
            }
            if(request()->get('model_id')) {
                $query->where('model_id',request()->get('model_id'));
            }
            if(request()->get('year_id')) {
                $query->where('year_id',request()->get('year_id'));
            }
            if(request()->get('color_id')) {
                $query->where('color_id',request()->get('color_id'));
            }
            if(request()->get('min_price')) {
                $query->where('price_per_day','>=',request()->get('min_price'));
            }
            if(request()->get('max_price')) {
                $query->where('price_per_day','<=',request()->get('max_price'));
            }
            if(request()->get('company_id')) {
                $query->where('company_id',request()->get('company_id'));
            }
            $query->where('type','default');
        })->orderBy('is_refresh','desc');

        if(request()->get('order_by') == 'price_low') {
            $cars = $cars->orderBy('price_per_day','asc');
        } else if(request()->get('order_by') == 'price_high') {
            $cars = $cars->orderBy('price_per_day','desc');
        }


        $cars = $cars->paginate(10);

        $suggested_cars = $this->getSuggestedCars("brands", $id);

        return response()->json([
            'cars' => $cars,
            'suggested_cars' => $suggested_cars,
            'content' => $content,
            'faq' => $faq
        ]);
    }


    public function search() {
        $cars = Car::with(['images','brand','model','color','types','company','year']);
        $selected_types  = [];
        if(request()->get('type_id')) {
            $selected_types[] = request()->get('type_id'); 
        }
        $selected_types = array_unique($selected_types);
        $cars = $cars->whereHas('types', function($q) use ($selected_types) {
            if(count($selected_types) > 0) {
                $q->whereIn('type_id',$selected_types);
            }
        });

        $cars = $cars->whereHas('company', function($q) {
            $q->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $q->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        });

        $cars = $cars->where(function($query) {
            if(request()->get('search')) {
                $query->where('name', 'like', '%' . request()->get('search') . '%');
            }
            if(request()->get('brand_id')) {
                $query->where('brand_id',request()->get('brand_id'));
            }
            if(request()->get('model_id')) {
                $query->where('model_id',request()->get('model_id'));
            }
            if(request()->get('year_id')) {
                $query->where('year_id',request()->get('year_id'));
            }
            if(request()->get('color_id')) {
                $query->where('color_id',request()->get('color_id'));
            }
            if(request()->get('min_price')) {
                $query->where('price_per_day','>=',request()->get('min_price'));
            }
            if(request()->get('max_price')) {
                $query->where('price_per_day','<=',request()->get('max_price'));
            }
            if(request()->get('company_id')) {
                $query->where('company_id',request()->get('company_id'));
            }
            $query->where('type','default');
        })->orderBy('is_refresh','desc');

        if(request()->get('order_by') == 'price_low') {
            $cars = $cars->orderBy('price_per_day','asc');
        } else if(request()->get('order_by') == 'price_high') {
            $cars = $cars->orderBy('price_per_day','desc');
        }


        $cars = $cars->paginate(10);


        return response()->json([
            'cars' => $cars,
        ]);

    }

    public function carsWithDriver() {
        $cars = Car::with(['images','brand','model','color','types','company','year'])->where('type','driver')
        ->whereHas('company', function($q) {
            $q->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $q->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        })
        ->paginate(10);
        return response()->json([
            'cars' => $cars,
        ]);
    }

    public function yachts() {
        $cars = Car::with(['images','brand','model','color','types','company','year'])->where('type','yacht')
        ->whereHas('company', function($q) {
            $q->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $q->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        })
        ->paginate(10);
        return response()->json([
            'yachts' => $cars,
        ]);
    }


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
            $q->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $q->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        });
        $cars = $cars->where('type','default')->limit(10)->get();
        return $cars;
    }

    public function show($id)
    {
        $car = Car::with(['images','brand','model','color','types','company','year'])->findOrfail($id);

        $suggested_cars = Car::with(['images','brand','model','color','types','company','year'])
        ->where(function($query) use ($car,$id) {
            if($car->brand_id) {
                $query->where('brand_id',$car->brand_id);
            } 
            $query->where('type',$car->type);
            $query->where('id','!=',$id);
        })->limit(10)->get();

        $car->company->views()->create([
            'car_id' => $car->id,
            'user_id' => null
        ]);

        if($car->model) {
            $description = \App\Models\Content::where('type','model')->where('resource_id', $car->model->id)->first();
        } else {
            $description = null;
        }

        $content = \App\Models\Content::where('type','car')->where('resource_id', $car->id)->first();
        $faq     = \App\Models\Faq::where('type','car')->where('resource_id', $car->id)->get();

        return response()->json([
            'car' => $car,
            'suggested_cars' => $suggested_cars,
            'description' => $description,
            'content' => $content,
            'faq' => $faq
        ]);
    }

    public function showCompany($id) {
        $company = Company::findOrFail($id);
        $cars = Car::with(['images','brand','model','color','types','company','year'])->where('company_id',$id)->paginate(10);
        
        $content = \App\Models\Content::where('type','company')->where('resource_id', $company->id)->first();
        $faq     = \App\Models\Faq::where('type','company')->where('resource_id', $company->id)->get();
        return response()->json([
            'company' => $company,
            'cars' => $cars,
            "content" => $content,
            "faq" => $faq
        ]);
    }

    public function section($id) {
        $section = \App\Models\Section::findOrFail($id);
        $cars = $section->cars()->with(['images','brand','model','color','types','company','year'])
        ->whereHas('company', function($q) {
            $q->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $q->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        })
        ->paginate(10);

        $content = \App\Models\Content::where('type','section')->where('resource_id', $section->id)->first();
        $faq     = \App\Models\Faq::where('type','section')->where('resource_id', $section->id)->get();

        return response()->json([
            'cars' => $cars,
            'section' => $section,
            'content' => $content,
            'faq' => $faq
        ]);

    }

    public function getModels($id) {
        $models = \App\Models\Models::where('brand_id',$id)->get();
        return response()->json($models);
    }

    public function getColors() {
        $colors = \App\Models\Color::get();
        return response()->json($colors);
    }

    public function getYears() {
        $years = \App\Models\Year::get();
        return response()->json($years);
    }

    public function toggleWishlist($id) {
        $car_id = $id;
        $user = auth()->user();
        if($user->wishlist->contains($car_id)) {
            $user->wishlist()->detach($car_id);
            return response()->json([
                "status" => "success",
                "action" => "remove",
            ]);
        } else {
            $user->wishlist()->attach($car_id);
            return response()->json([
                "status" => "success",
                "action" => 'add'
            ]);
        }
    }

    public function wishlist() {
        $user = auth()->user();
        $wishlist = $user->wishlist()->get();
        return response()->json([
            "cars" => $wishlist
        ]);
    }
}

<?php

namespace Modules\Website\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use \App\Models\Car;
use \App\Models\Company;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CarsController extends Controller
{

    public function indexModel($id, $slug, $slug_model)
    {

        $cars = Car::with(['images','brand.models','model','color','types','company','year']);

        $resource_type   = request()->route()->getName();
        $resource        = null;
        $resource_title  = $resource_type == "types" ? __('lang.Categories') : __('lang.Car Brands');
        $models          = [];
        $selected_types  = [];

        $resource = \App\Models\Brand::with("models")
            ->where('id', $id)
            ->first();

        if(!$resource) {
            return redirect()->to(LaravelLocalization::localizeUrl('/'));
        }

        $cars = $cars->where('brand_id', $resource->id);


// Execute the query and get the results
        $filteredCars = $cars->pluck('id')->toArray();
        dd($filteredCars);
        request()->merge(['brand_id' => $resource->id]);

//        $models = $resource->models()->where('slug', $slug_model)->limit(10)->get();

        $models   = $resource->models()->with('brand')->limit(10)->get();
        $seo      = \App\Models\SEO::where('type','brand')->where('resource_id',$resource->id)->first();
        $content  = \App\Models\Content::where('type','brand')->where('resource_id', $resource->id)->first();
        $faq      = \App\Models\Faq::where('type','brand')->where('resource_id', $resource->id)->get();

        if ($resource->slug != $slug) {
            return redirect()->route('brands', [$id, $resource->slug]);
        }


        if(request()->get('order_by') == 'price_low') {
            $cars = $cars->orderBy('price_per_day','asc');
        } else if(request()->get('order_by') == 'price_high') {
            $cars = $cars->orderBy('price_per_day','desc');
        }

        $cars = $cars->paginate(10);

        $suggested_cars = $this->getSuggestedCars($resource_type, $resource->id);

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
            'canonical'   =>  $resource instanceof Brand &&  $resource->slug != $slug
        ]);

    }

    public function index($id, $slug)
    {
        $cars = Car::with(['images','brand','model','color','types','company','year']);
        $resource_type   = request()->route()->getName();
        $resource        = null;
        $resource_title  = $resource_type == "types" ? __('lang.Categories') : __('lang.Car Brands');
        $models          = [];
        $selected_types  = [];
        if($resource_type == 'types') {
            $resource = \App\Models\Type::where("sync_id", $id)->first();
            if(!$resource) {
                return redirect()->to(LaravelLocalization::localizeUrl('/'));
            }

            if ($resource->slug != $slug) {
                return redirect()->route('types', [$id, $resource->slug]);
            }

            $selected_types = [$resource->id];
            $seo      = \App\Models\SEO::where('type','type')->where('resource_id',$resource->id)->first();
            $content  = \App\Models\Content::where('type','type')->where('resource_id', $resource->id)->first();
            $faq      = \App\Models\Faq::where('type','type')->where('resource_id', $resource->id)->get();

        } else if($resource_type == 'brands') {
            $resource = \App\Models\Brand::with("models")->where('sync_id', $id)->first();

            if(!$resource) {
                return redirect()->to(LaravelLocalization::localizeUrl('/'));
            }
            $cars = $cars->where('brand_id',$resource->id);
            request()->merge(['brand_id' => $resource->id]);

            $models   = $resource->models()->limit(10)->get();
            $seo      = \App\Models\SEO::where('type','brand')->where('resource_id',$resource->id)->first();
            $content  = \App\Models\Content::where('type','brand')->where('resource_id', $resource->id)->first();
            $faq      = \App\Models\Faq::where('type','brand')->where('resource_id', $resource->id)->get();

            if ($resource->slug != $slug) {
                return redirect()->route('brands', [$id, $resource->slug]);
            }
        }

        if(request()->get('type_id')) {
            array_push($selected_types, ...request()->get('type_id'));
        }
        $selected_types = array_unique($selected_types);
        $cars = $cars->whereHas('types', function($q) use ($selected_types) {
            if(count($selected_types) > 0) {
                $q->whereIn('type_id',$selected_types);
            }
        });
        $cars = $cars->whereHas('company', function($q) {
            $q->where('status',1);
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
        })->orderBy('refreshed_at','desc');

        if(request()->get('order_by') == 'price_low') {
            $cars = $cars->orderBy('price_per_day','asc');
        } else if(request()->get('order_by') == 'price_high') {
            $cars = $cars->orderBy('price_per_day','desc');
        }

        $cars = $cars->paginate(10);

        $suggested_cars = $this->getSuggestedCars($resource_type, $resource->id);

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
            'canonical'   =>  $resource instanceof Brand &&  $resource->slug != $slug
        ]);
    }

    public function getSearch() {
        $search = request()->get('search');
        $keywords_cars = Car::select('name')->where('name','like','%'.$search.'%')
        ->whereHas('company', function($q) {
            $q->where('status',1);
            $q->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $q->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        })->pluck('name')->toArray();

        $companies = Company::where('name','like','%'.$search.'%')
        ->whereHas('country', function($q) {
            $q->where('id', app('country')->getCountry()->id);
        })
        ->where('status',1)
        ->limit(5)
        ->get();

        $brands = \App\Models\Brand::where('title','like','%'.$search.'%')->limit(5)->get();

        $results = [];
        // unique
        $keywords_cars = array_unique($keywords_cars);
        // get first 10 of array
        $keywords_cars = array_slice($keywords_cars, 0, 5);
        foreach($keywords_cars as $keyword) {
            $results[] = [
                "keyword" => $keyword,
                "url" => "/search?search=" . $keyword,
            ];
        }
        foreach($companies as $company) {
            $results[] = [
                "keyword" => $company->name,
                "url" => url('/') . '/c/' . $company->id . '/' . $company->slug(),
            ];
        }
        foreach($brands as $brand) {
            $results[] = [
                "keyword" => $brand->title,
                "url" => url('/') . '/b/' . $brand->sync_id . '/' . $brand->slug(),
            ];
        }
        return response()->json($results);
    }

    public function show($id, $slug)
    {
        $car = Car::with(['images','brand','model','color','types','company','year'])->find($id);
        if (!$car) {
            return redirect()->to(LaravelLocalization::localizeUrl('/'));
        }

        if($car->slug() != $slug) {
            return redirect()->route('website.show-car', ['id' => $id, 'slug' => $car->slug()]);
        }

        $suggested_cars = Car::with(['images','brand','model','color','types','company','year'])
        ->where(function($query) use ($car,$id) {
            if($car->brand_id) {
                $query->where('brand_id',$car->brand_id);
            }

            $query->where('type',$car->type);
            $query->where('id','!=',$id);
        })
        ->whereHas('company', function($q) {
            $q->where('status',1);
            $q->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $q->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        })
        ->limit(10)->get();

        $car->company->views()->create([
            'car_id' => $car->id,
            'user_id' => null
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

    public function getModels() {
        $models = \App\Models\Models::where('brand_id',request()->get('brand_id'))->get();
        return response()->json($models);
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
            $q->where('status',1);
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

    public function carsWithDriver() {
        $cars = Car::with(['images','brand','model','color','types','company','year'])->where('type','driver')
        ->whereHas('company', function($q) {
            $q->where('status',1);
            $q->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $q->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        })
        ->orderBy('refreshed_at','desc')
        ->paginate(12);
        return view('website::cars.cars_with_driver')->with([
            'cars' => $cars
        ]);
    }

    public function section($id, $slug) {
        $section = \App\Models\Section::findOrFail($id);
        $cars = $section->cars()->with(['images','brand','model','color','types','company','year'])
        ->whereHas('company', function($q) {
            $q->where('status',1);
            $q->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $q->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        })
        ->orderBy('refreshed_at','desc')
        ->paginate(12);
        return view('website::cars.section')->with([
            'cars' => $cars,
            'section' => $section
        ]);
    }

    public function yacht() {
        $cars = Car::with(['images','brand','model','color','types','company','year'])->where('type','yacht')
        ->whereHas('company', function($q) {
            $q->where('status',1);
            $q->where('country_id', app('country')->getCountry()->id);
            if(app('country')->getCity()) {
                $q->whereHas('cities', function($qq) {
                    $qq->where('city_id', app('country')->getCity()->id);
                });
            }
        })
        ->orderBy('refreshed_at','desc')
        ->paginate(12);
        return view('website::cars.yacht')->with([
            'cars' => $cars
        ]);
    }

    public function search() {
        $cars = Car::with(['images','brand','model','color','types','company','year']);
        $selected_types  = [];
        $models          = [];
        if(request()->get('type_id')) {
            array_push($selected_types, ...request()->get('type_id'));
        }
        $selected_types = array_unique($selected_types);
        $cars = $cars->whereHas('types', function($q) use ($selected_types) {
            if(count($selected_types) > 0) {
                $q->whereIn('type_id',$selected_types);
            }
        });
        $cars = $cars->whereHas('company', function($q) {
            $q->where('status',1);
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
        })->orderBy('refreshed_at','desc');

        if(request()->get('order_by') == 'price_low') {
            $cars = $cars->orderBy('price_per_day','asc');
        } else if(request()->get('order_by') == 'price_high') {
            $cars = $cars->orderBy('price_per_day','desc');
        }


        $cars = $cars->paginate(10);


        return view('website::cars.search')->with([
            'cars'         => $cars,
            'models'       => $models,
            'selected_types' => $selected_types,
            'models'       => $models,

        ]);

    }

    public function cities($id, $slug) {
        $city = \App\Models\City::findOrFail($id);
        $cars = Car::with(['images','brand','model','color','types','company','year']);
        $selected_types  = [];
        $models          = [];

        if(request()->get('type_id')) {
            array_push($selected_types, ...request()->get('type_id'));
        }
        $selected_types = array_unique($selected_types);
        $cars = $cars->whereHas('types', function($q) use ($selected_types) {
            if(count($selected_types) > 0) {
                $q->whereIn('type_id',$selected_types);
            }
        });

        $cars = $cars->whereHas('company', function($q) use ($city) {
            $q->where('status',1);
            $q->where('country_id', $city->country_id);

            $q->whereHas('cities', function($qq) use ($city) {
                $qq->where('city_id', $city->id);
            });
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
        })->orderBy('refreshed_at','desc');

        if(request()->get('order_by') == 'price_low') {
            $cars = $cars->orderBy('price_per_day','asc');
        } else if(request()->get('order_by') == 'price_high') {
            $cars = $cars->orderBy('price_per_day','desc');
        }

        $cars = $cars->paginate(10);

        return view('website::cars.cities')->with([
            'cars' => $cars,
            'selected_types' => $selected_types,
            'models' => $models,
            "city" => $city
        ]);
    }

    public function company($id,$slug) {
        $company = Company::findOrFail($id);
        $cars = Car::with(['images','brand','model','color','types','company','year']);
        $cars = $cars->where('company_id',$company->id);
        $cars = $cars->where(function($query) {
        })->orderBy('refreshed_at','desc');

        if(request()->get('order_by') == 'price_low') {
            $cars = $cars->orderBy('price_per_day','asc');
        } else if(request()->get('order_by') == 'price_high') {
            $cars = $cars->orderBy('price_per_day','desc');
        }

        $cars = $cars->paginate(10);

        return view('website::cars.company')->with([
            'cars' => $cars,
            'company' => $company,
        ]);
    }

    public function contact($id) {
        $car = Car::findOrFail($id);
        $type = request()->get('type');

        $msg = "Hello, I am interested in your car " . url('/')  . '/' . $car->id .'/'. $car->slug();
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
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Models\Type;
use \App\Models\Brand;
use \App\Models\Models;
use \App\Models\Color;
use \App\Models\Year;
use \App\Models\Company;
use \App\Models\Country;
use \App\Models\City;
use \App\Models\User;
use \App\Models\Feature;
use \App\Models\Car;
use \App\Models\Page;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import old data from tajeercarrent';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->importTypes();
        $this->importBrands();
        $this->importModels();
        $this->importColors();
        $this->importYears();
        $this->importCountries();
        $this->importCities();
        $this->importCompanies();
        $this->importFeatures();
        $this->importCars();
        $this->importCarsWithDriver();
        $this->importYachts();
        $this->importPages();
    }

    public function importTypes() {
        Type::truncate();
        \DB::statement('ALTER TABLE types MODIFY title longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE types MODIFY page_title longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE types MODIFY page_description longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        $this->info('Importing types...');
        $types = \DB::connection('old')->table('kinds')->get();
        foreach ($types as $type) {
            if($type->file_path) {
                $data = [];
                $data['title'] = [
                    "en" => $type->name_en,
                    "ar" => $type->name_ar
                ];
                $data['slug'] = $type->slug_url;
                $data['image'] = "products/" . $type->file_path;
                $data['sync_id'] = $type->ID;
                $data['page_title'] = [
                    "en" => $type->h1_en,
                    "ar" => $type->h1_ar
                ];
                $data['page_description'] = [
                    "en" => $type->h2_en,
                    "ar" => $type->h2_ar
                ];
                
        
                $item = Type::create($data); 
                $resource = "type";
                $content = new \Modules\Admin\App\Services\ContentService();
                $content->createEmpty($resource, $item->id); 
            } 
        }
        $this->info('Importing types complete');
    }

    public function importBrands() {
        Brand::truncate();
        \DB::statement('ALTER TABLE brands MODIFY title longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE brands MODIFY page_title longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE brands MODIFY page_description longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        $this->info('Importing Brands...');
        $brands = \DB::connection('old')->table('departmen_hidway_t')->get();
        foreach($brands as $item) {
            if($item->file_path) {
                $data = [];
                $data['title'] = [
                    "en" => $item->dep_name_en,
                    "ar" => $item->dep_name_ar
                ];
                $data['slug'] = $item->slug_url;
                $data['image'] = "products/" . $item->file_path;
                $data['sync_id'] = $item->dep_id;
                $data['page_title'] = [
                    "en" => $item->h1_en,
                    "ar" => $item->h1_ar
                ];
                $data['page_description'] = [
                    "en" => $item->h2_en,
                    "ar" => $item->h2_ar
                ];
                $brand = Brand::create($data);
                $resource = "brand";
                $content = new \Modules\Admin\App\Services\ContentService();
                $content->createEmpty($resource, $brand->id); 
            }
        }
        $this->info('Importing brands complete');
    }

    public function importModels() {
        Models::truncate();
        \DB::statement('ALTER TABLE models MODIFY title longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        $this->info('Importing Models...');
        $data = \DB::connection('old')->table('sub_departmen_hidway_t')->get();
        foreach($data as $item) {
            $b = Brand::where('sync_id', $item->dep_id)->first();
            if($b) {
                $data = [];
                $data['title'] = [
                    "en" => $item->sub_name_en,
                    "ar" => $item->sub_name_ar
                ];
                $data['brand_id'] = $b->id;
                $data['type']  = 'car';
                $data['sync_id'] = $item->sub_id;
                Models::create($data);
            }
        }
        $this->info('Importing Models complete');
    }

    public function importColors() {
        Color::truncate();
        \DB::statement('ALTER TABLE colors MODIFY title longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        $this->info('Importing Colors...');
        $data = \DB::connection('old')->table('colors')->get();
        foreach($data as $item) {
            $data = [
                "sync_id" => $item->ID
            ];
            $data['title'] = [
                "en" => $item->name_en,
                "ar" => $item->name_ar
            ];
            Color::create($data);
        }
        $this->info('Importing Colors complete');
    }

    public function importYears() {
        Year::truncate();
        $this->info('Importing Years...');
        $data = \DB::connection('old')->table('branch')->where("name",">=", 2000)->where("name","<=",2025)->get();
        foreach($data as $item) {
            $data = [
                "title" => $item->name,
                "sync_id" => $item->ID
            ];
            Year::create($data);
        }
        $this->info('Importing Years complete');
    }

    public function importCountries() {
        Country::truncate();
        \DB::statement('ALTER TABLE countries MODIFY title longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        $this->info('Importing Countries...');
        $data = \DB::connection('old')->table('countries')->get();
        foreach($data as $item) {
            $data = [
                "sync_id" => $item->ID,
            ];
            $data['title'] = [
                "en" => $item->name_en,
                "ar" => $item->name_ar
            ];
            Country::create($data);
        }
        $this->info('Importing Countries complete');
    }

    public function importCities() {
        City::truncate();
        \DB::statement('ALTER TABLE cities MODIFY title longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        $this->info('Importing Cities...');
        $data = \DB::connection('old')->table('city')->get();
        foreach($data as $item) {
            $data = [
                "sync_id" => $item->ID,
                "country_id" => Country::where('sync_id', $item->dep_id)->first() ? Country::where('sync_id', $item->dep_id)->first()->id : null,
            ];
            $data['title'] = [
                "en" => $item->name_en,
                "ar" => $item->name_ar
            ];
            City::create($data);
        }
        $this->info('Importing Cities complete');
    }

    public function importCompanies() {
        Company::truncate();
        \DB::statement('ALTER TABLE companies MODIFY address longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE companies MODIFY responsible_name longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE companies MODIFY name longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE companies MODIFY description longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');

        User::where("type", "user")->delete();
        $this->info('Importing Companies...');
        $companies = \DB::connection('old')->table('memebers')
        ->whereIn('type_registration',['seller','entertain','chauffeur'])
        ->get();
        foreach($companies as $item) {
  
            $type = "default";
            if($item->type_registration  == "seller") {
                $type = "default";
            } else if($item->type_registration  == "entertain") {
                $type = "yacht";
            } else if($item->type_registration  == "chauffeur") {
                $type = "driver";
            }
    
            $data = [
                "address" => $item->address,
                "country_id" => Country::where('sync_id', $item->countryId)->first() ? Country::where('sync_id', $item->countryId)->first()->id : 2,
                "phone_01" => $item->mobile1,
                "phone_02" => $item->mobile2,
                "phone_03" => $item->mobile3,
                "responsible_name" => $item->delegate_name,
                "cars_limit"       => $item->car_count_limt ? $item->car_count_limt : 1,
                "refresh_limit"    => $item->refresh_limit_count ? $item->refresh_limit_count : 1,
                "fast_location_limit" => $item->fast_location_limit_count ? $item->fast_location_limit_count : 1,
                "password"            => $item->user_pass,
                "status"              => 1,
                "type"                => $type,
                "sync_id"             => $item->ID

            ];

            $user = new User;
            $user->name = $item->name;
            $checkUser = User::where('username', $item->name_user)->first();
            if($checkUser) {
                $user->username = $item->name_user . '-' . rand(1, 100);
            }else {
                $user->username = $item->name_user;
            }
            $user->password = bcrypt($item->user_pass);
            $user->email    = $item->email;
            $user->type     = "user";
            $user->save();
    
            $user->givePermissionTo("home");
            $user->givePermissionTo("cars");
    
            $data['name'] = [
                "en" => $item->company_name_en,
                "ar" => $item->company_name_en
            ];
            
    
            $data['description'] = [
                "en" => $item->notes_krag_owner_ar,
                "ar" => $item->notes_krag_owner_en
            ];
    
            
            if($item->img) {
                $data['image'] = "mem_img/" . $item->img;
            }else {
                $data['image'] = "mem_img/default.png";
            }
            
    
            $data['user_id'] = $user->id;
    
            $company = Company::create($data);

            $cities_ids = [];

            //sellers_governorateids
            $company_cities = \DB::connection('old')->table('sellers_governorateids')
            ->where('sellerId', $item->ID)
            ->get();

            foreach($company_cities as $city) {
                $city_id = City::where('sync_id', $city->governorateId)->first() ? City::where('sync_id', $city->governorateId)->first()->id : null;
                if($city_id) {
                    $cities_ids[] = $city_id;
                }
            }
    
            if(count($cities_ids) > 0) {
                $company->cities()->sync($cities_ids);
            }
            // parse json array from text
            if($company->type == "default") {
                $types_ids     = [];
                $company_types = str_replace("[,", "[null,", $item->specialization);
                $company_types = json_decode($company_types, true);
                if(count($company_types) > 0) {
                    foreach($company_types as $type) {
                        if($type) {
                            $type_id = Type::where('sync_id', $type)->first() ? Type::where('sync_id', $type)->first()->id : null;
                            if($type_id) {
                                $types_ids[] = $type_id;
                            }
                        }
                    }
                }
                $company->types()->sync($types_ids);
            }
    
    
            $resource = "company";
            $content = new \Modules\Admin\App\Services\ContentService();
            $content->createEmpty($resource, $company->id);        
        }
        $this->info('Importing Companies complete');
    }

    public function importFeatures() {
        Feature::truncate();
        \DB::statement('ALTER TABLE features MODIFY name longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        $this->info('Importing Features...');
        $data = \DB::connection('old')->table('cars_additional_specificatio_n')->get();
        foreach($data as $item) {
            $data = [
                "type" => "car",
                "sync_id" => $item->ID
            ];
            $data['name'] = [
                "en" => $item->name_en,
                "ar" => $item->name_ar
            ];
            Feature::create($data);
        }
        $this->info('Importing Features complete');
    }

    public function importCars() {
        Car::truncate();
        \DB::statement('ALTER TABLE cars MODIFY name longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE cars MODIFY customer_notes longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE cars MODIFY description longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        $this->info('Importing Cars...');
        $data = \DB::connection('old')->table('categorys')->get();
        foreach($data as $item) {
            $company = Company::where('sync_id', $item->seller_id)->first();
            $data = [
                "name" => [
                    "ar" => $item->name,
                    "en" => $item->name
                ],
                "company_id" => $company ? $company->id : null,
                "price_per_day" => $item->price ? $item->price : null,
                "price_per_week" => $item->price_byweek ? $item->price_byweek : null,
                "price_per_month" => $item->price_bymounth ? $item->price_bymounth : null,
                "minimum_day_booking" => $item->minimum_Day_Booking,
                "security_deposit" => $item->security_Deposit ? $item->security_Deposit : 0,
                "customer_notes"   => [
                    "ar" => $item->notes_krag_owner_ar,
                    "en" => $item->notes_krag_owner_en
                ],
                "description"   => [
                    "ar" => $item->notes_krag_owner_ar,
                    "en" => $item->notes_krag_owner_en
                ],
                "type" => "default",
                "status" => "active",
                "image" => $item->thumb ? "products/" . $item->thumb : "products/default.png",
                "is_publish" => 1,
                "is_refresh" => 0,
                "extra_price" => $item->extra_Millage_Cost_km ? $item->extra_Millage_Cost_km : 0,
                "brand_id" => Brand::where('sync_id', $item->dep_id)->first() ? Brand::where('sync_id', $item->dep_id)->first()->id : 0,
                "model_id" => Models::where('sync_id', $item->sub_id)->first() ?  Models::where('sync_id', $item->sub_id)->first()->id : 0,
                "year_id"  => Year::where('sync_id', $item->branch_id)->first() ? Year::where('sync_id', $item->branch_id)->first()->id : 0,
                "color_id" => Color::where('sync_id', $item->colors_ids)->first() ? Color::where('sync_id', $item->colors_ids)->first()->id : 0,
                "engine_capacity" => $item->title_1,
                "doors" => $item->title_4,
                "passengers" => $item->title_5,
                "bags" => $item->title_6,
            ]; 
            
            $car = Car::create($data);
            $features_ids     = [];
            $car_features  = str_replace("[,", "[null,", $item->additional_specification_unpaid);
            $features = json_decode($car_features, true);
            if(count($features) > 0) {
                foreach($features as $f) {
                    if($f) {
                        $f_id = Feature::where('sync_id', $f)->first() ? Feature::where('sync_id', $f)->first()->id : null;
                        if($f_id) {
                            $features_ids[] = $f_id;
                        }
                    }
                }
                $car->features()->sync($features_ids);
            }

            $kinds_ids = explode(",", $item->kinds_id);
            $types_ids = [];
            foreach($kinds_ids as $kind) {
                if($kind) {
                    $type = Type::where('sync_id', $kind)->first();
                    if($type) {
                        $types_ids[] = $type->id;
                    }
                }
            }
            if(count($types_ids) > 0) {
                $car->types()->sync($types_ids);
            }
            $images = [
                $item->file_path_branch_1,
                $item->file_path_branch_2,
                $item->file_path_branch_3,
                $item->file_path_branch_4,
                $item->file_path_branch_5,
                $item->file_path_branch_6,
            ];
            foreach($images as $image) {
                if($image) {
                    $car->images()->create([
                        'image' => "products/" . $image
                    ]);
                }
            }

            $resource = "car";
            $content = new \Modules\Admin\App\Services\ContentService();
            $content->createEmpty($resource, $car->id);

        }
        $this->info('Importing Cars complete');
    }

    public function importCarsWithDriver() {
        Car::where('type','driver')->delete();
        \DB::statement('ALTER TABLE cars MODIFY name longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE cars MODIFY customer_notes longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE cars MODIFY description longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        $this->info('Importing Cars With Driver...');
        $data = \DB::connection('old')->table('chauffeurcars')->get();
        foreach($data as $item) {
            $company = Company::where('sync_id', $item->seller_id)->first();
            $data = [
                "name" => [
                    "ar" => $item->name,
                    "en" => $item->name
                ],
                "company_id" => $company ? $company->id : null,
                "price_per_day" => $item->price_3 ? $item->price_3 : null,
                "price_per_week" => $item->price_2 ? $item->price_2 : null,
                "price_per_month" => $item->price_1 ? $item->price_1 : null,
                "minimum_day_booking" => $item->minimum_Day_Booking,
                "security_deposit" => $item->security_Deposit ? $item->security_Deposit : 0,
                "customer_notes"   => [
                    "ar" => $item->notes_krag_owner_ar,
                    "en" => $item->notes_krag_owner_en
                ],
                "description"   => [
                    "ar" => $item->notes_krag_owner_ar,
                    "en" => $item->notes_krag_owner_en
                ],
                "type" => "driver",
                "status" => "active",
                "image" => $item->img ? "products/" . $item->img : "products/default.png",
                "is_publish" => 1,
                "is_refresh" => 0,
                "extra_price" => $item->extra_Millage_Cost_km ? $item->extra_Millage_Cost_km : 0,
                "brand_id" => Brand::where('sync_id', $item->dep_id)->first() ? Brand::where('sync_id', $item->dep_id)->first()->id : 0,
                "model_id" => Models::where('sync_id', $item->sub_id)->first() ?  Models::where('sync_id', $item->sub_id)->first()->id : 0,
                "year_id"  => Year::where('sync_id', $item->branch_id)->first() ? Year::where('sync_id', $item->branch_id)->first()->id : 0,
                "color_id" => Color::where('sync_id', $item->colors_ids)->first() ? Color::where('sync_id', $item->colors_ids)->first()->id : 0,
                "engine_capacity" => $item->title_1,
                "doors" => $item->title_4,
                "passengers" => $item->title_5,
                "bags" => $item->title_6,
            ]; 
            
            $car = Car::create($data);
            $features_ids     = [];
            $car_features  = str_replace("[,", "[null,", $item->additional_specification_unpaid);
            $features = json_decode($car_features, true);
            if(count($features) > 0) {
                foreach($features as $f) {
                    if($f) {
                        $f_id = Feature::where('sync_id', $f)->first() ? Feature::where('sync_id', $f)->first()->id : null;
                        if($f_id) {
                            $features_ids[] = $f_id;
                        }
                    }
                }
                $car->features()->sync($features_ids);
            }

            $kinds_ids = explode(",", $item->kinds_id);
            $types_ids = [];
            foreach($kinds_ids as $kind) {
                if($kind) {
                    $type = Type::where('sync_id', $kind)->first();
                    if($type) {
                        $types_ids[] = $type->id;
                    }
                }
            }
            if(count($types_ids) > 0) {
                $car->types()->sync($types_ids);
            }
            $images = [
                $item->file_path_branch_1,
                $item->file_path_branch_2,
                $item->file_path_branch_3,
                $item->file_path_branch_4,
                $item->file_path_branch_5,
                $item->file_path_branch_6,
            ];
            foreach($images as $image) {
                if($image) {
                    $car->images()->create([
                        'image' => "products/" . $image
                    ]);
                }
            }

            $resource = "car";
            $content = new \Modules\Admin\App\Services\ContentService();
            $content->createEmpty($resource, $car->id);

        }
        $this->info('Importing Cars With Driver complete');
    }

    public function importYachts() {
        Car::where('type','yacht')->delete();
        \DB::statement('ALTER TABLE cars MODIFY name longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE cars MODIFY customer_notes longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE cars MODIFY description longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        $this->info('Importing Yachts...');
        $data = \DB::connection('old')->table('entertainitems')->get();
        foreach($data as $item) {
            $company = Company::where('sync_id', $item->seller_id)->first();
            $data = [
                "name" => [
                    "ar" => $item->name,
                    "en" => $item->name
                ],
                "company_id" => $company ? $company->id : null,
                "price_per_day" => $item->price_1 ? $item->price_1 : null,
                "price_per_week" => $item->price_1 ? $item->price_1 : null,
                "price_per_month" => $item->price_1 ? $item->price_1 : null,
                "minimum_day_booking" => $item->minimum_Day_Booking,
                "security_deposit" => $item->security_Deposit ? $item->security_Deposit : 0,
                "customer_notes"   => [
                    "ar" => $item->notes_krag_owner_ar,
                    "en" => $item->notes_krag_owner_en
                ],
                "description"   => [
                    "ar" => $item->notes_krag_owner_ar,
                    "en" => $item->notes_krag_owner_en
                ],
                "type" => "yacht",
                "status" => "active",
                "image" => $item->img ? "products/" . $item->img : "products/default.png",
                "is_publish" => 1,
                "is_refresh" => 0,
                "extra_price" => $item->extra_Millage_Cost_km ? $item->extra_Millage_Cost_km : 0,
                "brand_id" => Brand::where('sync_id', $item->dep_id)->first() ? Brand::where('sync_id', $item->dep_id)->first()->id : 0,
                "model_id" => Models::where('sync_id', $item->sub_id)->first() ?  Models::where('sync_id', $item->sub_id)->first()->id : 0,
                "year_id"  => Year::where('sync_id', $item->branch_id)->first() ? Year::where('sync_id', $item->branch_id)->first()->id : 0,
                "color_id" => Color::where('sync_id', $item->colors_ids)->first() ? Color::where('sync_id', $item->colors_ids)->first()->id : 0,
                "engine_capacity" => $item->title_1,
                "doors" => $item->title_4,
                "passengers" => $item->title_1,
                "bags" => $item->title_6,
            ]; 
            
            $car = Car::create($data);
            $features_ids     = [];
            $car_features  = str_replace("[,", "[null,", $item->additional_specification_unpaid);
            $features = json_decode($car_features, true);
            if(count($features) > 0) {
                foreach($features as $f) {
                    if($f) {
                        $f_id = Feature::where('sync_id', $f)->first() ? Feature::where('sync_id', $f)->first()->id : null;
                        if($f_id) {
                            $features_ids[] = $f_id;
                        }
                    }
                }
                $car->features()->sync($features_ids);
            }

            $kinds_ids = explode(",", $item->kinds_id);
            $types_ids = [];
            foreach($kinds_ids as $kind) {
                if($kind) {
                    $type = Type::where('sync_id', $kind)->first();
                    if($type) {
                        $types_ids[] = $type->id;
                    }
                }
            }
            if(count($types_ids) > 0) {
                $car->types()->sync($types_ids);
            }
            $images = [
                $item->file_path_branch_1,
                $item->file_path_branch_2,
                $item->file_path_branch_3,
                $item->file_path_branch_4,
                $item->file_path_branch_5,
                $item->file_path_branch_6,
            ];
            foreach($images as $image) {
                if($image) {
                    $car->images()->create([
                        'image' => "products/" . $image
                    ]);
                }
            }

            $resource = "car";
            $content = new \Modules\Admin\App\Services\ContentService();
            $content->createEmpty($resource, $car->id);

        }
        $this->info('Importing Yachts complete');
    }

    public function importPages() {
        Page::truncate();
        \DB::statement('ALTER TABLE pages MODIFY name longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        \DB::statement('ALTER TABLE pages MODIFY content longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci');
        $this->info('Importing Pages...');
        $data = \DB::connection('old')->table('fixed')->get();
        foreach($data as $item) {
            $data = [
                "show_header" => 1,
                "show_footer" => 1,
                "slug" => $item->slug_url
            ];
            $data['name'] = [
                "en" => $item->name_en,
                "ar" => $item->name_ar
            ];
            $data['content'] = [
                "en" => $item->details_en,
                "ar" => $item->details_ar
            ];
        
            $page = Page::create($data);

            $resource = "page";
            $content = new \Modules\Admin\App\Services\ContentService();
            $content->createEmpty($resource, $page->id);
        }
        $this->info('Importing Pages complete');
    }
}

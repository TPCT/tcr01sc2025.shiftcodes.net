<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Translatable\HasTranslations;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
class Company extends Model implements Sitemapable
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['name','description','terms'];

    protected $fillable = [
        'country_id',
        'name',
        'address',
        'phone_01',
        'phone_02',
        'phone_03',
        'responsible_name',
        'image',
        'cars_limit',
        'refresh_limit',
        'fast_location_limit',
        'password',
        'status',
        'user_id',
        'description',
        'type',
        'sync_id',
        'delivery_time',
        'salik_fees',
        'vat_percentage',
        'min_age',
        'deposit_refund',
        'terms',
        "payment_methods",

    ];

    protected $hidden = ['created_at', 'updated_at','image','password'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return url('storage/'.$this->image);
    }
    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function types() {
        return $this->belongsToMany(Type::class, 'company_types');
    }

    public function cars() {
        return $this->hasMany(Car::class);
    }

    public function cities() {
        return $this->belongsToMany(City::class, 'company_cities');
    }

    public function getCarsLimit() {
        return $this->cars_limit;
    }

    public function getCarsCount() {
        return $this->cars()->count();
    }

    public function refreshes() {
        return $this->hasMany(CompanyRefresh::class);
    }

    public function getAvailableCars() {
        return $this->cars_limit - $this->cars()->count();
    }

    public function getRefreshLimit() {
        return $this->refresh_limit;
    }

    public function getRefreshCarsCount() {
        return $this->refreshes()->count();
    }

    public function getAvailableRefreshCars() {
        return $this->getRefreshLimit() - $this->getRefreshCarsCount();
    }

    public function views() {
        return $this->hasMany(View::class);
    }

    public function actions() {
        return $this->hasMany(Action::class);
    }

    public function getViewsCount($period) {

        $start_date = null;
        $end_data   = null;
        if($period == "today") {
            $start_date = now()->startOfDay();
            $end_data   = now()->endOfDay();
        }else if($period == "yesterday") {
            $start_date = now()->subDay()->startOfDay();
            $end_data   = now()->subDay()->endOfDay();
        }else if($period == "week") {
            $start_date = now()->startOfWeek();
            $end_data   = now()->endOfWeek();
        }else if($period == "month") {
            $start_date = now()->startOfMonth();
            $end_data   = now()->endOfMonth();
        }else if($period == "year") {
            $start_date = now()->startOfYear();
            $end_data   = now()->endOfYear();
        }
        if($period != null) {
            return $this->views()->whereBetween('created_at', [$start_date, $end_data])->count();
        }else {
            return $this->views()->count();
        }

    }

    public function getViewsCountDate($date) {

        return $this->views()->whereDate('created_at', $date)->count();

    }



    public function getActionsByType($type, $period) {
        $start_date = null;
        $end_data   = null;
        if($period == "today") {
            $start_date = now()->startOfDay();
            $end_data   = now()->endOfDay();
        }else if($period == "yesterday") {
            $start_date = now()->subDay()->startOfDay();
            $end_data   = now()->subDay()->endOfDay();
        }else if($period == "week") {
            $start_date = now()->startOfWeek();
            $end_data   = now()->endOfWeek();
        }else if($period == "month") {
            $start_date = now()->startOfMonth();
            $end_data   = now()->endOfMonth();
        }else if($period == "year") {
            $start_date = now()->startOfYear();
            $end_data   = now()->endOfYear();
        }
        if($period != null) {
            return $this->actions()->where('type', $type)->whereBetween('created_at', [$start_date, $end_data])->count();
        }else {
            return $this->actions()->where('type', $type)->count();
        }
    }

    public function getActionsByTypeDate($type, $date) {
        return $this->actions()->where('type', $type)->whereDate('created_at', $date)->count();
    }

    public function slug() {
        $slug = str_replace(' ', '-', $this->getTranslation('name','en'));
        return $slug;
    }

    public function sections() {
        return $this->belongsToMany(Section::class, 'company_sections')->withPivot('max');
    }


    public function toSitemapTag(): Url | string | array
    {
        $url = LaravelLocalization::localizeUrl("/b/{$this->id}/{$this->slug()}");
        return Url::create($url)
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }

    public function hours() {
        return $this->hasMany(CompanyHour::class);
    }

    public static $days = [
        'saturday',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
    ];

    public static $allPaymentMethods = [
        "cash",
        "credit_card",
        "crypto",
        "bank_transfer"
    ];

    public function paymentMethods() {
        $paymentMethods = explode(",", $this->payment_methods);
        return $paymentMethods;
    }

    // public function sectionCars() {
    //     return $this->belongsToMany(Car::class, 'company_section_cars');
    // }

    public function brands() {
        $cars = $this->cars()->pluck('brand_id')->toArray();
        $cars = array_unique($cars);
        return Brand::whereIn('id', $cars)->get();
    }

    public function getCarsCountInType($type) {
        return $this->cars()->whereHas('types', function($q) use ($type) {
            $q->where('types.id', $type);
        })->count();
    }

    public function addAllCities() {
        $cities = \App\Models\City::all();
        foreach($cities as $city) {
            if(!$this->cities()->where('city_id', $city->id)->exists()) {
                $this->cities()->attach($city->id);
            }
        }
        return true;
    }

}

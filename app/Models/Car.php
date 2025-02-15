<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Translatable\HasTranslations;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
class Car extends Model implements Sitemapable
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['name','customer_notes','description'];

    protected $fillable = [
        'name',
        'slug',
        'price_per_day',
        'price_per_week',
        'price_per_month',
        'minimum_day_booking',
        'is_day_offer',
        'day_offer_price',
        'security_deposit',
        'customer_notes',
        'color_id',
        'brand_id',
        'model_id',
        'year_id',
        'image',
        'engine_capacity',
        'doors',
        'passengers',
        'bags',
        'status',
        'company_id',
        'description',
        'type',
        'extra_price',
        'km_per_day',
        'km_per_month',
        "insurance_type",
    ];

    protected $hidden = ['created_at', 'updated_at','image','is_day_offer','day_offer_price',
        'brand_id','color_id','model_id','year_id','refreshed_at'
    ];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return url('storage/'.$this->image);
    }

    protected $casts = [
        'refreshed_at' => 'datetime',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function model()
    {
        return $this->belongsTo(Models::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'car_features');
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class, 'car_types');
    }

    public function toSitemapTag(): Url | string | array
    {
        $url = LaravelLocalization::localizeUrl("/{$this->id}/{$this->slug()}");
        return Url::create($url)
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }

    public function getDescription() {
        $model = $this->model;
        $basicDescription = $model ? $model->page_description : '';
        $carDescription   = __('lang.Rent')
        . " " . $this->name
        . " " .   ($this->year ? $this->year->title : '')
        . " " .  ($this->color ? $this->color->title : '')
        . " " . __('lang.Color')
        . " " . __('lang.Contact')
        . " " . $this->company ? $this->company->name : ''
        . " " . __('lang.For Booking');
        return $carDescription . " <br/> " . $basicDescription;
    }

    public function getFeatures() {
        $model = $this->model;
        $basicFeatures = $model?->page_features;
        $carFeatures   = __('lang.Rent')
        . " " . $this->name
        . " " .   ($this->year ? $this->year->title : '')
        . " " .  ($this->color ? $this->color->title : '')
        . " " . __('lang.Color')
        . " " .  $this->doors . " " . __('lang.Doors') . ", "
        . " " .  __('lang.Minimum of Days') . " " .  $this->minimum_day_booking . ", "
        . " " .  $this->passengers . " " . __('lang.Passengers') . ", "
        . " " .__('lang.Price') . " " .  __('lang.Day') . " " .  $this->price_per_day . ", "


        . " " . __('lang.Contact') . " " . $this->company->name . " " . __('lang.For Booking');
        return $carFeatures . " <br/> " . $basicFeatures;
    }
}

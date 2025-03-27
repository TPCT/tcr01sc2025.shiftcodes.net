<?php

namespace App\Models;

use App\Helpers\HasCompany;
use App\Helpers\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Translatable\HasTranslations;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
/**
 * 
 *
 * @property int $id
 * @property string|null $slug
 * @property array|null $name
 * @property float|null $price_per_day
 * @property float|null $price_per_week
 * @property float|null $price_per_month
 * @property int|null $minimum_day_booking
 * @property int|null $is_day_offer
 * @property float|null $day_offer_price
 * @property float|null $security_deposit
 * @property array|null $customer_notes
 * @property int|null $color_id
 * @property int|null $brand_id
 * @property int $model_id
 * @property int|null $year_id
 * @property string|null $image
 * @property string|null $engine_capacity
 * @property string|null $doors
 * @property string|null $passengers
 * @property string|null $bags
 * @property string $status
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_publish
 * @property int $is_refresh
 * @property \Illuminate\Support\Carbon|null $refreshed_at
 * @property array|null $description
 * @property string $type
 * @property float|null $extra_price
 * @property float|null $km_per_day
 * @property float|null $km_per_month
 * @property string|null $insurance_type
 * @property-read \App\Models\Brand|null $brand
 * @property-read \App\Models\Color|null $color
 * @property-read \App\Models\Company|null $company
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Feature> $features
 * @property-read int|null $features_count
 * @property-read mixed $image_url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CarImage> $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Models|null $model
 * @property-read mixed $translations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Type> $types
 * @property-read int|null $types_count
 * @property-read \App\Models\Year|null $year
 * @method static \Illuminate\Database\Eloquent\Builder|Car hasCompany()
 * @method static \Illuminate\Database\Eloquent\Builder|Car newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car query()
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereBags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCustomerNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereDayOfferPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereDoors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereEngineCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereExtraPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereInsuranceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereIsDayOffer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereIsPublish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereIsRefresh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereKmPerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereKmPerMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereMinimumDayBooking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car wherePassengers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car wherePricePerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car wherePricePerMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car wherePricePerWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereRefreshedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereSecurityDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereYearId($value)
 * @mixin \Eloquent
 */
class Car extends Model implements Sitemapable
{
    use HasFactory;
    use HasSlug;
    use HasTranslations;
    use HasCompany;

    public $translatable = ['name','customer_notes','description'];

    protected $fillable = [
        'name',
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
        'slug',
        'extra_price',
        'km_per_day',
        'km_per_month',
        'insurance_type',
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
        $url = LaravelLocalization::localizeUrl("/{$this->id}/{$this->slug}");
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

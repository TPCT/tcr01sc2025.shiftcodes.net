<?php

namespace App\Models;

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
 * @property array|null $title
 * @property string|null $image
 * @property string|null $sync_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $page_title
 * @property array|null $page_description
 * @property string|null $external_url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Car> $cars
 * @property-read int|null $cars_count
 * @property-read mixed $image_url
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type query()
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereExternalUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Type wherePageDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type wherePageTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereSyncId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Type extends Model implements Sitemapable
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;

    public $translatable = ['title','page_title','page_description'];
    protected $fillable = [
        'title',
        'image',
        'slug',
        'sync_id',
        'page_title',
        'page_description',
        'external_url',
        'slug'
    ];

    protected $hidden = ['created_at', 'updated_at','image'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return url('storage/'.$this->image);
    }

    public function cars() {
        return $this->belongsToMany(Car::class, 'car_types')->with('company');
    }

    public function toSitemapTag(): Url | string | array
    {
        $url = LaravelLocalization::localizeUrl("/t/{$this->sync_id}/{$this->slug}");
        return Url::create($url)
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }
}

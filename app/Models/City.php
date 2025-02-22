<?php

namespace App\Models;

use App\Helpers\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * 
 *
 * @property int $id
 * @property string|null $slug
 * @property array|null $title
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $sync_id
 * @property array|null $page_title
 * @property array|null $page_description
 * @property int $default
 * @property-read \App\Models\Country $country
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|City whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|City wherePageDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City wherePageTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSyncId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class City extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;

    public $translatable = ['title','page_title','page_description'];

    protected $fillable = [
        'title',
        'country_id',
        'sync_id',
        'slug',
        'page_title',
        'page_description',
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->getTranslation('title','en'));
    }

}

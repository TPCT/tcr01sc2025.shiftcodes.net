<?php

namespace App\Models;

use App\Helpers\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
/**
 * 
 *
 * @property int $id
 * @property string|null $slug
 * @property array|null $title
 * @property int|null $brand_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $type
 * @property int|null $sync_id
 * @property array|null $page_description
 * @property array|null $page_features
 * @property-read \App\Models\Brand|null $brand
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Car> $cars
 * @property-read int|null $cars_count
 * @property-read mixed $translations
 * @method static Builder|Models newModelQuery()
 * @method static Builder|Models newQuery()
 * @method static Builder|Models query()
 * @method static Builder|Models whereBrandId($value)
 * @method static Builder|Models whereCreatedAt($value)
 * @method static Builder|Models whereId($value)
 * @method static Builder|Models whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static Builder|Models whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static Builder|Models whereLocale(string $column, string $locale)
 * @method static Builder|Models whereLocales(string $column, array $locales)
 * @method static Builder|Models wherePageDescription($value)
 * @method static Builder|Models wherePageFeatures($value)
 * @method static Builder|Models whereSlug($value)
 * @method static Builder|Models whereSyncId($value)
 * @method static Builder|Models whereTitle($value)
 * @method static Builder|Models whereType($value)
 * @method static Builder|Models whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Models extends Model
{
    use HasFactory;
    use HasSlug;
    use HasTranslations;

    public $translatable = ['title', 'page_title', 'page_features','page_description'];

    protected $fillable = [
        'title',
        'brand_id',
        'type',
        'sync_id',
        'page_features',
        'page_title',
        'page_description',
        'slug',
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function cars() {
        return $this->hasMany(Car::class, 'model_id');
    }
}

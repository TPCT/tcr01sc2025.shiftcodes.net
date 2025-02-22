<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
/**
 * 
 *
 * @property int $id
 * @property array|null $description
 * @property array|null $keywords
 * @property string|null $type
 * @property int|null $resource_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $meta_title
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Blog> $blogs
 * @property-read int|null $blogs_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|SEO newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SEO newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SEO query()
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SEO extends Model
{
    protected $table = 'seo';

    use HasFactory;
    use HasTranslations;

    public $translatable = ['description','keywords','meta_title'];


    protected $fillable = [
        "description",
        "keywords",
        "type",
        "resource_id",
        "meta_title"
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'id', 'resource_id');
    }
}

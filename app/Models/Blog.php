<?php

namespace App\Models;

use App\Helpers\HasSlug;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Tags\Url;
use Spatie\Translatable\HasTranslations;
/**
 * 
 *
 * @property int $id
 * @property string|null $slug
 * @property array|null $title
 * @property array|null $content
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_url
 * @property-read \App\Models\SEO|null $seo
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Blog extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;

    public $translatable = ['title','content'];

    protected $fillable = [
        'title',
        'content',
        'slug',
        'image'
    ];

    protected $hidden = ['created_at', 'updated_at','image'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return url('storage/'.$this->image);
    }

    public function seo()
    {
        return $this->belongsTo(SEO::class, 'id', 'resource_id');
    }

    public function toSitemapTag()
    {
        return Url::create(route('website.blogs.show', ['blog' => $this]))
            ->setLastModificationDate(Carbon::create($this->updated_at));
    }
}

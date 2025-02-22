<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
/**
 * 
 *
 * @property int $id
 * @property array|null $title
 * @property array|null $description
 * @property string|null $image
 * @property string|null $type
 * @property int|null $resource_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $title_2
 * @property array|null $title_3
 * @property array|null $description_2
 * @property array|null $description_3
 * @property string|null $image_2
 * @property string|null $image_3
 * @property-read mixed $image_url2
 * @property-read mixed $image_url3
 * @property-read mixed $image_url
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Content newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content query()
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereDescription2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereDescription3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereImage2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereImage3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereTitle2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereTitle3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Content extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['title','description','title_2','description_2','title_3','description_3'];


    protected $fillable = [
        "title",
        "description",
        "image",
        "type",
        "resource_id",
        "title_2",
        "description_2",
        "image_2",
        "title_3",
        "description_3",
        "image_3"
    ];
    protected $hidden = ['created_at', 'updated_at','image','type','resource_id'];
    protected $appends = ['image_url','image_url_2','image_url_3'];

    public function getImageUrlAttribute() {
        if(!$this->image) {
            return null;
        }
        return url('storage/'.$this->image);
    }

    public function getImageUrl2Attribute() {
        if(!$this->image_2) {
            return null;
        }
        return url('storage/'.$this->image_2);
    }

    public function getImageUrl3Attribute() {
        if(!$this->image_3) {
            return null;
        }
        return url('storage/'.$this->image_3);
    }
}

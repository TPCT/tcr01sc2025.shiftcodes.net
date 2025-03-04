<?php

namespace App\Models;

use App\Helpers\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
/**
 * 
 *
 * @property int $id
 * @property array|null $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $sync_id
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Color newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Color newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Color query()
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereSyncId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Color extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;

    public $translatable = ['title'];
    
    protected $fillable = [
        'title',
        "sync_id",
        "slug"
    ];
}

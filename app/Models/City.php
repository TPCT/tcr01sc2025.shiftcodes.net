<?php

namespace App\Models;

use App\Helpers\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;

class City extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;

    public $translatable = ['title','page_title','page_description'];

    protected $fillable = [
        'title',
        'slug',
        'country_id',
        'sync_id',
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

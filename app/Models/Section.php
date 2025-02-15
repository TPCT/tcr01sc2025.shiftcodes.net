<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Translatable\HasTranslations;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
class Section extends Model implements Sitemapable
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title','description'];

    protected $fillable = [
        'title',
        'description',
        'sort',
        'type_id',

    ];

    public function type()
    {
        return $this->belongsTo(Type::class)->with('cars');
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'section_cars');
    }

    public function toSitemapTag(): Url | string | array
    {
        $url = LaravelLocalization::localizeUrl("/s/{$this->id}/{$this->slug()}");
        return Url::create($url)
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }

}

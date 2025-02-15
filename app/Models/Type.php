<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Translatable\HasTranslations;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

class Type extends Model implements Sitemapable
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title','page_title','page_description'];
    protected $fillable = [
        'title',
        'image',
        'slug',
        'sync_id',
        'page_title',
        'page_description',
        'external_url'
    ];

    protected $hidden = ['created_at', 'updated_at','image'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return url('storage/'.$this->image);
    }

    public function cars() {
        return $this->belongsToMany(Car::class, 'car_types')->with('company');
    }

    public function slug() {
        // $slug = str_replace(' ', '-', $this->getTranslation('title','en'));
        // return $slug;
        $slug = "rent-".str_replace(' ', '-', $this->getTranslation('title','en'))."-car-rental-dubai";
        return $slug;
    }

    public function toSitemapTag(): Url | string | array
    {
        $url = LaravelLocalization::localizeUrl("/t/{$this->sync_id}/{$this->slug()}");
        return Url::create($url)
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }
}

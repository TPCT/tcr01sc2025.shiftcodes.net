<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Translatable\HasTranslations;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
class Brand extends Model implements Sitemapable
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
    ];

    protected $hidden = ['image'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return url('storage/'.$this->image);
    }

    public function models() {
        return $this->hasMany(Models::class, 'brand_id');
    }

    public function cars() {
        return $this->hasMany(Car::class);
    }

    public function toSitemapTag(): Url | string | array
    {
        $url = LaravelLocalization::localizeUrl("/b/{$this->sync_id}/{$this->slug}");
        return Url::create($url)
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }

}

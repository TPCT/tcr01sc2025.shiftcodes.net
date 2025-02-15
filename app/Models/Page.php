<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Translatable\HasTranslations;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
class Page extends Model implements Sitemapable
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['name','content'];

    protected $fillable = [
        'name',
        'content',
        'slug',
        'image',
        'show_header',
        'show_footer',
        "show_rent_car"
    ];

    protected $hidden = ['created_at', 'updated_at','image'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return url('storage/'.$this->image);
    }

    public function toSitemapTag(): Url | string | array
    {
        $url = LaravelLocalization::localizeUrl("/p/{$this->id}/{$this->slug}");
        return Url::create($url)
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'page_cars', 'page_id', 'car_id');
    }
}

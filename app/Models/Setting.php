<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Setting extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'title','footer_description',"footer_address","driver_title","driver_description","yacht_title","yacht_description","blog_title","faq_title",
        "car_types_title",
        "car_types_description",
        "car_brands_title",
        "car_brands_description",
        "car_companies_title",
        "car_companies_description",
        "book_your_next_trip_left",
        "book_your_next_trip_right",
        "find_your_car_title",
        "find_your_car_description",
        "default_notes",
        "driver_notes",
        "yacht_notes",
    ];

    protected $fillable = [
        'title',
        'header_logo',
        'footer_logo',
        'footer_description',
        'footer_address',
        'contact_email',
        'contact_phone',
        'contact_facebook',
        'contact_twitter',
        'contact_instagram',
        'app_google_play',
        'app_apple_store',
        'driver_title',
        'driver_description',
        'yacht_title',
        'yacht_description',
        "blog_title",
        "faq_title",
        "contact_whatsapp",
        "map",
        "google_reviews_widget",
        "facebook_reviews_widget",
        "car_types_title",
        "car_types_description",
        "car_brands_title",
        "car_brands_description",
        "car_companies_title",
        "car_companies_description",
        "book_your_next_trip_left",
        "book_your_next_trip_right",
        "find_your_car_title",
        "find_your_car_description",
        "scripts",
        "scripts_body",
        "default_notes",
        "driver_notes",
        "yacht_notes",
    ];

    protected $hidden = ['created_at', 'updated_at','header_logo','footer_logo'];

    protected $appends = ['header_logo_url','footer_logo_url'];

    public function getHeaderLogoUrlAttribute() {
        return url('storage/'.$this->header_logo);
    }

    public function getFooterLogoUrlAttribute() {
        return url('storage/'.$this->footer_logo);
    }
}

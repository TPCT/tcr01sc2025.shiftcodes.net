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
 * @property string|null $header_logo
 * @property string|null $footer_logo
 * @property array|null $footer_description
 * @property array|null $footer_address
 * @property string|null $contact_email
 * @property string|null $contact_phone
 * @property string|null $contact_facebook
 * @property string|null $contact_twitter
 * @property string|null $contact_instagram
 * @property string|null $app_google_play
 * @property string|null $app_apple_store
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $driver_title
 * @property array|null $driver_description
 * @property array|null $yacht_title
 * @property array|null $yacht_description
 * @property array|null $blog_title
 * @property array|null $faq_title
 * @property string|null $contact_whatsapp
 * @property string|null $map
 * @property string|null $google_reviews_widget
 * @property string|null $facebook_reviews_widget
 * @property array|null $car_types_title
 * @property array|null $car_types_description
 * @property array|null $car_brands_title
 * @property array|null $car_brands_description
 * @property array|null $car_companies_title
 * @property array|null $car_companies_description
 * @property array|null $book_your_next_trip_left
 * @property array|null $book_your_next_trip_right
 * @property array|null $find_your_car_title
 * @property array|null $find_your_car_description
 * @property string|null $scripts
 * @property array|null $default_notes
 * @property array|null $driver_notes
 * @property array|null $yacht_notes
 * @property string|null $scripts_body
 * @property-read mixed $footer_logo_url
 * @property-read mixed $header_logo_url
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAppAppleStore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAppGooglePlay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereBlogTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereBookYourNextTripLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereBookYourNextTripRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCarBrandsDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCarBrandsTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCarCompaniesDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCarCompaniesTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCarTypesDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCarTypesTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereContactFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereContactInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereContactTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereContactWhatsapp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDefaultNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDriverDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDriverNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDriverTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFacebookReviewsWidget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFaqTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFindYourCarDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFindYourCarTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFooterAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFooterDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFooterLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereGoogleReviewsWidget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereHeaderLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereScripts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereScriptsBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereYachtDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereYachtNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereYachtTitle($value)
 * @mixin \Eloquent
 */
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

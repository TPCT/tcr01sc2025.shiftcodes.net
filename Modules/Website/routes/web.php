<?php

use App\Models\Country;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Website\App\Http\Controllers\CarsController;
use Modules\Website\App\Http\Controllers\HomeController;
use Modules\Website\App\Http\Controllers\PagesController;
use Modules\Website\App\Http\Controllers\UsersController;
use Modules\Website\App\Http\Controllers\BlogsController;
use Modules\Website\App\Http\Controllers\TypesController;
use Modules\Website\App\Http\Controllers\BrandsController;
use Modules\Website\App\Http\Controllers\YachtsController;
use Modules\Website\App\Http\Controllers\StorageController;
use Modules\Website\App\Http\Controllers\MinifyController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/storage/{path}', [StorageController::class, "show"])->where('path', '.*');
Route::get('/minify/{any}', [MinifyController::class, 'minify'])->name('minify')->where('any', '.*');



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        "localeSessionRedirect", "localizationRedirect",
        "currency"
    ]],
    function() {
        Route::get('/language/{key}/switch', [HomeController::class, 'switchLanguage'])->name('website.switch.language');
        Route::get('/country/{country?}/switch', [HomeController::class, 'switchCountry'])->name('website.switch.country');
        Route::get('/currency/{currency?}/switch', [HomeController::class, 'switchCurrency'])->name('website.switch.currency');
        Route::get('/city/{city?}/switch', [HomeController::class, 'switchCity'])->name('website.switch.city');

        Route::get('/faq', [PagesController::class, 'faq'])->name('website.pages.faq');
        Route::any("/contact-us", [PagesController::class, 'contact'])->name('website.pages.contact-us');
        Route::get("/list-your-car", [PagesController::class, 'list_your_car'])->name('website.pages.list-your-car');


        Route::post("/signup", [UsersController::class, 'signup'])->name('website.account.register');
        Route::post("/login", [UsersController::class, 'login'])->name('website.account.login');
        Route::get("/login/{provider}", [UsersController::class, 'login_with_provider'])->name('website.account.login_with_provider');
        Route::get("/login/{provider}/callback", [UsersController::class, 'handle_provider_callback'])->name('website.account.login_with_provider_callback');

        Route::group(["middleware" => ["customer-auth"]], function () {
            Route::get("/account/phone", [UsersController::class, 'phone'])->name('website.account.phone');
            Route::get("/account/verify", [UsersController::class, 'verify_user'])->name('website.account.verify');
            Route::get("/account/wishlist", [UsersController::class, 'wishlist'])->name('website.account.wishlist');
            Route::get("/account/fcm/register", [UsersController::class, 'register_fcm_token'])->name('website.account.registerFCMToken');
            Route::get("/account/wishlist/toggle", [UsersController::class, 'toggle_wish_list'])->name('website.account.toggleWishlist');
            Route::get("/account/logout", [UsersController::class, 'logout'])->name('website.account.logout');
        });


        Route::get('/iframes', [HomeController::class, 'reviews']);

        Route::group([
            'prefix' => '{country?}/{city?}',
            'middleware' => \Modules\Website\App\Http\Middleware\CountryMiddleware::class,
            'where' => ['country' => Country::implode('slug', '|'), 'city' => \App\Models\City::implode('slug', '|')],
        ], function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');

            Route::prefix('types')->controller(TypesController::class)->group(function () {
                Route::get('/', 'index')->name('website.cars.types.index');
                Route::get('/{type}', 'show')->name('website.cars.types.show');
                Route::get('/{type}/models/{model}', 'model')->name('website.cars.types.models');
            });

            Route::prefix('brands')->controller(BrandsController::class)->group(function () {
                Route::get('/', 'index')->name('website.cars.brands.index');
                Route::get('/{brand}', 'show')->name('website.cars.brands.show');
                Route::get('/{brand}/models/{model}', 'model')->name('website.cars.brands.models');
            });

            Route::prefix('cars')->controller(CarsController::class)->group(function () {
                Route::get('/with-drivers', 'with_driver')->name('website.cars.with-drivers');
                Route::get('/filter', 'filter')->name('website.cars.filter');
                Route::get('/{car}', 'show')->name('website.cars.show');
            });

            Route::prefix('yachts')->controller(YachtsController::class)->group(function () {
                Route::get('/', 'index')->name('website.yachts.index');
                Route::get('/{yacht}', 'show')->name('website.yachts.show');
            });

            Route::prefix('blogs')->controller(BlogsController::class)->group(function () {
                Route::get('/', 'index')->name('website.blogs.index');
                Route::get('/{blog}', 'show')->name('website.blogs.show');
            });

            Route::get('/{page}', [PagesController::class, 'show'])->name('website.pages.show');
        });
 });



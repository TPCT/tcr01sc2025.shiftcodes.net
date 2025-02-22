<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Website\App\Http\Controllers\CarsController;
use Modules\Website\App\Http\Controllers\HomeController;
use Modules\Website\App\Http\Controllers\PagesController;
use Modules\Website\App\Http\Controllers\UsersController;
use Modules\Website\App\Http\Controllers\BlogsController;
use Modules\Website\App\Http\Controllers\TypesController;
use Modules\Website\App\Http\Controllers\BrandsController;

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

// Route::group(["middleware" => ["language","country","currency", "redirectIfNotSEOFriendly" , 'clean-url']], function () {

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect', 'localizationRedirect',
        "currency", \Modules\Website\App\Http\Middleware\CountryMiddleware::class
    ]],
    function() {


    Route::get('/language/{key}/switch', [HomeController::class, 'switchLanguage'])->name('website.switch.language');
    Route::get('/country/{country?}/switch', [HomeController::class, 'switchCountry'])->name('website.switch.country');
    Route::get('/currency/{currency?}/switch', [HomeController::class, 'switchCurrency'])->name('website.switch.currency');
    Route::get('/city/{city?}/switch', [HomeController::class, 'switchCity'])->name('website.switch.city');

    Route::group([
        'middleware' => [\Modules\Website\App\Http\Middleware\CountryMiddleware::class],
        'prefix' => '{country?}/{city?}'
    ], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::prefix('types')->group(function () {
            Route::get('/', [TypesController::class, 'index'])->name('website.cars.types.index');
            Route::get('/{type}', [TypesController::class, 'show'])->name('website.cars.types.show');
            Route::get('/{type}/models/{model}', [TypesController::class, 'model'])->name('website.cars.types.models');
        });

        Route::prefix('brands')->group(function () {
            Route::get('/', [BrandsController::class, 'index'])->name('website.cars.brands.index');
            Route::get('/{brand}', [BrandsController::class, 'show'])->name('website.cars.brands.show');
            Route::get('/{brand}/models/{model}', [BrandsController::class, 'model'])->name('website.cars.brands.models');
        });

        Route::prefix('cars')->group(function () {
            Route::get('/{car}', [CarsController::class, 'show'])->name('website.cars.show');
        });

        Route::prefix('/blogs')->group(function () {
            Route::get('/', [BlogsController::class , 'index'])->name('website.blogs.index');
            Route::get('/{blog}', [BlogsController::class, 'show'])->name('website.blogs.show');
        });
        Route::get('/faq', [PagesController::class, 'faq']);
    });
    /*
     *
     * /en/monthly -> /uae/monthly -> /uae/dubai/monthly
     * /en/uae/monthly/
     *
     * /en
     * /en/uae
     * /en/uae/dubai
     *
     * /en/uae/dubai/types/{type}/brands/{brand}/period/{period}
     * /en/uae/dubai/types/{type}
     * /en/uae/dubai/brands/{brand}
     * /en/uae/dubai/period/{monthly,weekly,daily}
     * /en/uae/dubai/cars/{}
     *
     * /en/uae/dubai/monthly/bmw/luxury?period=monthly
     * /en/uae/dubai/monthly
     *
     * /en/uae/dubai/luxury/
     * /car-rental-{location}
     *
     */

//    Route::get('/brands/models', [CarsController::class, 'getModels']);
    Route::get('/a/{id}', [CarsController::class, 'contact']);

//
//    Route::get('/t/{id}/{slug}', [CarsController::class, 'index'])->name('types');
//    Route::get('/b/{id}/{slug}', [CarsController::class, 'index'])->name('brands');
//



//    Route::get('/d/cars', [CarsController::class, 'carsWithDriver']);
//    Route::get('/yacht', [CarsController::class, 'yacht']);
//    Route::get('/c/{id}/{slug}', [CarsController::class, 'company'])->name('company');
    Route::get('/p/{id}/{slug}', [PagesController::class, 'index']);
    Route::get('/s/{id}/{slug}', [CarsController::class, 'section']);

    Route::get('/cars/search', [CarsController::class, 'getSearch']);
    Route::get('/search', [CarsController::class, 'search']);
    Route::get('/l/{id}/{slug}', [CarsController::class, 'cities']);


    Route::get("/contact", [PagesController::class, 'contact']);
    Route::get("/listyourcar", [PagesController::class, 'listYourCar']);
    Route::post("/contact", [PagesController::class, 'saveContact']);


    Route::post("/signup", [UsersController::class, 'signup'])->name('signup');
    Route::post("/login", [UsersController::class, 'login'])->name('login');
    Route::get("/login/{provider}", [UsersController::class, 'loginWithProvider']);
    Route::get("/login/{provider}/callback", [UsersController::class, 'handleProviderCallback']);

    Route::group(["middleware" => ["customer-auth"]], function () {
        Route::get("/account/phone", [UsersController::class, 'phone'])->name('phone');
        Route::get("/account/verify", [UsersController::class, 'verifyUser'])->name('verify');
        Route::get("/account/wishlist", [UsersController::class, 'wishlist']);
        Route::get("/account/fcm/register", [UsersController::class, 'registerFCMToken']);
        Route::get("/wishlist/toggle", [UsersController::class, 'toggleWishlist']);
        Route::get("/logout", [UsersController::class, 'logout'])->name('logout');
    });

    Route::get('/iframes', [HomeController::class, 'reviews']);
    Route::get('/{id}/{slug}', [CarsController::class, 'show'])->name('website.show-car');



});

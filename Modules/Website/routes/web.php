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
use Modules\Website\App\Http\Controllers\YachtsController;

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

        Route::prefix('/blogs')->controller(BlogsController::class)->group(function () {
            Route::get('/', 'index')->name('website.blogs.index');
            Route::get('/{blog}', 'show')->name('website.blogs.show');
        });
        Route::get('/faq', [PagesController::class, 'faq']);
    });

    Route::get('/a/{id}', [CarsController::class, 'contact']);

    Route::get('/p/{id}/{slug}', [PagesController::class, 'index']);
    Route::get('/s/{id}/{slug}', [CarsController::class, 'section']);

    Route::get('/l/{id}/{slug}', [CarsController::class, 'cities']);


    Route::get("/listyourcar", [PagesController::class, 'listYourCar']);
    Route::get("/contact", [PagesController::class, 'contact']);
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
});

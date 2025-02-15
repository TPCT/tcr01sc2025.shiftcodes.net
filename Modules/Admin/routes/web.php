<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\App\Http\Controllers\Auth\LoginController;
use Modules\Admin\App\Http\Controllers\AccountController;
use Modules\Admin\App\Http\Controllers\HomeController;
use Modules\Admin\App\Http\Controllers\BrandsController;
use Modules\Admin\App\Http\Controllers\ModelsController;
use Modules\Admin\App\Http\Controllers\TypesController;
use Modules\Admin\App\Http\Controllers\ColorsController;
use Modules\Admin\App\Http\Controllers\YearsController;
use Modules\Admin\App\Http\Controllers\CountriesController;
use Modules\Admin\App\Http\Controllers\CitiesController;
use Modules\Admin\App\Http\Controllers\CompaniesController;
use Modules\Admin\App\Http\Controllers\CarsController;
use Modules\Admin\App\Http\Controllers\FeaturesController;
use Modules\Admin\App\Http\Controllers\PagesController;
use Modules\Admin\App\Http\Controllers\BannersController;
use Modules\Admin\App\Http\Controllers\SectionsController;
use Modules\Admin\App\Http\Controllers\CustomersController;
use Modules\Admin\App\Http\Controllers\SettingsController;
use Modules\Admin\App\Http\Controllers\OffersController;
use Modules\Admin\App\Http\Controllers\ContentController;
use Modules\Admin\App\Http\Controllers\BlogController;
use Modules\Admin\App\Http\Controllers\NotificationsController;
use Modules\Admin\App\Http\Controllers\MessagesController;
use Modules\Admin\App\Http\Controllers\CurrenciesController;


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
Route::group(["middleware" => ["AdminLang"]], function() {
    Route::get('/lang/{lang}', function($lang) {
        session()->put('admin_lang', $lang);
        return redirect()->back();
    });

Route::group(["prefix" => "admin", "middleware"=>['guest']], function() {
    Route::get("/login", [LoginController::class, 'index']);
    Route::post("/login", [LoginController::class, 'login']);
});

Route::get('/admin/lang/switch', [HomeController::class, 'switchLang']);


Route::group(["prefix" => "admin", "middleware" => ['AdminAuth']], function () {


    Route::get('/', [HomeController::class, 'index']);

    Route::resource('brands', BrandsController::class);
    Route::resource('models', ModelsController::class);
    Route::resource('types', TypesController::class);
    Route::resource('colors', ColorsController::class);
    Route::resource('years', YearsController::class);
    Route::resource('countries', CountriesController::class);
    Route::resource('cities', CitiesController::class);
    Route::resource('companies', CompaniesController::class);
    Route::resource('cars', CarsController::class);
    Route::resource('features', FeaturesController::class);
    Route::resource('pages', PagesController::class);
    Route::resource('banners', BannersController::class);
    Route::resource('sections', SectionsController::class);
    Route::resource('customers', CustomersController::class);
    Route::resource('settings', SettingsController::class);
    Route::resource('blog', BlogController::class);

    Route::get('cars/{brand_id}/models', [CarsController::class, 'getModels']);
    Route::post('models/content/import', [ModelsController::class, 'importExcel']);
    Route::get('cars/images/{id}/delete', [CarsController::class, 'deleteImage']);
    Route::get('cars/{id}/status', [CarsController::class, 'toggleStatus']);
    Route::get('cars/{id}/delete', [CarsController::class, 'destroy']);
    Route::get('cars/{id}/visibilty', [CarsController::class, 'toggleVisibility']);
    Route::get('cars/{id}/refresh', [CarsController::class, 'refreshSingleCar']);
    Route::post('cars/list/refresh', [CarsController::class, 'refreshCars']);

    Route::get('countries/{id}/cities', [CitiesController::class, 'getCities']);
    Route::get('/logout', [AccountController::class, 'logout']);


    Route::get('offers', [OffersController::class, 'index']);
    Route::post('offers', [OffersController::class, 'update']);

    Route::get('content/{type}', [ContentController::class, 'index']);
    Route::put('content/{type}', [ContentController::class, 'update']);
    Route::get('content/delete-image/{id}/{number}', [ContentController::class, 'destroyImage']);
    Route::get('/sitemap/generate', [ContentController::class, 'generateSitemap']);

    Route::resource('notifications', NotificationsController::class);
    Route::resource('messages', MessagesController::class);
    Route::resource('currencies', CurrenciesController::class);



});

});

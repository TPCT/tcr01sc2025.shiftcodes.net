<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\API\App\Http\Controllers\HomeController;
use Modules\API\App\Http\Controllers\CarsController;
use Modules\API\App\Http\Controllers\PagesController;
use Modules\API\App\Http\Controllers\UsersController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/
Route::group(["middleware" => ['country-api']], function () {

    Route::get('/types', 'HomeController@types');
    Route::get('/brands', 'HomeController@brands');
    Route::get('/sections', 'HomeController@sections');
    Route::get('/companies', 'HomeController@companies');
    Route::get('/banners', 'HomeController@banners');
    Route::get('/faq', 'HomeController@faq');
    Route::get('/faq/all', 'HomeController@AllFaq');
    Route::get('/home/content', 'HomeController@homeContent');

    Route::get('/cars/t/{id}', 'CarsController@carsByType');
    Route::get('/cars/b/{id}', 'CarsController@carsByBrand');
    Route::get('/cars/search', 'CarsController@search');
    Route::get('/cars/driver', 'CarsController@carsWithDriver');
    Route::get('/yachts', 'CarsController@yachts');
    Route::get('/cars/{id}/show', 'CarsController@show');
    Route::get('/listyourcar', 'PagesController@listYourCar');
    Route::get('/companies/{id}/show', 'CarsController@showCompany');
    Route::get('/sections/{id}/show', 'CarsController@section');
    Route::get('/pages', 'PagesController@pages');
    Route::get('/pages/{id}/show', 'PagesController@showPage');
    Route::get('/brands/{id}/models', 'CarsController@getModels');
    Route::get('/colors', 'CarsController@getColors');
    Route::get('/years', 'CarsController@getYears');
    Route::get('/a/{id}', 'CarsController@contact');
    Route::get('/settings', 'PagesController@settings');
    Route::get('/countries', 'PagesController@countries');
    Route::get('/currencies', 'PagesController@currencies');
    Route::get('/countries/{id}/cities', 'PagesController@cities');
    Route::get('/blog', 'PagesController@blog');
    Route::post('/contact', 'PagesController@contact');
    Route::post('/signup', 'UsersController@signup');
    Route::post('/login', 'UsersController@login');
    Route::middleware('auth:api')->group(function () {
        Route::get('/profile', 'UsersController@profile');
        Route::post('/profile', 'UsersController@updateProfile');
        Route::post('/logout', 'UsersController@logout');
        Route::post('/cars/{id}/wishlist/toggle', 'CarsController@toggleWishlist');
        Route::get('/wishlist', 'CarsController@wishlist');
    });


});


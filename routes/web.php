<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});
Route::group(['namespace' => 'AccountingSystem', 'prefix' => 'dashboard', 'middleware' => 'auth','as' => 'dashboard.'], function () {
    route::get('/', 'DashboardController@index')->name('index');
    //====================== Admin Routes
    route::resource('users', 'UsersController');
    route::resource('categories', 'CategoryController');
    route::resource('subcategories', 'SubCategoryController');
    route::resource('products', 'ProductController');
    route::resource('meals', 'MealController');
    Route::get('/getAllSubcategories/{id}', 'MealController@getAllSubcategories');
    Route::post('/product','MealController@getAjaxProductQty')->name('meals.getAjaxProductQty');
    route::resource('subscriptions', 'SubscriptionController');
    route::resource('measurements', 'MeasurementController');
    route::resource('clients', 'ClientController');


});

Auth::routes();


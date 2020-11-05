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
    route::resource('settings', 'SettingController');
    route::resource('users', 'UsersController');
    route::resource('categories', 'CategoryController');
    route::resource('subcategories', 'SubCategoryController');
    route::resource('products', 'ProductController');
    route::resource('meals', 'MealController');
    route::resource('suppliers', 'SupplierController');
    Route::get('/getAllSubcategories/{id}', 'MealController@getAllSubcategories');
    Route::get('/getProduct/{id}', 'MealController@getProduct');
    route::resource('types_meal', 'TypeMealController');

    Route::post('/product','MealController@getAjaxProductQty')->name('meals.getAjaxProductQty');
    Route::get('/meals-products', 'MealController@delete_product')->name('meals-products.destroy');
    route::resource('subscriptions', 'SubscriptionController');
    route::resource('measurements', 'MeasurementController');
    route::resource('clients', 'ClientController');
    route::resource('clients_subscriptions', 'ClientSubscriptionController');
    route::resource('visits', 'VisitController');
    route::resource('purchases', 'PurchaseController');
    route::get('add_visit/{id}', 'VisitController@add_visit')->name('visits.add_visit');
    route::get('add_subscription/{id}', 'ClientSubscriptionController@add_subscription')->name('clients_subscriptions.add_subscription');
    route::get('dietsystems/{id}', 'ClientSubscriptionController@dietsystems')->name('dietsystems.show');
    route::get('dietsystems_edit/{id}', 'ClientSubscriptionController@dietsystems_edit')->name('dietsystems.edit');
    route::any('dietsystems_update/{id}', 'ClientSubscriptionController@dietsystems_update')->name('dietsystems.update');

    Route::get('/getEndDate/{id}', 'ClientSubscriptionController@getEndDateAjex');
    Route::get('/getMealTable/{id}', 'ClientSubscriptionController@getMealTable');
    Route::get('/getMealInputs/{id}', 'SubscriptionController@getMealInputs');
    Route::delete('/subscription_meal/{id}', 'SubscriptionController@subscription_meal')->name('subscriptions-meal.destroy');

      //=============================sales
    route::resource('sales', 'SaleController');
    Route::get('/getAllSubcategoriesSale/{id}', 'SaleController@getAllSubcategories');
    Route::get('/getAllMeals/{id}', 'SaleController@getAllMeals');
    //===============================stores
    route::get('stores', 'StoreController@index')->name('stores.index');



});

Auth::routes();


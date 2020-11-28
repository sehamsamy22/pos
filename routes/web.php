<?php

use Illuminate\Support\Facades\Auth;
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
    route::get('pay-subscription/{id}', 'RevenueController@payment_subscription')->name('clients_subscriptions.payment');
    route::resource('revenues', 'RevenueController');

    Route::get('/getEndDate/{id}', 'ClientSubscriptionController@getEndDateAjex');
    Route::get('/getMealTable/{id}', 'ClientSubscriptionController@getMealTable');
    Route::get('/getMealInputs/{id}', 'SubscriptionController@getMealInputs');
    Route::delete('/subscription_meal/{id}', 'SubscriptionController@subscription_meal')->name('subscriptions-meal.destroy');

      //=============================sales
    route::resource('sales', 'SaleController');
    Route::get('/getAllSubcategoriesSale/{id}', 'SaleController@getAllSubcategories');
    Route::get('/getAllcategoriesSale', 'SaleController@getAllcategories');

    Route::get('/getAllMeals/{id}', 'SaleController@getAllMeals');
    //===============================stores
    route::get('stores', 'StoreController@index')->name('stores.index');
    route::any('/purchase_order', 'StoreController@purchase_order')->name('stores.purchase_order');
    route::any('/cook-view', 'StoreController@cooker_view')->name('stores.cooker_view');
    Route::POST('/receive_products/{id}', 'StoreController@receive_products');
    Route::POST('/ready_meals/{id}', 'StoreController@ready_meals');
    route::get('/operarion_manger_view', 'StoreController@operarion_manger_view')->name('stores.operarion_manger_view');
    Route::POST('/receive_meals/{id}', 'StoreController@receive_meals');
    Route::POST('/distributed_meals/{id}', 'StoreController@distributed_meals');
    route::any('/driver_manger_view', 'StoreController@driver_manger_view')->name('stores.driver_manger_view');
    Route::POST('/assign_driver/{id}', 'StoreController@assign_driver');
    //===============================accounts
    route::resource('accounts', 'AccountController');
    route::resource('entries', 'EntryController');
    Route::get('/posted/{id}', 'EntryController@posted')->name('entries.posted');

    Route::group(['prefix' => 'entries'], function () {

        Route::get('filter', ['as' => 'entries.filter', 'uses' => 'EntryController@filter']);
        Route::get('posting/{id}', ['as' => 'entries.posting', 'uses' => 'EntryController@posting']);
        Route::get('toAccounts/{id}', ['as' => 'entries.toAccounts', 'uses' => 'EntryController@toaccounts']);

    });
});

Auth::routes();


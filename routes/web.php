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
    route::resource('units', 'UnitController');
    route::resource('areas', 'AreaController');

    route::resource('clients_subscriptions', 'ClientSubscriptionController');
    route::resource('visits', 'VisitController');
    route::resource('purchases', 'PurchaseController');
   route::any('/filter', 'PurchaseController@index')->name('purchases.filter');

    route::get('add_visit/{id}', 'VisitController@add_visit')->name('visits.add_visit');
    route::get('add_subscription/{id}', 'ClientSubscriptionController@add_subscription')->name('clients_subscriptions.add_subscription');
    route::get('dietsystems/{id}', 'ClientSubscriptionController@dietsystems')->name('dietsystems.show');
    route::get('dietsystems_edit/{id}', 'ClientSubscriptionController@dietsystems_edit')->name('dietsystems.edit');
    route::any('dietsystems_update/{id}', 'ClientSubscriptionController@dietsystems_update')->name('dietsystems.update');
    route::get('pay-subscription/{id}', 'RevenueController@payment_subscription')->name('clients_subscriptions.payment');
    route::get('pay-sale/{id}', 'RevenueController@payment_sale')->name('sales.payment');

    route::get('/checkquantity/{id}', 'MealController@checkquantity');

    route::get('receipt', 'RevenueController@receipt')->name('revenues.receipt');
    route::get('store-out', 'RevenueController@store_out')->name('revenues.store_out');
    route::get('receipt-index', 'RevenueController@receipt_index')->name('revenues.receipt_index');
    route::any('/receipt-filter', 'RevenueController@receipt_index')->name('revenues.receipt_filter');

    route::get('store-out-index', 'RevenueController@store_out_index')->name('revenues.store_out_index');
    route::any('store-out-index', 'RevenueController@store_out_index')->name('revenues.store_out_filter');
    route::get('store-out-show/{id}', 'RevenueController@store_out_show')->name('revenues.store_out_sanad_show');

    route::resource('revenues', 'RevenueController');
    route::any('/filter-payments', 'RevenueController@index')->name('revenues.filter');
    route::any('/filter-entriy', 'EntryController@filter')->name('entries.filter');


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
    route::get('stores/{id}', 'StoreController@show')->name('stores.show');


    route::any('/purchase_order', 'StoreController@purchase_order')->name('stores.purchase_order');
    route::any('/cook-view', 'StoreController@cooker_view')->name('stores.cooker_view');
    Route::POST('/receive_products/{id}', 'StoreController@receive_products');
    Route::POST('/ready_meals/{id}', 'StoreController@ready_meals');
    route::get('/operarion_manger_view', 'StoreController@operarion_manger_view')->name('stores.operarion_manger_view');
    Route::POST('/receive_meals/{id}', 'StoreController@receive_meals');
    Route::get('/meal_print/{id}', 'StoreController@meals_label');

    Route::POST('/distributed_meals/{id}', 'StoreController@distributed_meals');
    route::any('/driver_manger_view', 'StoreController@driver_manger_view')->name('stores.driver_manger_view');
    Route::POST('/assign_driver/{id}', 'StoreController@assign_driver');
    route::get('/productout', 'StoreController@productout');

    //===============================accounts
    route::resource('accounts', 'AccountController');
    route::resource('entries', 'EntryController');
    Route::get('/posted/{id}', 'EntryController@posted')->name('entries.posted');
    Route::get('statement/{id}', 'AccountController@statement')->name('accounts.statement');
    Route::get('statements', 'AccountController@statements')->name('accounts.statements');

    Route::get('/trial_balance', 'BalanceController@trial_balance')->name('accounts.trial_balance');

    Route::group(['prefix' => 'entries'], function () {

        // Route::get('filter', ['as' => 'entries.filter', 'uses' => 'EntryController@filter']);
        Route::get('posting/{id}', ['as' => 'entries.posting', 'uses' => 'EntryController@posting']);
        Route::get('toAccounts/{id}', ['as' => 'entries.toAccounts', 'uses' => 'EntryController@toaccounts']);

    });
});

Auth::routes();


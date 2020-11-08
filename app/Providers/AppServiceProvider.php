<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\PurchaseItem;
use App\Models\SaleItem;
use App\Observers\AccountObserver;
use App\Observers\PurchaseItemObserver;
use App\Observers\SaleItemObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        PurchaseItem::observe(PurchaseItemObserver::class);
        SaleItem::observe(SaleItemObserver::class);
        Account::observe(AccountObserver::class);


    }
}

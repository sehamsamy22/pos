<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Client;
use App\Models\Entry;
use App\Models\EntryAccount;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Supplier;
use App\Observers\AccountObserver;
use App\Observers\ClientObsever;
use App\Observers\EntryAccountObserver;
use App\Observers\EntryObserver;
use App\Observers\PurchaseItemObserver;
use App\Observers\PurchaseObserver;
use App\Observers\SaleItemObserver;
use App\Observers\SaleObserver;
use App\Observers\SupplierObsever;
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
        Entry::observe(EntryObserver::class);
        Client::observe(ClientObsever::class);
        Supplier::observe(SupplierObsever::class);
        Sale::observe(SaleObserver::class);
        Purchase::observe(PurchaseObserver::class);
        EntryAccount::observe(EntryAccountObserver::class);

    }
}

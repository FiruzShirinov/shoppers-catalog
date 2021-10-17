<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Shopper;
use App\Models\Purchase;
use App\Observers\ProductObserver;
use App\Observers\ShopperObserver;
use App\Observers\PurchaseObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Shopper::observe(ShopperObserver::class);
        Product::observe(ProductObserver::class);
        Purchase::observe(PurchaseObserver::class);
    }
}

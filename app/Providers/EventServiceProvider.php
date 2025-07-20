<?php

namespace App\Providers;

use App\Events\SubscriptionRenewed;
use App\Listeners\HandleSubscriptionRenewalNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SubscriptionRenewed::class => [
            HandleSubscriptionRenewalNotification::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}

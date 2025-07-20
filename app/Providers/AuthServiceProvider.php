<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Subscription;
use App\Policies\SubscriptionPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Subscription::class => SubscriptionPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
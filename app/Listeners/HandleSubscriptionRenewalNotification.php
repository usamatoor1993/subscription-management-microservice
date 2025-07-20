<?php

namespace App\Listeners;

use App\Events\SubscriptionRenewed;
use App\Jobs\SendNotificationJob;

class HandleSubscriptionRenewalNotification
{
    public function handle(SubscriptionRenewed $event): void
    {
        dispatch(new SendNotificationJob($event->subscription));
    }
}

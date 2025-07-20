<?php

use App\Models\Subscription;
use App\Jobs\SendReminderJob;
use App\Jobs\RenewSubscriptionJob;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schedule;

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Subscription scheduler for for microservice
Schedule::call(function () {
    $targetDate = Carbon::now()->addDays(3);

    $subscriptions = Subscription::whereDate('end_date', $targetDate)
        ->where('is_active', true)
        ->get();

    foreach ($subscriptions as $subscription) {
        dispatch(new SendReminderJob($subscription));

        if ($subscription->auto_renew) {
            dispatch(new RenewSubscriptionJob($subscription));
        }
    }
})->daily();
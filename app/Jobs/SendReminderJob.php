<?php

namespace App\Jobs;

use App\Models\Subscription;
use App\Notifications\SubscriptionReminderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

class SendReminderJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Subscription $subscription) {}

    public function handle(): void
    {
        $user = $this->subscription->user;

        // Send reminder notification
        $user->notify(new SubscriptionReminderNotification($this->subscription));
    }
}

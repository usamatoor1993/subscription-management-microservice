<?php

namespace App\Jobs;

use App\Models\Subscription;
use App\Models\NotificationLog;
use App\Notifications\SubscriptionRenewedNotification;
use App\Enums\NotificationTypeEnum;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Subscription $subscription) {}

    public function handle(): void
    {
        $user = $this->subscription->user;

        // Send renewal success notification
        $user->notify(new SubscriptionRenewedNotification($this->subscription));

        // Log notification
        NotificationLog::create([
            'user_id'         => $user->id,
            'subscription_id' => $this->subscription->id,
            'type'            => NotificationTypeEnum::RENEWAL->value,
            'message'         => 'Renewal notification sent',
            'sent_at'         => now(),
        ]);
    }
}

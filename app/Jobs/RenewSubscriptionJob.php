<?php

namespace App\Jobs;

use App\Models\Subscription;
use App\Models\RenewalLog;
use App\Enums\RenewalStatusEnum;
use App\Events\SubscriptionRenewed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Throwable;

class RenewSubscriptionJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Subscription $subscription) {}

    public function handle(): void
    {
        try {
            // Simulate payment success and update subscription
            $this->subscription->update([
                'end_date' => Carbon::parse($this->subscription->end_date)->addMonth(),
            ]);

            // Log success
            RenewalLog::create([
                'subscription_id' => $this->subscription->id,
                'status'          => RenewalStatusEnum::SUCCESS->value,
                'run_at'          => now(),
                'message'         => 'Auto-renewal successful.',
            ]);

            // Fire event for listener to handle notification
            event(new SubscriptionRenewed($this->subscription));

        } catch (Throwable $e) {
            // Log failure
            RenewalLog::create([
                'subscription_id' => $this->subscription->id,
                'status'          => RenewalStatusEnum::FAILED->value,
                'run_at'          => now(),
                'message'         => $e->getMessage(),
            ]);
        }
    }
}

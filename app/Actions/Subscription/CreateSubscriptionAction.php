<?php

namespace App\Actions\Subscription;

use App\Models\Subscription;
use Illuminate\Support\Carbon;


class CreateSubscriptionAction
{
   public function handle(
        int $userId,
        string $planName,
        bool $autoRenew = false
    ): Subscription {
        return Subscription::create([
            'user_id'    => $userId,
            'plan_name'  => $planName,
            'start_date' => Carbon::now(),
            'end_date'   => Carbon::now()->addMonth(),
            'is_active'  => true,
            'auto_renew' => $autoRenew,
        ]);
    }
}
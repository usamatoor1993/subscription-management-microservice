<?php

namespace App\Actions\Subscription;

use App\Models\Subscription;
use Illuminate\Support\Carbon;


class CreateSubscriptionAction
{
   public function handle(array $data): Subscription
    {
        return Subscription::create([
            'user_id'     => $data['user_id'],
            'plan_name'   => $data['plan_name'],
            'start_date'  => Carbon::now(),
            'end_date'    => Carbon::now()->addMonth(),
            'is_active'   => true,
            'auto_renew'  => $data['auto_renew'] ?? false,
        ]);
    }
}
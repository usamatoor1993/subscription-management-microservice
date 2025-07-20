<?php

namespace App\Events;

use App\Models\Subscription;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class SubscriptionRenewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Subscription $subscription) {}
}

<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subscription;
use App\Enums\UserRoleEnum;

class SubscriptionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === UserRoleEnum::ADMIN;
    }

    public function view(User $user, Subscription $subscription): bool
    {
        return $user->id === $subscription->user_id || $user->role === UserRoleEnum::ADMIN;
    }
}

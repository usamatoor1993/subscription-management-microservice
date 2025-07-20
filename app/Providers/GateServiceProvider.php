<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Enums\UserRoleEnum;

class GateServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('admin-only', fn ($user) => $user->role === UserRoleEnum::ADMIN->value);
    }
}

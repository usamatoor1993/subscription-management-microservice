<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subscription;
use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // 👤 Create Admin
        $admin = User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password'),
            'role'     => UserRoleEnum::ADMIN->value,
        ]);

        // 👤 Create Regular User
        $user = User::create([
            'name'     => 'Test User',
            'email'    => 'user@example.com',
            'password' => Hash::make('password'),
            'role'     => UserRoleEnum::USER->value,
        ]);

        // 📦 Create Subscriptions for User
        Subscription::create([
            'user_id'    => $user->id,
            'plan_name'  => 'Basic Plan',
            'start_date' => now(),
            'end_date'   => now()->addDays(10),
            'is_active'  => true,
            'auto_renew' => true,
        ]);

        Subscription::create([
            'user_id'    => $user->id,
            'plan_name'  => 'Expired Plan',
            'start_date' => now()->subMonths(2),
            'end_date'   => now()->subMonth(),
            'is_active'  => false,
            'auto_renew' => false,
        ]);
    }
}

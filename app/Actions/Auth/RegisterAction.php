<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRoleEnum;

class RegisterAction
{
    public function handle(string $name, string $email, string $password): array
    {
        $user = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
            'role'     => UserRoleEnum::USER->value, // default role
        ]);

        $token = $user->createToken('API Token')->plainTextToken;

        return compact('user', 'token');
    }
}
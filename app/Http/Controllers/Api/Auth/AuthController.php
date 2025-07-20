<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Actions\Auth\RegisterAction;
use App\Actions\Auth\LoginAction;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterAction $action)
    {
        $result = $action->handle(
            name: $request->name,
            email: $request->email,
            password: $request->password
        );

        return $this->successResponse($result, 'Registered successfully');
    }

    public function login(LoginRequest $request, LoginAction $action)
    {
        $result = $action->handle(
            email: $request->email,
            password: $request->password
        );

        return $this->successResponse($result, 'Login successful');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse(null, 'Logged out successfully');
    }
}

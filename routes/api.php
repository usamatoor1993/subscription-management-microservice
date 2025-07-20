<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Subscription\SubscriptionController;

// Public auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected API routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // ✅ 2. User subscribes to a plan
    Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);

    // ✅ 3. Authenticated user views active subscriptions
    Route::get('/user/subscriptions', [SubscriptionController::class, 'userSubscriptions']);

    // ✅ 1. List all subscriptions (admin only)
    Route::get('/subscriptions', [SubscriptionController::class, 'allSubscriptions']);
});

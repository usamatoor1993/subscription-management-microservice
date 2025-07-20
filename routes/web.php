<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-firebase-notifications', [AuthenticationController::class, 'testFirebaseNotifications']);
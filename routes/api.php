<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\PhoneCallController;
use Illuminate\Support\Facades\Route;

Route::post('/chat', [ChatController::class, 'handle']);
Route::post('/vapi/webhook', [PhoneCallController::class, 'webhook']);

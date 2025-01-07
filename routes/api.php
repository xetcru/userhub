<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiUserController;

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('users', ApiUserController::class);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;

Route::post('/login', [AuthController::class, 'login']);

//10 requests per minute
Route::middleware(['auth:sanctum', 'throttle:10,1'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('authors', AuthorController::class);

    Route::post('/logout', [AuthController::class, 'logout']);
});


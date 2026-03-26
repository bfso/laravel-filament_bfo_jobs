<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("api")->group(function () {

    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

     Route::middleware('auth:web')->group(function () {
        Route::get('/auth/me', [AuthController::class, 'me']);

        Route::apiResource('jobs', JobController::class)->except(['index', 'show']);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('locations', LocationController::class);
     });

     Route::get("/public/jobs",[JobController::class, "publicIndex"]);
     Route::get("/public/jobs/{job}", [JobController::class, "show"]);
});

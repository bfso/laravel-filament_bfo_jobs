<?php

use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jobs/test', [JobApplicationController::class, 'testPage']);
Route::post('/jobs/{job}/apply', [JobApplicationController::class, 'applyWeb']);

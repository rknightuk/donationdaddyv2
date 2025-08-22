<?php

use App\TiltifyClient;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('api/campaigns', \App\Http\Controllers\TiltifyController::class . '@campaigns');
Route::get('api/campaign', \App\Http\Controllers\TiltifyController::class . '@campaign');
Route::get('api/relay', \App\Http\Controllers\TiltifyController::class . '@relay');

// legacy
Route::get('sj.php', \App\Http\Controllers\TiltifyController::class . '@embed');

Route::get('api/clear', \App\Http\Controllers\TiltifyController::class . '@clearCache');

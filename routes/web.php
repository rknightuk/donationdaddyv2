<?php

use App\Http\Controllers\DaddyController;
use App\Http\Controllers\TiltifyController;
use Illuminate\Support\Facades\Route;

Route::get('/', DaddyController::class . '@home');

Route::domain('donationdaddy.rknight.me', DaddyController::class . '@home');
Route::domain('coinme.dad', DaddyController::class . '@coin');
Route::domain('coin.rknight.me', DaddyController::class . '@coin');
Route::domain('deskmat.help', DaddyController::class . '@deskmat');
Route::domain('donationtreats.rknight.me', DaddyController::class . '@treats');
Route::domain('septembed.rknight.me', DaddyController::class . '@septembed');
Route::domain('hathelp.rknight.me', DaddyController::class . '@bag');
Route::domain('baghelp.rknight.me', DaddyController::class . '@bag');

Route::get('api/campaigns', TiltifyController::class . '@campaigns');
Route::get('api/campaign', TiltifyController::class . '@campaign');
Route::get('api/relay', TiltifyController::class . '@relay');

// legacy
Route::get('sj.php', TiltifyController::class . '@embed');

Route::get('api/clear', TiltifyController::class . '@clearCache');

<?php

use App\Http\Controllers\DaddyController;
use App\Http\Controllers\TiltifyController;
use Illuminate\Support\Facades\Route;

Route::get('/', DaddyController::class . '@home');

Route::domain('donationdaddy.rknight.me', DaddyController::class . '@home');

Route::domain('/coin', DaddyController::class . '@coin');
Route::domain('coinme.dad', DaddyController::class . '@coin');
Route::domain('coin.rknight.me', DaddyController::class . '@coin');

Route::domain('/deskmat', DaddyController::class . '@deskmat');
Route::domain('deskmat.help', DaddyController::class . '@deskmat');

Route::domain('donationtreats.rknight.me', DaddyController::class . '@treats');

Route::domain('septembed', DaddyController::class . '@septembed');
Route::domain('septembed.rknight.me', DaddyController::class . '@septembed');
Route::get('sj.php', TiltifyController::class . '@embed');

Route::domain('/bag', DaddyController::class . '@bag');
Route::domain('hathelp.rknight.me', DaddyController::class . '@bag');
Route::domain('baghelp.rknight.me', DaddyController::class . '@bag');

Route::get('api/campaigns', TiltifyController::class . '@campaigns');
Route::get('api/campaign', TiltifyController::class . '@campaign');
Route::get('api/relay', TiltifyController::class . '@relay');

Route::get('api/clear', TiltifyController::class . '@clearCache');

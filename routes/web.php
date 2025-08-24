<?php

use App\Http\Controllers\DaddyController;
use App\Http\Controllers\TiltifyController;
use Illuminate\Support\Facades\Route;

Route::domain('coinme.dad')->group(function () {
    Route::get('/', DaddyController::class . '@coin');
});

Route::domain('coin.rknight.me', DaddyController::class . '@coin');

Route::get('/', DaddyController::class . '@home');

Route::get('/coin', DaddyController::class . '@coin');

Route::get('/deskmat', DaddyController::class . '@deskmat');
Route::domain('deskmat.help', DaddyController::class . '@deskmat');

Route::get('/treats', DaddyController::class . '@home');
Route::domain('donationtreats.rknight.me', DaddyController::class . '@home');

Route::get('/septembed', DaddyController::class . '@septembed');
Route::domain('septembed.rknight.me', DaddyController::class . '@septembed');
Route::get('/sj', TiltifyController::class . '@embed');

Route::get('/backpack', DaddyController::class . '@bag');
Route::domain('hathelp.rknight.me', DaddyController::class . '@bag');
Route::domain('backpackhelp.rknight.me', DaddyController::class . '@bag');

Route::get('api/campaigns', TiltifyController::class . '@campaigns');
Route::get('api/campaign', TiltifyController::class . '@campaign');
Route::get('api/relay', TiltifyController::class . '@relay');

Route::get('api/clear', TiltifyController::class . '@clearCache');

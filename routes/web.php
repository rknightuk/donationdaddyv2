<?php

use App\Http\Controllers\DaddyController;
use App\Http\Controllers\TiltifyController;
use Illuminate\Support\Facades\Route;

Route::domain('coinme.dad')->group(function () {
    Route::get('/', DaddyController::class . '@coin');
    Route::get('/dy', DaddyController::class . '@coin');
});

Route::domain('coin.rknight.me')->group(function () {
    Route::get('/', DaddyController::class . '@coin');
    Route::get('/dy', DaddyController::class . '@coin');
});

Route::domain('deskmat.help')->group(function () {
    Route::get('/', DaddyController::class . '@deskmat');
});

Route::domain('donationtreats.rknight.me')->group(function () {
    Route::get('/', DaddyController::class . '@treats');
});

Route::domain('septembed.rknight.me')->group(function () {
    Route::get('/', DaddyController::class . '@septembed');
});

Route::domain('hathelp.rknight.me')->group(function () {
    Route::get('/', DaddyController::class . '@bag');
});

Route::domain('backpackhelp.rknight.me')->group(function () {
    Route::get('/', DaddyController::class . '@bag');
});

Route::get('/', DaddyController::class . '@home');
Route::get('/coin', DaddyController::class . '@coin');

Route::get('/deskmat', DaddyController::class . '@deskmat');

Route::get('/treats', DaddyController::class . '@treats');

Route::get('/leaderboard', DaddyController::class . '@leaderboard');

Route::get('/septembed', DaddyController::class . '@septembed');
Route::get('/sj', TiltifyController::class . '@embed');

Route::get('/backpack', DaddyController::class . '@bag');

Route::get('api/campaigns', TiltifyController::class . '@campaigns');
Route::get('api/campaign', TiltifyController::class . '@campaign');
Route::get('api/relay', TiltifyController::class . '@relay');

Route::get('api/rewards', TiltifyController::class . '@fetchRewards');

Route::get('api/clear', TiltifyController::class . '@clearCache');

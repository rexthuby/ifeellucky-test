<?php

use App\Http\Controllers\AccessKeyController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::post('/register', RegisterController::class);
    Route::middleware('validate.access.key')->group(function (){
        Route::post('/access-key', [AccessKeyController::class, 'show']);
        Route::put('/access-key',[AccessKeyController::class, 'update']);
        Route::delete('/access-key',[AccessKeyController::class, 'destroy']);
        Route::post('/game-history', [GameController::class, 'index']);
        Route::post('/lucky-game', [GameController::class, 'luckyGame']);
    });
});

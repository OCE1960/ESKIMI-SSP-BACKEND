<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.')->prefix('v1')->group(function () {
    Route::get('/campaign', [App\Http\Controllers\AdvertisingCampaignController::class, 'index']);
    Route::post('/campaign', [App\Http\Controllers\AdvertisingCampaignController::class, 'store']);
    Route::get('/campaign/{id}', [App\Http\Controllers\AdvertisingCampaignController::class, 'show']);
    Route::get('/campaign/view/{id}', [App\Http\Controllers\AdvertisingCampaignController::class, 'viewCampaign']);
    Route::put('/campaign/{id}', [App\Http\Controllers\AdvertisingCampaignController::class, 'update']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

<?php

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\Geolocation\CountriesController;
use Modules\Core\Http\Controllers\Security\OtpController;

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

Route::prefix("/geolocation")->group(function () {
    Route::get("/countries", [CountriesController::class, "index"]);
});

Route::middleware('auth:sanctum')->prefix("/security")->group(function () {
    Route::post("/otp", [OtpController::class, "create"]);

    Route::post("/otp/validate", [OtpController::class, "validate"]);
});
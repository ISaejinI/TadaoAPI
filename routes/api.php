<?php

use App\Http\Controllers\API\RouteController;
use App\Http\Controllers\API\StopController;
use App\Http\Controllers\API\TripController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("routes", RouteController::class);
Route::get("/routes/{route}/trips",[RouteController::class, "trips"]);

Route::apiResource("stops", StopController::class);

Route::apiResource("trips", TripController::class);
Route::get('/trips/{trip}/route',[TripController::class, 'routes']);
Route::get("/trips/{trip}/stops",[TripController::class, 'stops']);
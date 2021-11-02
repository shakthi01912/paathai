<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Point CRUD
Route::get("getPoints",[PointController::class,'getAllPoints']);
Route::post("addPoint",[PointController::class,'addPoint']);
Route::put("updatePoint",[PointController::class,'updatePointById']);


//Route CRUD
Route::get("getRoutes",[RouteController::class,'getAllRoutes']);
Route::post("addRoute",[RouteController::class,'addRoute']);
Route::put("updateRoute",[RouteController::class,'updateRouteById']);
Route::delete("deleteRoute",[RouteController::class,'deleteRoute']);


Route::get("getRoute",[PointController::class,'getRoute']);
Route::get("getRouteForUser",[PointController::class,'getRouteForUser']);


Route::delete("deleteRouteAdmin",[RouteController::class,'deleteRouteById']);
Route::post("forgetPasswordOTP",[userController::class,'forgetPasswordOTP']);
Route::put("forgetPasswordOTPValidation",[userController::class,'forgetPasswordOTPValidation']);

//User function
Route::post("login",[UserController::class,'login']);

Route::group(['middleware' => 'auth:sanctum'], function(){

Route::put("changePassword",[UserController::class,'changePassword']);

    });




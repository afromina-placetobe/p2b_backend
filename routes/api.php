<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\eventController;
use App\Http\Controllers\API\userController;
use App\Http\Controllers\API\followController;
use App\Http\Controllers\API\AuthController;
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
Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('logout', [AuthController::class,'logout']);


Route::post('addEvent', [eventController::class,'addEvent']);
Route::put('editEvent', [eventController::class,'editEvent']);
Route::delete('deleteEvent', [eventController::class,'deleteEvent']);
Route::get('showSingleEvent', [eventController::class,'showSingleEvent']);
Route::get('approvedEvent', [eventController::class,'approvedEvent']);
Route::get('pendingEvent', [eventController::class,'pendingEvent']);
Route::get('declinedEvent', [eventController::class,'declinedEvent']);
Route::get('upcomingEvent', [eventController::class,'upcomingEvent']);
Route::get('expiredEvent', [eventController::class,'expiredEvent']);
Route::get('latestEvent', [eventController::class,'latestEvent']);
Route::put('publishEvent', [eventController::class,'publishEvent']);

Route::post('addFollow', [followController::class,'addFollow']);
Route::put('editFollow', [followController::class,'editFollow']);
Route::delete('deleteFollow', [followController::class,'deleteFollow']);
Route::get('showFollow', [followController::class,'showFollow']);

Route::post('addUser', [userController::class,'addUser']);
Route::put('editUser', [userController::class,'editUser']);
Route::delete('deleteUser', [userController::class,'deleteUser']);
Route::get('showSingleUser', [userController::class,'showSingleUser']);
Route::get('showUser', [userController::class,'showUser']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

<?php

use App\Http\Controllers\API\V1\FoodController;
use App\Http\Controllers\API\V1\OrderController;
use App\Http\Controllers\API\V1\UserController;
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

Route::group(['prefix' => 'v1', 'namespace' => 'API\V1'], function () {
    Route::get('menu', [FoodController::class, 'menu']);

    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
   
    Route::post('order', [OrderController::class, 'store']);
    Route::post('change/status', [OrderController::class, 'changeStatus']);
    Route::post('/user/food/history', [OrderController::class, 'getFoodHistory']);
});

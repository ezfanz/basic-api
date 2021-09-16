<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\RoleController;

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

//REGISTER
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){

    //POST API
    Route::apiResource('posts', PostApiController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);

    Route::apiResource('user', UserApiController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);

    Route::post('/logout', [AuthController::class, 'logout']);

});





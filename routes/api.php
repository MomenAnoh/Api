<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Tymon\JWTAuth\Facades\JWTAuth;

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
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware('auth:api')->post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');

});

Route::get('/posts',[PostController::class,'index']);
Route::get('/onepost/{id}',[PostController::class,'show']);
Route::post('/store',[PostController::class,'store']);
Route::post('/update_posts/{id}',[PostController::class,'update']);
Route::get('/delete_post/{id}',[PostController::class,'destory']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

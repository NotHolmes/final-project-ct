<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return [
        'version' => '1.0.0'
    ];
});
Route::apiResource('/users' , \App\Http\Controllers\Api\UserController::class);

Route::apiResource('/contacts' , \App\Http\Controllers\Api\ContactController::class);
Route::get('/conversation/{email}' , [\App\Http\Controllers\Api\ContactController::class,'getMessagesFor']);
Route::post('/conversation/send', [\App\Http\Controllers\Api\ContactController::class,'send']);

// post/search
Route::get('/posts/search', [\App\Http\Controllers\Api\PostController::class, 'search']);
Route::apiResource('/posts', \App\Http\Controllers\Api\PostController::class)->middleware('auth:api');

Route::apiResource('/categories', \App\Http\Controllers\Api\CategoryController::class);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('update', [AuthController::class, 'update']);
});

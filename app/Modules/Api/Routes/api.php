<?php

use Illuminate\Http\Request;
use Modules\Api\Http\Controllers\AuthController;

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

Route::get('/get-token', [AuthController::class,'getToken']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/test',function(){
        return 'hello world';
    });
});

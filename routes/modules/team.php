<?php

use App\Http\Controllers\Api\Users\UsersController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api']], function () {
    
    Route::group(['prefix' => 'team'], function () {
        Route::get('/', [UsersController::class,'index']);
        Route::post('/', [UsersController::class,'store']);
        Route::get('/{id}', [UsersController::class,'show']);
        Route::put('/{id}', [UsersController::class,'update']);
        Route::patch('/{id}', [UsersController::class,'update']);
        Route::delete('/{id}', [UsersController::class,'destroy']);
    });
    
    
});

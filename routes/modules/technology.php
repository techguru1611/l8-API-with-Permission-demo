<?php

use App\Http\Controllers\Api\Masters\TechnologyController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api']], function () {
    
    Route::group(['prefix' => 'technology'], function () {
        Route::get('/', [TechnologyController::class,'index']);
        Route::post('/', [TechnologyController::class,'store']);
        Route::get('/{id}', [TechnologyController::class,'show']);
        Route::get('/{id}/edit', [TechnologyController::class,'edit']);
        Route::patch('/{id}', [TechnologyController::class,'update']);
        Route::delete('/{id}', [TechnologyController::class,'destroy']);
    });
    
    
});

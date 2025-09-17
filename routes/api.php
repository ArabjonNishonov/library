<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RentController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('user')->group(function(){
        Route::get('/', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
    Route::prefix('author')->group(function(){
        Route::prefix('books')->group(function(){
            Route::get('/', [AuthorController::class, 'index']);
            Route::get('{book}', [AuthorController::class, 'show']);
            Route::post('/', [AuthorController::class, 'store']);
            Route::put('{book}', [AuthorController::class, 'update']);
            Route::put('change-status/{book}', [AuthorController::class, 'changeStatus']);
            Route::delete('{book}', [AuthorController::class, 'delete']);
        });
        Route::prefix('rents')->group(function(){
            Route::get('/', [RentController::class, 'index']);
            Route::get('{rent}', [RentController::class, 'rentBook']);
            Route::get('expireds', [RentController::class, 'expireds']);
            Route::get('expireds/{rent}', [RentController::class, 'expiredBook']);
        });
    });
    Route::prefix('client')->group(function(){
        Route::prefix('books')->group(function(){
            Route::get('/', [BookController::class, 'index']);
            Route::get('{book}', [BookController::class, 'show']);
        });
        Route::prefix('rents')->group(function(){
            Route::get('/', [ClientController::class, 'rentBooks']);
            Route::get('{book}', [ClientController::class, 'rentBookId']);
            Route::post('/', [ClientController::class, 'addRentBook']);
            Route::put('restore', [ClientController::class, 'restore']);
            Route::get('expireds', [ClientController::class, 'expireds']);
            Route::get('expireds/{rent}', [ClientController::class, 'expiredBook']);
        });
    });
});

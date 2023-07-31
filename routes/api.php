<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersTodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');
});

Route::middleware('auth:api')->group(function() {
    Route::get('/todos', [UsersTodoController::class, 'list']);
    Route::post('/todos', [UsersTodoController::class, 'add']);
    Route::post('/todos/{todoId}', [UsersTodoController::class, 'update']);
    Route::delete('/todos/{todoId}', [UsersTodoController::class, 'delete']);
});


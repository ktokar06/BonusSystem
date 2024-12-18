<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BonusController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\AccountController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');









					//<<<API>>>\\
# группа маршрутов для транзакций
Route::apiResource('transaction', TransactionController::class);

# группа маршрутов для аккаунтов
Route::apiResource('account',     AccountController::class);

# группа маршрутов для бонусов
Route::apiResource('bonus',       BonusController::class);
Route::get('getBalance/{id}',    [AccountController::class, 'show']);

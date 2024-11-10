<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Session;



Route::post('/userLogin', [UserController::class, 'login'])
	  ->name("UserLogin");

Route::post('/sendBonuses', [UserController::class, 'sendBonuses'])
	  ->name("BonusSend");


Route::get('/home', [UserController::class, 'openHome'])->name("HomePage");
Route::get('/', [UserController::class, 'openLogin'])->name("LoginPage");


Route::get('/game', function () {
	return view('randomGame')->with('accountId', Session::get("accountId"));
})->name("GamePage");


Route::post('/gameResult', function () {
	return view('result');
})->name("ResultPage");

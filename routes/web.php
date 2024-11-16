<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\AccountAuth;


Route::post('/userLogin', [UserController::class, 'login'])
	  ->name("UserLogin");

Route::post('/sendBonuses', [UserController::class, 'sendBonuses'])
	  ->name("BonusSend");




Route::get('/home', [UserController::class, 'openHome'])
//	->middleware(AccountAuth::class)	
	->name("HomePage");

Route::get('/game', [UserController::class, 'openGame'])
//	->middleware(AccountAuth::class)	
	->name("GamePage");

Route::get('/reg',  function() {
	return view("Reg");
})->name("RegPage");

Route::get('/', [UserController::class, 'openLogin'])->name("LoginPage");





/*
Route::get('/game', function () {
	return view('game');
})->name("GamePage");
 */


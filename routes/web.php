<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('Login');
})->name("LoginPage");

Route::post('/userLogin', [UserController::class, 'login'])
	  ->name("UserLogin");


Route::get('/home', function () {
	return view('Home');
})->name("HomePage");



Route::get('/registration', function () {
	return view('Registration');
})->name("RegPage");


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
	/*
	 * Контроллер для управления сессией пользователя
	 */

	public function login(Request $request)
	{
		$data  = $request->all();	

		$login = $data['login']; 
		$pass  = $data['password']; 
		
		$key     = "$login:$pass";
		$authKey = hash('sha256', $key);			
		

		$response = Http::withHeaders([
			'authkey'=>"$authKey"	
		])->get(url('/').'/api/account');	


		if (!$response->ok()) {
			return redirect('/')
				->with('error', $response->body());
		};
	

		$accId = $response[0]['id'];
		session()->push('accountId', "$accId");	
		
		return redirect()->route('HomePage');	
	}

	public function checkLogIn()
	{
		if (!session('accountId')){
			redirect('/')
				->with('error', 'Сначала войдите, чтобы получить доступ к этой странице');
		}
	}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

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

		Session::put('accountId', $accId);

		return redirect()->route('HomePage');
	}

	public function openHome()
	{
		$accId = Session::get('accountId');

		if (!$accId){
			return redirect('/')
				->with('error', 'Сначала войдите, чтобы получить доступ к этой странице');
		}

		return view('Home', ['accountId' => "$accId"]);
	}

	public function openLogin()
	{
		Session::forget('accountId');

		return view('Login');
	}

	public function unLogIn()
	{
		if (session()->has('accountId')) {
			session()->forget('accountId');
			return route('LoginPage');		
		}
	}

	public function getBonuses($id)
	{
		$response = Http::withHeaders([
			'accountId' => $id
		])->get(url('/').'/api/bonus');
		
		
		if (!$response->ok()) {
			return redirect('/')
				->with('error', $response->body());
		}
		
		$bonusCount = $response[0]['value'];
		return $bonusCount;
	}

	
	public function getTransactions($id)
	{
		$response = Http::withHeaders([
			'accountId' => $id,
			'limit'     => 5
		])->get(url('/').'/api/transaction');
		
		
		if (!$response->ok()) {
			return redirect('/')
				->with('error', $response->body());
		}

		return $response;
	}

	public function sendBonuses(Request $request)
	{
		$data = $request->all();	

		$senderId = $data['senderId'];		
		$recipientId = $data['recipientId'];
		$value       = $data['amount'];
		
		$response =  Http::post(url('/').'/api/bonus', [
			'senderId'    => "$senderId",
			'recipientId' => "$recipientId",
			'value'       => "$value",
		]);	
			
		if (!$response->ok()) {
			return redirect('/home')
				->with("accountId", "$senderId")
			    ->with("error", $response->body());
		}

		return redirect('/home')
			->with("accountId", "$senderId");
	}
}

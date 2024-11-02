<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
		
		$headers = $request->header();
		
		$loginError    = response('Invalid login field',    400)
			->header('Content-type', 'text/plain'); 
		$passwordError = response('Invalid password field', 400)
			->header('Content-type', 'text/plain'); 


		if (!$login = $request->header('login')) {
			return $loginError;	
		} else if ($password = $request->header('password')){
			return $passwordError;	
		}

		$password = hash('sha256', $password);

		$accountId = DB::select("SELECT id FROM accounts WHERE login = '$login' AND password = '$password'");
	
		return $accountId;	
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
    }
}

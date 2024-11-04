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

		/*
		 * Возвращает айди аккаунта по его ключю авторизации
		 */

		$key = $request->header('authkey');

		if (!$key) {
			return response('Authkey required', 422)
				->header('Content-type', 'text/plain');	
		}

		$query     = "SELECT (id) FROM accounts WHERE authkey='$key'";
		$accountId = DB::select($query);
		
		if (!$accountId){
			return response('Invalid authkey', 422)
				->header('Content-type', 'text/plain');
		}
	
		return $accountId;	
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
	{
		/*
		 * Создаёт нового пользователя в бд
		 */
		
        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)	
	{
		/*
		 * Возвращает балансы пользователя
		 */	
		
		$id        = $account['id'];
		$query     = "SELECT * FROM user_balance WHERE \"accountId\" = '$id'";
		$balances  = DB::select($query);

		if (!$balances) {
			return response('No balances', 422)
				->header('Content-type', 'text/plain');
		}		
			
		return $balances;	
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

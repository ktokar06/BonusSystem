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
		
		/*
		 * Ожидает запрос типа:
		 * POST 
		 * -H 'Accept: application/json'
		 * -H 'Content-type: application/json'
		 * --data '{"login":    "loginTest",
		 *          "password": "passwordTest",
		 *          "type":     "физ"}'
		 */


		$data  = $request->all();	
		
		$login = $data['login'   ];	
		$pass  = $data['password'];	
		$type  = $data['type'    ];

		$key   = "$login:$pass";

		$hashPass = hash('sha256', $pass); 	
		$hashKey  = hash('sha256', $key );	
		
		// Generating accounId
		do { 
    		$word = array_merge(range('a', 'z'), range('A', 'Z'));
    		shuffle($word);
			$accId = substr(implode($word), 0, 16);

		} while (DB::select("SELECT * FROM accounts WHERE id = '$accId'"));	
		
		$query = "INSERT INTO accounts (id, login, password, authkey, type)
			      values (?, ?, ?, ?, ?)";
		
		$isAdded = DB::insert($query, [$accId, $login, $hashPass, $hashKey, $type]);	
		
   		if (!$isAdded) {
			return response('Server error', 500)
                   ->header('Content-type', 'text/plain');	
		} 

		return response('Success', 200)
               ->header('Content-type', 'text/plain');		
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
	 *
    public function update(UpdateAccountRequest $request, Account $account)
    {
        // пока не нужно
    }

    /**
     * Remove the specified resource from storage.
     *
    public function destroy(Account $account)
    {
        // пока не нужно
	}
	*/
}

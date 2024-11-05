<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreBonusRequest;
use App\Http\Requests\UpdateBonusRequest;

use App\Models\Account;
use App\Models\Bonus;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;




class BonusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
		/*
		 * Получить текущую инфомацию по кл-ву 
		 * бонусов у пользователя
		 * если юр лицо возвращает коэффициент
		 */
		
		$accId = $request->header('accountId');	

		$accTypeQuery = "SELECT * FROM accounts WHERE id = '$accId'";
		$accInfo      = DB::select($accTypeQuery);
		
		$accInfoArray = json_decode(json_encode($accInfo), true);
		$accType      = $accInfoArray[0]['type'];
	
		switch ($accType){
			case 'юр':
				$companyCoefQuery = "SELECT (coef) FROM bonus_coefs
					                 WHERE \"companyId\" = '$accId'";
				$companyCoef      = DB::select($companyCoefQuery);	
				
				if (!$companyCoef) {		
					return response('No coef with companyId', 422)
						->header('Content-type', 'text/plain');	
				}
				
				return $companyCoef;

			case 'физ':
				$bonusValueQuery = "SELECT (value) FROM user_balance
									WHERE \"accountId\" = '$accId'
									AND
                                    \"balanceType\" = 'bonus'";
				$bonusValue      = DB::select($bonusValueQuery);	
				
				if (!$bonusValue) {		
					return response('No balance with accountId', 422)
						->header('Content-type', 'text/plain');	
				}
				
				return $bonusValue;	

			default:
				return response('Invalid account id', 422)
					->header('Content-type', 'text/plain');	
		}
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBonusRequest $request)
    {
	   /*
		* Создает транзакцию между пользователями
		* для передачи бонусов
		*/ 
		
		$data = $request->all();

		$senderId    = $data['senderId'   ];		
		$recipientId = $data['recipientId'];

		if ($senderId == $recipientId) {
			return response('Invalid recipientId', 422)
				->header('Content-type', 'text/plain');			
		}

		$value       = $data['value'];

		$senderValue    = $this->getBalance($senderId,    'bonus');	
		$recipientValue = $this->getBalance($recipientId, 'bonus');	

		if ($senderValue < 0) {	
			return response("Sender User not have bonus balance", 422)
				->header('Content-type', 'text/plain');	
		} else if ($recipientValue < 0) {	
			return response("Recipient User not have bonus balance", 422)
				->header('Content-type', 'text/plain');	
		}

		if ($senderValue - $value < 0) {
			return response('Not enough value', 422)
				->header('Content-type', 'text/plain');		
		}
		
		$senderValue    -= $value;
		$recipientValue += $value;	

		DB::statement("UPDATE user_balance SET value = $senderValue
			           WHERE  \"accountId\"='$senderId'");		
		DB::statement("UPDATE user_balance SET value = $recipientValue
			           WHERE  \"accountId\"='$recipientId'");		

		do { 
    		$word = array_merge(range('a', 'z'), range('A', 'Z'));
    		shuffle($word);
			$transactionId = substr(implode($word), 0, 16);

		} while (DB::select("SELECT * FROM transaction
			                 WHERE \"transactionId\" = '$transactionId'"));	

		$query = "INSERT INTO transaction (\"transactionId\",
										   \"senderId\",
										   \"recipientId\",
										   \"currencyType\",
                                             value)
			      values (?, ?, ?, ?, ?)";
		
		DB::insert($query, [$transactionId, $senderId, $recipientId, 'bonus', $value]);	
					
		return response('Success', 200)
			->header('Content-type', 'text/plain');	
    }

	public function getBalance($accountId, $type) {
		
		$balanceQuery = "SELECT * FROM user_balance
				         WHERE \"accountId\" = '$accountId'
                         AND
                         \"balanceType\"='$type'";		

		$balanceInfo = DB::select($balanceQuery);
		
		if (!$balanceInfo) {
			return -1;
		}		

		$balanceArray = json_decode(json_encode($balanceInfo), true);
		$value        = $balanceArray[0]['value'];		
		
		return $value;				
	}


    /**
     * Display the specified resource.
     */
    public function show(Bonus $bonus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBonusRequest $request, $accountBalance)
    {
		/*
		 * Обновить кл-во бонусов у пользователя
		 */		
		$data  = $request->all();

		$addValue = $data['value'];

		$hasBonusBalanceQuery = "SELECT * FROM user_balance 
				                 WHERE \"accountId\"='$accountBalance'
				                 AND
				                 \"balanceType\"='bonus'";

		$hasBonusBalance      = DB::select($hasBonusBalanceQuery);

		if (!$hasBonusBalance) {
			return response('User not have bonus balance', 422)
				->header('Content-type', 'text/plain');	
		}			

		$balanceInfo  = json_decode(json_encode($hasBonusBalance), true);
		$currentValue = $balanceInfo[0]['value'];	
		
		$total        = $addValue + $currentValue;

		DB::statement("UPDATE user_balance SET value = $total");		
	
		return response('Success', 200)
			->header('Content-type', 'text/plain');	
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bonus $bonus)
    {
        //
    }
}

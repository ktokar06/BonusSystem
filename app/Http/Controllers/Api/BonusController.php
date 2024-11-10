<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateBonusRequest;

use App\Models\Account;
use App\Models\Bonus;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;




class BonusController extends Controller
{
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
				
				return response()->json($companyCoef);

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
				
				return response()->json($bonusValue);	

			default:
				return response('Invalid account id', 422)
					->header('Content-type', 'text/plain');	
		}
    }

    public function store(Request $request)
    {
	   /*
		* Создает транзакцию между пользователями
		* для передачи бонусов
		*/ 
		
		$request->merge([
			'currency'=>'bonus'
		]);

        $request = StoreTransactionRequest::createFrom($request);

		return app('App\Http\Controllers\Api\TransactionController')
           ->store($request);
    }

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
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

use App\Models\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
	public function index(Request $request)
	{
		/*
		 * Получение N транзакций 
		 * определенного accountID (пользователя)
		 */
        $limit = $request->header('limit'    );
        $accId = $request->header('accountId');

		$query = "SELECT * FROM transaction 
				  WHERE \"senderId\" = '$accId'
                  LIMIT $limit";
			
		$queryResult = DB::select($query);
		
		if (!$queryResult) {
            return response('Invalid Account Id', 422)
                ->header('Content-type', 'text/plain');         
		}
		
		return response()->json($queryResult);	
    }


    public function store(StoreTransactionRequest $request)
    {
       /*
        * Создает транзакцию между пользователями
        * для передачи валюты
        */  
        $data = $request->all();

        $senderId    = $data['senderId'   ];        
        $recipientId = $data['recipientId'];

        if ($senderId == $recipientId) {
            return response('Invalid recipientId', 422)
                ->header('Content-type', 'text/plain');         
        }

        $value       = $data['value'];
		$curType     = $data['currency'];// currency type


        $senderValue    = $this->getBalance($senderId,    $curType); 
        $recipientValue = $this->getBalance($recipientId, $curType); 

        if (!$senderValue) { 
            return response("Sender User not have $curType balance", 422)
                   ->header('Content-type', 'text/plain'); 
        } else if (!$recipientValue) {   
            return response("Recipient User not have $curType balance", 422)
                   ->header('Content-type', 'text/plain'); 
        }

        if ($senderValue - $value < 0) {
            return response('Not enough sender value', 422)
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
        
		DB::insert($query, [$transactionId,
                            $senderId,
							$recipientId,
							$curType,
							$value]); 
                    
        return response('Success', 200)
            ->header('Content-type', 'text/plain'); 
    }

	public function getBalance($accountId, $type)
	{
		/*
		 * Получение определенного баланса пользователя
		 * по его accountId 
		 * с выбором валюты
		 */		 		
        $query = "SELECT * FROM user_balance
                  WHERE \"accountId\" = '$accountId'
                  AND
                  \"balanceType\"='$type'";      

        $queryResult = DB::select($query);
        
        if (!$queryResult) {
            return false;
        }       

        $balanceArray = json_decode(json_encode($queryResult), true);
        $value        = $balanceArray[0]['value'];      
        
        return $value;              
    }


    public function show(Transaction $transaction)
    {	
		/*
		 * Получение информации о транзакции
		 * по transactionId
		 */	
		
		if (!$transaction) {
            return response('Invalid transactionId', 422)
                   ->header('Content-type', 'text/plain');
		}

		return response()->json($transaction); 
    }
}

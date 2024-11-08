<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index(Request $request)
    {
        $limit_number = $request->header('limit');
        $userId       = $request->header('userId');

        $allTransactions = Transaction::all();

        $sortedTransactions = [];
        foreach ($allTransactions as $transaction) {
            if (isset($transaction['senderId']) && $transaction['senderId'] == $userId) {
                $sortedTransactions[] = $transaction;
            }
        }

        $countTransactions = count($sortedTransactions);
        
        if ($limit_number >= $countTransactions) {
			return response()->json(sortedTransactions);
        }

        $limit = $request->input('limit', $limit_number);
        
        $result = array_slice($sortedTransactions, 0, $countTransactions + 1);

		return response()->json($result); // Incorrect working
    }


    public function store(StoreTransactionRequest $request)
    {
       /*
        * Создает транзакцию между пользователями
        * для передачи денег
        */ 
        
        $data = $request->all();

        $senderId    = $data['senderId'   ];        
        $recipientId = $data['recipientId'];

        if ($senderId == $recipientId) {
            return response('Invalid recipientId', 422)
                ->header('Content-type', 'text/plain');         
        }

        $value       = $data['value'];

        $senderValue    = $this->getBalance($senderId,    'rub'); 
        $recipientValue = $this->getBalance($recipientId, 'rub'); 

        if ($senderValue < 0) { 
            return response("Sender User not have balance", 422)
                ->header('Content-type', 'text/plain'); 
        } else if ($recipientValue < 0) {   
            return response("Recipient User not have balance", 422)
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
        
        DB::insert($query, [$transactionId, $senderId, $recipientId, 'rub', $value]); 
                    
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


    public function show(Transaction $transaction)
    {	
		if (!$transaction) {
            return response('Invalid transactionId', 422)
                   ->header('Content-type', 'text/plain');
		}

		return response()->json($transaction); 
    }

	/*
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }


    public function destroy(Transaction $transaction)
    {
        //
	}

	 */
}

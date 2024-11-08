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
        
        $totalTransactions = Transaction::count();
        
        if ($limit_number >= $totalTransactions) {
			return response()->json(Transaction::all());
        }

        $limit = $request->input('limit', $limit_number);
            
        $transactions = Transaction::limit($limit)->get();

		return response()->json($transactions);
    }


    public function store(StoreTransactionRequest $request)
    {			
		//return $request;	
		//return Transaction::create($request::all());
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

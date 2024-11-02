<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		

		return Transaction::all();

		#return response()->json([
		#	'message'=>'test request works'
		#]);	
		
		#return 'test request works!';
    }

    /**
	 * Store a newly created resource in storage.
	 * Post запрос на создание транзакции
     */
    public function store(StoreTransactionRequest $request)
    {
        return Transaction::create($request::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return $transaction;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}

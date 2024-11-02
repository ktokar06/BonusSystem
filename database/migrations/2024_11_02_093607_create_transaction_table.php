<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->string('transactionId', 16);
            $table->string('senderId',      16);
			$table->string('recipientId',   16);
			$table->enum(  'currencyType',  ['rub', 'bonus']);
		});
		
		Schema::table('transaction', function (Blueprint $table) {
			# Добавление суммы перевода
			DB::Statement('ALTER TABLE transaction ADD COLUMN value real');	
			# Добавление связей ID полей	
			DB::Statement('ALTER TABLE transaction ADD CONSTRAINT accounts_transaction_transactionId_fk FOREIGN KEY ("transactionId") REFERENCES accounts(id)');	
			DB::Statement('ALTER TABLE transaction ADD CONSTRAINT accounts_transaction_senderId_fk FOREIGN KEY ("senderId") REFERENCES accounts(id)');	
			DB::Statement('ALTER TABLE transaction ADD CONSTRAINT accounts_transaction_recipientId_fk FOREIGN KEY ("recipientId") REFERENCES accounts(id)');	
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};

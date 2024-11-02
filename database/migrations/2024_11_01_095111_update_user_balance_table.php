<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserBalanceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
		Schema::table('user_balance', function (Blueprint $table){
			DB::statement('ALTER TABLE user_balance ADD CONSTRAINT users_users_balance_id_fk FOREIGN KEY ("accountId") REFERENCES accounts (id)');
		});	
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

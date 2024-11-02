<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBalance extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_balance', function (Blueprint $table) {
            $table->string('accountId',   16);
			$table->enum(  'balanceType', ['rub', 'bonus']);
		});

		# ларавел не поддерживает флоат
		# костыль
		Schema::table('user_balance', function (Blueprint $table){
			DB::statement('ALTER TABLE user_balance ADD value real');
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_balance');
    }
};

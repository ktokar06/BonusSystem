<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBonusCoefsTable extends Migration
{
    /**
     * Run the migrations.
	 */
	# Добавление связи с accounts
    public function up(): void
    {
		Schema::table('bonus_coefs', function (Blueprint $table) {
			DB::statement('ALTER TABLE bonus_coefs ADD CONSTRAINT accounts_bonus_coefs_id_fk FOREIGN KEY ("companyId") REFERENCES accounts(id)');	
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

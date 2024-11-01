<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
		// Создание таблицы users
		Schema::create('users', function (Blueprint $table) {
			$table->string('id',       16);            //имитация accountID
			$table->string('login',    64);            //логин        пользователя
			$table->string('password', 64);            //имитация хэша
			$table->enum(  'type',     ['юр', 'физ']); //тип аккаунта пользователя
		});	
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
		Schema::dropIfExists('users');	 
    }
};

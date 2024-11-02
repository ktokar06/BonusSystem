<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	//
	//
	//

	protected $table = 'transaction';

	# Наш ID в дб не является инкрементным
	# поэтому отключаем инкрементирование
	protected $keyType      = 'string';
	public    $incrementing = false;
}

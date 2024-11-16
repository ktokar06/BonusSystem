<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class StoreAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Request $request)
	{
		$data  = $request->all();	
		
		$login = $data['login'];	
					
		$query      = "SELECT * FROM accounts WHERE login = '$login'";
		$hasDbLogin = DB::select($query); 	
	
		#login already exists ? 
		return ($hasDbLogin) ? false: true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
		return [
			'name'    =>'bail|required|string',
			'surname' =>'required|string',
			'login'   =>'required|string',
			'password'=>'required|string',
			'phone'   =>'required|string',
        ];
    }
}

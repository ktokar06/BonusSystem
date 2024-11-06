<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
  {
    # Заглушка, в дальнейшем добавить проверку
        return true;
    }

    public function rules()
    {
        return [
            'transactionId'     => 'required|string',
            'senderId'          => 'required|string',
            'recipientId'       => 'required|string',
            'amountOperation'   => 'required|integer',
            'currencyType'      => 'required|string|in:rub,bonus',
        ];
    }

    // /**
    //  * Get the validation rules that apply to the request.
    //  *
    //  * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    //  */
    // public function rules(): array
    // {
    //     return [
    //         'senderId'    => 'required',
    //         'recipientId' => 'required'
    //     ];
    // }
}

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
            'senderId'          => 'required|string',
            'recipientId'       => 'required|string',
            'currency'          => 'required|string|in:rub,bonus',
            'value'             => 'required|integer'
        ];
    }
}

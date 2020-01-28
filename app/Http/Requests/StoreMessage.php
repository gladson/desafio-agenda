<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequest;

class StoreMessage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required', 
            'contacts_id' => 'required|max:255|exists:contacts,id', 
        ];
    }

    /**
     * Get the error messages that apply to the request parameters.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'description.required' => 'Campo descrição é obrigatório.',
            'contacts_id.required' => 'Campo contato é obrigatório.',
            'contacts_id.exists' => 'Este contato não existe na base de dados.'
        ];
    }
}

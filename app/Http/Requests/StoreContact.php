<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequest;

class StoreContact extends FormRequest
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
            'name' => 'required|max:255', 
            'lastname' => 'required|max:255', 
            'email' => 'required|email|max:255', 
            'phone' => 'required|max:255'
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
            'name.required' => 'Campo nome é obrigatório.',
            'lastname.required' => 'Campo sobrenome é obrigatório.',
            'email.required' => 'Campo email é obrigatório.',
            'phone.required' => 'Campo telefone é obrigatório.',
        ];
    }
}

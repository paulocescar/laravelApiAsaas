<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'cpfCnpj' => 'required',
            'mobilePhone' => 'required',
            'email' => 'required',
            'password' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo nome deve ser preenchido.',
            'name.string' => 'Campo nome deve ser texto.',

            'cpfCnpj.required' => 'Campo cpf ou Cnpj deve ser preenchido.',

            'mobilePhone.required' => 'Campo celular deve ser preenchido.',

            'email.required' => 'Campo email deve ser preenchido.',
        ];
    }
}

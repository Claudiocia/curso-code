<?php

namespace pizzaexpress\Http\Requests;

use pizzaexpress\Http\Requests\Request;

class AdminClientRequest extends Request
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
            'user.name' => 'required|min:3',
            'user.email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required|numeric|digits:8',

        ];
    }

    public function messages()
    {
        return [
            'user.name.required' => 'O campo Nome é obrigatório',
            'user.name.min' => "O nome precisa ter pelo menos 3 caracteres",
            'user.email.required' => 'Informe o email do cliente',
            'user.email.email' => 'Informe um email valido',
            'phone.required' => "Informe o número do telefone",
            'phone.numeric' => 'O campo Telefone aceita apenas numeros',
            'address.required' => 'Informe o endereço que é obrigatório',
            'city.required' => 'Informe a cidade do cliente',
            'state.required' => 'Informe o estado do cliente',
            'zipcode.required' => 'Informe o CEP do cliente',
            'zipcode.numeric' => 'O campo CEP aceita apenas numeros',
            'zipcode.digits' => 'O CEP deve ser informado com os 8 digitos',

        ];

    }
}

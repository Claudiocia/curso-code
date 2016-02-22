<?php

namespace pizzaexpress\Http\Requests;

use pizzaexpress\Http\Requests\Request;

class ClientRequest extends Request
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
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'senha' => 'required|min:6',
            'senha' => 'confirmed',
            'client.phone' => 'required|numeric',
            'client.address' => 'required',
            'client.city' => 'required',
            'client.state' => 'required',
            'client.zipcode' => 'required|numeric|digits:8',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é obrigatório',
            'name.min' => "O nome precisa ter pelo menos 3 caracteres",
            'email.required' => 'Informe o email do cliente',
            'email.email' => 'Informe um email valido',
            'email.unique' => 'Este email já está cadastrado',
            'senha.required' => 'Favor preencher a senha',
            'senha.min'  => 'A senha deve ter pelo menos 6 caracteres',
            'senha.confirmed' => 'As senhas digitadas são diferentes',
            'client.phone.required' => "Informe o número do telefone",
            'client.phone.numeric' => 'O campo Telefone aceita apenas numeros',
            'client.address.required' => 'Informe o endereço que é obrigatório',
            'client.city.required' => 'Informe a cidade do cliente',
            'client.state.required' => 'Informe o estado do cliente',
            'client.zipcode.required' => 'Informe o CEP do cliente',
            'client.zipcode.numeric' => 'O campo CEP aceita apenas numeros',
            'client.zipcode.digits' => 'O CEP deve ser informado com os 8 digitos',

        ];

    }
}

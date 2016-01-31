<?php

namespace pizzaexpress\Http\Requests;

use pizzaexpress\Http\Requests\Request;

class AdminProductRequest extends Request
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
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'O campo Nome é obrigatório',
            'name.min' => "O nome precisa ter pelo menos 3 caracteres",
            'description.required' => 'Faça uma breve descrição do produto',
            'price.required' => 'Informe o preço do produto',
            'category_id.required' => 'Escolha uma categoria para o produto',
        ];

}
}

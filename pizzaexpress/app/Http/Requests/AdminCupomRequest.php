<?php

namespace pizzaexpress\Http\Requests;

use pizzaexpress\Http\Requests\Request;

class AdminCupomRequest extends Request
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
            'code'=>'required',
            'value'=> 'required',

        ];
    }

    public function messages(){
        return [
            'code.required'=>'O código do Cupom é obrigatório',
            'value.required'=>'O valor do Cupom de desconto é obrigatório',

        ];

}
}

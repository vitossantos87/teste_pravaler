<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class InstituicaoRequest extends FormRequest
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
            'nome' => 'required',
            'cnpj' => 'required|digits:14|numeric'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'cnpj.required'  => 'O campo CNPJ é Obrigatório',
            'cnpj.digits' => 'O campo CNPJ é inválido ',
            'cnpj.numeric' => 'O CNPJ deconter apenas números'

        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}

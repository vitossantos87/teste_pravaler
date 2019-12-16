<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CursoRequest extends FormRequest
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
            'duracao_semestres' => 'required|numeric'
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
            'duracao_semestres.required'  => 'O campo duração é Obrigatório',
            'duracao_semestres.numeric' => 'O campo duração deve ser um número'

        ];
    }




    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}

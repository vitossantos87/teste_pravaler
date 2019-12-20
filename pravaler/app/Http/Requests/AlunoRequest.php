<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AlunoRequest extends FormRequest
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
            'cpf' => 'required',
            'data_nascimento' => 'required',
            'email' => 'required|email',
            'celular' => 'required|digits:11',
            'endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'curso' => 'required',
            'instituicao' => 'required',
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
            'cpf.required'  => 'O campo CPF é Obrigatório',
            'data_nascimento.required'  => 'O campo data de nascimento é Obrigatório',
            'email.required'  => 'O campo e-mail é Obrigatório',
            'email.email'  => 'O campo e-mail não está correto',
            'celular.required'  => 'O campo celular é Obrigatório',
            'celular.digits' => 'O celular é inválido',
            'endereco.required'  => 'O campo endereço é Obrigatório',
            'numero.required'  => 'O campo número é Obrigatório',
            'bairro.required'  => 'O campo bairro é Obrigatório',
            'cidade.required'  => 'O campo cidade é Obrigatório',
            'uf.required'  => 'O campo UF é Obrigatório',
            'curso.required'  => 'O campo curso é Obrigatório',
            'instituicao.required'  => 'O campo instituição é Obrigatório'
        ];
    }




    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}

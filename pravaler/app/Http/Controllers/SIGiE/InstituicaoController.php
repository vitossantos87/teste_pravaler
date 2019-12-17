<?php

namespace App\Http\Controllers\SIGIE;

use App\Helpers\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InstituicaoRequest;
use App\Models\InstituicaoModel;
use Log;

class InstituicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituicoes = InstituicaoModel::where('status', '=', 1)->paginate(20);
        return view('SIGIE.instituicao.list_instituicao', ['instituicoes' => $instituicoes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('SIGIE.instituicao.new_instituicao', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstituicaoRequest $request)
    {
        $validator = $request->validated();

        $nome = $request->input('nome');
        $cnpj = $request->input('cnpj');

        if(InstituicaoModel::jaExiste($cnpj)){
            Message::setMessage('cnpj já está cadastrado', 'danger');
            return redirect()->route('instituicao.create');
        }

        try {
            $instituicao = new InstituicaoModel();
            $instituicao->nome = $nome;
            $instituicao->cnpj = $cnpj;
            $instituicao->save();
            Message::setMessage('Instituição cadastrada com sucesso', 'success');
            return redirect()->route('instituicao.index');

        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar instituição: '. $e->getMessage());
            Message::setMessage('Ocorreu um erro ao cadastrar a instituição', 'danger');
            return redirect()->route('instituicao.create');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instituicao  = InstituicaoModel::find($id);
        if(!$instituicao){
            Message::setMessage('Instituição não encontrada', 'danger');
            return redirect()->route('instituicao.index');
        }
        return view('SIGIE.instituicao.edit_instituicao', ['instituicao' => $instituicao]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstituicaoRequest $request, $id)
    {
        $validator = $request->validated();

        $instituicao  = InstituicaoModel::find($id);

        if(!$instituicao){
            Message::setMessage('Instituição não encontrada', 'danger');
            return redirect()->route('instituicao.index');
        }
        $nome = $request->input('nome');
        $cnpj = $request->input('cnpj');

        try {
            $instituicao->nome = $nome;
            $instituicao->cnpj = $cnpj;
            $instituicao->save();
            Message::setMessage('Instituição atualizada com sucesso', 'success');
            return redirect()->route('instituicao.index');

        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar instituição: '. $e->getMessage());
            Message::setMessage('Ocorreu um erro ao salvar a instituição', 'danger');
            return redirect()->route('instituicao.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $instituicao  = InstituicaoModel::find($id);

            if (!$instituicao) {
                Message::setMessage('Instituição não encontrada', 'danger');
                return redirect()->route('instituicao.index');
            }
            $instituicao->status = 0;
            $instituicao->save();

        } catch (\Exception $e) {
            Log::error('Erro ao excluir a instituição: ' . $e->getMessage());
            Message::setMessage('Ocorreu um erro ao excluir a instituição', 'danger');
            return redirect()->route('instituicao.create');
        }
    }
}

<?php

namespace App\Http\Controllers\SIGIE;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\CursoRequest;
use App\Models\CursoModel;
use App\Models\InstituicaoModel;
use Illuminate\Http\Request;
use Log;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $instituicoes = InstituicaoModel::where('status', '=', 1)->get();
        $filtro_instituicao = $request->input('filtro_instituicao');
        $cursos = CursoModel::getCursos($filtro_instituicao);
        return view('SIGIE.curso.list_curso',
                    ['cursos' => $cursos,
                    'instituicoes' => $instituicoes,
                    'filtro_instituicao' => $filtro_instituicao]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instituicoes = $instituicoes = InstituicaoModel::where('status', '=', 1)->get();
        return view('SIGIE.curso.new_curso', ['instituicoes' => $instituicoes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CursoRequest $request)
    {
        $validator = $request->validated();

        $instituicao_id  = $request->input('instituicao');
        $instituicao = InstituicaoModel::find($instituicao_id);
        if(!$instituicao){
            Message::setMessage('Instituição não encontrada', 'danger');
            return redirect()->route('curso.create')->withInput();
        }
        $nome = $request->input('nome');
        $duracao = $request->input('duracao');

        try {
            CursoModel::inserirCurso($nome, $duracao, $instituicao_id);
            Message::setMessage('O curso foi inserido com sucesso', 'success');
            return redirect()->route('curso.index');

        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar curso: '. $e->getMessage());
            Message::setMessage('Ocorreu um erro ao salvar o curso', 'danger');
            return redirect()->route('curso.create')->withInput();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $curso  = CursoModel::find($id);
        if(!$curso){
            Message::setMessage('Curso não encontrado', 'danger');
            return redirect()->route('curso.index');
        }
        return view('SIGIE.curso.edit_curso', ['curso' => $curso]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CursoRequest $request, $id)
    {
        $validator = $request->validated();

        $curso  = CursoModel::find($id);

        if(!$curso){
            Message::setMessage('Curso não encontrado', 'danger');
            return redirect()->route('curso.index');
        }

        $nome = $request->input('nome');
        $duracao = $request->input('duracao');

        try {
            $curso->nome = $nome;
            $curso->duracao_semestres = $duracao;
            $curso->save();

            Message::setMessage('O curso foi alterado com sucesso', 'success');
            return redirect()->route('curso.index');

        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar curso: '. $e->getMessage());
            Message::setMessage('Ocorreu um erro ao salvar o curso', 'danger');
            return redirect()->route('curso.edit')->withInput();
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $curso  = CursoModel::find($id);
        $instituicao = InstituicaoModel::find($request->input('instituicao_id'));

        if(!$curso || !$instituicao){
            Message::setMessage('Curso não encontrado', 'danger');
            return redirect()->route('curso.index');
        }

        $excluido = CursoModel::excluirCurso($id, $instituicao->id);

        if(!$excluido){
            Message::setMessage('Ocorreu um erro ao excluir o curso!', 'danger');
            return redirect()->route('curso.index');
        }

        Message::setMessage('O curso foi escluido com sucesso!', 'success');
        return redirect()->route('curso.index');
    }


    public function getCursosAjax($instituicao_id)
    {
        return response()->json(
            json_encode(CursoModel::getCursosPorInstituicao($instituicao_id))
        );
    }
}

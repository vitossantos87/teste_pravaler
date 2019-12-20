<?php

namespace App\Http\Controllers\SIGIE;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlunoRequest;
use App\Models\AlunoModel;
use App\Models\CursoModel;
use App\Models\InstituicaoModel;
use Illuminate\Http\Request;
use App\Helpers\Message;
use Log;

class AlunoController extends Controller
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
        $filtro_curso = $request->input('filtro_curso');

        $alunos = AlunoModel::getAlunos($filtro_curso,$filtro_instituicao);

        return view('SIGIE.aluno.list_aluno',
                    ['alunos' => $alunos,
                    'instituicoes' => $instituicoes,
                    'filtro_instituicao' => $filtro_instituicao,
                    'filtro_curso' => $filtro_curso]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instituicoes = $instituicoes = InstituicaoModel::where('status', '=', 1)->get();
        return view('SIGIE.aluno.new_aluno', ['instituicoes' => $instituicoes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlunoRequest $request)
    {
        $validator = $request->validated();

        $curso_id  = $request->input('curso');
        $curso = CursoModel::where('id', '=', $curso_id)
                            ->where('status', '=', 1)
                            ->first();

        if(!$curso){
            Message::setMessage('O Curso selecionado não foi encontrado', 'danger');
            return redirect()->route('aluno.create')->withInput();
        }
        try {
            $inserido = AlunoModel::inserirAluno($request->all());
            if($inserido){
                Message::setMessage('O Aluno foi inserido com sucesso', 'success');
                return redirect()->route('aluno.index');

            }

            Message::setMessage($inserido, 'danger');
            return redirect()->route('aluno.create')->withInput();

        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar aluno: '. $e->getMessage());
            Message::setMessage('Ocorreu um erro ao salvar o aluno', 'danger');
            return redirect()->route('aluno.create')->withInput();
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
        $aluno = AlunoModel::getAluno($id);

        if(!$aluno){
            Message::setMessage('O aluno não foi encontrado', 'danger');
            return redirect()->route('aluno.index');
        }

        $instituicoes = $instituicoes = InstituicaoModel::where('status', '=', 1)->get();
        return view('SIGIE.aluno.edit_aluno', ['instituicoes' => $instituicoes, 'aluno' => $aluno]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlunoRequest $request, $id)
    {
        $validator = $request->validated();

        $aluno = AlunoModel::getAluno($id);

        if(!$aluno){
            Message::setMessage('O aluno não foi encontrado', 'danger');
            return redirect()->route('aluno.index');
        }

        $curso_id  = $request->input('curso');
        $curso = CursoModel::where('id', '=', $curso_id)
                            ->where('status', '=', 1)
                            ->first();

        if(!$curso){
            Message::setMessage('O Curso selecionado não foi encontrado', 'danger');
            return redirect()->route('aluno.edit', $id);
        }

        try {
            $salvo = AlunoModel::editarAluno($aluno->id, $aluno->curso_id, $request->all());
            if($salvo === TRUE){
                Message::setMessage('O Aluno foi salvo com sucesso', 'success');
                return redirect()->route('aluno.index');
            }

            Message::setMessage($salvo, 'danger');
            return redirect()->route('aluno.edit', $id);

        } catch (\Exception $e) {
            Log::error('Erro ao editar aluno: '. $e->getMessage());
            Message::setMessage('Ocorreu um erro ao salvar o aluno', 'danger');
            return redirect()->route('aluno.edit', $id);
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
        //
    }
}

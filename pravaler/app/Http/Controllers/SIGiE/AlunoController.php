<?php

namespace App\Http\Controllers\SIGIE;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlunoRequest;
use App\Models\AlunoModel;
use App\Models\InstituicaoModel;
use Illuminate\Http\Request;

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

        $cursos = AlunoModel::getAlunos($filtro_curso,$filtro_instituicao);

        return view('SIGIE.aluno.list_aluno',
                    ['cursos' => $cursos,
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

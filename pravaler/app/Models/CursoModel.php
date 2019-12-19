<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CursoModel extends Model
{
    protected $table = 'cursos';

    public static function getCursos($filtro_instituicao){
        $cursos = CursoModel::where('cursos.status', '=', 1);
        if(!empty($filtro_instituicao)){
            $cursos->where('instituicoes_cursos.instituicao_id', '=', $filtro_instituicao);
        }
        return $cursos
                ->leftJoin('instituicoes_cursos', 'cursos.id', '=', 'instituicoes_cursos.curso_id')
                ->leftJoin('instituicoes', 'instituicoes.id', '=', 'instituicoes_cursos.instituicao_id')
                ->select('cursos.*', 'instituicoes.nome as instituicao')
                ->paginate(20);

    }

    public static function inserirCurso($nome, $duracao, $instituicao_id){

        DB::beginTransaction();

        $curso = self::where('nome', '=', $nome)
                    ->where('duracao_semestres', '=', $duracao)
                    ->first();

        if (!$curso){
            $curso = new CursoModel();
            $curso->nome = $nome;
            $curso->duracao_semestres = $duracao;
        }

        $curso->status = 1;
        $curso->save();

        if(!InstituicaoCursoModel::inserirRelacao($curso->id, $instituicao_id)){
            DB::rollBack();
            throw new Exception("Erro ao Inserir o curso na instituição");
        }
        DB::commit();
    }
}

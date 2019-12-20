<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Log;

class CursoModel extends Model
{
    protected $table = 'cursos';

    public static function getCursos($filtro_instituicao){
        $cursos = CursoModel::where('cursos.status', '=', 1)
                            ->where('instituicoes.status', '=', 1);
        if(!empty($filtro_instituicao)){
            $cursos->where('instituicoes_cursos.instituicao_id', '=', $filtro_instituicao);
        }
        return $cursos
                ->leftJoin('instituicoes_cursos', 'cursos.id', '=', 'instituicoes_cursos.curso_id')
                ->leftJoin('instituicoes', 'instituicoes.id', '=', 'instituicoes_cursos.instituicao_id')
                ->select('cursos.*', 'instituicoes.nome as instituicao', 'instituicoes.id as instituicao_id')
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

    public static function excluirCurso($curso_id, $instituicao_id){
        try {
            $quantidade_instituicao = InstituicaoCursoModel::quantasInstituicoesOferecemOCurso($curso_id);

            if($quantidade_instituicao == 1) {
                $curso = CursoModel::find($curso_id);
                $curso->status = 0;
                $curso->save();
            }

            InstituicaoCursoModel::where('curso_id', '=', $curso_id)
                                    ->where('instituicao_id', '=', $instituicao_id)
                                    ->delete();

            return true;

        } catch (\Exception $e) {
            Log::error('Erro ao tentar apagar o curso:' . $e->getMessage());
            return false;
        }


    }


    public static function getCursosPorInstituicao($instituicao_id){
        return self::where('cursos.status', '=', 1)
                    ->where('instituicoes_cursos.instituicao_id', '=', $instituicao_id)
                    ->join('instituicoes_cursos', 'cursos.id', '=', 'instituicoes_cursos.curso_id')
                    ->get();
    }
}

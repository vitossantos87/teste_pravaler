<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlunoModel extends Model
{
    protected $table = 'alunos';

    public static function getAlunos($filtro_curso, $filtro_instituicao){

        $alunos = self::where('alunos.status', '=', 1)
                        ->where('matriculas.status', '=', 1)
                        ->where('instituicoes.status', '=', 1)
                        ->where('cursos.status', '=', 1);

        if(!empty($filtro_curso)){
            $alunos->where('matriculas.curso_id', '=', $filtro_curso);
        }

        if(!empty($filtro_instituicao)){
            $alunos->where('instituicoes_cursos.instituicao_id', '=', $filtro_instituicao);
        }

        return $alunos
                ->join('matriculas', 'alunos.id', '=', 'matriculas.curso_id')
                ->join('cursos', 'cursos.id', '=', 'matriculas.curso_id')
                ->join('instituicoes_cursos', 'cursos.id', '=', 'instituicoes_cursos.curso_id')
                ->join('instituicoes', 'instituicoes.id', '=', 'instituicoes_cursos.instituicao_id')
                ->select('matriculas.*', 'instituicoes.nome as instituicao', 'instituicoes.id as instituicao_id' ,  'cursos.nome as curso', 'cursos.id as curso_id')
                ->paginate(20);

    }
}

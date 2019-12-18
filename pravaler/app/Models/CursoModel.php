<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoModel extends Model
{
    protected $table = 'cursos';

    public static function getCursos($filtro_instituicao){
        $cursos = CursoModel::where('status', '=', 1);
        if(!empty($filtro_instituicao)){
            $cursos
                ->where('instituicoes_cursos', '=', $filtro_instituicao)
                ->join('instituicoes_cursos', 'cursos.id', '=', 'instituicoes_cursos.curso_id');
        }
        return $cursos->paginate(20);

    }
}

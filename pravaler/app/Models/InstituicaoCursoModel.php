<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Log;
use DB;

class InstituicaoCursoModel extends Model
{
    protected $table = 'instituicoes_cursos';

    public static function inserirRelacao($curso_id, $instituicao_id){
        try {
            DB::table('instituicoes_cursos')->insertOrIgnore([
                ['instituicao_id' => $instituicao_id, 'curso_id' => $curso_id]
            ]);
            return true;
        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar relação curso/instituição: '. $e->getMessage());
            return false;
        }

    }
}

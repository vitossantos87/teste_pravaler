<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MatriculaModel extends Model
{
    protected $table = 'matriculas';
    protected $fillable = ['aluno_id', 'curso_id','status'];


    private function matriculaAluno($curso_id, $aluno_id){
        try {

            $matricula = new MatriculaModel();
            $matricula->aluno_id = $aluno_id;
            $matricula->curso_id = $curso_id;
            $matricula->save();

            return true;

        } catch (\Exception $e) {

            Log::error('Erro ao matricular aluno' . $e->getMessage());

            return false;
        }

    }
}

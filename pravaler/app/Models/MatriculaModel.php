<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MatriculaModel extends Model
{
    protected $table = 'matriculas';
    protected $fillable = ['aluno_id', 'curso_id','status'];


    public static function matriculaAluno($curso_id, $aluno_id){
        try {
            $qtd_matriculas = self::where('aluno_id', '=', $aluno_id)
                                ->where('status', '=', 1)
                                ->count();

            if($qtd_matriculas > 0){
                return "Aluno já Matriculado";
            }

            $matricula = self::where('aluno_id', '=', $aluno_id)
                                ->where('curso_id', '=', $curso_id)
                                ->first();
            if($matricula){
                $matricula->status = 1;
                $matricula->save();
                return true;
            }

            $matricula = new MatriculaModel();
            $matricula->aluno_id = $aluno_id;
            $matricula->curso_id = $curso_id;
            $matricula->save();

            return true;

        } catch (\Exception $e) {

            Log::error('Erro ao matricular aluno' . $e->getMessage());

            return 'Erro ao matricular aluno';
        }

    }

    public static function varificaMatriculaAluno($curso_anterior, $curso_atual, $aluno_id){
        if($curso_anterior == $curso_atual){
            return true;
        }
        try {

            $matricula = self::where('aluno_id', '=', $aluno_id)
                                ->where('curso_id', '=', $curso_anterior)
                                ->first();
            if($matricula){
                $matricula->curso_id = $curso_atual;
                $matricula->status = 1;
                $matricula->save();
                return true;
            }

            Log::error('Erro ao matricular aluno: não foi encontrado a matricula');

            return 'Erro ao matricular aluno: Matrícula não encontrada!';

        } catch (\Exception $e) {

            Log::error('Erro ao matricular aluno' . $e->getMessage());

            return 'Erro ao matricular aluno';
        }

    }
}

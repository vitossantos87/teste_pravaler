<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use DB;

class MatriculaModel extends Model
{
    protected $table = 'matriculas';

    protected $fillable = ['aluno_id', 'curso_id','status'];

    public $incrementing = false;


    public static function matriculaAluno($curso_id, $aluno_id, $instituicao_id){
        try {
            $qtd_matriculas = self::where('aluno_id', '=', $aluno_id)
                                ->where('status', '=', 1)
                                ->count();

            if($qtd_matriculas > 0){
                return "Aluno já Matriculado";
            }

            $matricula = self::where('aluno_id', '=', $aluno_id)
                                ->where('curso_id', '=', $curso_id)
                                ->where('instituicao_id', '=', $instituicao_id)
                                ->first();
            if($matricula){
                $matricula->status = 1;
                $matricula->save();
                return true;
            }

            $matricula = new MatriculaModel();
            $matricula->aluno_id = $aluno_id;
            $matricula->curso_id = $curso_id;
            $matricula->instituicao_id = $instituicao_id;
            $matricula->save();

            return true;

        } catch (\Exception $e) {

            Log::error('Erro ao matricular aluno' . $e->getMessage());

            return 'Erro ao matricular aluno';
        }

    }

    public static function varificaMatriculaAluno($curso_anterior, $curso_atual, $aluno_id, $instituicao_anterior, $instituicao_atual){
        if($curso_anterior == $curso_atual && $instituicao_anterior == $instituicao_atual){
            return true;
        }
        try {

            $matricula = self::where('aluno_id', '=', $aluno_id)
                                ->where('curso_id', '=', $curso_anterior)
                                ->where('curso_id', '=', $instituicao_anterior)
                                ->first();
            if($matricula){
                DB::table('matriculas')
                    ->where('aluno_id', '=' , $aluno_id)
                    ->where('curso_id', '=', $curso_anterior)
                    ->where('curso_id', '=', $instituicao_anterior)
                    ->update(['curso_id' => $curso_atual, 'instituicao_id' => $instituicao_atual,  'status' => 1 ]);

                return true;
            }

            Log::error('Erro ao matricular aluno: não foi encontrado a matricula');

            return 'Erro ao matricular aluno: Matrícula não encontrada!';

        } catch (\Exception $e) {

            Log::error('Erro ao matricular aluno' . $e->getMessage());

            return 'Erro ao matricular aluno';
        }

    }

    public static function desmatricularAluno($aluno_id){
        try {
            DB::table('matriculas')
                    ->where('aluno_id', '=' , $aluno_id)
                    ->update(['status' => 0 ]);
            return true;
        } catch (\Exception $e) {
            Log::error('Erro ao desmatricular aluno' . $e->getMessage());
            return false;
        }
    }
}

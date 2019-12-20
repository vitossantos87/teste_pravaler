<?php

namespace App\Models;

use App\Helpers\Transformer;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Log as FacadesLog;
use Log;
use PhpParser\Node\Stmt\TryCatch;

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
                ->join('matriculas', 'alunos.id', '=', 'matriculas.aluno_id')
                ->join('cursos', 'cursos.id', '=', 'matriculas.curso_id')
                ->join('instituicoes_cursos', 'cursos.id', '=', 'instituicoes_cursos.curso_id')
                ->join('instituicoes', 'instituicoes.id', '=', 'instituicoes_cursos.instituicao_id')
                ->select('alunos.*', 'instituicoes.nome as instituicao', 'instituicoes.id as instituicao_id' ,  'cursos.nome as curso', 'cursos.id as curso_id')
                ->paginate(20);

    }

    public static function inserirAluno($dados){
        DB::beginTransaction();

        $aluno = self::where('cpf', '=', $dados['cpf'])->first();
        if(!$aluno){
            $aluno = new AlunoModel();
        }

        try {
            $aluno->nome = $dados['nome'];
            $aluno->cpf = $dados['cpf'];
            $aluno->data_nascimento = Transformer::dateToBank($dados['data_nascimento']);
            $aluno->email = $dados['email'];
            $aluno->celular = $dados['celular'];
            $aluno->endereco = $dados['endereco'];
            $aluno->numero = $dados['numero'];
            $aluno->bairro = $dados['bairro'];
            $aluno->cidade = $dados['cidade'];
            $aluno->uf = $dados['uf'];
            $aluno->status = 1;
            $aluno->save();
            $matriculado = MatriculaModel::matriculaAluno($dados['curso'], $aluno->id);

            if($matriculado === TRUE){
                DB::commit();
                return true;
            }

            return $matriculado;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao inserir aluno:' . $e->getMessage());
            throw new \Exception("Erro ao Inserir o aluno");
        }
    }


    public static function getAluno($id){
        return self::where('aluno_id', '=', $id)
                        ->where('alunos.status', '=', 1)
                        ->where('matriculas.status', '=', 1)
                        ->where('instituicoes.status', '=', 1)
                        ->where('cursos.status', '=', 1)
                        ->join('matriculas', 'alunos.id', '=', 'matriculas.aluno_id')
                        ->join('cursos', 'cursos.id', '=', 'matriculas.curso_id')
                        ->join('instituicoes_cursos', 'cursos.id', '=', 'instituicoes_cursos.curso_id')
                        ->join('instituicoes', 'instituicoes.id', '=', 'instituicoes_cursos.instituicao_id')
                        ->select('alunos.*', 'instituicoes.nome as instituicao', 'instituicoes.id as instituicao_id' ,  'cursos.nome as curso', 'cursos.id as curso_id')
                        ->first();


    }


    public static function editarAluno($aluno_id, $curso_id, $dados){

        $aluno = self::find($aluno_id);
        if(!$aluno){
            Log::error('Erro ao editar aluno: Não existe');
            return "Aluno não encontrado";
        }
        DB::beginTransaction();
        try {
            $aluno->nome = $dados['nome'];
            $aluno->cpf = $dados['cpf'];
            $aluno->data_nascimento = Transformer::dateToBank($dados['data_nascimento']);
            $aluno->email = $dados['email'];
            $aluno->celular = $dados['celular'];
            $aluno->endereco = $dados['endereco'];
            $aluno->numero = $dados['numero'];
            $aluno->bairro = $dados['bairro'];
            $aluno->cidade = $dados['cidade'];
            $aluno->uf = $dados['uf'];
            $aluno->status = 1;
            $aluno->save();
            $matriculado = MatriculaModel::varificaMatriculaAluno($curso_id, $dados['curso'], $aluno->id);

            if($matriculado === TRUE){
                DB::commit();
                return true;
            }
            DB::rollBack();
            return $matriculado;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao editar aluno:' . $e->getMessage());
            throw new \Exception("Erro ao Editar o aluno");
        }
    }
}

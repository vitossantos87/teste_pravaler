<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMatriculaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('matriculas');
        Schema::create('matriculas', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('aluno_id')->unsigned();
            $table->bigInteger('curso_id')->unsigned();
            $table->bigInteger('instituicao_id')->unsigned();
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->unique(['curso_id', 'aluno_id', 'instituicao_id']);

            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->foreign('instituicao_id')->references('id')->on('instituicoes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriculas');
        Schema::create('matriculas', function (Blueprint $table) {
            $table->bigInteger('aluno_id')->unsigned();
            $table->bigInteger('curso_id')->unsigned();
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->primary(['curso_id', 'aluno_id']);

            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->foreign('curso_id')->references('id')->on('cursos');

        });
    }
}

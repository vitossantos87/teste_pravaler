<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->bigInteger('aluno_id')->unsigned();
            $table->bigInteger('curso_id')->unsigned();

            $table->timestamps();

            $table->primary(['curso_id', 'aluno_id']);

            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->foreign('curso_id')->references('id')->on('cursos');

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
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituicoesCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicoes_cursos', function (Blueprint $table) {
            $table->bigInteger('instituicao_id')->unsigned();
            $table->bigInteger('curso_id')->unsigned();

            $table->timestamps();

            $table->primary(['instituicao_id', 'curso_id']);

            $table->foreign('instituicao_id')->references('id')->on('instituicoes');
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
        Schema::dropIfExists('instituicoes_cursos');
    }
}

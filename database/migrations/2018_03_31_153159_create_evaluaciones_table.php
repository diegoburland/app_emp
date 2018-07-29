<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->string('evalua', 50);
            $table->integer('trabajo_tiempo')->nullable();
            $table->string('posicion', 100);
            $table->string('departamento', 255);
            $table->string('titulo', 100)->nullable();
            $table->mediumText('comentarios')->nullable();

            $table->mediumText('mejoras')->nullable();
            $table->mediumText('like')->nullable();
            $table->mediumText('no_like')->nullable();
            $table->boolean('recomienda')->nullable();
            $table->mediumText('beneficios')->nullable();

            $table->string('confir_code', 50)->nullable();

            $table->boolean('confirmed')->default(false);

            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluaciones');
    }
}

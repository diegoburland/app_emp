<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 255);
            $table->string('dimension', 15);
            $table->mediumText('descripcion')->nullable();            
            $table->timestamps();
        });

        DB::table('categorias')->insert([ 'nombre' => 'Ambiente laboral', 'dimension' => 'empleado']);
        DB::table('categorias')->insert([ 'nombre' => 'Condiciones laborales', 'dimension' => 'empleado']);
        DB::table('categorias')->insert([ 'nombre' => 'Carrera profesional', 'dimension' => 'empleado']);
        
        DB::table('categorias')->insert([ 'nombre' => 'Ambiente laboral', 'dimension' => 'practicante']);
        DB::table('categorias')->insert([ 'nombre' => 'Condiciones laborales', 'dimension' => 'practicante']);
        DB::table('categorias')->insert([ 'nombre' => 'Carrera profesional', 'dimension' => 'practicante']);  

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}

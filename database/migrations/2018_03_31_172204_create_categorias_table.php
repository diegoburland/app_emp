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
            $table->mediumText('descripcion')->nullable();
            $table->timestamps();
        });

        DB::table('categorias')->insert([ 'nombre' => 'Cultura empresarial']);
        DB::table('categorias')->insert([ 'nombre' => 'Diversidad']);
        DB::table('categorias')->insert([ 'nombre' => 'Ambiente laboral']);
        DB::table('categorias')->insert([ 'nombre' => 'Carrera profesional']);        

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

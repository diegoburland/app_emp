<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->string('nombre', 255);
            $table->mediumText('descripcion')->nullable();
            $table->timestamps();
        });

         DB::table('items')->insert([ 'nombre' => 'Ambiente laboral', 'categoria_id' => 1]);
         DB::table('items')->insert([ 'nombre' => 'Comunicación', 'categoria_id' => 1]);
         DB::table('items')->insert([ 'nombre' => 'Cohesión ente colegas', 'categoria_id' => 1]);
         DB::table('items')->insert([ 'nombre' => 'Equilibrio trabajo-vida', 'categoria_id' => 1]);
         DB::table('items')->insert([ 'nombre' => 'Comportamiento del superior', 'categoria_id' => 1]);
         DB::table('items')->insert([ 'nombre' => 'Tareas Interesantes', 'categoria_id' => 1]);
         DB::table('items')->insert([ 'nombre' => 'Entrega de responsabilidades', 'categoria_id' => 1]);

         DB::table('items')->insert([ 'nombre' => 'Igualdad de derechos', 'categoria_id' => 2]);
         DB::table('items')->insert([ 'nombre' => 'Igualdad entre hombres y mujeres', 'categoria_id' => 2]);

         DB::table('items')->insert([ 'nombre' => 'Condiciones del puesto de trabajo', 'categoria_id' => 3]);
         DB::table('items')->insert([ 'nombre' => 'Consciencia social y ambiental', 'categoria_id' => 3]);

         DB::table('items')->insert([ 'nombre' => 'Salario', 'categoria_id' => 4]);
         DB::table('items')->insert([ 'nombre' => 'Salario quincenalmente/mes/año', 'categoria_id' => 4]);
         DB::table('items')->insert([ 'nombre' => 'Beneficios adicionales', 'categoria_id' => 4]);
         DB::table('items')->insert([ 'nombre' => 'Imagen de la empresa', 'categoria_id' => 4, 'descripcion' => '(como hablan los empleados de la misma)']);
         DB::table('items')->insert([ 'nombre' => 'Posibilidades de accenso', 'categoria_id' => 4]);
         DB::table('items')->insert([ 'nombre' => 'Calidad de formación continua', 'categoria_id' => 4]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}

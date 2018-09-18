<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benes', function (Blueprint $table) {
          $table->increments('id');        
		      $table->string('nombre', 250);
          $table->integer('tipo');
          $table->timestamps();
        });
      
        DB::table('benes')->insert([ 'nombre' => 'Actividades deportivas y recreativas', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Asignación de vehículo', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Auxilio de educación', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Auxilio por salud (Lentes, Odontología y otros)', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Bono de telefonía móvil', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Bonos', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Accesibilidad vial y geográfica', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Celular empresarial', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Crédito empresarial a tasas blandas', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Descansos remunerados', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Descuentos para empleados', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Eventos para empleados y familia', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Fondo de ahorro para pensión voluntario', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Fondo de empleados', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Guardería', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Horario flexible', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Medicina prepagada', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Parqueadero', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Participación en ganancias', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Plan de carrera profesional', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Posibilidad de traslados', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Prima de antigüedad', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Primas extralegales', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Restaurante empresarial', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Se permiten mascotas', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Seguro de vida, accidentes o invalidez', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Seminarios y talleres pagados', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Subsidio de alimentación', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Teletrabajo', 'tipo' => 1]);
        DB::table('benes')->insert([ 'nombre' => 'Transporte empresarial', 'tipo' => 1]);
      

        DB::table('benes')->insert([ 'nombre' => 'Actividades deportivas y recreativas', 'tipo' => 2]);
        DB::table('benes')->insert([ 'nombre' => 'Bonos', 'tipo' => 2]);
        DB::table('benes')->insert([ 'nombre' => 'Buena conexión de infraestructura de transporte', 'tipo' => 2]);        
        DB::table('benes')->insert([ 'nombre' => 'Calzado y vestido de labor', 'tipo' => 2]);
        DB::table('benes')->insert([ 'nombre' => 'Descansos remunerados', 'tipo' => 2]);
        DB::table('benes')->insert([ 'nombre' => 'Descuentos para practicantes', 'tipo' => 2]);
        DB::table('benes')->insert([ 'nombre' => 'Eventos para empleados y familia', 'tipo' => 2]);
        DB::table('benes')->insert([ 'nombre' => 'Horario flexible', 'tipo' => 2]);
        DB::table('benes')->insert([ 'nombre' => 'Parqueadero', 'tipo' => 2]);
        DB::table('benes')->insert([ 'nombre' => 'Restaurante empresarial', 'tipo' => 2]);
        DB::table('benes')->insert([ 'nombre' => 'Seminarios y talleres pagados', 'tipo' => 2]);
        DB::table('benes')->insert([ 'nombre' => 'Subsidio de Alimentación', 'tipo' => 2]);
        DB::table('benes')->insert([ 'nombre' => 'Transporte empresarial', 'tipo' => 2]);
      
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('benes');
    }
}

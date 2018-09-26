<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvalBenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eval_benes', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('evaluacion_id');
            $table->foreign('evaluacion_id')->references('id')->on('evaluaciones');
            $table->unsignedInteger('bene_id');
            $table->foreign('bene_id')->references('id')->on('benes');
          
            $table->timestamps();
          
          
            DB::table('evaluaciones')->insert([ 'empresa_id' => 1, 'evalua' => 'cualquier cosa', 'posicion' => 'practicante', 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => 'SI', 'ip'=>'1.1.1.1.1', 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jose@gmail.com', 'contenido'=>'POR VERIFICAR', 'ies' => 'udea', 'ciudad_eval_id' =>'239']);
            DB::table('evaluaciones')->insert([ 'empresa_id' => 1, 'evalua' => 'cualquier cosa', 'posicion' => 'practicante', 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => 'NO', 'ip'=>'1.1.1.1.1', 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jose2@gmail.com', 'contenido'=>'ACEPTADO', 'publicada'=>'SI', 'ies' => 'udea', 'ciudad_eval_id' =>'239']);
            DB::table('evaluaciones')->insert([ 'empresa_id' => 1, 'evalua' => 'cualquier cosa', 'posicion' => 'practicante', 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => 'PENDIENTE', 'ip'=>'1.1.1.1.1', 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jos3e@gmail.com', 'contenido'=>'EDITADO', 'ies' => 'udea', 'ciudad_eval_id' =>'239']);
            DB::table('evaluaciones')->insert([ 'empresa_id' => 1, 'evalua' => 'cualquier cosa', 'posicion' => 'practicante', 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => 'PENDIENTE', 'ip'=>'1.1.1.1.1', 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jos3e@gmail.com', 'contenido'=>'RECHAZADO', 'ies' => 'udea', 'ciudad_eval_id' =>'239']);
            DB::table('evaluaciones')->insert([ 'empresa_id' => 2, 'evalua' => 'cualquier cosa', 'posicion' => 'practicante', 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => 'PENDIENTE', 'ip'=>'1.1.1.1.1', 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jos3e@gmail.com', 'contenido'=>'SIN REVISION', 'ies' => 'udea', 'estado'=>'NORMAL', 'ciudad_eval_id' =>'239']);
            DB::table('evaluaciones')->insert([ 'empresa_id' => 2, 'evalua' => 'cualquier cosa', 'posicion' => 'practicante', 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => 'PENDIENTE', 'ip'=>'1.1.1.1.1', 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jos3e@gmail.com', 'contenido'=>'ESPERANDO', 'ies' => 'udea', 'estado'=>'INVALIDA', 'ciudad_eval_id' =>'239']);
            
            for($i = 1; $i < 20000; $i++){
              DB::table('evaluaciones')->insert([ 'empresa_id' => 1, 'evalua' => 'cualquier cosa', 'posicion' => 'practicante', 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => 'SI', 'ip'=>'1.1.1.1.1', 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jose@gmail'. $i .'.com', 'contenido'=>'POR VERIFICAR', 'ies' => 'udea', 'estado'=>'POR CONTROLAR', 'ciudad_eval_id' =>'239']);
            }
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eval_benes');
    }
}

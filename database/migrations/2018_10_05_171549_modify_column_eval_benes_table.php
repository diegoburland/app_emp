<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumnEvalBenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eval_benes', function (Blueprint $table) {
            $table->dropForeign('eval_benes_evaluacion_id_foreign');

            $table->foreign('evaluacion_id')
                ->references('id')->on('evaluaciones')
                ->onDelete('cascade')->onUpdate('cascade');
            
            if(env('APP_DEBUG') == true){
                $evalua = ['Trabajo Actual', 'Trabajo Pasado', 'Práctica'];
                $contenido = ['POR VERIFICAR','ACEPTADO','RECHAZADO', 'SIN REVISION', 'ESPERANDO'];
                $confirmed = ['SI', 'NO', 'PENDIENTE'];
                $posicion = ['Directivo', 'Empleado', 'Practicante'];
                $estado = ['INVALIDA', 'NORMAL', 'POR CONTROLAR'];
                DB::table('evaluaciones')->insert([ 'empresa_id' => 1, 'evalua' => 'Trabajo Actual', 'posicion' => 'practicante', 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => 'SI', 'ip'=>'1.1.1.1.1', 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jose@gmail.com', 'contenido'=>'POR VERIFICAR', 'ies' => 'udea', 'ciudad_eval_id' =>'239']);
                DB::table('evaluaciones')->insert([ 'empresa_id' => 1, 'evalua' => 'Trabajo Actual', 'posicion' => 'practicante', 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => 'NO', 'ip'=>'1.1.1.1.1', 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jose2@gmail.com', 'contenido'=>'ACEPTADO', 'publicada'=>'SI', 'ies' => 'udea', 'ciudad_eval_id' =>'239']);
                DB::table('evaluaciones')->insert([ 'empresa_id' => 1, 'evalua' => 'Trabajo Pasado', 'posicion' => 'practicante', 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => 'PENDIENTE', 'ip'=>'1.1.1.1.1', 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jos3e@gmail.com', 'contenido'=>'EDITADO', 'ies' => 'udea', 'ciudad_eval_id' =>'239']);
                DB::table('evaluaciones')->insert([ 'empresa_id' => 1, 'evalua' => 'Práctica', 'posicion' => 'practicante', 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => 'PENDIENTE', 'ip'=>'1.1.1.1.1', 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jos3e@gmail.com', 'contenido'=>'RECHAZADO', 'ies' => 'udea', 'ciudad_eval_id' =>'239']);
                DB::table('evaluaciones')->insert([ 'empresa_id' => 2, 'evalua' => 'Práctica', 'posicion' => 'practicante', 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => 'PENDIENTE', 'ip'=>'1.1.1.1.1', 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jos3e@gmail.com', 'contenido'=>'SIN REVISION', 'ies' => 'udea', 'estado'=>'NORMAL', 'ciudad_eval_id' =>'239']);
                DB::table('evaluaciones')->insert([ 'empresa_id' => 2, 'evalua' => 'Práctica', 'posicion' => 'practicante', 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => 'PENDIENTE', 'ip'=>'1.1.1.1.1', 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jos3e@gmail.com', 'contenido'=>'ESPERANDO', 'ies' => 'udea', 'estado'=>'INVALIDA', 'ciudad_eval_id' =>'239']);

                for($i = 1; $i < 200; $i++){
              
                    for($k = 1; $k < 32; $k++){
                    
                        DB::table('eval_items')->insert([ 'evaluacion_id' => $i, 'item_id' => $k, 'puntaje' => rand(1, 5) , 'comentario' => 'comentario de prueba']);
                    }
                    
                    $tmp = rand(1, 10);
                    for($j = 1; $j < $tmp; $j++){
                    
                        DB::table('eval_benes')->insert([ 'evaluacion_id' => $i, 'bene_id' => rand(1, 43)]);
                    }
                    

                    DB::table('evaluaciones')->insert([ 'empresa_id' => rand(1, 20), 'evalua' => $evalua[rand(0, 2)], 'posicion' => $posicion[rand(0,2)], 'departamento' => 'cualquiera', 'titulo' => 'cualquiera', 'confir_code' => 'xyz', 'confirmed' => $confirmed[rand(0,2)], 'ip'=>$i .'.' . ($i+1) . '.1.1.' . $i, 'created_at' => date('Y-m-d H:i:s'), 'email'=>'jose@gmail'. $i .'.com', 'contenido'=>$contenido[rand(0,4)], 'ies' => 'udea', 'estado'=>$estado[rand(0,2)], 'ciudad_eval_id' =>'239', 'trabajo_tiempo'=>rand(40, 50)]);
                }
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
        Schema::table('eval_benes', function (Blueprint $table) {
            //
        });
    }
}

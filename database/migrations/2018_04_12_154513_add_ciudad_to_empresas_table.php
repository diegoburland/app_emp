<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCiudadToEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('empresas', function (Blueprint $table) {

            $table->integer('ciudad_id')->after('razon_social');
            $table->foreign('ciudad_id')->references('id')->on('ciudades')->onDelete('cascade');
        });

        /*DB::table('empresas')->insert([ 'razon_social' => 'Ocupasion', 'sector_economico' => 'Administración / Organización', 'ciudad_id' => 547, 'verificada'=>'SI']);
        DB::table('empresas')->insert([ 'razon_social' => 'Exito', 'sector_economico' => 'Administración / Organización', 'ciudad_id' => 547, 'verificada'=>'ESPERANDO']);
        DB::table('empresas')->insert([ 'razon_social' => 'Bancolombia', 'sector_economico' => 'Administración / Organización', 'ciudad_id' => 547, 'verificada'=>'POR VERIFICAR']);
        DB::table('empresas')->insert([ 'razon_social' => 'Jumbo', 'sector_economico' => 'Administración / Organización', 'ciudad_id' => 547, 'verificada'=>'PENDIENTE']);
        DB::table('empresas')->insert([ 'razon_social' => 'Jumbo', 'sector_economico' => 'Administración / Organización', 'ciudad_id' => 547, 'verificada'=>'NO VERIFICADA']);
        DB::table('empresas')->insert([ 'razon_social' => 'Jumbo', 'sector_economico' => 'Administración / Organización', 'ciudad_id' => 547, 'verificada'=>'SIN REVISION']);*/
        //DB::unprepared(file_get_contents('/var/www/departamentos-y-municipios-colombia-SQL/municipios.sql'));   
        if(env('APP_DEBUG') == true){
            DB::unprepared(file_get_contents(__DIR__ . '/script/pruebas.sql'));   
        }else{
            DB::unprepared(file_get_contents(__DIR__ . '/script/empresas.sql'));   
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('empresas', function (Blueprint $table) {
             //Schema::dropIfExists('ciudades');
        });
    }
}

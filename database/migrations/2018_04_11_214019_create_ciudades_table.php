<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCiudadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciudades', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->primary();            
            $table->string('nombre', 200);
            $table->integer('estado');
            $table->integer('departamento_id');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade');
            $table->timestamps();
        });

        //DB::unprepared(file_get_contents('/var/www/departamentos-y-municipios-colombia-SQL/municipios.sql'));        
        DB::unprepared(file_get_contents(__DIR__ . '\\..\\..\\script\\municipios.sql'));
    }

    /**
     * Reverse the migrations.
     *a-SQL/municipios.sql
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ciudades');
    }
}

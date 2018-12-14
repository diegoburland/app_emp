<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nit', 30)->nullable();
          $table->string('razon_social', 300);
          $table->string('nicknames', 300)->nullable();
          $table->string('repre_nombre', 200)->nullable();
          $table->string('direccion', 200)->nullable();
          $table->string('tel1', 200)->nullable();
          $table->string('tel2', 20)->nullable();        
          $table->date('fecha_fun')->nullable();
          $table->string('email', 255)->nullable();
          $table->string('web', 255)->nullable();
          $table->string('ciiu', 20)->nullable();
          $table->string('sector_economico', 300);
          $table->string('ciiu_des', 300)->nullable();
          $table->string('total_empleados', 30)->nullable();
          $table->string('verificada', 30)->nullable();

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
        Schema::dropIfExists('empresas');
    }
}

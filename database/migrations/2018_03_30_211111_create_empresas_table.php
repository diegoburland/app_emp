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
            $table->string('razon_social', 255);
            $table->string('ubicacion', 255);
            $table->string('sector_economico', 255);
            $table->string('direccion', 200)->nullable();
            $table->string('tel', 15)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('nombres_contacto', 50)->nullable();
            $table->string('apellidos_contacto', 100)->nullable();
            $table->string('tel_contacto', 15)->nullable();
            $table->string('cel_contacto', 15)->nullable();
            $table->string('email_contacto', 255)->nullable();

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

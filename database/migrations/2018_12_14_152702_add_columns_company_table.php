<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->double('promedio', 2, 2)->nullable();
            
            $table->string('cargo_repre', 300)->nullable();
            $table->string('id_repre', 30)->nullable();
            $table->string('nombres_repre', 300)->nullable();
            $table->string('tel_repre', 15)->nullable();
            $table->string('email_repre', 255)->nullable();
            
            $table->string('linkedin', 500)->nullable();
            $table->string('facebook', 500)->nullable();
            $table->string('instagram', 500)->nullable();
            $table->string('youtube', 500)->nullable();
            $table->string('twitter', 500)->nullable();
            
            
            $table->string('vw_clase', 50)->nullable();
            $table->string('sector_economico2', 300)->nullable();
            $table->string('sector_economico3', 300)->nullable();
            
            $table->string('direccion2', 300)->nullable();
            $table->string('direccion3', 300)->nullable();
            $table->string('direccion4', 300)->nullable();
            $table->string('direccion5', 300)->nullable();
            
            $table->mediumText('campo_texto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            //
        });
    }
}

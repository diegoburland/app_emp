<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificarColumsEvalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluaciones', function (Blueprint $table) {

            $table->string('recomienda', 5)->nullable()->change();
            $table->string('email', 255)->nullable()->change();
            $table->string('terminos', 5)->nullable()->change();
            $table->string('salario', 15)->nullable()->change();
            $table->string('ofrecer', 5)->nullable()->change();
            $table->string('oferta', 5)->nullable()->change();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('evaluaciones', function (Blueprint $table) {
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsToEvalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluaciones', function (Blueprint $table) {

            $table->string('recomienda', 5)->change();
            $table->string('email', 255);
            $table->string('terminos', 5);
            $table->string('salario', 15);
            $table->string('ofrecer', 5);
            $table->string('oferta', 5);                        
            
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

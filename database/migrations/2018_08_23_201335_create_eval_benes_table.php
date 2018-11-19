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

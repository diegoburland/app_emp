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

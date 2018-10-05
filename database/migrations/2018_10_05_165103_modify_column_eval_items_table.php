<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumnEvalItemsTable extends Migration
{
    /**
     * Run the migrations.
     * delete from eval_benes where evaluacion_id > 1 and evaluacion_id < 19;
     * delete from eval_items where evaluacion_id > 1 and evaluacion_id < 19;
     *delete from evaluaciones where id > 1 and id < 19;
     * @return void
     */
    public function up()
    {
        Schema::table('eval_items', function (Blueprint $table) {
            //
            //$table->foreign('evaluacion_id')->references('id')->on('evaluaciones')->onDelete('cascade')->change();
            
            $table->dropForeign('eval_items_evaluacion_id_foreign');

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
        Schema::table('eval_items', function (Blueprint $table) {
            //
        });
    }
}

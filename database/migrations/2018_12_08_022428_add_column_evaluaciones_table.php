<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnEvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluaciones', function (Blueprint $table) {
            $table->string('posicion', 100)->nullable()->change(); //borrar 
            $table->bigInteger('salary')->nullable(); // borrar salario
            $table->unsignedInteger('job_id')->nullable()->after('empresa_id');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
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
            $table->dropForeign(['job_id']);
            $table->dropColumn('job_id');
            $table->dropColumn('salary');
        });
    }
}

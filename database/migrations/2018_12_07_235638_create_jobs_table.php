<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
           
            $table->increments('id');
            $table->string('name', 255);
            $table->bigInteger('salary')->nullable();
            $table->string('state', 15)->default('VERIFICADO');                        
            
            $table->timestamps();
        });
        
        DB::unprepared(file_get_contents(__DIR__ . '/script/jobs.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('jobs');
    }
}

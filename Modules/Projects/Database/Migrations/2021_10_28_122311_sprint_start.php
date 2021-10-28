<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SprintStart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('sprint_start', function (Blueprint $table) {

            $table->increments('id');
            $table->bigIncrements('product_id');
            $table->bigIncrements('sprint_id');
            $table->string('sprint_name');
            $table->string('sprint_duration')->comment('weekly');
            $table->string('sprint_start_date');
            $table->string('sprint_end_date');  
            $table->longText('start_sprint_goal'); 
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
        //
        Schema::dropIfExists('sprint_start');
    }
}

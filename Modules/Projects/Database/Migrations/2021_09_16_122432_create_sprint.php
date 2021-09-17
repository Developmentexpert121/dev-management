<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSprint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_sprints', function (Blueprint $table) {
        $table->increments('id');
        $table->string('sprint_name');
        $table->string('duration');
        $table->string('start_date');
        $table->string('end_date');
        $table->string('sprint_goal');
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
        Schema::dropIfExists('all_sprints');
    }
}

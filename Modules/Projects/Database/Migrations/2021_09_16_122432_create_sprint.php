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
<<<<<<< HEAD
        $table->string('created_by');
=======
>>>>>>> 78b4940f56b5dd1616af9de10c3db15b80024d19
        $table->string('duration');
        $table->string('start_date');
        $table->string('end_date');
        $table->string('sprint_goal');
<<<<<<< HEAD
        $table->string('project_id');
=======
>>>>>>> 78b4940f56b5dd1616af9de10c3db15b80024d19
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

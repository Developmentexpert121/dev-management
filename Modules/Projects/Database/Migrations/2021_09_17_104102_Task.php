<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Task extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
<<<<<<< HEAD
            $table->increments('id');
            $table->string('project_id');
            $table->string('task_type');
            $table->string('project_type')->comment('1=>team,2=>company');
            $table->string('sprint_id');
            $table->string('reporter');
            $table->string('assignee');
            $table->string('created_by');
            $table->string('summary');
            $table->longText('description');
=======
          $table->increments('id');
           $table->string('project_name');
            $table->string('task_type');
            $table->string('project_type')->comment('1=>team,2=>company');
            $table->string('created_by');
            $table->string('summary');
            $table->string('description');
>>>>>>> 78b4940f56b5dd1616af9de10c3db15b80024d19
            $table->string('task_prioprity');
           
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
         Schema::dropIfExists('task');
    }
}

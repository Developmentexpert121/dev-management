<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SprintIssue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sprint_issue', function (Blueprint $table) {

            $table->increments('id');
            $table->bigIncrements('project_id');
            $table->bigIncrements('sprint_id');
            $table->string('issue_name');
            $table->integer('issue_status')->comment('0 = todo , 1 = in progess , 2 =done');
            $table->bigIncrements('created_by');
            $table->integer('status')->comment('0 = default , 1 = backlog ');
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
        Schema::dropIfExists('sprint_issue');
    }
}

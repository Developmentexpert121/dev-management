<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BoardHeading extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('board_heading', function (Blueprint $table) {

              $table->increments('id');
              $table->string('status_name')->nullable()->comment('1 for ToDo, 2 for In Progress, 3 for Done ');
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
        Schema::dropIfExists('board_heading');
    }
}

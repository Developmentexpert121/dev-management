<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {   

        Schema::create('Users_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('job_title');
            $table->string('your_department');
            $table->string('your_organisation');
            $table->string('your_location');
            $table->string('image');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  
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
        Schema::dropIfExists('Users_data');
    }
}

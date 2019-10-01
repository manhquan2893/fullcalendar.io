<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->string('title')->nullable();
              $table->text('description')->nullable();
               $table->string('startdate')->nullable();
             $table->string('enddate')->nullable();
              $table->string('starttime')->nullable();
              $table->string('endtime')->nullable();
              $table->boolean('isfinished')->default(false);
              $table->bigInteger('user_id')->unsigned();
               // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('events');
    }
}

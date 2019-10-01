<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('group_user', function (Blueprint $table) {
               $table->bigIncrements('id');
               $table->bigInteger('group_id')->unsigned();
               $table->bigInteger('user_id')->unsigned();
                $table->foreign('group_id')->references('id')->on('groups');
                 $table->foreign('user_id')->references('id')->on('users');
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
    }
}

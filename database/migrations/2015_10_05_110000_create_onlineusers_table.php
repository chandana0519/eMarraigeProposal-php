<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onlineusers', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('status');         // 1 - online , 2 - away/timeout, 3 - logout, 4-inactive
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
        Schema::drop('onlineusers');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->integer('fromuser_id')->unsigned();
            $table->string('fromuser_name',20);
            $table->integer('touser_id')->unsigned();
            $table->string('touser_name',20);
            $table->string('subject',50);
            $table->text('body');
            $table->string('attachment');
            $table->boolean('fromuser_status')->default(0); // 0 - default , 1 - trash , 2 - deleted
            $table->boolean('touser_status')->default(0); // 0 - default , 1 - trash , 2 - deleted
            $table->boolean('is_read')->default(0);
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
        Schema::drop('messages');
    }
}

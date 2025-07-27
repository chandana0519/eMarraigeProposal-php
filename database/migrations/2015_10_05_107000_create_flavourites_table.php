<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlavouritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flavourites', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->integer('fromuser_id')->unsigned();
            $table->integer('touser_id')->unsigned();
            $table->boolean('fromuser_status'); // 0 - default , 1 - deleted
            $table->boolean('touser_status'); // 0 - default , 1 - deleted
            $table->boolean('is_new');
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
        Schema::drop('flavourites');
    }
}

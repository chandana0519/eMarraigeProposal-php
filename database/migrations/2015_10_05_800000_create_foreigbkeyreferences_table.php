<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeigbKeyReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // user profile picture 1 to 1 
             $table->foreign('profileimage_id')->references('id')->on('profileimages');
        });

        Schema::table('profileimages', function (Blueprint $table) {
            // user profile images 1 to n
             $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('userlanguages', function (Blueprint $table) {
            // user profile images 1 to n
             $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('messages', function (Blueprint $table) {
            // user from user messages 1 to n
             $table->foreign('fromuser_id')->references('id')->on('users');
             // user to user messages 1 to n
             $table->foreign('touser_id')->references('id')->on('users');
        });

        Schema::table('interests', function (Blueprint $table) {
            // user from user interests 1 to n
             $table->foreign('fromuser_id')->references('id')->on('users');
             // user to user interests 1 to n
             $table->foreign('touser_id')->references('id')->on('users');
        });

        Schema::table('flavourites', function (Blueprint $table) {
            // user from user flavourites 1 to n
             $table->foreign('fromuser_id')->references('id')->on('users');
             // user to user flavourites 1 to n
             $table->foreign('touser_id')->references('id')->on('users');
        });

        Schema::table('profilevisitors', function (Blueprint $table) {
            // user from user profilevisitors 1 to n
             $table->foreign('fromuser_id')->references('id')->on('users');
             // user to user profilevisitors 1 to n
             $table->foreign('touser_id')->references('id')->on('users');
        });

        Schema::table('state', function (Blueprint $table) {
            // country from country table 1 to n
             $table->foreign('country_id')->references('id')->on('country');             
        });

        Schema::table('city', function (Blueprint $table) {
            // state from state table 1 to n
             $table->foreign('state_id')->references('id')->on('state');             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}

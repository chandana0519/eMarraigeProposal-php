<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',20)->unique();
            $table->string('email',50)->unique();
            $table->string('password',60);
             $table->string('pswdhash',20);
            
            /* personal details*/            
            $table->date('dateofbirth');
            $table->string('sex',10);
            $table->tinyInteger('sex_id')->default(1);          // 1-male , 2-female
            $table->string('maritalstatus',50);
            $table->tinyInteger('maritalstatus_id')->default(0); // 1- never maiied, 2, separated/divorce...
            $table->string('kids',50);
            $table->tinyInteger('kids_id')->default(0);         // 1-Someday, 2- Alredy Have, 3-Grown up, 4- No, Never
            $table->string('title',100);
            $table->string('description',5000);
            $table->string('city',50);
            $table->mediumInteger('city_id');
            $table->string('state',50);
            $table->mediumInteger('state_id');
            $table->string('country',50);
            $table->smallInteger('country_id');
            $table->string('height',50);
            $table->tinyInteger('height_id');
            $table->string('weight',50);
            $table->tinyInteger('weight_id');
            $table->string('ethnicity',50);
            $table->tinyInteger('ethnicity_id');
            $table->string('cast',50);
            $table->tinyInteger('cast_id');
            $table->string('religion',50);
            $table->tinyInteger('religion_id');
            $table->string('education',50);
            $table->tinyInteger('education_id');
            $table->string('work',50);
            $table->tinyInteger('work_id');
            $table->string('smoking',50);
            $table->tinyInteger('smoking_id');
            $table->string('drinking',50);
            $table->tinyInteger('drinking_id');
            $table->string('residency',50);
            $table->string('body_type',50);
            $table->string('appearance',50);            
            $table->string('living_with',50);

            /* search criteria*/            
            $table->string('age_preference',50);
            $table->tinyInteger('age_min');
            $table->tinyInteger('age_max');
            $table->string('relationship',50);
            $table->tinyInteger('relationship_id');

            /* foreign key column*/
            $table->integer('profileimage_id')->unsigned()->nullable(); 
            $table->string('profileimage',20)->default('user.gif');

            /* account details*/
            $table->boolean('email_verified')->default(0);      
            $table->tinyInteger('profile_status')->default(0);  // 0-pending, 1-approved, 2-rejected, 4-blocked
            $table->tinyInteger('member_type')->default(0);     // 0-user, 1-power user, 2-moderator, 3-admin
            $table->tinyInteger('user_type')->default(0);       // 0-normal user, 1-paid
            $table->date('last_login'); 
            $table->boolean('online');
            $table->string('token',20)->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('f_name');
			$table->string('l_name');
			$table->string('gender');
			$table->date('dob');
			$table->longText('about_me');
			$table->string('education');
			$table->string('employment_status');
			$table->string('income_range');
			$table->string('relationship_status');
			$table->string('first_address');
			$table->string('alternate_address');
			$table->string('contact_no');
			$table->string('city');
			$table->string('state');
			$table->string('country');
			$table->string('zipcode');
			$table->string('website');
			$table->string('user_avtar');			
			$table->foreign('USER_ID')->references('id')->on('users');
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
		Schema::drop('profiles');
	}

}

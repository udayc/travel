<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		//			
		//$table->integer('project_id')->unsigned()->default(0);
		//$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
			
		Schema::table('users' , function(Blueprint $table)
		{
			$table->string('username' , 100)->after('name');
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

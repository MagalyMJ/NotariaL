<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('participants', function(Blueprint $table)
		{
			
			$table->integer('case_id')->unsigned();
			
			$table->integer('customer_id')->unsigned();

			$table->string('participants_type');

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
		Schema::drop('participants');
	}

}

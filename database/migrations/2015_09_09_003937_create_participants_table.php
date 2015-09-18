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
			$table->increments('id');
			
			$table->integer('customer_id')->unsigned();
			$table->foreign('customer_id')->references('id')->on('customer');

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

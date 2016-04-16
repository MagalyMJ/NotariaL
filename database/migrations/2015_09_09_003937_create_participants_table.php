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
		Schema::create('case_service_customer', function(Blueprint $table)
		{
			
			$table->integer('case_service_id')->unsigned();
			
			$table->integer('customer_id')->unsigned();

			$table->string('participants_type');

			$table->mediumText('documents_list');
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
		Schema::drop('case_service_customer');
	}

}

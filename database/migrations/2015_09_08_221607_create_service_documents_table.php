<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// this table es the result of many to many between documents table and servcies table
		Schema::create('document_service', function(Blueprint $table)
		{
			$table->integer('service_id')->unsigned();
			$table->integer('document_id')->unsigned();
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
		Schema::drop('document_service');
	}

}

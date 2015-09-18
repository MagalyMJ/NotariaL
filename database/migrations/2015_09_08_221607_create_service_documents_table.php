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
		Schema::create('service_documents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('document_id')->unsigned();

			$table->foreign('document_id')->references('id')->on('documents');
			
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
		Schema::drop('service_documents');
	}

}

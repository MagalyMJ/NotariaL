<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('service', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name');
			$table->enum('service_type',['enagenante','no_enagenante']);


			$table->integer('document_id')->unsigned();
			$table->foreign('document_id')->references('id')->on('documents');
			
			$table->integer('expense_id')->unsigned();
			$table->foreign('expense_id')->references('id')->on('expenses');

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
		//
	}

}

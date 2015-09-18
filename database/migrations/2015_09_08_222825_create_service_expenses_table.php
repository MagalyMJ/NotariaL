<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceExpensesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// this table es the result of many to many between expenses table and servcies table
		Schema::create('expense_service', function(Blueprint $table)
		{
			$table->integer('service_id')->unsigned();
			$table->integer('expense_id')->unsigned();
			$table->integer('cost')->unsigned();
			
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
		Schema::drop('expense_service');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('budget', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('user_id')->unsigned();

			$table->boolean('approved');
			$table->boolean('invoiced');
			$table->enum('payment_type',['efectivo','transferencia','cheque']);
			$table->float('operation_value')->unsigned();
			$table->float('cost')->unsigned();
			$table->float('commission')->unsigned();
			$table->float('travel_expenses')->unsigned();
			$table->float('isr')->unsigned();
			$table->float('miscellaneous_expense')->unsigned();
			$table->float('advance_payment')->unsigned();
			$table->float('surcharges')->unsigned();
			$table->float('isnjin')->unsigned();
			$table->float('discount')->unsigned();
			
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
		Schema::drop('budget');
	}

}

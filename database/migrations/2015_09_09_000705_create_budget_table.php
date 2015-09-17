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
			
			$table->integer('service_id')->unsigned();
			$table->foreign('service_id')->references('id')->on('service');

			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');

			$table->boolean('approved');
			$table->boolean('invoiced');
			$table->enum('payment_type',['efectivo','transferencia','cheque']);
			$table->float('operatin_value')->unsigned();
			$table->float('cost')->unsigned();
			$table->float('commission')->unsigned();
		
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

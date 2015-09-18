<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('address', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('custumer_id')->unsigned();

			$table->string('street');
			$table->string('number');
			$table->string('colony');
			$table->integer('postal_code');
			$table->text('observations');
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
		Schema::drop('address');
	}

}

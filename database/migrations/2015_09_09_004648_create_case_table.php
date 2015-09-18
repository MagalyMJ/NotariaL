<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('case', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('participants_id')->unsigned();
			
			$table->integer('budget_id')->unsigned();

			$table->string('place');
			$table->enum('progress',['0','25','33','50','66','75','99','100']);
			$table->mediumText('observations');

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
		Schema::drop('case');
	}

}

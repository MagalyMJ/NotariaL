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
			
			$table->integer('budget_id')->unsigned(); //prespuesto 
			
			$table->integer('service_id')->unsigned(); //tipo de servicio

			$table->string('place'); // Lugar donde se realiza 
			$table->enum('progress',['0','25','33','50','66','75','99','100']); //progreso
			$table->enum('notices',['Sin','Primer','Segundo']); // avisos al caso 
			$table->mediumText('observations');//observaciones 
			$table->mediumText('service_detail'); //detalles del servicio

            $table->float('remaining')->unsigned(); // Restante a pagar (del total del prespuesto aprovado - los pagos y el atisipo)
            
            $table->date('notices_one_date'); 
            $table->date('notices_two_date'); 

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

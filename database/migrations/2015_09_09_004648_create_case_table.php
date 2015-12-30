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
			$table->enum('progress',['0','10','25','33','50','66','75','99','100']); //progreso
			$table->enum('notices',['Sin','Primer','Segundo']); // avisos al caso 
			$table->mediumText('observations');//observaciones 
			$table->mediumText('service_detail'); //detalles del servicio

            $table->float('remaining')->unsigned(); // Restante a pagar (del total del prespuesto aprovado - los pagos y el atisipo)
            
            $table->date('notices_one_date'); //fecha del primer aviso 
            $table->date('notices_two_date'); //fecha del segundo aviso
            $table->date('public_register'); //fecha de registro
            $table->integer('voucher')->unsigned(); //Nº de volante que dan en el registro publico
            $table->date('voucher_date'); //fecha de acuse de registro

            $table->boolean('signature'); //booleano de comprovacion de firma
			
			$table->integer('N_write')->unsigned(); //Numero de escritura

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

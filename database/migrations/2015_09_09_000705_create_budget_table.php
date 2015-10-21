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

			$table->float('fee')->unsigned();//Honorarios

			$table->float('commission')->unsigned();//Comicion

			$table->boolean('approved');//Aprovado
			$table->boolean('invoiced');//Facturado	
			$table->enum('payment_type',['efectivo','transferencia','cheque']); //tipo de Pago 
			$table->float('miscellaneous_expense')->unsigned();//Gastos Varios
			$table->float('discount')->unsigned();//Descuento de Honorarios
			$table->float('advance_payment')->unsigned();//Antisipo
			$table->float('travel_expenses')->unsigned();//Gastos de Viaje
			$table->float('surcharges')->unsigned();//Recargos
			$table->float('total')->unsigned();//Total

			$table->float('operation_value')->unsigned();//Valor de operacion
			$table->float('isr')->unsigned();//ISR
			$table->float('isabi')->unsigned();//ISABI 2% del Valor de Operación para todos los servicios  que lo necesiten (exepto en Donación en Aguascalientes hay es 0%) - conjugues parientes de primer grado no aplica
			$table->float('isnjin')->unsigned();//ISNIJ
			
			
			
			
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

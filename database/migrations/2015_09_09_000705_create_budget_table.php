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
			
			$table->boolean('approved');//Aprovado
			$table->boolean('invoiced');//Facturado	
			$table->enum('payment_type',['efectivo','transferencia','cheque']); //tipo de Pago 
			$table->float('discount')->unsigned();//Descuento de Honorarios
			$table->float('advance_payment')->unsigned();//Antisipo
			$table->float('total')->unsigned();//Costo
			$table->float('commission')->unsigned();//Comicion
			$table->float('travel_expenses')->unsigned();//Gastos de Viaje
			$table->float('miscellaneous_expense')->unsigned();//Gastos Varios
			$table->float('surcharges')->unsigned();//Recargos
			$table->float('iva')->unsigned();// el iva que se necesitara si tiene que star facturado
			$table->float('sub_total')->unsigned();// subtotal es la suma de los honorarios mas el iva (aun no se agregan los demas gastos)

			$table->float('fee')->unsigned();//Honorarios
			$table->float('operation_value')->unsigned();//Valor de operacion

			$table->float('isr')->unsigned();//ISR
			$table->float('isnjin')->unsigned();//ISNIJ
			$table->float('isabi')->unsigned();//ISABI es 2% del Valor de Operación para todos los servicios  que lo necesiten (exepto en Donación en Aguascalientes hay es 0%)
			$table->float('property_valuation')->unsigned();//El Avaluo Catastral se efecutuara y tendra un costo
			$table->float('commercial_appraisal')->unsigned();//Avaluo Comercial se efecutuara y tendra un costo
			$table->float('writing_management')->unsigned();//Gestion de escritura se llevara acabo y tendra un costo 
			$table->integer('n_registration')->unsigned();//numero de registros (lotes, Propiedades,Cancelaciones Hipoteca)
			$table->float('total_registration_costs')->unsigned();//total del gasto que se llevara por los registros
			$table->integer('n_certificates')->unsigned();// numero de certificados
			$table->integer('total_certified_expenditure')->unsigned();// total del gasto por los certificados
			$table->integer('edicts')->unsigned();// Edictos Este es solo de haceptaccion de Herencia 
			$table->integer('n_extra_hours')->unsigned();//numero de horas extra 
			$table->integer('total_extra_hours')->unsigned();//numero de horas extra 
			$table->integer('n_extra_paper')->unsigned();//numero de hojas extra extra 
			$table->integer('total_extra_paper')->unsigned();//numero de hojas extra extra 
			
			
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

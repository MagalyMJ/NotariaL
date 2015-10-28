<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function(Blueprint $table)
        {
            $table->increments('id'); //id del pago 

            $table->integer('case_service_id')->unsigned(); //id del caso al que petenence

            $table->string('name'); //nombre de quien realiza el pago 
            $table->enum('payment_type',['efectivo','transferencia','cheque']); //tipo de Pago 
            $table->float('amount_to_pay')->unsigned(); // monto a pagar


            $table->timestamps(); //fecha de creacion y ultima actualizacion 
            
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
        Schema::drop('payments');
    }
}

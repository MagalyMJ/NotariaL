<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Expense;

class CatalogExpensesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          //
        $expneses = array(
        	'Honorarios',
        	'Gastos de Registro',
        	'Gestoria de Escritura',
        	'ISNJIN',
        	'ISR',
        	'ISABI',
        	'Edictos',
        	'Certificacion',
        	'Recargos',
        	'Avaluo Catastral',
        	'Avaluo Comercial',

        	);

    	foreach ($expneses  as $expnese => $name){

        	$expnese = new Expense;

       		$expnese->expense_name = $name;

        	$expnese->save();

    	}

    }
}

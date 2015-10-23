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
        	'Valor de Operación',
        	'Gastos de Registro',
        	'Nº Propiedades',
        	'Nº Registros',
        	'Nº Lotes',
        	'Cacelacion de Hipotecas',
        	'Nº Hipotecas Canceladas',
        	'Gestoria de Escritura',
        	'ISNJIN',
        	'ISR',
        	'ISABI',
        	'Edictos',
        	'Certificados',
        	'NºCertificados',
        	'Recargos',
        	'Avalúo Catastral',
        	'Avalúo Comercial',
        	'Honorarios Por Pernsona Moral',
        	'Honorarios Por Pernsona Fisica',
        	'Honorarios Por Hora Extra',
        	'Nº Hora Extra',
        	'Honorarios Por Hoja Extra',
        	'Nº Hojas Extra',
        	);

    	foreach ($expneses  as $expnese => $name){

        	$expnese = new Expense;

       		$expnese->expense_name = $name;

        	$expnese->save();

    	}

    }
}

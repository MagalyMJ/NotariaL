<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\ParticipantType ;

class CatalogParticipantType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          $participants  = array(
        	'Heredero/a',
        	'Albacea',
        	'Solicitante',
        	'Socio',
        	'Adquiriente',
        	'Deudor',
        	'Vendedor',
        	'Comprador',
        	'Acreedor',
        	'Donante',
        	'Donatario',
        	'Esposo/a',
        	'Adquiriente/Enajenante',
        	'Poderdante',
        	'Apoderado',
        	'Testigo',
        	'Testador',
        	);

    	foreach ($participants  as $participant => $name){

        	$participant = new ParticipantType ;

       		$participant->name = $name;

        	$participant->save();

    	}
    }
}

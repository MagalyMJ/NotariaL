<?php

use Illuminate\Database\Seeder;
use NotiAPP\Models\Document;
class CatalogDocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $documents = array(
        	'Identificación',
        	'IFE',
        	'Escrituras',
        	'Recibo de luz',
        	'Recibo de Agua',
        	'Recibo de Mantenimiento',
        	'Acta de Nacimiento',
        	'Avaluo',
        	'Objeto Social',
        	'Monto de Capital',
        	'Regimen de sociedad',
        	'Certificado De Libertad Degradable',
        	'Predial',
        	'Terminos de Contrato',
        	'Expediente de Jusgado',
        	'Poder Anterior',
            'Testamento',
        	'Acta de Matrimonio',
        	'Documentos Originales',
        	'Copia de Documentos',
        	'Acta de Asamble',
        	'Antecedentes',
        	'Subdivicion',
        	'Alineamiento',
        	'Antecendentes de Credito',
        	'Certificado de Cadanen',
        	'Escrituras de Certificado de Gradaben',
        	'Orden de Cancelacion',
        	'Carta de No Adeudo',
        	'Expediente del Jusgado',
        	);

    	foreach ($documents  as $document => $name){

        	$document = new Document;

       		$document->document_name = $name;

        	$document->save();

    	}


    }
}

<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;


class ServiceAdjudicacionJudicialSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
           $service = new Service;

      /* en DatabaseSeeder.php se ejecuta primero el seeder del Catalogo de Documentos
          los buscamos para no generar duplisidad y lo vinculamos 
         */
        /* Obtenemos los Id's de los cocumentos que tienen este nombre (array) */
        $IdentificationID = Document::where('document_name', 'Identificación')->get();
         /* Los buscamos para obtener un modelo Eloquent para poder relacionalros  */
        $Identification= Document::find($IdentificationID[0]->id); 

        $ExpedienteJusgadoID = Document::where('document_name', 'Expediente del Jusgado')->get();
        $ExpedienteJusgado = Document::find($ExpedienteJusgadoID[0]->id); 

        $PredialID= Document::where('document_name', 'Predial' )->get();
        $Predial = Document::find($PredialID[0]->id);


        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Adjudicación Judicial';
         $service->service_type = 1; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        // Docuemtos que lleva el vendedor 
        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Adquiriente']);
        $ExpedienteJusgado = $serviceFind->document_service()->save($ExpedienteJusgado,['participants_type' => 'Adquiriente']);
        $Predial = $serviceFind->document_service()->save($Predial,['participants_type' => 'Adquiriente']);
        
     
    }
}

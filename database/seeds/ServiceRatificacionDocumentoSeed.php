<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;

class ServiceRatificacionDocumentoSeed extends Seeder
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

        $DocumentosOriginalesID = Document::where('document_name', 'Documentos Originales')->get();
        $DocumentosOriginales = Document::find($DocumentosOriginalesID[0]->id); 


        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Cotejo y Ratificacion';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        // Docuemtos que lleva el vendedor 
        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Solicitante']);
        $DocumentosOriginales= $serviceFind->document_service()->save($DocumentosOriginales,['participants_type' => 'Solicitante']);
     
     
    }
}

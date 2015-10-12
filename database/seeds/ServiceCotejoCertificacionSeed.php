<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;

class ServiceCotejoCertificacionSeed extends Seeder
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
        $service = new Service;

      /* en DatabaseSeeder.php se ejecuta primero el seeder del Catalogo de Documentos
          los buscamos para no generar duplisidad y lo vinculamos 
         */  

        $DocumentosOriginalesID = Document::where('document_name', 'Documentos Originales')->get();
         /* Los buscamos para obtener un modelo Eloquent para poder relacionalros  */
        $DocumentosOriginales= Document::find($DocumentosOriginalesID[0]->id); 

        $CopiaDocumentosID = Document::where('document_name', 'Copia de Documentos' )->get();
        $CopiaDocumentos = Document::find($CopiaDocumentosID[0]->id); 


        /* Asignamos los datos para Crear el Servicio*/

         $service->name = 'Cotejo y Certificación';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

       
        $DocumentosOriginales= $serviceFind->document_service()->save($DocumentosOriginales,['participants_type' => 'Solicitante']);
        $CopiaDocumentos = $serviceFind->document_service()->save($CopiaDocumentos,['participants_type' => 'Solicitante']);
        

    }
}

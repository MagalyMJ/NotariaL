<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;


class ServiceProtocolizarSubdireccionSeed extends Seeder
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

        $IdentificationID = Document::where('document_name', 'Identificación')->get();
        $Identification = Document::find($IdentificationID[0]->id); 

        $AlineamientoID = Document::where('document_name', 'Alineamiento' )->get();
        $Alineamiento = Document::find($AlineamientoID[0]->id); 

        $SubdivicionID = Document::where('document_name', 'Subdivicion' )->get();
        $Subdivicion = Document::find($SubdivicionID[0]->id);
         
        $EscriturasID = Document::where('document_name', 'Escrituras')->get();
        $Escrituras = Document::find($EscriturasID[0]->id); 


        /* Asignamos los datos para Crear el Servicio*/

         $service->name = 'Protocolización de Subdireccion';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

       
        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Solicitante']);
        $Alineamiento= $serviceFind->document_service()->save($Alineamiento,['participants_type' => 'Solicitante']);
        $Subdivicion = $serviceFind->document_service()->save($Subdivicion,['participants_type' => 'Solicitante']);
        $Escrituras = $serviceFind->document_service()->save($Escrituras,['participants_type' => 'Solicitante']);
        
    }
}

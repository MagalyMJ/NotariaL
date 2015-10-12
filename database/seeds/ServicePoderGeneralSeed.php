<?php

use Illuminate\Database\Seeder;
use NotiAPP\Models\Service;
use NotiAPP\Models\Document;

class ServicePoderGeneralSeed extends Seeder
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

       $IdentificationID = Document::where('document_name', 'Identificación')->get();
       $Identification = Document::find($IdentificationID[0]->id); 

        

        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Poder general';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

       
        $Identification  = $serviceFind->document_service()->save($Identification ,['participants_type' => 'Poderdante']);
        $Identification  = $serviceFind->document_service()->save($Identification ,['participants_type' => 'Apoderado']);
     
    }
}

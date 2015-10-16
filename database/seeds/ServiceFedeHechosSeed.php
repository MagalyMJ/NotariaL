<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;

class ServiceFedeHechosSeed extends Seeder
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

       /*Obtenemos el tipo de participante que coresponde a este servicio */
       $SolicitanteType = ParticipantType::where('name','Solicitante')->get(); 

        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Fe de Hechos';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

         $serviceFind->participant_type_service()->attach( $SolicitanteType[0]->id );

         $Identification  = $serviceFind->document_service()->save($Identification ,['participants_type' => $SolicitanteType[0]->name]);

    }
}

<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;

class ServiceActaAsambleaSeed extends Seeder
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

        $ActaAsambleaID = Document::where('document_name', 'Acta de Asamble' )->get();
        $ActaAsamblea = Document::find($ActaAsambleaID[0]->id); 
        
        $AntecedentesID = Document::where('document_name', 'Antecedentes' )->get();
        $Antecedentes = Document::find($AntecedentesID[0]->id); 

        /*Obtenemos el tipo de participante que coresponde a este servicio */
        $SolicitanteType = ParticipantType::where('name','Solicitante')->get(); 
        /* Asignamos los datos para Crear el Servicio*/

         $service->name = 'Protocolización de Acta de Asamblea';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        $serviceFind->participant_type_service()->attach( $SolicitanteType[0]->id );

        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Solicitante']);
        $ActaAsamblea = $serviceFind->document_service()->save($ActaAsamblea,['participants_type' => 'Solicitante']);
        $Antecedentes = $serviceFind->document_service()->save($Antecedentes,['participants_type' => 'Solicitante']);
        

    }
}

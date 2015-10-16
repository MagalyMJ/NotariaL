<?php

use Illuminate\Database\Seeder;
use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;

class ServiceIntestamentariaSeed extends Seeder
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

        $ifeID = Document::where('document_name', 'ife')->get(); 
        $ife = Document::find($ifeID[0]->id); 

        $ActaNacimentoID = Document::where('document_name', 'Acta de Nacimiento' )->get();
        $ActaNacimento = Document::find($ActaNacimentoID[0]->id); 

        $PredialID= Document::where('document_name', 'Predial' )->get();
        $Predial = Document::find($PredialID[0]->id);

        $AvaluoID = Document::where('document_name', 'Avaluo' )->get();
        $Avaluo = Document::find($AvaluoID [0]->id); 

        $EscriturasID = Document::where('document_name', 'Escrituras')->get();
        $Escrituras = Document::find($EscriturasID[0]->id); 

        $ExpedienteJusgadoID = Document::where('document_name', 'Expediente del Jusgado')->get();
        $ExpedienteJusgado = Document::find($ExpedienteJusgadoID[0]->id); 


        /*Obtenemos el tipo de participante que coresponde a este servicio */
        $HerederoType = ParticipantType::where('name','Heredero/a')->get(); 
  
        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Sucesión Intestamentaría';
         $service->service_type = 1; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        $serviceFind->participant_type_service()->attach($HerederoType[0]->id );

        $ife = $serviceFind->document_service()->save($ife ,['participants_type' => 'Heredero/a']);
        $ActaNacimento = $serviceFind->document_service()->save( $ActaNacimento ,['participants_type' => 'Heredero/a']);
        $Predial = $serviceFind->document_service()->save( $Predial,['participants_type' => 'Heredero/a']);
        $Avaluo  = $serviceFind->document_service()->save( $Avaluo ,['participants_type' => 'Heredero/a']);
        $Escrituras = $serviceFind->document_service()->save( $Escrituras ,['participants_type' => 'Heredero/a']);
        $ExpedienteJusgado = $serviceFind->document_service()->save( $ExpedienteJusgado ,['participants_type' => 'Heredero/a']);
     
    }
}

<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;

class ServiceMatrimonilesSeed extends Seeder
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

        $ActaMatrimonioID = Document::where('document_name', 'Acta de Matrimonio' )->get();
        $ActaMatrimonio = Document::find($ActaMatrimonioID[0]->id); 

        $PredialID= Document::where('document_name', 'Predial' )->get();
        $Predial = Document::find($PredialID[0]->id);

        $AvaluoID = Document::where('document_name', 'Avaluo' )->get();
        $Avaluo = Document::find($AvaluoID [0]->id); 

        $EscriturasID = Document::where('document_name', 'Escrituras')->get();
        $Escrituras = Document::find($EscriturasID[0]->id); 

        $CdLID = Document::where('document_name', 'Certificado De Libertad Degradable' )->get();
        $CdL = Document::find($CdLID[0]->id);  


        /*Obtenemos el tipo de participante que coresponde a este servicio */
        $EsposoType = ParticipantType::where('name','Esposo/a')->get(); 
  
        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Capitulaciones Matrimoniales';
         $service->service_type = 1; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);


        $serviceFind->participant_type_service()->attach($EsposoType[0]->id );

        $ActaMatrimonio = $serviceFind->document_service()->save( $ActaMatrimonio ,['participants_type' => 'Esposo/a']);
        $Predial = $serviceFind->document_service()->save( $Predial,['participants_type' => 'Esposo/a']);
        $Avaluo  = $serviceFind->document_service()->save( $Avaluo ,['participants_type' => 'Esposo/a']);
        $Escrituras = $serviceFind->document_service()->save( $Escrituras ,['participants_type' => 'Esposo/a']);
        $$CdL = $serviceFind->document_service()->save( $CdL ,['participants_type' => 'Esposo/a']);
     
    }
}

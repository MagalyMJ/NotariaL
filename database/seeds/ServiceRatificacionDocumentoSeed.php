<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;
use NotiAPP\Models\Expense;


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

        /*Obtenemos el tipo de participante que coresponde a este servicio */
        $SolicitanteType = ParticipantType::where('name','Solicitante')->get(); 

        /*Obtenemos los Cobros a considear para el Servicio*/
        $Honorarios = Expense::where('expense_name','Honorarios')->first();
        $ISNJIN = Expense::where('expense_name','ISNJIN')->first();

        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Cotejo y Ratificacion';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        //El costo de honorarios es de 2400 para este servicio
        $serviceFind->expenses()->attach( $Honorarios->id,['cost' => '2400'] );
        $serviceFind->expenses()->attach( $ISNJIN->id,['cost' => ''] );


        $serviceFind->participant_type_service()->attach($SolicitanteType[0]->id );

        // Docuemtos que lleva el vendedor 
        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Solicitante']);
        $DocumentosOriginales= $serviceFind->document_service()->save($DocumentosOriginales,['participants_type' => 'Solicitante']);
     
     
    }
}

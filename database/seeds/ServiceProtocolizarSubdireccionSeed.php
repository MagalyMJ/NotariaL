<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;
use NotiAPP\Models\Expense;


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


        /*Obtenemos el tipo de participante que coresponde a este servicio */
        $SolicitanteType = ParticipantType::where('name','Solicitante')->get(); 

        /*Obtenemos los Cobros a considear para el Servicio*/
        $Honorarios = Expense::where('expense_name','Honorarios')->first();
        $ISNJIN = Expense::where('expense_name','ISNJIN')->first();
        $Registro = Expense::where('expense_name','Gastos de Registro')->first(); 
        $RegistroN = Expense::where('expense_name','Nº Lotes')->first(); 

        /* Asignamos los datos para Crear el Servicio*/

         $service->name = 'Protocolización de Subdivisión';
         $service->service_type = 2; 
         $service->icon_path = 'img/icons/services/protocolizacion_Subdivision.ico';  
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        //El costo de honorarios es de 4500 para este servicio
        $serviceFind->expenses()->attach( $Honorarios->id,['cost' => '4500','input_name' => 'honorarios' ,'type_input' => 'hidden' ] );
        //Este es requerdio para el presupeusto de este tipo de servicios pero es un valor que nos van a integrar 
        $serviceFind->expenses()->attach( $ISNJIN->id,['cost' => '','input_name' => 'isnjin','type_input' => 'text' ] );
        //Estos hay que Multiplicarlos por el numero de LOTEs que se tengan que Subdividir para resgistrarlos 
        $serviceFind->expenses()->attach($Registro->id,['cost' => '400','input_name' => 'gastos_registro','type_input' => 'hidden'] );
        $serviceFind->expenses()->attach($RegistroN->id,['cost' => '0','input_name' => 'ngastros_registro','type_input' => 'number'] );


        $serviceFind->participant_type_service()->attach($SolicitanteType[0]->id );
       
        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Solicitante']);
        $Alineamiento= $serviceFind->document_service()->save($Alineamiento,['participants_type' => 'Solicitante']);
        $Subdivicion = $serviceFind->document_service()->save($Subdivicion,['participants_type' => 'Solicitante']);
        $Escrituras = $serviceFind->document_service()->save($Escrituras,['participants_type' => 'Solicitante']);
        
    }
}

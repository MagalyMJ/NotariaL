<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;
use NotiAPP\Models\Expense;

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

        /*Obtenemos los Cobros a considear para el Servicio*/
        $Honorarios = Expense::where('expense_name','Honorarios')->first();
        $ISNJIN = Expense::where('expense_name','ISNJIN')->first();
        $Registro = Expense::where('expense_name','Gastos de Registro')->first(); 
        $RegistroN = Expense::where('expense_name','Nº Registros')->first(); 

        /* Asignamos los datos para Crear el Servicio*/

         $service->name = 'Protocolización de Acta de Asamblea';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        //El costo de honorarios es de 4500 para este servicio
        $serviceFind->expenses()->attach( $Honorarios->id,['cost' => '4500','input_name' => 'honorarios' ,'type_input' => 'hidden' ] );
        //Este es requerdio para el presupeusto de este tipo de servicios pero es un valor que nos van a integrar 
        $serviceFind->expenses()->attach( $ISNJIN->id,['cost' => '','input_name' => 'isnjin','type_input' => 'text' ] );
        $serviceFind->expenses()->attach($Registro->id,['cost' => '600','input_name' => 'gastos_registro','type_input' => 'hidden'] );
        $serviceFind->expenses()->attach($RegistroN->id,['cost' => '1','input_name' => 'ngastos_resgistro','type_input' => 'hidden'] );

        $serviceFind->participant_type_service()->attach( $SolicitanteType[0]->id );

        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Solicitante']);
        $ActaAsamblea = $serviceFind->document_service()->save($ActaAsamblea,['participants_type' => 'Solicitante']);
        $Antecedentes = $serviceFind->document_service()->save($Antecedentes,['participants_type' => 'Solicitante']);
        

    }
}

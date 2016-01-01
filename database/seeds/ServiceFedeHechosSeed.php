<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;
use NotiAPP\Models\Expense;

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


        /*Obtenemos los Cobros a considear para el Servicio*/
        $Honorarios = Expense::where('expense_name','Honorarios')->first();
        $HonorariosExtra = Expense::where('expense_name','Honorarios Por Hora Extra')->first();
        $HonorariosExtraN = Expense::where('expense_name','Nº Hora Extra')->first();
        $ISNJIN = Expense::where('expense_name','ISNJIN')->first();

        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Fe de Hechos';
         $service->service_type = 2; 
         $service->icon_path = 'img/icons/services/fe_de_Hechos.ico';   
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        //El costo de honorarios es de 2000 por la primer hora 
        $serviceFind->expenses()->attach( $Honorarios->id,['cost' => '2000','input_name' => 'honorarios' ,'type_input' => 'hidden' ] );
        //El costo de honorarios despues de la primer hora se aplicaran 1000 Por cada Hora extra
        $serviceFind->expenses()->attach( $HonorariosExtra->id,['cost' => '1000','input_name' => 'hora_extra','type_input' => 'checkbox' ] );
        $serviceFind->expenses()->attach( $HonorariosExtraN->id,['cost' => '0','input_name' => 'nhora_extra','type_input' => 'number' ] );
        //Este es requerdio para el presupeusto de este tipo de servicios pero es un valor que nos van a integrar 
        $serviceFind->expenses()->attach( $ISNJIN->id,['cost' => '','input_name' => 'isnjin','type_input' => 'text' ] );

         $serviceFind->participant_type_service()->attach( $SolicitanteType[0]->id );

         $Identification  = $serviceFind->document_service()->save($Identification ,['participants_type' => $SolicitanteType[0]->name]);

    }
}

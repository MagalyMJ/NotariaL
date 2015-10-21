<?php

use Illuminate\Database\Seeder;
use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;
use NotiAPP\Models\Expense;

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


        /*Obtenemos el tipo de participante que coresponde a este servicio */
        $PoderdanteType = ParticipantType::where('name','Poderdante')->get(); 
        $ApoderadoType = ParticipantType::where('name','Apoderado')->get(); 
         
        /*Obtenemos los Cobros a considear para el Servicio*/
        $HMoral = Expense::where('expense_name','Honorarios Por Pernsona Moral')->first();
        $HFisica = Expense::where('expense_name','Honorarios Por Pernsona Fisica')->first();
        $Gestoria = Expense::where('expense_name','Gestoria de Escritura')->first();
        $ISNJIN = Expense::where('expense_name','ISNJIN')->first();
        $Registro = Expense::where('expense_name','Gastos de Registro')->first();
        

        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Poder General';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        //El costo de Honorarios del presupuesto dependera a que tipo de pesona le dara el servicio
        $serviceFind->expenses()->attach( $HMoral->id,['cost' => '3000','input_name' => 'honorarios' ,'type_input' => 'radio' ] );
        $serviceFind->expenses()->attach( $HFisica->id,['cost' => '2000','input_name' => 'honorarios' ,'type_input' => 'radio' ] );
        // Aplica a todos los municipios ( menos en la capital ) $1500  todos los servicios que la necesiten
        $serviceFind->expenses()->attach( $Gestoria->id,['cost' => '1500','input_name' => 'gestoria','type_input' => 'checkbox' ] );
        //Este es requerdio para el presupeusto de este tipo de servicios pero es un valor que nos van a integrar 
        $serviceFind->expenses()->attach( $ISNJIN->id,['cost' => '','input_name' => 'isnjin' ,'type_input' => 'text' ] );

        $serviceFind->expenses()->attach($Registro->id,['cost' => '600','input_name' => 'gastros_registro','type_input' => 'checkbox'] );


        $serviceFind->participant_type_service()->attach($PoderdanteType[0]->id );
        $serviceFind->participant_type_service()->attach($ApoderadoType[0]->id );

       
        $Identification  = $serviceFind->document_service()->save($Identification ,['participants_type' => 'Poderdante']);
        $Identification  = $serviceFind->document_service()->save($Identification ,['participants_type' => 'Apoderado']);
     
    }
}

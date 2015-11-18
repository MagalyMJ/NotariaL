<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\Expense;
use NotiAPP\Models\ParticipantType;

class ServiceCancelacionHipotecaSeed extends Seeder
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

        $EscriturasCertificadoID = Document::where('document_name', 'Escrituras de Certificado de Gravamen')->get();
        $EscriturasCertificado = Document::find($EscriturasCertificadoID[0]->id); 

        $OrdendeCancelacionID = Document::where('document_name', 'Orden de Cancelacion')->get();
        $OrdendeCancelacion = Document::find($OrdendeCancelacionID[0]->id); 

        $CartaNoAdeudoID = Document::where('document_name', 'Carta de No Adeudo')->get();
        $CartaNoAdeudo = Document::find($CartaNoAdeudoID[0]->id); 
        
        /*Obtenemos el tipo de participante que coresponde a este servicio */
        $DeudorType = ParticipantType::where('name','Deudor')->get(); 

        /*Obtenemos los Cobros a considear para el Servicio*/
        $Honorarios1 = Expense::where('expense_name','Honorarios Por Pernsona Fisica')->first();
        $Honorarios2 = Expense::where('expense_name','Honorarios Por Cancelacion Banco')->first();
        $Honorarios3 = Expense::where('expense_name','Honorarios Por Cancelacion Infonavit')->first();
        $ISNJIN = Expense::where('expense_name','ISNJIN')->first();
        $Registro = Expense::where('expense_name','Gastos de Registro')->first(); 
        $RegistroN = Expense::where('expense_name','Nº Registros')->first();  


        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Cancelacion de Hipoteca';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        //El costo de honorarios es de 2200 si es una cancelacion de Infonavit
        $serviceFind->expenses()->attach( $Honorarios3->id,['cost' => '2200','input_name' => 'honorarios' ,'type_input' => 'radio' ] );  
        //El costo de honorarios es de 2400 si es una cancelacion de una persona Fisica
        $serviceFind->expenses()->attach( $Honorarios1->id,['cost' => '2400','input_name' => 'honorarios' ,'type_input' => 'radio' ] );
        //El costo de honorarios es de 3000 si es una cancelacion Para un Banco
        $serviceFind->expenses()->attach( $Honorarios2->id,['cost' => '3000','input_name' => 'honorarios' ,'type_input' => 'radio' ] );
        //Este es requerdio para el presupeusto de este tipo de servicios pero es un valor que nos van a integrar 
        $serviceFind->expenses()->attach( $ISNJIN->id,['cost' => '','input_name' => 'isnjin','type_input' => 'text' ] );
        //Esta relacioando con la Dacion en Pagos 
        $serviceFind->expenses()->attach($Registro->id,['cost' => '250','input_name' => 'gastos_registro','type_input' => 'hidden'] );
        $serviceFind->expenses()->attach($RegistroN->id,['cost' => '1','input_name' => 'ngastos_resgistro','type_input' => 'hidden'] );

       
        $serviceFind->participant_type_service()->attach($DeudorType[0]->id );
       
        $EscriturasCertificado  = $serviceFind->document_service()->save($EscriturasCertificado ,['participants_type' => 'Deudor']);
        $OrdendeCancelacion  = $serviceFind->document_service()->save($OrdendeCancelacion ,['participants_type' => 'Deudor']);
        $CartaNoAdeudo  = $serviceFind->document_service()->save($CartaNoAdeudo ,['participants_type' => 'Deudor']);
     
    }
}

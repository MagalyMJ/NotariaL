<?php

use Illuminate\Database\Seeder;
use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;
use NotiAPP\Models\Expense;

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

           /*Obtenemos los Cobros a considear para el Servicio*/
        $Honorarios = Expense::where('expense_name','Honorarios')->first();
        $ValorOperacion = Expense::where('expense_name','Valor de Operación')->first();
        $ISABI = Expense::where('expense_name','ISABI')->first();
        $Comercial = Expense::where('expense_name','Avalúo Comercial')->first();
        $ISR = Expense::where('expense_name','ISR')->first();
        $Certificacion = Expense::where('expense_name','Certificados')->first();
        $CertifcadosN = Expense::where('expense_name','NºCertificados')->first();
        $Registro = Expense::where('expense_name','Gastos de Registro')->first();
        $RegistroN = Expense::where('expense_name','Nº Propiedades')->first();

  
        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Sucesiónes Intestamentaría';
         $service->service_type = 1; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

         //El costo de honorarios se deja vacio porque se calcula en base al valor de operacion
        $serviceFind->expenses()->attach( $Honorarios->id,['cost' => '','input_name' => 'honorarios' ,'type_input' => 'hidden' ] );

        //El valor de operacion se deja vacio porque se sera un dato de entrada
        $serviceFind->expenses()->attach( $ValorOperacion->id,['cost' => '','input_name' => 'valor_operacion' ,'type_input' => 'text' ] );

        //este es requerido pero su valor sera dependiendo del valor de operacion ISABI = 2% del Valor de Operación todos los servicios (exepto en Donación en Aguascalientes hay es 0%) - conjugues parientes de primer grado no aplica
        $serviceFind->expenses()->attach( $ISABI->id,['cost' => '','input_name' => 'isabi','type_input' => 'hidden' ] );
        //Todos los servcios con ISABI llevan avaluo comercial
        $serviceFind->expenses()->attach( $Comercial->id,['cost' => '1300','input_name' => 'avaluo_comercial','type_input' => 'checkbox'] );
        //Este es requerdio para el presupeusto de este tipo de servicios pero es un valor que nos van a integrar 
        $serviceFind->expenses()->attach( $ISR->id,['cost' => '','input_name' => 'isr','type_input' => 'text' ] );
        //estos hay que multiplicarlos por el numero de certificados que se realizaran el cual es un dato de entrada
        $serviceFind->expenses()->attach($Certificacion->id,['cost' => '200','input_name' => 'certificados','type_input' => 'hidden' ] );
        //numero de certificados
        $serviceFind->expenses()->attach($CertifcadosN->id,['cost' => '0','input_name' => 'ncertificados','type_input' => 'number' ] );

        //los gastos de registro de este servicio dependen del numero de propiedades 
        $serviceFind->expenses()->attach($Registro->id,['cost' => '500','input_name' => 'gastos_registro','type_input' => 'hidden'] );
        $serviceFind->expenses()->attach($RegistroN->id,['cost' => '0','input_name' => 'ngastos_resgistro','type_input' => 'number'] );



        $serviceFind->participant_type_service()->attach($HerederoType[0]->id );

        $ife = $serviceFind->document_service()->save($ife ,['participants_type' => 'Heredero/a']);
        $ActaNacimento = $serviceFind->document_service()->save( $ActaNacimento ,['participants_type' => 'Heredero/a']);
        $Predial = $serviceFind->document_service()->save( $Predial,['participants_type' => 'Heredero/a']);
        $Avaluo  = $serviceFind->document_service()->save( $Avaluo ,['participants_type' => 'Heredero/a']);
        $Escrituras = $serviceFind->document_service()->save( $Escrituras ,['participants_type' => 'Heredero/a']);
        $ExpedienteJusgado = $serviceFind->document_service()->save( $ExpedienteJusgado ,['participants_type' => 'Heredero/a']);
     
    }
}

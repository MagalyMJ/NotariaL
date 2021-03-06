<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\Expense;


class ServiceDacionPagoSeed extends Seeder
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

        $EscriturasID = Document::where('document_name', 'Escrituras')->get();
        $Escrituras = Document::find($EscriturasID[0]->id); 

        $PredialID= Document::where('document_name', 'Predial' )->get();
        $Predial = Document::find($PredialID[0]->id);  

        $CertificadoCadanenID= Document::where('document_name', 'Certificado de Cadanen' )->get();
        $CertificadoCadanen = Document::find($CertificadoCadanenID[0]->id);  

        $AvaluoID = Document::where('document_name', 'Avaluo' )->get();
        $Avaluo = Document::find($AvaluoID [0]->id); 

        /*Obtenemos los Cobros a considear para el Servicio*/
        $Honorarios = Expense::where('expense_name','Honorarios')->first();
        $ValorOperacion = Expense::where('expense_name','Valor de Operación')->first();
        $Catastral = Expense::where('expense_name','Avalúo Catastral')->first();
        $ISABI = Expense::where('expense_name','ISABI')->first();
        $Comercial = Expense::where('expense_name','Avalúo Comercial')->first();
        $ISR = Expense::where('expense_name','ISR')->first();
        $Registro = Expense::where('expense_name','Gastos de Registro')->first();
        $RegistroN = Expense::where('expense_name','Nº Propiedades')->first();
        $CacelacionHipotecas = Expense::where('expense_name','Cacelacion de Hipotecas')->first();
        $CacelacionHipotecasN = Expense::where('expense_name','Nº Hipotecas Canceladas')->first();

            
        /* Asignamos los datos para Crear el Servicio*/

         $service->name = 'Dacion en Pago';
         $service->service_type = 1; 
         $service->icon_path = 'img/icons/services/dacion_en_Pago.ico';  
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);


        //El costo de honorarios se deja vacio porque se calcula en base al valor de operacion
        $serviceFind->expenses()->attach( $Honorarios->id,['cost' => '','input_name' => 'honorarios' ,'type_input' => 'hidden' ] );

        //El valor de operacion se deja vacio porque se sera un dato de entrada
        $serviceFind->expenses()->attach( $ValorOperacion->id,['cost' => '','input_name' => 'valor_operacion' ,'type_input' => 'text' ] );

        $serviceFind->expenses()->attach( $Catastral->id,['cost' => '120','input_name' => 'avaluo_catastral','type_input' => 'checkbox' ] );
        
        //este es requerido pero su valor sera dependiendo del valor de operacion ISABI = 2% del Valor de Operación todos los servicios (exepto en Donación en Aguascalientes hay es 0%) - conjugues parientes de primer grado no aplica
        $serviceFind->expenses()->attach( $ISABI->id,['cost' => '','input_name' => 'isabi','type_input' => 'hidden' ] );
        //Todos los servcios con ISABI llevan avaluo comercial
        $serviceFind->expenses()->attach( $Comercial->id,['cost' => '1300','input_name' => 'avaluo_comercial','type_input' => 'checkbox'] );
        //Este es requerdio para el presupeusto de este tipo de servicios pero es un valor que nos van a integrar 
        $serviceFind->expenses()->attach( $ISR->id,['cost' => '','input_name' => 'isr','type_input' => 'text' ] );
        //los gastos de registro de este servicio dependen del numero de propiedades 
        $serviceFind->expenses()->attach($Registro->id,['cost' => '500','input_name' => 'gastos_registro','type_input' => 'hidden'] );
        $serviceFind->expenses()->attach($RegistroN->id,['cost' => '0','input_name' => 'ngastos_resgistro','type_input' => 'number'] );
        //En este servicio se considearan un gasto las cancelaciones de hipoteca 
        $serviceFind->expenses()->attach($CacelacionHipotecas->id,['cost' => '250','input_name' => 'cancelacion_hipoteca','type_input' => 'checkbox'] );
        $serviceFind->expenses()->attach($CacelacionHipotecasN->id,['cost' => '0','input_name' => 'ncancelacion_hipoteca','type_input' => 'number'] );

        
       
        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Acreedor']);

        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Deudor']);
        $Escrituras = $serviceFind->document_service()->save($Escrituras,['participants_type' => 'Deudor']);
        $Predial  = $serviceFind->document_service()->save($Predial ,['participants_type' => 'Deudor']);
        $CertificadoCadanen  = $serviceFind->document_service()->save($CertificadoCadanen ,['participants_type' => 'Deudor']);
        $Avaluo = $serviceFind->document_service()->save($Avaluo ,['participants_type' => 'Deudor']);
        

    }
}

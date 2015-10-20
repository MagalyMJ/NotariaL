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
        $Catastral = Expense::where('expense_name','Avalúo Catastral')->first();
        $ISABI = Expense::where('expense_name','ISABI')->first();
        $Comercial = Expense::where('expense_name','Avalúo Comercial')->first();
        $ISR = Expense::where('expense_name','ISR')->first();
        $Registro = Expense::where('expense_name','Gastos de Registro')->first();

        /* Asignamos los datos para Crear el Servicio*/

         $service->name = 'Dacion en Pago';
         $service->service_type = 1; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);


        //El costo de honorarios se deja vacio porque se calcula en base al valor de operacion
        $serviceFind->expenses()->attach( $Honorarios->id,['cost' => ''] );
        $serviceFind->expenses()->attach( $Catastral->id,['cost' => '120'] );
        //este es requerido pero su valor sera dependiendo del valor de operacion ISABI = 2% del Valor de Operación todos los servicios (exepto en Donación en Aguascalientes hay es 0%) - conjugues parientes de primer grado no aplica
        $serviceFind->expenses()->attach( $ISABI->id,['cost' => ''] );
        //Todos los servcios con ISABI llevan avaluo comercial
        $serviceFind->expenses()->attach( $Comercial->id,['cost' => '1300'] );
        //Este es requerdio para el presupeusto de este tipo de servicios pero es un valor que nos van a integrar 
        $serviceFind->expenses()->attach( $ISR->id,['cost' => ''] );
        //Gastos de Registro: $500* Priedad  y  $250 *cacelacion de hipoteca  1 al 10 (esta relacionado con el servicio de Cancelación de Hipoteca )
        $serviceFind->expenses()->attach($Registro->id,['cost' => '500'] );
        $serviceFind->expenses()->attach($Registro->id,['cost' => '250'] );
       
        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Acreedor']);

        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Deudor']);
        $Escrituras = $serviceFind->document_service()->save($Escrituras,['participants_type' => 'Deudor']);
        $Predial  = $serviceFind->document_service()->save($Predial ,['participants_type' => 'Deudor']);
        $CertificadoCadanen  = $serviceFind->document_service()->save($CertificadoCadanen ,['participants_type' => 'Deudor']);
        $Avaluo = $serviceFind->document_service()->save($Avaluo ,['participants_type' => 'Deudor']);
        

    }
}

<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\Expense;
use NotiAPP\Models\ParticipantType;


class ServiceContratoMutuoSeed extends Seeder
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
        $Identification= Document::find($IdentificationID[0]->id); 

        $ActaNacimentoID = Document::where('document_name', 'Acta de Nacimiento' )->get();
        $ActaNacimento = Document::find($ActaNacimentoID[0]->id);   

        $EscriturasID = Document::where('document_name', 'Escrituras')->get();
        $Escrituras = Document::find($EscriturasID[0]->id); 

        $CdLID = Document::where('document_name', 'Certificado De Libertad Degradable' )->get();
        $CdL = Document::find($CdLID[0]->id);  

        $TerminosContratoID = Document::where('document_name', 'Terminos de Contrato' )->get();
        $TerminosContrato = Document::find($TerminosContratoID[0]->id);  

        $PredialID= Document::where('document_name', 'Predial' )->get();
        $Predial = Document::find($PredialID[0]->id);  


         /*Obtenemos el tipo de participante que coresponde a este servicio */
        $AcreedorType = ParticipantType::where('name','Acreedor')->get(); 
        $DeudorType = ParticipantType::where('name','Deudor')->get(); 

         /*Obtenemos los Cobros a considear para el Servicio*/
        $Honorarios = Expense::where('expense_name','Honorarios')->first();
        $ValorOperacion = Expense::where('expense_name','Valor de Operación')->first();
        $Catastral = Expense::where('expense_name','Avalúo Catastral')->first();
        $Gestoria = Expense::where('expense_name','Gestoria de Escritura')->first();
        $ISNJIN = Expense::where('expense_name','ISNJIN')->first();
        $Certificacion = Expense::where('expense_name','Certificados')->first();
        $CertifcadosN = Expense::where('expense_name','NºCertificados')->first();
        $Registro = Expense::where('expense_name','Gastos de Registro')->first();

        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Contrato mutuo con Interés y Garantía Hipotecaria';
         $service->service_type = 1; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        //El costo de honorarios se deja vacio porque se calcula en base al valor de operacion
        $serviceFind->expenses()->attach( $Honorarios->id,['cost' => '','input_name' => 'honorarios' ,'type_input' => 'hidden' ] );

        //El valor de operacion se deja vacio porque se sera un dato de entrada
        $serviceFind->expenses()->attach( $ValorOperacion->id,['cost' => '','input_name' => 'valor_operacion' ,'type_input' => 'text' ] );

        $serviceFind->expenses()->attach( $Catastral->id,['cost' => '120','input_name' => 'avaluo_catastral','type_input' => 'checkbox' ] );
        // Aplica a todos los municipios ( menos en la capital ) $1500  todos los servicios que la necesiten
        $serviceFind->expenses()->attach( $Gestoria->id,['cost' => '1500','input_name' => 'gestoria','type_input' => 'checkbox' ] );
        //Este es requerdio para el presupeusto de este tipo de servicios pero es un valor que nos van a integrar 
        $serviceFind->expenses()->attach( $ISNJIN->id,['cost' => '','input_name' => 'isnjin' ,'type_input' => 'text' ] );
        //estos hay que multiplicarlos por el numero de certificados que se realizaran el cual es un dato de entrada
        $serviceFind->expenses()->attach($Certificacion->id,['cost' => '200','input_name' => 'certificados','type_input' => 'checkbox' ] );
        //numero de certificados
        $serviceFind->expenses()->attach($CertifcadosN->id,['cost' => '0','input_name' => 'ncertificados','type_input' => 'number' ] );

        $serviceFind->expenses()->attach($Registro->id,['cost' => '1000','input_name' => 'gastros_registro','type_input' => 'checkbox'] );

        $serviceFind->participant_type_service()->attach($AcreedorType[0]->id );
        $serviceFind->participant_type_service()->attach($DeudorType[0]->id );

        // Docuemtos que lleva el Acreedor
        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Acreedor']);
        $ActaNacimento  = $serviceFind->document_service()->save($ActaNacimento ,['participants_type' => 'Acreedor']);

        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Deudor']);
        $ActaNacimento  = $serviceFind->document_service()->save($ActaNacimento ,['participants_type' => 'Deudor']);
        $Escrituras  = $serviceFind->document_service()->save($Escrituras ,['participants_type' => 'Deudor']);
        $CdL = $serviceFind->document_service()->save($CdL  ,['participants_type' => 'Deudor']);
        $TerminosContrato = $serviceFind->document_service()->save($TerminosContrato  ,['participants_type' => 'Deudor']);
        $Predial = $serviceFind->document_service()->save($Predial ,['participants_type' => 'Deudor']);
     
    }
}

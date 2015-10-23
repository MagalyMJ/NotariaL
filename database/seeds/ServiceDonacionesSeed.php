<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;
use NotiAPP\Models\Expense;


class ServiceDonacionesSeed extends Seeder
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

        $ifeID = Document::where('document_name', 'ife')->get();

        $ife= Document::find($ifeID[0]->id); 

        $EscriturasID = Document::where('document_name', 'Escrituras')->get();
        $Escrituras = Document::find($EscriturasID[0]->id); 

        $RluzID = Document::where('document_name',  'Recibo de luz' )->get();
        $Rluz = Document::find($RluzID[0]->id);  

        $RaguaID = Document::where('document_name','Recibo de Agua' )->get(); 
        $Ragua = Document::find($RaguaID[0]->id);  

        $RamantID = Document::where('document_name', 'Recibo de Mantenimiento' )->get();
        $Ramant = Document::find($RamantID[0]->id);   

        $CdLID = Document::where('document_name', 'Certificado De Libertad Degradable' )->get();
        $CdL = Document::find($CdLID[0]->id);  

        $ActaNacimentoID = Document::where('document_name', 'Acta de Nacimiento' )->get();
        $ActaNacimento = Document::find($ActaNacimentoID[0]->id);   


        /*Obtenemos el tipo de participante que coresponde a este servicio */
        $DonanteType = ParticipantType::where('name','Donante')->get(); 
        $DonatarioType = ParticipantType::where('name','Donatario')->get(); 

           /*Obtenemos los Cobros a considear para el Servicio*/
        $Honorarios = Expense::where('expense_name','Honorarios')->first();
        $ValorOperacion = Expense::where('expense_name','Valor de Operación')->first();
        $Catastral = Expense::where('expense_name','Avalúo Catastral')->first();
        $Gestoria = Expense::where('expense_name','Gestoria de Escritura')->first();
        $ISABI = Expense::where('expense_name','ISABI')->first();
        $Comercial = Expense::where('expense_name','Avalúo Comercial')->first();
        $ISR = Expense::where('expense_name','ISR')->first();
        $Certificacion = Expense::where('expense_name','Certificados')->first();
        $CertifcadosN = Expense::where('expense_name','NºCertificados')->first();
        $Registro = Expense::where('expense_name','Gastos de Registro')->first();
        $RegistroN = Expense::where('expense_name','Nº Registros')->first();  
        

        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Donaciones';
         $service->service_type = 1; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        $serviceFind->participant_type_service()->attach($DonanteType[0]->id );
        $serviceFind->participant_type_service()->attach($DonatarioType[0]->id );

         //El costo de honorarios se deja vacio porque se calcula en base al valor de operacion
        $serviceFind->expenses()->attach( $Honorarios->id,['cost' => '','input_name' => 'honorarios' ,'type_input' => 'hidden' ] );

        //El valor de operacion se deja vacio porque se sera un dato de entrada
        $serviceFind->expenses()->attach( $ValorOperacion->id,['cost' => '','input_name' => 'valor_operacion' ,'type_input' => 'text' ] );

        $serviceFind->expenses()->attach( $Catastral->id,['cost' => '120','input_name' => 'avaluo_catastral','type_input' => 'checkbox' ] );
        // Aplica a todos los municipios ( menos en la capital ) $1500  todos los servicios que la necesiten
        $serviceFind->expenses()->attach( $Gestoria->id,['cost' => '1500','input_name' => 'gestoria','type_input' => 'checkbox' ] );
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

        $serviceFind->expenses()->attach($Registro->id,['cost' => '500','input_name' => 'gastos_registro','type_input' => 'hidden'] );
        $serviceFind->expenses()->attach($RegistroN->id,['cost' => '1','input_name' => 'ngastos_resgistro','type_input' => 'hidden'] );



        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Donante']);
        $Escrituras = $serviceFind->document_service()->save($Escrituras,['participants_type' => 'Donante']);
        $Rluz = $serviceFind->document_service()->save($Rluz,['participants_type' => 'Donante']);
        $Ragua = $serviceFind->document_service()->save($Ragua,['participants_type' => 'Donante']);
        $Ramant = $serviceFind->document_service()->save($Ramant,['participants_type' => 'Donante']);
        $CdL = $serviceFind->document_service()->save($CdL,['participants_type' => 'Donante']);

        $ife = $serviceFind->document_service()->save($ife,['participants_type' => 'Donatario']);
        $ActaNacimento  = $serviceFind->document_service()->save($ActaNacimento ,['participants_type' => 'Donatario']);
     
    }
}

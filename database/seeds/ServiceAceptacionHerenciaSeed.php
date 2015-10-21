<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;
use NotiAPP\Models\Expense;

class ServiceAceptacionHerenciaSeed extends Seeder
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
         /* Los buscamos para obtener un modelo Eloquent para poder relacionalros  */
        $Identification= Document::find($IdentificationID[0]->id); 

        $ActaNacimentoID = Document::where('document_name', 'Acta de Nacimiento' )->get();
        $ActaNacimento = Document::find($ActaNacimentoID[0]->id); 

        $TestamentoID = Document::where('document_name', 'Testamento')->get();
        $Testamento = Document::find($TestamentoID[0]->id);

       /*Obtenemos el tipo de participante que coresponde a este servicio */
       $HerederoType = ParticipantType::where('name','Heredero/a')->get(); 
       $AlbaceaType = ParticipantType::where('name','Albacea')->get(); 

       /*Obtenemos los Cobros a considear para el Servicio*/
        $Honorarios = Expense::where('expense_name','Honorarios')->first();
        $Edictos = Expense::where('expense_name','Edictos')->first();

        /* Asignamos los datos para Crear el Servicio*/

         $service->name = 'Reconocimiento y Aceptación de Herencia';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

         $serviceFind->participant_type_service()->attach( $HerederoType[0]->id );
         $serviceFind->participant_type_service()->attach( $AlbaceaType[0]->id );

         $serviceFind->expenses()->attach( $Honorarios->id,['cost' => '4500','input_name' => 'honorarios' ,'type_input' => 'hidden' ] );
         $serviceFind->expenses()->attach( $Edictos->id,['cost' => '1000','input_name' => 'gastros_registro','type_input' => 'checkbox'] );
       
        $Identification= $serviceFind->document_service()->save($Identification,['participants_type' => 'Heredero/a']);
        $ActaNacimento = $serviceFind->document_service()->save( $ActaNacimento ,['participants_type' => 'Heredero/a']);
        $Testamento = $serviceFind->document_service()->save( $Testamento ,['participants_type' => 'Heredero/a']);

        $Identification= $serviceFind->document_service()->save($Identification,['participants_type' => 'Albacea']);
        $ActaNacimento = $serviceFind->document_service()->save( $ActaNacimento ,['participants_type' => 'Albacea']);
        $Testamento = $serviceFind->document_service()->save( $Testamento ,['participants_type' => 'Albacea']);

     
    }
}

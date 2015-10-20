<?php

use Illuminate\Database\Seeder;
use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;
use NotiAPP\Models\Expense;

class ServiceActaCosntitutivaSeed extends Seeder
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
        $Identification= Document::find($IdentificationID[0]->id); 

        $ObjetoSocialID = Document::where('document_name', 'Objeto Social')->get();
        $ObjetoSocial= Document::find($ObjetoSocialID[0]->id); 

        $MontodeCapitalID = Document::where('document_name', 'Monto de Capital')->get();
        $MontodeCapital = Document::find($MontodeCapitalID[0]->id); 

        $RegimendesociedadID = Document::where('document_name', 'Regimen de sociedad')->get();
        $Regimendesociedad= Document::find($RegimendesociedadID[0]->id); 

         /*Obtenemos el tipo de participante que coresponde a este servicio */
        $SocioType = ParticipantType::where('name','Socio')->get();

        /*Obtenemos los Cobros a considear para el Servicio*/
        $Honorarios = Expense::where('expense_name','Honorarios')->first();
        $Gestoria = Expense::where('expense_name','Gestoria de Escritura')->first();
        $ISNJIN = Expense::where('expense_name','ISNJIN')->first();
        $Registro = Expense::where('expense_name','Gastos de Registro')->first(); 

        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Acta Constitutiva';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        //El costo de honorarios es de 7000 para este servicio
        $serviceFind->expenses()->attach( $Honorarios->id,['cost' => '7000'] );
        // Aplica a todos los municipios ( menos en la capital ) $1500  todos los servicios que la necesiten
        $serviceFind->expenses()->attach( $Gestoria->id,['cost' => '1500'] );
        //Este es requerdio para el presupeusto de este tipo de servicios pero es un valor que nos van a integrar 
        $serviceFind->expenses()->attach( $ISNJIN->id,['cost' => ''] );
        $serviceFind->expenses()->attach($Registro->id,['cost' => '600'] );

         $serviceFind->participant_type_service()->attach( $SocioType[0]->id );

        // Docuemtos que lleva el Socio 
        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Socio']);
        $ObjetoSocial = $serviceFind->document_service()->save($ObjetoSocial,['participants_type' => 'Socio']);
        $MontodeCapital = $serviceFind->document_service()->save($MontodeCapital,['participants_type' => 'Socio']);
        $Regimendesociedad = $serviceFind->document_service()->save($Regimendesociedad,['participants_type' => 'Socio']);
     
    }
}

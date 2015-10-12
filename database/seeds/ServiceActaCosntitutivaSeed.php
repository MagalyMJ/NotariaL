<?php

use Illuminate\Database\Seeder;
use NotiAPP\Models\Service;
use NotiAPP\Models\Document;

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

        

        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Acta Constitutiva';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        // Docuemtos que lleva el vendedor 
        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Socio']);
        $ObjetoSocial = $serviceFind->document_service()->save($ObjetoSocial,['participants_type' => 'Socio']);
        $MontodeCapital = $serviceFind->document_service()->save($MontodeCapital,['participants_type' => 'Socio']);
        $Regimendesociedad = $serviceFind->document_service()->save($Regimendesociedad,['participants_type' => 'Socio']);
     
    }
}

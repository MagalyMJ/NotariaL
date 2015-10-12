<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;

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

        $EscriturasCertificadoID = Document::where('document_name', 'Escrituras de Certificado de Gradaben')->get();
        $EscriturasCertificado = Document::find($EscriturasCertificadoID[0]->id); 

        $OrdendeCancelacionID = Document::where('document_name', 'Orden de Cancelacion')->get();
        $OrdendeCancelacion = Document::find($OrdendeCancelacionID[0]->id); 

        $CartaNoAdeudoID = Document::where('document_name', 'Carta de No Adeudo')->get();
        $CartaNoAdeudo = Document::find($CartaNoAdeudoID[0]->id); 
        

        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Cancelacion de Hipoteca';
         $service->service_type = 2; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

       
        $EscriturasCertificado  = $serviceFind->document_service()->save($EscriturasCertificado ,['participants_type' => 'Deudor']);
        $OrdendeCancelacion  = $serviceFind->document_service()->save($OrdendeCancelacion ,['participants_type' => 'Deudor']);
        $CartaNoAdeudo  = $serviceFind->document_service()->save($CartaNoAdeudo ,['participants_type' => 'Deudor']);
     
    }
}

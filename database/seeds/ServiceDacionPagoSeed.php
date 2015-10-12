<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;


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


        /* Asignamos los datos para Crear el Servicio*/

         $service->name = 'Dacion en Pago';
         $service->service_type = 1; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

       
        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Acreedor']);

        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Deudor']);
        $Escrituras = $serviceFind->document_service()->save($Escrituras,['participants_type' => 'Deudor']);
        $Predial  = $serviceFind->document_service()->save($Predial ,['participants_type' => 'Deudor']);
        $CertificadoCadanen  = $serviceFind->document_service()->save($CertificadoCadanen ,['participants_type' => 'Deudor']);
        $Avaluo = $serviceFind->document_service()->save($Avaluo ,['participants_type' => 'Deudor']);
        

    }
}

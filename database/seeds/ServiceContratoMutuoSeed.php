<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;


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

        

        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Contrato mutuo con Interés y Garantía Hipotecaria';
         $service->service_type = 1; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

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

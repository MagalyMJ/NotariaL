<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;


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

        

        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Donaciones';
         $service->service_type = 1; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);

        
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

<?php

use Illuminate\Database\Seeder;
use NotiAPP\Models\Service;
use NotiAPP\Models\Document;
use NotiAPP\Models\ParticipantType;

class ServiceCompraVentaSeed extends Seeder
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
        /* Obtenemos los Id's de los cocumentos que tienen este nombre (array) */
        $IdentificationID = Document::where('document_name', 'Identificación')->get();
         /* Los buscamos para obtener un modelo Eloquent para poder relacionalros  */
        $Identification= Document::find($IdentificationID[0]->id); 

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

        $AvaluoID = Document::where('document_name', 'Avaluo' )->get();
        $Avaluo = Document::find($AvaluoID [0]->id); 

         /*Obtenemos el tipo de participante que coresponde a este servicio */
        $VendedorType = ParticipantType::where('name','Vendedor')->get(); 
        $CompradorType = ParticipantType::where('name','Comprador')->get(); 

        

        /* Asignamos los datos para Crear el Servicio*/
         $service->name = 'Contrato Compra Venta';
         $service->service_type = 1; 
         $service->save();

         $serviceId = $service->id;
         /* Una ves Registrado lo buscamos para hacer las viculaciones */
         $serviceFind = Service::find($serviceId);


        $serviceFind->participant_type_service()->attach($VendedorType[0]->id );
        $serviceFind->participant_type_service()->attach($CompradorType[0]->id );

        // Docuemtos que lleva el vendedor 
        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Vendedor']);
        $Escrituras = $serviceFind->document_service()->save($Escrituras,['participants_type' => 'Vendedor']);
        $Rluz = $serviceFind->document_service()->save($Rluz,['participants_type' => 'Vendedor']);
        $Ragua = $serviceFind->document_service()->save($Ragua,['participants_type' => 'Vendedor']);
        $Ramant = $serviceFind->document_service()->save($Ramant,['participants_type' => 'Vendedor']);
        $CdL = $serviceFind->document_service()->save($CdL,['participants_type' => 'Vendedor']);

        $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Comprador']);
        $ActaNacimento  = $serviceFind->document_service()->save($ActaNacimento ,['participants_type' => 'Comprador']);
        $Avaluo = $serviceFind->document_service()->save($Avaluo,['participants_type' => 'Comprador']);
     
    }
}

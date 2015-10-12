<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\Document;

class ServiceTestamentSeeder extends Seeder
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
        
        /* Obtenemos los Id's de los cocumentos que tienen este nombre (array) */
        $IdentificationID = Document::where('document_name', 'Identificación')->get();
        
        $EscrituraID = Document::where('document_name', 'Escrituras')->get();


        /* Los buscamos para obtener un modelo Eloquent para poder relacionalros  */
		$Escrituras = Document::find($EscrituraID[0]->id); 

		$Identification= Document::find($IdentificationID[0]->id); 


         $service->name = 'Testamento';
         $service->service_type = 2;
         $service->save();
         /* Generamos El servicio y sus viculaciones */
         $serviceId = $service->id;

            $serviceFind = Service::find($serviceId);

		    $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Testigo']);

            $Identification = $serviceFind->document_service()->save($Identification,['participants_type' => 'Testador']);

            $Escrituras = $serviceFind->document_service()->save($Escrituras,['participants_type' => 'Testigo' ]);

            $Escrituras= $serviceFind->document_service()->save($Escrituras,['participants_type' => 'Testador']);


        
    }
}

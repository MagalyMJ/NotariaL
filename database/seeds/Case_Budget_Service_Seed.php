<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\CaseService;
use NotiAPP\Models\Budget;
use NotiAPP\Models\Customer;


class Case_Budget_Service_Seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $SerciveCase = new CaseService;

        //buscamos el servicio con id 1 
        $Service = Service::find(3);

        // llenamos los datos que corresponden al modelo
        $SerciveCase->place = 'Aguascalientes';
        $SerciveCase->progress = 1;
        $SerciveCase->observations = "Faltan documentos por entregar ";
        $SerciveCase->service_detail = "Serivicio VIP";
        //Guardamos y obtenemos el id generado
        $SerciveCase->save();
        
        $CaseID = $SerciveCase->id;
        $CreateCase = CaseService::find($CaseID);

        //realizamos la relacion del servicio y el caso generado
        $CreateCase = $Service->case_service()->save($CreateCase);

        //Le asignamos un presupuesto
        $CaseBudget = new Budget;

	    $CaseBudget->approved = 1;
	    $CaseBudget->invoiced = 0;
	    $CaseBudget->payment_type = 2;
	    $CaseBudget->operation_value = 3232;
	    $CaseBudget->cost = 49892;
	    $CaseBudget->commission = 0.08;

	    $CaseBudget->save();
	    // hacemos la relacion del presupuesto creado con el caso creado 
	    $CreateCase = $CaseBudget->case_service()->save($CreateCase);

        //buscando al cliente Registrado y asignarlo al caso  
	    $customer = Customer::find(4);

	    $customer = $CreateCase ->customer()->save($customer ,['participants_type' => 'Acredor']);


    }
}

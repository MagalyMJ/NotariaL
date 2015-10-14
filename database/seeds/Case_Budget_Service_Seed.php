<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Service;
use NotiAPP\Models\CaseService;
use NotiAPP\Models\Budget;
use NotiAPP\Models\Customer;
use NotiAPP\Models\User;


class Case_Budget_Service_Seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Por cada servicio crearemos un caso de prueba, se les asignara un presupuesto y 
        // y se vinculara con clientes de forma aleatoria de fomra de quedar mas de uno en un caso
        $Services = Service::All();

        foreach ($Services   as $service ){

               $SerciveCase = new CaseService;

        //buscamos el servicio con id 1 
        $Service = Service::find($service->id);

        // llenamos los datos que corresponden al modelo
        $SerciveCase->place = 'Aguascalientes';
        $SerciveCase->progress = rand(1,8);
        $SerciveCase->notices = rand(1,3);
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

        //el creador del prespupuesto tiene que ser un usuario
        $user = User::find(rand(1,10));

        $user->budget()->save($CaseBudget);

        // hacemos la relacion del presupuesto creado con el caso creado 
        $CreateCase = $CaseBudget->case_service()->save($CreateCase);

        //buscando al cliente Registrado y asignarlo al caso  
        $customer = Customer::find(rand(1,10));

        $customer = $CreateCase->customer()->attach($customer->id,['participants_type' => 'Acredor']);
        
        
        }

     

    }
}

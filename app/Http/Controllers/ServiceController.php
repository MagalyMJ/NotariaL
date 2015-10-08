<?php

namespace NotiAPP\Http\Controllers;

use Illuminate\Http\Request;

use NotiAPP\Http\Requests;
use NotiAPP\Http\Controllers\Controller;

use NotiAPP\Models\Customer;
use NotiAPP\Models\Address;
use NotiAPP\Models\Participant;
use NotiAPP\Models\CaseService;
use NotiAPP\Models\Service;
use NotiAPP\Models\Budget;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($servicio)
    {
        //
            switch ($servicio) {

             case "testamento":
                $id_service = 1;
                //Request Para Obtener los casos en bace al servicio por pedio del presupuesto 
                $cases = CaseService::whereHas('budget', function($query)
                 {   
                
                     $query->where('service_id', '=', '1');

                 })->get();

                return view('ServiceGetByIdService',[ 'cases_services' => $cases , 'service_id' => $id_service ]);
             break;

             case "contrato_compra_venta":
                $id_service = 2;
                //Request Para Obtener los casos en bace al servicio por pedio del presupuesto 
                $cases = CaseService::whereHas('budget', function($query)
                    {   
                
                        $query->where('service_id', '=', '2');

                    })->get();
                return view('ServiceGetByIdService',[ 'cases_services' => $cases, 'service_id' => $id_service ]);
             break;
             case "donaciones":
                $id_service = 3;
                //Request Para Obtener los casos en bace al servicio por pedio del presupuesto 
                $cases = CaseService::whereHas('budget', function($query)
                {   
                
                    $query->where('service_id', '=', '3');

                    })->get();
                return view('ServiceGetByIdService',[ 'cases_services' => $cases , 'service_id' => $id_service ]);
             break;
             case "acta_constitutiva":
                $id_service = 4;
                //Request Para Obtener los casos en bace al servicio por pedio del presupuesto 
                $cases = CaseService::whereHas('budget', function($query)
                {   
                
                    $query->where('service_id', '=', '4');

                })->get();
                return view('ServiceGetByIdService',[ 'cases_services' => $cases , 'service_id' => $id_service ]);
             break;
             case "acta_constitutiva":
                $id_service = 5;
                //Request Para Obtener los casos en bace al servicio por pedio del presupuesto 
                $cases = CaseService::whereHas('budget', function($query)
                {   
                
                    $query->where('service_id', '=', '5');

                })->get();
                return view('ServiceGetByIdService',[ 'cases_services' => $cases , 'service_id' => $id_service ]);
             break;
        }

      
        // Request para Obtener los presupuestos en bace a un servicio
        $budgets = Budget::where('service_id', '=',$id_service)->get();


        //Request Para Obtener los casos en bace al servicio por pedio del presupuesto 
        $cases = CaseService::whereHas('budget', function($query)
            {   
                
                $query->where('service_id', '=', '1');

                })->get();

        $cases2 = CaseService::with(['customer.budget' => function($query)
            {   
                
                $query->where('budget.service_id', '=', '1');

                }])->get();

        $cases3 = CaseService::with(['customer'])->get();

        //para obtener los clientes de los casos en bace a el servicio
       $customers = Customer::with(['case_service.budget' => function($query)
            {   
                
                $query->where('budget.service_id', '=', '1');

                }])->get();


       $customers2 = Customer::with('case_service')->get();

        //dd($cases2,$customers2);

    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id_service)
    {
        // Aqui se creara un nuevo caso de testamento
     
        dd($id_service);

        

    }

    public function service($id_service){


        // $documnets = Service::find($id_service)->documents;
        // $name = Service::find($id_service)->name;
        $customers = Customer::all();

        //dd($documnets);
         //return view('custumerAdd',['name'=>$name,'documents'=>$documnets]);
        return view('allClients',[ 'customers' => $customers , 'id_service' => $id_service]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace NotiAPP\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use NotiAPP\Http\Requests;
use NotiAPP\Http\Controllers\Controller;

use NotiAPP\Models\Customer;
use NotiAPP\Models\Address;
use NotiAPP\Models\Participant;
use NotiAPP\Models\CaseService;
use NotiAPP\Models\Service;
use NotiAPP\Models\Budget;

use Response;
use Input;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id_service)
    {
        //
            //Request Para Obtener los casos en bace al servicio
            $cases = CaseService::where('service_id',$id_service)->get();
            $service = Service::find($id_service);
              
            //dd($cases[0]->customer->all());
                
            return view('CaseGetByIdService',[ 'cases_services' => $cases , 'service' => $service ]);
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request,$id_service)
    {
       //  // Aqui se creara un nuevo caso

        $NewCase = new CaseService;
        $NewCase->service_id = $id_service;
        $NewCase->save();
        $id_caseService = $NewCase->id;

        $service= Service::find($id_service);
        /* los estoy expoliendo ya que los es toy pasando en un strign BUSCAR UNA MEJOR MANERA DE ESCOJERLOS*/
        $Sleectedcustomers = explode(',',$request->customers_selected);

        $CreateCase = CaseService::find($id_caseService);

        //creamos un presupuesto vacio y lo asignamos
        $CaseBudget = new Budget;
        $CaseBudget->save();
        $CaseBudget->case_service()->save($CreateCase);


        //Por cada id de cliente que nos proporcionen asignamos al caso 
        foreach ($Sleectedcustomers as $customerSelect => $id) {
            
           $CreateCase->customer()->attach($id);
        }

        //Despues de escojer a los partisipantes, llenaremos el presupuesto
        return Redirect::route('EditBudget', array('id_presupuesto' => $CaseBudget->id));
        //return view('Service.serviceDetail',[ 'ServiceCase' => $CreateCase, 'id_service' => $id_service ,'documents'=> $service->documents ]);
    }

    public function SelectCustomers($id_service){

        $customers = Customer::all();
      

        return view('SelectCustomersforCase',[ 'customers' => $customers , 'id_service' => $id_service ]);
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
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function EditBudget(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id_caseService)
    {
        //
        
        $ShowCase = CaseService::find($id_caseService);
        //dd($ShowCase);
        return view('Service.DetailCase',['ServiceCase' => $ShowCase ]);

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
        $editCase = CaseService::find($id);

        return view('Service.EditCaseService',[ 'ServiceCase' => $editCase]);

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
        dd($request);
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

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
                
                return view('ServiceGetByIdService',[ 'cases_services' => $cases , 'service' => $service ]);
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request,$id_service)
    {
        // Aqui se creara un nuevo caso
        $idCustomer = $request->customers_selected[0];

       $customers = Customer::find($idCustomer);

        $service  =  Service::find($id_service);

         //dd($idCustomer, $id_service);
       
        return view('CustomerCaseService',[ 'customers' => $customers , 'id_service' => $id_service ,'documents'=> $service->documents ]);
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

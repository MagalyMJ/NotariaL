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
     * Despliega una lista de casos en base al servico.
     *
     * @return Response
     */
    public function index($id_service, Request $request)
    {
        //
          $service = Service::find($id_service);
          $cases;  
        
        //Usamos un scope para traer los caso del Tipo de servico y filtrados por id , o por numero de escritura o Cliente 
        if ($request->id != null) {
                 $cases = CaseService::SearchByIdAndService($request->id,$id_service)->orderBy('id','DESC')->get();
            }
        elseif ($request->N_write != null ) {
                $cases = CaseService::SearchByNwriteAndService($request->N_write,$id_service)->orderBy('id','DESC')->get();
            }elseif ($request->FullName_write != null ) {
                $cases = CaseService::SearchByFullNameCustomerAndService($request->FullName_write,$id_service)->orderBy('id','DESC')->get();
            }
            else{
                $cases = CaseService::where('service_id',$id_service)->orderBy('id','DESC')->get();
            }

            return view('Service.CaseGetByIdService',[ 'cases_services' => $cases , 'service' => $service ]);
            
    }
    
    /**
     * Despliega una lista de todos los casos
     * Request $request proviene de los formularios de filtros
     * @return Response
     */
    public function AllCaseByProgres(Request $request)
    {
        //
         
         
         $cases = $this->queryFilterCaseService('progress','ASC',$request);  
         return view('Service.AllCasebyProgres',[ 'cases_services' => $cases ]);
            
    } 
    
    /**
     * Despliega una lista de todos los casos
     *  Request $request proviene de los formularios de filtros
     * @return Response
     */
    public function AllCaseByNotice(Request $request)
    {
        //
         
         $cases = $this->queryFilterCaseService('notices','ASC',$request);  
         return view('Service.AllCasebyNotice',[ 'cases_services' => $cases ]);
            
    }

     /**
     * Metodo de filtrados y delpligue de casos.
     *
     * @return Response
     */
    private function queryFilterCaseService($orderBy , $order, $request ){

        //Usamos un scope para traer todos caso filtrados por id , o por numero de escritura o Cliente
        if ($request->id != null) {
                 return CaseService::SearchById($request->id)->orderBy($orderBy,$order)->get();
            }
        elseif ($request->N_write != null ) {
                 return  CaseService::SearchByNwrite($request->N_write)->orderBy($orderBy,$order)->get();
            }elseif ($request->FullName_write != null ) {
                return   CaseService::SearchByFullNameCustomer($request->FullName_write)->orderBy($orderBy,$order)->get();
            }elseif ($request->progress_Select != null) {
                return   CaseService::SearchByProgress($request->progress_Select)->orderBy($orderBy,$order)->get();
            }
            else{
                return  CaseService::orderBy($orderBy ,$order)->get();
            }

    }

    
     /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request ,int, id_service
     * @return Response
     */
    public function store(Request $request,$id_service)
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
        $CreateCase->place = 'Aguascalientes'; // al crear un coaso le asignamos el municipio de ags por defecto. 
        //creamos un presupuesto vacio y lo asignamos
        $CaseBudget = new Budget;
        $CaseBudget->save();
        $CaseBudget->case_service()->save($CreateCase);


        //Por cada id de cliente que nos proporcionen asignamos al caso 
        foreach ($Sleectedcustomers as $customerSelect => $id) {
            
           $CreateCase->customer()->attach($id);
        }

        //Despues de escojer a los partisipantes, iremos a los detalles del caso para llenar el presupuesto 
        return Redirect::route('Show_Case_path', array('$ServiceCase' => $CreateCase->id));
    }

    public function SelectCustomers($id_service , Request $request){

        $customers;

         if ($request->FullName_write != null) {
                 $customers = Customer::SearchByFullName($request->FullName_write)->orderBy('name','ASC')->get();
            }
            else{
                $customers = Customer::orderBy('name','ASC')->get();
            }

        return view('Customers.SelectCustomersforNewCase',[ 'customers' => $customers , 'id_service' => $id_service ]);
    }
    
   /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
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
        //Al querer ver los detalles de caso,se actulaizara el progreso, llevado por los cambios hechos 
        $ShowCase->progress = $ShowCase->Progress();
        //el saldo restante a apagar se guarda en el caso 
        $ShowCase->remaining =  $ShowCase->budget->total - $ShowCase->SumPayments() ;
        $ShowCase->save();

        $ShowCase = CaseService::find($id_caseService);

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

        if ($editCase->service->service_type == 'no_enagenante') {
            
             return view('Service.Edit.EditCaseService',[ 'ServiceCase' => $editCase]);
        }else{

             return view('Service.Edit.EditEnagenanteCaseService',[ 'ServiceCase' => $editCase]);

        }
       
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
        //dd($request);
        $UpdateCase = CaseService::find($id);

        $UpdateCase->place = $request->place;
        $UpdateCase->service_detail = $request->service_detail;
        $UpdateCase->observations = $request->observations;

        //Edicion de los avisos
        $UpdateCase->notices_one_date = $request->notices_one_date;
        $UpdateCase->notices_two_date = $request->notices_two_date;
        $UpdateCase->public_register = $request->public_register;
        $UpdateCase->N_write = $request->N_write;
       
        //enum(1=> 'Sin', 2=> 'Primer', 3=>'Segundo') aviso
        $UpdateCase->notices = 1;
        // dd($UpdateCase->notices_one_date );
         if( $UpdateCase->notices_one_date != null || $UpdateCase->notices_one_date != '') {
            $UpdateCase->notices = 2;
            if ($UpdateCase->notices_two_date != null || $UpdateCase->notices_two_date != '') {
                  $UpdateCase->notices = 3;
             }
         }
        //si el contrato ya se firmo, 
        $UpdateCase->signature = $request->signature;

        $UpdateCase->save();

        return Redirect::route('Show_Case_path', array('id_caseService' => $UpdateCase->id));
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

    /**
     * Show the form for editing the specified a Customer documents .
     *
     * @param  int  $id_caseService,$id_customer
     * @return Response
     */
    public function editPariticipantData($id_caseService ,$id_customer)
    {
        //
         $editCase = CaseService::find($id_caseService);
        
         $customerSelect = $editCase->customer->where('pivot.customer_id', (int)$id_customer)->first();
         
         // dd($editCase ,$customerSelect);

        return view('Service.CustomerCase.EditParticipatCase',[ 'ServiceCase' => $editCase ,'customerSelect' => $customerSelect]);


    }   
     /**
     * Show the form for editing the specified a Customer documents .
     *
     * @param  int  $id_caseService,$id_customer 
     * @param  Request  $request
     * @return Response
     */
    public function updatePariticipantData(Request $request,$id_caseService ,$id_customer)
    {
        //se Modifican los atributos de la tabla pivote 

         $UpdateCase = CaseService::find($id_caseService);

         $UpdateCase->customer()->updateExistingPivot( (int)$id_customer, array('participants_type' => $request->participant_type ,'documents_list' => $request->documents_selected)); 
         
         //dd($customerSelect);
         return Redirect::route('Edit_Case_path', array('id_caseService' => $UpdateCase->id));
    }

}

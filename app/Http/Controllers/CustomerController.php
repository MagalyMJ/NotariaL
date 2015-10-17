<?php

namespace NotiAPP\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use NotiAPP\Http\Requests;
use NotiAPP\Http\Controllers\Controller;
use NotiAPP\Models\Customer;
use NotiAPP\Models\Address;
use NotiAPP\Models\CaseService;
use NotiAPP\Models\Service;
use NotiAPP\Models\Budget;
use NotiAPP\Models\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id_service = null)
    {
        //
        return view('custumerAdd',['id_service'=>$id_service]);
    } 
    
public function addCustumer(Request $request)
    {
        $addCustumer = new Customer;
        $addres = new Address;
         if (empty($request->id_service)){  
         //El Registro proviene de unar ruta de SelectCustomerForCase > No estaba registrado > Crear uno nuevo > Formulario  
                $addCustumer->name = $request->name;
                $addCustumer->fathers_last_name = $request->fathers_last_name;
                $addCustumer->mothers_last_name = $request->mothers_last_name;
                $addCustumer->rfc = $request->rfc;
                $addCustumer->from = $request->from;
                $addCustumer->birthdate = $request->birth_day;
                $addCustumer->occupation = $request->occupation;
                $addCustumer->marital_status = $request->marital_status;
                $addCustumer->phone = $request->phone;
        
                $addCustumer->save();

                //aun esta instanciado a si que tenemos su id 
                $insertedId = $addCustumer->id;

                //instanciamos una direccion 
                $addres->street = $request->street;
                $addres->number = $request->number;
                $addres->colony = $request->colony;
                $addres->postal_code = $request->postal_code;

                //buscamos al cliente para asignarle su direcion y su id de partticipante, caso  
                $customer = Customer::find($insertedId);

                $addres = $customer->address()->save($addres);
                //Buscamos el servicio del cual se quiere crear un caso, 

                $Service = Service::find($request->id_service);
                //Creamos el caso 
                $NewCase = new CaseService;
                $NewCase->save();
                //identificamos su id 
                $CreateCase = CaseService::find($NewCase->id);
                //Lo relacionamos con el servicio al que peretence
                $Service->case_service()->save($CreateCase);
                //Le Relacionamos el Cliente que Se Registro
                $CreateCase->customer()->attach($customer->id);

                //Le Buscamos Un USUARIO (el primer con permiso de manager)
                $User = User::where('user_type','manager')->first();


                //creamos un presupuesto vacio y lo asignamos
                $CaseBudget = new Budget;
                $CaseBudget->save();
                $CaseBudget->case_service()->save($CreateCase);
                $User->budget()->save($CaseBudget);
                //

                return Redirect::route('Show_Case_path', array('id_caseService' => $CreateCase->id ));
         }

        
        dd($request);
         
    }
    public function addCustumerCase(Request $request)
    {
        // Aqui se creara un nuevo caso de testamento
        //dd($request->all());

        $case = new CaseService; 
        $buget = new Budget;

        //instanciamos un caso 
        $case->place = 'Aguascalietnes';
        $case->progress = 1;
        $case->observations = $request->subject;
        
        //buscamos al cliente para asignarle su direcion y su id de partticipante, caso
        // hay que mandarlo por un parametro   
        $custumer = Customer::find($request->idcustomer);

        // Como primer prametro se guarda el caso al que estara relacionado, y como segundo parametro
        // se pone un atributo de la tabla pibote entre estas dos con su valor asignado
        // la relacion es efectuada por eloquent 

       $case = $custumer->case_service()->save($case,['participants_type' => 'testigo'/*$request->participants_type*/ ]);

        $newcase = CaseService::find($case->id);
        //inicalizamos el presupuesto 
        
        $buget->service_id = 1;
        $buget->user_id = 4;
        $buget->approved = 0;
        $buget->invoiced = 0;
        $buget->payment_type = 1;
        $buget->operation_value = $request->operationValue;
        $buget->commission = 0.8;
        $buget->cost = $request->operationValue + ($request->operationValue * 0.8);
       

        $buget = $newcase->budget()->save($buget);

        $case->budget()->save($buget);
       
        return view('home');
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

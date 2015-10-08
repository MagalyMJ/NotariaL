<?php

namespace NotiAPP\Http\Controllers;

use Illuminate\Http\Request;

use NotiAPP\Http\Requests;
use NotiAPP\Http\Controllers\Controller;
use NotiAPP\Models\Customer;
use NotiAPP\Models\Address;
use NotiAPP\Models\CaseService;
use NotiAPP\Models\Budget;

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

        return view('custumerAdd');
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
public function addCustumer(Request $request)
    {
        // Aqui se creara un nuevo caso de testamento
        //dd($request->all());

        $addCustumer = new Customer;
        $addres = new Address;
        // $case = new CaseService; 

        $addCustumer->name = $request->name;
        $addCustumer->fathers_last_name = $request->fathers_last_name;
        $addCustumer->mothers_last_name = $request->mothers_last_name;
        $addCustumer->rfc = $request->rfc;
        $addCustumer->from = $request->from;
        $addCustumer->birthdate = $request->birth_day;
        $addCustumer->occupation = $request->occupation;
        $addCustumer->marital_status = $request->marital_status;
        $addCustumer->phone = $request->phone;
        

        //se creo un cliente en la bd
        $addCustumer->save();
        //aun esta instanciado ais que tenemos su id 
        $insertedId = $addCustumer->id;

        //instanciamos una direccion 
        $addres->street = $request->street;
        $addres->number = $request->number;
        $addres->colony = $request->colony;
        $addres->postal_code = $request->postal_code;

        //instanciamos un caso 
        // $case->place = 'Aguascalietnes';
        // $case->progress = 2;
        // $case->observations = $request->subject;

         
        //buscamos al cliente para asignarle su direcion y su id de partticipante, caso  
        $custumer = Customer::find($insertedId);

        $addres = $custumer->address()->save($addres);
        // Como primer prametro se guarda el caso al que estara relacionado, y como segundo parametro
        // se pone un atributo de la tabla pibote entre estas dos con su valor asignado
        // la relacion es efectuada por eloquent 
        // $case = $custumer->participant()->save($case,['participants_type' => $request->participants_type]);
        
        $customers = Customer::all();
            //dd($customers);

         return view('allClients',[ 'customers' => $customers ]);
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
        $custumer = Customer::find(8);

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

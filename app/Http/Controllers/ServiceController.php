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
             break;
             case "contrato_compra_venta":
                $id_service = 2;
             break;
             case "donaciones":
                $id_service = 3;
             break;
             case "acta_constitutiva":
                $id_service = 4;
             break;
             case "acta_constitutiva":
                $id_service = 5;
             break;
        }

      

        $budgets = Budget::where('service_id', '=',$id_service)->get();


    
        //Request Para Obtener los casos en bace al servicio por edio del presupuesto 
      $caso = CaseService::whereHas('budget', function($query,$id_service)
            {   
                
                $query->where('service_id', '=', '1');

                })->get();

        dd($caso,$budgets);

       //return view('ServiceGetByIdService',['service' => $service->name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Aqui se creara un nuevo caso de testamento

    }
    public function service($servicio){
            $id = 0;
            switch ($servicio) {

             case "testamento":
                $id=1;
             break;
             case "contrato_compra_venta":
                $id=2;
             break;
             case "donaciones":
                $id=3;
             break;
             case "acta_constitutiva":
                $id=4;
             break;
             case "acta_constitutiva":
                $id=5;
             break;
        }

        $documnets = Service::find($id)->documents;
        $name = Service::find($id)->name;

         //dd($documnets);
         return view('custumerAdd',['name'=>$name,'documents'=>$documnets]);

    }
    public function addCustumer(Request $request)
    {
        // Aqui se creara un nuevo caso de testamento
        //dd($request->all());

        $addCustumer = new Customer;
        $addres = new Address;
        $participant = new Participant;
        $case = new CaseService; 

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

        //intanciamos que va a ser un participante y le asignamos su rol 
        if ($request->testador ='on') {
           $participant->participants_type = 'testador'; 
        } else {
            $participant->participants_type = 'testigo'; 
        }
        //instanciamos un caso 
        $case->place = 'Aguascalietnes';
        $case->progress = 2;
        $case->observations = $request->subject;

         
        //buscamos al cliente para asignarle su direcion y su id de partticipante, caso  
        $custumer = Customer::find($insertedId);

        $addres = $custumer->address()->save($addres);
        // Como primer prametro se guarda el caso al que estara relacionado, y como segundo parametro
        // se pone un atributo de la tabla pibote entre estas dos con su valor asignado
        // la relacion es efectuada por eloquent 
        $case = $custumer->participant()->save($case,['participants_type' => $participant->participants_type]);

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

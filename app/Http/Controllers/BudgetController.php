<?php

namespace NotiAPP\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use NotiAPP\Http\Requests;
use NotiAPP\Http\Controllers\Controller;

use NotiAPP\Models\Budget;
use NotiAPP\Models\User;

class BudgetController extends Controller
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
    public function create()
    {
        //
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
        $users = User::where('user_type', 'manager' )->get();
        $Budget = Budget::find($id);
        return view('Budget.NewEditBuget',[ 'Budget' => $Budget, 'users' =>$users]);
 
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
        $Upddate = Budget::find($id);

    /* -------------------- Calculo o Asignacion de Honorarios Base Y Excepciónes de ISABI ------------------------------------------------------------------------*/
        $Upddate->operation_value = $request->valor_operacion;

        //Calculamos o no Los honorarios
        if ($Upddate->case_service->service->service_type == 'enagenante') {

            $Upddate->fee = $Upddate->FeeByOpertationVaule($Upddate->operation_value);
            //ISABI es 2% del Valor de Operación para todos los servicios  que lo necesiten (exepto en Donación en Aguascalientes hay es 0%)
            if ( ($Upddate->case_service->service->name == 'Donaciones' && $Upddate->case_service->place == 'Aguascalientes') || ( $Upddate->case_service->service->name == 'Contrato mutuo con Interés y Garantía Hipotecaria') ) {
                
                $Upddate->isabi = 0;

            }else{
                $Upddate->isabi = (($Upddate->operation_value * 2 )/ 100 ); 
            }
        }
        else{
            $Upddate->fee = $request->honorarios;
        }
        /* --------------------------------------------------------------------------------------------*/

        /* --------------------- GASTOS DE REGISTROS  -----------------------------------------------*/ 
        if ($Upddate->case_service->service->name == 'Reconocimiento y Aceptación de Herencia') {
            //este es el unico servicio que requiere esto
            $Upddate->edicts = $request->edictos;
        }
        
        //Gastos de Registro e Hipotecas
         //Podemos hacer lo con el input que nos da el request o con esta consulta 
          //de igual forma para todos los  que ocupend un numero determidaod para calcular su todal (certificados,Gastos de Registro,Cancelaciones)
          $Upddate->n_registration = $request->ngastos_registro;
         //$Upddate->total_registration_costs = $request->ngastos_registro * $Upddate->case_service->service->expenses->where('expense_name', "Gastos de Registro")->first()->pivot->cost;
         $Upddate->total_registration_costs = $request->gastos_registro * $request->ngastos_registro;

        $Upddate->n_certificates =  $request->ncertificados;
        //$Upddate->total_registration_costs = $request->ngastos_registro * $Upddate->case_service->service->expenses->where('expense_name', "Certificados")->first()->pivot->cost;
        $Upddate->total_certified_expenditure =  $request->ncertificados * $request->certificados;;


        if ($Upddate->case_service->service->name == 'Dacion en Pago') {
            // En dacion de Pagos se Puede registrar la dacion de pago de la propiedad y la cancelacion de hipoteca de la propiedad 
            $hipotecas = $request->ncancelacion_hipoteca * $request->cancelacion_hipoteca;
            $registro = $request->gastos_registro * $request->ngastos_registro;
            $Upddate->n_registration = $request->ncancelacion_hipoteca + $request->ngastos_registro;

            $Upddate->total_registration_costs = $registro + $hipotecas;
        } 
    /* --------------------------------------------------------------------------------------------*/
    /* --------------------------------GENERALES---------------------------------------------------*/

        $Upddate->property_valuation = $request->avaluo_catastral; //como es un checbox solo se agregara si esta seleccioando
        $Upddate->commercial_appraisal = $request->avaluo_comercial; //como es un checbox solo se agregara si esta seleccioando
        $Upddate->writing_management = $request->gestoria;  //como es un checbox solo se agregara si esta seleccioando
        $Upddate->isr = $request->isr;
        $Upddate->isnjin= $request->isnjin;

        $Upddate->advance_payment = $request->advance_payment;
        $Upddate->payment_type = $request->payment_type;
        $Upddate->discount = $request->discount;
        $Upddate->miscellaneous_expense = $request->miscellaneous_expense;
        $Upddate->travel_expenses = $request->travel_expenses;

        // PREGUNTAR SOBRE COMO SE MANJEAN LOS RECARGOS
        $Upddate->surcharges = $request->surcharges;
    /* --------------------------------------------------------------------------------------------*/

        switch ($Upddate->case_service->service->name) {
            case 'Fe de Hechos':
                        $Upddate->n_extra_hours = $request->nhora_extra;
                        //los honorarios tiene un cosot fijo e incrementa por por el numero de horas extra 
                        $Upddate->total_extra_hours = $request->hora_extra * $Upddate->n_extra_hours;
                        if ($request->invoiced == '1') {
                            //calculamos el iva a agregar en base a los honorarios 
                            $Upddate->iva =  (($Upddate->fee + $Upddate->total_extra_hours) * 16)/100;
                            $Upddate->invoiced =  $request->invoiced; //indicamos que el servicio va facturado en la bace de datos
                        }
                break;
            
            case 'Cotejo y Certificación':
                        $Upddate->n_extra_paper = $request->nhonorarios_HojaExtra;
                         //los honorarios tiene un cosot fijo e incrementa por el numero de hojas adicionales
                        $Upddate->total_extra_paper = $request->honorarios_HojaExtra * $Upddate->n_extra_paper;
                        if ($request->invoiced == '1') {
                             //calculamos el iva a agregar en base a los honorarios 
                            $Upddate->iva =  (($Upddate->fee + $Upddate->total_extra_paper ) * 16)/100;
                            $Upddate->invoiced =  $request->invoiced; //indicamos que el servicio va facturado en la bace de datos
                        }
            break;
            default:
                // Si se va a Facturar el Caso 
                     if ($request->invoiced == '1') {
                         //calculamos el iva a agregar en base a los honorarios 
                        $Upddate->iva =  ($Upddate->fee * 16)/100;
                        $Upddate->invoiced =  $request->invoiced; //indicamos que el servicio va facturado en la bace de datos
                      }
                break;
        }

         

        $Upddate->sub_total = $Upddate->SubTotal();

        $Upddate->total = $Upddate->sub_total + $Upddate->iva;

        $Upddate->save();

        return Redirect::route('Show_Case_path', array('id_caseService' => $Upddate->case_service->id));
        //dd($Upddate->case_service->id);
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

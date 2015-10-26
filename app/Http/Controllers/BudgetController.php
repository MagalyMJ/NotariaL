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
     * Display the specified resource in PDF Format
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        $Budget = Budget::find($id);

        $date = date('d-m-Y');


        switch ($Budget->case_service->service->name) {

            case 'Testamento':

                $view =  \View::make('pdf.TestamentoBudget', compact('date','Budget'))->render();
                break;
            case 'Contrato Compra Venta':

                $view =  \View::make('pdf.CompraVentaBudget', compact('date','Budget'))->render();
                break;

            case 'Donaciones':

                $view =  \View::make('pdf.DonacionesBudget', compact('date','Budget'))->render();
                break;

            case 'Acta Constitutiva':

                $view =  \View::make('pdf.ActaConstitutivaBudget', compact('date','Budget'))->render();
                break;

            case 'Contrato mutuo con Interés y Garantía Hipotecaria':

                $view =  \View::make('pdf.MutuoInteresBudget', compact('date','Budget'))->render();
                break;

            case 'Cancelacion de Hipoteca':

                $view =  \View::make('pdf.CancelacionHipotecaBudget', compact('date','Budget'))->render();
                break;

            case 'Poder General':

                $view =  \View::make('pdf.PoderGeneralBudget', compact('date','Budget'))->render();
                break;

            case 'Sucesiónes Intestamentaría':

                $view =  \View::make('pdf.SucesionesIntestamentariaBudget', compact('date','Budget'))->render();
                break;

            case 'Sucesiónes Testamentaría':

            // NO ESTA TOMANDO SU VISTA DE PDF Call to undefined method DOMText::getAttribute()
                $view =  \View::make('pdf.budgetPDF', compact('date','Budget'))->render();
                break;

            case 'Capitulaciones Matrimoniales':

                $view =  \View::make('pdf.MatrimonialesBudget', compact('date','Budget'))->render();
                break;

            case 'Fe de Hechos':

                $view =  \View::make('pdf.FedeHechosBudget', compact('date','Budget'))->render();
                break;

            case 'Revocación de Poder':

                $view =  \View::make('pdf.RevocacionPoderBudget', compact('date','Budget'))->render();
                break;

            case 'Adjudicación Testamentaria':

                $view =  \View::make('pdf.AdjudicacionTestamentariaBudget', compact('date','Budget'))->render();
                break;

            case 'Reconocimiento y Aceptación de Herencia':

                $view =  \View::make('pdf.ReconocimientoAceptacionHerenciaBudget', compact('date','Budget'))->render();
                break;

            case 'Cotejo y Certificación':

                $view =  \View::make('pdf.CotejoCertificacionBudget', compact('date','Budget'))->render();
                break;

            case 'Protocolización de Acta de Asamblea':

                $view =  \View::make('pdf.ActaAsambleaBudget', compact('date','Budget'))->render();
                break;

            case 'Protocolización de Subdivisión':

                $view =  \View::make('pdf.SubdivisionBudget', compact('date','Budget'))->render();
                break;

            case 'Dacion en Pago':

                $view =  \View::make('pdf.DacionPagoBudget', compact('date','Budget'))->render();
                break;

            case 'Permutas':

                $view =  \View::make('pdf.PermutasBudget', compact('date','Budget'))->render();
                break;

            case 'Adjudicación Judicial':

                $view =  \View::make('pdf.AdjudicacionJudicialBudget', compact('date','Budget'))->render();
                break;

            case 'Cotejo y Ratificacion':

                $view =  \View::make('pdf.CotejoRatificacionBudget', compact('date','Budget'))->render();
                break;
            
            default:
                
                $view =  \View::make('pdf.budgetPDF', compact('date','Budget'))->render();
                break;
            }   

         
        
         $pdf = \App::make('dompdf.wrapper');

         $pdf->loadHTML($view);

        return $pdf->stream('PDF');
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
          $Upddate->n_registration = $request->ngastos_resgistro;
         //$Upddate->total_registration_costs = $request->ngastos_resgistro * $Upddate->case_service->service->expenses->where('expense_name', "Gastos de Registro")->first()->pivot->cost;
         $Upddate->total_registration_costs = $request->gastos_registro * $request->ngastos_resgistro;

        $Upddate->n_certificates =  $request->ncertificados;
        //$Upddate->total_registration_costs = $request->ngastos_resgistro * $Upddate->case_service->service->expenses->where('expense_name', "Certificados")->first()->pivot->cost;
        $Upddate->total_certified_expenditure =  $request->ncertificados * $request->certificados;;


        if ($Upddate->case_service->service->name == 'Dacion en Pago') {
            // En dacion de Pagos se Puede registrar la dacion de pago de la propiedad y la cancelacion de hipoteca de la propiedad 
            $hipotecas = $request->ncancelacion_hipoteca * $request->cancelacion_hipoteca;
            $registro = $request->gastos_registro * $request->ngastos_resgistro;
            $Upddate->n_registration = $request->ncancelacion_hipoteca + $request->ngastos_resgistro;

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
    /* ------------------Calculos de IVA---------------------------------------------------------------*/

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

    /* --------------------------------------------------------------------------------------------*/
         

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

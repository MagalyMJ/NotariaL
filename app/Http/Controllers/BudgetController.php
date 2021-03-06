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
    * Create a new authentication controller instance.
    *
    * @return void
    */
   public function __construct(){
        $this->middleware('auth');
    }
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


        $view = $this->TypeServicePDF($Budget->case_service->service->name,$date,$Budget);

         
        
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
        $Budget = Budget::find($id);
       
       return $this->EditBugetTypeService($Budget->case_service->service->name,$Budget);
 
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
        
        /* -------------------- Calculo o Asignacion de Honorarios Base ------------------------------------------------------------------------*/
        $Upddate->operation_value = (int)$request->valor_operacion;

        //En algunos servicios los honorarios ya estan por defecto, en otros son basados por el valor de operacion.
        if ($Upddate->case_service->service->service_type == 'enagenante') {

            $Upddate->fee = $Upddate->FeeByOpertationVaule($Upddate->operation_value);

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

         $Upddate->total_registration_costs = $request->gastos_registro * $request->ngastos_resgistro;

        $Upddate->n_certificates =  $request->ncertificados;

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
            $Upddate->isnjin= $request->isnjin; // ISNJIN un campo abierto porque varia a la peticiones
            $Upddate->isabi = $request->isabi; // El ISABI es el 2% del valor de operacion para, pero se deja como un acampo abierto a peticion de los usuarios
            $Upddate->advance_payment = $request->advance_payment;
            $Upddate->payment_type = $request->payment_type;
            $Upddate->discount = $request->discount;
            $Upddate->miscellaneous_expense = $request->miscellaneous_expense;
            $Upddate->travel_expenses = $request->travel_expenses;

            $Upddate->approved = $request->approved;
            
            // Los recargos varian por lo que es un campo abierto. 
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
                                $Upddate->iva =  (($Upddate->fee + $Upddate->total_extra_hours - $Upddate->discount) * 16)/100;
                                $Upddate->invoiced =  $request->invoiced; //indicamos que el servicio va facturado en la bace de datos
                            }
                    break;
                
                case 'Cotejo y Certificación':
                            $Upddate->n_extra_paper = $request->nhonorarios_HojaExtra;
                             //los honorarios tiene un cosot fijo e incrementa por el numero de hojas adicionales
                            $Upddate->total_extra_paper = $request->honorarios_HojaExtra * $Upddate->n_extra_paper;
                            if ($request->invoiced == '1') {
                                 //calculamos el iva a agregar en base a los honorarios 
                                $Upddate->iva =  (($Upddate->fee + $Upddate->total_extra_paper - $Upddate->discount) * 16)/100;
                                $Upddate->invoiced =  $request->invoiced; //indicamos que el servicio va facturado en la bace de datos
                            }
                break;
                default:
                    // Si se va a Facturar el Caso 
                         if ($request->invoiced == '1') {
                             //calculamos el iva a agregar en base a los honorarios 
                            $Upddate->iva =  (($Upddate->fee - $Upddate->discount)* 16)/100;
                            $Upddate->invoiced =  $request->invoiced; //indicamos que el servicio va facturado en la bace de datos
                          }
                    break;
            }
            $Upddate->iva_construction = $request->iva_construction;
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

/**
     * Escoje la vista del prespupesto en PDF dependiendo del servico  
     *
     * @param  string  $typeService, string $date, Model Objegt $Budget
     * @return View
     */
    public function TypeServicePDF($typeService,$date,$Budget){
         switch ($typeService) {

            case 'Testamento':

                return \View::make('pdf.TestamentoBudget', compact('date','Budget'))->render();
                break;
            case 'Contrato Compra Venta':

                return  \View::make('pdf.CompraVentaBudget', compact('date','Budget'))->render();
                break;

            case 'Donaciones':

                return  \View::make('pdf.DonacionesBudget', compact('date','Budget'))->render();
                break;

            case 'Acta Constitutiva':

                return  \View::make('pdf.ActaConstitutivaBudget', compact('date','Budget'))->render();
                break;

            case 'Contrato mutuo con Interés y Garantía Hipotecaria':

                return  \View::make('pdf.MutuoInteresBudget', compact('date','Budget'))->render();
                break;

            case 'Cancelacion de Hipoteca':

                return  \View::make('pdf.CancelacionHipotecaBudget', compact('date','Budget'))->render();
                break;

            case 'Poder General':

                return  \View::make('pdf.PoderGeneralBudget', compact('date','Budget'))->render();
                break;

            case 'Sucesiónes Intestamentaría':

                return  \View::make('pdf.SucesionesIntestamentariaBudget', compact('date','Budget'))->render();
                break;

            case 'Sucesiónes Testamentaría':

            // NO ESTA TOMANDO SU VISTA DE PDF Call to undefined method DOMText::getAttribute()
                return  \View::make('pdf.SucesionesTestamentariaBudget', compact('date','Budget'))->render();
                break;

            case 'Capitulaciones Matrimoniales':

                return  \View::make('pdf.MatrimonialesBudget', compact('date','Budget'))->render();
                break;

            case 'Fe de Hechos':

                return  \View::make('pdf.FedeHechosBudget', compact('date','Budget'))->render();
                break;

            case 'Revocación de Poder':

                return  \View::make('pdf.RevocacionPoderBudget', compact('date','Budget'))->render();
                break;

            case 'Adjudicación Testamentaria':

                $view =  \View::make('pdf.AdjudicacionTestamentariaBudget', compact('date','Budget'))->render();
                break;

            case 'Reconocimiento y Aceptación de Herencia':

                return  \View::make('pdf.ReconocimientoAceptacionHerenciaBudget', compact('date','Budget'))->render();
                break;

            case 'Cotejo y Certificación':

                return  \View::make('pdf.CotejoCertificacionBudget', compact('date','Budget'))->render();
                break;

            case 'Protocolización de Acta de Asamblea':

                return  \View::make('pdf.ActaAsambleaBudget', compact('date','Budget'))->render();
                break;

            case 'Protocolización de Subdivisión':

                return  \View::make('pdf.SubdivisionBudget', compact('date','Budget'))->render();
                break;

            case 'Dacion en Pago':

                return  \View::make('pdf.DacionPagoBudget', compact('date','Budget'))->render();
                break;

            case 'Permutas':

                return  \View::make('pdf.PermutasBudget', compact('date','Budget'))->render();
                break;

            case 'Adjudicación Judicial':

                return  \View::make('pdf.AdjudicacionJudicialBudget', compact('date','Budget'))->render();
                break;

            case 'Cotejo y Ratificacion':

                return  \View::make('pdf.CotejoRatificacionBudget', compact('date','Budget'))->render();
                break;
            
            default:
                
                $view =  \View::make('pdf.budgetPDF', compact('date','Budget'))->render();
                break;
            } 
    }
    /**
     * Escoje la vista del prespupesto  para el formualrio dependiendo del servico  
     *
     * @param  string  $typeService, string $date, Model Objegt $Budget
     * @return View
     */
    public function EditBugetTypeService($typeService,$Budget){
         switch ($typeService) {

            case 'Testamento':

                 return view('Budget.BudgetEdit.TestamentoEditBudget',[ 'Budget' => $Budget ]);
                 
                break;
            case 'Contrato Compra Venta':

                return view('Budget.BudgetEdit.CompraVentaEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Donaciones':

                return view('Budget.BudgetEdit.DonacionesEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Acta Constitutiva':

                return view('Budget.BudgetEdit.ActaConstitutivaEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Contrato mutuo con Interés y Garantía Hipotecaria':

                return view('Budget.BudgetEdit.MutuoInteresEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Cancelacion de Hipoteca':

                return view('Budget.BudgetEdit.CancelacionHipotecaEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Poder General':

                return view('Budget.BudgetEdit.PoderGeneralEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Sucesiónes Intestamentaría':

                return view('Budget.BudgetEdit.SucesionesIntestamentariaEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Sucesiónes Testamentaría':

                return view('Budget.BudgetEdit.SucesionesTestamentariaEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Capitulaciones Matrimoniales':

                return view('Budget.BudgetEdit.MatrimonialesEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Fe de Hechos':

                return view('Budget.BudgetEdit.FeHechosEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Revocación de Poder':

                return view('Budget.BudgetEdit.RevocacionPoderEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Adjudicación Testamentaria':

                return view('Budget.BudgetEdit.AdjudicacionTestamentariaEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Reconocimiento y Aceptación de Herencia':

                return view('Budget.BudgetEdit.AceptacionHerenciaEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Cotejo y Certificación':

                return view('Budget.BudgetEdit.CotejoCertificacionEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Protocolización de Acta de Asamblea':

                return view('Budget.BudgetEdit.ActaAsambleaEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Protocolización de Subdivisión':

                return view('Budget.BudgetEdit.SubdivisionEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Dacion en Pago':

                return view('Budget.BudgetEdit.DacionPagoEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Permutas':

                return view('Budget.BudgetEdit.PermutasEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Adjudicación Judicial':

                return view('Budget.BudgetEdit.AdjudicacionJudicialEditBudget',[ 'Budget' => $Budget ]);
                break;

            case 'Cotejo y Ratificacion':

                return view('Budget.BudgetEdit.CotejoRatificacionEditBudget',[ 'Budget' => $Budget ]);
                break;
            
            default:
                
                return "sin Vista";
                break;
            } 
    }
}

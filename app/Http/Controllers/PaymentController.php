<?php

namespace NotiAPP\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use NotiAPP\Http\Requests;
use NotiAPP\Http\Controllers\Controller;

use NotiAPP\Models\CaseService;
use NotiAPP\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_caseService)
    {
        //
         $ServiceCase = CaseService::find($id_caseService);
         $ServiceCase->SumPayments();
         return view('Payment.ListCasePayments',[ 
            'ServiceCase' => $ServiceCase,
            'SumPayments' => $ServiceCase->SumPayments(), 
            'BudgetTotal'=> $ServiceCase->budget->total,
            'DiffToPay' =>  $ServiceCase->budget->total - $ServiceCase->SumPayments() ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     *@param  int $id_caseService
     * @return \Illuminate\Http\Response
     */
    public function create($id_caseService)
    {
        //
         $ServiceCase = CaseService::find($id_caseService);

         return view('Payment.CratePayment',[ 'ServiceCase' => $ServiceCase]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request , Int $id_caseService
     * @return \Illuminate\Http\Response
     */
    public function store($id_caseService, Request $request)
    {
        //
         
         $newPayment = new Payment;
         $newPayment->name = $request->name;
         $newPayment->payment_type = $request->payment_type;
         $newPayment->amount_to_pay = $request->amount_to_pay;

         $newPayment->save();

        //realizamos la relacion del pago con el caso correspondiente
         $CaseService = CaseService::find($id_caseService);

         $CaseService->payment()->save($newPayment);
        
        //el saldo restante a apgar se guarda en el caso
        $CaseService->remaining =  $CaseService->budget->total - $CaseService->SumPayments() ;

        $CaseService->save();
        return Redirect::route('Show_Case_path', array('id_caseService' => $CaseService->id));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

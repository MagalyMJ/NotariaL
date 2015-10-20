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
        return view('Budget.EditBudget',[ 'Budget' => $Budget, 'users' =>$users]);
 
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

        $Upddate->operation_value = $request->operation_value;
        $Upddate->payment_type = $request->payment_type;
        $Upddate->approved = $request->approved;
        $Upddate->total = $request->total;
        $Upddate->user_id = $request->user_id;
        $Upddate->invoiced = $request->invoiced;
        $Upddate->discount = $request->discount;
        $Upddate->travel_expenses = $request->travel_expenses;
        $Upddate->miscellaneous_expense = $request->miscellaneous_expense;
        $Upddate->advance_payment= $request->advance_payment;
        $Upddate->surcharges= $request->surcharges;
        $Upddate->isnjin= $request->isnjin;
        $Upddate->isr = $request->isr;
        
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

<?php

namespace NotiAPP\Http\Controllers;

use Illuminate\Http\Request;

use NotiAPP\Http\Requests;
use NotiAPP\Http\Controllers\Controller;

use NotiAPP\Models\Custumer;
use NotiAPP\Models\Address;

class TestamentController extends Controller
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
        // Aqui se creara un nuevo caso de testamento

    }
    public function addCustumer(Request $request)
    {
        // Aqui se creara un nuevo caso de testamento
        //dd($request->all());

        $addCustumer = new Custumer;
        $addres = new Address;

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
        
        $insertedId = $addCustumer->id;

        $addres->street = $request->street;
        $addres->number = $request->number;
        $addres->colony = $request->colony;
        $addres->postal_code = $request->postal_code;

        $post = Custumer::find($insertedId);

        $addres = $post->address()->save($addres);   

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

<?php

namespace NotiAPP\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use NotiAPP\Http\Requests;
use NotiAPP\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return view('login');
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
        //esto muestra lo que esta mandando el formulario
        //dd($request->all());

        $this->validate($request, [
            'user_name'    => 'required',
            'password' => 'required',
        ]);

        //
        if (!auth()->attempt($request->only(['user_name', 'password']))) {
            return redirect()->route('auth_show_path')->withErrors('No se encontro al usuario');
        }
        return ('home');
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

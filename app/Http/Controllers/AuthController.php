<?php

namespace NotiAPP\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;

use NotiAPP\Http\Requests;
use NotiAPP\Http\Controllers\Controller;
use Session;
class AuthController extends Controller
{
      /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

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
        return Redirect::route('home');
    }
    /**
     * Metodo para hacer un cierre de secion basico 
     *
     * @return Redirect
     */
    public function getLogout()
    {
        auth()->logout();

        Session::flush(); 

        return redirect()->route('auth_show_path');
    }
}

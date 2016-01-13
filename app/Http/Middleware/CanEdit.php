<?php

namespace NotiAPP\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use NotiAPP\Models\CaseService;


class CanEdit
{
    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Este Middleware filtra que sea el usuario asignado o administrador para poder editar
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $id_serviceCase
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $CaserService = CaseService::find($request->id_caseService);
        
        if ($this->auth->check() && $CaserService->isMyuser() ) { 
            return $next($request);
        }
        else {
            return redirect('Error/AccesoDenegado');
        }

    }
}


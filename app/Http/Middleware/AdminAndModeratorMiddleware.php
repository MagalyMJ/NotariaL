<?php

namespace NotiAPP\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;


class AdminAndModeratorMiddleware
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
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check() && $this->auth->user()->is('admin|moderator')) { 
            return $next($request);
        }
        else {
            return redirect('Error/AccesoDenegado');
        }

    }
}

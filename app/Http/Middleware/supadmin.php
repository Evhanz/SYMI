<?php

namespace symi\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Session;
use Closure;

class supadmin
{


    protected  $auth;

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
        switch ($this->auth->user()->idrol){

            case '1':
                #supadmin
                //return redirect()->to('marca');
            break;

        }

        return $next($request);
    }





}

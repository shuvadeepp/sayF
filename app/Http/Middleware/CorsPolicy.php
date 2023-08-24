<?php

/********************************************
  File Name     : BasicAuth.php
  Description   : Middleware to authienticate the API requests
  Created By    : Samir Kumar
  Created On    : 14-Jun-2021

  ======================================================================
  |Update History                                                      |
  ======================================================================
  |<Updated by>                 |<Updated On> |<Remarks>         
  ----------------------------------------------------------------------
  |Name Goes Here               |XX-XXX-XXXX  |Remark goes here        
  ----------------------------------------------------------------------
  |                             |             |                  
  ----------------------------------------------------------------------

 ********************************************/

namespace App\Http\Middleware;
use Closure;

class CorsPolicy
{
    
    public function handle($request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Access-Control-Allow-Methods','GET,POST,PUT,PATCH,DELETE,OPTIONS')
            ->header('Access-Control-Allow-Headers','Content-Type,Authorization,x-csrf-token,X-CSRF-TOKEN');
    
    }
}

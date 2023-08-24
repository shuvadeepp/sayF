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

class BasicAuth
{
    
   public function handle($request, Closure $next)
    {
        $has_supplied_credentials   = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
        $auth_user                  = !empty($_SERVER['PHP_AUTH_USER'])?$_SERVER['PHP_AUTH_USER']:'';
        $auth_pwd                   = !empty($_SERVER['PHP_AUTH_PW'])?$_SERVER['PHP_AUTH_PW']:'';
        
        $is_not_authenticated       = (!$has_supplied_credentials ||  !\Hash::check($auth_user,env('BASIC_AUTH_UID')) || !\Hash::check($auth_pwd,env('BASIC_AUTH_PWD')));

        if ($is_not_authenticated) {
            $respArr      = array('status' => 403, 'msg' => 'invalid authentication credentials');
            return response()->json($respArr);
            exit;
        } 
        return $next($request);
       
    }
}

<?php

/* * ******************************************
  File Name     : AccountController.php
  Description   : Controller file for managing all the ajax requests of Website and employer and employee
  Created By    : Ananya Dash
  Created On    : 06-Apr-2021

  ======================================================================
  |Update History                                                      |
  ======================================================================
  |<Updated by>                 |<Updated On> |<Remarks>
  ----------------------------------------------------------------------
  |Name Goes Here               |DD-MMM-YYYY  |Remark goes here
  ----------------------------------------------------------------------
  |                             |             |
  ----------------------------------------------------------------------

 * ****************************************** */

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\AppController;
use App\Models\EmployerprofileModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use DB;
use Storage;

class AccountController extends AppController {
    public function index(){
       return view('employer.postjob');      
    }
}
<?php

/* * ******************************************
  File Name     : LoginController.php
  Description   : Controller file for managing all the ajax requests of Website and employer and employee
  Created By    : Samir Kumar
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

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\AppController;
use App\Models\AdminModel;
use Session;
use Illuminate\Http\Request;
use App\Captcha\Securimage;
use Validator;
use DB;
use App\Models\MessageModel;
use App\Models\MessageconvoModel;
use App\Models\PartnerDetailsCounterModel;



class DashboardController extends AppController {
    public function index(){
         $partnerId       = session('partner_session_data.userId');
         $messageThreads=array();
        $messageThreads  = MessageModel::select('*')
                         ->where([['respOne',$partnerId]])
                          ->orwhere([['respTwo',$partnerId]])
                          ->where([['deletedFlag',0]])
                          ->orderBy('updatedOn','DESC')
                          ->get();
                       // echo "<pre>";  print_R($messageThreads);exit;

      $this->viewVars['messageThreads'] = $messageThreads; 
      $this->viewVars['JobViews'] = DB::select('SELECT sum(counter) AS ngoall from t_partner_details_counter a left join t_partner_profile b on b.profileId=a.partnerId WHERE a.deletedFlag=0 and b.partnerId='.$partnerId .' and  b.deletedFlag=0');
        $this->viewVars['JobViewsLast7days'] =  DB::select('SELECT sum(counter) AS ngo7days  from t_partner_details_counter a left join t_partner_profile b on b.profileId=a.partnerId WHERE a.deletedFlag=0 and b.partnerId='.$partnerId .' and  b.deletedFlag=0 and  DATE(a.createdOn) > (NOW() - INTERVAL 7 DAY)');
      return view('partner.dashboard',$this->viewVars);
    }


   
}

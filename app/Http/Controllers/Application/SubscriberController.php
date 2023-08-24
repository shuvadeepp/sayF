<?php

/* * ******************************************
  File Name     : SubscriberController.php
  Description   : Controller file to display the Subscriber list & Export the list
  Created By    : Sangita Pratap
  Created On    : 03-Apr-2023

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

namespace App\Http\Controllers\Application;

use App\Http\Controllers\AppController;
use Session;
use Illuminate\Http\Request;
use Validator;
use DB;
use Storage;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class SubscriberController extends AppController {
/* Subscriber List Page -- Sangita Pratap -- 03-04-2023 -- */
public function index(){ 

      $subscriberList=DB::table('m_newsletter as US')
           ->where([['US.deletedFlag',0],['US.subscriptionStatus',1]]);     
 
      $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;    
    
      if($isViewAll==2){      
        $subscriberList=$subscriberList->get();
      }elseif($isViewAll==1){
        $subscriberList=$subscriberList->paginate(TOTPAGINATE);       
      }
  
  
      $this->viewVars['userList'] = $subscriberList;
      $this->viewVars['startrec']  = $isViewAll;
 
    return view('application.subscriberList',$this->viewVars);
}

  public function exportSubscribers(){    
    $fp = fopen('php://output', 'w');
    $filename = "Subscriber_List.xlsx";

    $header = ["Sl No.","Email","Subscription Date"];

    header('Content-type: application/xlsx');
            header('Content-Disposition: attachment; filename=' . $filename);
            fputcsv($fp, $header);
   
            $data = DB::table('m_newsletter')->select(['emailId', DB::raw('DATE(m_newsletter.createdOn) as createdOn')])->where([['subscriptionStatus','1'],['deletedFlag','0']])->get();

            $data = json_decode(json_encode($data),true);
           
            $ctr = 0;
            foreach ($data as $subscriberData) {
              $ctr++;
              
            $rowcsv[0] = $ctr;
            $rowcsv[1] = $subscriberData['emailId'];
            $rowcsv[2] = $subscriberData['createdOn'];
           
            fputcsv($fp, $rowcsv);
          } 
          fclose($fp);
          exit(0);
  }
}
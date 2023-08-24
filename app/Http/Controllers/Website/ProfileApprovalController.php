<?php

/* * ******************************************
  File Name     : ProfileApprovalController.php
  Description   : Controller file to manage approval or reject of Employer profile
  Created By    : Sangita Pratap
  Created On    : 25-May-2022

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

namespace App\Http\Controllers\Website;

use App\Http\Controllers\AppController;
use App\Models\EmployerprofileModel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ProfileApprovalController extends AppController {

    public function index($encEmpId){     
       $approvalUrl=0;     
      if(!empty($encEmpId)){
        $approvalUrl++;
        try {
          $decrypted = Crypt::decryptString($encEmpId);
          $decryptarr=explode("~::~",$decrypted);
          $employerId=$decryptarr[0]; 
      } catch (DecryptException $e) {
          //
      }   

      }     
   
      $skills                       = DB::table('m_skills')
                                      ->select('skillsId','skillName')
                                      ->where([['publishStatus',0],['deletedflag',0]])->get();

      $industries                   = DB::table('m_industrytype')
                                      ->select('industryId','industryName')
                                      ->where([['publishStatus',0],['deletedflag',0]])->get();


      $existingProfile              = DB::table('t_employer_profile')
                                      ->where([['deletedflag',0],['employerId', $employerId]])->get()->first();    
                                      // echo '<pre>';print_r($existingProfile);exit;  

       $locations  = DB::table('m_location')
                ->select('stateId','state')
                ->where('deletedflag',0)
                ->orderBy('state','ASC')
                ->groupBy('stateId','state')
                ->get();                                                                        
      $this->viewVars['skills']     = $skills;
      $this->viewVars['industries'] = $industries;
      $this->viewVars['locations']  = $locations;
      $this->viewVars['existingProfile'] = $existingProfile;
      $this->viewVars['approvalUrl']=$approvalUrl;
      $this->viewVars['employerId']=$employerId;  
      $this->viewVars['approvalTime']=$existingProfile->approvalTime;
      return view('website.empProfileApproval',$this->viewVars);      
    }


    // /* Employer approval mail send to super admin -- Sangita Pratap -- 18th May 2022 */ 
    // public function employerApprovalMail($employerId){

    //   $adminMails=array('sangita.raddyx18@gmail.com','sangita@csm.co.in');

    //   EmployerprofileModel::where('employerId', $employerId)
    //         ->update([
    //           'approvalTime' => date('Y-m-d H:i:s')
    //         ]);

    //   foreach($adminMails as $mails){    
    //    $encryptedurl = Crypt::encryptString($employerId.'~::~'.time());
      
    //     $varurl='<a href='.ROOT_URL.'/employer/employerprofile/'.$encryptedurl.'>click here</a>';
    //     $mailContent='Click on this link to view Employer Profile : '. $varurl;
    //      $ccmailAddress='';
    //      $bccmailAddress='';
    //      $subject='Employer Profile Approval Request';
    //      $attachment='';
    //      $sendTo=$mails;
    //     echo '<pre>'; print_r($mailContent); exit;
    //     $sendemail=1;
    //      $sendemail=sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);
    //   }
    //      if($sendemail==1)
    //      {  
    //        return 'success';         
    //      }
    //      else
    //      {
    //        return 'failed';          
    //      }      
    // }  
}
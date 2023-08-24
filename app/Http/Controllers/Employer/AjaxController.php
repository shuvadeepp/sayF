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
use Session;
use Illuminate\Http\Request;
use App\Models\SkillModel;
use Validator;
use Illuminate\Support\Facades\DB;
use Storage;
use App\Models\DisabledocModel;
use Illuminate\Support\Facades\Response;
use App\Models\EmployerprofileModel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class AjaxController extends AppController {
    public function loadskills(){
   
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        $validator   = \Validator::make($requestData, [
                          'typedStr'            => 'bail|required|regex:/[A-Za-z0-9 ]/'
                        ]);
        if($validator->fails()) {
          $respArr    = array('status' => 500, 'msg' => $validator->errors());
          return response()->json($respArr);
        }else{
          $typedStr        = $requestData['typedStr'];
          //$selectedskill   = json_decode($requestData['selectedskill']);
          //$selectedskill   = ($selectedskill)?implode(',', $selectedskill):'';
          $getskills       = \DB::table('m_skills')
                                      ->select('skillsId','skillName')
                                      ->where('skillName', 'like', $typedStr . '%');
                                      
          if(!empty($selectedskill)){
            $getskills = $getskills->whereNotIn('skillsId', $selectedskill);
          }
          $getskills   = $getskills->where([['publishStatus',0],['deletedflag',0]])->get();
          $data        = collect($getskills)->map(function($x){ return (array) $x; })->toArray(); 

          //echo '<pre>';print_r($data);exit;     
          $respArr      = array('status' => 200, 'result' => $getskills);
          return response()->json($respArr);                       
        }
      }else{
        $respArr      = array('status' => 500, 'msg' => 'Sorry!! something went wrong');
        return response()->json($respArr);
      }
    }
    

    public function pushnewSkill(){
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        $validator   = \Validator::make($requestData, [
                          'newText'            => 'bail|required|regex:/[A-Za-z0-9 ]/'
                        ]);
        if($validator->fails()) {
          $respArr    = array('status' => 500, 'msg' => $validator->errors());
          return response()->json($respArr);
        }else{
          $newText        = $requestData['newText'];
          $chkDup         = \DB::table('m_skills')->where('skillName', '=', $newText)->count();
          //echo '<pre>';print_r($chkDup);exit;
          if(empty($chkDup)){
            $id = DB::table('m_skills')-> insertGetId(array(
                    'designationId' => 0,
                    'skillName'     => $newText,
                    'createdBy'     => session('employer_session_data.userId')
            ));
          }    
          $respArr      = array('status' => 200, 'resultid' => $id);
          return response()->json($respArr);                       
        }
      }else{
        $respArr      = array('status' => 500, 'msg' => 'Sorry!! something went wrong');
        return response()->json($respArr);
      }
    }

      /* Employer Profile approval mail send -- Sangita --  17-05-2022 -- */
          public function employerApprovalMail(){
            $requestData = request()->all();        
            $employerId=$requestData['employerId'];          

            EmployerprofileModel::where('employerId', $employerId)
            ->update([
              'approvalTime' => date('Y-m-d H:i:s')
            ]);
      
           // foreach($adminMails as $mails){         
              $encryptedurl = Crypt::encryptString($employerId.'~::~'.time());  
              $varurl='<a href='.ROOT_URL.'/profileapproval/'.$encryptedurl.'>Employer Profile</a>';        
             // $varurl='<a href='.ROOT_URL.'/employer/employerprofile/'.$encryptedurl.'>Employer Profile</a>';             
              $mailContent ='Dear Admin, <br/><br/>';
              $mailContent .='Click to view the : '. $varurl.' <br/><br/>';
              $mailContent .='Please review the profile within 48 hours. <br/><br/>';
               $ccmailAddress= '';
               $bccmailAddress='';
               $subject='Employer Profile Approval Request';
               $attachment='';
               $sendTo= APPROVAL_ADMIN; 
               $sendToAdmin= APPROVAL_ADMIN_CC; 
               $sendemail=sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);
               $sendAdminEmail=sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendToAdmin);
             
               if($sendAdminEmail==1)
               {  
                 return 'success';         
               }
               else
               {
                 return 'failed';          
               }     
            
          }  
}
<?php

/* * ******************************************
File Name     : ProfileController.php
Description   : Controller file for managing profile details for candidate
Created By    : Sandeep Kumar Senapati
Created On    : 12-Apr-2021

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

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\AppController;
use App\Models\AdminModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class ProfileController extends AppController {
 public function index(){
    $candidateId= SESSION('candidate_session_data.userId');

    $candidateDetls=DB::table('m_user_master')
        ->select('fullName','mobileNo','emailId','gender','DOB')
        ->where([['userId',$candidateId],['tinUserType',3],['deletedFlag',0]])->first();
    $fullName=$candidateDetls->fullName;
    $candMobile=$candidateDetls->mobileNo;
    $candEmail=$candidateDetls->emailId;
    $candGender=$candidateDetls->gender;
    $candDOB=$candidateDetls->DOB;
    $expFullName=explode(' ',$fullName);
    $cntName = count($expFullName);
    $firstName=$expFullName[0];
    $middleName='';
    $lastName = '';
    if($cntName==2){
        $middleName='';
        $lastName=$expFullName[1];
    }else if($cntName>=2){
        $middleName=$expFullName[1];
        $lastName=$expFullName[2];
    }
    
    $disability=DB::table('m_disabilitytype')
                    ->select('disabilityId','disabilityName')
                    ->where([['deletedflag',0],['publishStatus',0]])->get();

    $board=DB::table('m_board')
                    ->select('boardId','boardName')
                    ->where([['deletedflag',0],['publishStatus',0]])->get();
    
    $education=DB::table('m_educationtype')
                  ->select('educationId','educationName','educationType')
                  ->where([['deletedflag',0],['publishStatus',0]])->get();

   // $state=DB::table('m_state')
                  //  ->select('intId','name')->get();

                      $state  = DB::table('m_location')
                ->select('stateId','state')
                ->where('deletedflag',0)
                  ->orderBy('state','ASC')
                 ->groupBy('stateId','state')
                ->get();

    $skillRec=DB::table('m_skills')
                  ->select('skillsId','skillName')
                  ->where([['deletedflag',0],['publishStatus',0]])->get();
    /*Retrive Profile Data if exist */
    //Personal Information
    $personalInfo=DB::table('t_candidate_details')
      ->select('firstName','middleName','lastName','address','pin','city','state','secondMob','profileImage','disablityType','profileCV','candidateType','finalSubmit','disabilitySubType','disabilityPercentage','disabilityCertificateNo')
      ->where([['userId',$candidateId],['deletedFlag',0]])->first();

    //Work Experience
    $workDetls=DB::table('t_candidate_experience')
      ->select('designation','companyName','startYear','endYear','currentJob')
      ->where([['userId',$candidateId],['deletedFlag',0]])->get();

    //Education details
    $educationdetls=DB::table('t_candidate_education')
      ->select('class','board','medium','university','score','passYear','course','certificate','scoreType')
      ->where([['userId',$candidateId],['deletedFlag',0]])->get();

    //Skill details
    $skillDetls=DB::table('t_candidate_skill as S')
      ->select('S.skillId','S.skillName','S.experienceYear','S.skillCertificate','SK.skillName as skillnames')
      ->leftjoin('m_skills as SK',function($join1){
        $join1->on('SK.skillsId','=','S.skillName');
      })
      ->where([['S.userId',$candidateId],['S.deletedFlag',0]])->get();

    //document details
    $docDetails =  DB::table('t_disable_docs')
                  ->select('docId','candidateId','docFile')
                  ->where([['candidateId',$candidateId],['deletedFlag',0]])->get();  
    /*Retrive Profile Data if exist */
    //echo '<pre>';print_r($docDetails);exit;
    $ageLimit= date('Y-m-d', strtotime('-18 year'));
    $this->viewVars['candMobile']     = $candMobile;
    $this->viewVars['candEmail']      = $candEmail;
    $this->viewVars['candGender']     = $candGender;
    $this->viewVars['candDOB']        = $candDOB;
    $this->viewVars['firstName']      = $firstName;
    $this->viewVars['middleName']     = $middleName;
    $this->viewVars['lastName']       = $lastName;
    $this->viewVars['disability']     = $disability;
    $this->viewVars['education']      = $education;
    $this->viewVars['board']          = $board;
    $this->viewVars['states']         = $state;
    $this->viewVars['personalInfo']   = $personalInfo;
    $this->viewVars['workDetls']      = $workDetls;
    $this->viewVars['educationdetls'] = $educationdetls;
    $this->viewVars['docDetails']     = $docDetails;
    $this->viewVars['skillRec'] = $skillRec;
    $this->viewVars['skillDetls'] = $skillDetls;
    $this->viewVars['ageLimit'] = $ageLimit;
    return view('candidate.candidateProfile',$this->viewVars);
  }


}

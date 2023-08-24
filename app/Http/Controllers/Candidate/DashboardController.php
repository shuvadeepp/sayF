<?php

/* * ******************************************
  File Name     : LoginController.php
  Description   : Controller file for managing all the ajax requests of Website and employer and candidate
  Created By    : Samir Kumar
  Created On    : 05-Apr-2021

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
use App\Models\MessageModel;
use App\Models\AppliedJobModel;
use Session;
use Illuminate\Http\Request;
use App\Captcha\Securimage;
use Validator;
use DB;

class DashboardController extends AppController {
    public function index(){
      $candidateId    = session('candidate_session_data.userId');
      $profile_completion = 0 ;

      //Personal Information
      $candidateDetls=DB::table('m_user_master')
        ->select('fullName','mobileNo','emailId','gender','DOB')
        ->where([['userId',$candidateId],['tinUserType',3],['deletedFlag',0]])->first();

      $personalInfo=DB::table('t_candidate_details')
        ->select('firstName','middleName','lastName','address','pin','city','state','secondMob','profileImage','disablityType','profileCV','candidateType','finalSubmit','disabilitySubType','disabilityPercentage','disabilityCertificateNo')
        ->where([['userId',$candidateId],['deletedFlag',0]])->first();
      
      if(!empty($candidateDetls) && !empty($personalInfo)){
        //print_r($personalInfo);exit;

        $profile_completion = $profile_completion + 5 ;

        if(!empty($candidateDetls->DOB)){
          $profile_completion = $profile_completion + 1 ;
        }
        if(!empty($candidateDetls->mobileNo)){
          $profile_completion = $profile_completion + 2 ;
        }
        if(!empty($candidateDetls->emailId)){
          $profile_completion = $profile_completion + 2 ;
        }
        if(!empty($personalInfo->profileImage)){
          $profile_completion = $profile_completion + 5 ;
        }
        if(!empty($personalInfo->profileCV)){
        
          $profile_completion = $profile_completion + 5 ;
        }

        if(!empty($personalInfo->disablityType)){
          $profile_completion = $profile_completion + 2.5 ;
        }
        if(!empty($personalInfo->disabilitySubType)){
          $profile_completion = $profile_completion + 2.5 ;
        }
        if(!empty($personalInfo->disabilityPercentage)){
          $profile_completion = $profile_completion + 2.5 ;
        }
        if(!empty($personalInfo->disabilityCertificateNo)){
          $profile_completion = $profile_completion + 2.5 ;
        }

      }
//exit;
      //Work Experience
      $workDetls=DB::table('t_candidate_experience')
        ->select('designation','companyName','startYear','endYear','currentJob')
        ->where([['userId',$candidateId],['deletedFlag',0]])->get();
      if(!empty($workDetls)){
        $profile_completion = $profile_completion + 20 ;
      }

      //Education details
      $educationdetls=DB::table('t_candidate_education')
        ->select('class','board','medium','university','score','passYear','course','certificate','scoreType')
        ->where([['userId',$candidateId],['deletedFlag',0]])->get();
      if(!empty($educationdetls)){
        $profile_completion = $profile_completion + 20 ;
      }

      //Skill details
      $skillDetls=DB::table('t_candidate_skill as S')
        ->select('S.skillId','S.skillName','S.experienceYear','S.skillCertificate','SK.skillName as skillnames')
        ->leftjoin('m_skills as SK',function($join1){
          $join1->on('SK.skillsId','=','S.skillName');
        })
        ->where([['S.userId',$candidateId],['S.deletedFlag',0]])->get();
      if(!empty($skillDetls)){
        $profile_completion = $profile_completion + 20 ;
      }

      //document details
      $docDetails =  DB::table('t_disable_docs')
                    ->select('docId','candidateId','docFile')
                    ->where([['candidateId',$candidateId],['deletedFlag',0]])->get();  
      if(!empty($docDetails)){
        $profile_completion = $profile_completion + 10 ;
      }
      


      $getMessageThread  = MessageModel::select('*')
                         ->where([['respOne',$candidateId]])
                         ->orwhere([['respTwo',$candidateId]])
                         ->where([['deletedFlag',0]])->orderBy('updatedOn','DESC')->take(2)->get();
      // echo "<pre>";print_r($getMessageThread);exit;
      $this->viewVars['getMessageThread'] = $getMessageThread;  
      $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;       
      $arrAllRecords = AppliedJobModel::where('deletedFlag',0)
                     ->where('candidateId',$candidateId)
                     ->orderBy('createdOn','DESC')
                     ->paginate(TOTPAGINATE);
     

      $this->viewVars['startrec']  = $isViewAll;
      $this->viewVars['arrAllRecords'] = $arrAllRecords; 
      //  echo'<pre>';print_r($this->viewVars['arrAllRecords']);exit;
      $arrAllRecordsRelevent   = DB::table('t_job as A')
              ->select('A.jobId','A.jobTitle','A.jobLocation','A.jobVacancy','A.employmentTypeId','A.jobDescription','A.jobRoleResponsibilities','A.minExp','A.minSalary','A.maxSalary','A.companyDetails','A.createdOn','B.jobtypeName','H.liked','E.employerCompany',
                     DB::raw('group_concat(distinct(G.skillName)) as skillName'),
                     DB::raw('group_concat(distinct(G.skillsId)) as skillsId'),
                     DB::raw('group_concat(distinct(J.state)) as location'),
                     DB::raw('group_concat(distinct(L.location)) as city'),
                     DB::raw('group_concat(distinct(M.skillId)) as candidateskillId'),
                     DB::raw('group_concat(distinct(E.employerId)) as employerId'),
                   // DB::raw('select appliedJobId from t_applied_job where t_applied_job.jobId=A.jobId')
                      DB::raw("(select  COALESCE(SUM(appliedJobId),0) from t_applied_job where jobId=A.jobId and candidateId=$candidateId) as appliedJobId")
                )
              ->leftjoin('m_jobtype AS B','A.employmentTypeId','=','B.jobtypeId','B.deletedflag','=',0)
          
        
              ->leftjoin('t_jobskills AS F','F.jobId','=','A.jobId','F.deletedFlag','=',0)
              ->leftjoin('m_skills AS G','G.skillsId','=','F.skillId','G.deletedFlag','=',0)
              ->leftjoin('t_bookmarked AS H','H.jobId','=','A.jobId','H.candidateUserId','=','A.createdBy')
              ->leftjoin('t_job_location AS I','I.jobId','=','A.jobId','I.deletedFlag','=',0)
              ->leftjoin('m_location AS J','J.stateId','=','I.locationId','J.deletedFlag','=',0)
              ->leftjoin('m_location AS L','L.locationId','=','I.cityId','L.deletedFlag','=',0)

              ->leftjoin('t_employer_profile AS E','E.employerId','=','A.jobId', 'deletedFlag', '=', 0)

              ->rightjoin('t_candidate_skill AS M','M.skillName','=','F.skillId')
             // ->leftjoin('t_applied_job AS K','K.jobId','=','A.jobId')
              ->groupBy('A.jobId','A.jobTitle','A.jobLocation','A.jobVacancy','A.employmentTypeId','A.jobDescription','A.jobRoleResponsibilities','A.minExp','A.minSalary','A.maxSalary','A.industryId','A.qualificationId','A.companyDetails','A.createdOn','B.jobtypeName','H.liked','E.employerCompany')
              ->where([['A.deletedFlag',0],['A.job_status',1]])
              ->where('M.userId','=',$candidateId)
                // ->where('K.candidateId','=',$candidateId)
               ->paginate(TOTPAGINATE);
            // $arrAllRecordsRelevent=$arrAllRecordsRelevent->get()->toArray();
           //echo "<pre>";print_r($arrAllRecordsRelevent);exit;
              $this->viewVars['profile_completion'] = $profile_completion;  
              $this->viewVars['variableRelevent'] = $arrAllRecordsRelevent;
              // echo '<pre>';print_r($this->viewVars['variableRelevent']);exit;
      return view('candidate.dashboard',$this->viewVars);
    }


  


   
}

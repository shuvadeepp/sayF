<?php

/* * ******************************************
  File Name     : JobstatusController.php
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

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\AppController;
use App\Models\JobModel;
use App\Models\AppliedJobModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use DB;
use Storage;

class JobstatusController extends AppController {
    public function index(){
      $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
      $candidateId= SESSION('candidate_session_data.userId');
      $jobStatus=DB::table('t_applied_job as AJ')
        ->select('AJ.appliedJobId','AJ.jobId','AJ.candidateId','AJ.status','AJ.createdOn as appliedDate','J.jobTitle','J.jobLocation','EP.employerCompany')
        ->leftjoin('t_job as J',function($join1){
          $join1->on('J.jobId','=','AJ.jobId')
            ->where('J.deletedFlag',0);
        })
        ->leftjoin('t_employer_profile as EP',function($join2){
          $join2->on('EP.employerId','=','J.createdBy')
            ->where('EP.deletedFlag',0);
        })
        ->where([['AJ.deletedFlag',0],['candidateId',$candidateId]]);

        if($isViewAll==2){
          $jobStatus=$jobStatus->get();
        }elseif($isViewAll==1){
          $jobStatus=$jobStatus->paginate(TOTPAGINATE);
        } 
        
        $this->viewVars['jobStatus']     = $jobStatus;
        $this->viewVars['startrec']  = $isViewAll; 
       return view('candidate.jobStatus',$this->viewVars); 

    }

    public function jobpreview($jobId = 0){
      $jobId=decrypt($jobId);
      $jobData = JobModel::where('jobId',$jobId)
                  ->leftJoin("t_employer_profile", "t_employer_profile.employerId", "=", "t_job.createdBy")
                     ->first();

      $recentJobs = JobModel::where('deletedFlag',0)
                     ->where('createdBy',$jobData->employerId)
                     ->orderBy('createdOn','DESC')->get();
                      
      $candidateapplied = AppliedJobModel::where('deletedFlag',0)
                    ->where('jobId',$jobData->jobId)
                     ->count();

      $this->viewVars['jobData'] = $jobData;     
      $this->viewVars['recentJobs'] = $recentJobs;        
      $this->viewVars['candidateapplied'] = $candidateapplied; 
      //echo "<pre>";print_r($jobData);exit;
      return view('candidate.jobPreview',$this->viewVars);
    }
}
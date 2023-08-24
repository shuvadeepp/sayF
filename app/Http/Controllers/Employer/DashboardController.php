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

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\AppController;
use App\Models\AdminModel;
use App\Models\JobModel;
use App\Models\MessageModel;
use App\Models\MessageconvoModel;
use Session;
use Illuminate\Http\Request;
use App\Captcha\Securimage;
use Validator;
use DB;

class DashboardController extends AppController {
    public function index(){
      $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
      $arrResQuery = JobModel::select("t_job.*",
                  DB::raw("(SELECT count(1) FROM t_applied_job
                          WHERE t_applied_job.jobId = t_job.jobId
                        ) as candidateapplied"))
                  ->where('deletedFlag',0)
                  ->where('createdBy',session()->get('employer_session_data.userId'))
                  ->orderBy('createdOn','DESC');
      if($isViewAll==2){
        $arrResQuery=$arrResQuery->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
      } 
      $this->viewVars['startrec']  = $isViewAll; 
      $this->viewVars['arrAllRecords'] = $arrResQuery; 
       $employerId       = session('employer_session_data.userId');

     $this->viewVars['candidateappliedall']  =DB::select('SELECT COUNT(1) AS candidateapplied FROM t_applied_job a  left join t_job b on b.jobId=a.jobId WHERE b.createdBy= '.$employerId .' and a.deletedFlag =0');
     $this->viewVars['candidateappliedlast7days']  =DB::select('SELECT COUNT(1) AS candidatlast7days  FROM t_applied_job a  left join t_job b on b.jobId=a.jobId WHERE b.createdBy= '.$employerId .' and a.deletedFlag =0 and DATE(a.createdOn) > (NOW() - INTERVAL 7 DAY)');
     $this->viewVars['expiringlast7days']  =DB::select('SELECT COUNT(1) AS expiring7days FROM t_job WHERE job_status=1 and deletedFlag=0 and createdBy = '.$employerId .' and (current_date()>= date(jobStartDate) and current_date()<=date(jobExpiryDate)) and  DATE(jobExpiryDate) > (NOW() - INTERVAL 7 DAY)');
     $this->viewVars['JobViews']  =DB::select('SELECT sum(counter) as viewscounter  from t_job_details_counter a left join t_job b on b.jobId=a.jobId WHERE b.createdBy='.$employerId .' and  a.deletedFlag=0');
    $this->viewVars['JobViewsLast7days']  =DB::select('SELECT sum(counter) as viewscounter7days  from t_job_details_counter a left join t_job b on b.jobId=a.jobId WHERE a.deletedFlag=0 and b.createdBy='.$employerId .' and  DATE(a.createdOn) > (NOW() - INTERVAL 7 DAY)');
      $getMessageThread  = MessageModel::select('*')
                          ->where([['respOne',$employerId]])
                          ->orwhere([['respTwo',$employerId]])
                          ->where([['deletedFlag',0]])
                          ->orderBy('updatedOn','DESC')
                          ->get();
      $this->viewVars['getMessageThread'] = $getMessageThread;                             

      return view('employer.dashboard',$this->viewVars);
    }

    public function managejob(){
      return view('employer.managejob');
    }
    public function jobpreview(){
      return view('employer.jobpreview');
    }
    public function candidateapplied(){
      return view('employer.candidateapplied');
    }
    public function candidatedetails(){
      return view('employer.candidatedetails');
    }


   
}

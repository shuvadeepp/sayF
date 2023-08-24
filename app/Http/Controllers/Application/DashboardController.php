<?php

/* * ******************************************
  File Name     : LoginController.php
  Description   : Controller file for managing all the ajax requests of Website and employer and employee
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

namespace App\Http\Controllers\Application;

use App\Http\Controllers\AppController;
use App\Models\AdminModel;
use Session;
use Illuminate\Http\Request;
use App\Captcha\Securimage;
use Validator;
use DB;

use App\Models\DisabilityModel;
use App\Models\CandidateModel;
use App\Models\CandidateExperienceModel;
use App\Models\CandidateEducationModel;
use App\Models\CandidateSkillModel;

class DashboardController extends AppController {
    public function index(){  
      //echo '<pre>';   print_r(Session::all());exit;
      $this->viewVars['empjobseekerdata']  = DB::select('SELECT SUM(
                                                            CASE WHEN (tinUserType = 2 AND mobileVerifyFlag = 1 AND publishStatus = 1 AND deletedFlag = 0) THEN 1 ELSE 0 END
                                                          ) AS TOTALEMPLOYER,

                                                               SUM(
                                                              CASE WHEN (tinUserType = 3 AND emailVerifyFlag = 1 AND publishStatus = 1 AND deletedFlag = 0) THEN 1 ELSE 0 END   
                                                          ) AS TOTALJOBSEEKER

                                                            FROM m_user_master WHERE deletedFlag = 0');
      // echo'<pre>';print_r($this->viewVars['empjobseekerdata']);exit;
      $this->viewVars['noofjobs']          = DB::select('SELECT COUNT(1) AS NOOFJOBS FROM t_job WHERE job_status = 1 AND deletedFlag = 0');
      $this->viewVars['totalrecruit']      = DB::select('SELECT COUNT(1) AS TOTALRECRUITED FROM t_applied_job WHERE status = 1 AND deletedFlag = 0');
      $this->viewVars['top10job']          = DB::select('SELECT A.jobId,A.jobTitle,A.jobVacancy,COUNT(B.appliedJobId) AS TOTALAPPLIED,COUNT(C.appliedJobId) AS TOTALRECRUITED FROM t_job A LEFT JOIN t_applied_job B ON (A.jobId = B.jobId AND B.deletedFlag = 0) LEFT JOIN t_applied_job C ON (A.jobId = C.jobId AND C.status = 1 AND C.deletedFlag = 0) WHERE A.deletedFlag = 0 GROUP BY A.jobId,A.jobTitle,A.jobVacancy ORDER BY TOTALAPPLIED DESC,TOTALRECRUITED DESC LIMIT 10');
      $this->viewVars['top10emp']          = DB::select('SELECT A.userId,A.companyName,B.employerCompany, COUNT(C.jobId) AS TOTALJOBPOST, COALESCE(SUM(C.jobVacancy),0) AS TOTALVACANCIES,COUNT(D.appliedJobId) AS TOTALRECRUITED FROM m_user_master A LEFT JOIN t_employer_profile B ON (A.userId = B.employerId AND B.deletedFlag = 0) LEFT JOIN t_job C ON (A.userId = C.createdBy AND C.deletedFlag = 0) LEFT JOIN t_applied_job D ON (C.jobId = D.jobId AND D.status = 1 AND D.deletedFlag = 0) WHERE A.tinUserType = 2 AND A.publishStatus = 1 AND A.mobileVerifyFlag = 1 AND A.deletedFlag = 0 GROUP BY A.userId,A.companyName,B.employerCompany ORDER BY TOTALVACANCIES DESC, TOTALRECRUITED DESC LIMIT 10');

      //echo '<pre>';print_r($this->viewVars['empjobseekerdata']);exit;
      return view('application.dashboard',$this->viewVars);
    }

    public function viewTotalJobSeeker () {
      // echo $abc;exit;

    // $candidateId=decrypt($candidateId); 
    // echo $candidateId;exit;
    /*$jobSeekerData= DB::table('m_user_master as US')
      ->select('US.fullName','US.mobileNo','US.emailId','US.gender','US.DOB','DTL.*')
      ->leftjoin('t_candidate_details AS DTL','DTL.userId','=','US.userId','DTL.deletedFlag','=',0)
      ->where([['US.tinUserType',3],['US.deletedFlag',0],['US.publishStatus',1]]); */
      // $userList = json_decode(json_encode($userList), TRUE);
      
      $jobSeekerData = /* DB::table("m_user_master as um")
          ->Join("t_candidate_details as cd", function($join){
            $join->on("cd.userid", "=", "um.userid");
          })
          ->where("tinusertype", "=", 3)
          ->where("mobileverifyflag", "=", 1)
          ->where("publishstatus", "=", 1); */
          DB::table('m_user_master as US')
      ->select('US.fullName','US.mobileNo','US.emailId','US.gender','US.DOB','US.createdOn','DTL.*')
      ->leftjoin('t_candidate_details AS DTL','DTL.userId','=','US.userId','DTL.deletedFlag','=',0)
      ->where([['US.tinUserType',3],['US.deletedFlag',0],['US.publishStatus',1],['US.emailVerifyFlag',1]]);
          
          // echo'<pre>';print_r($jobSeekerData);exit;
      $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;    
    
      if($isViewAll==2){      
        $jobSeekerData=$jobSeekerData->get();
        // echo'<pre>';print_R($jobSeekerData);exit; 
      }elseif($isViewAll==1){
        $jobSeekerData=$jobSeekerData->paginate(TOTPAGINATE);       
      }
  
  
      $this->viewVars['userList'] = $jobSeekerData;
      $this->viewVars['startrec']  = $isViewAll;
          // echo'<pre>';print_R($this->viewVars);exit;
      return view('application.jobSeekersDetails', $this->viewVars);
    }

    public function viewTotalEmployees ($TotalRecruitedId = 0) {
      // echo 11111;exit;
      // echo $TotalRecruitedId;exit;
      // $TotalEmployeesId = decrypt($TotalEmployeesId);
      
      /* if ($TotalRecruitedId == 1) {
        $TotalEmployees = DB::table("m_user_master")
          ->where("tinusertype", "=", 2)
          ->where("mobileverifyflag", "=", 1)
          ->where("publishstatus", "=", 1);
      } else {
        $TotalEmployees = DB::table("t_applied_job")
          ->where("status", "=", 1)
          ->where("deletedflag", "=", 0);
      } */
      $TotalEmployees = DB::table("m_user_master")
        ->where("tinusertype", "=", 2)
        ->where("deletedFlag", "=", 0)
        // ->where("mobileverifyflag", "=", 1)
        /* ->where("publishstatus", "=", 1) */;
        // ->get();


        $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;    
    
      if($isViewAll==2){      
        $TotalEmployees=$TotalEmployees->get();
        // echo'<pre>';print_R($TotalEmployees);exit; 
      }elseif($isViewAll==1){
        $TotalEmployees=$TotalEmployees->paginate(TOTPAGINATE);       
      }
  
  
      $this->viewVars['userList'] = $TotalEmployees;
      $this->viewVars['startrec']  = $isViewAll;
        // echo'<pre>';print_r($TotalEmployees);exit;
      return view('application.totalEmployeesDetails', $this->viewVars);
    } 

    public function publishEmployee($param){
   
      try{
        $arrParams=json_decode(decrypt($param),true); 
        
        $intPublishStatus=0;
        if($arrParams['publishStatus']==1)
        {
          $intPublishStatus=0;
        }elseif($arrParams['publishStatus']==0)
        {
          $intPublishStatus=1;
        }
       
        $res=DB::select("update m_user_master SET publishStatus=$intPublishStatus WHERE userId='".$arrParams['user_id']."'");
        return redirect('application/Dashboard/viewTotalEmployees');
     }
     catch(Exception $e){
      echo "Something went wrong. Please try again";
     }

    }

    public function listEmployeesDetails($empId=''){

      $empId  = decrypt($empId);
      $skills = '';
	  $listEmpDetails = '';
      $listEmpDetails= DB::table("m_user_master as um")
      ->join("t_employer_profile as ep", function($join){
        $join->on("ep.employerid", "=", "um.userid");
      })
      ->join("m_location as loc", function($join){
        $join->on("loc.locationId", "=", "ep.employerlocation");
      })
      ->join("m_industrytype as it", function($join){
        $join->on("it.industryid", "=", "ep.employerindustry");
      })
      ->select("um.fullname", "um.emailid","um.address","um.gender", "um.dob", "um.phoneno", "ep.companylogo", "ep.employerdesignation", "ep.employercompany", "ep.employerwebsite", "loc.location", "ep.employersize", "ep.employerpannumber", "ep.employercompanyaddr", "ep.approvestatus", "ep.approvaltime", "ep.employerskills","it.industryName")
      ->where("um.tinusertype", "=", 2)
      ->where("um.mobileverifyflag", "=", 1)
      ->where("um.publishstatus", "=", 1)
      ->where("um.deletedflag", "=", 0)      
      ->where("um.userid", "=", $empId)
      ->get();
	// echo'<pre>';print_R($listEmpDetails);exit;
	$empDetails=json_decode(json_encode($listEmpDetails),true);  
	
     if(!empty($empDetails)){
		 
		  $this->viewVars['listEmpDetails'] = $listEmpDetails[0];
	 } else {
		  $this->viewVars['listEmpDetails'] = '';
	 }
      
	  if(!empty($empDetails)){
       $skillIds = explode("/",$empDetails[0]['employerskills']);
       
    if(!empty($skillIds)){
       $skillData= DB::table("m_skills")     
          ->select("skillName")
          ->whereIn("skillsId", $skillIds)->get();
      $skillData = json_decode(json_encode($skillData),true);
      
      if(empty($skillData)) {
        
      }else {;
        foreach($skillData as $skill){        
          $skillList[] = $skill['skillName'];        
        }      
      
        $skills = implode(', ', $skillList);     
      }
    }
	 
		
	}
	
	
     
      $this->viewVars['skills'] = $skills;
      //echo'<pre>';print_r($this->viewVars['skills']);exit;
      
      return view('application.listEmployeesDetails', $this->viewVars);
    }

    public function TotalRecruited() {
      // echo 1111;
      /*$TotalRecruitedQuery =  DB::table("t_applied_job")
      ->where("status", "=", 1)
      ->where("deletedflag", "=", 0); */

      $TotalRecruitedQuery = DB::table("t_applied_job as aj")
        ->leftJoin("t_candidate_details as cd", function($join){
          $join->on("cd.userid", "=", "aj.candidateid");
        })
        ->leftJoin("m_user_master as um", function($join){
          $join->on("um.userid", "=", "cd.userid");
        })
        ->leftJoin("t_job as tj", function($join){
          $join->on("tj.jobid", "=", "aj.jobid");
        })
        ->select("cd.userId","um.fullname", "tj.jobtitle", "aj.jobid", "aj.status")
        ->where("status", "=", 1);
        // ->get();
        // echo'<pre>';print_R($TotalRecruitedQuery);exit; 
      $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;    
    
      if($isViewAll==2){      
        $TotalRecruitedQuery=$TotalRecruitedQuery->get();
        // echo'<pre>';print_R($TotalRecruitedQuery);exit; 
      }elseif($isViewAll==1){
        $TotalRecruitedQuery=$TotalRecruitedQuery->paginate(TOTPAGINATE);       
      }
  
  
      $this->viewVars['userList'] = $TotalRecruitedQuery;
      $this->viewVars['startrec']  = $isViewAll;
      // echo'<pre>';print_R($this->viewVars['userList']);exit;
      return view('application.totalRecruitedDetails', $this->viewVars);
    }

    /* public function numOfJobList () {
      // echo 1111;exit;
      $numOfJobQuery = 
      // DB::table("t_job")
      //     ->where("job_status", "=", 1)
      //     ->where("deletedflag", "=", 0);
           

          // echo'<pre>';print_R($numOfJobQuery); exit;
          $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;    
    // $numOfJobQuery = strip_tags($numOfJobQuery);
    // echo'<pre>';print_r($numOfJobQuery, 1);exit;

      if($isViewAll==2){      
        $numOfJobQuery=$numOfJobQuery->get();
        // echo'<pre>';print_R($numOfJobQuery->count()); exit;
      }elseif($isViewAll==1){
        $numOfJobQuery=$numOfJobQuery->paginate(TOTPAGINATE);       
      }
          $this->viewVars['numOfJobQuery'] = $numOfJobQuery;
          $this->viewVars['startrec']  = $isViewAll;

      return view('application.numOfJobList', $this->viewVars);
    } */
   
}

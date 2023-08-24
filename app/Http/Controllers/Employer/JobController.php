<?php

/* * ******************************************
  File Name     : JobController.php
  Description   : Controller file for managing all job requests
  Created By    : Swagatika Sahoo
  Created On    : 14-Apr-2021

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
use App\Models\JobModel;
use App\Models\JobSkillModel;
use App\Models\JobLocationModel;
use App\Models\AppliedJobModel;
use App\Models\DisabilityModel;
use App\Models\JobIndustriesModel;
use App\Models\EmployerprofileModel;
use App\Models\JobDisabilityModel;
use App\Models\JobQualificationModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use DB;
use Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;

class JobController extends AppController {
    public function postjob($jobId = 0){     
    $empData  = EmployerprofileModel::where([['employerId', session()->get('employer_session_data.userId')]])->first();
    $empData=json_decode(json_encode($empData),true);
    // print_r( $empData);exit;
    if(empty($empData)){
      request()->session()->flash('error', 'Please update your company profile before posting a job.');
      return redirect('employer/employerprofile');
    }
      
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        if($jobId>0){
          $objJobModel = JobModel::find($jobId);
        }else{
          $objJobModel = new JobModel();
        }
        //echo '<pre>';print_r($requestData);exit;seldisable
        $validator   = \Validator::make($requestData, [
                          'jobTitle'               => 'bail|required|max:256',
                          'jobLocations'           => 'bail|required|max:128',
                          'selcity'               => 'bail|required|max:128',
                          'jobVacancy'             => 'bail|required|numeric',
                          'seldisable'               => 'bail|required|max:128',
                          'employmentTypeId'       => 'bail|required|numeric',
                          'jobDescription'         => 'bail|required',
                          'jobRoleResponsibilities'=> 'bail|required',
                          'jobSkills'              => 'bail|required',
                          'minExp'                 => 'bail|required|numeric',
                          'minSalary'              => 'bail|required|numeric',
                          'maxSalary'              => 'bail|required|numeric',
                          'industryId'             => 'bail|required',
                          'qualificationId'        => 'bail|required',
                          'companyDetails'         => 'bail|required',
                          'jobStartDate'           => 'bail|required|date',
                          'jobExpiryDate'          => 'bail|required|date|after:jobStartDate',
                        ], 
                        [
                          'jobTitle.required' => 'Job title is required',
                          'jobLocations.required' => 'Job State is required',
                          'selcity.required' => 'Job city is required',
                          'jobVacancy.required' => 'No. of vacancies is required',
                          'seldisable.required' => 'Job disabilty is required',
                          'employmentTypeId.required' => 'Choose type of employment',
                          'jobDescription.required' => 'Job description is required',
                          'jobRoleResponsibilities.required' => 'Roles & responsibilities is required',
                          'jobSkills.required' => 'Key skills is required',
                          'minExp.required' => 'Minimum work experience is required',
                          'minSalary.required' => 'Minimum salary range is required',
                          'maxSalary.required' => 'Maximum salary range is required',
                          'industryId.required' => 'Industry is required',
                          'qualificationId.required' => 'qualification is required',
                          'companyDetails.required' => 'Company Details is required',
                          'jobStartDate.required' => 'Job start date is required',
                          'jobExpiryDate.required' => 'Job expiry date is required',
                        ]);
        if ($validator->fails()) {
            return redirect('employer/Job/managejob')->withErrors($validator)->withInput();
        }else{
            $defaultJobStatus=1;
            $objJobModel->jobTitle                 = $requestData['jobTitle'];
            //$objJobModel->jobLocation              = $requestData['jobLocation'];
            $objJobModel->jobVacancy               = $requestData['jobVacancy'];
            $objJobModel->employmentTypeId         = $requestData['employmentTypeId'];
            $objJobModel->jobDescription           = htmlspecialchars($requestData['jobDescription'],ENT_QUOTES);
            $objJobModel->jobRoleResponsibilities  = htmlspecialchars($requestData['jobRoleResponsibilities'],ENT_QUOTES);
            //$objJobModel->jobSkills              = $requestData['jobSkills'];
            $objJobModel->minExp                   = $requestData['minExp'];
            $objJobModel->minSalary                = $requestData['minSalary'];
            $objJobModel->maxSalary                = $requestData['maxSalary'];
            //$objJobModel->industryId             = $requestData['industryId'];
            //$objJobModel->qualificationId          = $requestData['qualificationId'];
            $objJobModel->jobStartDate             = (strtotime($requestData['jobStartDate'])>0)?date("Y-m-d",strtotime($requestData['jobStartDate'])):'';
            $objJobModel->jobExpiryDate            = (strtotime($requestData['jobExpiryDate'])>0)?date("Y-m-d",strtotime($requestData['jobExpiryDate'])):'';
            $objJobModel->companyDetails           = htmlspecialchars($requestData['companyDetails'],ENT_QUOTES);
            $objJobModel->job_status = $defaultJobStatus;
            if($jobId>0){
              // if(strtotime($requestData['jobExpiryDate'])>strtotime(date("Y-m-d")) && (date("Y-m-d",strtotime($requestData['jobExpiryDate'])) != $objJobModel->jobExpiryDate)){
              //   $objJobModel->readStatus           = 0;
              // }
              $objJobModel->updatedBy              = session()->get('employer_session_data.userId');
              $objJobModel->updatedOn              = date("Y-m-d H:i:s");
            }else{
              $objJobModel->createdBy              = session()->get('employer_session_data.userId');
              $objJobModel->createdOn              = date("Y-m-d H:i:s");
            }
            if($objJobModel->save()){

              if($jobId>0){
                $lastInsertedId = $jobId;
              }else{
                $lastInsertedId = $objJobModel->jobId; //exit;
              }

              if(!empty($requestData['jobSkills'])){

                if($jobId>0){
                  DB::table('t_jobskills')->where('jobId', $jobId)->delete();
                }
                $jobSkills = explode('/', $requestData['jobSkills']);


              //  $empSkill = EmployerprofileModel::where([['employerId',session()->get('employer_session_data.userId')]])->first();
	
              //  $empSkillToAdd = $empSkill->employerSkills;              

              //  foreach ($jobSkills as $jskey => $jsval){

              //    if(!empty($empSkill->employerSkills)){
              //      $empSkillArr = explode('/', $empSkill->employerSkills);
              //      if(!in_array($jsval,$empSkillArr)){
              //        $empSkillToAdd .= '/'.$jsval;
              //      }
              //    } 
		        $empSkillToAdd='';
                $empSkill = EmployerprofileModel::where([['employerId',session()->get('employer_session_data.userId')]])->first();
               
                if(!empty($empSkill)){
               		 $empSkillToAdd = $empSkill->employerSkills;
                }

	            foreach ($jobSkills as $jskey => $jsval){

                  if(!empty($empSkill->employerSkills)){
                    $empSkillArr = explode('/', $empSkill->employerSkills);
                    if(!in_array($jsval,$empSkillArr)){
                      $empSkillToAdd .= '/'.$jsval;
                    }
                  } else {
                    $empSkillToAdd .= '/'.$jsval;
                  }

                  $objJobSkillModel = new JobSkillModel();
                  $objJobSkillModel->jobId      = $lastInsertedId;
                  $objJobSkillModel->skillId    = $jsval;
                  $objJobSkillModel->createdBy  = session()->get('employer_session_data.userId');
                  $objJobSkillModel->createdOn  = date("Y-m-d H:i:s");
                  $objJobSkillModel->save();
                  
                }

                if($empSkill != $empSkillToAdd){
                  //echo $empSkillToAdd;exit;
                  DB::table('t_employer_profile')->where('employerId', session()->get('employer_session_data.userId'))->update(array('employerSkills' => $empSkillToAdd));
                }

              }

              if(!empty($requestData['jobLocations'])){
                if($jobId>0){
                  DB::table('t_job_location')->where('jobId', $jobId)->delete();
                }
                foreach ($requestData['jobLocations'] as $lkey => $lval){
                  // echo"<pre>";print_r($requestData);exit;
                  $objJobLocationModel = new JobLocationModel();
                  $objJobLocationModel->jobId      = $lastInsertedId;
                  $objJobLocationModel->locationId = $lval;
                  $objJobLocationModel->cityId = $requestData['selcity'];
                  $objJobLocationModel->createdBy  = session()->get('employer_session_data.userId');
                  $objJobLocationModel->createdOn  = date("Y-m-d H:i:s");
                  $objJobLocationModel->save();
                }
              }

              if(!empty($requestData['industryId'])){
                if($jobId>0){
                  DB::table('t_job_industries')->where('jobId', $jobId)->delete();
                }
                foreach ($requestData['industryId'] as $ikey => $ival){
                  $objJobIndustriesModel = new JobIndustriesModel();
                  $objJobIndustriesModel->jobId      = $lastInsertedId;
                  $objJobIndustriesModel->industryId = $ival;
                  $objJobIndustriesModel->createdBy  = session()->get('employer_session_data.userId');
                  $objJobIndustriesModel->createdOn  = date("Y-m-d H:i:s");
                  $objJobIndustriesModel->save();
                }
              }

              // disability:
              if(!empty($requestData['seldisable'])){
                if($jobId>0){
                  DB::table('t_job_disable')->where('jobId', $jobId)->delete();
                }
                foreach ($requestData['seldisable'] as $lkey => $dval){
                  // echo"<pre>";print_r($requestData);exit;
                  $objJobDisabilityModel = new JobDisabilityModel();
                  $objJobDisabilityModel->jobId          = $lastInsertedId;
                  $objJobDisabilityModel->disabilityType = $dval;
                  // $objJobDisabilityModel->deletedFlag    = 1;
                  $objJobDisabilityModel->createdBy      = session()->get('employer_session_data.userId');
                  $objJobDisabilityModel->createdOn      = date('Y-m-d H:i:s');
                  $objJobDisabilityModel->updatedOn      = date('Y-m-d H:i:s');
                  $objJobDisabilityModel->updatedBy      = session()->get('employer_session_data.userId');
                  $objJobDisabilityModel->save();
                }
              }

              // Minimum Education Qualification:
              if(!empty($requestData['qualificationId'])){ 
                if($jobId>0){
                  DB::table('t_job_minEdu_Quealification')->where('jobId', $jobId)->delete();
                }
                foreach ($requestData['qualificationId'] as $Qkey => $Qval){
                  $objJobQualificationModel = new JobQualificationModel();
                  $objJobQualificationModel->jobId          = $lastInsertedId;
                  $objJobQualificationModel->qualificationType = $Qval;
                  // $objJobQualificationModel->deletedFlag    = 1;
                  $objJobQualificationModel->createdBy      = session()->get('employer_session_data.userId');
                  $objJobQualificationModel->updated_at      = date('Y-m-d H:i:s');
                  $objJobQualificationModel->created_at      = date('Y-m-d H:i:s');
                  $objJobQualificationModel->updatedBy      = session()->get('employer_session_data.userId');
                  $objJobQualificationModel->save();
                }
              }

              if($jobId>0){
                request()->session()->flash('success', 'Job updated successfully');
              }else{
                /********* Send Notification to Employer *********/
                $notificationDesc = 'You have successfully posted a new job - '.$requestData['jobTitle'];
                $notificationType = 1;
                $notificationFrom = session()->get('employer_session_data.userId');
                $notificationTo   = session()->get('employer_session_data.userId');
                $notifycommonId   = $lastInsertedId;
                sendNotification($notificationDesc,$notificationType,$notificationFrom,$notificationTo,$notifycommonId);
                /********* Send Notification to Employer *********/
                request()->session()->flash('success', 'Job added successfully');
              }
              return redirect('employer/Job/managejob');

            }else{
              request()->session()->flash('error', 'Sorry!!! something went wrong');
              return redirect('employer/Job/postjob');
            }

        }
      }

      $location  = DB::table('m_location')
                ->select('stateId','state')
                ->where('deletedflag',0)
                ->orderBy('state','ASC')
                ->groupBy('stateId','state')
                ->get();
                
      $jobtypes  = DB::table('m_jobtype')
                ->select('jobtypeId','jobtypeName')
                ->where([['publishStatus',0],['deletedflag',0]])
                ->orderBy('jobtypeName','ASC')
                ->get();

      $skills  = DB::table('m_skills')
                ->select('skillsId','skillName')
                ->where([['publishStatus',0],['deletedflag',0]])
                ->orderBy('skillName','ASC')
                ->get();

      $industries = DB::table('m_industrytype')
                  ->select('industryId','industryName')
                  ->where([['publishStatus',0],['deletedflag',0]])
                  ->orderBy('industryName','ASC')
                  ->get(); 

      $qualifications  = DB::table('m_qualification')
                ->select('qualificationId','qualification')
                ->where([['publishStatus',0],['deletedflag',0]])
                ->orderBy('qualification','ASC')
                ->get();

      $disablity = DB::table('m_disabilitytype')
                    ->select('disabilityId','disabilityName')
                    ->where([['deletedflag',0]])
                    ->get();
      
      if($jobId > 0){
        $jobData = JobModel::where('deletedFlag',0)
                    ->where('jobId',$jobId)
                    ->first();
        // echo "<pre>";print_r($jobData);exit;
        $this->viewVars['jobData']           = $jobData;
        $this->viewVars['strSubmit']         = 'Update Job';
      }else{
        $this->viewVars['strSubmit']         = 'Post Job';        
      }

      $this->viewVars['location']         = $location;
      $this->viewVars['jobtypes']         = $jobtypes;
      $this->viewVars['skills']           = $skills;
      $this->viewVars['industries']       = $industries;
      $this->viewVars['qualifications']   = $qualifications;
      $this->viewVars['disablity']        = $disablity;
      /* Employer profile approval condition */
      $this->viewVars['approveStatus'] =$empData['approveStatus'];
      $this->viewVars['approvalTime'] =$empData['approvalTime'];

     // $employerApprovalDate=(!empty($existingProfile->approvalTime))?$existingProfile->approvalTime:'';
     /* $timeDifference='';
     if(!empty($empData['approvalTime'])){
      $secondsDifference= strtotime(date('Y-m-d H:i:s'))-strtotime($empData['approvalTime']);
      $timeDifference =intval($secondsDifference/60);     
     } 
    
      if($empData['approveStatus'] == 0 && $timeDifference <= 0){
        request()->session()->flash('error', 'Your profile has not been approved to Post a job.');
      } elseif($empData['approveStatus'] == 0 && $timeDifference < 2880){
        request()->session()->flash('error', 'Your profile is pending for approval to Post a job.');
      } elseif($empData['approveStatus'] == 2){
        request()->session()->flash('error', 'Your profile is being rejected to Post a job.');
      }   */ 
      return view('employer.postjob',$this->viewVars);       
    }

    public function managejob($status = ''){   

      $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;

      $arrResQuery = JobModel::select("t_job.*",
                  DB::raw("(SELECT count(1) FROM t_applied_job
                          WHERE t_applied_job.jobId = t_job.jobId
                        ) as candidateapplied"))
                  ->where('deletedFlag',0)
                  ->where('createdBy',session()->get('employer_session_data.userId'));
      if($status == 'active'){
        $arrResQuery = $arrResQuery->where('jobStartDate','<=',date("Y-m-d"));
        $arrResQuery = $arrResQuery->where('jobExpiryDate','>=',date("Y-m-d"));
        $arrResQuery = $arrResQuery->where('job_status',1);
      }else if($status == 'expired'){
        $arrResQuery = $arrResQuery->where('jobExpiryDate','<',date("Y-m-d"));
        $arrResQuery = $arrResQuery->where('job_status',1);
      }

      $arrResQuery = $arrResQuery->orderBy('createdOn','DESC');

      $archivedJobCount = JobModel::where('deletedFlag',1)
       ->where('createdBy',session()->get('employer_session_data.userId'))
       ->count();

      $activeJobCount = JobModel::where('deletedFlag',0)
       ->where('createdBy',session()->get('employer_session_data.userId'))
       ->where('jobStartDate','<=',date("Y-m-d"))
       ->where('jobExpiryDate','>=',date("Y-m-d"))
       ->where('job_status',1)
       ->count();

      $expiredJobCount =  JobModel::where('deletedFlag',0)
       ->where('createdBy',session()->get('employer_session_data.userId'))
       ->where('jobExpiryDate','<',date("Y-m-d"))
       ->where('job_status',1)
       ->count();


      if($isViewAll==2){
          $arrResQuery=$arrResQuery->get();
        }elseif($isViewAll==1){
          $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
        } 

      $this->viewVars['status']  = $status; 
      $this->viewVars['archivedJobCount']  = $archivedJobCount; 
      $this->viewVars['activeJobCount']   = $activeJobCount; 
      $this->viewVars['expiredJobCount']  = $expiredJobCount; 
      $this->viewVars['startrec']  = $isViewAll; 
      $this->viewVars['arrAllRecords'] = $arrResQuery;     
      return view('employer.managejob',$this->viewVars);
    }

    public function jobpreview($jobId = 0){
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all(); 
        //echo '<pre>';print_r($requestData);exit;
        //$jobId = $requestData['jobId'];
        $objJobModel = JobModel::find($jobId);
        $objJobModel->deletedFlag = 1;
        if($objJobModel->save()){
          return redirect('employer/job/archivejob');
        }
      }
      $jobData = JobModel::where('jobId',$jobId)
                     ->first();
      $recentJobs = JobModel::where('deletedFlag',0)
                     ->where('createdBy',session()->get('employer_session_data.userId'))
                     ->orderBy('createdOn','DESC')->get();
                      
      $candidateapplied = AppliedJobModel::where('deletedFlag',0)
                    ->where('jobId',$jobData->jobId)
                     ->count();

      $this->viewVars['jobData'] = $jobData;     
      $this->viewVars['recentJobs'] = $recentJobs;        
      $this->viewVars['candidateapplied'] = $candidateapplied;
      //  echo "<pre>";print_r($jobData->jobqualification[0]->jobminEduQual->qualification);exit;
      return view('employer.jobpreview',$this->viewVars);
    }

    public function archivejob(){
      $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
      $arrResQuery = JobModel::where([['deletedFlag',1]])
                     ->where('createdBy',session()->get('employer_session_data.userId'))
                     ->orderBy('createdOn','DESC');
      
      if($isViewAll==2){
          $arrResQuery=$arrResQuery->get();
        }elseif($isViewAll==1){
          $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
        } 

      $this->viewVars['startrec']  = $isViewAll; 
      $this->viewVars['arrAllRecords'] = $arrResQuery;     
      return view('employer.archivejob',$this->viewVars);
    }

    public function candidateapplied($jobId = 0){
      if(!empty(request()->all()) && request()->isMethod('post')) {

        $requestData = request()->all(); 
        // echo'<pre>';print_r($requestData['chkSign']);exit;
        if($requestData['hdnAction'] == 'shortlist'){
          DB::table('t_applied_job')->whereIn('appliedJobId', $requestData['chkItem'])->update(array('status' => 1));

          if(!empty($requestData['chkItem'])){
            foreach ($requestData['chkItem'] as $key => $value) {
              $jobData = AppliedJobModel::find($value);
              /********* Send Notification to Candidate *********/
              $notificationDesc = 'Congratulations! You were shortlisted for the job of '.$jobData->jobdetail->jobTitle;
              $notificationType = 7; 
              $notificationFrom = $jobData->jobdetail->createdBy;
              $notificationTo   = $jobData->candidateId;
              $notifycommonId  = $jobData->jobId;
              sendNotification($notificationDesc,$notificationType,$notificationFrom,$notificationTo,$notifycommonId);
              /********* Send Notification to Candidate *********/
            }
          }

        }else if($requestData['hdnAction'] == 'onhold'){
          DB::table('t_applied_job')->whereIn('appliedJobId', $requestData['chkItem'])->update(array('status' => 2));
        }else if($requestData['hdnAction'] == 'reject'){
           DB::table('t_applied_job')->whereIn('appliedJobId', $requestData['chkItem'])->update(array('status' => 4));

           if(!empty($requestData['chkItem'])){
            foreach ($requestData['chkItem'] as $key => $value) {
              $jobData = AppliedJobModel::find($value);              
              /********* Send Notification to Candidate *********/
              $notificationDesc = 'We regret to inform you that you were not shortlisted for '.$jobData->jobdetail->jobTitle;
              $notificationType = 8; 
              $notificationFrom = $jobData->jobdetail->createdBy;
              $notificationTo   = $jobData->candidateId;
              $notifycommonId  = $jobData->jobId;
              sendNotification($notificationDesc,$notificationType,$notificationFrom,$notificationTo,$notifycommonId);            
              /********* Send Notification to Candidate *********/
            }
          }

        }

        

        // request()->session()->flash('success', 'Status updated successfully');

      }

      $jobData    = JobModel::where('jobId',$jobId)->first();

      // ! Added in candidateapplied page Filter Sign Medium checkbox for filtering. (21-06-2023) 

      if(!empty(request('filterSign') == 1) && request()->isMethod('post')) {
      
        $requestData = Request()->all();
      
        $appliedJob = DB::table("t_applied_job as AJ")
                  ->join("m_user_master as UM", function($join){
                    $join->on("AJ.candidateId", "=", "UM.userId");
                  })
                  ->join("t_candidate_details as CD", function($join){
                    $join->on("CD.employeeId", "=", "UM.userId");
                  })
                  ->select("AJ.*", "UM.*", "CD.*")
                  ->where("AJ.jobId", "=", $jobId)
                  ->where("AJ.deletedFlag", "=", 0)
                  ->orderBy('AJ.appliedJobId','DESC')
                  ->get();
                  
                  $this->viewVars['appliedJob']       = $appliedJob;
                  $this->viewVars['filterData']       = $requestData['filterSign'];
                  // print_r($this->viewVars['appliedJob']);exit;

      } else {
        
        $this->viewVars['filterData'] = 0;
        $appliedJob = AppliedJobModel::where('deletedFlag',0)
                    ->where('jobId',$jobId)
                    ->get();
                    
        $this->viewVars['appliedJob']       = $appliedJob;
      }
      
      $this->viewVars['jobData']          = $jobData;       

      // ! END.

      return view('employer.candidateapplied', $this->viewVars);
    }

    public function candidatedetails($appliedJobId = 0){
      $jobData  = AppliedJobModel::where('appliedJobId',$appliedJobId)
                    ->first(); 
      $candidateapplied = AppliedJobModel::where('deletedFlag',0)
                    ->where('jobId',$jobData->jobId)
                     ->count();
                     
      $disablityTypes = DisabilityModel::whereIn('disabilityId',explode(',', $jobData->candidatedetail->disablityType))
                     ->get();
                    //  echo"<pre>";print_r($jobData);exit;
      $this->viewVars['jobData'] = $jobData;        
      $this->viewVars['candidateapplied'] = $candidateapplied;        
      $this->viewVars['disablityTypes'] = $disablityTypes;        
      return view('employer.candidatedetails',$this->viewVars);
    }
    public function download () {
      // echo 111;exit;
      $empDownload = DB::table('m_user_master as US')
      ->select('US.fullName','US.mobileNo','US.emailId','US.gender','US.DOB','DTL.*')
      ->leftjoin('t_candidate_details AS DTL','DTL.userId','=','US.userId','DTL.deletedFlag','=',0)
      ->where([['US.tinUserType',3],['US.deletedFlag',0]])->get();
      // echo '<pre>';print_r($empDownload);exit;

      $this->viewVars['empDownload'] = $empDownload;

      return view('employer.candidatedetails',$this->viewVars);
    }
}
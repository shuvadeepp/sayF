<?php

/* * ******************************************
  File Name     : AjaxController.php
  Description   : Controller file for managing all the ajax requests of Website and employer and employee
  Created By    : Ananya Dash
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

namespace App\Http\Controllers\Website;

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Mail;
use Session;
use DB;
use App\Models\CategoryModel;
use App\Models\JobTypeModel;
use App\Models\SkillModel;
use App\Models\LocationModel;
use App\Models\JobModel;
use App\Models\AppliedJobModel;
use App\Models\BookmarkedModel;
use App\Models\EmployerprofileModel;
use App\Models\JobDetailsCounterModel;
use App\Models\JobDisabilityModel;
use App\Models\DisabilityModel;
use App\Models\BannerModel;




class JobsearchController extends AppController {
  function index() {
  	$this->viewVars['arrCategoryRec']='';
  	$this->viewVars['arrJobtypeRec']='';
  	$this->viewVars['arrSkillRec']='';
    $this->viewVars['arrResLocation']='';
    $this->viewVars['arrDisableRec']='';
  	$arrResQueryCategory=CategoryModel::where([['deletedflag',0]])->get();
  	if(!empty($arrResQueryCategory)){
  		$this->viewVars['arrCategoryRec'] = $arrResQueryCategory;
  	}
  	 $arrResQueryJobType = JobTypeModel::where([['deletedflag', 0]])->get();
  	 if(!empty($arrResQueryJobType))
  	{
  		$this->viewVars['arrJobtypeRec'] = $arrResQueryJobType;
  	}
  	$arrResQuerySkill=SkillModel::where([['deletedflag',0]])->get();
  	 if(!empty($arrResQuerySkill))
  	{
  		$this->viewVars['arrSkillRec'] = $arrResQuerySkill;
  	}

    $arrResQueryDiasability=DisabilityModel::where([['deletedflag',0]])->get();
   // echo '<pre>';print_r($arrResQueryDiasability);exit;
    if(!empty($arrResQueryDiasability))
   {
     $this->viewVars['arrDisableRec'] = $arrResQueryDiasability;
   }
    
   // $arrResQueryLocation=LocationModel::where([['deletedFlag',0]])->get();
       $arrResQueryLocation  = DB::table('m_location')
                ->select('stateId','state')
                ->where('deletedflag',0)
                ->orderBy('state','ASC')
                ->groupBy('stateId','state')
                ->get();
     if(!empty($arrResQueryLocation))
    {
      $this->viewVars['arrResLocation'] = $arrResQueryLocation;
    }

  	 $data   = DB::table('t_job as A')
              ->select('A.jobId','A.jobTitle','A.jobLocation','A.jobVacancy','A.employmentTypeId','A.jobDescription','A.jobRoleResponsibilities','A.minExp','A.minSalary','A.maxSalary','A.industryId','A.qualificationId','A.companyDetails','A.createdOn','B.jobtypeName','C.industryName','D.qualification','E.employerCompany','E.companyLogo','H.liked',
                    DB::raw('group_concat(distinct(G.skillName)) as skillName'),
                     DB::raw('group_concat(distinct(G.skillsId)) as skillsId'),
                     DB::raw('group_concat(distinct(J.state)) as location'),
                     DB::raw('group_concat(distinct(L.location)) as city'),
                     DB::raw('group_concat(distinct(DT.disabilityName)) as disabilityName'),
                     DB::raw('group_concat(distinct(DT.disabilityId)) as disabilityId')
                )
              ->leftjoin('m_jobtype AS B','A.employmentTypeId','=','B.jobtypeId','B.deletedflag','=',0)
              ->leftjoin('m_industrytype AS C','A.industryId','=','C.industryId','C.deletedflag','=',0)
              ->leftjoin('m_qualification AS D','A.qualificationId','=','D.qualificationId','D.deletedflag','=',0)
              ->leftjoin('t_employer_profile AS E','A.createdBy','=','E.employerId','D.deletedflag','=',0)
              ->leftjoin('t_jobskills AS F','F.jobId','=','A.jobId','F.deletedFlag','=',0)
              ->leftjoin('m_skills AS G','G.skillsId','=','F.skillId','G.deletedFlag','=',0)
             ->leftjoin('t_bookmarked AS H','H.jobId','=','A.jobId','H.candidateUserId','=','A.createdBy')
             ->leftjoin('t_job_location AS I','I.jobId','=','A.jobId','I.deletedFlag','=',0)
             ->leftjoin('m_location AS J','J.stateId','=','I.locationId','J.deletedFlag','=',0)
              ->leftjoin('m_location AS L','L.locationId','=','I.cityId','L.deletedFlag','=',0)
              // ->leftjoin('t_applied_job AS K','K.jobId','=','A.jobId','K.candidateId','=','A.createdBy')
              ->leftjoin('t_job_disable AS JD','JD.jobId','=','A.jobId','JD.deletedFlag','=',0)              
               ->leftjoin('m_disabilitytype AS DT','DT.disabilityId','=','JD.disabilityType','DT.deletedflag','=',0)
             // ->leftjoin('t_job_disable AS JD','K.jobId','=','A.jobId','K.candidateId','=','A.createdBy')

              ->groupBy('A.jobId','A.jobTitle','A.jobLocation','A.jobVacancy','A.employmentTypeId','A.jobDescription','A.jobRoleResponsibilities','A.minExp','A.minSalary','A.maxSalary','A.industryId','A.qualificationId','A.companyDetails','A.createdOn','B.jobtypeName','C.industryName','D.qualification','E.employerCompany','E.companyLogo','H.liked')
               ->where([['A.deletedFlag',0],['A.job_status',1]]);
              // ->where('A.deletedFlag', '=', '0')
              //  ->where('A.job_status', '=', '1');              
    // echo '<pre>';print_r($data->get());exit;
          $data=$data->paginate(15);

          /* Functionality for relevant category filter
            Sangita Pratap 30-Mar-2022 */
          $candidateid='';         
          if(!empty(SESSION('candidate_session_data.userId'))){
            $candidateid=SESSION('candidate_session_data.userId');
            // echo $candidateid;exit;
             //Personal Information
             $personalInfo=DB::table('t_candidate_details')
             ->select('userId','firstName','lastName','address','city','state','disablityType','disabilitySubType','disabilityPercentage','disabilityCertificateNo')
             ->where([['userId',$candidateid],['deletedFlag',0]])->first();
            //  echo '<pre>';print_r($personalInfo);exit;

            $jobIdsQuery  = DB::table('t_applied_job')->select('jobId')->where([['deletedFlag',0], ['candidateId', $candidateid]])->get();

            $jobIdsArr  = json_decode(json_encode($jobIdsQuery), true);
            $jobIdsVals = array_column($jobIdsArr, 'jobId');

            // echo '<pre>';print_r($jobIdsVals);exit;

            $this->viewVars['userPersonalInfo']     = $personalInfo;
            $this->viewVars['jobIdsVals']           = $jobIdsVals;
             //  Skill details 
             $skillDetls=DB::table('t_candidate_skill as S')
             ->select('S.skillId','S.skillName','S.experienceYear','S.skillCertificate','SK.skillName as skillnames')
             ->leftjoin('m_skills as SK',function($join1){
               $join1->on('SK.skillsId','=','S.skillName');
             })
             ->where([['S.userId',$candidateid],['S.deletedFlag',0]])->get()->toArray(); 
             
              //Work Experience
              $workDetls=DB::table('t_candidate_experience')
              ->select('designation','companyName','startYear','endYear','currentJob')
              ->where([['userId',$candidateid],['deletedFlag',0]])->get();            

              $totalExp=calcTotalExp($workDetls);
              $totalExp= explode(',', $totalExp);
              $totalExp=(abs($totalExp[0]));
              $this->viewVars['totalExp']=$totalExp;
              $skillArr=array();
             foreach($skillDetls as $skillDetlsObj)
             {
              // $skillArr[] = (array) $skillDetlsObj;
               $skillArr[]=$skillDetlsObj;
             }          
             $this->viewVars['userSkillDetls']=$skillArr;           
          }
          $this->viewVars['candidateid']=$candidateid;

          $pageType ='12';
    $bannerList=BannerModel::where([['deletedflag',0],['publishStatus',0],['pageType',$pageType]])->orderBy('bannerId','ASC')->get();
    $this->viewVars['banners']  = $bannerList;    
        // echo "<pre>";print_r($this->viewVars);exit;
     return view('website.job-search', compact('data'),$this->viewVars);
  }
   public function jobdetails($jobTitle, $jobId = 0){

            $jobId=decrypt($jobId);
            $candidateid=SESSION('candidate_session_data.userId');

            $date=date('Y-m-d');
             $cookie_name = 'cookies_'.$candidateid.'_'.$jobId.'_'.$date;
              // setcookie($cookie_name,'');exit;
              if (!isset($_COOKIE[$cookie_name])){
                 $tocount = JobDetailsCounterModel::select("t_job_details_counter.*")
                          ->whereDate('createdOn',$date)
                          ->where('jobId', '=',$jobId )
                          ->get()->toArray();
                  if(empty($tocount)){
                    setcookie($cookie_name,'1');
                    $counter=1;
                    $JobDetailsCounterModel = new JobDetailsCounterModel();
                    $JobDetailsCounterModel->jobId = $jobId;
                    $JobDetailsCounterModel->counter =$counter;                                              
                    $JobDetailsCounterModel->save();
                  }else{
                     if (!isset($_COOKIE[$cookie_name])){
                          setcookie($cookie_name,'1');
                          JobDetailsCounterModel::where([['jobId',$jobId]])
                          ->update([
                            'counter' => DB::raw('counter+1')
                          ]);
                      }
                  }
              }
              else{
              $tocount = JobDetailsCounterModel::select("t_job_details_counter.*")
                          ->whereDate('createdOn',$date)
                          ->where('jobId', '=',$jobId )
                          ->get()->toArray();
              if(!empty($tocount)){
                 if (!isset($_COOKIE[$cookie_name])){
                      JobDetailsCounterModel::where([['jobId',$jobId]])
                        ->update([
                            'counter' => DB::raw('counter+1')
                        ]);
                  }
                 }
              }

            if(!empty(request()->all()) && request()->isMethod('post')) {
              $requestData = request()->all(); 
              $objJobModel = JobModel::find($jobId);
              $objJobModel->deletedFlag = 1;
              if($objJobModel->save()){
                return redirect('employer/job/archivejob');
              }
            }
            $jobData = JobModel::where('jobId',$jobId)
                           ->first();
             $appliedjob=AppliedJobModel::where([['jobId',$jobId],['candidateId',$candidateid],['deletedFlag',0]])->first();
             $Bookmarked=BookmarkedModel::where([['jobId',$jobId],['candidateUserId',$candidateid],['liked',1]])->first();
             $Employerprofile=EmployerprofileModel::where([['employerId',$jobData->createdBy],['deletedFlag',0]])->first();
            $recentJobs = JobModel::where([['job_status',1],['deletedFlag',0]])
                      ->whereNotIn('jobId', [$jobId])
                           ->get();
            $this->viewVars['jobData'] = $jobData;     
            $this->viewVars['recentJobs'] = $recentJobs;
            $this->viewVars['appliedjob'] = $appliedjob;
            $this->viewVars['Bookmarked'] = $Bookmarked;
            $this->viewVars['Employerprofile'] = $Employerprofile;
            /* For banner */
            $pageType ='16';
            $bannerList=BannerModel::where([['deletedflag',0],['publishStatus',0],['pageType',$pageType]])->orderBy('bannerId','ASC')->get();
            $this->viewVars['banners']  = $bannerList;  
            return view('website.jobdetails',$this->viewVars);
          }
}
?>
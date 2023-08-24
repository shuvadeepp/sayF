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
use App\Models\BookmarkedModel;
use Validator;
use App\Captcha\Securimage;
use App\Models\AdminModel;
use App\Models\AppliedJobModel;
use App\Models\JobModel;
use App\Models\MessageconvoModel;
use App\Models\NotificationModel;
use App\Models\CountryModel;
use App\Models\GalleryModel;
use App\Models\EmployerprofileModel;
use Google\Service\Directory\Printer;

class AjaxController extends AppController {
function jobsearch(){
if(request()->ajax()){
 // print_r(request('selDisablityType')); exit;
        $arrResQuery=DB::table('t_job as A')
            ->select('A.jobId','A.jobTitle','A.jobLocation','A.jobVacancy','A.employmentTypeId','A.jobDescription','A.jobRoleResponsibilities','A.minExp','A.minSalary','A.maxSalary','A.industryId','A.qualificationId','A.companyDetails','A.createdOn','B.jobtypeName','C.industryName','D.qualification','E.employerCompany','E.companyLogo','H.liked','K.appliedJobId',
              DB::raw('group_concat(distinct(G.skillName)) as skillName'),
              DB::raw('group_concat(distinct(G.skillsId)) as skillsId'),
              DB::raw('group_concat(distinct(J.state)) as location'),
             DB::raw('group_concat(distinct(L.location)) as city'),
              DB::raw('group_concat(distinct(J.stateId)) as locationIds'),
                DB::raw('group_concat(distinct(L.locationId)) as cityids')
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
             ->leftjoin('t_applied_job AS K','K.jobId','=','A.jobId','K.candidateId','=','A.createdBy')
             ->leftjoin('t_job_disable AS JD','JD.jobId','=','A.jobId','JD.deletedFlag','=',0)
            ->groupBy('A.jobId','A.jobTitle','A.jobLocation','A.jobVacancy','A.employmentTypeId','A.jobDescription','A.jobRoleResponsibilities','A.minExp','A.minSalary','A.maxSalary','A.industryId','A.qualificationId','A.companyDetails','A.createdOn','B.jobtypeName','C.industryName','D.qualification','E.employerCompany','E.companyLogo','H.liked','K.appliedJobId')
            // ->where('A.deletedFlag', '=', '0')
            //   ->where('A.job_status', '=', '1');
             ->where([['A.deletedFlag',0],['A.job_status',1]]);

   
       
            if(!empty(request('selJobValues'))){
                 $arrResQuery = $arrResQuery->whereIn('A.employmentTypeId', request('selJobValues'));
            }if(!empty(request('selExperiencevals'))){
            
              foreach(request('selExperiencevals') as $key=>$value)
              {
                $arr=explode(',',$value);
                if($key==0){
                   $arrResQuery=$arrResQuery->whereBetween('A.minExp',$arr);
                   }else{
                   $arrResQuery=$arrResQuery->orWhereBetween('A.minExp',$arr);
                   }
              }
            }if(!empty(request('skillTypes'))){
           //  print_r(request('skillTypes'));exit;
             $arrResQuery = $arrResQuery->whereIn('skillsId',request('skillTypes'));
            }if(!empty(request('joblocation'))){
             $arrResQuery = $arrResQuery->whereIn('J.stateId', request('joblocation'));
            }
            if(!empty(request('city'))){         
             $arrResQuery = $arrResQuery->whereIn('L.locationId', request('city'));
            }
            if(!empty(request('selDisablityType'))){             
              $arrResQuery = $arrResQuery->whereIn('JD.disabilityType', request('selDisablityType'));
         }
            
            if(!empty(request('sel')) && request('sel')==1){
              $arrResQuery = $arrResQuery->orderBy('A.jobTitle', 'asc');
            } if(!empty(request('sel')) && request('sel')==2){
             $arrResQuery = $arrResQuery->orderBy('A.createdOn', 'desc');
            } if(!empty(request('sel')) && request('sel')==3){
            $arrResQuery = $arrResQuery->orderBy('A.createdOn', 'asc');        
            }

            if(!empty(request('sel')) && request('sel')==4){            
              $arrResQuery = $arrResQuery->Where('H.candidateUserId',SESSION('candidate_session_data.userId'));
              $arrResQuery = $arrResQuery->Where('H.deletedFlag',0);           
            } 
              
              if(!empty(request('sel')) && request('sel')==5){
              $candidateId= SESSION('candidate_session_data.userId');
              if(!empty($candidateId)){
               //Personal Information
              $personalInfo=DB::table('t_candidate_details')
              ->select('firstName','lastName','address','city','state','disablityType','disabilitySubType','disabilityPercentage','disabilityCertificateNo')
              ->where([['userId',$candidateId],['deletedFlag',0]])->first();
             
              //  Skill details          
              $skillDetls=DB::table('t_candidate_skill as S')
              ->select('S.skillName')                     
              ->where([['S.userId',$candidateId],['S.deletedFlag',0]])->get();

              foreach($skillDetls as $object)
                {
                  $arrays[] = (array) $object;
                }
              foreach($arrays as $value)
                {
                  $skillArr[] = $value['skillName'];
                }
               
            if(!empty($skillArr)){
              $arrResQuery = $arrResQuery->whereIn('skillsId',$skillArr);
              }              
              
               if(!empty($personalInfo->state)){                
                  $arrResQuery = $arrResQuery->where('J.stateId',$personalInfo->state);
               }
              
               if(!empty($personalInfo->city)){
                  $arrResQuery = $arrResQuery->where('L.locationId',$personalInfo->city);              
               }           
            }
          }

            if(!empty(request('rangleslider'))){
              $minmaxarr=explode(",",request('rangleslider'));
              $arrResQuery=$arrResQuery->where('A.minSalary', '>', $minmaxarr['0']);
              $arrResQuery=$arrResQuery->where('A.maxSalary', '<', $minmaxarr['1']);
            }if(!empty(request('searchkeyword'))){
               $search=request('searchkeyword');

               $arrResQuery=$arrResQuery->Where('A.jobTitle', 'LIKE', '%'.$search.'%');

               $arrResQuery=$arrResQuery->orWhere('E.employerCompany', 'LIKE', '%'.$search.'%');
               $arrResQuery = $arrResQuery->orWhere('J.state', 'LIKE', '%'.$search.'%');
                
              // $arrResQuery=$arrResQuery->orWhere('A.jobLocation', 'LIKE', '%'.$search.'%');
            }

            
            $data=$arrResQuery->paginate(15);
            $intCurrPage = $data->currentPage();
            $intPagecount   = ceil($data->total()/$data->perPage());
            if($data->currentPage()>$intPagecount)
                $intCurrPage    = $intPagecount;
                $intRecNext     = $intCurrPage * $data->perPage();
                $intStartRec    =  ($data->currentPage()-1)*$data->perPage()+1;  
                $intRecNext     = $intCurrPage * $data->perPage();
                $intEndRec      = $intRecNext;
            if($intEndRec>$data->total())
              $intEndRec  = $data->total();
            $returnHTML = view('website.jobdetails_data',compact('data'))->render();
return response()->json(array('success' => 200, 'html'=>$returnHTML,'intStartRec'=>$intStartRec,'intEndRec'=>$intEndRec,'totalrec'=>$data->total()));

          
   // return view('website.jobdetails_data', compact('data'))->render();

  }

}
function addFavourite(){
$data=request()->all();
$BookmarkedModel = new BookmarkedModel();
$userid=SESSION('candidate_session_data.userId');
$status['status'] =300;
$status['msg'] = "some inputs missing";
if(!empty($data) && $data['liked']==1){
  $tocount=BookmarkedModel::where([['jobId',$data['jobid']],['candidateUserId',$userid]])->get();
  $count = $tocount->count();
  if($count==0){
     $BookmarkedModel->jobId = $data['jobid'];
     $BookmarkedModel->candidateUserId =$userid;  
     $BookmarkedModel->liked =1;                                              
     $BookmarkedModel->save();
     $status['status'] =200;
    $status['msg'] = "successfuly saved";
  }else{
    BookmarkedModel::where([['jobId',$data['jobid']],['candidateUserId',$userid]])
              ->update([
                  'deletedFlag' => 0,
                  'liked' => 1
              ]);
                $status['status'] =200;
                $status['msg'] = "successfuly saved";
  }
}else{
  BookmarkedModel::where([['jobId',$data['jobid']],['candidateUserId',$userid]])
              ->update([
                  'deletedFlag' => 1,
                   'liked' => 2
              ]);
              $status['status'] =200;
                $status['msg'] = "successfuly saved";
}


return json_encode($status);
}

function savedjob(){
if(request()->ajax()){

    $arrResQuery=DB::table('t_job as A')
            ->select('A.jobId','A.jobTitle','A.jobLocation','A.jobVacancy','A.employmentTypeId','A.jobDescription','A.jobRoleResponsibilities','A.minExp','A.minSalary','A.maxSalary','A.industryId','A.qualificationId','A.companyDetails','A.createdOn','B.jobtypeName','C.industryName','D.qualification','E.employerCompany','E.companyLogo','H.liked','K.appliedJobId',
              DB::raw('group_concat(distinct(G.skillName)) as skillName'),
              DB::raw('group_concat(distinct(G.skillsId)) as skillsId'),
              DB::raw('group_concat(distinct(J.state)) as location'),
              DB::raw('group_concat(distinct(L.location)) as city'),
              DB::raw('group_concat(distinct(J.stateId)) as locationIds'),
                  DB::raw('group_concat(distinct(L.locationId)) as cityids')
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
            ->leftjoin('t_applied_job AS K','K.jobId','=','A.jobId','K.candidateId','=','A.createdBy')
            ->groupBy('A.jobId','A.jobTitle','A.jobLocation','A.jobVacancy','A.employmentTypeId','A.jobDescription','A.jobRoleResponsibilities','A.minExp','A.minSalary','A.maxSalary','A.industryId','A.qualificationId','A.companyDetails','A.createdOn','B.jobtypeName','C.industryName','D.qualification','E.employerCompany','E.companyLogo','H.liked','K.appliedJobId')
            // ->where('A.deletedFlag', '=', '0')
            // ->where('H.deletedFlag', '=', '0')
            // ->where('H.liked', '=', '1');
             ->where([['A.deletedFlag',0],['H.deletedFlag',0],['H.liked',1]]);
            if(!empty(request('sel')) && request('sel')==1){
              $arrResQuery = $arrResQuery->orderBy('A.jobTitle', 'asc');
            } if(!empty(request('sel')) && request('sel')==2){
             $arrResQuery = $arrResQuery->orderBy('A.createdOn', 'desc');
            } if(!empty(request('sel')) && request('sel')==3){
            $arrResQuery = $arrResQuery->orderBy('A.createdOn', 'asc');
            }
          $data=$arrResQuery->paginate(15);
          $intCurrPage = $data->currentPage();
          $intPagecount   = ceil($data->total()/$data->perPage());
        if($data->currentPage()>$intPagecount)
         $intCurrPage  = $intPagecount;
         $intRecNext     = $intCurrPage * $data->perPage();
         $intStartRec =  ($data->currentPage()-1)*$data->perPage()+1;  
         $intRecNext     = $intCurrPage * $data->perPage();
         $intEndRec    = $intRecNext;
      if($intEndRec>$data->total())
        $intEndRec  = $data->total();
        $returnHTML = view('website.savedjob_data',compact('data'))->render();
         
return response()->json(array('success' => 200, 'html'=>$returnHTML,'intStartRec'=>$intStartRec,'intEndRec'=>$intEndRec,'totalrec'=>$data->total()));
           
      //return view('website.savedjob_data', compact('data'))->render();
    }
}

function login(){
 
   $data=request()->all();
   if(!empty($data)){
   $requestData = request()->all();  
$validator   = Validator::make($requestData, [
  'emailidemployer' => 'bail|required|email|max:128',
  'passwordemployer' => 'bail|required',
  //'captcha' => 'bail|required'
], ['emailidemployer.required' => 'emailid  is required'
]);
if ($validator->fails()) {
  $respArr = array('status' => 500, 'msg' => $validator->errors());
  return response()->json($respArr);
} else {

  /*************************google recaptcha validation by :: samir kumar**********************************/
  // $captcha = $requestData['g-recaptcha-response'];
  // $ip  = $_SERVER['REMOTE_ADDR'];
  // $key = env('RE_CAPTCHA_SERVER');
  // $url = env('RE_CAPTCHA_VERIFY_URL');

  // // RECAPTCH RESPONSE
  // $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
  // $data = json_decode($recaptcha_response);
 

  //if(isset($data->success) &&  $data->success === true) {
    $userName = $requestData['emailidemployer'];
    $password = md5($requestData['passwordemployer']);
    $getEmployeerData = AdminModel::from('m_user_master AS A')
          ->selectRaw('A.*,B.companyLogo, B.employerName, B.employerDesignation, B.employerCompany, B.employerWebsite, B.employerLocation, B.employerSkills, B.employerSize, B.employerIndustry, B.employerPannumber, B.employerPanfile, B.employerCompanyintro, B.employerCompanyaddr')
          ->leftjoin('t_employer_profile AS B','A.userId','=','B.employerId','B.deletedFlag','=',0)
          ->where([['loginId',$userName],['password',$password],['tinUserType',2],['publishStatus',1]])->get()->toArray();
    if(empty($getEmployeerData)){
      $status['status'] = "300";
      $status['msg'] = "You have entered wrong username or password.";
  
    }else{
      session(['employer_session_data' => $getEmployeerData[0]]);
       $status['status'] ="200";
       $status['msg'] = "log in successful";
    }
  // }else{
  //   $status['status'] = "300";
  //   $status['msg'] = "Invalid Captcha Code";
  // }
  /*************************google recaptcha validation by :: samir kumar**********************************/
}

}
else
{
$status['status'] =300;
$status['msg'] = "some inputs missing";
}

$status=json_encode($status);
return $status;
}

function loginCandidate(){
  $adminModel = new AdminModel();
  $data=request()->all();
  if(!empty($data)){
    $requestData = request()->all();  
    $validator   = Validator::make($requestData, [
        'emailaddress' => 'bail|required|email|max:128',
        'password' => 'bail|required',
        // 'captcha' => 'bail|required'
        ], ['emailaddress.required' => 'emailaddress  is required'
      ]);
      if ($validator->fails()) {
        $respArr = array('status' => 500, 'msg' => $validator->errors());
        return response()->json($respArr);
      } else {
        /*************************google recaptcha validation by :: samir kumar**********************************/
        // $captcha = $requestData['g-recaptcha-response'];
        // $ip  = $_SERVER['REMOTE_ADDR'];
        // $key = env('RE_CAPTCHA_SERVER');
        // $url = env('RE_CAPTCHA_VERIFY_URL');

        // // RECAPTCH RESPONSE
        // $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
        // $data = json_decode($recaptcha_response);
   

       // if(isset($data->success) &&  $data->success === true) {
          $userName = $requestData['emailaddress'];
          $password = md5($requestData['password']);
          //$getCandidateData = $adminModel->where([['loginId',$userName],['password',$password],['tinUserType',3],['publishStatus',1]])->get()->toArray();
          /* chkin data exits or not */
          $getPortalCandidate = AdminModel::from('m_user_master AS A')
                ->selectRaw('A.*,B.location, B.experience, B.firstName, B.middleName, B.lastName, B.address, B.pin, B.city, B.state, B.secondMob, B.profileImage, B.disablityType, B.profileCV, B.createdOn, B.createdBy, B.updatedOn, B.updatedBy, B.deletedFlag, B.candidateType, B.selLocation, B.finalSubmit, B.disabilitySubType, B.disabilityPercentage, B.disabilityCertificateNo')
                ->leftjoin('t_candidate_details AS B','A.userId','=','B.userId','B.deletedFlag','=',0)
                ->where([['loginId',$userName],['password',$password],['tinUserType',3],['publishStatus',1],['registerType',1]])->get()->toArray();
               
          if(empty($getPortalCandidate)) {
            /* chkin registerType exits or not */
            $getGoogleCandidateData = AdminModel::from('m_user_master AS A')
                ->selectRaw('A.*,B.location, B.experience, B.firstName, B.middleName, B.lastName, B.address, B.pin, B.city, B.state, B.secondMob, B.profileImage, B.disablityType, B.profileCV, B.createdOn, B.createdBy, B.updatedOn, B.updatedBy, B.deletedFlag, B.candidateType, B.selLocation, B.finalSubmit, B.disabilitySubType, B.disabilityPercentage, B.disabilityCertificateNo')
                ->leftjoin('t_candidate_details AS B','A.userId','=','B.userId','B.deletedFlag','=',0)
                ->where([['loginId',$userName],['tinUserType',3],['publishStatus',1],['registerType',2]])->get()->toArray();
               // echo'<pre>';print_R($getGoogleCandidateData);exit; 
                  if(empty($getGoogleCandidateData)){
                    $status['status'] = "300";
                    $status['msg'] = "You have entered wrong username or password.";
                  } else {
                    session()->forget('form_type');
                    session()->forget('getCandidateData');  
                  
                    $status['status'] ="202";
                    $status['msg'] = "This email Id is registered from Google Account. Please Sign In With Google!";
                  
                  }           
          }else{

              session(['candidate_session_data' => $getPortalCandidate[0]]);
              $status['status'] ="200";
              $status['msg'] = "log in successful";
            
          }
              // session()->forget('form_type');
              // session()->forget('getCandidateData');  
              // session(['candidate_session_data' => $getCandidateData[0]]);
              // Session::flash('message', 'Sorry!!! This email Id is registered from Portal. Please login!'); 
              // Session::flash('alert-class', 'alert alert-danger'); 
              // $this->viewVars['status'] = 1;
              // $this->viewVars['reenter']=1;
              // return view('candidate.verifyOtp', $this->viewVars);
            
          //  session(['candidate_session_data' => $getCandidateData[0]]);
          //    $status['status'] ="200";
          //    $status['msg'] = "log in successful";
          }
        // }else{
        //   $status['status'] = "300";
        //   $status['msg'] = "Invalid Captcha Code";
        // }
        /*************************google recaptcha validation by :: samir kumar**********************************/
     // }
  }
  else
  {
  $status['status'] =300;
  $status['msg'] = "some inputs missing";
  }

  $status=json_encode($status);
  return $status; 
}

function loginPartner(){ 
 $adminModel = new AdminModel();
   $data=request()->all();
   if(!empty($data)){
   $requestData = request()->all();  
 
$validator   = Validator::make($requestData, [
  'emailaddpartner' => 'bail|required|email|max:128',
  'passwordpartner' => 'bail|required'
  //'captcha' => 'bail|required'
], ['emailaddpartner.required' => 'emailid  is required'
]);
if ($validator->fails()) {
  $respArr = array('status' => 500, 'msg' => $validator->errors());
  return response()->json($respArr);
} else {

    /*************************google recaptcha validation by :: samir kumar**********************************/
        // $captcha = $requestData['g-recaptcha-response'];
        // $ip  = $_SERVER['REMOTE_ADDR'];
        // $key = env('RE_CAPTCHA_SERVER');
        // $url = env('RE_CAPTCHA_VERIFY_URL');

        // // RECAPTCH RESPONSE
        // $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
        // $data = json_decode($recaptcha_response);
        //echo '<pre>';print_r($data);exit;

       // if(isset($data->success) &&  $data->success === true) {
          $userName = $requestData['emailaddpartner'];
          $password = md5($requestData['passwordpartner']);
          //$getPartnerData = $adminModel->where([['loginId',$userName],['password',$password],['tinUserType',4],['publishStatus',1]])->get()->toArray();
          $getPartnerData = AdminModel::from('m_user_master AS A')
                ->selectRaw('A.*,B.companyLogo, B.partnerName, B.partnerDesignation, B.partnerCompany, B.partnerWebsite, B.partnerLocation, B.partnerService, B.partnerSize, B.partnerCompanyintro, B.partnerCompanyaddr, B.partnerServiceOffered')
                ->leftjoin('t_partner_profile AS B','A.userId','=','B.partnerId','B.deletedFlag','=',0)
                ->where([['loginId',$userName],['password',$password],['tinUserType',4],['publishStatus',1]])->get()->toArray();
          if(empty($getPartnerData)){
            $status['status'] = "300";
            $status['msg'] = "You have entered wrong username or password.";
        
          }else{
             session(['partner_session_data' => $getPartnerData[0]]);
             $status['status'] ="200";
             $status['msg'] = "log in successful";
          }
        // }else{
        //   $status['status'] = "300";
        //   $status['msg'] = "Invalid Captcha Code";
        // }
    /*********************************************************************************************************/    
}

}
else
{
$status['status'] =300;
$status['msg'] = "some inputs missing";
}

$status=json_encode($status);
return $status;
}
public function applyjob(){
$data=request()->all();
$AppliedJobModel = new AppliedJobModel();
$status['status'] =300;
$status['msg'] = "some inputs missing";
if(!empty($data)){
     $AppliedJobModel->jobId = $data['jobid'];
     $AppliedJobModel->candidateId =$data['candidateid']; 
      if($AppliedJobModel->save()){

          $jobData = AppliedJobModel::find($AppliedJobModel->appliedJobId);
          $cname = $jobData->candidatedetail->firstName.' '.$jobData->candidatedetail->middleName.' '.$jobData->candidatedetail->lastName;
          //echo "<pre>";print_r($jobData->candidatedetail);exit;

          /********* Send Notification to Candidate *********/
          $notificationDesc = 'You have successfully applied for '.$jobData->jobdetail->jobTitle;
          $notificationType = 6; 
          $notificationFrom = session()->get('candidate_session_data.userId');
          $notificationTo   = session()->get('candidate_session_data.userId');
          $notifycommonId  = $jobData->jobId;
          sendNotification($notificationDesc,$notificationType,$notificationFrom,$notificationTo,$notifycommonId);

          /********* Send Notification to Candidate *********/

          /********* Send Notification to Employer *********/
          $notificationDesc = $cname.' applied for '.$jobData->jobdetail->jobTitle;
          $notificationType = 2; 
          $notificationFrom = session()->get('candidate_session_data.userId');
          $notificationTo   = $jobData->jobdetail->createdBy;
          $notifycommonId  = $jobData->jobId;
          sendNotification($notificationDesc,$notificationType,$notificationFrom,$notificationTo,$notifycommonId);

          /********* Send Notification to Employer *********/

         $status['status'] =200;
         $status['msg'] = "You have successfully applied the job.";
      }
}
return json_encode($status);

}

public function resendOtp(){
$adminModel=new AdminModel();
$data=request()->all();
$getEmployeerData = $adminModel->where([['userId',$data['userid']]])->get()->toArray();
$mobileno=$getEmployeerData[0]['mobileNo'];
$emailId=$getEmployeerData[0]['emailId'];
$otp=$getEmployeerData[0]['otp'];
// messages
$status['status'] =300;
$status['msg'] = "some inputs missing";
// $otp=rand ( 1000 , 9999 );
$mailContent='Your one time otp for registration is '.$otp;
               
$ccmailAddress='';
$bccmailAddress='';
$subject='OTP Verification';
$attachment='';
$sendTo=$emailId;

$sendmail=sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);
//print_R($sendmail);exit;
        if($sendmail==1){
         // if(!empty($data)){
            // $updatedata=AdminModel::where([['userId',$data['userid']]])
            // ->update([
            //   'otp' => $otp
            // ]);
   //if(!empty($updatedata)){
           $status['status'] =200;
           $status['msg'] = "Otp has been successfully sent to your Email.";
      //  }

    //  } 
    } else{
          $status['status'] =300;
          $status['msg'] = "some inputs missing";
          }

return json_encode($status);
}
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
          $getskills   = $getskills->where([['deletedflag',0]])->get();
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

public function loadnotifiation() {
 
$requestData = request()->all();  
$userid=$requestData['userid'];
$message =  DB::select( DB::raw("
SELECT GROUP_CONCAT(F.msgId) AS notificationId,CONCAT('You have received ',COUNT(F.msgId),' message(s) in last 24 hours. You have ',
  SUM(
    CASE WHEN (F.readStatus = 0) THEN 1 ELSE 0 END
  )

 ,' unread messages. Click to view.') AS notificationDesc, 3 AS notificationType,'t_msg_convo' AS tbl_name FROM t_msg_convo F WHERE F.createdOn > DATE_SUB(NOW(), INTERVAL 24 HOUR) and F.readStatus = 0 and F.createdBy=$userid 

") );
$message=json_decode(json_encode($message), true);
$NotificationModel = new NotificationModel();
$NotificationModel = $NotificationModel->where([['notificationTo',$userid],['readStatus',0]])->get()->toArray();
$cards=array_merge($NotificationModel,$message);
  if(!empty($cards)){
      $respArr      = array('status' => 200, 'result' => $cards);
  }else{
       $respArr      = array('status' => 500, 'msg' => 'Sorry!! something went wrong');
  }
                 
  return response()->json($respArr);       
              
}
    public function addnotification() {
      $requestData = request()->all();  
      $id=$requestData['notificationId'];
      $type=$requestData['type'];
      if($type!=3){
         NotificationModel::where('notificationId', $id)
                ->update([
                    'readStatus'=>1
                ]);
      }
       if($type==3){
        $arr=explode(',', $id);
        foreach ($arr as $key => $value) {
           MessageconvoModel::where('msgId', $value)
                ->update([
                    'readStatus'=>1
                ]);
        }
      }
      $respArr      = array('status' => 200,'types'=>$type, 'msg' => 'update successfuly');
        return response()->json($respArr);
    }


  public function volunteerformsubmit(){
    $requestData = request()->all(); 
    if(!empty($requestData)){
     $validator   = Validator::make($requestData, [
      'vfname'     =>  'bail|required',
      'vlname'     =>  'bail|required',
      'vfmobile'   =>  'bail|required',
      'vfemail'    =>  'bail|required|email',
      'vfcomments' =>  'bail|required'
      //'vfmobile'   =>  'bail|required|numeric|max:10',
      //'captcha' => 'bail|required'
      ],
      [
        'vfname.required'      => 'first Name is required',
        'vlname.required'      => 'last Name is required',
        'vfemail.required'     => 'Email is required',
        'vfmobile.required'    => 'Mobile number is required',
        'vfcomments.required'  => 'Meassage is required'
        //'captcha.required'     => 'Captcha is required',
      ]);
      if($validator->fails()) {
        // echo 111;exit;
        $respArr = array('status' => 500, 'msg' => $validator->errors());
      } else {
        // echo 222;exit;
          /*************************google recaptcha validation by :: samir kumar**********************************/
          // $captcha = $requestData['g-recaptcha-response'];
          // $ip  = $_SERVER['REMOTE_ADDR'];
          // $key = env('RE_CAPTCHA_SERVER');
          // $url = env('RE_CAPTCHA_VERIFY_URL');

          // // RECAPTCH RESPONSE
          // $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
          // $data = json_decode($recaptcha_response);
          //echo '<pre>';print_r($data);exit;

         // if(isset($data->success) &&  $data->success === true) {
            $mailContent  ='First Name :  '.$requestData['vfname'].'<br/>';
            $mailContent .='Last Name :  '.$requestData['vlname'].'<br/>';
            $mailContent .='Mobile :  '.$requestData['vfmobile'].'<br/>';
            $mailContent .='Email :  '.$requestData['vfemail'].'<br/>';
            $mailContent .='Message :  '.$requestData['vfcomments'].'<br/>';
            // echo'<pre>';print_r($mailContent);exit;
            $ccmailAddress='';
            $bccmailAddress='';
            $subject='Say foundation volunteer application';
            $attachment='';
            $sendTo=SAY_FND_EMAIL;
            //$sendTo='swagatika.sahoo@csm.co.in,samir.muduli@csm.co.in';
            $mailRes = sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);   
            if(!empty($mailRes)){
              $respArr = array('status' => 200, 'msg' => 'Application submitted successfully');
            }else{         
              $respArr = array('status' => 500, 'msg' => 'Something went wrong.Try later.');
            }
          // }else{
          //   $respArr = array('status' => 300, 'msg' => 'Invalid Captcha Code');
          // }
          /**************************************************************************************/
          
      }     
      return response()->json($respArr);
    }
  }


  public function donateformsubmit(){
    $requestData = request()->all();  
    if(!empty($requestData)){
     $validator   = Validator::make($requestData, [
      'dname'     =>  'bail|required',
      'dcountry'  =>  'bail|required',
      'demail'    =>  'bail|required|email',
      'dmobile'   =>  'bail|required',
      'ddate'     =>  'bail|required',
      'dtime'     =>  'bail|required',
      //'vfmobile'=>  'bail|required|numeric|max:10',
      'dcomments' =>  'bail|required'
      //'dcaptcha'   => 'bail|required'
      ],
      [
        'dname.required'   => 'Name is required',
        'dcountry.required'  => 'Country is required',
        'demail.required'  => 'Email is required',
        'dmobile.required' => 'Mobile number is required',
        'ddate.required'  => 'Date is required',
        'dtime.required'  => 'Time is required',
        'dcomments.required'  => 'Meassage is required'
        //'dcaptcha.required'     => 'Captcha is required',
      ]);
      if($validator->fails()) {
        $respArr = array('status' => 500, 'msg' => $validator->errors());
      } else {

        /*************************google recaptcha validation by :: samir kumar**********************************/
          // $captcha = $requestData['g-recaptcha-response'];
          // $ip  = $_SERVER['REMOTE_ADDR'];
          // $key = env('RE_CAPTCHA_SERVER');
          // $url = env('RE_CAPTCHA_VERIFY_URL');

          // // RECAPTCH RESPONSE
          // $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
          // $data = json_decode($recaptcha_response);
          //echo '<pre>';print_r($data);exit;

         // if(isset($data->success) &&  $data->success === true) {
            // $mailContent  ='Name :  '.$requestData['dname'].'<br/>';
            $mailContent  ='Country : '.$requestData['dcountry'].'<br/>';
            $mailContent  ='Name :  '.$requestData['dname'].'<br/>';
            $mailContent .='Email :  '.$requestData['demail'].'<br/>';
            $mailContent .='Mobile :  '.$requestData['dmobile'].'<br/>';
            $mailContent .='Date :  '.$requestData['ddate'].'<br/>';
            $mailContent .='Time :  '.$requestData['dtime'].'<br/>';
            $mailContent .='Message :  '.$requestData['dcomments'].'<br/>';

            $ccmailAddress='';
            $bccmailAddress='';
            $subject='Say foundation donation application';
            $attachment='';
            $sendTo=SAY_FND_EMAIL;

            //$sendTo='swagatika.sahoo@csm.co.in,samir.muduli@csm.co.in';
            // $mailRes = sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);  
            // if(!empty($mailRes)){

              $CountryCode = CountryModel::where([['country_name',$requestData['dcountry']],['deletedFlag',0]])->first()->country_ISD;

             // echo "<pre>";print_r($CountryCode);exit;

              
              $calMailData['start_date'] = date("Y-m-d H:i:s",strtotime($requestData['ddate'].' '.$requestData['dtime']));
              $calMailData['description'] = 'Discussion with '. $requestData['dname'] .' for donation towards Say Foundation';
              $calMailData['location'] = 'Over call - '.$CountryCode.'-'.$requestData['dmobile'];
              $calMailData['subject'] = 'Donation : Say Foundation';
              $calMailData['sendTo'] = SAY_FND_EMAIL;
              //$calMailData['sendTo'] = 'skumarsm1319@gmail.com';
              $calMailData['ccmailAddress'] = $ccmailAddress;
              $calMailData['bccmailAddress'] = $bccmailAddress;
              $calMailData['attachment'] = $attachment;
              $calMailData['messsage'] = $mailContent;
              $calMailData['message'] = $mailContent;

              sendMailWithGoogleCalender($calMailData);  

              $respArr = array('status' => 200, 'msg' => 'Application submitted successfully');
            // }else{          
            //   $respArr = array('status' => 500, 'msg' => 'Something went wrong.Try later.');
            // }   
          // }else{
          //   $respArr = array('status' => 300, 'msg' => 'Invalid Captcha Code');
          // }   
      }     
      return response()->json($respArr);
    }
  }

   public function contactformsubmit(){
    $requestData = request()->all();  
    if(!empty($requestData)){
     $validator   = Validator::make($requestData, [
      'cname'      =>  'bail|required',
      'cemail'     =>  'bail|required|email',
      'cmobile'    =>  'bail|required',
      //'vfmobile'   =>  'bail|required|numeric|max:10',
      'ccomments' =>  'bail|required',  
      //'ccaptcha'   => 'bail|required'
      ],
      [
        'cname.required'   => 'Name is required',
        'cemail.required'  => 'Email is required',
        'cmobile.required' => 'Mobile number is required',
        'ccomments.required'  => 'Meassage is required',    
        //'ccaptcha.required'     => 'Captcha is required',
      ]);
      if($validator->fails()) {
        $respArr = array('status' => 500, 'msg' => $validator->errors());
      } else {


        /*************************google recaptcha validation by :: samir kumar**********************************/
          // $captcha = $requestData['g-recaptcha-response'];
          // $ip  = $_SERVER['REMOTE_ADDR'];
          // $key = env('RE_CAPTCHA_SERVER');
          // $url = env('RE_CAPTCHA_VERIFY_URL');

          // // RECAPTCH RESPONSE
          // $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
          // $data = json_decode($recaptcha_response);
          //echo '<pre>';print_r($data);exit;

         // if(isset($data->success) &&  $data->success === true) {
            $mailContent  ='Name :  '.$requestData['cname'].'<br/>';
            $mailContent .='Email :  '.$requestData['cemail'].'<br/>';
            $mailContent .='Mobile :  '.$requestData['cmobile'].'<br/>';
            $mailContent .='Message :  '.$requestData['ccomments'].'<br/>';

            $ccmailAddress='';
            $bccmailAddress='';
            $subject='Say foundation donation application';
            $attachment='';
            //$sendTo='swagatika.sahoo@csm.co.in,samir.muduli@csm.co.in';
            $sendTo=SAY_FND_EMAIL;
            //$sendTo='swagatika.sahoo@csm.co.in,samir.muduli@csm.co.in';
            $mailRes = sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);   
            if(!empty($mailRes)){
              //$respArr = array('status' => 200, 'msg' => 'Application submitted successfully');
              $respArr = array('status' => 200, 'msg' => 'Thank you for your interest in The SAY Foundation. We would love to hear from you and answer any questions you may have. Please use the form below to get in touch with us or email us: contactus@thesayfoundation.com.');
            }else{          
              $respArr = array('status' => 500, 'msg' => 'Something went wrong.Try later.');
            } 
          // }else{
          //   $respArr = array('status' => 300, 'msg' => 'Invalid Captcha Code');
          // }
          /******************************************************************************************************/       
        return response()->json($respArr);
      }
    }
  }
  function loadcity(){
    $data=request()->all();
    $stateid=$data['stateid'];
    $locations                    = DB::table('m_location')
                                   ->select('locationId','location')
                                   ->where([['stateId', $stateid],['deletedflag',0]])
                                   ->orderBy('location', 'asc')->get()->toArray();
    $respArr      = array('status' => 200,'result'=>$locations);
    return response()->json($respArr); 
  }
   function loadmultiplecity(){
    $data=request()->all();
    $stateid=$data['jobmultiplelocation'];
    $locations                    = DB::table('m_location')
                                   ->select('locationId','location')
                                    ->whereIn('stateId',$stateid)
                                   ->where([['deletedflag',0]])
                                   ->orderBy('location', 'asc')->get()->toArray();
    $respArr      = array('status' => 200,'result'=>$locations);
    return response()->json($respArr); 
  }

  function loadGallery(){
    $data=request()->all();
    $type=$data['type'];
    $result = GalleryModel::where([['deletedflag',0],['publishStatus',0],['type',$type]])->orderBy('sequence','ASC')->get()->toArray();
    $respArr      = array('status' => 200,'result'=>$result);
    return response()->json($respArr); 
  }

  function loadGalleryData(){   
    $rdata=request()->all(); //echo "<pre>" ;print_r($rdata) ;exit;
    $type=$rdata['type'];
    $arrResQuery = GalleryModel::where([['deletedflag',0],['publishStatus',0],['type',$type]])->orderBy('sequence','ASC');
    $data=$arrResQuery->paginate(15);
    $intCurrPage = $data->currentPage();
    $intPagecount   = ceil($data->total()/$data->perPage());
  if($data->currentPage()>$intPagecount)
     $intCurrPage  = $intPagecount;
     $intRecNext     = $intCurrPage * $data->perPage();
     $intStartRec =  ($data->currentPage()-1)*$data->perPage()+1;  
     $intRecNext     = $intCurrPage * $data->perPage();
     $intEndRec    = $intRecNext;
    if($intEndRec>$data->total())
      $intEndRec  = $data->total();

    $returnHTML = view('website.galleryData',compact('data','type'))->render();
    return response()->json(array('success' => 200, 'html'=>$returnHTML,'intStartRec'=>$intStartRec,'intEndRec'=>$intEndRec,'totalrec'=>$data->total()));
  }

  /*************************load country ajax by :: samir kumar******************************/
  function loadcountryAjax(){
    $country =  CountryModel::where('deletedFlag',0)->get()->toArray();
    //echo '<pre>';print_r($country);exit;
    if(count($country) > 0){
      return response()->json(array('status' => 200, 'msg' => 'Success', 'result' => $country));
    }else{
      return response()->json(array('status' => 404, 'msg' => 'Sorry!!! No record found.'));
    }
  }

   /* Employer Profile approval status update -- Sangita --  17-05-2022 -- */
   public function employerApprovalStatus(){
   //echo '213214'; exit;
    $requestData = request()->all();       
        $employerId=$requestData['employerId'];
        $status=$requestData['empStatus'];
        $statusName=($status=='1')?'Approved':'Rejected';
       
        $updateEmpStatus = EmployerprofileModel::where('employerId', $employerId)
          ->update([              
             'approveStatus' => $status
          ]);          

          if($updateEmpStatus=1){           
            $respArr      = array('status' => 200, 'msg' =>'Employer status has been '.$statusName.'.');
            return response()->json($respArr);              
          } else {

            $respArr      = array('status' => 500, 'msg' => 'Sorry!! something went wrong');
            return response()->json($respArr);
          }
        }

         /* Newsletter Subscription -- Sangita --  03-04-2023 -- */
         public function newsletterSubscription(){
          $requestData = request()->all();       
          $emailId=$requestData['emailid'];         

          $chkDup = DB::table('m_newsletter')->where([['emailId',$requestData['emailid']],['deletedFlag',0]])->first();
         // echo '<pre>'.'5345435'; print_r($chkDup); exit;
          if(!empty($chkDup)){
            $respArr=array('status'=>500, 'msg'=>'Email address already subscribed!');
          } else {
            $data=DB::table('m_newsletter')->insert(
              ['emailId' => $emailId, 'subscriptionStatus' => 1]);             
            
            $respArr=array('status'=>200, 'msg'=>'Subscription successful!');
           
          }          
          return response()->json($respArr);
        }

}

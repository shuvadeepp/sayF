<?php

/* * ******************************************
  File Name     : ImportController.php
  Description   : Controller file to import data through Excel file
  Created By    : Sangita Pratap
  Created On    : 16-May-2022

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
use App\Models\JobModel;
use App\Models\JobSkillModel;
use App\Models\JobLocationModel;
use App\Models\AppliedJobModel;
use App\Models\DisabilityModel;
use App\Models\JobIndustriesModel;
use App\Models\JobDisabilityModel;
use App\Models\JobQualificationModel;
use App\Models\AdminModel;
use App\Models\CandidateModel;
use App\Models\CandidateExperienceModel;
use App\Models\CandidateEducationModel;
use App\Models\CandidateSkillModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use DB;
use Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\PayUService\Exception;


class ImportController extends AppController {


      /* Import Job from Excel file at admin panel -- Sangita Pratap -- 16-05-2022 -- */
public function importjob(){     
    if(!empty(request()->all()) && request()->isMethod('post')) {
        try{
          DB::beginTransaction();     
      // Get the excel rows as an array
    $jobArray = Excel::toArray(new JobModel(), request('import_job'));
  
    $jobArray=$jobArray[0];
    unset($jobArray[0]);
    $res=0;
    $jobListDetails='';
   
    foreach($jobArray as $jobDetails){      

      $objJobModel = new JobModel();
      $objJobModel->jobTitle                 = (!empty($jobDetails[0]))?$jobDetails[0]:'';
      $objJobModel->jobVacancy               = (!empty($jobDetails[1]))?$jobDetails[1]:'';
      $objJobModel->employmentTypeId         = (!empty($jobDetails[2]))?$jobDetails[2]:'';
      $objJobModel->jobDescription           = htmlspecialchars($jobDetails[3],ENT_QUOTES);
      $objJobModel->jobRoleResponsibilities  = htmlspecialchars($jobDetails[4],ENT_QUOTES);    
      $objJobModel->minExp                   = (!empty($jobDetails[5]))?$jobDetails[5]:'';
      $objJobModel->minSalary                = (!empty($jobDetails[6]))?$jobDetails[6]:'';
      $objJobModel->maxSalary                = (!empty($jobDetails[7]))?$jobDetails[7]:'';    
      $objJobModel->companyDetails           = htmlspecialchars($jobDetails[8],ENT_QUOTES);
    //  $objJobModel->jobStartDate             = (strtotime($jobDetails[9])>0)?date("Y-m-d",strtotime($jobDetails[9])):'';
    //  $objJobModel->jobExpiryDate            = (strtotime($jobDetails[10])>0)?date("Y-m-d",strtotime($jobDetails[10])):'';
      $UNIX_START_DATE = ($jobDetails[9] - 25569) * 86400;
      $objJobModel->jobStartDate = gmdate("Y-m-d H:i:s", $UNIX_START_DATE);

      $UNIX_EXPIRY_DATE = ($jobDetails[10] - 25569) * 86400;
      $objJobModel->jobExpiryDate = gmdate("Y-m-d H:i:s", $UNIX_EXPIRY_DATE); 

      $objJobModel->createdBy              = (!empty($jobDetails[11]))?$jobDetails[11]:'';
      $objJobModel->updatedBy              = (!empty($jobDetails[12]))?$jobDetails[12]:'';
      $objJobModel->updatedOn              = date("Y-m-d H:i:s");    
      $objJobModel->job_status = (!empty($jobDetails[13]))?$jobDetails[13]:'';
      $objJobModel->readStatus = (!empty($jobDetails[14]))?$jobDetails[14]:'';
      $objJobModel->readExpiryStatus = (!empty($jobDetails[15]))?$jobDetails[15]:'';
      $objJobModel->save();    
      $lastInsertedId = $objJobModel->jobId;        

      $skillList='';
      $jobLocationsList='';
      $industryIdList='';
      $seldisableList='';
      $qualificationList='';
      $selCity='';

      if(!empty($lastInsertedId)){
     /* Saving Skill */
      $skillList=(!empty($jobDetails[16]))?$jobDetails[16]:'';
      $jobSkills=array();
      if(!empty($skillList)){      
      $jobSkills = explode(',', $skillList);      
    
      foreach ($jobSkills as $jskey => $jsval){
        $objJobSkillModel = new JobSkillModel();
        $objJobSkillModel->jobId      = $lastInsertedId;
        $objJobSkillModel->skillId    = $jsval;
        $objJobSkillModel->createdBy  = $jobDetails[13];
        $objJobSkillModel->createdOn  = date("Y-m-d H:i:s");
        $objJobSkillModel->save();        
      }
      $res++;  
    }

       /* Saving Job Location -- Start -- */
      $jobLocationsList=(!empty($jobDetails[17]))?$jobDetails[17]:'';
      $selCityList=(!empty($jobDetails[21]))?$jobDetails[21]:'';
      $jobLocations=array(); 
      if(!empty($jobLocationsList)){          
      $jobLocations = explode(',', $jobLocationsList);
      
      $selCity=array();  
      if(!empty($selCityList)){           
        $selCity = explode(',', $selCityList);
      }


      if(!empty($jobLocations)){      
        foreach ($jobLocations as $lkey => $lval){ 
          /* saving city under each state */
          $locationList = $location  = DB::table('m_location')  
          ->select('locationId')    
          ->where('deletedflag',0)
          ->where('stateId',$lval)
          ->orderBy('state','ASC')
          ->groupBy('stateId','state','locationId')
          ->get();
          $allLocation=array();
          $locationList= json_decode(json_encode($locationList),true);
            foreach($locationList as $location){
              $allLocation[] = $location['locationId'];
            }     
          
            foreach ($selCity as $ckey => $cval){ 
              if(in_array($cval, $allLocation)){       
                $objJobLocationModel = new JobLocationModel();
                $objJobLocationModel->jobId      = $lastInsertedId;
                $objJobLocationModel->locationId = $lval;
                $objJobLocationModel->cityId = $cval;
                $objJobLocationModel->createdBy  = $jobDetails[13];
                $objJobLocationModel->createdOn  = date("Y-m-d H:i:s");
                $objJobLocationModel->save();
              }
            }
        }
        $res++;  
      }
    }
     /* Saving Job Location -- End -- */
    /* Saving industry -- Start -- */
    $industryIdList=(!empty($jobDetails[18]))?$jobDetails[18]:'';
    $industryId=array();  
    if(!empty($industryIdList)) {         
      $industryId = explode(',', $industryIdList);

      if(!empty($industryId)){       
        foreach ($industryId as $ikey => $ival){
          $objJobIndustriesModel = new JobIndustriesModel();
          $objJobIndustriesModel->jobId      = $lastInsertedId;
          $objJobIndustriesModel->industryId = $ival;
          $objJobIndustriesModel->createdBy  =  $jobDetails[13];
          $objJobIndustriesModel->createdOn  = date("Y-m-d H:i:s");
          $objJobIndustriesModel->save();
        }
        $res++;  
      }
    }
     /* Saving industry -- End -- */

     /* Saving disability -- Start -- */  
    $seldisableList=(!empty($jobDetails[19]))?$jobDetails[19]:'';
    if(!empty($seldisableList)){
      $seldisable=array();
      $seldisable = explode(',', $seldisableList);

      if(!empty($seldisable)){       
        foreach ($seldisable as $lkey => $dval){        
          $objJobDisabilityModel = new JobDisabilityModel();
          $objJobDisabilityModel->jobId          = $lastInsertedId;
          $objJobDisabilityModel->disabilityType = $dval;       
          $objJobDisabilityModel->createdBy      = $jobDetails[13];
          $objJobDisabilityModel->createdOn      = date('Y-m-d H:i:s');
          $objJobDisabilityModel->updatedOn      = date('Y-m-d H:i:s');
          $objJobDisabilityModel->updatedBy      = $jobDetails[13];
          $objJobDisabilityModel->save();
        }
        $res++;  
      }
    }
    /* Saving disability -- End -- */  
    /* Saving Minimum Education Qualification -- Start -- */
        $qualificationList=(!empty($jobDetails[20]))?$jobDetails[20]:'';
        if(!empty($qualificationList)){
        $qualificationId=array();        
        $qualificationId = explode(',', $qualificationList);

      if(!empty($qualificationId)){        
        foreach ($qualificationId as $Qkey => $Qval){
          $objJobQualificationModel = new JobQualificationModel();
          $objJobQualificationModel->jobId          = $lastInsertedId;
          $objJobQualificationModel->qualificationType = $Qval;         
          $objJobQualificationModel->createdBy      = $jobDetails[13];
          $objJobQualificationModel->updated_at      = date('Y-m-d H:i:s');
          $objJobQualificationModel->created_at      = date('Y-m-d H:i:s');
          $objJobQualificationModel->updatedBy      = $jobDetails[13];
          $objJobQualificationModel->save();
        }
        $res++;  
      }     
    } 
     /* Saving Minimum Education Qualification -- End -- */
  } 
  }
      if($res>0){
        DB::commit();
        request()->session()->flash('success', 'Jobs added successfully!');  
        return redirect('application/import/importjob'); 
      } else {
        request()->session()->flash('error', 'Failed to add Jobs!'); 
        return redirect('application/import/importjob'); 
      }
      } catch (\Exception $e) {
        DB::rollback(); 
        request()->session()->flash('error', 'Error: '. $e->getMessage()); 
       // request()->session()->flash('error', 'Something wrong while adding Job!');  
       return redirect('application/import/importjob'); 
      }
      }     
      return view('application.importjob');  
    }

   /* Import Candidate from Excel file -- Sangita Pratap -- 22-05-2022 -- */
    public function importCandidate(){

      if(!empty(request()->all()) && request()->isMethod('post')) {
        $res=0; 
        $status['error_msg']='';       
        $duplicateEmail=array();
        $duplicateRows=array();
        $currentRow=array();
        $errArr=array();
        $candidateEmailArr=array();
        $randPwdArr=array();
        // Get the excel rows as an array
      $candidateArray = Excel::toArray(new AdminModel(), request('import_candidate')); 
   
      $candidateArray=$candidateArray[0];
      unset($candidateArray[0]);
   
     try{      
      DB::beginTransaction();

      foreach($candidateArray as $key =>$candidatebDetails){
        $currentRow[]= $key; 
        if(!empty($candidatebDetails[0]) && !empty($candidatebDetails[1]) && !empty($candidatebDetails[2]) && !empty($candidatebDetails[3]) && !empty($candidatebDetails[4]) && !empty($candidatebDetails[6])){
        $chkDup = AdminModel::where([['emailId',$candidatebDetails[4]],['tinUserType',3]])->orWhere('loginId', $candidatebDetails[6])->first();
      
      // if(!empty($chkDup) && $chkDup->emailVerifyFlag!=1){  
        if(empty($chkDup)){   

        $objCandidateModel = new AdminModel();
        /* -- Start-- Insert to m_user_master table */
        $objCandidateModel->fullName           = (!empty($candidatebDetails[0]))?$candidatebDetails[0]:'';
        $objCandidateModel->gender               = (!empty($candidatebDetails[1]))?$candidatebDetails[1]:'';       
        $UNIX_EXPIRY_DATE = ($candidatebDetails[2] - 25569) * 86400;        
        $objCandidateModel->DOB = gmdate("Y-m-d H:i:s", $UNIX_EXPIRY_DATE);    
        $objCandidateModel->mobileNo             =(!empty($candidatebDetails[3]))?$candidatebDetails[3]:'';
        $objCandidateModel->emailId            = (!empty($candidatebDetails[4]))?$candidatebDetails[4]:'';
        $randPwd=substr(md5(time()), 0, 8);
        $objCandidateModel->password  = md5($randPwd);
       // $objCandidateModel->password  = md5(rand(1111,9999));
        $objCandidateModel->companyName              = (!empty($candidatebDetails[5]))?$candidatebDetails[5]:'';
        $objCandidateModel->tinUserType                   = 3;  
        $objCandidateModel->loginId               = (!empty($candidatebDetails[6]))?$candidatebDetails[6]:'';
        $objCandidateModel->loginType                   = 1;  
        $objCandidateModel->emailVerifyFlag = 1;
        $objCandidateModel->publishStatus= 1;
        $objCandidateModel->otp=rand(1111,9999);
        $objCandidateModel->save();
        $lastInsertedId = $objCandidateModel->userId;       
        /* -- End-- Insert to m_user_master table */

        if(!empty($lastInsertedId)){
          $res++;
         /* -- Start-- Insert to candidate details table */
        $objCandidateDetailModel= new CandidateModel();
        $objCandidateDetailModel->userId =$lastInsertedId;
        $objCandidateDetailModel->experience=(!empty($candidatebDetails[7]))?$candidatebDetails[7]:'';
        $objCandidateDetailModel->firstName =(!empty($candidatebDetails[8]))?$candidatebDetails[8]:'';
        $objCandidateDetailModel->middleName =(!empty($candidatebDetails[9]))?$candidatebDetails[9]:'';
        $objCandidateDetailModel->lastName =(!empty($candidatebDetails[10]))?$candidatebDetails[10]:'';
        $objCandidateDetailModel->address =(!empty($candidatebDetails[11]))?$candidatebDetails[11]:'';
        $objCandidateDetailModel->pin =(!empty($candidatebDetails[12]))?$candidatebDetails[12]:'';
        $objCandidateDetailModel->state =(!empty($candidatebDetails[13]))?$candidatebDetails[13]:'';
        $objCandidateDetailModel->city =(!empty($candidatebDetails[14]))?$candidatebDetails[14]:'';       
        $objCandidateDetailModel->secondMob =(!empty($candidatebDetails[15]))?$candidatebDetails[15]:'';
        $objCandidateDetailModel->disablityType =(!empty($candidatebDetails[16]))?$candidatebDetails[16]:'';
        $objCandidateDetailModel->disabilitySubType =(!empty($candidatebDetails[17]))?$candidatebDetails[17]:'';
        $objCandidateDetailModel->createdBy =$lastInsertedId;
        $objCandidateDetailModel->candidateType=(!empty($candidatebDetails[18]))?$candidatebDetails[18]:'';
        $objCandidateDetailModel->save();   
        /* -- End-- Insert to candidate details table */

        /* -- Start-- Insert to candidate Experience table (If experienced then it will execute) */
       if(!empty($candidatebDetails[18]) && $candidatebDetails[18] == 2){       
        $designationList=(!empty($candidatebDetails[19]))?$candidatebDetails[19]:'';
        $desListData=array();
        if(!empty($designationList)){               
          $desListData = explode(',', $designationList);
        }      
        $cmpNameList=(!empty($candidatebDetails[20]))?$candidatebDetails[20]:'';
        $cmpNameListData=array(); 
        if(!empty($cmpNameList)){               
          $cmpNameListData = explode(',', $cmpNameList);
        }   
       
        $startYrList=(!empty($candidatebDetails[21]))?$candidatebDetails[21]:'';
        $startYrListData=array();
        if(!empty($startYrList)){               
          $startYrListData = explode(',', $startYrList);
        } 
                  
        $endYrList=(!empty($candidatebDetails[22]))?$candidatebDetails[22]:'';
        $endYrListData=array();
        if(!empty($endYrList)){               
          $endYrListData = explode(',', $endYrList);
        }
       
        $currentJobList=(!empty($candidatebDetails[23]))?$candidatebDetails[23]:'';
        $currentJobListData=array();   
        if(!empty($currentJobList)){            
          $currentJobListData = explode(',', $currentJobList);
        }     
        
    //  if(count($desListData) == count($cmpNameListData) && count($cmpNameListData) == count($startYrListData) && count($startYrListData) == count($currentJobListData)){
      
        foreach($desListData as $dkey=>$desListData){
          $objCandidateExperience = new CandidateExperienceModel();
          $objCandidateExperience->designation =$desListData;
          $objCandidateExperience->userId =$lastInsertedId;
          if(isset($cmpNameListData[$dkey])){
            $objCandidateExperience->companyName =$cmpNameListData[$dkey];
          }
          if(isset($currentJobListData[$dkey])){          
            $objCandidateExperience->currentJob =$currentJobListData[$dkey];
          }
        
          if(count($startYrListData) == 1) {
            $startYr = $startYrListData[0];
            $UNIX_EXPIRY_DATE = ($startYr - 25569) * 86400;
            $objCandidateExperience->startYear = gmdate("Y-m-d H:i:s", $UNIX_EXPIRY_DATE);        
          } else if(count($startYrListData) != 0 && count($startYrListData) > 1) {
            $startYr = $startYrListData[$dkey];
            $objCandidateExperience->startYear= $startYr;
          }
          
          if(count($endYrListData) == 1) {
            $endYr = $endYrListData[0]; 
            $UNIX_EXPIRY_DATE = ($endYr - 25569) * 86400;
            $objCandidateExperience->endYear = gmdate("Y-m-d H:i:s", $UNIX_EXPIRY_DATE);      
          } else if(count($endYrListData) != 0 && count($endYrListData) > 1) {
            $endYr = $endYrListData[$dkey]; 
            $objCandidateExperience->endYear = $endYr;
          }
        
          $objCandidateExperience->save();
      
        }         
     // }
    }
      /* -- End-- Insert to candidate Experience table */

      /* -- Start -- Import candidate Education Details */
      $educationNameList=(!empty($candidatebDetails[24]))?$candidatebDetails[24]:'';
      $educationNameListData=array(); 
      if(!empty($educationNameList)){             
        $educationNameListData = explode(',', $educationNameList);
      }    
      $boardNameList=(!empty($candidatebDetails[25]))?$candidatebDetails[25]:'';
      $boardNameListData=array();
      if(!empty($boardNameList)){              
        $boardNameListData = explode(',', $boardNameList);
      }     
      $mediumList=(!empty($candidatebDetails[26]))?$candidatebDetails[26]:'';
      $mediumListData=array();    
      if(!empty($mediumList)){         
        $mediumListData = explode(',', $mediumList);
      }      
      $scoreTypeList=(!empty($candidatebDetails[27]))?$candidatebDetails[27]:'';
      $scoreTypeListData=array(); 
      if(!empty($scoreTypeList)){            
        $scoreTypeListData = explode(',', $scoreTypeList);
      }
      $scoreList=(!empty($candidatebDetails[28]))?$candidatebDetails[28]:'';
      $scoreListData=array(); 
      if(!empty($scoreList)){            
        $scoreListData = explode(',', $scoreList);
      }
      $passYearList=(!empty($candidatebDetails[29]))?$candidatebDetails[29]:'';
      $passYearListData=array();  
      if(!empty($passYearList)){           
        $passYearListData = explode(',', $passYearList);
      }

      if(count($educationNameListData) == count($boardNameListData) && count($mediumListData) == count($scoreTypeListData) && count($scoreListData) == count($passYearListData)){
        foreach($educationNameListData as $ekey=>$educationId){
          $objCandidateEducation = new CandidateEducationModel();
          $objCandidateEducation->userId =$lastInsertedId;
          $objCandidateEducation->class =$educationId; 

          if($educationId == 1 || $educationId == 2) {      
          $objCandidateEducation->board =$boardNameListData[$ekey];
          } else {
            $objCandidateEducation->medium =$mediumListData[$ekey]; 
          }                  
          $objCandidateEducation->scoreType =$scoreTypeListData[$ekey];
          $objCandidateEducation->score =$scoreListData[$ekey];
          $objCandidateEducation->passYear =$passYearListData[$ekey];         
         $objCandidateEducation->save();        
      }
    }
     /* -- End -- Import candidate Education Details  */

      /* -- Start -- Import candidate Skill Details */
      $skillList=(!empty($candidatebDetails[30]))?$candidatebDetails[30]:'';
      if(!empty($skillList)){
        $skillListData=array();      
        $skillListData = explode(',', $skillList);
      }    
      $skillExpList=(!empty($candidatebDetails[31]))?$candidatebDetails[31]:'';
      if(!empty($skillExpList)){
        $skillExpListData=array();      
        $skillExpListData = explode(',', $skillExpList);
      }

      if(count($skillListData) == count($skillExpListData)){
        foreach($skillListData as $skey=>$skillId){
          $objCandidateSkill = new CandidateSkillModel();
          $objCandidateSkill->userId =$lastInsertedId;
          $objCandidateSkill->skillName =$skillId;         
          $objCandidateSkill->experienceYear =$skillExpListData[$skey];              
         $objCandidateSkill->save();  
         $res++;       
      }
    }
     /* -- End -- Import candidate Skill End */  
    $candidateEmailArr[]=$candidatebDetails[4];
    $randPwdArr[]=$randPwd;       
  }   

      
   //  $res++; 
        
    }  else {
          $res=0;     
          $duplicateEmail[]=$chkDup->emailId;
          $duplicateRows[] = $key;    
          }      
    } else {
      request()->session()->flash('error', 'Mandatory field data missing!'); 
      return redirect('application/import/importcandidate/'); 
    }
  }
    
    if($res>0){        
      DB::commit();    
     /* Sending Password in mail to each candidate */
      $ccmailAddress='';
      $bccmailAddress='';
      $subject='Candidate Registration Successful!';
      $attachment='';
      foreach($candidateEmailArr as $mkey=>$candidateEmail){
        $mailContent='Your email has been registered successfully.<br/>';
        $mailContent .='Below is your login details: <br/>';
        $mailContent .='Email :  '.$candidateEmail.'<br/>';
        $mailContent .='Password :  '.$randPwdArr[$mkey].'<br/>';
        $sendTo=$candidateEmail;
        sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);
      }     
      /* Send mail -- end -- */
      request()->session()->flash('success', 'Candidates added successfully!'); 
      return redirect('application/import/importcandidate/');  
    } else {
      if(!empty($duplicateEmail) && !empty($duplicateRows)){ 
        $dupEmail = implode(" , ",$duplicateEmail);  
        $dupRows = implode(" , ",$duplicateRows);  
        request()->session()->flash('error', 'Email id ' .$dupEmail. ' already registered! Please check in row no. - '.$dupRows);       
      } else {
        request()->session()->flash('error', 'Failed to Import Candidates!');  
      }
      DB::rollback();
      return redirect('application/import/importcandidate/');
    } 

   } catch (\Exception $e) {     
      DB::rollback();     
      array_push($errArr, $e->getMessage());
      $currentrow=(isset($currentRow[0]))?$currentRow[0]:'';
       request()->session()->flash('error', 'Errors: ' . implode(" , ",$errArr) . ' at row - ' . $currentrow); 
       return redirect('application/import/importcandidate/');      
  }                   
  }
  return view('application.importCandidate');
} 
}
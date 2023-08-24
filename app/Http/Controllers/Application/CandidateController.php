<?php

/* * ******************************************
  File Name     : CandidateController.php
  Description   : Controller file to display the Candidates list
  Created By    : Sangita Pratap
  Created On    : 02-Aug-2022

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
use App\Models\DisabilityModel;
use App\Models\CandidateModel;
use App\Models\CandidateExperienceModel;
use App\Models\CandidateEducationModel;
use App\Models\CandidateSkillModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use DB;
use Storage;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportCandidate;

class CandidateController extends AppController {
/* Candidate List Page -- Sangita Pratap -- 02-08-2022 -- */
public function index(){ 

      /* $userList=DB::table('m_user_master')      
      ->where([['tinUserType',3],['deletedFlag',0],['publishStatus',1]]); */
      $userList=DB::table('m_user_master as US')
      ->select('US.fullName','US.mobileNo','US.emailId','US.gender','US.DOB','DTL.*')
      ->leftjoin('t_candidate_details AS DTL','DTL.userId','=','US.userId','DTL.deletedFlag','=',0)
      ->where([['US.tinUserType',3],['US.deletedFlag',0],['US.publishStatus',1]]);
      // $userList = json_decode(json_encode($userList), TRUE);
 
      $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;    
    
      if($isViewAll==2){      
        $userList=$userList->get();
      }elseif($isViewAll==1){
        $userList=$userList->paginate(TOTPAGINATE);       
      }
  
  
      $this->viewVars['userList'] = $userList;
      $this->viewVars['startrec']  = $isViewAll;
 
    return view('application.candidateList',$this->viewVars);
}

/* For Candidate Details Page -- Sangita Pratap -- 02-08-2022 -- */
  public function candidateDetails($candidateId = 0){
    $candidateId=decrypt($candidateId); 
    $candidateDetls=DB::table('m_user_master as US')
    ->select('US.fullName','US.mobileNo','US.emailId','US.gender','US.DOB','DTL.*')
    ->leftjoin('t_candidate_details AS DTL','DTL.userId','=','US.userId','DTL.deletedFlag','=',0)
    ->where([['US.userId',$candidateId],['US.tinUserType',3],['US.deletedFlag',0]])->first();

    $candidateSkill = CandidateSkillModel::where([['userId',$candidateId]])->get();
    $candidateEdu = CandidateEducationModel::where([['userId',$candidateId]])->get();
    $candidateExp = CandidateExperienceModel::where([['userId',$candidateId]])->get();
    $candidateDisability = DisabilityModel::where([['disabilityId',$candidateDetls->disablityType]])->get();
                        
    $this->viewVars['candidateData'] = $candidateDetls;        
    $this->viewVars['candidateEdu'] = $candidateEdu;        
    $this->viewVars['candidateSkill'] = $candidateSkill;        
    $this->viewVars['candidateExp'] = $candidateExp;        
    $this->viewVars['disablityTypes'] = $candidateDisability;  
        
    return view('application.candidatedetails',$this->viewVars);
  }

  public function exportCandidates(){ 
    // echo 1111;exit;
    $fp = fopen('php://output', 'w');
    $filename = "Candidate_data.xlsx";

    $header = ["Sl No.","Name","Email","Mobile","DOB","Date of registration"];

    header('Content-type: application/xlsx');
            header('Content-Disposition: attachment; filename=' . $filename);
            fputcsv($fp, $header);
   
            $data = DB::table('m_user_master')->select(['fullName','emailId','mobileNo','dob', DB::raw('DATE(m_user_master.createdOn) as createdOn')])->where([['emailVerifyFlag','1'],['publishStatus','1'],['deletedFlag','0'],['tinUserType','3']])->get();

            $data = json_decode(json_encode($data),true);
            // echo'<pre>';print_r($data);exit;
            $ctr = 0;
            foreach ($data as $candidateData) {
              $ctr++;
              
            $rowcsv[0] = $ctr;
            $rowcsv[1] = $candidateData['fullName'];
            $rowcsv[2] = $candidateData['emailId'];
            $rowcsv[3] = $candidateData['mobileNo'];
            $rowcsv[4] = $candidateData['dob'];
            $rowcsv[5] = $candidateData['createdOn'];
            fputcsv($fp, $rowcsv);
          } 
          fclose($fp);
          exit(0);

          // return Excel::download(new ExportCandidate, 'Candidate_data.xlsx');
  }
}
<?php

/* * ******************************************
  File Name     : CandidateCvController.php
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

namespace App\Http\Controllers\Website;

use App\Http\Controllers\AppController;
use Session;
use Illuminate\Http\Request;
use Validator;
use DB;
use Storage;
// use Illuminate\Support\Facades\Crypt;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\CandidateExperienceModel;
use App\Models\CandidateEducationModel;
use App\Models\CandidateSkillModel;
use App\Models\DisabilityModel;
use Google\Service\CivicInfo\Candidate;
use PDF;

class CandidateCvController extends AppController {

  
  /* public function index ($candidateId = '') {
    $decrypted    = Crypt::decrypt($candidateId);
    $decryptarr   = explode("~::~",$decrypted);
    $candidateId  = $decryptarr[0];
   
    $candidateData = DB::table('m_user_master as US')
  ->select('US.fullName','US.mobileNo','US.emailId','US.gender','US.DOB','DTL.*')
  ->leftjoin('t_candidate_details AS DTL','DTL.userId','=','US.userId','DTL.deletedFlag','=',0)
  ->where([['US.userId',$candidateId],['US.tinUserType',3],['US.deletedFlag',0]])->get();

  $candidateSkill       = CandidateSkillModel::where([['userId',$candidateId]])->get();
  $candidateEdu         = CandidateEducationModel::where([['userId',$candidateId]])->get();
  $candidateExp         = CandidateExperienceModel::where([['userId',$candidateId]])->get();
  $candidateDisability  = DisabilityModel::where([['disabilityId',$candidateData[0]->disablityType]])->get();

 $this->viewVars['candidateData']    = $candidateData;        
  $this->viewVars['candidateEdu']     = $candidateEdu;        
  $this->viewVars['candidateSkill']   = $candidateSkill;        
  $this->viewVars['candidateExp']     = $candidateExp;        
  $this->viewVars['disablityTypes']   = $candidateDisability; 

    return view('website.CandidateCv', $this->viewVars);
  } */
  
  /* File Download */
  function downloadCv($candidateId = '') {
    $decrypted    = Crypt::decrypt($candidateId);
    $decryptarr   = explode("~::~",$decrypted);
    $candidateId  = $decryptarr[0];
   
    $candidateData = DB::table('m_user_master as US')
  ->select('US.fullName','US.mobileNo','US.emailId','US.gender','US.DOB','DTL.*')
  ->leftjoin('t_candidate_details AS DTL','DTL.userId','=','US.userId','DTL.deletedFlag','=',0)
  ->where([['US.userId',$candidateId],['US.tinUserType',3],['US.deletedFlag',0]])->get();

  $candidateSkill       = CandidateSkillModel::where([['userId',$candidateId]])->get();
  $candidateEdu         = CandidateEducationModel::where([['userId',$candidateId]])->get();
  $candidateExp         = CandidateExperienceModel::where([['userId',$candidateId]])->get();
  $candidateDisability  = DisabilityModel::where([['disabilityId',$candidateData[0]->disablityType]])->get();

 $this->viewVars['candidateData']    = $candidateData;        
  $this->viewVars['candidateEdu']     = $candidateEdu;        
  $this->viewVars['candidateSkill']   = $candidateSkill;        
  $this->viewVars['candidateExp']     = $candidateExp;        
  $this->viewVars['disablityTypes']   = $candidateDisability; 

  // echo'<pre>';print_R($this->viewVars['candidateEdu']);exit;
  $path = storage_path().'\app\uploads\candidateProfile\/';

  if(!Storage::exists($path)) {
    Storage::makeDirectory($path, $mode = 0777, true, true);
  }
  
  $filename= $candidateData[0]->firstName. '_'. $candidateData[0]->lastName . '_'. 'Cv'; 
  
   $pdf = PDF::loadView('website.candidateCv', $this->viewVars)->save(''.$path.'/'.$filename.'.pdf');
   return $pdf->download($filename.'.pdf');    

  //  return view('website.CandidateCv', $this->viewVars);
  }
}
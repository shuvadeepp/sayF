<?php

/* * ******************************************
  File Name     : AccountController.php
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
use Session;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Storage;
use App\Models\DisabledocModel;
use App\Models\MessageconvoModel;
use App\Models\MessageModel;
use App\Models\EmployerprofileModel;
use App\Models\DisabilitySubtypeModel;
use App\Models\PartnerprofileModel;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Response;

class AjaxController extends AppController {
    public function uploadfile(){
        $errFlag = 0;
        $errMsg = '';
        try {
          $fileObj        = request('title');
          $mimetype       = request($fileObj)->getMimeType();
          $FileSize       = request($fileObj)->getClientsize();
          $OrgFileName    = request($fileObj)->getClientOriginalName();
          $ext            = request()->$fileObj->getClientOriginalExtension();

          if($OrgFileName == ''){
              $errFlag++;
              $errMsg     = "No file has been uplaoded.";
          }else if (!in_array($mimetype, array('application/pdf', 'image/jpeg', 'image/png'))){
              $errFlag++;
              $errMsg     = "Invalid File Type!!!";
          }else if($ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "png" && $ext != "PNG" && $ext != "pdf" && $ext != "PDF" && $ext != "dwg" && $ext != "DWG"){
              $errFlag++;
              $errMsg    = "Invalid File Type!!!";
          }
          if($errFlag == 0) {
              $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
              $mainParentDir= $storagePath.'uploads';
              if(!file_exists($mainParentDir)){
                  \mkdir($mainParentDir, 0755);
              }
              $tempdirpath  = $storagePath.'uploads/temp';
              if(!file_exists($tempdirpath)){
                  \mkdir($tempdirpath, 0755);
              }
              $NewFileName = uniqid() . time() . '.' . request()->$fileObj->getClientOriginalExtension();
              //echo $tempdirpath;exit;
              //request()->file('employerPanfile')->move($pandirpath,$modifiypannme);
              if(request()->$fileObj->move('storage/app/uploads/temp/', $NewFileName)) {
              //if($fileObj->storeAs($tempdirpath, $NewFileName)) {
                  $response['status']       = 200;
                  $response['file']         = $NewFileName;
                  $response['fileOrg']      = $OrgFileName;
                  $response['fileTempUrl']  = ROOT_URL.'/storage/app/uploads/temp/'.$NewFileName;
              }else{
                  $response['status'] = 400;
                  $response['error'] = "Some error occured. Please try again";
              }
          }else{
              $response['status'] = 400;
              $response['error'] = $errMsg;
          }
        } catch (\Exception $e) {
            $response['status'] = 400;
            $response['error'] = "Some error occured. Please try again";
        }
        echo json_encode($response);
    }



    public function removetempfile(){
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        $validator   = \Validator::make($requestData, [
                          'fileName'           => 'bail|required|regex:/^[\w,\s-]+\.[A-Za-z]{3,4}$/',
                        ]);
        if($validator->fails()) {
          $respArr = array('status' => 500, 'msg' => $validator->errors());
          return response()->json($respArr);
        }else{
          @unlink('storage/app/uploads/temp/'.$requestData['fileName']);
          $respArr = array('status' => 200, 'msg' => 'File Deleted successfully');
          return response()->json($respArr);
        }
      }else{
        $respArr = array('status' => 500, 'msg' => 'Sorry!! something went wrong');
        return response()->json($respArr);
      }
    }
    public function candidatePersonalinfo(){
        $requestData = request()->all();
        $validator   = \Validator::make($requestData, [
            'txtFName' => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:20',
            'txtMName' => 'bail|max:20',
            'txtLName' => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:20',
            'txtAddress' => 'bail|required',
            'txtPin' => 'bail|required|numeric',
            'txtCity' => 'bail|required|max:20',
            'selState' => 'bail|required',
            'txtMobile' => 'bail|required|numeric',
            'txtSecMobile' => 'nullable|numeric',            
            'selGender' => 'bail|required',            
            'txtDOBDate' => 'bail|required',  
            'profileCV' => 'mimes:pdf,doc,docx|max:1024',  
            'fileProfileImg' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:1024'        
                ], 
            ['txtFName.required' => 'First name is required',
              'txtFName.regex'   => 'First name should be alphanumeric',
              'txtFName.max'     => 'First name should be 20 character',
              'txtMName.max'     => 'Middle name should be 20 character',
              'txtLName.required' => 'Last name is required',
              'txtLName.regex'   => 'Last name should be alphanumeric',
              'txtLName.max'     => 'Last name should be 20 character',
              'txtAddress.required' => 'Address is required',
              'txtPin.required' => 'Pin is required',
              'txtPin.numeric'  => 'Please enter a valid pin number',
              'txtCity.required' => 'City is required',
              'selState.required' => 'State is required',
              'txtEmail.required' => 'Email is required',
              'txtEmail.email'    => 'Please enter a valid email address',              
              'txtEmail.max'       => 'Email should be 128 character',
              'txtMobile.required' => 'Primary number required',
              'txtMobile.numeric'  => 'Please enter a valid primary number',
              'txtSecMobile.numeric'  => 'Please enter a valid secondary number',              
              'selGender.required'  => 'Gender is required',              
              'txtDOBDate.required'  => 'Date of birth is required', 
              'profileCV.mimes'=>'Profile CV should be pdf',        
              'profileCV.max'=>'Profile CV should not be more than 1 mb',         
              'fileProfileImg.required'=>'Profile image is required',
              'fileProfileImg.mimes' => 'Profile image should be jpg,png,jpeg,gif',
              'fileProfileImg.max'   => 'Profile image should not be more than 1 mb',             
    ]);
        if($validator->fails()){
            return Response::json(array(
                    'success' => false,
                    'errors' => $validator->errors()
                ), 406);
        }
        else{
            
            $txtFName        = request('txtFName');
            $txtMName        = request('txtMName');
            $txtLName        = request('txtLName');
            $txtAddress      = request('txtAddress');
            $txtPin        = request('txtPin');
            $txtCity        = request('txtCity');
            $selState        = request('selState');
            $txtMobile        = request('txtMobile');
            $txtSecMobile        = request('txtSecMobile');
            $hidprofileImg        = request('hidprofileImg');
            $hiddbprofileImg        = request('hiddbprofileImg');
            $selGender        = request('selGender');
            $txtDOBDate        = request('txtDOBDate');
            $hidprofileCV        = request('hidprofileCV');
            $hiddbprofileCV        = request('hiddbprofileCV');
            if($txtMName){
                $fullName=$txtFName.' '.$txtMName.' '.$txtLName;
            }else{
                $fullName=$txtFName.' '.$txtLName;
            }        

            $candidateId= SESSION('candidate_session_data.userId');

            /***********************make dir if not exist************************************/
            $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
            $mainParentDir= $storagePath.'uploads';
            if(!file_exists($mainParentDir)){
                \mkdir($mainParentDir, 0755);
            }
            $docpath  = $storagePath.'uploads/candidateProfile';
            if(!file_exists($docpath)){
                \mkdir($docpath, 0755);
            }
            /******************************************************/
            //Upload Profile image
            //echo $hiddbprofileCV;
           // echo "<pre>";print_r($requestData);exit;
            
            if(!empty($requestData['hdnbase64file'])){
              
              if($requestData['hiddbprofileImg'] && $requestData['hiddbprofileImg'] !=''){
                  @unlink('storage/app/uploads/candidateProfile/'.$requestData['hiddbprofileImg']);
              }
              
              $image_parts        = explode(";base64,", $requestData['hdnbase64file']);
              $image_type_aux     = explode("image/", $image_parts[0]);
              $image_type         = $image_type_aux[1];
              $image_base64       = base64_decode($image_parts[1]);
       
              $newPath     = 'candidate'.time().'.png';
       
              $imageFullPath      = $docpath.'/'.$newPath;
       
              file_put_contents($imageFullPath, $image_base64);
              session(['candidate_session_data.image' => $newPath]);
            }else{
              $newPath = (!empty($requestData['hiddbprofileImg']))?$requestData['hiddbprofileImg']:'';
            }
            //echo $hidprofileCV;exit;
            
            //Upload CV
            if($hidprofileCV =='' && $hiddbprofileCV !=''){
                $newpathCV=$hiddbprofileCV;
            }else{
                $oldCV = 'storage/app/uploads/candidateProfile/'.$hiddbprofileCV;
                if($hiddbprofileCV != '' && file_exists($oldCV)){				
                    unlink($oldCV);
                }
                if($hidprofileCV){
                    $oldpathCV = 'storage/app/uploads/temp/'.$hidprofileCV;
                    $newpathCV = 'storage/app/uploads/candidateProfile/'.$hidprofileCV;
                    \File::move($oldpathCV, $newpathCV);
                }            
                $newpathCV=$hidprofileCV;
            }
           // echo $newpathCV;exit;

            DB::beginTransaction();
            try{
            DB::table('t_candidate_details')
                ->where([['userId',$candidateId]])
                ->update([
                    'firstName'=>$txtFName,
                    'middleName'=>$txtMName,
                    'lastName'=>$txtLName,
                    'address'=>$txtAddress,
                    'pin'=>$txtPin,
                    'city'=>$txtCity,
                    'state'=>$selState,
                    'secondMob'=>$txtSecMobile,
                    'profileImage'=>$newPath,
                    'profileCV'=>$newpathCV
                ]);

            DB::table('m_user_master')
                ->where([['userId',$candidateId]])
                ->update(['mobileNo'=>$txtMobile,
                    'fullName'=>$fullName,
                    'image'=>$newPath,
                    'gender'=>$selGender,
                    'DOB'=>date('Y-m-d', strtotime($txtDOBDate)),
                ]);

                $status   = 'Personal Information updated successfully';
                $errFlag  = 0;
                DB::commit(); 

            }
            catch(\Exception $e){
                DB::rollBack();
                $status   = 'Error Occured';
                $errFlag  = 1;
            } 
            return Response::json(array('success' => true, 'errFlag'=>$errFlag, 'status'=>$status), 200);
        }        
    }
    public function candidateFresher(){
        $candType        = request('candType');
        $candidateId= SESSION('candidate_session_data.userId');
        if($candType){
            DB::beginTransaction();
            try{
            DB::table('t_candidate_experience')->where('userId', $candidateId)->delete();
            DB::table('t_candidate_details')
                ->where([['userId',$candidateId]])
                ->update([
                    'candidateType'=>1
                ]);
                $status   = 'Experience updated successfully';
                $errFlag  = 0;
                DB::commit();
            }
            catch(\Exception $e){
                DB::rollBack();
                $status   = 'Error Occured';
                $errFlag  = 1;
            }
            return Response::json(array('success' => true, 'errFlag'=>$errFlag, 'status'=>$status), 200);
        }else{
            return Response::json(array('success' => true, 'errFlag'=>1, 'status'=>'Error occured!!'), 200);
        }
    }

    public function candidateExperience(){
        $allData        = request()->all();

        $validator   = \Validator::make($allData, [
            'txtDesignation.*' => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:30',
            'txtCompany.*' => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:30',
            'txtStartDate.*' => 'bail|required',
            'txtEndDate.*' => 'bail|required_if:hidChkCuurrentjob.*,==,0',           
                ], 
            ['txtDesignation.*.required' => 'Designation is required',
              'txtDesignation.*.regex'   => 'Designation should be alphanumeric',
              'txtDesignation.*.max'     => 'Designation should be 30 character',
              'txtCompany.*.required' => 'Company is required',
              'txtCompany.*.regex'   => 'Company should be alphanumeric',
              'txtCompany.*.max'     => 'Company should be 30 character',
              'txtStartDate.*.required' => 'Start date is required',
              'txtEndDate.*.required_if' => 'End date is required',           
    ]);
        if($validator->fails()){
            return Response::json(array(
                    'success' => false,
                    'errors' => $validator->errors()
                ), 406);
        }
        else{

            $candidateId= SESSION('candidate_session_data.userId');
            $totExpData=count($allData['txtDesignation']);
            if($totExpData > 0){
                for($i=0;$i<$totExpData;$i++){
                    $designation=$allData['txtDesignation'][$i];
                    $company=$allData['txtCompany'][$i];
                    $startDate=$allData['txtStartDate'][$i];
                    $enddate=$allData['txtEndDate'][$i];
                    $currentJob=$allData['hidChkCuurrentjob'][$i];

                    $insertExperience[]=['userId'=>$candidateId,
                        'designation'=>$designation,
                        'companyName'=>$company,
                        'startYear'=>date('Y-m-d', strtotime($startDate)),
                        'endYear'=>($enddate)?date('Y-m-d', strtotime($enddate)):NULL,
                        'currentJob'=>$currentJob
                    ];
                }
                DB::beginTransaction();
                try{
                    DB::table('t_candidate_details')
                        ->where([['userId',$candidateId]])
                        ->update([
                            'candidateType'=>2
                        ]);
                    DB::table('t_candidate_experience')->where('userId', $candidateId)->delete();
                    DB::table('t_candidate_experience')
                        ->insert($insertExperience);
                        $status  = 'Experience updated successfully';
                        $errFlag  = 0;
                        DB::commit(); 
            
                    }
                    catch(\Exception $e){
                        DB::rollBack();
                        $status   = 'Error Occured';
                        $errFlag  = 1;
                    } 
                    //echo json_encode($response);
                    return Response::json(array('success' => true, 'errFlag'=>$errFlag, 'status'=>$status), 200);
            }
        }
        
    }

    public function candidateEducation(){
        $allData        = request()->all();
        $candidateId= SESSION('candidate_session_data.userId');

        $validator   = \Validator::make($allData, [
            'selEducation.*' => 'bail|required',
            'selScoretype.*' => 'bail|required',
            'txtScore.*' => 'bail|required|numeric|between:0,100',
            'txtPassout.*' => 'bail|required|numeric',           
                ], 
            ['selEducation.*.required' => 'Select education type',
              'selScoretype.*.required' => 'Select score type',
              'txtScore.*.required'   => 'Score is required',
              'txtScore.*.between'     => 'Score should be between 0-100',
              'txtScore.*.numeric'     => 'Score should be numeric',
              'txtPassout.*.required' => 'Year of passing is required',
              'txtPassout.*.numeric' => 'Enter valid year of passing',     
    ]);
        if($validator->fails()){
            return Response::json(array(
                    'success' => false,
                    'errors' => $validator->errors()
                ), 406);
        }else{ 
            $totEduData=count($allData['selEducation']);
            if($totEduData > 0){
                /***********************make dir if not exist************************************/
                $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                $mainParentDir= $storagePath.'uploads';
                if(!file_exists($mainParentDir)){
                    \mkdir($mainParentDir, 0755);
                }
                $docpath  = $storagePath.'uploads/candidateEducation';
                if(!file_exists($docpath)){
                    \mkdir($docpath, 0755);
                }
                /******************************************************/
                for($i=0;$i<$totEduData;$i++){
                    $selEducation=$allData['selEducation'][$i];
                    $selBoard=($allData['selBoard'][$i]>0)?$allData['selBoard'][$i]:0;
                    $selMedium=$allData['selMedium'][$i];
                    $txtScore=$allData['txtScore'][$i];
                    $txtPassout=$allData['txtPassout'][$i];
                    $txtCourse=$allData['txtCourse'][$i];
                    $txtUniversity=$allData['txtUniversity'][$i];
                    $hidEduCert=$allData['hidEduCert'][$i];
                    $hiddbEduCert=$allData['hiddbEduCert'][$i];
                    $selScoretype=$allData['selScoretype'][$i];

                    if($hidEduCert =='' && $hiddbEduCert !=''){
                        $newPath=$hiddbEduCert;
                    }else{
                        $oldProfile = 'storage/app/uploads/candidateEducation/'.$hiddbEduCert;
                        if($hiddbEduCert != '' && file_exists($oldProfile)){				
                            unlink($oldProfile);
                        }
                        if($hidEduCert){
                            $oldpath = 'storage/app/uploads/temp/'.$hidEduCert;
                            $newpath = 'storage/app/uploads/candidateEducation/'.$hidEduCert;
                            \File::move($oldpath, $newpath);
                        }
                        $newPath=$hidEduCert;
                    }
                    $insertEducation[]=['userId'=>$candidateId,
                        'class'=>$selEducation,
                        'board'=>$selBoard,
                        'medium'=>$selMedium,
                        'score'=>$txtScore,
                        'passYear'=>$txtPassout,
                        'course'=>$txtCourse,
                        'university'=>$txtUniversity,
                        'certificate'=>$newPath,
                        'scoreType'=>$selScoretype
                    ];
                }
                DB::beginTransaction();
                try{
                    DB::table('t_candidate_education')->where('userId', $candidateId)->delete();
                    DB::table('t_candidate_education')
                        ->insert($insertEducation);
                        $status   = 'Education updated successfully';
                        $errFlag  = 0;
                        DB::commit(); 
            
                    }
                    catch(\Exception $e){
                        DB::rollBack();
                        $status   = 'Error Occured';
                        $errFlag  = 1;
                    } 
                    return Response::json(array('success' => true, 'errFlag'=>$errFlag, 'status'=>$status), 200);
            }
        }        
    }

    public function candidateSkill(){
        $allData        = request()->all();
        $candidateId= SESSION('candidate_session_data.userId');
        $allData        = request()->all();
        
        $validator   = \Validator::make($allData, [
            'txtSkill.*' => 'bail|required',
            'txtSkillExp.*' => 'bail|required|numeric',    
                ], 
            ['txtSkill.*.required' => 'Skill is required',
              'txtSkillExp.*.required' => 'Experience is required',
              'txtSkillExp.*.numeric' => 'Enter valid Experience',     
    ]);
        if($validator->fails()){
            return Response::json(array(
                    'success' => false,
                    'errors' => $validator->errors()
                ), 406);
        }
        else{
            $totSkillData=count($allData['txtSkill']);
            if($totSkillData > 0){
                /***********************make dir if not exist************************************/
                $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                $mainParentDir= $storagePath.'uploads';
                if(!file_exists($mainParentDir)){
                    \mkdir($mainParentDir, 0755);
                }
                $docpath  = $storagePath.'uploads/candidateSkill';
                if(!file_exists($docpath)){
                    \mkdir($docpath, 0755);
                }
                /******************************************************/
                for($i=0;$i<$totSkillData;$i++){
                    $txtSkill=$allData['txtSkill'][$i];
                    $txtSkillExp=$allData['txtSkillExp'][$i];
                    $hidskillCert=$allData['hidskillCert'][$i];
                    $hiddbskillCert=$allData['hiddbskillCert'][$i];
                    
                    if($hidskillCert =='' && $hiddbskillCert !=''){
                        $newPath=$hiddbskillCert;
                    }else{
                        
                        $oldProfile = 'storage/app/uploads/candidateSkill/'.$hiddbskillCert;
                        if($hiddbskillCert != '' && file_exists($oldProfile)){				
                            unlink($oldProfile);
                        }
                        if($hidskillCert){
                            $oldpath = 'storage/app/uploads/temp/'.$hidskillCert;
                            $newpath = 'storage/app/uploads/candidateSkill/'.$hidskillCert;
                            \File::move($oldpath, $newpath);
                        }
                        $newPath=$hidskillCert;                        
                
                    }
                    $insertSkill[]=['userId'=>$candidateId,
                        'skillName'=>$txtSkill,
                        'experienceYear'=>$txtSkillExp,
                        'skillCertificate'=>$newPath,
                    ];

                }
                
                DB::beginTransaction();
                try{
                    DB::table('t_candidate_skill')->where('userId', $candidateId)->delete();
                    DB::table('t_candidate_skill')
                        ->insert($insertSkill);

                    DB::table('t_candidate_details')
                        ->where('userId', $candidateId)
                        ->update(['finalSubmit'=>1]);

                        $status   = 'Skill updated successfully';
                        $errFlag  = 0;
                        DB::commit(); 
            
                    }
                    catch(\Exception $e){
                        DB::rollBack();
                        $status   = 'Error Occured';
                        $errFlag  = 1;
                    } 
                    //echo json_encode($response);
                    return Response::json(array('success' => true, 'errFlag'=>$errFlag, 'status'=>$status), 200);
            }
        }
        
    }


    public function disabilityinfo(){
      $requestData    = request()->all(); 
      $candidateId    = SESSION('candidate_session_data.userId');
      //$chkdisable     = implode(',',$requestData['chkdisable']);
      $validator   = \Validator::make($requestData, [
        'selDisability' => 'bail|required',
        'selPersentage' => 'bail|required',    
        'txtDisableCert' => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/',    
            ], 
            ['selDisability.required' => 'Select disability type',
              'selPersentage.required' => 'Select disability percentage',
              'txtDisableCert.required' => 'Enter disability certificate number',     
              'txtDisableCert.regex' => 'Disability certificate number should be alphanumeric',     
    ]);
        if($validator->fails()){
            return Response::json(array(
                    'success' => false,
                    'errors' => $validator->errors()
                ), 406);
        }else{
          $upldFiles      = $requestData['upldFiles'];
          $selDisability      = $requestData['selDisability'];
          $selSubDisability      = ($requestData['selSubDisability'])?$requestData['selSubDisability']:0;
          $selPersentage      = $requestData['selPersentage'];
          $txtDisableCert      = $requestData['txtDisableCert'];
          $updDisab       = DB::table('t_candidate_details')
                            ->where('userId', $candidateId)
                            ->update(['disablityType' => $selDisability,
                                  'disabilitySubType'=>$selSubDisability,
                                  'disabilityPercentage'=>$selPersentage,
                                  'disabilityCertificateNo'=>$txtDisableCert
                            ]);
          if(!empty($upldFiles)){
            $query = array();
            foreach ($upldFiles as $im => $vals) {
              $data = array('candidateId' => $candidateId, 'docFile' => $vals, 'createdBy' => $candidateId);
              array_push($query, $data);
            }

            if(!empty($query)){
              $countChild = \DB::table('t_disable_docs')->where('candidateId', '=', $candidateId)->count();
              //print_r($countChild);exit;
              if($countChild > 0){
                DB::table('t_disable_docs')->where('candidateId', $candidateId)->delete();
              }
              if(DisabledocModel::insert($query)){
                foreach ($query as $k => $v) {
                  if($v['docFile'] != ''){
                    /***********************make dir if not exist************************************/
                    $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                    $mainParentDir= $storagePath.'uploads';
                    if(!file_exists($mainParentDir)){
                        \mkdir($mainParentDir, 0755);
                    }
                    $docpath  = $storagePath.'uploads/disabilitydoc';
                    if(!file_exists($docpath)){
                        \mkdir($docpath, 0755);
                    }
                    /******************************************************/
                    $oldpath = 'storage/app/uploads/temp/'.$v['docFile'];
                    $newpath = 'storage/app/uploads/disabilitydoc/'.$v['docFile'];
                    if(file_exists($oldpath)){
                      \File::move($oldpath, $newpath);
                    }
                  }
                }
              }
            }
          }

            $fileDtls  = DB::table('t_disable_docs')
                      ->select('docId','candidateId','docFile')
                      ->where([['candidateId',$candidateId],['deletedFlag',0]])->get();
            $filelistArr = array();
            if($fileDtls->isNotEmpty()){
              foreach ($fileDtls as $fl => $fv) {
                # code...
                $respData = array('docFile' => $fv->docFile, 'docId' => $fv->docId);
                array_push($filelistArr, $respData);
              }
            }

            $respArr = array('status' => 200, 'msg' => 'File updated successfully.', 'filelistArr' => $filelistArr);
            return response()->json($respArr);
        }

      
    }

    public function removeexistingfile(){
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        $validator   = \Validator::make($requestData, [
                          'filenme'            => 'bail|required|regex:/^[\w,\s-]+\.[A-Za-z]{3,4}$/',
                          'fileId'             => 'bail|required|integer',
                        ]);
        if($validator->fails()) {
          $respArr   = array('status' => 500, 'msg' => $validator->errors());
          return response()->json($respArr);
        }else{
          if(DB::table('t_disable_docs')->where('docId', $requestData['fileId'])->delete()){
            @unlink('storage/app/uploads/disabilitydoc/'.$requestData['filenme']);
            $respArr = array('status' => 200, 'msg' => 'File Deleted successfully');
            return response()->json($respArr);
          }else{
            $respArr = array('status' => 500, 'msg' => 'Sorry!! something went wrong');
            return response()->json($respArr);
          } 
        }
      }else{
        $respArr     = array('status' => 500, 'msg' => 'Sorry!! something went wrong');
        return response()->json($respArr);
      }
    }

    public function loadskillsCand(){
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
            $getskills       = \DB::table('m_skills')
                                        ->select('skillsId','skillName')
                                        ->where('skillName', 'like', $typedStr . '%');
                                        
            
            $getskills   = $getskills->where([['deletedflag',0],['publishStatus',0]])->get();
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

    public function pushnewSkillCand(){
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        $validator   = \Validator::make($requestData, [
                          'newText'            => 'bail|required|regex:/[A-Za-z0-9 ]/'
                        ]);
        if($validator->fails()) {
          $respArr    = array('status' => 500, 'msg' => $validator->errors());
          return response()->json($respArr);
        }else{
          $newText        = $requestData['newText'];
          $chkDup         = \DB::table('m_skills')->where('skillName', '=', $newText)->count();
          //echo '<pre>';print_r($chkDup);exit;
          if(empty($chkDup)){
            $id = DB::table('m_skills')-> insertGetId(array(
                    'designationId' => 0,
                    'skillName'     => $newText,
                    'createdBy'     => session('employer_session_data.userId')
            ));
          }    
          $respArr      = array('status' => 200, 'resultid' => $id);
          return response()->json($respArr);                       
        }
      }else{
        $respArr      = array('status' => 500, 'msg' => 'Sorry!! something went wrong');
        return response()->json($respArr);
      }
    }

    public function loadMessagehistory(){
      //echo '<pre>';print_r(session()->all());exit;
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        $validator   = \Validator::make($requestData, [
                          'msgHead'            => 'bail|required|regex:/[0-9]/',
                          'userId'             => 'bail|required|regex:/[0-9]/'
                        ]);
          if($validator->fails()) {
            $respArr    = array('status' => 500, 'msg' => $validator->errors());
            return response()->json($respArr);
          }else{
            $msgHead       = $requestData['msgHead'];
            $userId        = $requestData['userId'];
            $getAllmessage = MessageconvoModel::select('*')
                                ->where([['convoHead',$msgHead]])
                                ->where([['deletedFlag',0]])->get();
            $responseArr   = array();              
            if($getAllmessage->isNotEmpty()){
              foreach ($getAllmessage as $ks => $vs) {
                if($vs['msgFrom'] != $userId){
                  if($vs->senderdtls->tinUserType == 2){
                    $name          = ($vs->senderdtls->employer->employerCompany)?$vs->senderdtls->employer->employerCompany:'';
                  }else if($vs->senderdtls->tinUserType == 4){
                    $name          = ($vs->senderdtls->partner->partnerName)?$vs->senderdtls->partner->partnerName:'';
                  }
                }else{
                  if($vs->receiverdtls->tinUserType == 2){
                    $name          = ($vs->receiverdtls->employer->employerCompany)?$vs->receiverdtls->employer->employerCompany:'';
                  }else if($vs->receiverdtls->tinUserType == 4){
                    $name          = ($vs->receiverdtls->partner->partnerName)?$vs->receiverdtls->partner->partnerName:'';
                  }
                }
                $dataArr     = array('msgId' => $vs['msgId'],'convoHead' => $vs['convoHead'],'msgFrom' => $vs['msgFrom'],'msgTo' => $vs['msgTo'],'msgText' => $vs['msgText'],'msgFile' => $vs['msgFile'],'readStatus' => $vs['readStatus'],'createdOn' => $vs['createdOn'],'companyName' => $name, 'candidateName' => session('candidate_session_data.fullName'), 'msgFileName' => $vs['msgOriginalFileName']);

                array_push($responseArr, $dataArr);
              }
              $respArr      = array('status' => 200, 'result' => $responseArr);
              return response()->json($respArr);
            }else{
              $respArr      = array('status' => 404, 'msg' => 'Sorry!! No Record Found');
              return response()->json($respArr);
            }                    
          }
      }
    }  


    public function submitchat(){
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        $regex1      = "/^[a-zA-Z0-9_\- \/+:!?,.@#$'\r\n]*$/";
        $validator   = \Validator::make($requestData, [
                          'hdnFromrecp'           => 'bail|required|regex:/[0-9]/',
                          'hdnTorecp'             => 'bail|required|regex:/[0-9]/',
                          'hdnChathead'           => 'bail|required|regex:/[0-9]/',
                          'msgarea'               => 'bail|required'
                        ]);
          if($validator->fails()) {
            $respArr    = array('status' => 500, 'msg' => $validator->errors());
            return response()->json($respArr);
          }else{
            //print_r($requestData);exit; 
            $sender              =   $requestData['hdnFromrecp'];
            $receiver            =   $requestData['hdnTorecp'];
            $chatHead            =   $requestData['hdnChathead'];
            $msgarea             =   (empty($requestData['hdnChatFileName']))?$requestData['msgarea']:'';
            $hdnChatFile         =   $requestData['hdnChatFile'];
            $hdnChatFileName     =   $requestData['hdnChatFileName'];
            $inputs              =   [];
            //$chkExisting         = MessageModel::select('*')->where('skillName', '=', $newText)->count();       
            //WHERE (respOne = 4 AND respTwo = 5) OR (respOne = 5 AND respTwo = 4);     
            $chkExisting         = MessageModel::where(function ($query) use ($sender,$receiver) {
                                                        $query->where([['respOne',$sender]])
                                                              ->Where([['respTwo',$receiver]]);
                                                    })->orwhere(function ($query) use ($sender,$receiver){
                                                        $query->where([['respOne',$receiver]])
                                                              ->Where([['respTwo',$sender]]);
                                                    })->count(); 

            if($chkExisting > 0){
              $MessageconvoModel            = new MessageconvoModel;
              $MessageconvoModel->convoHead = $chatHead;
              $MessageconvoModel->msgFrom   = $sender;
              $MessageconvoModel->msgTo     = $receiver;
              $MessageconvoModel->msgText   = $msgarea;
              $MessageconvoModel->msgFile   = $hdnChatFile;
              $MessageconvoModel->msgOriginalFileName   = $hdnChatFileName;
              $MessageconvoModel->createdBy = $sender;
              //$data->save();
              if($MessageconvoModel->save()){
                if(!empty($hdnChatFile)){

                    $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                    $mainParentDir= $storagePath.'uploads';
                    if(!file_exists($mainParentDir)){
                        \mkdir($mainParentDir, 0755);
                    }
                    $docpath  = $storagePath.'uploads/chatFiles';
                    if(!file_exists($docpath)){
                        \mkdir($docpath, 0755);
                    }

                    $tempFile = 'storage/app/uploads/temp/'.$hdnChatFile;
                    $newFile = 'storage/app/uploads/chatFiles/'.$hdnChatFile;
                    \File::move($tempFile, $newFile);
                }
                DB::table('t_msg_convo_head')->where('convHeadId', $chatHead)->update(array('updatedOn' => date('Y-m-d H:i:s')));
                $respArr      = array('status' => 200, 'msg' => 'Record added successfully');
                return response()->json($respArr);
              }else{
                $respArr      = array('status' => 500, 'msg' => 'Sorry!! Something went wrong');
                return response()->json($respArr);
              }
            }else{
              //fresh insert
              $MessageModel                 = new MessageModel;
              $MessageModel->respOne        = $sender;
              $MessageModel->respTwo        = $receiver;
              $MessageModel->createdBy      = $sender;
              $MessageModel->createdOn      = date('Y-m-d H:i:s');
              $MessageModel->updatedOn      = date('Y-m-d H:i:s');
              if($MessageModel->save()){
                $headId                       = $MessageModel->convHeadId;
                $MessageconvoModel            = new MessageconvoModel;
                $MessageconvoModel->convoHead = $headId;
                $MessageconvoModel->msgFrom   = $sender;
                $MessageconvoModel->msgTo     = $receiver;
                $MessageconvoModel->msgText   = $msgarea;
                $MessageconvoModel->msgFile   = $hdnChatFile;
                $MessageconvoModel->msgOriginalFileName   = $hdnChatFileName;
                $MessageconvoModel->createdBy = $sender;
                if($MessageconvoModel->save()){
                  if(!empty($hdnChatFile)){

                      $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                      $mainParentDir= $storagePath.'uploads';
                      if(!file_exists($mainParentDir)){
                          \mkdir($mainParentDir, 0755);
                      }
                      $docpath  = $storagePath.'uploads/chatFiles';
                      if(!file_exists($docpath)){
                          \mkdir($docpath, 0755);
                      }

                      $tempFile = 'storage/app/uploads/temp/'.$hdnChatFile;
                      $newFile = 'storage/app/uploads/chatFiles/'.$hdnChatFile;
                      \File::move($tempFile, $newFile);
                  }   
                  $respArr      = array('status' => 200, 'msg' => 'Record added successfully', 'convoHead' => $headId);
                  return response()->json($respArr);
                }
              }else{
                $respArr      = array('status' => 500, 'msg' => 'Sorry!! Something went wrong');
                return response()->json($respArr);
              }
            }                                                   
          }
      }
    }



    public function initiatechathead(){

      if(!empty(request()->all()) && request()->isMethod('post')) {

        $requestData   = request()->all();  
        $validator     = \Validator::make($requestData, [
                           'senderId'            => 'bail|required|regex:/[0-9]/',
                           'receiverId'          => 'bail|required|regex:/[0-9]/'
                         ]);
          if($validator->fails()) {
            $respArr                            = array('status' => 500, 'msg' => $validator->errors());
            return response()->json($respArr);
          }else{
            $senderId                           = $requestData['senderId'];
            $receiverId                         = $requestData['receiverId'];
            $userType                           = AdminModel::select('tinUserType')->where([['userId',$receiverId]])->where([['deletedFlag',0]])->first();
            if($userType->tinUserType == 2){
              $employerDtls                     = EmployerprofileModel::select('companyLogo','employerCompany')
                                                 ->where([['employerId',$receiverId]])
                                                 ->where([['deletedFlag',0]])->first();
              $responseArr                      = array();              
              if(!empty($employerDtls)){
                $logodirpath                    = STORAGE_PATH.'companylogo';

                if(Storage::disk('local')->exists('/uploads/companylogo/' . $employerDtls->companyLogo) && $employerDtls->companyLogo != ''){
                  $logofullpath                 = $logodirpath.'/'.$employerDtls->companyLogo;
                }else{
                  $logofullpath                 = PUBLIC_PATH.'images/user-avatar-placeholder.png';
                }
                $responseArr['profileImage']    = $logofullpath;
                $responseArr['receiver']        = $employerDtls->employerCompany;
                $respArr                        = array('status' => 200, 'result' => $responseArr);
                return response()->json($respArr);
              }else{
                $respArr                        = array('status' => 500, 'msg' => 'Sorry!! No such recode found.');
                return response()->json($respArr);                    
              }                                 
            }else if($userType->tinUserType == 4){
              $partnerDtls                      = PartnerprofileModel::select('companyLogo','partnerName')
                                                  ->where([['partnerId',$receiverId]])
                                                  ->where([['deletedFlag',0]])->first();
              $responseArr                      = array();              
              if(!empty($partnerDtls)){
                $logodirpath                    = STORAGE_PATH.'partnerlogo';

                if(file_exists(storage_path().'/app/uploads/partnerlogo/'.$partnerDtls->companyLogo)){
                  $logofullpath                 = $logodirpath.'/'.$partnerDtls->companyLogo;
                }else{
                  $logofullpath                 = PUBLIC_PATH.'images/user-avatar-placeholder.png';
                }
                $responseArr['profileImage']    = $logofullpath;
                $responseArr['receiver']        = $partnerDtls->partnerName;
                $respArr  = array('status' => 200, 'result' => $responseArr);
                return response()->json($respArr);
              }else{
                $respArr  = array('status' => 500, 'msg' => 'Sorry!! No such recode found.');
                return response()->json($respArr);                    
              }                                 
            }


            /*$companyDtls                      = EmployerprofileModel::select('companyLogo','employerCompany')
                                               ->where([['employerId',$receiverId]])
                                               ->where([['deletedFlag',0]])->get();
                                               //echo '<pre>';print_r($companyDtls);exit;
            $responseArr                      = array();              
            if($companyDtls->isNotEmpty()){
              $logodirpath                    = STORAGE_PATH.'companylogo';
              $abslogopath                    = storage_path().'\/companylogo\/'.$companyDtls[0]->companyLogo;

              if(file_exists(storage_path().'/app/uploads/companylogo/'.$companyDtls[0]->companyLogo)){
                $logofullpath                 = $logodirpath.'/'.$companyDtls[0]->companyLogo;
              }else{
                $logofullpath                 = PUBLIC_PATH.'images/user-avatar-placeholder.png';
              }
              $responseArr['companyLogo']     = $logofullpath;
              $responseArr['employerCompany'] = $companyDtls[0]->employerCompany;
              $respArr                        = array('status' => 200, 'result' => $responseArr);
              return response()->json($respArr);
            }else{
              $respArr                        = array('status' => 500, 'msg' => 'Sorry!! No such recode found.');
              return response()->json($respArr);                    
            }*/
          }
      }
    } 



    public function uploadTempChatFile(){
        $errFlag = 0;
        $errMsg = '';
        if(!empty(request()->all()) && request()->isMethod('post')) {
          $requestData  = request()->all();  
          // echo "<pre>";print_r($requestData);exit;
          if(request()->hasFile('chat_attach_file')){

            $fileObj        = request('chat_attach_file');
            $mimetype       = request('chat_attach_file')->getMimeType();
            $FileSize       = request('chat_attach_file')->getClientsize();
            $OrgFileName    = request('chat_attach_file')->getClientOriginalName();
            $ext            = request('chat_attach_file')->getClientOriginalExtension();

            if($OrgFileName == ''){
                $errFlag++;
                $errMsg     = "No file has been uplaoded.";
            }else if (!in_array($mimetype, array('application/pdf', 'image/jpeg', 'image/png'))){
                $errFlag++;
                $errMsg     = "Invalid File Type!!!";
            }else if($ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "png" && $ext != "PNG" && $ext != "pdf" && $ext != "PDF" && $ext != "dwg" && $ext != "DWG"){
                $errFlag++;
                $errMsg    = "Invalid File Type!!!";
            }

          if($errFlag == 0) {
              $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
              $mainParentDir= $storagePath.'uploads';
              if(!file_exists($mainParentDir)){
                  \mkdir($mainParentDir, 0755);
              }
              $tempdirpath  = $storagePath.'uploads/temp';
              if(!file_exists($tempdirpath)){
                  \mkdir($tempdirpath, 0755);
              }
             $NewFileName = uniqid() . time() . '.' . request('chat_attach_file')->getClientOriginalExtension();
              if(request('chat_attach_file')->move('storage/app/uploads/temp/', $NewFileName)) {
                  $response['status']       = 200;
                  $response['file']         = $NewFileName;
                  $response['fileOrg']      = $OrgFileName;
                  $response['fileTempUrl']  = ROOT_URL.'/storage/app/uploads/temp/'.$NewFileName;
              }else{
                  $response['status'] = 400;
                  $response['error'] = "Some error occured. Please try again";
              }
          }else{
              $response['status'] = 401;
              $response['error'] = $errMsg;
          }
        }else{
          $response['status'] = 402;
          $response['error'] = "Some error occured. Please try again";
        }
      }else{
        $response['status'] = 403;
        $response['error'] = "Some error occured. Please try again";
      }
      echo json_encode($response);
    }

    public function choosSubDisability(){
      $disableId=request('disableId');
      $selectId=request('selectId');
      $html='';
      if($disableId > 0){
        $arrRes=DisabilitySubtypeModel::where([['deletedflag',0],['disabilityId',$disableId]])->get();
        if($arrRes->isNotEmpty()){
          $html='<option value="">Select</option>';
          foreach($arrRes as $arrRec){
            if($arrRec->disabilitySubtypeId==$selectId){ $select='selected';}else{$select='';}
            $html.='<option value='.$arrRec->disabilitySubtypeId.'  '.$select.'>'.$arrRec->disabilitySubType.'</option>';
          }
          echo json_encode(array('subType' => $html, 'status'=>'success'));
        }else{
          echo json_encode(array('subType' => '', 'status'=>'error'));
        }
      }
    }
}
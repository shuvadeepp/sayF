<?php

/* * ******************************************
  File Name     : MessagesController.php
  Description   : Controller file for managing all the ajax requests of Website and employer and employee
  Created By    : Samir Kumar
  Created On    : 27-Apr-2021

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

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\AppController;
use App\Models\MessageModel;
use App\Models\MessageconvoModel;
use App\Models\CandidateModel;
use App\Models\EmployerprofileModel;
use App\Models\AdminModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use DB;
use Storage;

class MessagesController extends AppController {
    public function index($reqSenderId = ''){
      $partnerId         = session('partner_session_data.userId');
      $getMessageThread  = MessageModel::select('*')
                          ->where([['respOne',$partnerId]])
                          ->orwhere([['respTwo',$partnerId]])
                          ->where([['deletedFlag',0]])
                          ->orderBy('updatedOn','DESC')
                          ->get();
      $this->viewVars['getMessageThread'] = $getMessageThread;                          
      $this->viewVars['reqSenderId'] = ($reqSenderId)?decrypt($reqSenderId):0;                          
      return view('partner.messages',$this->viewVars);      
    }

    public function loadMessagehistory(){
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
                  }else if($vs->senderdtls->tinUserType == 3){
                    $name          = ($vs->senderdtls->candidate->firstName)?$vs->senderdtls->candidate->firstName:'';
                  }
                }else{
                  if($vs->receiverdtls->tinUserType == 2){
                    $name          = ($vs->receiverdtls->employer->employerCompany)?$vs->receiverdtls->employer->employerCompany:'';
                  }else if($vs->receiverdtls->tinUserType == 3){
                    $name          = ($vs->receiverdtls->candidate->firstName)?$vs->receiverdtls->candidate->firstName:'';
                  }
                }
                $dataArr     = array('msgId' => $vs['msgId'],'convoHead' => $vs['convoHead'],'msgFrom' => $vs['msgFrom'],'msgTo' => $vs['msgTo'],'msgText' => $vs['msgText'],'msgFileName' => $vs['msgOriginalFileName'],'msgFile' => $vs['msgFile'],'readStatus' => $vs['readStatus'],'createdOn' => $vs['createdOn'],'candidateName' => $name, 'companyName' => session('partner_session_data.fullName'));

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

    public function sendMessage(){

      if(!empty(request()->all()) && request()->isMethod('post')) {

        $requestData = request()->all();  
        $regex1      = "/^[a-zA-Z0-9_\- \/+:,'!?.\r\n]*$/";
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
            $sender              =   $requestData['hdnFromrecp'];
            $receiver            =   $requestData['hdnTorecp'];
            $chatHead            =   $requestData['hdnChathead'];
            $msgarea             =   (empty($requestData['hdnChatFileName']))?$requestData['msgarea']:'';
            $hdnChatFile         =   $requestData['hdnChatFile'];
            $hdnChatFileName     =   $requestData['hdnChatFileName'];
            $inputs              =   [];
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
                }
                $respArr      = array('status' => 200, 'msg' => 'Record added successfully', 'convoHead' => $headId);
                return response()->json($respArr);
              }else{
                $respArr      = array('status' => 500, 'msg' => 'Sorry!! Something went wrong');
                return response()->json($respArr);
              }
            }                                                   
          }
      }
    }

    public function initiateChat(){
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData                          = request()->all();  
        $validator                            = \Validator::make($requestData, [
                                                   'senderId'     => 'bail|required|regex:/[0-9]/',
                                                   'receiverId' => 'bail|required|regex:/[0-9]/'
                                                 ]);
          if($validator->fails()) {
            $respArr                          = array('status' => 500, 'msg' => $validator->errors());
            return response()->json($respArr);
          }else{
            $senderId      = $requestData['senderId'];
            $receiverId    = $requestData['receiverId'];
            $userType      = AdminModel::select('tinUserType')->where([['userId',$receiverId]])->where([['deletedFlag',0]])->first();
            //echo '<pre>';print_r($userType);exit;
            if($userType->tinUserType == 2){
              $employerDtls    = EmployerprofileModel::select('companyLogo','employerCompany')
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

                /*if(file_exists(storage_path().'/app/uploads/companylogo/'.$employerDtls->companyLogo)){
                  $logofullpath                 = $logodirpath.'/'.$employerDtls->companyLogo;
                }else{
                  $logofullpath                 = PUBLIC_PATH.'images/user-avatar-placeholder.png';
                }*/
                $responseArr['profileImage']    = $logofullpath;
                $responseArr['receiver']        = $employerDtls->employerCompany;
                $respArr  = array('status' => 200, 'result' => $responseArr);
                return response()->json($respArr);
              }else{
                $respArr  = array('status' => 500, 'msg' => 'Sorry!! No such recode found.');
                return response()->json($respArr);                    
              }                                 
            }else if($userType->tinUserType == 3){
              $candidateDtls   = CandidateModel::select('profileImage','firstName','middleName','lastName')
                                               ->where([['userId',$receiverId]])
                                               ->where([['deletedFlag',0]])->first();
              $responseArr                      = array();              
              if(!empty($candidateDtls)){
                $logodirpath                    = STORAGE_PATH.'candidateProfile';

                if(file_exists(storage_path().'/app/uploads/candidateProfile/'.$candidateDtls->profileImage)){
                  $logofullpath                 = $logodirpath.'/'.$candidateDtls->compaprofileImagenyLogo;
                }else{
                  $logofullpath                 = PUBLIC_PATH.'images/user-avatar-placeholder.png';
                }
                $responseArr['profileImage']    = $logofullpath;
                if($candidateDtls->middleName != ''){
                  $responseArr['receiver']      = $candidateDtls->firstName.' '.$candidateDtls->lastName;
                }else{
                  $responseArr['receiver']      = $candidateDtls->firstName.' '.$candidateDtls->middleName.' '.$candidateDtls->lastName;
                }
                $respArr  = array('status' => 200, 'result' => $responseArr);
                return response()->json($respArr);
              }else{
                $respArr  = array('status' => 500, 'msg' => 'Sorry!! No such recode found.');
                return response()->json($respArr);                    
              }                                 
            }
            
            // echo '<pre>';print_r($candidateDtls);exit;
            /*$responseArr                      = array();              
            if(!empty($candidateDtls)){
              $logodirpath                    = STORAGE_PATH.'candidateProfile';
              $abslogopath                    = storage_path().'\/candidateProfile\/'.$candidateDtls->profileImage;

              if(file_exists(storage_path().'/app/uploads/candidateProfile/'.$candidateDtls->profileImage)){
                $logofullpath                 = $logodirpath.'/'.$candidateDtls->compaprofileImagenyLogo;
              }else{
                $logofullpath                 = PUBLIC_PATH.'images/user-avatar-placeholder.png';
              }
              $responseArr['profileImage']     = $logofullpath;
              if($candidateDtls->middleName != ''){
                $responseArr['candidateName'] = $candidateDtls->firstName.' '.$candidateDtls->lastName;
              }else{
                $responseArr['candidateName'] = $candidateDtls->firstName.' '.$candidateDtls->middleName.' '.$candidateDtls->lastName;
              }
              $respArr  = array('status' => 200, 'result' => $responseArr);
              return response()->json($respArr);
            }else{
              $respArr  = array('status' => 500, 'msg' => 'Sorry!! No such recode found.');
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

}
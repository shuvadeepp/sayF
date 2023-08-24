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
use App\Models\EmployerprofileModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use DB;
use Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EmployerprofileController extends AppController {

    public function index($encEmpId = null){
       $approvalUrl=0;
      // $employerId = session()->get('employer_session_data.userId'); 
      if(!empty($encEmpId)){
        $approvalUrl++;
        try {
          $decrypted = Crypt::decryptString($encEmpId);
          $decryptarr=explode("~::~",$decrypted);
          $employerId=$decryptarr[0]; 
      } catch (DecryptException $e) {
          //
      }     
    
      } else {
        $employerId = session()->get('employer_session_data.userId');
      }     
     
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all(); 
        // echo'<pre>';print_R($requestData);exit; 
        $EmployerprofileModel = new EmployerprofileModel();
       
        $regex       = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $regex1      = '/^[a-zA-Z0-9_\- \/+:,.!@&()\r\n]*$/';
        $validator   = \Validator::make($requestData, [
                          //'employerName'         => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:50', 
                          //'employerDesignation'  => 'required|image|mimes:jpg,png,jpeg,gif|max:1024'
                          'employerName'           => 'bail|required|regex:/^[a-zA-Z ]*$/|max:64',
                          'employerDesignation'    => 'nullable|regex:/^[a-zA-Z ]*$/|max:128',
                          'employerCompany'        => 'nullable|regex:/^[a-zA-Z ]*$/|max:128',
                          // 'employerWebsite'        => 'nullable|regex:'.$regex.'|max:128',
                          'employerWebsite'        => 'nullable|regex:'.$regex1,
                          //'employerLocation'     => 'nullable|regex:/^[0-9]*$/',
                          'employerLocation'       => 'bail|required',
                            'selcity'       => 'bail|required',
                          'employerSize'           => 'nullable|regex:/^[a-zA-Z0-9 -]*$/',
                          'pwdSizeHead'            => 'bail|required',
                          'pwdSize'                => 'nullable|numeric',
                          'employerIndustry'       => 'nullable|numeric',
                          //'employerPannumber'    => 'nullable|regex:/(^([a-zA-Z]{5})([0-9]{4})([a-zA-Z]{1})$)/|max:10',
                          'employerCompanyintro'   => 'nullable',
                          'employerCompanyaddr'    => 'nullable|regex:'.$regex1,
                          'companyLogo'            => 'nullable|image|mimes:jpg,png,jpeg,gif|max:10240',
                        ], 
                        [
                          'employerName.required'         => 'Employer Name is required',
                          'employerName.regex'            => 'Employer Name should be alphabetic',
                          'employerDesignation.regex'     => 'Employer Designation should be alphabetic',
                          'employerCompany.regex'         => 'Employer Company should be alphabetic',
                          'employerWebsite.regex'         => 'Please enter a valid website URL',
                          'employerLocation.required'     => 'Employer State is required',
                           'selcity.required'             => 'Employer City is required',
                          'employerPannumber.regex'       => 'Please enter a valid pan number',
                          'employerCompanyintro.regex'    => 'Please enter a valid company intro',
                          'employerCompanyaddr.regex'     => 'Please enter a valid registered address',
                          'companyLogo.mimes'             => 'Logo should be jpg,png,jpeg,gif',
                          'companyLogo.max'               => 'Logo should not be more than 10 Mb',
                        ]);
        if ($validator->fails()) {
            return redirect('employer/employerprofile')->withErrors($validator)->withInput();
        }else{
          $chkExisting      = EmployerprofileModel::where([['employerId', $employerId]])->first(); 
          $chkExistingDtl= json_decode(json_encode($chkExisting),true);
         
          $pwdSize = ($requestData['pwdSize']>0)?$requestData['pwdSize']:0;
          $employerLocation = '';
          if(!empty($requestData['employerLocation'])){
            $employerLocation = implode(",",$requestData['employerLocation']);
          }   
           $selcity='';
            if(!empty($requestData['selcity'])){
            $selcity = implode(",",$requestData['selcity']);
          }         
          if($chkExisting){
              //if(request()->hasFile('companyLogo')){
              if(!empty($requestData['hdnbase64file'])){
                //$logoFile       = request()->file('companyLogo');
                //$modifiylogonme = 'companyLogo'.time().'.'.$logoFile->getClientOriginalExtension();
                
                /***************create dir*******************/
                $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                $mainParentDir= $storagePath.'uploads';
                if(!file_exists($mainParentDir)){
                    \mkdir($mainParentDir, 0755);
                }
                $logodirpath  = $storagePath.'uploads/companylogo';
                if(!file_exists($logodirpath)){
                    \mkdir($logodirpath, 0755);
                }
                /**********************************/
                if($requestData['hdncompanyLogo'] && $requestData['hdncompanyLogo'] !=''){
                    @unlink('storage/app/uploads/companylogo/'.$requestData['hdncompanyLogo']);
                }
                //request()->file('companyLogo')->move($logodirpath,$modifiylogonme);
                $image_parts        = explode(";base64,", $requestData['hdnbase64file']);
                $image_type_aux     = explode("image/", $image_parts[0]);
                $image_type         = $image_type_aux[1];
                $image_base64       = base64_decode($image_parts[1]);
         
                $modifiylogonme     = 'companyLogo'.time().'.png';
         
                $imageFullPath      = $logodirpath.'/'.$modifiylogonme;
         
                file_put_contents($imageFullPath, $image_base64);
                session(['employer_session_data.companyLogo' => $modifiylogonme]);
              }else{
                $modifiylogonme = (!empty($requestData['hdncompanyLogo']))?$requestData['hdncompanyLogo']:'';
              }

              /*if(request()->hasFile('employerPanfile')){
                $panFile        = request()->file('employerPanfile');
                $modifiypannme  = 'employerPanfile'.time().'.'.$panFile->getClientOriginalExtension();
                
                $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                $mainParentDir= $storagePath.'uploads';
                if(!file_exists($mainParentDir)){
                    \mkdir($mainParentDir, 0755);
                }
                $pandirpath   = $storagePath.'uploads/panfiles';
                if(!file_exists($pandirpath)){
                    \mkdir($pandirpath, 0755);
                }
                if($requestData['hdnemployerPanfile'] && $requestData['hdnemployerPanfile'] !=''){
                    @unlink('storage/app/uploads/panfiles/'.$requestData['hdnemployerPanfile']);
                }
                request()->file('employerPanfile')->move($pandirpath,$modifiypannme);
              }else{
                $modifiypannme = (!empty($requestData['hdnemployerPanfile']))?$requestData['hdnemployerPanfile']:'';
              } */
            //  echo $selcity;exit;
              EmployerprofileModel::where('employerId', $employerId)
                  ->update([
                      'companyLogo'           => $modifiylogonme,
                      'employerName'          => $requestData['employerName'],
                      'employerDesignation'   => $requestData['employerDesignation'],
                      'employerCompany'       => $requestData['employerCompany'],
                      'employerWebsite'       => $requestData['employerWebsite'],
                      'employerLocation'      => $employerLocation,
                      'employerCity'          =>$selcity,
                      //'employerSkills'        => implode('/',$requestData['employerSkills']),
                      'employerSkills'        => $requestData['emplskill'],
                      'employerSize'          => $requestData['employerSize'],
                      'employerIndustry'      => $requestData['employerIndustry'],
                      //'employerPannumber'     => $requestData['employerPannumber'],
                      'pwdSizeHead'           => $requestData['pwdSizeHead'],
                      'pwdSize'               => $pwdSize,
                      //'employerPanfile'       => $modifiypannme,
                      'employerCompanyintro'  => $requestData['employerCompanyintro'],
                      'employerCompanyaddr'   => $requestData['employerCompanyaddr'],
                      'updatedBy'             => $employerId
                     // 'approvalTime' => date('Y-m-d H:i:s')
                  ]);
                  /* Sending mail to admin for existing user profile approval */
                  $timeDifference='';
                  $secondsDifference= strtotime(date('Y-m-d H:i:s'))-strtotime($chkExistingDtl['approvalTime']);
                  $timeDifference =intval($secondsDifference/60);

                  if($chkExistingDtl['approveStatus'] == 0 && $timeDifference > 2880){
                    $res= $this->employerApprovalMail($employerId);                   
                    if($res == 'success'){                    
                    request()->session()->flash('success', 'Record updated successfully and profile approval email has been sent to the Admin.');                   
                    return redirect('employer/employerprofile');   
                  } else {
                    request()->session()->flash('error', 'Something went wrong!');
                    return redirect('employer/employerprofile'); 
                  }
                  } else {
                    request()->session()->flash('success', 'Record updated successfully.');
                    return redirect('employer/employerprofile'); 
                  }
                  
          }else{
           // $approveStatus=0;
            //if(request()->hasFile('companyLogo')){
            if(!empty($requestData['hdnbase64file'])){
              //$logoFile       = request()->file('companyLogo');
              //$modifiylogonme = 'companyLogo'.time().'.'.$logoFile->getClientOriginalExtension();
              
              /***************create dir*******************/
              $storagePath        = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
              $mainParentDir      = $storagePath.'uploads';
              if(!file_exists($mainParentDir)){
                  \mkdir($mainParentDir, 0755);
              }
              $logodirpath        = $storagePath.'uploads/companylogo';
              if(!file_exists($logodirpath)){
                  \mkdir($logodirpath, 0755);
              }
              /**********************************/
              //request()->file('companyLogo')->move($logodirpath,$modifiylogonme);
              $image_parts        = explode(";base64,", $requestData['hdnbase64file']);
              $image_type_aux     = explode("image/", $image_parts[0]);
              $image_type         = $image_type_aux[1];
              $image_base64       = base64_decode($image_parts[1]);
       
              $modifiylogonme     = 'companyLogo'.time().'.png';
       
              $imageFullPath      = $logodirpath.'/'.$modifiylogonme;
       
              file_put_contents($imageFullPath, $image_base64);
              session(['employer_session_data.companyLogo' => $modifiylogonme]);
            }else{
              $modifiylogonme     = '';
            }

            /*if(request()->hasFile('employerPanfile')){
              $panFile        = request()->file('employerPanfile');
              $modifiypannme  = 'employerPanfile'.time().'.'.$panFile->getClientOriginalExtension();
              
              
              $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
              $mainParentDir= $storagePath.'uploads';
              if(!file_exists($mainParentDir)){
                  \mkdir($mainParentDir, 0755);
              }
              $pandirpath   = $storagePath.'uploads/panfiles';
              if(!file_exists($pandirpath)){
                  \mkdir($pandirpath, 0755);
              }
              
              request()->file('employerPanfile')->move($pandirpath,$modifiypannme);
            }else{
              $modifiypannme = '';
            } */
      //echo '<pre>';print_r($requestData);exit;
            $EmployerprofileModel->employerId           = $employerId;
            $EmployerprofileModel->companyLogo          = $modifiylogonme;
            $EmployerprofileModel->employerName         = $requestData['employerName'];
            $EmployerprofileModel->employerDesignation  = $requestData['employerDesignation'];
            $EmployerprofileModel->employerCompany      = $requestData['employerCompany'];
            $EmployerprofileModel->employerWebsite      = $requestData['employerWebsite'];
            $EmployerprofileModel->employerLocation     = $employerLocation;
            $EmployerprofileModel->employerCity         = $selcity;
            $EmployerprofileModel->employerSkills       = $requestData['emplskill'];//implode('/',$requestData['employerSkills']);
            $EmployerprofileModel->employerSize         = $requestData['employerSize'];
            $EmployerprofileModel->employerIndustry     = $requestData['employerIndustry'];
            $EmployerprofileModel->pwdSizeHead          = $requestData['pwdSizeHead'];
            $EmployerprofileModel->pwdSize              = $pwdSize;
            //$EmployerprofileModel->employerPannumber    = $requestData['employerPannumber'];
            //$EmployerprofileModel->employerPanfile      = $modifiypannme;
            $EmployerprofileModel->employerCompanyintro = $requestData['employerCompanyintro'];
            $EmployerprofileModel->employerCompanyaddr  = $requestData['employerCompanyaddr'];
            $EmployerprofileModel->createdBy            = $employerId;
           // $EmployerprofileModel->approvalTime = date('Y-m-d H:i:s');

            if($EmployerprofileModel->save()){

              /* Sending mail to dmin for new user profile approval */
              $res= $this->employerApprovalMail($employerId);
              if($res == 'success'){
                request()->session()->flash('success', 'Record updated successfully and profile approval email has been sent to the Admin.');           
                return redirect('employer/employerprofile');
              } else {
                request()->session()->flash('error', 'Sorry!!! something went wrong while updating.');
                return redirect('employer/employerprofile');
              }              
            }else{
              request()->session()->flash('error', 'Sorry!!! something went wrong');
              return redirect('employer/employerprofile');
            }
          }
        }
      }
      $skills                       = DB::table('m_skills')
                                      ->select('skillsId','skillName')
                                      ->where([['publishStatus',0],['deletedflag',0]])->get();

      $industries                   = DB::table('m_industrytype')
                                      ->select('industryId','industryName')
                                      ->where([['publishStatus',0],['deletedflag',0]])->get();


      $existingProfile              = DB::table('t_employer_profile')
                                      ->where([['deletedflag',0],['employerId', $employerId]])->get()->first();    
                                      // echo '<pre>';print_r($existingProfile);exit;  

       $locations  = DB::table('m_location')
                ->select('stateId','state')
                ->where('deletedflag',0)
                ->orderBy('state','ASC')
                ->groupBy('stateId','state')
                ->get();                                                                        
      $this->viewVars['skills']     = $skills; 
      // echo '<pre>';print_r($this->viewVars['skills']);exit;  
      $this->viewVars['industries'] = $industries;
      $this->viewVars['locations']  = $locations;
      $this->viewVars['existingProfile'] = $existingProfile;
      $this->viewVars['approvalUrl']=$approvalUrl;
      $this->viewVars['employerId']=$employerId;  
    //  $this->viewVars['approvalTime']=$existingProfile->approvalTime;
    // echo '<pre>'; print_r($this->viewVars); exit;
      return view('employer.employerProfile',$this->viewVars);      
    }

    public function removeProfileImage(){
      $empData  = EmployerprofileModel::where([['employerId', session()->get('employer_session_data.userId')]])->first();
      if(DB::table('t_employer_profile')->where('employerId', session()->get('employer_session_data.userId'))->update(array('companyLogo' => ''))){
        if($empData->companyLogo){
           @unlink('storage/app/uploads/companylogo/'.$empData->companyLogo);
        }
        echo json_encode(array('status'=>200,'msg'=>'Image removed successfully.'));
        
      }else{
        echo json_encode(array('status'=>400,'msg'=>'Something went wrong!try later.'));
      }
    }

    /* Employer approval mail send to super admin -- Sangita Pratap -- 18th May 2022 */ 
    public function employerApprovalMail($employerId){     

      EmployerprofileModel::where('employerId', $employerId)
            ->update([
              'approvalTime' => date('Y-m-d H:i:s')
            ]);

     // foreach($adminMails as $mails){    
       $encryptedurl = Crypt::encryptString($employerId.'~::~'.time());     
        $varurl='<a href='.ROOT_URL.'/profileapproval/'.$encryptedurl.'>Employer Profile</a>';
        $mailContent ='Dear Admin, <br/><br/>';
        $mailContent .='Click to view the : '. $varurl.' <br/><br/>';
        $mailContent .='Please review the profile within 48 hours. <br/><br/>';
         $ccmailAddress= '';
         $bccmailAddress='';
         $subject='Employer Profile Approval Request';
         $attachment='';
         $sendTo= APPROVAL_ADMIN; 
         $sendToAdmin= APPROVAL_ADMIN_CC; 
        $sendemail=sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);
         $sendAdminEmail=sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendToAdmin);
      // echo $mailContent; exit;
         if($sendAdminEmail==1)
         {  
           return 'success';         
         }
         else
         {
           return 'failed';          
         }     
    }  
}
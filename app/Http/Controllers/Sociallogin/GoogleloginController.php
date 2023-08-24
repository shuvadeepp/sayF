<?php

/* * ******************************************
File Name     : GoogleloginController.php
Description   : Controller file for managing all the Google login
Created By    : Shuvadeep Podder
Created On    : 11-Aug-2022

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

namespace App\Http\Controllers\Sociallogin;

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


class GoogleloginController extends AppController {

  public function socialLogin () {

    $requestData = request()->all();
    $signUp = $requestData['formType'];

   if(!empty($signUp)){
    session()->forget('form_type');
    session(['form_type' => $signUp]);
   }
   
    $clientID     = '685976981395-k7rmf2pm3irrhneogtifbq6hhkll27qq.apps.googleusercontent.com';
    $clientSecret = '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';
    $redirectUri  = 'http://localhost:7001/the-say-foundation/sociallogin/Googlelogin/googleLog';
    // $redirectUri  = 'https://thesayfoundation.com/sociallogin/Googlelogin/googleLog';
      
    // create Client Request to access Google API
    $client = new \Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");
    
    $redirectUrl= $client->createAuthUrl();
   // return redirect($redirectUrl);
    echo $redirectUrl;
    // echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";  
      
  }

  public function googleLog ($type=''){
   $status = [];
   $formType = session('form_type');
  
    $reqData = request()->all();
    //print_r($reqData);exit;
    $clientID     = '685976981395-k7rmf2pm3irrhneogtifbq6hhkll27qq.apps.googleusercontent.com';
    $clientSecret = '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';
    $redirectUri  = 'http://localhost:7001/the-say-foundation/sociallogin/Googlelogin/googleLog';
	// $redirectUri  = 'https://thesayfoundation.com/sociallogin/Googlelogin/googleLog';
      
    // create Client Request to access Google API
    $client = new \Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);

    //echo $reqData['code'];exit;
    $token = $client->fetchAccessTokenWithAuthCode($reqData['code']);

    $client->setAccessToken($token['access_token']);
    
    // get profile info
    $google_oauth = new \Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email  =  $google_account_info->email;
    $name   =  $google_account_info->name;
 

    $adminModel = new AdminModel();

        if (!empty($email) && !empty($name)) {
          //DB::enableQueryLog();
        
          $getCandidateData = AdminModel::from('m_user_master AS A')
            ->selectRaw('A.*,B.location, B.experience, B.firstName, B.middleName, B.lastName, B.address, B.pin, B.city, B.state, B.secondMob, B.profileImage, B.disablityType, B.profileCV, B.createdOn, B.createdBy, B.updatedOn, B.updatedBy, B.deletedFlag, B.candidateType, B.selLocation, B.finalSubmit, B.disabilitySubType, B.disabilityPercentage, B.disabilityCertificateNo')
            ->leftjoin('t_candidate_details AS B','A.userId','=','B.userId','B.deletedFlag','=',0)
            ->where([['emailId',$email],['publishStatus',1]])
            ->orWhere('loginId', $email)
            ->first();
           //echo'<pre>';print_r($getCandidateData['registerType']);exit;
		   //echo'<pre>';print_r($getCandidateData);exit;
          if(!empty($getCandidateData) && $formType == 'signUp') {         
            session()->forget('form_type');
            request()->session()->flash('error', 'Sorry!!! This email Id is already registered.');
            return redirect('candidate/register');
          } elseif(empty($getCandidateData) && $formType == 'signUp') {
            /* Insert */
            $insrtSocial = new AdminModel;
            $insrtSocial  -> fullName       = $name;
            $insrtSocial  -> emailId        = $email;
            $insrtSocial  -> loginId        = $email;
            $insrtSocial  -> password       = '';
            $insrtSocial  -> tinUserType    = 3;
            $insrtSocial  -> registerType   = 2;
            $insrtSocial  -> createdOn      = now();

            $insrtSocial -> save();

            $getdata = $insrtSocial->userId;
              
            $getCandidateInsrtData = AdminModel::from('m_user_master AS A')
            ->selectRaw('A.*,B.location, B.experience, B.firstName, B.middleName, B.lastName, B.address, B.pin, B.city, B.state, B.secondMob, B.profileImage, B.disablityType, B.profileCV, B.createdOn, B.createdBy, B.updatedOn, B.updatedBy, B.deletedFlag, B.candidateType, B.selLocation, B.finalSubmit, B.disabilitySubType, B.disabilityPercentage, B.disabilityCertificateNo')
            ->leftjoin('t_candidate_details AS B','A.userId','=','B.userId','B.deletedFlag','=',0)
            ->where([['emailId',$email],['publishStatus',1]])
            ->orWhere('loginId', $email)
            ->get()->toArray();

            session()->forget('getCandidateData');          
            session(['candidate_session_data' => $getCandidateInsrtData[0]]);
            return redirect('candidate/dashboard');  
            // echo '<pre>';print_r($getCandidateInsrtData);exit;           
            
          } elseif(!empty($getCandidateData) && $formType == 'signIn' && $getCandidateData['tinUserType']) {  

            $getCandidateInsrtData = AdminModel::from('m_user_master AS A')
            ->selectRaw('A.*,B.location, B.experience, B.firstName, B.middleName, B.lastName, B.address, B.pin, B.city, B.state, B.secondMob, B.profileImage, B.disablityType, B.profileCV, B.createdOn, B.createdBy, B.updatedOn, B.updatedBy, B.deletedFlag, B.candidateType, B.selLocation, B.finalSubmit, B.disabilitySubType, B.disabilityPercentage, B.disabilityCertificateNo')
            ->leftjoin('t_candidate_details AS B','A.userId','=','B.userId','B.deletedFlag','=',0)
            ->where([['emailId',$email],['publishStatus',1]])
            ->orWhere('loginId', $email)
            ->get()->toArray();
          
              if ($getCandidateData['registerType'] == 2) { 
                session()->forget('form_type');
                session()->forget('getCandidateData');          
                
                session(['candidate_session_data' => $getCandidateInsrtData[0]]);
                  $this->viewVars['status'] = 0;
                  $this->viewVars['reenter']= 1;
                  return redirect('candidate/dashboard');  
                
                
              } else if ($getCandidateData['registerType'] == 1) { 
                /* 1 - Portal, login popup */
                session()->forget('form_type');
                Session::flash('message', 'Sorry!!! This email Id is registered from Portal. Please Login Here!'); 
                Session::flash('alert-class', 'alert alert-danger'); 
                $this->viewVars['status'] = 1;
                $this->viewVars['reenter']= 1;
                Session::flash('is_candidate','1');
				
				        request()->session()->flash('error', 'Sorry!!! This email Id is registered from Portal. Please Login Here!');
				        return redirect('user-login');                  
                // return view('candidate.verifyOtp', $this->viewVars); 
              }

          } else if(empty($getCandidateData) && $formType == 'signIn') { 
            /* Not registerd Google Account. */
              session()->forget('form_type');
              return redirect('candidate/register')->withErrors('Sorry!!! This email Id is not registered yet.')->withInput();
              
          } else if (!empty($getCandidateData) && $formType == 'signIn' && $getCandidateData['tinUserType'] != 3 ) {
                session()->forget('form_type');
                Session::flash('message', 'Sorry!!! This email Id is registered from a diffrent user type!'); 
                Session::flash('alert-class', 'alert alert-danger'); 
                $this->viewVars['status'] = 1;
                $this->viewVars['reenter']=1;
                                
                return view('candidate.verifyOtp', $this->viewVars); 
          }   

        } else {
            /* something went: */
            session()->forget('form_type');   
            request()->session()->flash('error', 'Sorry!!! Something Went Wrong.');
            return redirect('candidate/register');       
        }
  }

   

}



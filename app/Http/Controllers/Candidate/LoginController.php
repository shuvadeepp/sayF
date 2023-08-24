<?php

/* * ******************************************
File Name     : LoginController.php
Description   : Controller file for managing login details for candidate
Created By    : Sandeep Kumar Senapati
Created On    : 06-Apr-2021

======================================================================
|Update History                                                      |
======================================================================
|<Updated by>                 |<Updated On> |<Remarks>
----------------------------------------------------------------------
|Name Goes Here               |DD-MMM-YYYY  |Remark goes here
----------------------------------------------------------------------
|Ananya Dash              |12-APR-2021  |forgetpassword,resetpassword,changepassword
----------------------------------------------------------------------

********************************************/

namespace App\Http\Controllers\Candidate;
use App\Http\Controllers\AppController;
use App\Models\AdminModel;
use App\Models\BannerModel;
use Session;
use Illuminate\Http\Request;
use App\Captcha\Securimage;
use Validator;
use DB;

class LoginController extends AppController {
 public function index(){
  $this->viewVars[]='';
  $this->viewVars['saveid']=0;
    $adminModel = new AdminModel();
    if(!empty(request()->all())) {

      $requestData = request()->all();  
      $validator   = Validator::make($requestData, [
                  'emailaddress' => 'bail|required|max:128',
                  'password' => 'bail|required'
                  // 'captcha' => 'bail|required'
                  //     ], ['userId.required' => 'User Id is required'
      ]);
        if ($validator->fails()) {
            return redirect('candidate/register')->withErrors($validator)->withInput();
        } else {
           // if ($requestData['captcha']) {
                // $image = new Securimage();
                // if ($image->check($requestData['captcha']) !== true) {
                //     $status['status'] = 'error';
                //     $status['error_msg'] = "Invalid Captcha Code";
                // } else {
                    $userName = $requestData['emailaddress'];
                    $password = md5($requestData['password']);
                    $getCandidateData = $adminModel->where([['loginId',$userName],['password',$password],['tinUserType',3],['publishStatus',1]])->get()->toArray();
                    if(empty($getCandidateData)){
                      $status['status'] = 'error';
                      $status['error_msg'] = "Invalid User Credential.";
                      return redirect('candidate/login')->with('error', $status['error_msg']);
                    }else{
                      session(['candidate_session_data' => $getCandidateData[0]]);
                      return redirect('candidate/dashboard');
                    }
               // }
           // }
            if ($status['status'] == 'error') {
                return redirect('candidate/login')->with('error', $status['error_msg'])->back()->withInput();
            } else {
                return view('candidate.candidateRegister',$this->viewVars);
            }
        }
      }


    return view('candidate.candidateRegister',$this->viewVars);
  }
  public function register(){
    $this->viewVars['location']='';
    $location  = DB::table('m_location')
                ->select('stateId','state')
                ->where('deletedflag',0)
                ->orderBy('state','ASC')
                ->groupBy('stateId','state')
                ->get();
    if(!empty($location)){
      $this->viewVars['location'] = $location;
    }
   
    $AdminModel    = new AdminModel();
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all(); 
      $validator   = \Validator::make($requestData, [
                  'txtName'                  => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:128',
                  'txtEmail'                 => 'bail|required|email|max:128',
                  'txtPhone'                 => 'bail|required|numeric',
                  'txtPassword'              => 'bail|required|required_with:cpassword|same:cpassword',
                  'cpassword'                => 'bail|required',
                  'selstate'                 => 'bail|required',
                  'selcity'                  => 'bail|required',
                  'selExperience'            => 'bail|required|numeric',
                  'acceptregistercandidate'  => 'bail|required|numeric'
                      ], 
                  ['txtName.required'        => 'Name is required',
                    'txtName.regex'          => 'Name should be alphabetic',
                    'txtName.max'            => 'Name should be 128 character',
                    'txtEmail.required'      => 'Email is required',
                    'txtEmail.email'         => 'Please enter a valid email address',
                    'txtEmail.max'           => 'Email should be 128 character',
                    'txtPhone.required'      => 'Phone is required',
                    'txtPhone.numeric'       => 'Please enter a valid phone number',
                    'txtPassword.required'   => 'Password is required',
                    'txtPassword.same'       => 'Password and confirm password must match',
                    'cpassword.required'     => 'Confirm password is required',
                    'selstate.required'      => 'State is required',
                    'selcity.required'       => 'City is required',
                    'selExperience.required' => 'Experience is required',
                    'selExperience.numeric'  => 'Experience should be a number',
                    'acceptregistercandidate.required'  => 'Please accept the terms and condition',
                    'acceptregistercandidate.numeric'   => 'Please accept the terms and condition'
      ]);
      if ($validator->fails()) {
            return redirect('candidate/register')->withErrors($validator)->withInput();
      }else{
          /*************************google recaptcha validation by :: samir kumar**********************************/
         /* $captcha = $requestData['g-recaptcha-response'];
          $ip  = $_SERVER['REMOTE_ADDR'];
          $key = env('RE_CAPTCHA_SERVER');
          $url = env('RE_CAPTCHA_VERIFY_URL');
          $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
          $data = json_decode($recaptcha_response);*/
         // if(isset($data->success) &&  $data->success === true) { 
             // $chkDup = AdminModel::where([['emailId',$requestData['txtEmail']],['tinUserType',3]])->orWhere('loginId', $requestData['txtEmail'])->orWhere('mobileNo', $requestData['txtPhone'])->first();
              $chkDup = AdminModel::where([['emailId',$requestData['txtEmail']],['tinUserType',3]])->orWhere('loginId', $requestData['txtEmail'], ['registerType', 1])->first();
// echo'<pre>';print_r($chkDup);exit;
             // if(!empty($chkDup) && $chkDup->mobileVerifyFlag==0){
              if(!empty($chkDup) && $chkDup->emailVerifyFlag==0){
                 // if($requestData['txtEmail'] == $chkDup->emailId && $requestData['txtPhone'] == $chkDup->mobileNo){
                  
                    if($requestData['txtEmail'] == $chkDup->emailId){
                      $otp=$chkDup->otp;
                      $mailContent='Your one time otp for registration is '.$otp;
                      $ccmailAddress='';
                      $bccmailAddress='';
                      $subject='Registration as Candidate';
                      $attachment='';
                      $sendTo=$requestData['txtEmail'];
                      sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);
                      request()->session()->flash('success', "One Time Password(OTP) has been sent to your Email, please enter the same here to register. <br> If you dont find the mail in your inbox then please check your spam folder.");
                      return redirect('candidate/verifyOtp/'.encrypt($chkDup->userId));
                  }else{
                     $status['status'] = 'error';
                     $status['error_msg'] = "Email already registered! Please use a different email id";
                     return redirect('candidate/register')->with('error', $status['error_msg'])->withInput();
                  }
              //}else if(!empty($chkDup) && $chkDup->mobileVerifyFlag==1){
              }else if(!empty($chkDup) && $chkDup->emailVerifyFlag==1){
                // echo 000;exit;
                
                    if ($chkDup->registerType == 2) {
                      // echo 9999;exit;
                      $status['status'] = 'error';
                      $status['error_msg'] = "Email already registered in Google Account! Please use a different email id";
                      return redirect('candidate/register')->with('error', $status['error_msg']);
                    } 
                    $status['status'] = 'error';
                    $status['error_msg'] = "Details already registered! Please use a different email id";
                    return redirect('candidate/register')->with('error', $status['error_msg'])->withInput();
              }else{
                    $otp=rand(1000,9999);
                    $AdminModel->fullName = $requestData['txtName'];
                    $AdminModel->mobileNo = $requestData['txtPhone'];
                    $AdminModel->emailId = $requestData['txtEmail'];
                    $AdminModel->loginId = $requestData['txtEmail'];
                    $AdminModel->password = md5($requestData['txtPassword']);
                    $AdminModel->tinUserType = 3;
                    $AdminModel->otp  = $otp;
                    $AdminModel->signMediumCertified  = $requestData['signMedium'];
                    // echo'<pre>';print_r($AdminModel);exit;
                    $AdminModel->save();
                    $lastInsertedId = $AdminModel->userId;
                    DB::table('t_candidate_details')
                      ->insert(['userId'=>$lastInsertedId,
                        'state'=>$requestData['selstate'],
                          'city'=>$requestData['selcity'],
                        'experience'=>$requestData['selExperience'],
                        'createdBy'=>$lastInsertedId
                    ]);
                    if($AdminModel->save()){
                          $mailContent='Your one time otp for registration is '.$otp;
                          $ccmailAddress='';
                          $bccmailAddress='';
                          $subject='Registration as Candidate';
                          $attachment='';
                          $sendTo=$requestData['txtEmail'];

                          // sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);
                          request()->session()->flash('success', "One Time Password(OTP) has been sent to your Email, please enter the same here to register. <br> If you dont find the mail in your inbox then please check your spam folder.");
                          return redirect('candidate/verifyOtp/'.encrypt($lastInsertedId));
                    }
              }
         /* }else{
            $status['status'] = 'error';
            $status['error_msg'] = "Invalid Captcha Code";
            return redirect('candidate/register')->with('error', $status['error_msg'])->withInput();
          } */
      }
    
     }
     $pageType ='19';
     $bannerList=BannerModel::where([['deletedflag',0],['publishStatus',0],['pageType',$pageType]])->orderBy('bannerId','ASC')->get();
     $this->viewVars['banners']  = $bannerList;     
  return view('candidate.candidateRegister',$this->viewVars);
}
public function logout() {
      \Auth::logout();
      request()->session()->flush();
      request()->session()->regenerate(true);
      $cookie         = \Cookie::forget('PHPSESSID');
      $laravelcookie  = \Cookie::forget('laravel_session');
      return redirect('/');
  }
  public function forgetpassword(){
    $adminModel = new AdminModel();
    if(!empty(request()->all()) && request()->isMethod('post')) {
    $requestData = request()->all();
    $validator   =  Validator::make($requestData, [
         'emailId'         => 'bail|required|email|max:128',
        // 'captcha'         => 'bail|required',
           ], [
            'emailId.required'          => 'Email is required',
            'emailId.email'             => 'Please Enter a valid email address',
            'emailId.max'               => 'Company Name should be 128 character',
           // 'captcha.required'          => 'Captcha is required',
      ]);
    if ($validator->fails()) {
        return redirect('candidate/forgetpassword')->withErrors($validator)->withInput();
    } else {
     // $image = new Securimage();
        // if($image->check($requestData['captcha']) !== true) {
        //     $status['status'] = 'error';
        //     $status['error_msg'] = "Invalid Captcha Code";
        //     return redirect('candidate/forgetpassword')->with('error', $status['error_msg']);
        // }else{
          $userName=$requestData['emailId'];
          $getCandidateData = $adminModel->where([['loginId',$userName],['tinUserType',3],['publishStatus',1]])->get()->toArray();
          // echo'<pre>';print_R($getCandidateData);exit;
          if(!empty($getCandidateData) && $getCandidateData[0]['registerType'] == 1){
           $encryptedurl = encrypt($getCandidateData[0]['userId'].'~::~'.time());
           $varurl='<a href='.ROOT_URL.'/employer/resetpassword/'.$encryptedurl.'> click here</a>';
            $mailContent='click on this link for Account Verification '. $varurl;
                $ccmailAddress='';
                $bccmailAddress='';
                $subject='Forget password for candidate';
                $attachment='';
                $sendTo=$getCandidateData[0]['loginId'];

                $sendemail=sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);
                if($sendemail==1)
                {
                  
                   request()->session()->flash('success', 'Link has been sent to your Emailid.');
                }
                else
                {
                  request()->session()->flash('error', 'Some error occured.');
                }
          } else if ( !empty($getCandidateData) && $getCandidateData[0]['registerType'] == 2 ) {
              request()->session()->flash('error', 'This Email Id is registered from Google Account.');
          } else{
              request()->session()->flash('error', 'Invalid Credentials.');
          }
      // }
     }
    } 
    $pageType ='20';
    $bannerList=BannerModel::where([['deletedflag',0],['publishStatus',0],['pageType',$pageType]])->orderBy('bannerId','ASC')->get();
    $this->viewVars['banners']  = $bannerList;
  return view('candidate.forgetpassword',$this->viewVars);
 }
public function resetpassword($url){
    $decryptarr=explode("~::~",decrypt($url));
    $timestamp=$decryptarr[1];
    $diffence=time()-$timestamp;
    $userid=$decryptarr[0];
    $hour=$diffence/(60*60*1000);
       if($hour>=1){
           request()->session()->flash('error', 'Your Link has been expired');
          return redirect('candidate/forgetpassword');
       }
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();
      $validator   =  Validator::make($requestData, [
       'newpassword'         => 'bail|required|required_with:conpassword|same:conpassword',
       'conpassword'         => 'bail|required',
      // 'captcha'         => 'bail|required',
         ], [
        'newpassword.required'          => 'New password is required',
        'newpassword.same'     => 'New Password and confirm password must match',
        'conpassword.required'          => 'Confirm password password is required',
       // 'captcha.required'          => 'Captcha is required',      
    ]);
       if ($validator->fails()) {
        return redirect('candidate/resetpassword/'.$url)->withErrors($validator)->withInput();
    } else {
      //  $image = new Securimage();
      //   if($image->check($requestData['captcha']) !== true) {
      //       $status['status'] = 'error';
      //       $status['error_msg'] = "Invalid Captcha Code";
            
      //       return redirect('candidate/resetpassword/'.$url)->with('error', $status['error_msg']);
      //   }else{
      $updatedata=AdminModel::where('userId', $userid)
                  ->update([
                      'password' => md5($requestData['newpassword'])
                  ]);
     if(!empty($updatedata))
     {
       request()->session()->flash('success', 'Password has been reset Successfully.');
       return redirect('candidate/register');
     }
   // }
  }
}
   return view('candidate.resetpassword');
}
public function changepassword(){
    $adminModel = new AdminModel();
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();
      $validator   =  Validator::make($requestData, [
       'oldpassword'         => 'bail|required',
       'newpassword'         => 'bail|required|required_with:conpassword|same:conpassword',
       'conpassword'         => 'bail|required',
     ], [
      'oldpassword.required'          => 'Current password is required',
      'newpassword.required'          => 'New password is required',
      'newpassword.same'              => 'Password And Confirm password should match.',
      'conpassword.required'          => 'Confirm password password is required',      
    ]);
      if ($validator->fails()) {
        return redirect('candidate/changepassword')->withErrors($validator)->withInput();
      }else{
        if(md5($requestData['oldpassword'])==md5($requestData['newpassword'])){
         $status['status'] = 'error';
         $status['error_msg'] = "New password should not be same as current password.";
         return redirect('candidate/changepassword')->with('error', $status['error_msg']);
       }else{
        $userid=session('candidate_session_data.userId');
        $getCandidateData = $adminModel->where([['userId',$userid],['tinUserType',3]])->get()->toArray();
        if(!empty($getCandidateData) && ($getCandidateData[0]['password']==md5($requestData['oldpassword']))){
          $updatedata=AdminModel::where('userId', $userid)
          ->update([
            'password' => md5($requestData['newpassword'])
          ]);
          if(!empty($updatedata)) {
           request()->session()->flash('success', 'Password has been reset Successfully.');
           return redirect('candidate/Dashboard');
         }
       }else{
         $status['status'] = 'error';
         $status['error_msg'] = "Incorrect Current Password";
         return redirect('candidate/changepassword')->with('error', $status['error_msg']);
       }
     }
  }
}
return view('candidate.changepassword');
}
public function verifyOtp($encid){
  $userid=decrypt($encid);
 // / echo $userid;exit;
   $this->viewVars['status']=0;
    $this->viewVars['reenter']=0;
  $adminModel = new AdminModel();
  $getEmployeerData=array();

  $getEmployeerData = $adminModel->where([['userId',$userid]])->get()->toArray();
  //print_r($getEmployeerData);exit;
   $this->viewVars['getEmployeerData']=$getEmployeerData;
   $data=request()->all();
   //if(!empty($getEmployeerData) && $getEmployeerData[0]['mobileVerifyFlag']==1)
   if(!empty($getEmployeerData) && $getEmployeerData[0]['emailVerifyFlag']==1)
   {
    $this->viewVars['status']=1;
   }
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();
      $validator   =  Validator::make($requestData, [
       'otpcandiate'         => 'bail|required',
         ], [
          'otpcandiate.required'          => 'otp is required',      
        ]);
      if ($validator->fails()) {
        return redirect('candidate/verifyOtp/'.$encid)->withErrors($validator)->withInput();
      }else{

         
          $updatedata=AdminModel::where([['userId',$userid],['otp',$data['otpcandiate']]])
          ->update([
            'publishStatus' => 1,
           // 'mobileVerifyFlag'=>1,
            'emailVerifyFlag'=>1
          ]);

          if(!empty($updatedata)){
            return redirect('user-login/2');
             $this->viewVars['status']=1;
         //  request()->session()->flash('success', 'OTP Verified successfully.');
         
          }else{
              $this->viewVars['status']=0;
                $this->viewVars['reenter']=1;
                 $status['status'] = 'error';
         $status['error_msg'] = "The OTP entered is incorrect.";
         return redirect('candidate/verifyOtp/'.$encid)->with('error', $status['error_msg']);
              //request()->session()->flash('error', 'The OTP entered is incorrect.');
          }
     }
  }
  //print_R($this->viewVars);exit;

 return view('candidate.verifyOtp', $this->viewVars);
 }

}

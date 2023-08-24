<?php

/* * ******************************************
File Name     : LoginController.php
Description   : Controller file for managing Employer
Created By    : Samir Kumar
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

namespace App\Http\Controllers\Employer;
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
        'emailidemployer' => 'bail|required|max:128',
        'passwordemployer' => 'bail|required'
      //   'captcha' => 'bail|required'
      // ], ['userId.required' => 'User Id is required'
    ]);
      if ($validator->fails()) {
        return redirect('employer/register')->withErrors($validator)->withInput();
      } else {
      //  if ($requestData['captcha']) {
          // $image = new Securimage();
          // if ($image->check($requestData['captcha']) !== true) {
          //   $status['status'] = 'error';
          //   $status['error_msg'] = "Invalid Captcha Code";
          // } else {
            $userName = $requestData['emailidemployer'];
            $password = md5($requestData['passwordemployer']);
            $getEmployeerData = AdminModel::from('m_user_master AS A')
                  ->selectRaw('A.*,B.companyLogo, B.employerName, B.employerDesignation, B.employerCompany, B.employerWebsite, B.employerLocation, B.employerSkills, B.employerSize, B.employerIndustry, B.employerPannumber, B.employerPanfile, B.employerCompanyintro, B.employerCompanyaddr')
                  ->leftjoin('t_employer_profile AS B','A.userId','=','B.employerId','B.deletedFlag','=',0)
                  ->where([['loginId',$userName],['password',$password],['tinUserType',2],['publishStatus',1]])->get()->toArray();
           
            if(empty($getEmployeerData)){
              $status['status'] = 'error';
              $status['error_msg'] = "Invalid User Credential.";
              return redirect('employer/login')->with('error', $status['error_msg']);
            }else{
              session(['employer_session_data' => $getEmployeerData[0]]);
              return redirect('employer/dashboard');
            }
         // }
      //  }
        if ($status['status'] == 'error') {
          return redirect('employer/login')->with('error', $status['error_msg']);
        } else {
          return view('employer.register',$this->viewVars);
        }
      }
    }
    return view('employer.register',$this->viewVars);
  }
  public function logout() {
    \Auth::logout();
    request()->session()->flush();
    request()->session()->regenerate(true);
    $cookie         = \Cookie::forget('PHPSESSID');
    $laravelcookie  = \Cookie::forget('laravel_session');
    return redirect('/');
  }
  public function register(){
   
    $adminModel = new AdminModel();
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $validator   =  Validator::make($requestData, [
        'fullName'        => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:128',
        'companyName'     => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:128',
        'emailId'         => 'bail|required|email|max:128',
        'phoneNo'         => 'bail|required|numeric',
        'password'        => 'bail|required|required_with:cpassword|same:cpassword',
        'cpassword'       => 'bail|required',
        'acceptregisteremployer'  => 'bail|required|numeric'
      ], [
        'fullName.required'         => 'Full name is required',
        'fullName.regex'            => 'Full name should be alphabetic',
        'fullName.max'              => 'Full name should be 128 character',
        'companyName.required'      => 'Company name is required',
        'companyName.regex'         => 'Company name should be alphabetic',
        'companyName.max'           => 'Company name should be 128 character',
        'emailId.required'          => 'Email is required',
        'emailId.email'             => 'Please enter a valid email address',
        'emailId.max'               => 'Email Id should be 128 character',
        'phoneNo.required'          => 'Phone Number is required',
        'phoneNo.numeric'           => 'Please enter a valid phone number',
        'password.required'         => 'Password is required',
        'password.same'             => 'The password and confirm password must match',
        'cpassword.required'        => 'Confirm password is required',
        'acceptregisteremployer.required'   => 'Please accept the terms and condition',
        'acceptregisteremployer.numeric'   => 'Please accept the terms and condition'
      ]);

      if($validator->fails()){
        return redirect('employer/register')->withErrors($validator)->withInput();
      }else{
         /*************************google recaptcha validation by :: samir kumar**********************************/
        /*  $captcha = $requestData['g-recaptcha-response'];
          $ip  = $_SERVER['REMOTE_ADDR'];
          $key = env('RE_CAPTCHA_SERVER');
          $url = env('RE_CAPTCHA_VERIFY_URL');
          $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
          $data = json_decode($recaptcha_response);
          if(isset($data->success) &&  $data->success === true) { */
          //  $chkDup           = AdminModel::where([['emailId',$requestData['emailId']],['tinUserType',2]])->orWhere('loginId', $requestData['emailId'])->orWhere('mobileNo', $requestData['phoneNo'])->first();
            $chkDup           = AdminModel::where([['emailId',$requestData['emailId']],['tinUserType',2]])->orWhere('loginId', $requestData['emailId'])->first();
         
            // if(!empty($chkDup) && $chkDup->mobileVerifyFlag==0){
              if(!empty($chkDup) && $chkDup->emailVerifyFlag==0){
                if($requestData['emailId'] == $chkDup->emailId && $requestData['phoneNo'] == $chkDup->mobileNo){
                    $otp=$chkDup->otp;
                    $mailContent='Your one time otp for registration is '.$otp;
                    $ccmailAddress='';
                    $bccmailAddress='';
                    $subject='Registration as Employer';
                    $attachment='';
                    $sendTo=$requestData['emailId'];
                    // sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);
                    request()->session()->flash('success', "One Time Password(OTP) has been sent to your Email, please enter the same here to register. <br> If you dont find the mail in your inbox then please check your spam folder.");
                    return redirect('employer/verifyOtp/'.encrypt($chkDup->userId));
                }else{
                   $status['status'] = 'error';
                   $status['error_msg'] = "Email already registered! Please use a different email id.";
                   return redirect('employer/register')->with('error', $status['error_msg'])->withInput();
                }
           // }else if(!empty($chkDup) && $chkDup->mobileVerifyFlag==1){
            }else if(!empty($chkDup) && $chkDup->emailVerifyFlag==1){
                $status['status'] = 'error';
                $status['error_msg'] = "Details already registered! Please use a different email id.";
                return redirect('employer/register')->with('error', $status['error_msg'])->withInput();
            }else{
              $otp=rand(1000,9999);
              $adminModel->fullName          = $requestData['fullName'];
              $adminModel->companyName       = $requestData['companyName'];
              $adminModel->emailId           = $requestData['emailId'];
              $adminModel->loginId           = $requestData['emailId'];
              $adminModel->mobileNo          = $requestData['phoneNo'];
              $adminModel->password          = md5($requestData['password']);
              $adminModel->tinUserType       = 2;
              $adminModel->otp               = $otp;
              $adminModel->signMediumCertified = $requestData['signMedium'];
              // echo'<pre>';print_r($adminModel);exit;
              if($adminModel->save()){
                $lastInsertedId = $adminModel->userId;
                $mailContent='Your one time otp for registration is '.$otp;
                $ccmailAddress='';
                $bccmailAddress='';
                $subject='Registration as Employer';
                $attachment='';
                $sendTo=$requestData['emailId'];
                // sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);
                request()->session()->flash('success', "One Time Password(OTP) has been sent to your Email, please enter the same here to register. <br> If you dont find the mail in your inbox then please check your spam folder.");
                  return redirect('employer/verifyOtp/'.encrypt($lastInsertedId));
              }else{
                request()->session()->flash('error', 'Sorry Something went wrong.');
              }
            }
         /* }else{
            $status['status'] = 'error';
            $status['error_msg'] = "Invalid Captcha Code";
            return redirect('employer/register')->with('error', $status['error_msg'])->withInput();
          }*/
      }
    }
    $pageType ='19';
    $bannerList=BannerModel::where([['deletedflag',0],['publishStatus',0],['pageType',$pageType]])->orderBy('bannerId','ASC')->get();
    $this->viewVars['banners']  = $bannerList;  
  //  return redirect('employer/verifyOtp/'.encrypt($lastInsertedId));
    return view('employer.register',$this->viewVars);
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
      //'captcha.required'          => 'Captcha is required',
    ]);
      if ($validator->fails()) {
        return redirect('employer/forgetpassword')->withErrors($validator)->withInput();
      } else {
        // $image = new Securimage();
        // if($image->check($requestData['captcha']) !== true) {
        //   $status['status'] = 'error';
        //   $status['error_msg'] = "Invalid Captcha Code";
        //   return redirect('employer/forgetpassword')->with('error', $status['error_msg']);
        // }else{
          $userName=$requestData['emailId'];
          $getEmployeerData = $adminModel->where([['loginId',$userName],['tinUserType',2],['publishStatus',1]])->get()->toArray();
        
          if(!empty($getEmployeerData)){
         //   request()->session()->flash('success', 'Your Account is already Verified.');          
         // }else{
           $encryptedurl = encrypt($getEmployeerData[0]['userId'].'~::~'.time());
           $varurl='<a href='.ROOT_URL.'/employer/resetpassword/'.$encryptedurl.'> click here</a>';
            $mailContent='click on this link for Account Verification '. $varurl;
                $ccmailAddress='';
                $bccmailAddress='';
                $subject='Forget password for Employer';
                $attachment='';
                $sendTo=$getEmployeerData[0]['loginId'];

                $sendemail=sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);
                if($sendemail==1)
                {
                  
                   request()->session()->flash('success', 'Link has been sent to your Emailid.');
                }
                else
                {
                  request()->session()->flash('error', 'Some error occured.');
                }
          
         }
         else{
          request()->session()->flash('error', 'Invalid Credentials.');
         }
      // }
     }
   }
   $pageType ='20';
   $bannerList=BannerModel::where([['deletedflag',0],['publishStatus',0],['pageType',$pageType]])->orderBy('bannerId','ASC')->get();
   $this->viewVars['banners']  = $bannerList;   
   return view('employer.forgetpassword',$this->viewVars);
 }

 public function resetpassword($url){
  $decryptarr=explode("~::~",decrypt($url));
  $timestamp=$decryptarr[1];
  $diffence=time()-$timestamp;
  $userid=$decryptarr[0];
  $hour=$diffence/(60*60*1000);
  if($hour>=1){
   request()->session()->flash('error', 'Your Link has been expired');
   return redirect('employer/forgetpassword');
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
    return redirect('employer/resetpassword/'.$url)->withErrors($validator)->withInput();
  } else {
  // $image = new Securimage();
  //  if($image->check($requestData['captcha']) !== true) {
  //   $status['status'] = 'error';
  //   $status['error_msg'] = "Invalid Captcha Code";
  //   return redirect('employer/resetpassword/'.$url)->with('error', $status['error_msg']);
  // }else{
    $updatedata=AdminModel::where('userId', $userid)
    ->update([
      'password' => md5($requestData['newpassword'])
    ]);
    if(!empty($updatedata))
    {
     request()->session()->flash('success', 'Password has been reset Successfully.');
     return redirect('employer/register');
   }
 //}
}
}
return view('employer.resetpassword');
}
public function changepassword()
{
    $adminModel = new AdminModel();
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();
      $validator   =  Validator::make($requestData, [
       'oldpassword'         => 'bail|required',
       'newpassword'         => 'bail|required|required_with:conpassword|same:conpassword',
       'conpassword'         => 'bail|required',
     ], [
      'oldpassword.required'          => 'Currentpassword is required',
      'newpassword.required'          => 'New password is required',
      'newpassword.same'              => 'Password And Confirm password should match.',
      'conpassword.required'          => 'Confirm password password is required',      
    ]);
      if ($validator->fails()) {
        return redirect('employer/changepassword/')->withErrors($validator)->withInput();
      }else{
        if(md5($requestData['oldpassword'])==md5($requestData['newpassword'])){
         $status['status'] = 'error';
         $status['error_msg'] = "New password should not be same as current password.";
         return redirect('employer/changepassword/')->with('error', $status['error_msg']);
       }
       else{
        $userid=session('employer_session_data.userId');
        $getEmployeerData = $adminModel->where([['userId',$userid],['tinUserType',2]])->get()->toArray();
        if(!empty($getEmployeerData) && ($getEmployeerData[0]['password']==md5($requestData['oldpassword']))){
          $updatedata=AdminModel::where('userId', $userid)
          ->update([
            'password' => md5($requestData['newpassword'])
          ]);
          if(!empty($updatedata)) {
           request()->session()->flash('success', 'Password has been reset Successfully.');
           return redirect('employer/Dashboard');
         }
       }else{
         $status['status'] = 'error';
         $status['error_msg'] = "Incorrect Current Password";
         return redirect('employer/changepassword/')->with('error', $status['error_msg']);
       }
     }
  }
}
return view('employer.changepassword');
}
public function verifyOtp($encid){
  
  $this->viewVars['status']=0;
  $this->viewVars['reenter']=0;
  $userid=decrypt($encid);
  //echo $userid;exit;

  $adminModel = new AdminModel();
  $getEmployeerData = $adminModel->where([['userId',$userid]])->get()->toArray();
   $this->viewVars['getEmployeerData']=$getEmployeerData;
    if($getEmployeerData[0]['emailVerifyFlag']==1)
   {
    $this->viewVars['status']=1;
   }
  $data=request()->all();
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();
      // print_r($requestData['otpemployeer']);exit;
      $validator   =  Validator::make($requestData, [
       'otpemployeer'         => 'bail|required',
     ], [
      'otpemployeer.required'          => 'otp is required',      
    ]);
      if ($validator->fails()) {
        return redirect('employer/verifyOtp/'.$encid)->withErrors($validator)->withInput();
      }else{
     
          $updatedata=AdminModel::where([['userId',$userid],['otp',$data['otpemployeer']]])
          ->update([
            'publishStatus' => 1,
            'emailVerifyFlag'=>1
          ]);

          if(!empty($updatedata)){
            return redirect('user-login/1');
             $this->viewVars['status']=1;
           //request()->session()->flash('success', 'OTP Verified successfully.');
         
          }else{
              $this->viewVars['status']=0;
              $this->viewVars['reenter']=1;
              $status['status'] = 'error';
         $status['error_msg'] = "The OTP entered is incorrect.";
         return redirect('employer/verifyOtp/'.$encid)->with('error', $status['error_msg']);

           //request()->session()->flash('error', 'The OTP entered is incorrect.');
          }
     }
  }

 return view('employer.verifyOtp', $this->viewVars);
 }
}

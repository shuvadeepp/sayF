<?php

/* * ******************************************
  File Name     : LoginController.php
  Description   : Controller file for managing all the ajax requests of Website and employer and employee
  Created By    : Samir Kumar
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

namespace App\Http\Controllers\Application;

use App\Http\Controllers\AppController;
use App\Models\AdminModel;
use Session;
use Illuminate\Http\Request;
use App\Captcha\Securimage;
use Validator;
use DB;

class LoginController extends AppController {
    public function index(){
      
      $adminModel = new AdminModel();
      if(!empty(request()->all()) && request()->isMethod('post')) {

        $requestData = request()->all();  
        //echo '<pre>';print_r($requestData);exit;
        $validator   = Validator::make($requestData, [
                    'userId' => 'bail|required|alphaNum|max:50',
                    'password' => 'bail|required',
                    //'captcha' => 'bail|required'
                        ], ['userId.required' => 'User Id is required'
        ]);
          if ($validator->fails()) {
              return redirect('application')->withErrors($validator)->withInput();
          } else {


               /*************************google recaptcha validation**********************************/
                // $captcha = $requestData['g-recaptcha-response'];
                // $ip  = $_SERVER['REMOTE_ADDR'];
                // $key = env('RE_CAPTCHA_SERVER');
                // $url = env('RE_CAPTCHA_VERIFY_URL');

                // // RECAPTCH RESPONSE
                // $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
                // $data = json_decode($recaptcha_response);
                //echo '<pre>';print_r($data);exit;

               // if(isset($data->success) &&  $data->success === true) {
                  $userName = $requestData['userId'];
                  $password = md5($requestData['password']);
                  $getAdminData = $adminModel->where([['loginId',$userName],['password',$password]])->get()->toArray();
                  //SanctionedFeeModel::find($arrPageData['int_Course_Id'][$i]);
                  //echo '<pre>';print_r($getAdminData);exit;
                  if(empty($getAdminData)){
                    $status['status'] = 'error';
                    $status['error_msg'] = "Invalid User Credential.";
                  }else{
                    //echo '<pre>';print_r($getAdminData);exit;
                    session(['admin_session_data' => $getAdminData[0]]);
                    return redirect('application/dashboard');
                  }
                // }else{
                //   $status['status'] = 'error';
                //   $status['error_msg'] = "Invalid Captcha Code";
                // }  

              /*if ($requestData['captcha']) {
                  $image = new Securimage();
                  if ($image->check($requestData['captcha']) !== true) {
                      $status['status'] = 'error';
                      $status['error_msg'] = "Invalid Captcha Code";
                  } else {
                      $userName = $requestData['userId'];
                      $password = md5($requestData['password']);
                      $getAdminData = $adminModel->where([['loginId',$userName],['password',$password]])->get()->toArray();
                      //SanctionedFeeModel::find($arrPageData['int_Course_Id'][$i]);
                      //echo '<pre>';print_r($getAdminData);exit;
                      if(empty($getAdminData)){
                        $status['status'] = 'error';
                        $status['error_msg'] = "Invalid User Credential.";
                      }else{
                        //echo '<pre>';print_r($getAdminData);exit;
                        session(['admin_session_data' => $getAdminData[0]]);
                        return redirect('application/dashboard');
                      }
                  }
              }*/
              if ($status['status'] == 'error') {
                  return redirect('application')->with('error', $status['error_msg']);
              } else {
                  return view('application.admin-login');
              }
          }
        }
      return view('application.admin-login');
    }


    public function logout() {
        \Auth::logout();
        request()->session()->flush();
        request()->session()->regenerate(true);
        $cookie         = \Cookie::forget('PHPSESSID');
        $laravelcookie  = \Cookie::forget('laravel_session');
        return redirect('/application');
    }
}

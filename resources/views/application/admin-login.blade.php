@extends('layouts.website')
@section('page-content')
<!-- <div class="page-wrapper align-items-center d-flex"> -->
	<div class="container">
    <div class="inner-page-baner">
      <img src="<?php echo PUBLIC_PATH; ?>images/banner1.png" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
        <strong>Login</strong> - <br> We are on a quest <br>to <strong>spread joy</strong>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6 offset-xl-3">
        <div class="utf-login-register-page-aera margin-bottom-50"> 
          <div class="utf-welcome-text-item">
            <h3>Login</h3>
		      </div>
          @include('components.admin-msg-tap')
          <form method="post" id="adminloginform">
            {{csrf_field()}}
            <div class="utf-no-border">
              <input type="text" class="utf-with-border" name="userId" id="userId" placeholder="User Name"/>
              <span class="errMsg_userId errDiv"></span>
            </div>
            <div class="utf-input-with-icon show-password">
              <input type="password" class="utf-with-border" name="password" id="admin_password" placeholder="Password"/>
               <i class="icon-feather-eye "></i>
               <span class="errMsg_admin_password errDiv"></span>
            </div>
            
            <div class="row">
                <div class="col-12">
                  <!-- <div id="admincap"></div> -->
                </div>
                <!-- <div class="col-12 mt-3"><span class="errMsg_acaptchacode errDiv"></span></div> -->
                    <!-- <div class="col-sm-6 no-padding-left">
                        <input type="text" maxlength="4" name="captcha" id="captcha" onkeypress="return isNumberKey(event);" class="utf-with-border" placeholder="Enter Code">
                        <span class="errMsg_captcha errDiv"></span>
                    </div>
                    <div class="col-sm-5 no-padding-right">
                        <div class="d-flex align-items-center" >
                            <label class="form-control input-md no-padding text-center p-0 mb-0" >
                                <img src="{{url('/')."/captcha"}}" alt="captcha image" 
 class="captchaImage" id="captchaImage">
                            </label>
                            <a href="javascript:void(0);" class="input-group-addon captchaRefresh ml-2" onClick="generateCaptcha()" ><span class="icon-feather-refresh-cw"></span></a>
                        </div>
                    </div> -->
                    <!-- <div class="clearfix"></div> -->
                </div>
          </form>
          <div class="text-center">
            <button class="button secondary" type="submit" onclick="return validatorapplication();" form="login-form">
              Log In 
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>  
<!-- </div> -->
<a style="display: none;" href="#small-dialog-2" onclick="return viewAlert('','','');" class="btn btn-alert-modal">open modal</a>
@include('components.admin-alert-modal')
@section('page-js')
<script>
  /*$(document).ready(function(){
    alert(SITE_URL)
  });*/
    $("#adminloginform").keyup(function(event){
                if(event.keyCode == 13){
                   validatorapplication();
                }
            });
  function generateCaptcha()
  {
      var ranNo = Math.floor((Math.random() * 100) + 1);
      $('.captchaImage').attr('src', SITE_URL + '/captcha?' + ranNo);
  }


  function validatorapplication()
  {
      if (!blankCheck('userId', 'User ID can not be left blank'))
          return false;
      if (!blankCheck('admin_password', 'Password can not be left blank'))
          return false;
      /*if (!blankCheck('captcha', 'Captcha can not be left blank'))
          return false;*/
      /*if (!maxLength('captcha', 4, 'Captcha'))
          return false;*/
      // var response = grecaptcha.getResponse(admincap);
      // if(response.length == 0){
      //   $('.errMsg_acaptchacode').html('Please check captcha').show();
      //   return false;
      // }    

      $('#adminloginform').submit();  
        
  }
</script>
@endsection
@endsection

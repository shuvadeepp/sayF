@extends('layouts.website')
@section('page-content')
<div class="page-wrapper align-items-center d-flex">
	<div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3">
        <div class="utf-login-register-page-aera margin-bottom-50"> 
          <div class="utf-welcome-text-item">
                <h3>Reset Password For Candidate!</h3>
          </div>
          @include('components.admin-msg-tap')
          
         
          <form method="post" id="reset-form" autocomplete="off">
            {{csrf_field()}}
              <div class="utf-input-with-icon show-password">
                <input type="password" class="utf-with-border" maxlength="32" name="newpassword" id="newpassword" placeholder="New Password">
                 <i class="icon-feather-eye "></i>
                 <span class="errMsg_newpassword errDiv"></span>
              </div>
             <div class="utf-input-with-icon show-password">
                <input type="password" class="utf-with-border" maxlength="32" name="conpassword" id="conpassword" placeholder="Confirm Password">
                 <i class="icon-feather-eye "></i>
                 <span class="errMsg_conpassword errDiv"></span>
              </div>
              <div class="form-group ">
                <div class="row">
                    <!-- <div class="col-sm-6 no-padding-left">
                        <input type="text" maxlength="4" name="captcha" id="captcha" onkeypress="return isNumberKey(event);" class="utf-with-border" placeholder="Enter Code">
                    </div>
                    <div class="col-sm-5 no-padding-right">
                        <div class="d-flex align-items-center" >
                            <label class="form-control input-md no-padding text-center p-0 mb-0" >
                                <img src="{{url('/')."/captcha"}}" alt="captcha image" 
 class="captchaImage" id="captcha">
                            </label>
                            <a href="javascript:void(0);" class="input-group-addon captchaRefresh ml-2" onClick="generateCaptcha()" ><span class="icon-feather-refresh-cw"></span></a>
                        </div>


                    </div>
                     <span class="errMsg_captcha errDiv"></span> -->
                    <div class="clearfix"></div>
                </div>
            </div>
             
          </form>
          <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit" style="width: 545px;" onclick="return validator();">Reset<i class="icon-feather-chevrons-right"></i></button>
        </div>
      </div>
    </div>

  </div>  
</div>
@section('page-js')
<script
>
  function validator()
  {
      $('.errDiv').hide();
      $('.error-input').removeClass('error-input');
      if (!blankCheck('newpassword', 'password can not be left blank'))
          return false;
      if (!blankCheck('conpassword', 'Confirm password can not be left blank'))
          return false;
      if (!matchpassword('newpassword', 'conpassword'))
          return false;  
      // if (!blankCheck('captcha', 'Captcha can not be left blank'))
      //     return false;
      // if (!maxLength('captcha', 4, 'Captcha'))
      //     return false;
      $('#reset-form').submit();  
        
  }
</script>
@endsection
@endsection

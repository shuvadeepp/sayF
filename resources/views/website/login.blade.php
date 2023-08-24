@extends('layouts.website')
@section('page-content')
<div class="page-wrapper align-items-center d-flex">
	<div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3">
        <div class="utf-login-register-page-aera margin-bottom-50"> 
          <div class="utf-welcome-text-item">
            <h3>Login</h3>
		      </div>
          <form method="post" id="login-form">
            <div class="utf-no-border">
              <input type="text" class="utf-with-border" name="emailaddress" id="emailaddress" placeholder="Email Address" required/>
            </div>
            <div class="utf-input-with-icon show-password">
              <input type="password" class="utf-with-border" name="password" id="password" placeholder="Password" required/>
              <i class="icon-feather-eye "></i>
            </div>

            <div class="utf-input-with-icon show-password">
              <input type="text" class="utf-with-border" name="captcha" id="password" placeholder="Password" required/>
              <i class="icon-feather-eye "></i>
            </div>
            
            <div class="form-group ">
                <div class="row">
                    <div class="col-sm-4 no-padding-left">
                        <input type="text" maxlength="10" name="captcha" id="captcha" class="form-control input-md" placeholder="Enter Code">
                    </div>
                    <div class="col-sm-8 no-padding-right">
                        <div class="input-group" >
                            <label class="form-control input-md no-padding text-center" style="padding: 0;">
                                <img src="{{url('/')."/captcha"}}" alt="captcha image" 
 class="captchaImage" id="captcha">
                            </label>
                            <a href="javascript:void(0);" class="input-group-addon captchaRefresh" onClick="generateCaptcha()" ><i class="fa fa-refresh"></i></a>
                        </div>


                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
          </form>
          <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form">Log In <i class="icon-feather-chevrons-right"></i></button>
          
        </div>
      </div>
    </div>
  </div>  
</div>
<script src="{{ asset('public/js/validatorchklist.js') }}"></script>
@endsection

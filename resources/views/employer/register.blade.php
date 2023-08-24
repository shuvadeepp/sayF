@extends('layouts.website')
@section('page-content')
<!-- <div class="page-wrapper align-items-center d-flex"> -->
	<div class="container">
    <div class="inner-page-baner">
    <?php if(isset($banners) && $banners->isNotEmpty()){ ?>
      <img src="<?php if(!empty($banners[0]->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banners[0]->bannerImage; } else{ echo PUBLIC_PATH.'images/banner1.png'; } ?>" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
          <strong>{{$banners[0]->bannerTitle}}</strong> - <br> {{$banners[0]->bannerText}}
      </div>
      <?php } else { ?>
      <img src="<?php echo PUBLIC_PATH; ?>images/banner1.png" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
        <strong>Employer Registration</strong> - <br>
        Get exclusive access to jobs, events, resources
      </div>
      <?php } ?>
    </div>
    <div class="row">
      <div class="col-xl-6 offset-xl-3">
        <div class="utf-login-register-page-aera  login-container"> 
          <div class="utf-welcome-text-item">
                <h3>Create Your New Account!</h3>
          </div>
          @include('components.admin-msg-tap')
         
          <!-- <div class="utf-account-type">
            <div>
              <a href="{{ROOT_URL}}/employer/register"></a>
                <input type="radio" name="utf-account-type-radio" id="freelancer-radio" class="utf-account-type-radio" checked="">
              <label for="freelancer-radio" data-tippy-placement="top" class="utf-ripple-effect-dark" data-tippy="" data-original-title="Employer"><i class="icon-material-outline-business-center"></i> Employer</label>
            </div>
            <div>
              <a href="{{ROOT_URL}}/candidate/register"></a>
                <input type="radio" name="utf-account-type-radio" id="employer-radio" class="utf-account-type-radio">
                <label for="employer-radio" data-tippy-placement="top" class="utf-ripple-effect-dark" data-tippy="" data-original-title="Candidate"><i class="icon-material-outline-account-circle"></i> Candidate</label>
            </div>
             <div>
              <a href="{{ROOT_URL}}/ngo/register"></a>
                <input type="radio" name="utf-account-type-radio" id="employer-radio" class="utf-account-type-radio" >
                <label for="employer-radio" data-tippy-placement="top" class="utf-ripple-effect-dark" data-tippy="" data-original-title="Candidate"><i class="icon-material-outline-account-circle"></i> NGO</label>
            </div>
          </div> -->

          <div class="radio-btn-group "> 
            <div class="custom-radio"> 
             <input type="radio" name="utf-account-type-radio" class="utf-account-type-radio" id="freelancer-radio"  checked="" value="employer">
              <label for="freelancer-radio" class="custom-radio-label"> 
                 Employer</label>
            </div> 
            <div class="custom-radio">           
                <input type="radio" name="utf-account-type-radio" class="utf-account-type-radio" id="employer-radio" value="candidate">
                <label for="employer-radio" class="custom-radio-label"> 
                  Candidate
                </label>
            </div>
            <div class="custom-radio"> 
                <input type="radio" name="utf-account-type-radio" class="utf-account-type-radio" id="ngo-radio" value="ngo">
                <label for="ngo-radio"  class="custom-radio-label">
                  NGO
                </label>
            </div>
          </div>
          
          <form method="post" id="utf-register-account-form" autocomplete="off">
            {{csrf_field()}}
            <div class="utf-no-border">
                <input type="text" class="utf-with-border" name="fullName" maxlength="128" id="fullName" placeholder="Name" value="{{old('fullName')}}" onkeypress="return isCharKey(event);">
                <span class="errMsg_fullName errDiv"></span>
              </div>
              <div class="utf-no-border">
                <input type="text" class="utf-with-border" name="companyName" maxlength="128" id="companyName" placeholder="Company Name" value="{{old('companyName')}}" onkeypress="return isCharKey(event);">
                  <span class="errMsg_companyName errDiv"></span>
              </div>
              <div class="utf-no-border">
                <input type="text" class="utf-with-border" maxlength="128" name="emailId" id="emailId" placeholder="Email Address" value="{{old('emailId')}}">
                 <span class="errMsg_emailId errDiv"></span>
              </div>
              <div class="utf-no-border">
                <input type="text" class="utf-with-border" name="phoneNo" id="phoneNo" onkeypress="return isNumberKey(event);" maxlength="16" placeholder="Phone Number" value="{{old('phoneNo')}}">
                  <span class="errMsg_phoneNo errDiv"></span>
              </div>
              <div class="utf-input-with-icon show-password">
                <input type="password" class="utf-with-border" maxlength="32" name="password" id="passwordemp" placeholder="Password">
                <i class="icon-feather-eye "></i>
                 <span class="errMsg_passwordemp errDiv"></span>
              </div>
             <div class="utf-input-with-icon show-password">
                <input type="password" class="utf-with-border" maxlength="32" name="cpassword" id="cpassword" placeholder="Confirm Password">
                <i class="icon-feather-eye "></i>
                 <span class="errMsg_cpassword errDiv"></span>
              </div>
              <div class="form-group ">
                <div class="row">
                  <div class="col-12">
                    <!-- <div id="employerregcap"></div> -->
                  </div>
                  <div class="col-sm-6 no-padding-left">
                    <!-- <span class="errMsg_captcha errDiv"></span> -->
                  </div>
                    <!-- <div class="col-sm-6 no-padding-left">
                        <input type="text" maxlength="4" name="captcha" id="captcha" onkeypress="return isNumberKey(event);" class="utf-with-border" placeholder="Enter Code">
                        <span class="errMsg_captcha errDiv"></span>
                    </div>
                    <div class="col-sm-5 no-padding-right">
                        <div class="d-flex align-items-center" >
                            <label class="form-control input-md no-padding text-center p-0 mb-0" >
                                <img src="{{url('/')."/captcha"}}" alt="captcha image" 
 class="captchaImage" id="captcha">
                            </label>
                            <a href="javascript:void(0);" class="input-group-addon captchaRefresh ml-2" onClick="generateCaptcha()" ><span class="icon-feather-refresh-cw"></span></a>
                        </div>


                    </div> -->
                    <div class="clearfix"></div>
                </div>
            </div>

            <!-- Added Sign Medium Cartified -->
              <div class="radio-btn-group">
                <label for="signMedium"> Sign Medium Certified ? </label>&nbsp;&nbsp;
                <div class="custom-radio">
                    <input type="radio" name="signMedium" class="utf-account-type-radio" id="signMediumYes" value="1">
                    <label for="signMediumYes" class="custom-radio-label"> Yes </label>
                </div>
                <div class="custom-radio">
                    <input type="radio" name="signMedium" class="utf-account-type-radio" id="signMediumNo" value="0" checked>
                    <label for="signMediumNo" class="custom-radio-label"> No </label>
                </div>
              </div>
            <!-- end -->

              <div class="checkbox mb-3">
                
                <input type="checkbox" id="two-step2" name="acceptregisteremployer" id="acceptregisteremployer" value="1">
                <label for="two-step2"><span class="checkbox-icon"></span> By Registering You Confirm That You Accept <a href="#">Terms &amp; Conditions</a></label>
                 <span class="errMsg_acceptregisteremployer errDiv"></span>

              </div>
          </form>
          <div class="text-center">
            <button class="button secondary" type="submit" onclick="return validatoremp();">Register Now</button>
          </div>
        </div>
      </div>
    </div>

  </div>  
<!-- </div> -->
@section('page-js')
<script
>
   $("#utf-register-account-form").keyup(function(event){
                if(event.keyCode == 13){
                   validatoremp();
                }
            });
  function generateCaptcha()
  {
      var ranNo = Math.floor((Math.random() * 100) + 1);
      $('.captchaImage').attr('src', SITE_URL + '/captcha?' + ranNo);
  }
  function validatoremp()
  {
      $('.errDiv').hide();
       $('.error-input').removeClass('error-input');
      if (!blankCheck('fullName', 'Name can not be left blank'))
          return false;
      if (!blankCheck('companyName', 'Company Name can not be left blank'))
          return false;
      if (!blankCheck('emailId', 'Email can not be left blank'))
          return false;
      if (!validEmail('emailId'))
          return false;  
      if (!blankCheck('phoneNo', 'Phone No can not be left blank'))
          return false;
      if (!blankCheck('passwordemp', 'password can not be left blank'))
          return false;
      if (!blankCheck('cpassword', 'Confirm password can not be left blank'))
          return false;
      if (!matchpassword('cpassword', 'passwordemp'))
          return false;  
      /*if (!blankCheck('captcha', 'Captcha can not be left blank'))
          return false;
      if (!maxLength('captcha', 4, 'Captcha'))
          return false;*/

      // var response = grecaptcha.getResponse(employerregcap);
      // if(response.length == 0){
      //   $('.errMsg_captcha').html('Please check captcha').show();
      //   return false;
      // }    

      if (!blankChkRad('acceptregisteremployer', 'Please Accept Terms and Conditions'))
          return false;
      $('#utf-register-account-form').submit();  
        
  }

  $('.utf-account-type-radio').on('click',function(){
    var loginType = $(this).val();
  
    if(loginType == 'employer'){
      window.location.href=SITE_URL+"/employer/register";  
    } else if(loginType == 'candidate'){
      window.location.href=SITE_URL+"/candidate/register";       
    } else if(loginType == 'ngo'){
      window.location.href=SITE_URL+"/ngo/register";            
    }   
});
</script>
@endsection
@endsection

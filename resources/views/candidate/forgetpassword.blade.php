@extends('layouts.website')
@section('page-content')
<!-- <div class="page-wrapper align-items-center d-flex"> -->
	<div class="container">
  <div class="inner-page-baner">
  <?php if(isset($banners) && $banners->isNotEmpty()){ ?>
      <img src="<?php if(!empty($banners[0]->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banners[0]->bannerImage; } else{ echo PUBLIC_PATH.'images/banner1.png.png'; } ?>" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
          <strong>{{$banners[0]->bannerTitle}}</strong> - <br> {{$banners[0]->bannerText}}
      </div>
      <?php } else { ?>
      <img src="<?php echo PUBLIC_PATH; ?>images/banner1.png" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
          <strong>Forgot Password</strong> - <br> Reset it quickly
      </div>
      <?php } ?>
  </div>
    <div class="row">
      <div class="col-xl-6 offset-xl-3">
        <div class="utf-login-register-page-aera margin-bottom-50"> 
          <div class="utf-welcome-text-item">
                <h3>Forgot Password For Candidate!</h3>
          </div>
          @include('components.admin-msg-tap')
         
          
          <form method="post" id="gorgetpass-form" autocomplete="off">
            {{csrf_field()}}
         
            
             
               <div class="utf-no-border">
                <input type="text" class="utf-with-border" maxlength="128" name="emailId" id="emailId" placeholder="Email Address">
                 <span class="errMsg_emailId errDiv"></span>
              </div>
               <div class="form-group ">
                <div class="row">
                  <!--  <div class="col-sm-6 no-padding-left">
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


                    </div>-->
                     <!-- <span class="errMsg_captcha errDiv"></span> -->
                    <div class="clearfix"></div>
                </div>
            </div>
             
          </form>
          <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit" style="width: 545px;" onclick="return validator();">Reset<i class="icon-feather-chevrons-right"></i>
          </button>
         <div class="text-center mt-4">
             <span>Don't Have an Account? <a href="{{ ROOT_URL.'/candidate/register' }}" >Sign Up!</a></span> 
         </div>
        </div>
      </div>
    </div>

  </div>  
<!-- </div> -->
@section('page-js')
<script
>
  function generateCaptcha()
  {
      var ranNo = Math.floor((Math.random() * 100) + 1);
      $('.captchaImage').attr('src', SITE_URL + '/captcha?' + ranNo);
  }
  function validator()
  {
      $('.errDiv').hide();
      $('.error-input').removeClass('error-input');
      if (!blankCheck('emailId', 'Email can not be left blank'))
          return false;
      if (!validEmail('emailId'))
          return false;  
    //   if (!blankCheck('captcha', 'Captcha can not be left blank'))
    //       return false;
    //   if (!maxLength('captcha', 4, 'Captcha'))
    //       return false;
      
      $('#gorgetpass-form').submit();  
        
  }
</script>
@endsection
@endsection

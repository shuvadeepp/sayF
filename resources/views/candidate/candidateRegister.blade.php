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
        <strong>Candidate Registration</strong> - <br>
        Get exclusive access to jobs, events, resources
      </div>
      <?php } ?>
    </div>
    <div class="row">
      <div class="col-xl-6 offset-xl-3">
        <div class="utf-login-register-page-aera login-container">
          <div class="utf-welcome-text-item">
            <h3>Create Your New Account!</h3>
          </div>
          @include('components.admin-msg-tap')

          <!--<div class="utf-account-type">
            <div>
              <a href="{{ ROOT_URL.'/employer/register' }}"></a>
                <input type="radio" name="utf-account-type-radio" id="freelancer-radio" class="utf-account-type-radio" >
              <label for="freelancer-radio" data-tippy-placement="top" class="utf-ripple-effect-dark" data-tippy="" data-original-title="Employer"><i class="icon-material-outline-business-center"></i> Employer</label>
            </div>
            <div>
              <a href="{{ ROOT_URL.'/candidate/register' }}"></a>
                <input type="radio" name="utf-account-type-radio" id="employer-radio" class="utf-account-type-radio" checked="">
                <label for="employer-radio" data-tippy-placement="top" class="utf-ripple-effect-dark" data-tippy="" data-original-title="Candidate"><i class="icon-material-outline-account-circle"></i> Candidate</label>
            </div>
             <div>
              <a href="{{ROOT_URL}}/ngo/register"></a>
                <input type="radio" name="utf-account-type-radio" id="employer-radio" class="utf-account-type-radio">
                <label for="employer-radio" data-tippy-placement="top" class="utf-ripple-effect-dark" data-tippy="" data-original-title="Candidate"><i class="icon-material-outline-account-circle"></i> NGO</label>
            </div> 
           </div>-->
          <div class="radio-btn-group">
            <div class="custom-radio">
              <input type="radio" name="utf-account-type-radio" class="utf-account-type-radio" id="freelancer-radio"
                value="employer">
              <label for="freelancer-radio" class="custom-radio-label">
                Employer</label>
            </div>
            <div class="custom-radio">
              <input type="radio" name="utf-account-type-radio" class="utf-account-type-radio" id="employer-radio"
                checked="" value="candidate">
              <label for="employer-radio" class="custom-radio-label">
                Candidate
              </label>
            </div>
            <div class="custom-radio">
              <input type="radio" name="utf-account-type-radio" class="utf-account-type-radio" id="ngo-radio"
                value="ngo">
              <label for="ngo-radio" class="custom-radio-label">
                NGO
              </label>
            </div>
          </div>


          <form method="post" name="frmEmployeeReg" id="frmEmployeeReg">
            {{csrf_field()}}
            <div class="utf-no-border">
              <input type="text" class="utf-with-border" name="txtName" id="txtName" placeholder="Name" required=""
                autocomplete="off" maxlength="128" value="{{old('txtName')}}" onkeypress="return isCharKey(event);">
              <span class="errMsg_txtName errDiv"></span>
            </div>
            <div class="utf-no-border">
              <input type="text" class="utf-with-border" name="txtEmail" id="txtEmail" placeholder="Email Address"
                required="" autocomplete="off" maxlength="128" value="{{old('txtEmail')}}">
              <span class="errMsg_txtEmail errDiv"></span>
            </div>
            <div class="utf-no-border">
              <input type="text" class="utf-with-border" name="txtPhone" id="txtPhone"
                onkeypress="return isNumberKey(event);" placeholder="Phone Number" required="" autocomplete="off"
                maxlength="10" value="{{old('txtPhone')}}">
              <span class="errMsg_txtPhone errDiv"></span>
            </div>
            <div class="utf-input-with-icon show-password">
              <input type="password" class="utf-with-border" name="txtPassword" id="txtPassword" placeholder="Password"
                required="" maxlength="32">
              <i class="icon-feather-eye "></i>
              <span class="errMsg_txtPassword errDiv"></span>
            </div>
            <div class="utf-input-with-icon show-password">
              <input type="password" class="utf-with-border" maxlength="32" name="cpassword" id="cpassword"
                placeholder="Confirm Password" maxlength="32">
              <i class="icon-feather-eye "></i>
              <span class="errMsg_cpassword errDiv"></span>
            </div>
            <div class="utf-no-border margin-bottom-18">
              <select class="selectpicker utf-with-border" title="State" data-size="7" data-live-search="true"
                name="selstate" id="selstate" onChange="loadcity(this.value,0);">
                <?php 
                   if(!empty($location))
                   {
                      foreach ($location as $locationkey => $locationVal) { 
                     
                        ?>

                <option value="{{$locationVal->stateId}}" {{(old('selstate')==$locationVal->stateId?'selected':'')}}
                  >{{$locationVal->state}}</option>
                <?php
                      } }
                      ?>
              </select>
              <input type="hidden" name="selcaluestate" id="selcaluestate"
                value="{{!empty(old('selstate'))?old('selstate'):'0'}}">

              <!--    <option value="Bhubaneswar" {{(old('selLocation') == "Bhubaneswar"?'selected':'')}}>Bhubaneswar</option>
                    <option value="Khordha" {{(old('selLocation') == "Khordha"?'selected':'')}}>Khordha</option>
                    <option value="Puri" {{(old('selLocation') == "Puri"?'selected':'')}}>Puri</option>
                    <option value="Cuttack" {{(old('selLocation') == "Cuttack"?'selected':'')}}>Cuttack</option>
                    <option value="Rourkela" {{(old('selLocation') == "Rourkela"?'selected':'')}}>Rourkela</option>
                  </select> -->

            </div>

            <div class="utf-no-border margin-bottom-18">
              <select class="selectpicker utf-with-border" title="City" name="selcity" data-size="7"
                data-live-search="true" id="selcity">
                <option value="0">--select--</option>

              </select>
              <input type="hidden" name="selcaluecity" id="selcaluecity"
                value="{{!empty(old('selcity'))?old('selcity'):'0'}}">




            </div>
            <span class="errMsg_selcity errDiv"></span>
            <div class="utf-no-border">
              <input type="number" min="1" max="50" class="utf-with-border" name="selExperience" id="selExperience"
                placeholder="Total Work Experience" required="" maxlength="2" onkeypress="return isNumberKey(event);"
                value="{{old('selExperience')}}">
              <span class="errMsg_selExperience errDiv"></span>
            </div>

            <!--   <div class="utf-no-border margin-bottom-18">
                  <select class="selectpicker utf-with-border" title="Total Experience" name="selExperience" id="selExperience">
                    <?php $expTypeArr = json_decode(EXPERIENCE_TYPE,true);
                      foreach ($expTypeArr as $expTypeArrKey => $expTypeArrVal) { ?>
                      
                        <option value="{{$expTypeArrKey}}" {{(old('selExperience') == $expTypeArrKey?'selected':'')}}>{{$expTypeArrVal}}</option>
                      <?php
                      }
                      ?>
                  </select>
                </div> -->
            <!--   <span class="errMsg_selExperience errDiv"></span> -->

            <div class="row">
              <div class="col-12">
                <!-- <div id="candidateregcap"></div> -->
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
 class="captchaImage" id="captchaImage">
                            </label>
                            <a href="javascript:void(0);" class="input-group-addon captchaRefresh ml-2" onClick="generateCaptcha()" ><span class="icon-feather-refresh-cw"></span></a>
                        </div>
                    </div> -->
              <div class="clearfix"></div>
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
            <div class="checkbox margin-top-0">
              <input type="checkbox" id="two-step0" name="acceptregistercandidate" id="acceptregistercandidate"
                value="1">
              <label for="two-step0"><span class="checkbox-icon"></span> By Registering You Confirm That You Accept <a
                  href="#">Terms &amp; Conditions</a></label>
              <span class="errMsg_acceptregistercandidate errDiv"></span>
            </div>
          </form> 
            <div class="text-center mt-3">
              <button class="button secondary mr-3" type="submit"
                onclick="return validator();">Register Now</button>
           
              <button class="button secondary-outline" type="submit"
                onclick="return candidateSocialsignUp();">Sign Up With Google</button>
            </div> 

        </div>
      </div>
    </div>




  </div>
<!-- </div> -->
@section('page-js')
<script src="{{ asset('public/js/validatorchklist.js') }}"></script>
<script>
  /* $(document).ready(function(){
    alert(SITE_URL)
  }); */
  // var state=<?php //old('selstate'); ?>
  // if(state!=null)
  // {
  //   loadcity(state);
  // }
  $(document).ready(function () {
    var selState = $("#selcaluestate").val();
    var cityval = $("#selcaluecity").val();

    if (cityval != 0) {
      loadcity(selState, cityval)
    }
  });
  function generateCaptcha() {
    var ranNo = Math.floor((Math.random() * 100) + 1);
    $('.captchaImage').attr('src', SITE_URL + '/captcha?' + ranNo);
  }


  function validator() {
    $('.errDiv').hide();
    $('.error-input').removeClass('error-input');
    if (!blankCheck('txtName', 'Name can not be left blank'))
      return false;
    if (!blankCheck('txtEmail', 'Email can not be left blank'))
      return false;
    if (!validEmail('txtEmail'))
      return false;
    if (!blankCheck('txtPhone', 'Phone can not be left blank'))
      return false;
    if (!maxLength('txtPhone', 10, 'txtPhone'))
      return false;
    if (!blankCheck('txtPassword', 'Password can not be left blank'))
      return false;
    if (!blankCheck('cpassword', 'Confirm password can not be left blank'))
      return false;
    if (!matchpassword('cpassword', 'txtPassword'))
      return false;
    if (!selectDropdown('selstate', 'Select State'))
      return false;
    if (!selectDropdown('selcity', 'Select City'))
      return false;
    if (!blankCheck('selExperience', 'Experience can not be left blank'))
      return false;
    if (!maxLength('selExperience', 2, 'Experience'))
      return false;
    /*if (!blankCheck('captcha', 'Captcha can not be left blank'))
        return false;
    if (!maxLength('captcha', 4, 'Captcha'))
        return false;*/
    // var response = grecaptcha.getResponse(candidateregcap);
    // if(response.length == 0){
    //   $('.errMsg_captcha').html('Please check captcha').show();
    //   return false;
    // }  
    if (!blankChkRad('acceptregistercandidate', 'Please Accept Terms and Conditions'))
      return false;

    $('#frmEmployeeReg').submit();

  }

  // console.log(SITE_URL);return false;

  /* Google Candidate SignUp Ajax  */
  function candidateSocialsignUp(signUp) {
    $.ajax({
      type: 'POST',
      url: SITE_URL + "/sociallogin/Googlelogin/socialLogin",
      data: { formType: 'signUp', _token: '{{ csrf_token() }}' },
      processData: true,
      success: function (res) {
        window.location = res;
      }
    });
  }

  $('.utf-account-type-radio').on('click', function () {
    var loginType = $(this).val();

    if (loginType == 'employer') {
      window.location.href = SITE_URL + "/employer/register";
    } else if (loginType == 'candidate') {
      window.location.href = SITE_URL + "/candidate/register";
    } else if (loginType == 'ngo') {
      window.location.href = SITE_URL + "/ngo/register";
    }
  });


</script>
@endsection
@endsection
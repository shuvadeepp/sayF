@extends('layouts.website')
@section('page-content')
<!-- <div class="page-wrapper align-items-center d-flex"> -->
<div class="container">
  <div class="inner-page-baner">
    <?php if(isset($banners) && $banners->isNotEmpty()){ ?>
    <img
      src="<?php if(!empty($banners[0]->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banners[0]->bannerImage; } else{ echo PUBLIC_PATH.'images/lets-say-our-blogs.png'; } ?>"
      class="d-block" alt="banner">
    <div class="inner-page-baner-content">
      <strong>{{$banners[0]->bannerTitle}}</strong> - <br> {{$banners[0]->bannerText}}
    </div>
    <?php } else { ?>
    <img src="<?php echo PUBLIC_PATH; ?>images/banner1.png" class="d-block" alt="banner">
    <div class="inner-page-baner-content">
      <strong>User Login</strong> - <br>
      Unlock a world of opportunities with us
    </div>
    <?php } ?>
  </div>
 
  <div class="utf-login-register-page-aera login-container">
    <!-- <div class="utf-welcome-text-item">
            <h3>User Login</h3>
      </div>  -->
    <!-- <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
        <label class="custom-control-label" for="customRadioInline1">Toggle this custom radio</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
        <label class="custom-control-label" for="customRadioInline2">Or toggle this other custom radio</label>
      </div> -->
    <!-- <input type="radio" name="demon"   checked="checked" value="employer"> -->
    <div class="radio-btn-group">
      <div class="custom-radio">
        <input type="radio" name="utf-account-type-radio" class="utf-account-type-radio" id="employer-radio"
          value="employer" checked="">
        <label for="employer-radio" class="custom-radio-label">
          Employer</label>
      </div>
      <div class="custom-radio">
        <input type="radio" name="utf-account-type-radio" class="utf-account-type-radio" id="candidate-radio"
          value="candidate">
        <label for="candidate-radio" class="custom-radio-label">
          Candidate
        </label>
      </div>
      <div class="custom-radio">
        <input type="radio" name="utf-account-type-radio" class="utf-account-type-radio" id="ngo-radio" value="ngo">
        <label for="ngo-radio" class="custom-radio-label">
          NGO
        </label>
      </div>
      <div class="custom-radio">
        <input type="radio" name="utf-account-type-radio" class="utf-account-type-radio" id="gov-radio" value="gov">
        <label for="gov-radio" class="custom-radio-label">
          Government
        </label>
      </div>
    </div>


    <!-- Employer Sign In Popup -->
    <div id="empForm">
      <div class="row"> 
        <div class="col-lg-5">  
            <div class="text-center mb-md-4 mb-3">
              <h5 class="text-primary">Welcome Back Sign in to Continue</h5>
              <span>Don't Have an Account? <a href="{{ ROOT_URL.'/employer/register' }}">Sign Up!</a></span>
            </div>
            <form method="post" id="employeerlogin-form">
              {{csrf_field()}}

              <div class="utf-no-border">
                <input type="text" class="utf-with-border" name="emailidemployer" id="emailidemployer"
                  placeholder="Email Address" required />
                <span class="errMsg_emailidemployer errDiv"></span>
              </div>
              <div class="utf-input-with-icon show-password">
                <input type="password" class="utf-with-border" name="passwordemployer" id="passwordemployer"
                  placeholder="Password" required />
                <i class="icon-feather-eye "></i>
                <span class="errMsg_passwordemployer errDiv"></span>
              </div>
              <!-- <div class="row">
                  <div class="col-12"> -->
              <!-- <div id="employerlogincap"></div> -->
              <!-- </div>
                  <div class="row mb-4"> -->
              <!-- <div class="col-sm-6 no-padding-left">
                    <input type="text" maxlength="4" name="captcha" id="captchacode" onkeypress="return isNumberKey(event);" class="utf-with-border mb-0" placeholder="Enter Code">
                </div>
                <div class="col-sm-5 mt-3 mt-md-0 no-padding-right d-flex align-items-center">
                    <div class="d-flex align-items-center" >
                        <label class="form-control input-md no-padding text-center mb-0" style="padding: 0;">
                            <img src="{{url('/')."/captcha"}}" alt="captcha image" 
class="captchaImage" id="captchacode">
                        </label>
                        <a href="javascript:void(0);" class="input-group-addon captchaRefresh ml-2" onClick="//generateCaptcha()" ><span class="icon-feather-refresh-cw"></span></a>
                    </div>


                </div> -->
              <!-- <div class="col-12 mt-3"><span class="errMsg_captchacode errDiv"></span></div> -->
              <!-- <div class="clearfix"></div>

                  </div>
                </div> -->
              <span class="servererror errDiv"></span>
              <!-- <div class="col-12 mt-md-3"></div> -->
            </form>
            <div class="text-center">
              <button class="button secondary employerlogin" type="button"
                onclick="return validatoremployeer();">Log In</button>
            </div>

            <div class="d-flex my-3 justify-content-center">
              <span>Forgot Password? <a href="{{ ROOT_URL.'/employer/forgetpassword' }}">
                  Click Here</a></span>
            </div>
            <div class="text-center">
              Email us at <a href="mailto:contactus@thesayfoundation.com">contactus@thesayfoundation.com</a> for
              more details
            </div> 
        </div>
        <div class="col-lg"> 
          <div class="login-content"> 
            <p class="login-content-title">
              We partner with companies who are committed to diversity, equity, and inclusion (DEI) to help them find and hire qualified candidates with disabilities. 
            </p>
            <ul class="section-list">
              <li>
                Our job portal provides a platform for companies to post job requirements and connect with a diverse pool of talent.
              </li>
              <li>
                How else do we help you as an Employer?
              </li>
              <li>
                We also provide resources and guidance on how to create a more inclusive workplace for persons with disabilities. 
              </li>
              <li>
                Our team can help you identify accessibility barriers, develop accommodations, and implement DEI initiatives.
              </li>
              <li>
                We believe that by working together, we can create a more inclusive society where everyone has the opportunity to succeed. Join us in our mission to promote DEI and empower persons with disabilities in the workforce.
              </li> 
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Sign In Popup / End -->


    <!-- Candidate Sign In Popup / End -->
    <div id="candidateForm"> 
      <div class="row"> 
        <div class="col-lg-5">  
          <div id="candidate">
            <div class="text-center mb-md-4 mb-3">
              <h5 class="text-primary">Welcome Back Sign in to Continue</h5>
              <span>Don't Have an Account? <a href="{{ ROOT_URL.'/candidate/register' }}">Sign Up!</a></span>
            </div>

            <p class="alert errMsg" style="color: red;"></p>

            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert alert-danger', 'alert-danger') }}" style="color: red;">{{
              Session::get('message') }}</p>
            @endif
            <form method="post" id="candidatelogin-form">
              {{csrf_field()}}
              <div class="utf-no-border">
                <input type="text" class="utf-with-border" name="emailaddress" id="emailaddress"
                  placeholder="Email Address" required />
                <span class="errMsg_emailaddress errDiv"></span>
              </div>
              <div class="utf-input-with-icon show-password">
                <input type="password" class="utf-with-border" name="password" id="password" placeholder="Password"
                  required />
                <i class="icon-feather-eye "></i>
                <span class="errMsg_password errDiv"></span>
              </div>
              <!-- <div class="row">
                  <div class="col-12"> -->
              <!-- <div id="candidatelogincap"></div> -->
              <!-- </div>
                  <div class="row mb-4"> -->
              <!-- <div class="col-sm-6 no-padding-left">
                    <input type="text" maxlength="4" name="captcha" id="captchaval" onkeypress="return isNumberKey(event);" class="utf-with-border mb-0" placeholder="Enter Code">
                </div>
                <div class="col-sm-5 mt-3 mt-md-0 no-padding-right d-flex align-items-center">
                    <div class="d-flex align-items-center" >
                        <label class="form-control input-md no-padding text-center mb-0" style="padding: 0;">
                            <img src="{{url('/')."/captcha"}}" alt="captcha image" 
class="captchaImage" id="captchaval">
                        </label>
                        <a href="javascript:void(0);" class="input-group-addon captchaRefresh ml-2" onClick="//generateCaptcha()" ><span class="icon-feather-refresh-cw"></span></a>
                    </div>
                                    </div> -->
              <!-- <div class="col-12 mt-3"><span class="errMsg_captchaval errDiv" id="errMsg_candidatelogincaptcha"></span></div>-->
              <!-- <div class="clearfix"></div>
                  </div>
                </div>
                <div class="col-12 mt-3">
                  </div> -->
              <span class="servererrormsg errDiv"></span>

            </form>
            <div class="text-center">
              <button class="button secondary candidatelogin mr-3" type="button"
                onclick="return validatorcandidate();">Log In</button>
              <button class="button secondary-outline candidateSociallogin" type="button"
                onclick="return candidateSocialLogin();">Sign In With Google </button>
            </div>
            <div class="d-flex my-3 justify-content-center">
              <span>Forgot Password? <a href="{{ ROOT_URL.'/candidate/forgetpassword' }}">
                  Click Here</a></span>
            </div>
            <div class="text-center">
              Email us at <a href="mailto:contactus@thesayfoundation.com">contactus@thesayfoundation.com</a> for
              more details
            </div>
          </div>
        </div>
        <div class="col-lg">
          <div class="login-content">
            <p class="login-content-title">
              We believe in empowering individuals with disabilities to build fulfilling careers and reach their full potential.
            </p>
            <ul class="section-list">
              <li>
                On this page, you can create a profile and apply for job opportunities posted by companies looking to hire candidates with disabilities. Our job portal is designed to help you find the right job for your skills, experience, and needs.
              </li>
              <li>
                But we offer more than just a job board. We also provide support services to help you succeed in your job search and career. Our team can help you build a strong resume, prepare for interviews, and connect with employers who are committed to diversity, equity, and inclusion.
              </li>
              <li>
                At Say Foundation, we believe that everyone deserves the opportunity to work and thrive in their chosen field. 
              </li>
            </ul>
            <p><strong>Join us and start building your career today!</strong></p>
          </div>
        </div>
      </div>
    </div>
    <!-- Sign In Popup / End -->

    <!-- NGO modal / End -->
    <div id="ngoForm">
      <div class="row"> 
        <div class="col-lg-5">  
            <div class="text-center mb-md-4 mb-3">
              <h5 class="text-primary">Welcome Back Sign in to Continue</h5>
              <span>Don't Have an Account? <a href="{{ ROOT_URL.'/ngo/register' }}">Sign Up!</a></span>
            </div>
            <form method="post" id="partnerlogin-form">
              {{csrf_field()}}
              <div class="utf-no-border">
                <input type="text" class="utf-with-border" name="emailaddpartner" id="emailaddpartner"
                  placeholder="Email Address" required />
                <span class="errMsg_emailaddpartner errDiv"></span>
              </div>
              <div class="utf-input-with-icon show-password">
                <input type="password" class="utf-with-border" name="passwordpartner" id="passwordpartner"
                  placeholder="Password" required />
                <i class="icon-feather-eye "></i>
                <span class="errMsg_password errDiv"></span>
              </div>
              <div id="ngologincap"></div>
              <!-- <div class="row">
                  <div class="col-12">
                  </div>
                  <div class="row mb-4"> -->
              <!-- <div class="col-sm-6 no-padding-left">
                    <input type="text" maxlength="4" name="captchpartner" id="captchpartner" onkeypress="return isNumberKey(event);" class="utf-with-border mb-0" placeholder="Enter Code">
                </div>
                <div class="col-sm-5 mt-3 mt-md-0 no-padding-right d-flex align-items-center">
                    <div class="d-flex align-items-center" >
                        <label class="form-control input-md no-padding text-center mb-0" style="padding: 0;">
                            <img src="{{url('/')."/captcha"}}" alt="captcha image" 
class="captchaImage" id="captchaval">
                        </label>
                        <a href="javascript:void(0);" class="input-group-addon captchaRefresh ml-2" onClick="//generateCaptcha()" ><span class="icon-feather-refresh-cw"></span></a>
                    </div>
                </div> -->
              <!-- <div class="col-12 mt-3">
                      </div> -->
              <span class="errMsg_captchaval errDiv"></span>
              <!-- <div class="clearfix"></div>
                  </div>
                </div>
                <div class="col-12 mt-3">
                  </div> -->
              <span class="errormsg errDiv"></span>

            </form>
            <div class="text-center">
              <button class="button secondary partnerLogin" type="button"
                onclick="return validatorpartnerlogin();">Log In</button>
            </div>
            <div class="d-flex my-3 justify-content-center">
              <span>Forgot Password? <a href="{{ ROOT_URL.'/ngo/forgetpassword' }}"> Click
                  Here</a></span>
            </div>
            <div class="text-center">
              Email us at <a href="mailto:contactus@thesayfoundation.com">contactus@thesayfoundation.com</a> for
              more details
            </div> 
        </div>
        <div class="col-lg">
          <div class="login-content">
            <p class="login-content-title">
              We partner with NGOs to provide training and employment opportunities to persons with disabilities. Our goal is to equip individuals with the skills they need to succeed in the workplace and build fulfilling careers.
            </p>
            <ul class="section-list">
              <li> 
                As an NGO, you can offer your expertise in skill training, job placement, and other support services to PwDs. 
              </li>
              <li>
                In return, we can connect you with companies looking to hire candidates with disabilities. 
              </li>
              <li>
                We provide a platform for you to showcase your services and help bridge the gap between job seekers and employers.
              </li>
              <li>
                We also offer resources and guidance to NGOs who are committed to supporting persons with disabilities. Our team can help you identify best practices, create training programs, and connect with other organizations in the disability community.
              </li>
            </ul>
            <p>
              <strong>Join us in our mission to empower persons with disabilities and create a more inclusive society.</strong>
            </p> 
          </div>
        </div>
      </div>
    </div>
    <!-- NGO modal / End -->
    <!-- gov user -->
    <!-- gov user end-->
    <div id="govForm">
      <div class="row">  
        <div class="col-lg"> 
            <p class="login-content-title">
              We believe in working collaboratively with the government to create policies that promote inclusion and access to employment for persons with disabilities.
            </p>
            <ul class="section-list">
              <li>
                As an organization committed to empowering persons with disabilities, we believe that government plays a vital role in creating an inclusive society. 
              </li>
              <li>
                We believe that policies and regulations should be put in place to provide equal opportunities for employment and to break down barriers to access.
              </li>
              <li>
                Our team can provide guidance and expertise to help you create and implement disability-inclusive policies and programs.
              </li>
              <li>
                We also believe in promoting employment opportunities in the public & government sector for persons with disabilities. Our team can help connect government agencies with qualified candidates and provide guidance on accommodations and accessibility.
              </li>
              <li>
                Join us in our mission to create a more inclusive society by promoting disability-inclusive policies and practices in the public sector. 
              </li>
            </ul>
            <p>
              <strong>
                Together, we can make a positive impact on the lives of persons with disabilities.
              </strong>
            </p> 
        </div>
        <div class="col-lg-5"> 
          <div class="connect-box">
            <img src="<?php echo PUBLIC_PATH; ?>images/connectus.jpg" class="img-fluid mb-3">
            <h5 class="text-primary">
             <span class="d-block">Connect with us on this email id </span>
              <a href="mailto:contactus@thesayfoundation.com">contactus@thesayfoundation.com</a>
            </h5> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- </div> -->



@section('page-css')

@endsection

@section('page-js')
<script>
  $(document).ready(function () {
    $("#empForm").show();
    $("#empForm,#candidateForm,#govForm").hide();
  
	<?php if(session()->has('is_candidate')){ ?> 
		$("#candidate-radio").attr('checked', true).trigger('click');
	<?php }?>
	
	/* :::::::::: This code snippet handles the redirection from the dashboard page to the user-login form when the user clicks on the button. -- Shuvadeep Podder -- Dt: 17-04-2023 :::::::::: */
    <?php $val == ''; ?>
    <?php if($val == 1) { ?>
      $("#employer-radio").attr('checked', true).trigger('click');
    <?php } else if($val == 2) { ?>
      $("#candidate-radio").attr('checked', true).trigger('click');
    <?php } else if($val == 3) { ?>
      $("#ngo-radio").attr('checked', true).trigger('click'); 
    <?php } else if($val == 4) { ?>
      $("#gov-radio").attr('checked', true).trigger('click'); 
    <?php } ?>  
  });
  $('.utf-account-type-radio').on('click', function () {
    var loginType = $(this).val();
    // alert(loginType);
    if (loginType == 'employer') {
      $("#empForm").show();
      $("#candidateForm,#govForm,#ngoForm").hide(); 
    } else if (loginType == 'candidate') {
      $("#candidateForm").show();
      $("#empForm,#govForm,#ngoForm").hide(); 
    } else if (loginType == 'ngo') {
      $("#ngoForm").show();
      $("#empForm,#candidateForm,#govForm").hide();
    } else if (loginType == 'gov') {
      $("#govForm").show();
      $("#empForm,#candidateForm,#ngoForm").hide(); 
    }
    //alert($(this).val());
  });

</script>

@endsection

@endsection
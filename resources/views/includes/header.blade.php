<?php //echo "<pre>";print_r(session('partner_session_data'));exit; ?>
<header class="header">
  <div id="header" >
  <div class="container">
    <!-- <nav class="navbar navbar-expand-xl px-0">
      <h1>
        <a class="navbar-brand" href="{{ROOT_URL}}">
          <img src="<?php echo PUBLIC_PATH; ?>images/thesay-logo.svg" alt="The Say Foundation">
          <span>Cause creates <br>competence & character</span>
        </a>
      </h1>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
        aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <i class="icon-feather-menu"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarToggler">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{ROOT_URL}}/jobsearch">Explore Jobs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ROOT_URL}}/about-us">
              Our Story
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ROOT_URL}}/blog">Say Blogs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ROOT_URL}}/donate">Donate</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ROOT_URL}}/volunteer">Volunteer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ROOT_URL}}/resource">Resource</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ROOT_URL}}/connect">Contact Us</a>
          </li> -->


          <div class="utf-left-side">
            <h1 id="logo" class="mb-0">
              <a href="{{ROOT_URL}}">
                <img src="<?php echo PUBLIC_PATH; ?>images/logo.svg" alt="The Say Foundation">
                <!-- <span>Cause creates <br>competence & character</span> -->
              </a> 
            </h1>

            <nav id="navigation">
              <div class="d-flex flex-column w-100">
                <ul id="responsive">
                  <li>
                    <a class="{{(request()->is('jobsearch')) ? 'current' : ''}}" href="{{ROOT_URL}}/jobsearch">Explore Jobs</a>
                  </li>
                  <li>
                    <a class="{{(request()->is('about-us')) ? 'current' : ''}}" href="{{ROOT_URL}}/about-us">Our Story</a>
                  </li>
                  <li>
                    <a class="{{(request()->is('LetsSay-OurBlogs')) ? 'current' : ''}}" href="{{ROOT_URL}}/LetsSay-OurBlogs">Let's Say - Our Blogs</a>
                  </li>
                  <li>
                    <a class="{{(request()->is('donate')) ? 'current' : ''}}" href="{{ROOT_URL}}/donate">Donate</a>
                  </li>
                  <li>
                    <a class="{{(request()->is('volunteer')) ? 'current' : ''}}" href="{{ROOT_URL}}/volunteer">Volunteer</a>
                  </li>
                  <!-- <li>
                    <a class="{{(request()->is('resource')) ? 'current' : ''}}" href="{{ROOT_URL}}/resource">Resource</a>
                  </li> -->
                  <li>
                    <a class="{{(request()->is('pressrelease')) ? 'current' : ''}}" href="{{ROOT_URL}}/pressrelease">Press Release</a>
                  </li>
                  <li>
                    <a class="{{(request()->is('connect')) ? 'current' : ''}}" href="{{ROOT_URL}}/connect">Contact Us</a>
                  </li>
                  <!-- <li>
                    <a href="{{ROOT_URL}}" class="{{(request()->is('/')) ? 'current' : ''}}" title="Home"><i
                        class="icon-line-awesome-dot-circle-o d-lg-none"></i> Home</a></li>
                  <li><a href="{{ROOT_URL.'/about-us'}}" class="{{(request()->is('about-us')) ? 'current' : ''}}"
                      title="About Us"><i class="icon-line-awesome-dot-circle-o d-lg-none"></i> About Us</a></li>

                  <li><a href="{{ROOT_URL.'/blog'}}" class="{{(request()->is('blog')) ? 'current' : ''}}"
                      title="Our Blogs"><i class="icon-line-awesome-dot-circle-o d-lg-none"></i> Our Blogs</a></li>
                  <li><a href="{{ROOT_URL.'/ngo'}}" class="{{(request()->is('ngo')) ? 'current' : ''}}" title="NGO"><i
                        class="icon-line-awesome-dot-circle-o d-lg-none"></i> NGO</a></li>
                  <li><a href="{{ROOT_URL.'/connect'}}" class="{{(request()->is('connect')) ? 'current' : ''}}"
                      title="Connect"><i class="icon-line-awesome-dot-circle-o d-lg-none"></i> Contact Us</a></li> -->

                      
                  <?php if(empty(session('candidate_session_data.fullName')) && empty(session('employer_session_data.fullName')) && empty(session('partner_session_data.fullName'))) { ?>
                  <!-- <li class="nav-item profile-link">
                    <a class="nav-link" href="{{ROOT_URL}}/user-login">Login</a>
                  </li> -->
                  <li class="header-login-btn">
                    <a href="{{ROOT_URL}}/user-login/1" class="button">
                      <i class="icon-feather-log-in"></i> <span>Login</span>
                    </a> 
                  </li>
                  <!-- <li class="d-lg-none">
                    <a href="{{ROOT_URL}}/user-login">
                      <i class="icon-feather-log-in"></i> <span>Login</span>
                    </a>
                  </li> -->
                  <!--               <li>
                <div class="utf-header-notifications user-menu">
                  <div class="utf-header-notifications-trigger user-profile-title"> 
                    <a href="#" class="log-in-btn"><i class="icon-feather-log-in"></i> <span>Login</span></a>
                  </div>
                  <div class="utf-header-notifications-dropdown-block mt-3"> 
                    <ul class="utf-user-menu-dropdown-nav">
                      <li><a href="#utf-signin-dialog-block" class="popup-with-zoom-anim emp"><i class="icon-feather-user-plus"></i> Employer</a></li>
                      <li><a href="#small-dialog" class="popup-with-zoom-anim cand"><i class="icon-feather-user"></i> Candidate</a></li>
                    </ul>
                  </div>
                </div>
              </li>
  -->
                  <!-- <li><a href="{{ ROOT_URL.'/candidate/register' }}" class="register-btn"><i class="icon-line-awesome-user-plus"></i> <span>Register</span></a></li>     -->

                  <?php } ?>
                </ul>
                <?php //if(empty(session('candidate_session_data.fullName')) && empty(session('partner_session_data.fullName')) && empty(session('employer_session_data.fullName'))){ ?>
                <!-- <ul class="order-lg-1" id="login-group">
              <li><a href="#small-dialog" class="popup-with-zoom-anim cand login mr-3 " title="Click to login"><i class="icon-feather-user"></i>Candidate Login</a></li>
              <li><a href="#utf-signin-dialog-block" class="popup-with-zoom-anim emp login mr-3" title="Click to login"><i class="icon-feather-user-plus"></i>Employer Login</a></li>
              <li>              
               <a href="#small-dialog-2" class="popup-with-zoom-anim ngo emp logi" title="NGO Login"><i class="icon-line-awesome-user-plus"></i> <span>NGO Login</span></a>
              </li> 
               
            </ul> -->
                <?php //} ?>
                <!--  <div class="utf-header-notifications user-menu">
              <div class="utf-header-notifications-trigger user-profile-title"> 
                <a href="#" class="popup-with-zoom-anim log-in-btn"><i class="icon-feather-log-in"></i> <span>Login</span></a>
              </div>
              <div class="utf-header-notifications-dropdown-block"> 
                <ul class="utf-user-menu-dropdown-nav">
                  <li><a href=""><i class="icon-material-outline-dashboard"></i> Employer</a></li>
                  <li><a href=""><i class="icon-material-outline-dashboard"></i> Candidate</a></li>
                </ul>
              </div>
            </div> -->

                <!-- After Login -->
                <?php if(!empty(session('candidate_session_data.fullName'))){ ?>
                <div class="utf-header-widget-item text-right">
                  <div class="utf-header-notifications user-menu">
                    <div class="utf-header-notifications-trigger user-profile-title">
                      <a href="#">
                        <div class="user-avatar status-online"><img
                            src="<?php echo (!empty(session('candidate_session_data.profileImage')))?STORAGE_PATH.'candidateProfile/'.session('candidate_session_data.profileImage'):PUBLIC_PATH.'images/user-avatar-placeholder.png';?>"
                            alt=""> </div>
                        <div class="user-name">Hi, {{ session('candidate_session_data.fullName') }}!</div>
                      </a>
                    </div>
                    <div class="utf-header-notifications-dropdown-block">
                      <ul class="utf-user-menu-dropdown-nav">
                        <li><a href="<?php echo ROOT_URL; ?>/candidate/dashboard"><i
                              class="icon-material-outline-dashboard"></i> Dashboard</a></li>
                        <li><a href="<?php echo ROOT_URL; ?>/candidate/profile"><i class="icon-feather-user"></i> My
                            Profile</a></li>
                        <li><a href="<?php echo ROOT_URL; ?>/candidate/logout"><i
                              class="icon-material-outline-power-settings-new"></i> Logout</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <?php }else if(!empty(session('partner_session_data.fullName'))){ ?>
                <div class="utf-header-widget-item text-right">
                  <div class="utf-header-notifications user-menu">
                    <div class="utf-header-notifications-trigger user-profile-title">
                      <a href="#">
                        <div class="user-avatar status-online"><img
                            src="<?php echo (!empty(session('partner_session_data.companyLogo')))?STORAGE_PATH.'partnerlogo/'.session('partner_session_data.companyLogo'):PUBLIC_PATH.'images/user-avatar-placeholder.png';?>"
                            alt=""> </div>
                        <div class="user-name">Hi, {{ session('partner_session_data.fullName') }}!</div>
                      </a>
                    </div>
                    <div class="utf-header-notifications-dropdown-block">
                      <ul class="utf-user-menu-dropdown-nav">
                        <li><a href="<?php echo ROOT_URL; ?>/ngo/dashboard"><i
                              class="icon-material-outline-dashboard"></i> Dashboard</a></li>
                        <li><a href="<?php echo ROOT_URL; ?>/ngo/profile"><i class="icon-feather-user"></i> My
                            Profile</a></li>
                        <li><a href="<?php echo ROOT_URL; ?>/ngo/logout"><i
                              class="icon-material-outline-power-settings-new"></i> Logout</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <?php }else if(!empty(session('employer_session_data.fullName'))){ ?>
                <div class="utf-header-widget-item text-right">
                  <div class="utf-header-notifications user-menu">
                    <div class="utf-header-notifications-trigger user-profile-title">
                      <a href="#">
                        <div class="user-avatar status-online"><img
                            src="<?php echo (!empty(session('employer_session_data.companyLogo')))?STORAGE_PATH.'companylogo/'.session('employer_session_data.companyLogo'):PUBLIC_PATH.'images/user-avatar-placeholder.png';?>"
                            alt=""> </div>
                        <div class="user-name">Hi, {{ session('employer_session_data.fullName') }}!</div>
                      </a>
                    </div>
                    <div class="utf-header-notifications-dropdown-block">
                      <ul class="utf-user-menu-dropdown-nav">
                        <li><a href="<?php echo ROOT_URL; ?>/employer/dashboard"><i
                              class="icon-material-outline-dashboard"></i> Dashboard</a></li>
                        <li><a href="<?php echo ROOT_URL; ?>/employer/employerprofile"><i class="icon-feather-user"></i>
                            My Profile</a></li>
                        <li><a href="<?php echo ROOT_URL; ?>/employer/logout"><i
                              class="icon-material-outline-power-settings-new"></i> Logout</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <?php }?>
              </div> 
              <div class="clearfix"></div>
            </nav>
            <a href="javascript:;" class="toggle-btn d-md-none ml-auto" title="Toggle Menu" id="menu-toggle">
         <span></span>
         <span></span>
         <span></span>
        </a>
            <span class="mmenu-trigger"> 
              <i class="icon-feather-menu"></i>
            </span>
            <!-- </div> -->
            <!-- </div> -->


          </div>
          <!--   </div> -->
</header>
<!-- Employer Sign In Popup -->
<!-- <div id="utf-signin-dialog-block" class="zoom-anim-dialog mfp-hide dialog-with-tabs"> 
  <div class="utf-signin-form-part">
    <ul class="utf-popup-tabs-nav-item text-center">
      <li class="modal-title">Employer Login</li>
    </ul>
    <div class="utf-popup-container-part-tabs"> 

      <div class="utf-popup-tab-content-item" > 
        <div class="utf-welcome-text-item">

          <h3>Welcome Back Sign in to Continue</h3>
          <span>Don't Have an Account? <a href="{{ ROOT_URL.'/employer/register' }}">Sign Up!</a></span> 
        </div>
        <form method="post" id="employeerlogin-form">
            {{csrf_field()}}
             
          <div class="utf-no-border">
            <input type="text" class="utf-with-border" name="emailidemployer" id="emailidemployer" placeholder="Email Address" required/>
               <span class="errMsg_emailidemployer errDiv"></span>
          </div>
          <div class="utf-input-with-icon show-password">
            <input type="password" class="utf-with-border" name="passwordemployer" id="passwordemployer" placeholder="Password" required/>
            <i class="icon-feather-eye "></i>
               <span class="errMsg_passwordemployer errDiv"></span>
          </div>
            <div class="row">
                <div class="col-12">-->
<!-- <div id="employerlogincap"></div> -->
<!-- </div>
                <div class="row mb-4">-->
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
            </div>
            
              <div class="col-12 mt-md-3"><span class="servererror errDiv"></span></div>
              </form> 
        <button class="button full-width utf-button-sliding-icon ripple-effect employerlogin" type="button" onclick="return validatoremployeer();" ><span>Log In</span> <i class="icon-feather-chevrons-right"></i></button>

        <div class="d-flex mt-3 justify-content-center">
          <span>Forgot Password?  <a href="{{ ROOT_URL.'/employer/forgetpassword' }}" class="forgot-password"> Click Here</a></span>
        </div>
      
    
      </div>        
      
    </div>
  </div>
</div>-->
<!-- Sign In Popup / End -->

<!-- Candidate Sign In Popup / End -->
<!--<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs"> 
  <div class="utf-signin-form-part">
    <ul class="utf-popup-tabs-nav-item text-center">
      <li class="modal-title">Candidate Login</li>
    </ul>
    <div class="utf-popup-container-part-tabs"> 
      <div class="utf-popup-tab-content-item" id="candidate"> 
        <div class="utf-welcome-text-item">
          <h3>Welcome Back Sign in to Continue</h3>
          <span>Don't Have an Account? <a href="{{ ROOT_URL.'/candidate/register' }}" >Sign Up!</a></span> 
        </div>
       
        <p class="alert errMsg" style="color: red;"></p>        
       
        @if(Session::has('message'))
          <p class="alert {{ Session::get('alert alert-danger', 'alert-danger') }}" style="color: red;">{{ Session::get('message') }}</p>
        @endif
        <form method="post" id="candidatelogin-form" >
           {{csrf_field()}}
          <div class="utf-no-border">
            <input type="text" class="utf-with-border" name="emailaddress" id="emailaddress" placeholder="Email Address" required/>
             <span class="errMsg_emailaddress errDiv"></span>
          </div>
          <div class="utf-input-with-icon show-password">
            <input type="password" class="utf-with-border" name="password" id="password" placeholder="Password" required/>
               <i class="icon-feather-eye "></i>
              <span class="errMsg_password errDiv"></span>
          </div>
            <div class="row">
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
<!--   <div class="clearfix"></div> 
                </div>
            </div>
             <div class="col-12 mt-3"><span class="servererrormsg errDiv"></span></div>
       
           </form> 
             <button class="button full-width utf-button-sliding-icon ripple-effect candidatelogin" type="button" onclick="return validatorcandidate();" ><span>Log In </span><i class="icon-feather-chevrons-right"></i></button>  

             <button class="button full-width utf-button-sliding-icon ripple-effect candidateSociallogin" type="button" onclick="return candidateSocialLogin();" ><span> Sign In With Google </span><i class="icon-feather-chevrons-right"></i></button>  

          <div class="d-flex mt-3 justify-content-center">

              

            <span>Forgot Password? <a class="forgot-password" href="{{ ROOT_URL.'/candidate/forgetpassword' }}"> Click Here</a></span>
          </div>
        
      
      </div>
    </div>
  </div>
</div>-->
<!-- Sign In Popup / End -->

<!-- NGO modal / End -->
<!--<div id="small-dialog-2" class="zoom-anim-dialog mfp-hide dialog-with-tabs "> 
  <div class="utf-signin-form-part">
    <ul class="utf-popup-tabs-nav-item text-center">
      <li class="modal-title">NGO Login</li>
    </ul>
    <div class="utf-popup-container-part-tabs"> 
      <div class="utf-popup-tab-content-item"> 
        <div class="utf-welcome-text-item">
          <h3>Welcome Back Sign in to Continue</h3>
          <span>Don't Have an Account? <a href="{{ ROOT_URL.'/ngo/register' }}" >Sign Up!</a></span> 
        </div>
        <form method="post" id="partnerlogin-form" 
>
           {{csrf_field()}}
          <div class="utf-no-border">
            <input type="text" class="utf-with-border" name="emailaddpartner" id="emailaddpartner" placeholder="Email Address" required/>
             <span class="errMsg_emailaddpartner errDiv"></span>
          </div>
          <div class="utf-input-with-icon show-password">
            <input type="password" class="utf-with-border" name="passwordpartner" id="passwordpartner" placeholder="Password" required/>
             <i class="icon-feather-eye "></i>
              <span class="errMsg_password errDiv"></span>
          </div>
            <div class="row">
                <div class="col-12">
                    <div id="ngologincap"></div>
                </div>
                <div class="row mb-4">-->
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
<!--  <div class="col-12 mt-3"><span class="errMsg_captchaval errDiv"></span></div>
                    <div class="clearfix"></div>
                </div>
            </div>
             <div class="col-12 mt-3"><span class="errormsg errDiv"></span></div>
       
           </form> 
             <button class="button full-width utf-button-sliding-icon ripple-effect partnerLogin" type="button" onclick="return validatorpartnerlogin();" ><span>Log In </span><i class="icon-feather-chevrons-right"></i></button>  
          <div class="d-flex mt-3 justify-content-center">
            <span>Forgot Password? <a class="forgot-password" href="{{ ROOT_URL.'/ngo/forgetpassword' }}"> Click Here</a></span>
          </div>
        
      
      </div>
    </div>
  </div>
</div>-->
<!-- NGO modal / End -->


<!-- Press Release modal / Start -->
<div id="small-dialog-3" class="zoom-anim-dialog mfp-hide dialog-with-tabs press-release">
  <div class="utf-signin-form-part">
    <ul class="utf-popup-tabs-nav-item text-center">
      <li class="modal-title">Press Release – 3rd December 2022</li>
    </ul>
    <div class="utf-popup-container-part-tabs">
      <div class="utf-popup-tab-content-item">

        <h3 class="mb-3">Announcing The Say Foundation-Yunikee partnership</h3>
        <h4 class="mb-2">The Say Foundation Partners with Yunikee to enable job opportunities for PwDs</h4>
        <p>Today, The Say foundation announced its partnership with Yunikee to enable jobs with PwDs in India. The Say
          Foundation will collaborate with Yunikee to identify jobs, source talent & opportunities for PwDs, especially
          the deaf. </p>
        <p>The Say Foundation has initiated a registration drive for the deaf on their website, so that they can be
          intimated about the job opportunities available in different organisations across sectors. The registration
          drive is for Sign Medium participants - (define what is sign medium participants) </p>
        <p>"This collaboration with Yunikee is very exciting and provides us the right foot hold to create an inclusive
          eco-system for the PwDs. We will be working closely with the Yunikee team to empower the deaf and make them
          self-reliant, financially independent and productive contributors of the society." - said Swati Yadav, CEO of
          The Say Foundation</p>
        <p>The aim of Say Foundation is to provide PwDs with the right jobs, collaborate with NGOs by providing them a
          platform to share the skills of their associates and promote their organisation.</p>
        <p>In additon, Say Foundation works closely with the Government by accurately informing them about the
          happenings in the world of PwDs, recommending/influencing policies that will create a positive impact on the
          lives of the PwDs.</p>
        <p>Chaithanya of Yunikee said "We are the preferred partners for the Deaf community. We have trained over 5,500+
          deaf candidates in over 30+ skills in India. Our focus is on digital and in-demand skills that help the deaf
          community secure a high quality of life. </p>
        <p>The fundamental objective of our collaboration with Say Foundation is to provide employment for these skilled
          deaf associates and promote our programs to more PwDs through the network of Say Foundation.</p>
        <p>The Say Foundation and Yunikee have entered into a partnership to enable job opportunities for Persons with
          Disabilities (PwDs). This is exciting for both the organizations as we both have the common goal – of
          empowering PwDs and making them financially independent.</p>
        <p><span><strong>Say Foundation –</strong> <a
              href="javascript:void(0);">contactus@thesayfoundation.com</a></span></br>
          <span><strong>Yunikee/ Sign Medium –</strong> <a href="javascript:void(0);">contact@Yunikee.com</a></span>
        </p>


      </div>
    </div>
  </div>
</div>
<!-- Press Release modal / End -->

<!-- Page under construction modal -->
<!-- <div class="modal fade under-construction-modal" id="under-construction-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mb-0" id="modalLabel">
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </h5>

      </div>
      <div class="modal-body">
        <div>
          <h4>The website is under construction, few things may not work properly.</h4>   
        </div>
        <div class="mac-wrapper start">
          <svg width="100%" height="100%" viewBox="0 0 321 230" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
              <g id="MacBook">
                  <path id="Monitor" d="M43.492,0.054C43.492,0.054 33.882,-0.78 33.99,9.755C34.098,20.291 36.873,168.94 36.873,168.94C36.873,168.94 36.413,174.74 40.46,174.657C43.484,174.595 284.414,174.657 284.414,174.657C284.414,174.657 287.802,174.446 287.636,166.691C287.471,158.926 290.232,7.403 290.232,7.403C290.232,7.403 289.322,0.176 284.414,0.054C279.507,-0.068 43.492,0.054 43.492,0.054Z" style="fill:#fff;"/>
                  <clipPath id="_clip1">
                      <path d="M43.492,0.054C43.492,0.054 33.882,-0.78 33.99,9.755C34.098,20.291 36.873,168.94 36.873,168.94C36.873,168.94 36.413,174.74 40.46,174.657C43.484,174.595 284.414,174.657 284.414,174.657C284.414,174.657 287.802,174.446 287.636,166.691C287.471,158.926 290.232,7.403 290.232,7.403C290.232,7.403 289.322,0.176 284.414,0.054C279.507,-0.068 43.492,0.054 43.492,0.054Z"/>
                  </clipPath>
                  <g clip-path="url(#_clip1)">
                      <path id="MonitorBottom" d="M37.045,166.247L287.37,166.247L296.521,176.423L29.994,176.423L32.912,167.858L37.045,166.247Z" style="fill:#f0f0f0;"/>
                      <path id="Screen" d="M41.327,12.352L44.374,161.76L280.211,162.496L282.775,12.352L41.327,12.352Z" style="fill:#292929;"/>
                  </g>
                  <path id="Base" d="M0.148,221.598C0.133,220.574 0.83,219.636 0.83,219.636L33.989,175.534C35.497,173.386 39.911,173.514 39.911,173.514C39.911,173.514 279.422,173.479 284.325,173.514C289.228,173.549 290.232,175.939 290.232,175.939C290.232,175.939 315.123,211.433 319.185,217.682C320.328,219.442 320.103,221.711 320.1,222.9C319.997,228.085 317.079,229.881 317.079,229.881C317.079,229.881 6.437,229.948 3.992,229.881C1.546,229.814 0.988,228.339 0.348,226.959C-0.293,225.578 0.148,221.598 0.148,221.598L0.148,221.598Z" style="fill:#fff;"/>
                  <clipPath id="_clip2">
                      <path d="M0.148,221.598C0.133,220.574 0.83,219.636 0.83,219.636L33.989,175.534C35.497,173.386 39.911,173.514 39.911,173.514C39.911,173.514 279.422,173.479 284.325,173.514C289.228,173.549 290.232,175.939 290.232,175.939C290.232,175.939 315.123,211.433 319.185,217.682C320.328,219.442 320.103,221.711 320.1,222.9C319.997,228.085 317.079,229.881 317.079,229.881C317.079,229.881 6.437,229.948 3.992,229.881C1.546,229.814 0.988,228.339 0.348,226.959C-0.293,225.578 0.148,221.598 0.148,221.598L0.148,221.598Z"/>
                  </clipPath>
                  <g clip-path="url(#_clip2)">
                      <g id="Keyboard">
                          <path id="keyboard-space" d="M224.966,198.091L96.562,198.091L98.348,193.116L223.477,193.096L224.966,198.091Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard49" d="M49.783,193.124L46.783,198.091L31.419,198.091L34.773,193.126L49.783,193.124Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard48" d="M62.925,198.091L48.992,198.091L51.992,193.123L65.545,193.121L62.925,198.091Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard47" d="M79.355,198.091L65.062,198.091L67.682,193.121L81.501,193.119L79.355,198.091Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard46" d="M94.553,198.091L81.415,198.091L83.561,193.118L96.339,193.116L94.553,198.091Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard45" d="M240.382,198.091L226.894,198.091L225.405,193.096L238.396,193.094L240.382,198.091Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard44" d="M257.421,198.091L242.417,198.091L240.43,193.094L255.071,193.091L257.421,198.091Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard43" d="M268.544,198.091L259.51,198.091L257.16,193.091L265.902,193.09L268.544,198.091Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard42" d="M269.577,195.999L278.619,195.999L279.874,198.091L270.683,198.091L269.577,195.999Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard41" d="M290.931,198.091L282.079,198.091L279.076,193.088L287.821,193.086L290.931,198.091Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard40" d="M278.126,195.178L269.144,195.178L268.04,193.089L276.871,193.088L278.126,195.178Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard39" d="M63.683,176.58L61.57,180.094L43.584,180.097L45.982,176.547L63.683,176.58Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard38" d="M80.107,176.61L78.385,180.091L63.505,180.094L65.615,176.584L80.107,176.61Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard37" d="M96.547,176.641L95.215,180.089L80.235,180.091L81.955,176.614L96.547,176.641Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard36" d="M113.062,176.672L112.104,180.086L96.992,180.088L98.323,176.644L113.062,176.672Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard35" d="M129.595,176.702L128.926,180.083L113.826,180.086L114.783,176.675L129.595,176.702Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard34" d="M146.059,176.733L145.772,180.081L130.616,180.083L131.285,176.705L146.059,176.733Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard33" d="M162.439,176.763L162.537,180.078L147.436,180.08L147.723,176.736L162.439,176.763Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard32" d="M179.014,176.794L179.402,180.075L164.196,180.078L164.097,176.766L179.014,176.794Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard31" d="M195.578,176.825L196.339,180.073L181.071,180.075L180.684,176.797L195.578,176.825Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard30" d="M212.067,176.855L213.149,180.07L198.042,180.072L197.282,176.828L212.067,176.855Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard29" d="M228.458,176.886L229.87,180.067L214.898,180.07L213.817,176.858L228.458,176.886Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard28" d="M244.897,176.916L246.608,180.065L231.683,180.067L230.273,176.889L244.897,176.916Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard27" d="M261.375,176.947L263.068,180.062L248.495,180.064L246.786,176.92L261.375,176.947Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard26" d="M56.397,186.819L53.556,191.545L35.839,191.547L39.032,186.822L56.397,186.819Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard25" d="M72.813,191.542L55.762,191.544L58.603,186.819L75.151,186.816L72.813,191.542Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard24" d="M92.088,191.539L74.923,191.541L77.261,186.816L93.914,186.813L92.088,191.539Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard23" d="M111.43,191.535L94.115,191.538L95.941,186.813L112.756,186.81L111.43,191.535Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard22" d="M130.677,191.532L113.394,191.535L114.72,186.81L131.612,186.807L130.677,191.532Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard21" d="M149.973,191.529L132.604,191.532L133.539,186.807L150.379,186.804L149.973,191.529Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard20" d="M169.181,191.526L151.871,191.529L152.277,186.804L169.04,186.801L169.181,191.526Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard19" d="M188.48,191.523L171.072,191.526L170.932,186.801L187.922,186.798L188.48,191.523Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard18" d="M207.884,191.52L190.384,191.523L189.826,186.798L206.778,186.795L207.884,191.52Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard17" d="M227.132,191.517L209.826,191.52L208.719,186.795L225.542,186.792L227.132,191.517Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard16" d="M246.282,191.514L229.127,191.517L227.537,186.792L244.186,186.789L246.282,191.514Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard15" d="M265.447,191.511L248.351,191.514L246.254,186.789L262.88,186.786L265.447,191.511Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard14" d="M265.032,186.786L283.949,186.783L286.885,191.508L267.599,191.511L265.032,186.786Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard13" d="M63.421,181.308L60.974,185.378L40.005,185.381L42.754,181.311L63.421,181.308Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard12" d="M78.297,185.375L62.954,185.377L65.401,181.307L80.311,181.305L78.297,185.375Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard11" d="M95.638,185.372L80.191,185.375L82.205,181.305L97.211,181.302L95.638,185.372Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard10" d="M113.037,185.369L97.458,185.372L99.03,181.302L114.179,181.3L113.037,185.369Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard9" d="M130.344,185.367L114.8,185.369L115.942,181.3L131.149,181.297L130.344,185.367Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard8" d="M147.705,185.364L132.074,185.366L132.88,181.297L148.054,181.294L147.705,185.364Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard7" d="M164.987,185.361L149.408,185.364L149.758,181.294L164.866,181.292L164.987,185.361Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard6" d="M182.343,185.358L166.685,185.361L166.564,181.292L181.862,181.289L182.343,185.358Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard5" d="M199.802,185.356L184.052,185.358L183.571,181.289L198.849,181.286L199.802,185.356Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard4" d="M217.116,185.353L201.545,185.355L200.592,181.286L215.746,181.284L217.116,185.353Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard3" d="M234.344,185.35L218.906,185.353L217.537,181.283L232.538,181.281L234.344,185.35Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard2" d="M251.582,185.348L236.2,185.35L234.395,181.281L249.371,181.278L251.582,185.348Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard1" d="M268.434,185.345L253.514,185.347L251.303,181.278L266.223,181.276L268.434,185.345Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                          <path id="keyboard-return" d="M270.064,180.07L264.955,180.062L263.264,176.95L277.847,176.977L279.763,180.06L279.755,180.06L283.054,185.343L272.992,185.358L270.064,180.07Z" style="fill:#0d0000;fill-opacity:0.1;"/>
                      </g>
                      <path id="Trackpad" d="M96.136,199.49L88.014,221.323L231.405,222L225.178,199.49L96.136,199.49Z" style="fill:#f0f0f0;"/>
                      <path id="BaseFront" d="M320.12,220.574L326.048,224.74L323.687,235.617L0,235.617L-5.255,221.437L0.628,220.574C0.628,220.574 -1.201,223.94 8.606,224.039C18.414,224.138 133.47,224.039 133.47,224.039L136.171,228.295L184.19,228.295L187.105,224.039L313.932,224.74C317.877,224.854 320.241,223.706 320.12,220.574Z" style="fill:#f0f0f0;"/>
                      <path id="Shadow" d="M135.535,224.21L137.498,226.92L183.378,226.92L185.338,224.21L135.535,224.21Z" style="fill:#f0f0f0;"/>
                  </g>
                  <g id="CodeEditorWindow">
                      <clipPath id="_clip3">
                          <path id="CodeEditor" d="M68.863,30.416L71.588,144.464L252.946,144.464L254.313,30.416L68.863,30.416Z"/>
                      </clipPath>
                      <g clip-path="url(#_clip3)">
                          <g opacity="0.786239">
                              <path d="M68.863,30.416L71.588,144.464L252.946,144.464L254.313,30.416L68.863,30.416Z" style="fill:#506062;"/>
                              <clipPath id="_clip4">
                                  <path d="M68.863,30.416L71.588,144.464L252.946,144.464L254.313,30.416L68.863,30.416Z"/>
                              </clipPath>
                              <g clip-path="url(#_clip4)">
                                  <path id="Sidebar" d="M128.413,32.095L68.851,32.095L71.464,148.099L129.232,148.099L128.413,32.095Z" style="fill:#000901;"/>
                                  <clipPath id="_clip5">
                                      <path d="M128.413,32.095L68.851,32.095L71.464,148.099L129.232,148.099L128.413,32.095Z"/>
                                  </clipPath>
                                  <g clip-path="url(#_clip5)">
                                      <path d="M125.215,40.952L72.205,40.952L74.395,141.052L125.999,141.052L125.215,40.952Z" style="fill:#131413;"/>
                                      <clipPath id="_clip6">
                                          <path d="M125.215,40.952L72.205,40.952L74.395,141.052L125.999,141.052L125.215,40.952Z"/>
                                      </clipPath>
                                      <g clip-path="url(#_clip6)">
                                          <g>
                                              <path d="M106.976,45.439L74.979,45.439L75.011,46.88L107.009,46.88L106.976,45.439Z" style="fill:#9f9f9f;"/>
                                              <path d="M107.345,49.341L75.348,49.341L75.38,50.782L107.378,50.782L107.345,49.341Z" style="fill:#9f9f9f;"/>
                                              <path d="M107.374,53.243L75.377,53.243L75.409,54.684L107.407,54.684L107.374,53.243Z" style="fill:#9f9f9f;"/>
                                              <path d="M107.817,72.753L75.819,72.753L75.852,74.194L107.849,74.194L107.817,72.753Z" style="fill:#9f9f9f;"/>
                                              <path d="M112.482,57.145L80.485,57.145L80.518,58.586L112.515,58.586L112.482,57.145Z" style="fill:#9f9f9f;"/>
                                              <path d="M112.925,76.655L80.928,76.655L80.961,78.096L112.958,78.096L112.925,76.655Z" style="fill:#9f9f9f;"/>
                                              <path d="M112.571,61.047L80.574,61.047L80.606,62.488L112.604,62.488L112.571,61.047Z" style="fill:#9f9f9f;"/>
                                              <path d="M113.014,80.557L81.016,80.557L81.049,81.998L113.046,81.998L113.014,80.557Z" style="fill:#9f9f9f;"/>
                                              <path d="M112.678,68.851L80.681,68.851L80.713,70.292L112.711,70.292L112.678,68.851Z" style="fill:#9f9f9f;"/>
                                              <path d="M112.589,64.949L80.592,64.949L80.625,66.39L112.622,66.39L112.589,64.949Z" style="fill:#9f9f9f;"/>
                                          </g>
                                      </g>
                                      <path d="M125.176,34.89L114.037,34.89L114.155,39.694L125.176,39.694L125.176,34.89Z" style="fill:#131413;"/>
                                      <clipPath id="_clip7">
                                          <path d="M125.176,34.89L114.037,34.89L114.155,39.694L125.176,39.694L125.176,34.89Z"/>
                                      </clipPath>
                                      <g clip-path="url(#_clip7)">
                                          <g>
                                              <path d="M107.072,45.439L75.075,45.439L75.1,46.88L107.097,46.88L107.072,45.439Z" style="fill:#9f9f9f;"/>
                                              <path d="M107.42,49.341L75.423,49.341L75.448,50.782L107.445,50.782L107.42,49.341Z" style="fill:#9f9f9f;"/>
                                              <path d="M107.429,53.243L75.431,53.243L75.457,54.684L107.454,54.684L107.429,53.243Z" style="fill:#9f9f9f;"/>
                                              <path d="M107.769,72.753L75.772,72.753L75.797,74.194L107.795,74.194L107.769,72.753Z" style="fill:#9f9f9f;"/>
                                              <path d="M112.517,57.145L80.52,57.145L80.545,58.586L112.542,58.586L112.517,57.145Z" style="fill:#9f9f9f;"/>
                                              <path d="M112.857,76.655L80.86,76.655L80.885,78.096L112.883,78.096L112.857,76.655Z" style="fill:#9f9f9f;"/>
                                              <path d="M112.585,61.047L80.588,61.047L80.613,62.488L112.61,62.488L112.585,61.047Z" style="fill:#9f9f9f;"/>
                                              <path d="M112.925,80.557L80.928,80.557L80.953,81.998L112.951,81.998L112.925,80.557Z" style="fill:#9f9f9f;"/>
                                              <path d="M112.651,68.851L80.654,68.851L80.679,70.292L112.676,70.292L112.651,68.851Z" style="fill:#9f9f9f;"/>
                                              <path d="M112.583,64.949L80.586,64.949L80.611,66.39L112.608,66.39L112.583,64.949Z" style="fill:#9f9f9f;"/>
                                          </g>
                                      </g>
                                      <path d="M112.724,34.89L95.081,34.89L95.183,39.694L112.834,39.694L112.724,34.89Z" style="fill:#131413;"/>
                                      <clipPath id="_clip8">
                                          <path d="M112.724,34.89L95.081,34.89L95.183,39.694L112.834,39.694L112.724,34.89Z"/>
                                      </clipPath>
                                      <g clip-path="url(#_clip8)">
                                          <g>
                                              <path d="M84.048,45.439L33.368,45.439L33.408,46.88L84.088,46.88L84.048,45.439Z" style="fill:#9f9f9f;"/>
                                              <path d="M84.6,49.341L33.92,49.341L33.959,50.782L84.64,50.782L84.6,49.341Z" style="fill:#9f9f9f;"/>
                                              <path d="M84.614,53.243L33.933,53.243L33.973,54.684L84.654,54.684L84.614,53.243Z" style="fill:#9f9f9f;"/>
                                              <path d="M85.153,72.753L34.473,72.753L34.512,74.194L85.193,74.194L85.153,72.753Z" style="fill:#9f9f9f;"/>
                                              <path d="M92.673,57.145L41.992,57.145L42.032,58.586L92.713,58.586L92.673,57.145Z" style="fill:#9f9f9f;"/>
                                              <path d="M93.212,76.655L42.531,76.655L42.571,78.096L93.252,78.096L93.212,76.655Z" style="fill:#9f9f9f;"/>
                                              <path d="M92.781,61.047L42.1,61.047L42.14,62.488L92.82,62.488L92.781,61.047Z" style="fill:#9f9f9f;"/>
                                              <path d="M93.32,80.557L42.639,80.557L42.679,81.998L93.36,81.998L93.32,80.557Z" style="fill:#9f9f9f;"/>
                                              <path d="M92.885,68.851L42.205,68.851L42.245,70.292L92.925,70.292L92.885,68.851Z" style="fill:#9f9f9f;"/>
                                              <path d="M92.778,64.949L42.097,64.949L42.137,66.39L92.817,66.39L92.778,64.949Z" style="fill:#9f9f9f;"/>
                                          </g>
                                      </g>
                                  </g>
                                  <g id="Code">
                                      <g id="codeline1">
                                          <path d="M139.94,38.909L131.872,38.909L131.929,40.789L139.998,40.789L139.94,38.909Z" style="fill:#ed427f;"/>
                                          <path d="M154.565,38.909L141.631,38.909L141.688,40.789L154.623,40.789L154.565,38.909Z" style="fill:#306aea;"/>
                                          <path d="M179.583,38.909L156.71,38.909L156.768,40.789L179.64,40.789L179.583,38.909Z" style="fill:#2dcd47;"/>
                                          <path d="M187.431,38.909L181.559,38.909L181.616,40.789L187.489,40.789L187.431,38.909Z" style="fill:#ed427f;"/>
                                      </g>
                                      <g id="codeline2">
                                          <path d="M147.122,42.381L139.054,42.381L139.111,44.261L147.179,44.261L147.122,42.381Z" style="fill:#ed427f;"/>
                                          <path d="M161.747,42.381L148.813,42.381L148.87,44.261L161.805,44.261L161.747,42.381Z" style="fill:#306aea;"/>
                                          <path d="M186.764,42.381L163.892,42.381L163.95,44.261L186.822,44.261L186.764,42.381Z" style="fill:#2dcd47;"/>
                                          <path d="M194.613,42.381L188.74,42.381L188.798,44.261L194.671,44.261L194.613,42.381Z" style="fill:#ed427f;"/>
                                          <path d="M216.575,42.295L196.503,42.295L196.56,44.175L216.632,44.175L216.575,42.295Z" style="fill:#eac130;"/>
                                      </g>
                                      <g id="codeline3">
                                          <path d="M171.63,46.363L163.561,46.363L163.619,48.243L171.687,48.243L171.63,46.363Z" style="fill:#ed427f;"/>
                                          <path d="M161.789,46.363L146.313,46.363L146.371,48.243L161.846,48.243L161.789,46.363Z" style="fill:#306aea;"/>
                                          <path d="M144.541,46.363L139.086,46.363L139.143,48.243L144.598,48.243L144.541,46.363Z" style="fill:#eac130;"/>
                                      </g>
                                      <g id="codeline4">
                                          <path d="M180.314,49.835L157.404,49.835L157.461,51.715L180.371,51.715L180.314,49.835Z" style="fill:#ed427f;"/>
                                          <path d="M194.608,49.835L181.673,49.835L181.73,51.715L194.665,51.715L194.608,49.835Z" style="fill:#306aea;"/>
                                          <path d="M219.267,49.796L196.395,49.796L196.452,51.676L219.324,51.676L219.267,49.796Z" style="fill:#2dcd47;"/>
                                          <path d="M156.143,49.835L141.745,49.835L141.803,51.715L156.2,51.715L156.143,49.835Z" style="fill:#306aea;"/>
                                      </g>
                                      <g id="codeline5">
                                          <path d="M140.503,53.307L132.023,53.307L132.08,55.187L140.561,55.187L140.503,53.307Z" style="fill:#ed427f;"/>
                                          <path d="M162.343,53.307L142.271,53.307L142.328,55.187L162.4,55.187L162.343,53.307Z" style="fill:#eac130;"/>
                                          <path d="M184.183,53.307L164.111,53.307L164.168,55.187L184.24,55.187L184.183,53.307Z" style="fill:#306aea;"/>
                                      </g>
                                      <g id="codeline6">
                                          <path d="M147.263,56.779L139.195,56.779L139.252,58.659L147.321,58.659L147.263,56.779Z" style="fill:#ed427f;"/>
                                          <path d="M164.439,56.779L148.963,56.779L149.021,58.659L164.497,58.659L164.439,56.779Z" style="fill:#306aea;"/>
                                          <path d="M176.742,56.664L166.138,56.664L166.195,58.545L176.799,58.545L176.742,56.664Z" style="fill:#eac130;"/>
                                      </g>
                                      <g id="codeline7">
                                          <path d="M160.927,60.25L145.654,60.25L145.712,62.13L160.984,62.13L160.927,60.25Z" style="fill:#ed427f;"/>
                                          <path d="M143.967,60.25L139.231,60.25L139.289,62.13L144.025,62.13L143.967,60.25Z" style="fill:#306aea;"/>
                                          <path d="M178.368,60.136L162.613,60.136L162.67,62.016L178.425,62.016L178.368,60.136Z" style="fill:#2dcd47;"/>
                                      </g>
                                      <g id="codeline8">
                                          <path d="M140.227,66.313L132.159,66.313L132.216,68.193L140.285,68.193L140.227,66.313Z" style="fill:#ed427f;"/>
                                          <path d="M154.852,66.313L141.918,66.313L141.975,68.193L154.91,68.193L154.852,66.313Z" style="fill:#306aea;"/>
                                          <path d="M179.87,66.313L156.997,66.313L157.055,68.193L179.927,68.193L179.87,66.313Z" style="fill:#2dcd47;"/>
                                          <path d="M187.718,66.313L181.846,66.313L181.903,68.193L187.776,68.193L187.718,66.313Z" style="fill:#ed427f;"/>
                                      </g>
                                      <g id="codeline9">
                                          <path d="M147.409,69.785L139.341,69.785L139.398,71.665L147.466,71.665L147.409,69.785Z" style="fill:#ed427f;"/>
                                          <path d="M162.034,69.785L149.099,69.785L149.157,71.665L162.092,71.665L162.034,69.785Z" style="fill:#306aea;"/>
                                          <path d="M169.598,69.785L163.725,69.785L163.782,71.665L169.655,71.665L169.598,69.785Z" style="fill:#ed427f;"/>
                                          <path d="M191.559,69.699L171.487,69.699L171.545,71.579L191.617,71.579L191.559,69.699Z" style="fill:#eac130;"/>
                                      </g>
                                      <g id="codeline10">
                                          <path d="M171.917,73.767L163.848,73.767L163.906,75.647L171.974,75.647L171.917,73.767Z" style="fill:#ed427f;"/>
                                          <path d="M162.076,73.767L146.6,73.767L146.658,75.647L162.133,75.647L162.076,73.767Z" style="fill:#306aea;"/>
                                          <path d="M144.828,73.767L139.373,73.767L139.43,75.647L144.885,75.647L144.828,73.767Z" style="fill:#eac130;"/>
                                          <path d="M193.13,73.767L173.058,73.767L173.115,75.647L193.187,75.647L193.13,73.767Z" style="fill:#306aea;"/>
                                      </g>
                                      <g id="codeline11">
                                          <path d="M180.601,77.239L157.691,77.239L157.748,79.119L180.658,79.119L180.601,77.239Z" style="fill:#ed427f;"/>
                                          <path d="M194.895,77.239L181.96,77.239L182.017,79.119L194.952,79.119L194.895,77.239Z" style="fill:#306aea;"/>
                                          <path d="M156.43,77.239L142.032,77.239L142.09,79.119L156.487,79.119L156.43,77.239Z" style="fill:#306aea;"/>
                                      </g>
                                      <g id="codeline12">
                                          <path d="M140.79,80.711L132.31,80.711L132.367,82.591L140.848,82.591L140.79,80.711Z" style="fill:#ed427f;"/>
                                          <path d="M162.63,80.711L142.558,80.711L142.615,82.591L162.687,82.591L162.63,80.711Z" style="fill:#eac130;"/>
                                          <path d="M184.47,80.711L164.398,80.711L164.455,82.591L184.527,82.591L184.47,80.711Z" style="fill:#306aea;"/>
                                      </g>
                                      <g id="codeline13">
                                          <path d="M165.832,83.932L154.561,83.932L154.608,85.812L165.879,85.812L165.832,83.932Z" style="fill:#ed427f;"/>
                                          <path d="M153.403,83.932L139.479,83.932L139.537,85.812L153.461,85.812L153.403,83.932Z" style="fill:#306aea;"/>
                                          <path d="M178.606,83.932L166.979,83.932L167.027,85.812L178.654,85.812L178.606,83.932Z" style="fill:#2dcd47;"/>
                                      </g>
                                      <g id="codeline14">
                                          <path d="M139.94,90.638L131.872,90.638L131.929,92.518L139.998,92.518L139.94,90.638Z" style="fill:#ed427f;"/>
                                          <path d="M154.565,90.638L141.631,90.638L141.688,92.518L154.623,92.518L154.565,90.638Z" style="fill:#306aea;"/>
                                          <path d="M179.583,90.638L156.71,90.638L156.768,92.518L179.64,92.518L179.583,90.638Z" style="fill:#2dcd47;"/>
                                          <path d="M187.431,90.638L181.559,90.638L181.616,92.518L187.489,92.518L187.431,90.638Z" style="fill:#ed427f;"/>
                                      </g>
                                      <g id="codeline15">
                                          <path d="M147.122,94.11L139.054,94.11L139.111,95.99L147.179,95.99L147.122,94.11Z" style="fill:#ed427f;"/>
                                          <path d="M161.747,94.11L148.813,94.11L148.87,95.99L161.805,95.99L161.747,94.11Z" style="fill:#306aea;"/>
                                          <path d="M186.764,94.11L163.892,94.11L163.95,95.99L186.822,95.99L186.764,94.11Z" style="fill:#2dcd47;"/>
                                          <path d="M194.613,94.11L188.74,94.11L188.798,95.99L194.671,95.99L194.613,94.11Z" style="fill:#ed427f;"/>
                                          <path d="M216.575,94.024L196.503,94.024L196.56,95.904L216.632,95.904L216.575,94.024Z" style="fill:#eac130;"/>
                                      </g>
                                      <g id="codeline16">
                                          <path d="M171.63,98.092L163.561,98.092L163.619,99.972L171.687,99.972L171.63,98.092Z" style="fill:#ed427f;"/>
                                          <path d="M161.789,98.092L146.313,98.092L146.371,99.972L161.846,99.972L161.789,98.092Z" style="fill:#306aea;"/>
                                          <path d="M144.541,98.092L139.086,98.092L139.143,99.972L144.598,99.972L144.541,98.092Z" style="fill:#eac130;"/>
                                      </g>
                                      <g id="codeline17">
                                          <path d="M180.314,101.564L157.404,101.564L157.461,103.444L180.371,103.444L180.314,101.564Z" style="fill:#ed427f;"/>
                                          <path d="M194.608,101.564L181.673,101.564L181.73,103.444L194.665,103.444L194.608,101.564Z" style="fill:#306aea;"/>
                                          <path d="M156.143,101.564L141.745,101.564L141.803,103.444L156.2,103.444L156.143,101.564Z" style="fill:#306aea;"/>
                                      </g>
                                      <g id="codeline18">
                                          <path d="M140.503,105.036L132.023,105.036L132.08,106.916L140.561,106.916L140.503,105.036Z" style="fill:#ed427f;"/>
                                          <path d="M162.343,105.036L142.271,105.036L142.328,106.916L162.4,106.916L162.343,105.036Z" style="fill:#eac130;"/>
                                          <path d="M184.183,105.036L164.111,105.036L164.168,106.916L184.24,106.916L184.183,105.036Z" style="fill:#306aea;"/>
                                      </g>
                                      <g id="codeline19">
                                          <path d="M147.263,108.508L139.195,108.508L139.252,110.388L147.321,110.388L147.263,108.508Z" style="fill:#ed427f;"/>
                                          <path d="M164.439,108.508L148.963,108.508L149.021,110.388L164.497,110.388L164.439,108.508Z" style="fill:#306aea;"/>
                                          <path d="M176.742,108.394L166.138,108.394L166.195,110.274L176.799,110.274L176.742,108.394Z" style="fill:#eac130;"/>
                                      </g>
                                      <g id="codeline20">
                                          <path d="M160.927,111.979L145.654,111.979L145.712,113.86L160.984,113.86L160.927,111.979Z" style="fill:#ed427f;"/>
                                          <path d="M143.967,111.979L139.231,111.979L139.289,113.86L144.025,113.86L143.967,111.979Z" style="fill:#306aea;"/>
                                          <path d="M178.368,111.865L162.613,111.865L162.67,113.745L178.425,113.745L178.368,111.865Z" style="fill:#2dcd47;"/>
                                      </g>
                                      <g id="codeline21">
                                          <path d="M140.227,118.042L132.159,118.042L132.216,119.922L140.285,119.922L140.227,118.042Z" style="fill:#ed427f;"/>
                                          <path d="M154.852,118.042L141.918,118.042L141.975,119.922L154.91,119.922L154.852,118.042Z" style="fill:#306aea;"/>
                                          <path d="M179.87,118.042L156.997,118.042L157.055,119.922L179.927,119.922L179.87,118.042Z" style="fill:#2dcd47;"/>
                                          <path d="M187.718,118.042L181.846,118.042L181.903,119.922L187.776,119.922L187.718,118.042Z" style="fill:#ed427f;"/>
                                      </g>
                                      <g id="codeline22">
                                          <path d="M147.409,121.514L139.341,121.514L139.398,123.394L147.466,123.394L147.409,121.514Z" style="fill:#ed427f;"/>
                                          <path d="M162.034,121.514L149.099,121.514L149.157,123.394L162.092,123.394L162.034,121.514Z" style="fill:#306aea;"/>
                                          <path d="M169.598,121.514L163.725,121.514L163.782,123.394L169.655,123.394L169.598,121.514Z" style="fill:#ed427f;"/>
                                          <path d="M191.559,121.428L171.487,121.428L171.545,123.308L191.617,123.308L191.559,121.428Z" style="fill:#eac130;"/>
                                      </g>
                                      <g id="codeline23">
                                          <path d="M171.917,125.496L163.848,125.496L163.906,127.376L171.974,127.376L171.917,125.496Z" style="fill:#ed427f;"/>
                                          <path d="M162.076,125.496L146.6,125.496L146.658,127.376L162.133,127.376L162.076,125.496Z" style="fill:#306aea;"/>
                                          <path d="M144.828,125.496L139.373,125.496L139.43,127.376L144.885,127.376L144.828,125.496Z" style="fill:#eac130;"/>
                                          <path d="M193.13,125.496L173.058,125.496L173.115,127.376L193.187,127.376L193.13,125.496Z" style="fill:#306aea;"/>
                                      </g>
                                      <g id="codeline24">
                                          <path d="M180.601,128.968L157.691,128.968L157.748,130.848L180.658,130.848L180.601,128.968Z" style="fill:#ed427f;"/>
                                          <path d="M194.895,128.968L181.96,128.968L182.017,130.848L194.952,130.848L194.895,128.968Z" style="fill:#306aea;"/>
                                          <path d="M156.43,128.968L142.032,128.968L142.09,130.848L156.487,130.848L156.43,128.968Z" style="fill:#306aea;"/>
                                      </g>
                                      <g id="codeline25">
                                          <path d="M140.79,132.44L132.31,132.44L132.367,134.32L140.848,134.32L140.79,132.44Z" style="fill:#ed427f;"/>
                                          <path d="M162.63,132.44L142.558,132.44L142.615,134.32L162.687,134.32L162.63,132.44Z" style="fill:#eac130;"/>
                                          <path d="M184.47,132.44L164.398,132.44L164.455,134.32L184.527,134.32L184.47,132.44Z" style="fill:#306aea;"/>
                                      </g>
                                      <g id="codeline26">
                                          <path d="M165.832,135.661L154.561,135.661L154.608,137.541L165.879,137.541L165.832,135.661Z" style="fill:#ed427f;"/>
                                          <path d="M153.403,135.661L139.479,135.661L139.537,137.541L153.461,137.541L153.403,135.661Z" style="fill:#306aea;"/>
                                          <path d="M178.606,135.661L166.979,135.661L167.027,137.541L178.654,137.541L178.606,135.661Z" style="fill:#2dcd47;"/>
                                      </g>
                                  </g>
                                  <g id="AppBar">
                                      <path d="M254.159,30.416L254.107,33.773L56.763,33.773L56.679,30.416"/>
                                      <circle cx="71.395" cy="32.052" r="0.935" style="fill:#ff6059;"/>
                                      <circle cx="73.93" cy="32.052" r="0.935" style="fill:#ffc02f;"/>
                                      <circle cx="76.465" cy="32.052" r="0.935" style="fill:#28ca42;"/>
                                  </g>
                              </g>
                          </g>
                      </g>
                      <path id="CodeEditor1" d="M253.144,144.664L71.392,144.664L68.658,30.216L254.516,30.216L253.144,144.664ZM68.863,30.416L71.588,144.464L252.946,144.464L254.313,30.416L68.863,30.416Z" style="fill-opacity:0.786239;"/>
                  </g>
              </g>
          </svg>
          </div>


      </div>
    </div>
  </div>
</div> -->
<!-- Page under construction end -->
@include('components.admin-alert-modal')
@section('page-js')
<script>

  // $(document).ready(function(){
  //   $(".errMsg").hide();
  // });

  /* Added UserWay :- https://userway.org/ */
  (function (d) { var s = d.createElement("script"); s.setAttribute("data-account", "Mk5KJTJr42"); s.setAttribute("src", "https://cdn.userway.org/widget.js"); (d.body || d.head).appendChild(s); })(document)


  /* function generateCaptcha()
  {
      var ranNo = Math.floor((Math.random() * 100) + 1);
      $('.captchaImage').attr('src', SITE_URL + '/captcha?' + ranNo);
  } */

  function validatoremployeer() {

    $('.errDiv').hide();
    $('.error-input').removeClass('error-input');
    if (!blankCheck('emailidemployer', 'Email Id can not be left blank'))
      return false;
    if (!validEmail('emailidemployer'))
      return false;
    if (!blankCheck('passwordemployer', 'Password can not be left blank'))
      return false;
    /* if (!blankCheck('captchacode', 'Captcha can not be left blank'))
         return false;
     if (!maxLength('captchacode', 4, 'Captcha')){
        return false;
     }*/

    // var response = grecaptcha.getResponse(employerlogincap);
    // if(response.length == 0){
    //   $('.errMsg_captchacode').html('Please check captcha').show();
    //   return false;
    // }   

    var emailidemployer = $("#emailidemployer").val();
    var passwordemployer = $("#passwordemployer").val();
    // var captchacode=$("#captchacode").val();
    $.ajax({
      type: 'POST',
      url: SITE_URL + "/website/ajax/login",
      //data: {emailid:emailidemployer,password:passwordemployer,captcha:captchacode},
      data: $('#employeerlogin-form').serialize(),
      // async: false,
      dataType: "json",
      processData: true,
      beforeSend: function () {
        $(".employerlogin").attr('disabled', 'disabled');
        $(".employerlogin span").text('Logining In...');
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (res) {
        $(".employerlogin span").text('Log In');
        $(".employerlogin").removeAttr('disabled');
        $(".errMsg_emailidemployer").hide();
        $(".errMsg_passwordemployer").hide();
        //  $(".errMsg_captchacode").hide();
        $(".servererror").hide();

        if (res.status == 200) {
          $(".employerlogin").attr('disabled', 'disabled');
          $(".employerlogin span").text('Logining In...');
          window.location = SITE_URL + "/employer/dashboard";
        } else if (res.status == 300) {
          $(".servererror").html(res.msg);
          $(".servererror").show();
          //  generateCaptcha();
          //  grecaptcha.reset(employerlogincap);
        } else if (res.status == 500) {
          // generateCaptcha();
          // grecaptcha.reset(employerlogincap);
          if (res.msg.emailid != undefined) {
            $(".errMsg_emailidemployer").html(res.msg.emailid[0]);
            $(".errMsg_emailidemployer").show();
          } if (res.msg.password != undefined) {
            $(".errMsg_passwordemployer").html(res.msg.password[0]);
            $(".errMsg_passwordemployer").show();
            // }if(res.msg.captcha!=undefined){
            //   $(".errMsg_captchacode").html(res.msg.captcha[0]);
            //   $(".errMsg_captchacode").show();
          }
        }
        //  generateCaptcha();
        //  grecaptcha.reset(employerlogincap);
        return false;
      }
    });
  }


  function validatorcandidate() {
    $('.errDiv').hide();
    $('.error-input').removeClass('error-input');
    if (!blankCheck('emailaddress', 'Email Id can not be left blank'))
      return false;
    if (!validEmail('emailaddress'))
      return false;
    if (!blankCheck('password', 'Password can not be left blank'))
      return false;
    /*if (!blankCheck('captchaval', 'Captcha can not be left blank'))
        return false;
    if (!maxLength('captchaval', 4, 'Captcha'))
        return false;*/

    // var response = grecaptcha.getResponse(candidatelogincap);
    // if(response.length == 0){
    //   $('.errMsg_candidatelogincaptcha').html('Please check captcha').show();
    //   return false;
    // }      

    //var emailaddress=$("#emailaddress").val();
    //var password=$("#password").val();
    $.ajax({
      type: 'POST',
      url: SITE_URL + "/website/ajax/loginCandidate",
      //data: {emailid:emailaddress,password:password},
      data: $('#candidatelogin-form').serialize(),
      //async: false,
      dataType: "json",
      processData: true,
      beforeSend: function () {
        $(".candidatelogin").attr('disabled', 'disabled');
        $(".candidatelogin span").text('Logining In...');

      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (res) {
        $(".candidatelogin span").text('Log In');
        $(".candidatelogin").removeAttr('disabled');
        $(".errMsg_emailaddress").hide();
        $(".errMsg_password").hide();
        // $(".errMsg_captchaval").hide();
        $(".servererrormsg").hide();

        if (res.status == 200) {
          $(".candidatelogin").attr('disabled', 'disabled');
          $(".candidatelogin span").text('Logining In...');
          window.location = SITE_URL + "/candidate/dashboard";
        } else if (res.status == 300) {
          $(".servererrormsg").html(res.msg);
          $(".servererrormsg").show();
          //  generateCaptcha();
          //  grecaptcha.reset(candidatelogincap);
        } else if (res.status == 500) {
          // generateCaptcha();
          // grecaptcha.reset(candidatelogincap);
          if (res.msg.emailid != undefined) {
            $(".errMsg_emailaddress").html(res.msg.emailid[0]);
            $(".errMsg_emailaddress").show();
          } if (res.msg.password != undefined) {
            $(".errMsg_password").html(res.msg.password[0]);
            $(".errMsg_password").show();
            // }if(res.msg.captcha!=undefined){
            //   $(".errMsg_captchaval").html(res.msg.captcha[0]);
            //   $(".errMsg_captchaval").show();
          }
        } else if (res.status == 202) {
          $('#emailaddress').val('');
          $('#password').val('');
          $(".candidatelogin span").text('Log In');
          $(".candidatelogin").removeAttr('disabled');
          $(".errMsg").show();
          $(".errMsg").html(res.msg);
        }
        return false;
      }
    });
  }

  function validatorpartnerlogin() {

    $('.errDiv').hide();
    $('.error-input').removeClass('error-input');
    if (!blankCheck('emailaddpartner', 'Email Id can not be left blank'))
      return false;
    if (!validEmail('emailaddpartner'))
      return false;
    if (!blankCheck('passwordpartner', 'Password can not be left blank'))
      return false;
    /*if (!blankCheck('captchpartner', 'Captcha can not be left blank'))
        return false;
    if (!maxLength('captchpartner', 4, 'Captcha'))
        return false;*/
    // var response = grecaptcha.getResponse(ngologincap);
    // if(response.length == 0){
    //   $('.errMsg_captchpartner').html('Please check captcha').show();
    //   return false;
    // }   

    //var emailaddress=$("#emailaddpartner").val();
    //var password=$("#passwordpartner").val();
    //var captchaval=$("#captchpartner").val();
    $.ajax({
      type: 'POST',
      url: SITE_URL + "/website/ajax/loginPartner",
      //data: {emailid:emailaddress,password:password,captcha:captchaval},
      data: $('#partnerlogin-form').serialize(),
      //async: false,
      dataType: "json",
      processData: true,
      beforeSend: function () {
        $(".partnerLogin").attr('disabled', 'disabled');
        $(".partnerLogin span").text('Logining In...');


      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (res) {
        $(".partnerLogin span").text('Log In');
        $(".partnerLogin").removeAttr('disabled');
        $(".errMsg_emailaddpartner").hide();
        $(".errMsg_passwordpartner").hide();
        // $(".errMsg_captchpartner").hide();
        $(".errormsg").hide();

        if (res.status == 200) {
          $(".partnerLogin").attr('disabled', 'disabled');
          $(".partnerLogin span").text('Logining In...');
          window.location = SITE_URL + "/ngo/dashboard";
        } else if (res.status == 300) {
          $(".errormsg").html(res.msg);
          $(".errormsg").show();
          //  generateCaptcha();
          //  grecaptcha.reset(ngologincap);
        } else if (res.status == 500) {
          // generateCaptcha();
          // grecaptcha.reset(ngologincap);
          if (res.msg.emailid != undefined) {
            $(".errMsg_emailaddpartner").html(res.msg.emailid[0]);
            $(".errMsg_emailaddpartner").show();
          } if (res.msg.password != undefined) {
            $(".errMsg_passwordpartner").html(res.msg.password[0]);
            $(".errMsg_passwordpartner").show();
            // }if(res.msg.captcha!=undefined){
            //   $(".errMsg_captchpartner").html(res.msg.captcha[0]);
            //   $(".errMsg_captchpartner").show();
          }
        }
        return false;
      }
    });
  }


  /* Google Candidate Login Ajax */
  function candidateSocialLogin() {
    // alert("google login here");
    $.ajax({
      type: 'POST',
      url: SITE_URL + "/sociallogin/Googlelogin/socialLogin",
      processData: true,
      data: { formType: 'signIn', _token: '{{ csrf_token() }}' },
      beforeSend: function () {
        $(".candidatelogin").attr('disabled', 'disabled');
        $(".candidatelogin span").text('Logining In...');
      },
      success: function (res) {
        window.location = res;
      }
    });
  }


</script>
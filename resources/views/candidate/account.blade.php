@extends('layouts.candidatelayout')
@section('page-content')
  
  <!-- account -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>My Account</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}">Home</a></li>
              <li>My Account</li>
            </ul>
          </nav>
        </div>
      </div>    
    </div>

    <!-- Page Content -->
    <div class="utf-dashboard-content-inner-aera" style="min-height: 855px;"> 
        <div class="row"> 
          <div class="col-xl-6">
            <div class="dashboard-box margin-top-0 margin-bottom-30"> 
              <div class="headline">
                <h3>My Profile Details</h3>
              </div>
              <div class="content with-padding padding-bottom-0">
                <div class="row">
                  <div class="col">
                    <div class="row">
            <div class="col-xl-12">
            <div class="row">
              <div class="col-xl-5 col-md-3 col-sm-4">
                <div class="utf-avatar-wrapper" data-tippy-placement="top" data-tippy="" data-original-title="Change Profile Picture"> 
                  <img class="profile-pic" src="<?php echo PUBLIC_PATH; ?>images/user-avatar-placeholder.png" alt="">
                  <div class="upload-button"></div>
                  <input class="file-upload" type="file" accept="image/*">
                </div>
              </div>
              <div class="col-xl-7 col-md-9 col-sm-8"> 
                <div class="utf-submit-field">
                  <h5 class="text-center text-md-left">Account Type</h5>
                  <div class="utf-account-type">
                  <div>
                    <input type="radio" name="utf-account-type-radio" id="freelancer-radio" class="utf-account-type-radio" checked="">
                    <label for="freelancer-radio" data-tippy-placement="top" class="utf-ripple-effect-dark" data-tippy="" data-original-title="Employer"><i class="icon-material-outline-business-center"></i> Employer</label>
                  </div>
                  <div>
                    <input type="radio" name="utf-account-type-radio" id="employer-radio" class="utf-account-type-radio">
                    <label for="employer-radio" data-tippy-placement="top" class="utf-ripple-effect-dark" data-tippy="" data-original-title="Candidate"><i class="icon-material-outline-account-circle"></i> Candidate</label>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            </div>  
                      <div class="col-xl-12 col-md-6 col-sm-6">
                        <div class="utf-submit-field">
                          <h5>Your Name</h5>
                          <input type="text" class="utf-with-border" value="John Williams">
                        </div>
                      </div>
                      <div class="col-xl-12 col-md-6 col-sm-6">
                        <div class="utf-submit-field">
                          <h5>Phone Number</h5>
                          <input type="text" class="utf-with-border" value="(+22) 1201 123-456">
                        </div>
                      </div>
                      <div class="col-xl-12 col-md-6 col-sm-6">
                        <div class="utf-submit-field">
                          <h5>Email Address</h5>
                          <input type="text" class="utf-with-border" value="demo@example.com">
                        </div>
                      </div>
            <div class="col-xl-12 col-md-12 col-sm-12">
                        <div class="utf-submit-field">
                          <h5>Notes</h5>
                          <textarea name="notes" class="utf-with-border" cols="20" rows="3">Lorem Ipsum is simply dummy text of printing and type setting industry Lorem Ipsum been industry standard dummy text ever since.</textarea>
                        </div>
                      </div>
            <div class="col-xl-12 col-md-6 col-sm-6">
                        <div class="utf-submit-field">
                          <h5><i class="icon-brand-facebook"></i> Facebook</h5>
                          <input type="text" class="utf-with-border" value="https://www.facebook.com">
                        </div>
                      </div>
                      <div class="col-xl-12 col-md-6 col-sm-6">
                        <div class="utf-submit-field">
                          <h5><i class="icon-brand-twitter"></i> Twitter</h5>
                          <input type="text" class="utf-with-border" value="https://www.twitter.com">
                        </div>
                      </div>
            <div class="col-xl-12 col-md-6 col-sm-6">
                        <div class="utf-submit-field">
                          <h5><i class="icon-brand-linkedin"></i> Linkedin</h5>
                          <input type="text" class="utf-with-border" value="https://www.google.com">
                        </div>
                      </div>
            <div class="col-xl-12 col-md-6 col-sm-6">
                        <div class="utf-submit-field">
                          <h5><i class="icon-brand-google-plus-g"></i> Google+</h5>
                          <input type="text" class="utf-with-border" value="https://www.linkedin.com">
                        </div>
                      </div>            
                    </div>
                  </div>
                </div>
        <a href="javascript:void(0);" class="button ripple-effect big margin-top-10 margin-bottom-20">Save Changes</a>
              </div>
            </div>      
          </div>
          
          <div class="col-xl-6">
            <div id="test1" class="dashboard-box margin-top-0"> 
              <div class="headline">
                <h3>Change Password</h3>
              </div>
              <div class="content with-padding">
                <div class="row">
                  <div class="col-xl-12 col-md-6 col-sm-6">
                      <h5>Current Password</h5>
                     <div class="utf-input-with-icon show-password">
                      <input type="password" class="utf-with-border" data-tippy-placement="top" data-tippy="" data-original-title="Current Password">
                      <i class="icon-feather-eye "></i>
                    </div>
                  </div>
                  <div class="col-xl-12 col-md-6 col-sm-6">
                      <h5>New Password</h5>
                    <div class="utf-input-with-icon show-password">
                      <input type="password" class="utf-with-border" data-tippy-placement="top"  data-tippy="" data-original-title="The password must be at least 8 characters">
                      <i class="icon-feather-eye "></i>
                    </div>
                  </div>
                  <div class="col-xl-12 col-md-6 col-sm-6">
                      <h5>Confirm New Password</h5>
                    <div class="utf-input-with-icon show-password">
                      <input type="password" class="utf-with-border" data-tippy-placement="top"   data-original-title="The password must be at least 8 characters">
                      <i class="icon-feather-eye "></i>
                    </div>
                  </div>                  
                </div>
        <a href="javascript:void(0);" class="button ripple-effect big margin-top-10">Changes Password</a> 
              </div>        
            </div>
          </div>          
        </div>
        
      </div>
    <!-- Page Content ends -->
  </div>    
</div>
@endsection

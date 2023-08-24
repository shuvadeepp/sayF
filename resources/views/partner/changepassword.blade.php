@extends('layouts.partnerlayout')
@section('page-content')
  
  <!-- postJobs -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Change Password</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/ngo/dashboard">Home</a></li>
              <li>Change Password</li>

            </ul>
          </nav>

        </div>
      </div>   

    </div>
      @include('components.admin-msg-tap')
        
         
          <form method="post" id="reset-form" autocomplete="off">
            {{csrf_field()}}
            <div class="utf-dashboard-content-inner-aera">
              <div class="content with-padding">
                <div class="row justify-content-center">
                  <div class="col-12 col-md-6">
                    <div class="row dashboard-box p-4">
                      <div class="col-xl-12 col-md-6 col-sm-6">
                       <div class="utf-input-with-icon show-password">
                          <!-- <h5>Current Password</h5> -->
                           <input type="password" class="utf-with-border" maxlength="32" name="oldpassword" id="oldpassword" placeholder="Current Password">
                           <i class="icon-feather-eye "></i>
                            <span class="errMsg_oldpassword errDiv"></span>
                        
                        </div>
                      </div>
                      <div class="col-xl-12 col-md-6 col-sm-6">
                        <div class="utf-input-with-icon show-password">
                          <!-- <h5>New Password</h5> -->
                            <input type="password" class="utf-with-border" maxlength="32" name="newpassword" id="newpassword" placeholder="New Password">
                            <i class="icon-feather-eye "></i>
                            <span class="errMsg_newpassword errDiv"></span>
                          
                        </div>
                      </div>
                      <div class="col-xl-12 col-md-6 col-sm-6">
                       <div class="utf-input-with-icon show-password">
                          <!-- <h5>Confirm New Password</h5> -->
                           <input type="password" class="utf-with-border" maxlength="32" name="conpassword" id="conpassword" placeholder="Confirm New Password">
                           <i class="icon-feather-eye "></i>
                          <span class="errMsg_conpassword errDiv"></span>
                         
                        </div>
                      </div>    
                   
                        <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit" onclick="return validator();">Change password<i class="icon-feather-chevrons-right"></i></button>
                                  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        
              </div>   

    <!-- Page Content -->
  

    
    <!-- Page Content ends -->
  </div>    
</div>
@section('page-js')
<script
>
  function validator()
  {
      $('.errDiv').hide();
      $('.error-input').removeClass('error-input');
       if (!blankCheck('oldpassword', 'Current password can not be left blank'))
          return false;
      if (!blankCheck('newpassword', 'New password can not be left blank'))
          return false;
      if (!blankCheck('conpassword', 'Confirm password can not be left blank'))
          return false;
      if (!matchpassword('newpassword', 'conpassword'))
          return false;
      $('#reset-form').submit();  
        
  }
</script>
@endsection
@endsection


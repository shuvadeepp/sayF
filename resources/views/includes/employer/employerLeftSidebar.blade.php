<!-- Dashboard Sidebar -->
  <div class="utf-dashboard-sidebar-item">
    <div class="utf-dashboard-sidebar-item-inner" data-simplebar>
      <div class="utf-dashboard-nav-container"> 
        <!-- Responsive Navigation Trigger --> 
        <a href="#" class="utf-dashboard-responsive-trigger-item"> <span class="hamburger utf-hamburger-collapse-item" > <span class="utf-hamburger-box-item"> <span class="utf-hamburger-inner-item"></span> </span> </span> <span class="trigger-title">Dashboard Navigation Menu</span> </a> 
        <!-- Navigation -->
    <div class="utf-dashboard-nav">
    <div class="utf-dashboard-nav-inner">
      <div class="dashboard-profile-box">
        <span class="avatar-img">
          <img alt="" src="<?php echo (!empty(session('employer_session_data')) && !empty(session('employer_session_data.companyLogo')))?STORAGE_PATH.'companylogo'.'/'.session('employer_session_data.companyLogo'):PUBLIC_PATH.'images/user-avatar-placeholder.png';?>" class="photo">
        </span>
        <div class="user-profile-text">
          <span class="fullname">{{ session('employer_session_data.fullName') }}</span>
          <!-- <span class="user-role">Software Engineer</span> -->
        </div>
      </div>
      <div class="clearfix"></div>
            <ul>
              <li class="{{(request()->is('employer/dashboard')) ? 'active' : ''}}"><a href="<?php echo ROOT_URL; ?>/employer/dashboard"><i class="icon-material-outline-dashboard"></i>Dashboard</a></li>
              <li class="{{(request()->is('employer/employerprofile')) ? 'active' : ''}}"><a href="<?php echo ROOT_URL; ?>/employer/employerprofile"><i class="icon-feather-user"></i> Company Profile</a></li>
              <li class="{{(request()->is('employer/job/postjob')) ? 'active' : ''}}"><a href="<?php echo ROOT_URL; ?>/employer/job/postjob"><i class="icon-line-awesome-user-secret"></i> Post Job</a></li>
              <li class="{{(request()->is('employer/job/managejob')) ? 'active' : ''}}"><a href="<?php echo ROOT_URL; ?>/employer/job/managejob"><i class="icon-material-outline-supervisor-account"></i> Manage Jobs</a></li>
              <li class="{{(request()->is('employer/messages')) ? 'active' : ''}}"><a href="<?php echo ROOT_URL; ?>/employer/messages"><i class="icon-material-outline-rate-review"></i> Message</a></li>
            </ul>
          </div>
        </div>          
      </div>
    </div>
  </div>
  <!-- Dashboard Sidebar / End --> 
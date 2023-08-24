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
          <img alt="" src="<?php echo (!empty(session('candidate_session_data.image')))?ROOT_URL.'/storage/app/uploads/candidateProfile/'.session('candidate_session_data.image'):PUBLIC_PATH.'images/user-avatar-placeholder.png';?>" class="photo">
        </span>
        <div class="user-profile-text">
          <span class="fullname">{{ session('candidate_session_data.fullName') }}</span>
        <!--   <span class="user-role">Software Engineer</span> -->
        </div>
      </div>
      <div class="clearfix"></div>
            <ul>
              <li class="{{(request()->is('candidate/dashboard')) ? 'active' : ''}}"><a href="<?php echo ROOT_URL; ?>/candidate/dashboard"><i class="icon-material-outline-dashboard"></i>Dashboard</a></li>
              <li class="{{(request()->is('candidate/profile')) ? 'active' : ''}}"><a href="<?php echo ROOT_URL; ?>/candidate/profile"><i class="icon-line-awesome-user-secret"></i> Candidate Profile</a></li>
             <!--  <li><a href="dashboard-manage-resume.html"><i class="icon-material-outline-supervisor-account"></i> Post Jobs</a></li> -->
              <li><a href="<?php echo ROOT_URL; ?>/jobsearch"><i class="icon-material-outline-person-pin"></i> Explore Jobs</a></li>
              <li><a href="<?php echo ROOT_URL; ?>/savedjob"><i class="icon-feather-heart"></i> Saved Jobs</a></li>

              <li class="{{(request()->is('candidate/jobstatus')) ? 'active' : ''}}"><a href="<?php echo ROOT_URL; ?>/candidate/jobstatus"><i class="icon-line-awesome-wrench"></i> Job Status</a></li>
              <li class="{{(request()->is('candidate/message')) ? 'active' : ''}}"><a href="<?php echo ROOT_URL; ?>/candidate/message"><i class="icon-material-outline-rate-review"></i> Message</a></li>
              <!-- <li class="{{(request()->is('candidate/account')) ? 'active' : ''}}"><a href="<?php echo ROOT_URL; ?>/candidate/account"><i class="icon-feather-user"></i> Account</a></li> -->
            </ul>
          </div>
        </div>          
      </div>
    </div>
  </div>
  <!-- Dashboard Sidebar / End --> 
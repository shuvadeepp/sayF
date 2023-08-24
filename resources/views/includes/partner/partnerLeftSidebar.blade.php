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
          <img alt="" src="<?php echo (!empty(session('partner_session_data.image')))?STORAGE_PATH.'companylogo'.'/'.session('partner_session_data.companyLogo'):PUBLIC_PATH.'images/user-avatar-placeholder.png';?>" class="photo">
        </span>
        <div class="user-profile-text">
          <span class="fullname">{{ session('partner_session_data.fullName') }}</span>
          <!-- <span class="user-role">Software Engineer</span> -->
        </div>
      </div>
      <div class="clearfix"></div>
            <ul>
              <li class="{{(request()->is('ngo/dashboard')) ? 'active' : ''}}"><a href="<?php echo ROOT_URL; ?>/ngo/dashboard"><i class="icon-material-outline-dashboard"></i>Dashboard</a></li>
              <li class="{{(request()->is('ngo/partnerprofile')) ? 'active' : ''}}"><a href="<?php echo ROOT_URL; ?>/ngo/profile"><i class="icon-line-awesome-user-secret"></i> NGO Profile</a></li>

              <li class="{{(request()->is('ngo/messages')) ? 'active' : ''}}"><a href="<?php echo ROOT_URL; ?>/ngo/messages"><i class="icon-material-outline-rate-review"></i>  Messages</a></li>
             
            </ul>
          </div>
        </div>          
      </div>
    </div>
  </div>
  <!-- Dashboard Sidebar / End --> 
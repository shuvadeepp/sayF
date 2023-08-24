<header id="utf-header-container-block" class="fullwidth dashboard-header not-sticky app-header"> 
    <div id="header">
      <div class="container"> 

        <div class="app-header-container">
          <div class="utf-left-side"> 

            <div id="logo"> <a href="{{ROOT_URL}}"><img src="<?php echo PUBLIC_PATH; ?>images/logo.svg" alt=""></a> </div>
          </div>
          
          <div class="utf-right-side">           
            <div class="utf-header-widget-item hide-on-mobile"> 
              <div class="utf-header-notifications"> 
                <div class="utf-header-notifications-trigger notifications-trigger-icon"> <a href="#"><i class="icon-feather-bell"></i><span>5</span></a> </div>
                <div class="utf-header-notifications-dropdown-block">
                  <div class="utf-header-notifications-headline">
                    <h4>View All Notifications</h4>                  
                  </div>
                  <div class="utf-header-notifications-content">
                    <div class="utf-header-notifications-scroll" data-simplebar>
                      <ul>
                        <li class="notifications-not-read"><a href="dashboard-manage-resume.html"> <span class="notification-icon"><i class="icon-material-outline-group"></i></span> <span class="notification-text"> <strong>John Williams</strong> Applied for Jobs <span class="color_blue">Full Time</span> <strong>Web Designer</strong></span></a></li>
                        <li><a href="dashboard-manage-resume.html"><span class="notification-icon"><i class="icon-feather-briefcase"></i></span> <span class="notification-text"> <strong>John Williams</strong> Applied for Jobs <span class="color_green">Internship</span> <strong>Web Designer</strong></span></a></li>
                        <li><a href="dashboard-manage-resume.html"><span class="notification-icon"><i class="icon-feather-briefcase"></i></span> <span class="notification-text"> <strong>John Williams</strong> Applied for Jobs <span class="color_yellow">Part Time</span> <strong>Web Designer</strong></span></a></li>
              <li><a href="dashboard-manage-resume.html"><span class="notification-icon"><i class="icon-material-outline-group"></i></span> <span class="notification-text"> <strong>John Williams</strong> Applied for Jobs <span class="color_blue">Full Time</span> <strong>Web Designer</strong></span></a></li>
              <li><a href="dashboard-manage-resume.html"><span class="notification-icon"><i class="icon-material-outline-group"></i></span> <span class="notification-text"> <strong>John Williams</strong> Applied for Jobs <span class="color_yellow">Part Time</span> <strong>Web Designer</strong></span></a></li>
                      </ul>
                    </div>
                  </div>
           <!--    <a href="javascript:void(0);" class="utf-header-notifications-button ripple-effect utf-button-sliding-icon">See All Notifications<i class="icon-feather-chevrons-right"></i></a> -->
                    </div>
                  </div>            
                </div>
                
                <div class="utf-header-widget-item"> 
                  <div class="utf-header-notifications user-menu">
                    <div class="utf-header-notifications-trigger user-profile-title"> 
                      <a href="#">
                        <div class="user-avatar status-online"><img src="<?php echo PUBLIC_PATH; ?>images/user_small_1.jpg" alt=""> </div>  
                        <div class="user-name">Hi, {{ session('employer_session_data.fullName') }}!</div>  
                      </a> 
                    </div>
                    <div class="utf-header-notifications-dropdown-block"> 
                      <ul class="utf-user-menu-dropdown-nav">
                        <li><a href="dashboard.html"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
                        <li><a href="dashboard-jobs-post.html"><i class="icon-line-awesome-user-secret"></i> Manage Jobs Post</a></li>
                        <li><a href="dashboard-manage-jobs.html"><i class="icon-material-outline-group"></i> Manage Jobs</a></li>
                        <li><a href="dashboard-bookmarks.html"><i class="icon-feather-heart"></i> Bookmarks Jobs</a></li>
                        <li><a href="dashboard-my-profile.html"><i class="icon-feather-user"></i> My Profile</a></li>
                        <li><a href="index-1.html"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <span class="mmenu-trigger"> 
                <i class="icon-feather-menu"></i>
              </span>
          </div>        
        </div>
      </div>
    </div>    
  </header>
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
            <img alt="" src="<?php echo PUBLIC_PATH; ?>images/user-avatar-placeholder.png" class="photo">
          </span>
          <div class="user-profile-text">
            <span class="fullname">{{Session::get('admin_session_data.fullName')}}</span>
            <span class="user-role">Administrator</span>
          </div>
        </div>
        <div class="clearfix"></div>
              <ul>
                <li class="{{(request()->is('application/dashboard')) ? 'active' : ''}}"><a href="{{APP_URL.'dashboard'}}"><i class="icon-material-outline-dashboard"></i> Application Dashboard</a></li>
                <li  class="{{(request()->is('application/master*')) ? 'active active-submenu' : ''}}"><a href="javascript:void(0);"><i class="icon-material-outline-assignment"></i> Manage Master</a>
                    <ul class="dropdown-nav">
                   <!--    <li class="{{(request()->is('application/master/category')) ? 'active' : ''}}"><a href="{{APP_URL.'master/category'}}"><i class="icon-feather-chevrons-right"></i> Manage Category</a></li> -->
                      <li class="{{(request()->is('application/master/designation')) ? 'active' : ''}}"><a href="{{APP_URL.'master/designation'}}"><i class="icon-feather-chevrons-right"></i> Designation</a></li>
                      <li class="{{(request()->is('application/master/skill')) ? 'active' : ''}}"><a href="{{APP_URL.'master/skill'}}"><i class="icon-feather-chevrons-right"></i> Skill</a></li>
                      <li class="{{(request()->is('application/master/jobtype')) ? 'active' : ''}}"><a href="{{APP_URL.'master/jobtype'}}"><i class="icon-feather-chevrons-right"></i> Job Type</a></li>
                      <li class="{{(request()->is('application/master/disability')) ? 'active' : ''}}"><a href="{{APP_URL.'master/disability'}}"><i class="icon-feather-chevrons-right"></i> Disability</a></li>
                      <li class="{{(request()->is('application/master/disabilitysubtype')) ? 'active' : ''}}"><a href="{{APP_URL.'master/disabilitysubtype'}}"><i class="icon-feather-chevrons-right"></i> Disability Subtype</a></li>
                      <li class="{{(request()->is('application/master/qualification')) ? 'active' : ''}}"><a href="{{APP_URL.'master/qualification'}}"><i class="icon-feather-chevrons-right"></i> Job Qualification</a></li>
                   <!--    <li class="{{(request()->is('application/master/qualificationsubcategory')) ? 'active' : ''}}"><a href="{{APP_URL.'master/qualificationsubcategory'}}"><i class="icon-feather-chevrons-right"></i> Manage Qualification Sub-cat</a></li> -->
                      <li class="{{(request()->is('application/master/industry')) ? 'active' : ''}}"><a href="{{APP_URL.'master/industry'}}"><i class="icon-feather-chevrons-right"></i> Industry</a></li>
                      <li class="{{(request()->is('application/master/education')) ? 'active' : ''}}"><a href="{{APP_URL.'master/education'}}"><i class="icon-feather-chevrons-right"></i> Candidate Education</a></li>
                        <li class="{{(request()->is('application/master/board')) ? 'active' : ''}}"><a href="{{APP_URL.'master/board'}}"><i class="icon-feather-chevrons-right"></i> Board</a></li>
                        <li class="{{(request()->is('application/master/blog')) ? 'active' : ''}}"><a href="{{APP_URL.'master/blog'}}"><i class="icon-feather-chevrons-right"></i> Blog</a></li>
                        <li class="{{(request()->is('application/master/service')) ? 'active' : ''}}"><a href="{{APP_URL.'master/service'}}"><i class="icon-feather-chevrons-right"></i> Service</a></li>
                         <li class="{{(request()->is('application/master/douknow')) ? 'active' : ''}}"><a href="{{APP_URL.'master/douknow'}}"><i class="icon-feather-chevrons-right"></i> Did you know</a></li>
                         <li class="{{(request()->is('application/master/gallery')) ? 'active' : ''}}"><a href="{{APP_URL.'master/gallery'}}"><i class="icon-feather-chevrons-right"></i> Gallery </a></li>
                         <li class="{{(request()->is('application/master/Banner')) ? 'active' : ''}}"><a href="{{APP_URL.'master/Banner'}}"><i class="icon-feather-chevrons-right"></i> Banner </a></li>
                         <li class="{{(request()->is('application/master/Resource')) ? 'active' : ''}}"><a href="{{APP_URL.'master/Resource'}}"><i class="icon-feather-chevrons-right"></i> Resource </a></li>
                         <li class="{{(request()->is('application/master/Testimonial/viewTestimonial')) ? 'active' : ''}}"><a href="{{APP_URL.'master/Testimonial/viewTestimonial'}}"><i class="icon-feather-chevrons-right"></i> Testimonial </a></li>
                         <li class="{{(request()->is('application/master/PressRelease')) ? 'active' : ''}}"><a href="{{APP_URL.'master/PressRelease'}}"><i class="icon-feather-chevrons-right"></i> Press Release </a></li>
                         <li class="{{(request()->is('application/master/importCandidate')) ? 'active' : ''}}"><a href="{{APP_URL.'Import/importCandidate'}}"><i class="icon-feather-chevrons-right"></i> Import Candidate </a></li>
                         
                    </ul>
                </li>
                <!-- <li><a href="dashboard-my-profile.html"><i class="icon-feather-user"></i> Account</a></li> -->
                <li class="{{(request()->is('application/managejob*')) ? 'active active-submenu' : ''}}"><a href="javascript:void(0);"><i class="icon-material-outline-assignment"></i> Manage Job</a>
                  <ul class="dropdown-nav">
                    <li class="{{(request()->is('application/managejob/postedjob')) ? 'active' : ''}}"><a href="{{APP_URL.'managejob/postedjob'}}"><i class="icon-feather-chevrons-right"></i> Posted Jobs </a></li>
                    <!-- <li class="{{(request()->is('application/import/importjob')) ? 'active' : ''}}"><a href="{{APP_URL.'import/importjob'}}"><i class="icon-feather-chevrons-right"></i> Import Jobs </a></li>
                    <li class="{{(request()->is('application/import/importCandidate')) ? 'active' : ''}}"><a href="{{APP_URL.'import/importCandidate'}}"><i class="icon-feather-chevrons-right"></i> Import Candidate </a></li> -->
                  </ul>
                </li>
                <li class="{{(request()->is('application/candidate')) ? 'active' : ''}}"><a href="{{APP_URL.'candidate'}}"><i class="icon-material-outline-assignment"></i> Candidate List</a></li>
                <li class="{{(request()->is('application/subscriber')) ? 'active' : ''}}"><a href="{{APP_URL.'subscriber'}}"><i class="icon-material-outline-assignment"></i> Subscriber List</a></li>
              </ul>
            </div>
          </div>          
        </div>
      </div>
    </div>
    <!-- Dashboard Sidebar / End --> 
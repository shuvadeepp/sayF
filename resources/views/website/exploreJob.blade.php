@extends('layouts.website')
@section('page-content')
<div class="page-wrapper pt-0">
  <!-- Titlebar -->
  <div id="titlebar" class="gradient">
    <div class="container">
      <div class="row">
      <div class="col-md-12">
        <h2>Explore Jobs</h2>
        <nav id="breadcrumbs">
        <ul>
          <li><a href="index-1.html">Home</a></li>
          <li>Explore Jobs</li>
        </ul>
        </nav>
      </div>
      </div>
    </div>
  </div>
  <!-- Titlebar End -->

    <!-- Search Jobs Start -->
  <div class="inner_search_block_section">
    <div class="container">
      <div class="col-md-12">
        <div class="utf-intro-banner-search-form-block"> 
        <div class="utf-intro-search-field-item">
          <i class="icon-feather-search"></i>
          <input id="intro-keywords" type="text" placeholder="Search Jobs Keywords...">
        </div>
        <div class="utf-intro-search-field-item">
          <select class="selectpicker default" data-live-search="true" data-selected-text-format="count" data-size="5" title="Select Location">
            <option>Afghanistan</option>
            <option>Albania</option>
            <option>Algeria</option>
            <option>Brazil</option>
            <option>Burundi</option>
            <option>Bulgaria</option>
            <option>Germany</option>
            <option>Grenada</option>
            <option>Guatemala</option>
            <option>Iceland</option>
          </select>
        </div>
        <div class="utf-intro-search-button">
          <button class="button ripple-effect" onclick="window.location.href='jobs-list-layout-leftside.html'"><i class="icon-material-outline-search"></i> Search</button>
        </div>
        </div>
        <p class="utf-trending-silver-item"><span class="utf-trending-black-item">Trending Jobs Keywords:</span> Web Designer,  Web Developer,  Graphic Designer,  PHP Developer,  IOS Developer,  Android Developer</p>
      </div>
    </div>      
    </div>
    <!-- Search Jobs End -->

    <div class="container">
    <div class="row">
      <div class="col-xl-3 col-lg-4">
        <div class="utf-sidebar-container-aera">
      <div class="utf-sidebar-widget-item">
      <div class="utf-quote-box utf-jobs-listing-utf-quote-box">
        <div class="utf-quote-info">
          <h4>Make a Difference with Online Resume!</h4>
          <p>Your Resume in Minutes with Jobs Resume Assistant is Ready!</p>
          <a href="register.html" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0">Create Account <i class="icon-feather-chevrons-right"></i></a>
        </div>
      </div>
      </div>
      
      <div class="utf-sidebar-widget-item">
            <h3>Search Keywords</h3>
            <div class="utf-input-with-icon">
                <input type="text" placeholder="Search Keywords...">
                <i class="icon-material-outline-search"></i> 
      </div>
          </div>
      
          <div class="utf-sidebar-widget-item">
            <h3>Category</h3>
            <select class="selectpicker" data-live-search="true" data-selected-text-format="count" data-size="7" title="All Categories">
              <option>Web Design</option>
              <option>Accountant</option>
              <option>Data Analytics</option>
              <option>Marketing</option>
              <option>Software Developing</option>
              <option>IT & Networking</option>
              <option>Translation</option>
              <option>Sales & Marketing</option>
            </select>
          </div>
      
      <div class="utf-sidebar-widget-item">
            <h3>Gender</h3>
            <select class="selectpicker" data-size="3" title="Gender">
              <option>Male</option>
              <option>Female</option>
              <option>Others</option>              
            </select>
          </div>
          
          <div class="utf-sidebar-widget-item">
            <h3>Job Type</h3>
            <div class="utf-radio-btn-list">
        <div class="checkbox">
          <input type="checkbox" id="chekcbox1" checked>
          <label for="chekcbox1"><span class="checkbox-icon"></span> Full Time Jobs</label>
        </div>
        <div class="checkbox">
          <input type="checkbox" id="chekcbox2">
          <label for="chekcbox2"><span class="checkbox-icon"></span> Part Time Jobs</label>
        </div>
        <div class="checkbox">
          <input type="checkbox" id="chekcbox3">
          <label for="chekcbox3"><span class="checkbox-icon"></span> Freelancer Jobs</label>
        </div>
        <div class="checkbox">
          <input type="checkbox" id="chekcbox4">
          <label for="chekcbox4"><span class="checkbox-icon"></span> Internship Jobs</label>
        </div>
        <div class="checkbox">
          <input type="checkbox" id="chekcbox5">
          <label for="chekcbox5"><span class="checkbox-icon"></span> Temporary Jobs</label>
        </div>        
            </div>
          </div>
      <div class="clearfix"></div>
      
      <div class="utf-sidebar-widget-item">
            <h3>Experince</h3>
            <div class="utf-radio-btn-list">
        <div class="checkbox">
          <input type="checkbox" id="chekcbox01" checked>
          <label for="chekcbox01"><span class="checkbox-icon"></span> 1Year to 2Year</label>
        </div>
        <div class="checkbox">
          <input type="checkbox" id="chekcbox02">
          <label for="chekcbox02"><span class="checkbox-icon"></span> 2Year to 3Year</label>
        </div>
        <div class="checkbox">
          <input type="checkbox" id="chekcbox03">
          <label for="chekcbox03"><span class="checkbox-icon"></span> 3Year to 4Year</label>
        </div>
        <div class="checkbox">
          <input type="checkbox" id="chekcbox04">
          <label for="chekcbox04"><span class="checkbox-icon"></span> 4Year to 5Year</label>
        </div>        
            </div>
          </div>
      <div class="clearfix"></div>
      
      <div class="utf-sidebar-widget-item">
            <h3>Career Level</h3>
            <div class="utf-radio-btn-list">
        <div class="checkbox">
          <input type="checkbox" id="chekcbox001" checked>
          <label for="chekcbox001"><span class="checkbox-icon"></span> Intermediate</label>
        </div>
        <div class="checkbox">
          <input type="checkbox" id="chekcbox002">
          <label for="chekcbox002"><span class="checkbox-icon"></span> Normal</label>
        </div>
        <div class="checkbox">
          <input type="checkbox" id="chekcbox003">
          <label for="chekcbox003"><span class="checkbox-icon"></span> Special</label>
        </div>
        <div class="checkbox">
          <input type="checkbox" id="chekcbox004">
          <label for="chekcbox004"><span class="checkbox-icon"></span> Experienced</label>
        </div>  
            </div>
          </div>
          
          <div class="utf-sidebar-widget-item">
            <h3>Hourly Rate</h3>
            <div class="margin-top-55"></div>            
            <input class="range-slider" type="text" value="" data-slider-currency="$" data-slider-min="5000" data-slider-max="50000" data-slider-step="100" data-slider-value="[5000,40000]"/>
          </div>
          
          <div class="utf-sidebar-widget-item">
            <h3>Skills</h3>
            <div class="utf-tags-container-item">
              <div class="tag">
                <input type="checkbox" id="tag1"/>
                <label for="tag1">HTML 5</label>
              </div>
              <div class="tag">
                <input type="checkbox" id="tag2"/>
                <label for="tag2">Javascript</label>
              </div>
              <div class="tag">
                <input type="checkbox" id="tag3"/>
                <label for="tag3">Web Design</label>
              </div>
              <div class="tag">
                <input type="checkbox" id="tag4"/>
                <label for="tag4">Graphic Designer</label>
              </div>        
            </div>
            <div class="clearfix"></div>
          </div>
      
        </div>
      </div>
    
      <div class="col-xl-9 col-lg-8">
        <div class="utf-notify-box-aera">
          <div class="utf-switch-container-item">
            <span>Showing 1–10 of 50 Jobs Results :</span>      
          </div>          
      <div class="sort-by">
        <span>Sort By:</span>
        <select class="selectpicker hide-tick">
          <option>A to Z</option>
          <option>Newest</option>
          <option>Oldest</option>
          <option>Random</option>
        </select>
      </div>
        </div>
    
        <div class="utf-listings-container-part compact-list-layout"> 
      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_1.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
          <h3 class="utf-job-listing-title">Web Designer, Graphic Designer, UI/UX Designer & Art <span class="utf-verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 15 Minute Ago</li>
          </ul>
          </div>
        </div>
        <span class="bookmark-icon"></span> 
         </div>
      </a> 

      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_2.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
          <h3 class="utf-job-listing-title">PHP Developer, Team of PHP & IT Co</h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 30 Minute Ago</li>
          </ul>
          </div>
        </div>
        <span class="bookmark-icon"></span> 
         </div>
      </a> 
      
      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_3.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
          <h3 class="utf-job-listing-title">Website Developer & Software Developer</h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 48 Minute Ago</li>
          </ul>
          </div>
        </div>
        <span class="bookmark-icon"></span> 
         </div>
      </a> 
          
      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_4.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
          <h3 class="utf-job-listing-title">Head of Developers & MySQL Developers <span class="utf-verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 55 Minute Ago</li>
          </ul>
          </div>
        </div>
        <span class="bookmark-icon"></span> 
         </div>
      </a> 
          
      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_5.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
          <h3 class="utf-job-listing-title">Application Developer & Web Designer</h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 1 Days Ago</li>
          </ul>
          </div>
        </div>
        <span class="bookmark-icon"></span>
         </div>
      </a> 
          
      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_6.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
          <h3 class="utf-job-listing-title">IT Department Manager & Blogger-Entrepenour</h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 3 Days Ago</li>
          </ul>
          </div>
        </div>            
        <span class="bookmark-icon"></span> 
         </div>
      </a> 
          
      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_7.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
          <h3 class="utf-job-listing-title">Frontend/Backendd Developer</h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 5 Days Ago</li>
          </ul>
          </div>
        </div>
        <span class="bookmark-icon"></span> 
         </div>
      </a> 
          
      <a href="single-job-page.html" class="utf-job-listing">           
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_8.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
          <h3 class="utf-job-listing-title">Web Designer and Graphic Designer</h3>              
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 5 Days Ago</li>
          </ul>
          </div>
        </div>            
        <span class="bookmark-icon"></span> 
         </div>
      </a>

      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_9.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
          <h3 class="utf-job-listing-title">Web Designer, Graphic Designer, UI/UX Designer & Art <span class="utf-verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 15 Minute Ago</li>
          </ul>
          </div>
        </div>
        <span class="bookmark-icon"></span> 
         </div>
      </a> 

      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_10.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Part Time</span>
          <h3 class="utf-job-listing-title">PHP Developer, Team of PHP & IT Co</h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 30 Minute Ago</li>
          </ul>
          </div>
        </div>
        <span class="bookmark-icon"></span> 
         </div>
      </a> 
      
      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_1.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
          <h3 class="utf-job-listing-title">Website Developer & Software Developer</h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 48 Minute Ago</li>
          </ul>
          </div>
        </div>
        <span class="bookmark-icon"></span> 
         </div>
      </a>
      
      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_2.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
          <h3 class="utf-job-listing-title">Web Designer, Graphic Designer, UI/UX Designer & Art <span class="utf-verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 15 Minute Ago</li>
          </ul>
          </div>
        </div>
        <span class="bookmark-icon"></span> 
         </div>
      </a> 

      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_3.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Part Time</span>
          <h3 class="utf-job-listing-title">PHP Developer, Team of PHP & IT Co</h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 30 Minute Ago</li>
          </ul>
          </div>
        </div>
        <span class="bookmark-icon"></span> 
         </div>
      </a> 
      
      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_4.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
          <h3 class="utf-job-listing-title">Website Developer & Software Developer</h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 48 Minute Ago</li>
          </ul>
          </div>
        </div>
        <span class="bookmark-icon"></span> 
         </div>
      </a> 
          
      <a href="single-job-page.html" class="utf-job-listing"> 
        <div class="utf-job-listing-details"> 
        <div class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_5.png" alt=""> </div>
        <div class="utf-job-listing-description">
          <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i> Full Time</span>
          <h3 class="utf-job-listing-title">Head of Developers & MySQL Developers <span class="utf-verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h3>
          <div class="utf-job-listing-footer">
          <ul>
            <li><i class="icon-feather-briefcase"></i> Software Developer</li>
            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
            <li><i class="icon-material-outline-location-on"></i> Drive Potsdam, NY 676</li>
            <li><i class="icon-material-outline-access-time"></i> 55 Minute Ago</li>
          </ul>
          </div>
        </div>
        <span class="bookmark-icon"></span> 
         </div>
      </a>
    </div>
        
        <!-- Pagination -->
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12"> 
            <div class="utf-pagination-container-aera mb-4 mt-md-4 mb-md-5">
              <nav class="pagination">
                <ul>
                  <li class="utf-pagination-arrow"><a href="#"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
                  <li><a href="#" class="current-page">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li class="utf-pagination-arrow"><a href="#"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </div>

</div>
@endsection

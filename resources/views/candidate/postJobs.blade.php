@extends('layouts.app')
@section('page-content')
  
  <!-- postJobs -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Post Jobs</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/candidate/dashboard">Home</a></li>
              <li>Post Jobs</li>
            </ul>
          </nav>
        </div>
      </div>    
    </div>

    <!-- Page Content -->
    <div class="utf-dashboard-content-inner-aera"> 
        <div class="row"> 
      <div class="col-xl-12">
        <div class="mb-2">
          <a href="javascript:void(0);" class="button utf-ripple-effect-dark">View Jobs</a>      
        </div>
      </div>

      <div class="col-xl-12">
            <div class="dashboard-box"> 
              <div class="content with-padding padding-bottom-10">
                <div class="row">
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>First Name</h5>
                      <input type="text" class="utf-with-border" placeholder="First Name">
                    </div>
                  </div>
          <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Last Name</h5>
                      <input type="text" class="utf-with-border" placeholder="Last Name">
                    </div>
                  </div>
          <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Email Address</h5>
                      <input type="email" class="utf-with-border" placeholder="Email Address">
                    </div>
                  </div>
          <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Phone Number</h5>
                      <input type="text" class="utf-with-border" placeholder="Phone Number">
                    </div>
                  </div>
          <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Designation</h5>
                      <input type="text" class="utf-with-border" placeholder="Designation">
                    </div>
                  </div>
          <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Job Category</h5>
                      <select class="selectpicker utf-with-border" data-size="7" title="Select Category">
                        <option>Accounting and Finance</option>
                        <option>Clerical & Data Entry</option>
                        <option>Counseling</option>
                        <option>Court Administration</option>
                        <option>Human Resources</option>
                        <option>Investigative</option>
                        <option>IT and Computers</option>
                        <option>Law Enforcement</option>
                        <option>Management</option>
                        <option>Miscellaneous</option>
                        <option>Public Relations</option>
                      </select>
                    </div>
                  </div>
        
               
              
                  <div class="col-xl-12 col-md-12 col-sm-12">
                    <div class="utf-submit-field">
                      <h5>Career Description</h5>
            <textarea cols="40" rows="2" class="utf-with-border" placeholder="Career Description..."></textarea>                      
                    </div>
                  </div>
                </div>
              <div class="utf-centered-button">
                <a href="javascript:void(0);" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0">Add Job<i class="icon-feather-plus"></i></a>      
              </div>
              </div>        
            </div>
          </div>  
       
        </div>
        
                
      </div>
    <!-- Page Content ends -->
  </div>    
</div>
@endsection

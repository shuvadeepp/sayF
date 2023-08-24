<?php //echo "<pre>";print_r($jobData->employer);exit; 
/*if(!empty(session('admin_session_data'))){ ?>
@extends('layouts.adminlayout')
<?php } if(!empty(session('employer_session_data'))){ ?>
  @extends('layouts.employerlayout')
<?php }*/ ?>
@extends(!empty(session('admin_session_data')) ? 'layouts.adminlayout' : 'layouts.employerlayout');
@section('page-content')
<div class="utf-dashboard-content-container-aera" data-simplebar>
  <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
    <div class="row">
      <div class="col-xl-12"> 
        <h3>Job Preview</h3>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}/employer/dashboard">Home</a></li>
            <li>Job Preview</li>
          </ul>
        </nav>
      </div>
    </div>    
  </div>
   @include('components.admin-msg-tap')
<div class="utf-dashboard-content-inner-aera">   
  <div class="row">
      <div class="col-xl-8">
        <div class="job-apply-card">
          <h2 class="utf-job-listing-title mb-2">{{$jobData->jobTitle}}</h2>
          <span>{{@$jobData->employer->employerCompany}} </span>
          <div class="d-md-flex justify-content-md-between">
            <div class="utf-job-listing-footer align-self-end mb-3 mb-md-0">
              <ul>
                <li><i class="icon-line-awesome-user"></i> {{$jobData->minExp}} year(s)</li>
                <li><i class="icon-material-outline-account-balance-wallet"></i><span
                    class="icon-line-awesome-inr"></span>{{ indianCurrency($jobData->minSalary) }} - <span class="icon-line-awesome-inr"></span>{{ indianCurrency($jobData->maxSalary) }}</li>
                    <?php
                     $locations = '';
                       $city='';
                      if(!empty($jobData->joblocations)){
                        foreach ($jobData->joblocations as $key => $value) {
                         // $locations .= $value->location->location.',';
                          $locations .= @$value->location->state.',';
                          $city.= @$value->city->location.',';
                        }
                      }
                      $locations = rtrim($locations,',');
                      $city = rtrim($city,',');
                    ?>
                <li><i class="icon-material-outline-location-on"></i> {{$locations}},{{$city}} </li>
              
              </ul>
            </div>
            <div>
              <?php if(empty(session('admin_session_data')) && $jobData->deletedFlag == 0 ){ ?>
              <a href="{{ROOT_URL}}/employer/job/postjob/{{$jobData->jobId}}" class="save-btn">Edit</a>
              <button class="button utf-ripple-effect-dark apply-now-button popup-with-zoom-anim" href="#small-dialog">Archive</button>
              <?php } ?>
            </div>
          </div>
          <div class="job-apply-card-footer">
            <label>Posted: <span>{{ time_elapsed_string(strtotime($jobData->createdOn)) }}</span></label>
            <label>Openings: <span>{{$jobData->jobVacancy}}</span></label>
            <label>Job Applicants: <span>{{$candidateapplied}}</span></label>
            <!-- <a href="javascript:;" class="send-me">Send Me Jobs Like This</a> -->
          </div>
        </div>
        <div class="job-description">
          <div class="utf-single-page-section-aera mb-0">
            <h3 class="margin-top-40"><i class="icon-material-outline-description"></i> Jobs Description </h3>
            <?php echo htmlspecialchars_decode($jobData->jobDescription) ?>
            <h3 class="margin-top-40"><i class="icon-feather-settings"></i> Role & Responsibilities </h3>
            <?php echo htmlspecialchars_decode($jobData->jobRoleResponsibilities); ?>
            <h3 class="margin-top-40"><i class="icon-line-awesome-building"></i> Company Details </h3>
            <?php echo htmlspecialchars_decode($jobData->companyDetails); ?>
            <h3 class="margin-top-40"><i class="icon-feather-briefcase"></i> Education Qualification</h3>
            <ul class="utf-job-deatails-content-item">
            <?php 
               if( !empty( $jobData->jobqualification[0] )){
                 // echo "<pre>";print_r($jobData->jobqualification[0]->jobminEduQual->qualification);exit;
                  foreach ( $jobData->jobqualification as $key => $value ) {            
                    ?>
                      <li><i class="icon-feather-arrow-right"></i> {{ @$value->jobminEduQual->qualification }} </li>
                    <?php                   
                  }
                }
              ?>
            </ul>
            <h3 class="margin-top-40"><i class="icon-feather-star"></i> Key Skills</h3>
            <ul class="utf-job-deatails-content-item">
              <?php 
               if(!empty($jobData->jobskills)){
                  foreach ($jobData->jobskills as $key => $value) {
                    // echo "<pre>";print_r($value->skillname);exit;
                    ?>
                      <li><i class="icon-feather-arrow-right"></i> {{ @$value->skillname->skillName }} </li>
                    <?php
                  }
                }
              ?>
            </ul>
          </div>
        </div>
        <!-- <div class="utf-sidebar-widget-item margin-top-30">
          <h3>Tags</h3>
          <div class="task-tags">
            <a href="#"><span>Business</span></a>
            <a href="#"><span>Investment </span></a>
            <a href="#"><span>Audit</span></a>
            <a href="#"><span>Assurance</span></a>
            <a href="#"><span>Consulting </span></a>
            <a href="#"><span>Partnership</span></a>
            <a href="#"><span>Secutity</span></a>
            <a href="#"><span>Camera</span></a>
          </div>
        </div> -->
      </div>
      <div class="col-xl-4">
        <?php if(empty(session('admin_session_data'))){ ?>
        <div class="utf-sidebar-widget-item interest-job-list">
          <h3>Recently Posted Jobs</h3>
          <ul>
            <?php
              foreach ($recentJobs as $row){ 
               $locations = '';
                  $city='';
                if(!empty($row->joblocations)){
                  foreach ($row->joblocations as $key => $value) {
                    //$locations .= $value->location->location.',';
                      $locations .= @$value->location->state.',';
                     $city.= @$value->city->location.',';
                  }
                }
                $locations = rtrim($locations,',');   
                 $city = rtrim($city,',');                 
            ?>
            <li>
              <h4 class="utf-job-listing-title">{{$row->jobTitle}}</h4>
              <span class="company-name">{{@$row->employer->employerCompany}} </span>
              <span class="location"><i class="icon-material-outline-location-on"></i> {{$locations}},{{$city}}</span>
              
              <p class="text-right mb-0 shared-date">{{ time_elapsed_string(strtotime($row->createdOn)) }}</p>
              <a href="javascript:;" class="interest-list-link"></a>
            </li>
          <?php } ?>
          </ul>
          <div class="text-right">
            <a href="{{ROOT_URL}}/employer/job/managejob" class="interest-view-link">View all</a>
          </div>
        </div>
        <?php } ?>
        <div class="utf-sidebar-widget-item utf-detail-social-sharing margin-top-25">
            <h3>Share with friends</h3>
            <ul class="margin-top-15">
              <li><a href="#" title="Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
              <li><a href="#" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
              <li><a href="#" title="LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a>
              </li>
              <li><a href="#" title="Google Plus" data-tippy-placement="top"><i
                    class="icon-brand-google-plus-g"></i></a>
              </li>
              <li><a href="#" title="Whatsapp" data-tippy-placement="top"><i class="icon-brand-whatsapp"></i></a></li>
              <li><a href="#" title="Pinterest" data-tippy-placement="top"><i class="icon-brand-pinterest-p"></i></a>
              </li>
            </ul>

        </div>
      </div>
  </div>
</div>
</div>    

</div>

<!-- Apply for a job popup -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs"> 
  <form method="post" id="archive-job" enctype="multipart/form-data">
    {{csrf_field()}}
      <div class="utf-signin-form-part">
        <ul class="utf-popup-tabs-nav-item text-center">
          <li class="modal-title">Alert!</li>
        </ul>
        <div class="utf-popup-container-part-tabs"> 
          <div class="utf-popup-tab-content-item" id="tab"> 
            <h3 class="mb-5 text-center">This job will be archive! <br> Are you sure want to proceed?</h3> 
            <div class="d-flex justify-content-center align-items-center">
              <a href="javascript:void(0);"  class="btn btn-secondary full-width ripple-effect" onclick="archiveJob()">Ok, Archive</a>
              <a href="javascript:void(0);" class="btn btn-primary full-width ripple-effect ml-3" onclick="dismisArchivePopup()">Cancel </a>  
            </div>
          </div>
        </div>
      </div>
  </form>
</div>
<!-- Apply for a job popup / End --> 


@section('page-js')
<script
>
  $(document).ready(function(){
    //$('.popup-with-zoom-anim').magnificPopup().magnificPopup('open');
  });
  function dismisArchivePopup(){
    $('#small-dialog').magnificPopup('close'); 
  }
  function archiveJob(){
    $('#archive-job').submit(); 
  }
</script>
@endsection
@endsection

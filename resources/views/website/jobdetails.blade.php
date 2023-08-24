@extends('layouts.website')
@section('page-content')
@section('page-css')

@endsection

<!-- <div class="section pt-4 pt-md-5 "> -->
  <div class="container">
    <div class="inner-page-baner">
    <?php if(isset($banners) && $banners->isNotEmpty()){ ?>
      <img src="<?php if(!empty($banners[0]->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banners[0]->bannerImage; } else{ echo PUBLIC_PATH.'images/explore-jobs.png'; } ?>" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
          <strong>{{$banners[0]->bannerTitle}}</strong> - <br> {{$banners[0]->bannerText}}
      </div>
      <?php } else { ?>
      <img src="<?php echo PUBLIC_PATH; ?>images/explore-jobs.png" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
        <strong>Job Details</strong> - <br> Discover Inclusive Job Opportunities
      </div>
      <?php } ?>
    </div>
    <div class="row">
      <div class="col-xl-8 col-lg-7">
        <div class="job-apply-card">
          <h3 class="utf-job-listing-title ">{{$jobData->jobTitle}}</h3>
          <span>{{!empty($jobData->employer->employerCompany)?$jobData->employer->employerCompany:''}} </span>
          <div class="d-flex justify-content-between">
            <div class="utf-job-listing-footer align-self-end">
              <ul>
                <li><i class="icon-line-awesome-user"></i> {{$jobData->minExp}} years</li>
                <li><i class="icon-material-outline-account-balance-wallet"></i><span
                    class="icon-line-awesome-inr"></span>{{ indianCurrency($jobData->minSalary) }} - <span
                    class="icon-line-awesome-inr"></span>{{ indianCurrency($jobData->maxSalary) }}</li>
                <?php
                     $locations = '';
                     $city='';
                      if(!empty($jobData->joblocations)){
                        foreach ($jobData->joblocations as $key => $value) {
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
            <div class="d-flex align-items-center">
              <?php 
                if(!empty(SESSION('candidate_session_data.userId'))){ 
                if(empty($Bookmarked->bookmarkedId)){ ?>

              <button type="button" class="save-btn savejob">Save</button>
              <?php }else{?>

              <button type="button" class="save-btn">Saved</button>


              <?php } if(empty($appliedjob->appliedJobId)){ ?>

              <button type="button" class="save-btn applyjob ml-2">Apply</button>
              <?php  } else{ ?>
              <button type="button" class="save-btn ml-2">Applied</button>
              <?php  } }
                ?>

            </div>
          </div>
          <div class="job-apply-card-footer">
            <label>Posted: <span>{{ time_elapsed_string(strtotime($jobData->createdOn)) }}</span></label>
            <label>Openings: <span>{{$jobData->jobVacancy}}</span></label>
            <label>Job Applicants: <span>60</span></label>
            <!--   <a href="javascript:;" class="send-me">Send Me Jobs Like This</a> -->
          </div>
        </div>
        <div class="job-description">
          <div class="utf-single-page-section-aera">
            <h3 class="text-primary"><i class="icon-material-outline-description"></i> Jobs Description </h3>
            <?php echo htmlspecialchars_decode($jobData->jobDescription) ?>
            <h3 class="text-primary"><i class="icon-feather-settings"></i> Role & Responsibilities </h3>
            <?php echo htmlspecialchars_decode($jobData->jobRoleResponsibilities); ?>
            <h3 class="text-primary"><i class="icon-line-awesome-building"></i> Company Details </h3>
            <?php echo htmlspecialchars_decode($jobData->companyDetails); ?>
            <h3 class="text-primary"><i class="icon-feather-briefcase"></i> Education Qualification</h3>
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
                    ?>
              <li><i class="icon-feather-arrow-right"></i> {{ @$value->skillname->skillName }} </li>
              <?php
                  }
                }
              ?>
            </ul>
          </div>
        </div>

        <div class="utf-sidebar-widget-item utf-detail-social-sharing">
          <div class="recruiter">
            <div class="recruiter__img">

              <?php 
               $logodirpath  = STORAGE_PATH.'companylogo'.'/'.@$Employerprofile->companyLogo;
               $staticpath=PUBLIC_PATH.'images/no-logo-images.png';


              //echo (!empty($existingProfile))?$logodirpath.'/'.$existingProfile->companyLogo:PUBLIC_PATH.'images/no-logo-images.png';
               ?>
              <input type="hidden" id="encemployerid" value="<?php echo encrypt(@$Employerprofile->employerId) ?>">

              <img src="<?php echo !empty($Employerprofile->companyLogo)?$logodirpath:$staticpath ?>" alt="">
            </div>
            <div class="recruiter__details">
              <h4>
                <?php echo !empty($Employerprofile->employerName)?$Employerprofile->employerName:'' ?>
              </h4>
              <p>
                <?php echo !empty($Employerprofile->employerDesignation)?$Employerprofile->employerDesignation:'' ?> at
                <?php echo !empty($Employerprofile->employerCompany)?$Employerprofile->employerCompany:'' ?>
              </p>
              <span>Recruiter last active 00 days ago.</span>
            </div>
          </div>
          <div class="recruiter-action">
            <div class="recruiter__sendMsg">
              <?php 
                $senderId = 0;
                $type     = 0;
                if(!empty(SESSION('candidate_session_data.userId'))){
                  $type     = 1;
                  $senderId = SESSION('candidate_session_data.userId');
                }else if(!empty(SESSION('partner_session_data.userId'))){
                  $type     = 2;
                  $senderId = SESSION('partner_session_data.userId');
                }
                //$senderId = ?SESSION('candidate_session_data.userId'):
              ?>
              <a href="javascript:void(0)" onclick="sendmessage(<?php echo $senderId;?>,<?php echo $type;?>)">SEND
                Message</a>
              <span>Credits Required</span>
            </div>
          </div>
        </div>

        <div class="utf-sidebar-widget-item margin-top-30">
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
        </div>
      </div>
      <div class="col-xl-4 col-lg-5">
        <div class="utf-sidebar-widget-item interest-job-list">
          <h3>Jobs you might be interested in</h3>
          <ul>
            <?php
              foreach ($recentJobs as $row){ 
                 $locations = '';
                 $city='';
                if(!empty($row->joblocations)){
                  foreach ($row->joblocations as $key => $value) {
                     $locations .= @$value->location->state.', ';
                    $city.= @$value->city->location.', ';
                  }
                }
                $locations = rtrim($locations,', ');    
                 $city = rtrim($city,', ');                
            ?>

            <li>
           <h4 class="utf-job-listing-title">{{$row->jobTitle}}</h4>
              <span class="company-name">{{@$row->employer->employerCompany}}</span>
              <span class="location"><i class="icon-material-outline-location-on"></i> {{$locations}} , {{$city}}</span>
              <p class="text-right mb-0 shared-date">{{ time_elapsed_string(strtotime($row->createdOn)) }} </p>
              <a href="{{ROOT_URL.'/jobdetails/'.str_replace(' ','_',strtolower($row->jobTitle)).'_'.str_replace(' ','_',strtolower($row->employerCompany)).'/'.encrypt($row->jobId)}}" class="interest-list-link"></a>
            </li>
            <?php }?>
          </ul>
          <div class="text-right">
            <a href="<?php echo ROOT_URL; ?>/jobsearch" class="interest-view-link">View all</a>
          </div>
        </div>

        <div class="utf-sidebar-widget-item utf-detail-social-sharing margin-top-25">
          <h3>Share with friends</h3>
          <ul class="margin-top-15">
            <li><a href="#" title="Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
            <li><a href="#" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
            <li><a href="#" title="LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a>
            </li>
            <li><a href="#" title="Google Plus" data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a>
            </li>
            <li><a href="#" title="Whatsapp" data-tippy-placement="top"><i class="icon-brand-whatsapp"></i></a></li>
            <li><a href="#" title="Pinterest" data-tippy-placement="top"><i class="icon-brand-pinterest-p"></i></a>
            </li>
          </ul>

        </div>
      </div>
    </div>
  </div>
<!-- </div> -->
<input type="hidden" id="jobid" value="{{$jobData->jobId}}">
<input type="hidden" id="candidateid"
  value="<?php echo !empty(SESSION('candidate_session_data.userId'))? SESSION('candidate_session_data.userId'):0;?>">
<input type="hidden" id="jobtitle" value="{{$jobData->jobTitle}}">

@include('components.admin-alert-modal')
@section('page-js')
<script>
  $(document).ready(function () {
  });
  function sendmessage(senderId, type) {
    var encemployerid = $("#encemployerid").val();
    if (senderId == 0) {
      $('.cand').magnificPopup().magnificPopup('open');
    } else {
      if (type == 1) {
        window.location = SITE_URL + "/candidate/message/index/" + encemployerid;
      } else if (type == 2) {
        window.location = SITE_URL + "/ngo/messages/index/" + encemployerid;
      }
    }

  }

  $('.applyjob').on("click", function (e) {
    $('#confirmAlertModal').modal('show');
  });
  $('#btnConfirmModalOK').on('click', function () {
    var jobid = $("#jobid").val();
    var candidateid = $("#candidateid").val();
    $('#confirmAlertModal').modal('hide');
    var jobtitle = $("#jobtitle").val();
    jobtitle = '<br>' + jobtitle + '</br>'
    if (candidateid > 0) {

      $.ajax({
        type: 'POST',
        url: SITE_URL + "/website/ajax/applyjob",
        data: { jobid: jobid, candidateid: candidateid },
        dataType: "json",
        async: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
          $('#confirmAlertModal').modal('hide');
          if (res.status == 200) {
            viewAlert(res.msg + ' ' + jobtitle);
          }
          location.reload();
        }
      });
    }
  });

  $('.savejob').on("click", function (e) {
    var jobid = $("#jobid").val();
    favourite(jobid, 1);

  });


  function favourite(jobid, liked) {
    $.ajax({
      type: 'POST',
      url: SITE_URL + "/website/ajax/addFavourite",
      data: { jobid: jobid, liked: liked },
      dataType: "json",
      async: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (res) {
        if (res.status == 200) {
          viewAlert(res.msg);
        }
        location.reload();
      }
    });

  }
</script>
@endsection
<!--  <div id="small-dialog-1" class="zoom-anim-dialog mfp-hide dialog-with-tabs"> 
  
      <div class="utf-signin-form-part">
        <ul class="utf-popup-tabs-nav-item text-center">
          <li class="modal-title active">Apply Job</li>
        </ul>
        <div class="utf-popup-tab-content-item"> 
          <div class="utf-welcome-text-item mb-0">
            <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid ex, impedit necessitatibus. Placeat libero quae minima distinctio provident accusantium dignissimos, maiores!</p>
            <button class="btn btn-primary utf-button-sliding-icon ripple-effect">Edit Profile</button>
            <button class="btn btn-secondary utf-button-sliding-icon ripple-effect ml-2">Apply Now</button>
          </div>
        </div>

        <div class="noti-success">
          <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
          </svg>
          <p class="noti-msg">Lorem ipsum dolor sit amet consectetur adipisicing, elit. Iste, fugiat. Lorem ipsum dolor sit, amet.</p>
        </div>        

      </div>
  </div> -->


@endsection
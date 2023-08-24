@extends('layouts.candidatelayout')
@section('page-content')
<!-- Dashboard Container -->
<!-- <div class="utf-dashboard-container-aera">  -->
<!-- Dashboard Content -->
<?php //echo 111; exit;?>
<div class="utf-dashboard-content-container-aera" data-simplebar>
  <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
    <div class="row">
      <div class="col-xl-12">
        <h3>Dashboard</h3>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}/candidate/dashboard">Home</a></li>
            <li>Dashboard</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  @include('components.admin-msg-tap')
  <div class="utf-dashboard-content-inner-aera">
    <div class="row"> <!--
      <div class="col-xl-4 col-md-12 col-sm-12">
        <div class="dashboard-box">
          <div class="headline">
            <h3>Profile View - Widget</h3>
          </div>
          <div class="content">
            <div class="profile-view">
              
            </div>
          </div>
        </div>
      </div> -->
      <div class="col-xl-6 col-md-12 col-sm-12">
        <div class="dashboard-box dashboard-box--msg">
          <div class="headline">
            <h3>Message</h3>
          </div>
          <div class="content">
            <?php if(count($getMessageThread) > 0){ ?>
            <ul class="utf-dashboard-box-list">
              <?php
              $employerlogodirpath   = STORAGE_PATH.'companylogo';
              $partnerlogodirpath    = STORAGE_PATH.'partnerlogo';
              foreach ($getMessageThread as $ks => $vs) {
              //echo $vs->respOne.'==='.session('candidate_session_data.userId');exit;
              $leng          = count($vs->msgconv);
              $lastMsg     = ($vs->msgconv[$leng-1]->msgText)?$vs->msgconv[$leng-1]->msgText:'Attachment';
              $lastTime    = $vs->msgconv[$leng-1]->createdOn;
              if($vs->respOne != session('candidate_session_data.userId')){
              if($vs->sender->tinUserType == 2){
              $receiverId    = ($vs->sender->employer->employerId)?$vs->sender->employer->employerId:0;
              $name          = (@$vs->sender->employer->employerCompany)?@$vs->sender->employer->employerCompany:'';
              $img           = (@$vs->sender->employer->companyLogo)?@$vs->sender->employer->companyLogo:'';
              if(Storage::disk('local')->exists('/uploads/companylogo/' . $img) && $img != ''){
              $logofullpath= $employerlogodirpath.'/'.$img;
              }else{
              $logofullpath= PUBLIC_PATH.'images/user-avatar-placeholder.png';
              }
              }else if($vs->sender->tinUserType == 4){
              $receiverId    = ($vs->sender->partner->partnerId)?$vs->sender->partner->partnerId:0;
              $name          = ($vs->sender->partner->partnerName)?$vs->sender->partner->partnerName:'';
              $img           = (@$vs->sender->partner->companyLogo)?@$vs->sender->partner->companyLogo:'';
              if(Storage::disk('local')->exists('/uploads/partnerlogo/' . $img) && $img != ''){
              $logofullpath= $partnerlogodirpath.'/'.$img;
              }else{
              $logofullpath= PUBLIC_PATH.'images/user-avatar-placeholder.png';
              }
              }
              }else{
              if($vs->receiver->tinUserType == 2){
              $receiverId    = ($vs->receiver->employer->employerId)?$vs->receiver->employer->employerId:0;
              $name          = (@$vs->receiver->employer->employerCompany)?@$vs->receiver->employer->employerCompany:'';
              $img           = (@$vs->receiver->employer->companyLogo)?@$vs->receiver->employer->companyLogo:'';
              if(Storage::disk('local')->exists('/uploads/companylogo/' . $img) && $img != ''){
              $logofullpath= $employerlogodirpath.'/'.$img;
              }else{
              $logofullpath= PUBLIC_PATH.'images/user-avatar-placeholder.png';
              }
              }else if($vs->receiver->tinUserType == 4){
              $receiverId    = ($vs->receiver->partner->partnerId)?$vs->receiver->partner->partnerId:0;
              $name          = ($vs->receiver->partner->partnerName)?$vs->receiver->partner->partnerName:'';
              $img           = (@$vs->receiver->partner->companyLogo)?@$vs->receiver->partner->companyLogo:'';
              if(Storage::disk('local')->exists('/uploads/partnerlogo/' . $img) && $img != ''){
              $logofullpath= $partnerlogodirpath.'/'.$img;
              }else{
              $logofullpath= PUBLIC_PATH.'images/user-avatar-placeholder.png';
              }
              }
              }
              ?>
              <li>
                <div class="utf-job-listing">
                  <div class="utf-job-listing-details">
                    <a href="#" class="utf-job-listing-company-logo"> <img src="<?php echo $logofullpath; ?>" alt=""> </a>
                    <div class="utf-job-listing-description">
                      <div class="d-flex justify-content-between">
                        <h4 class="utf-job-listing-title">{{$name}} <!-- <small class="badge badge-primary rounded-circle px-2">4</small> --> </h4>
                      </div>
                      <span class="message-short-content"><a href="{{ROOT_URL.'/candidate/message/index/'.encrypt($receiverId)}}">{{@$lastMsg}}</a></span>
                      <div class="utf-job-listing-footer">
                        <ul>
                          <li>
                            <i class="icon-material-outline-access-time"></i> {{ time_elapsed_string(strtotime($vs->createdOn)) }}
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <?php } ?>
            </ul>
            <?php }else{ ?>
            <div class="col-xl-12 d-flex justify-content-center align-items-center">
              <div class="p-3">No Messages Available</div>
            </div>
            <?php } ?>
          </div>
          <div class="py-4 text-center">
            <?php if(count($getMessageThread) > 0){ ?>
            <a href="{{ROOT_URL}}/candidate/message" class="btn btn-secondary mb-2">View All Messages</a>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-md-12 col-sm-12 margin-bottom-30">
        <div class="dashboard-box h-100">
          <div class="headline">
            <h3>Profile Completion</h3>
          </div>
          <div class="content">
            <div class="profile-completion">
              <!-- <img src="<?php echo PUBLIC_PATH; ?>images/job-category-01.jpg" alt="">
              <h4>Samir Mohapatra</h4> -->
              <span class="profile-completion-percentage">{{$profile_completion}}%</span>
              <span>Profile Completion</span>

              <?php $profile='Complete your profile';
              if(!empty($profile_completion) && $profile_completion==100) {
                $profile='View Profile';
              }
                ?>
              <a href="{{ROOT_URL}}/candidate/profile" class="btn btn-secondary"><?php echo $profile; ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6">
        <div class="dashboard-box margin-top-0">
          <div class="headline">
            <h3>Applications</h3>
          </div>
          <div class="content">
            <?php if(count($arrAllRecords) > 0){ ?>
            <ul class="utf-dashboard-box-list">
              <?php
              foreach ($arrAllRecords as $row){
              $locations = '';
              $city='';
              if(!empty($row->jobdetail->joblocations)){
              foreach ($row->jobdetail->joblocations as $key => $value) {
                // echo'<pre>';print_r($row);exit;
              $locations .= @$value->location->state.',';
              $city.= @$value->city->location.',';
              }
              }
              $locations = rtrim($locations,',');
                $city = rtrim($city,',');
                                              //echo "<pre>";print_r($row->jobdetail->employer->employerCompany);exit; 
                ?>
                                                <li> 
                                                      <div class="utf-job-listing"> 
                                                            <div class="utf-job-listing-details"> 
                      <a href="#" class="utf-job-listing-company-logo"> <img src="<?php echo STORAGE_PATH; ?>/companylogo/<?php echo @$row->jobdetail->employer->companyLogo; ?>" alt=""> </a>
                                                                  <div class="utf-job-listing-description">
                                                                        <div class="d-flex justify-content-between">
                                                                              <h3 class="utf-job-listing-title">{{@$row->jobdetail->employer->employerCompany}}</h3>
                                                                              <a href="{{ROOT_URL.'/jobdetails/'.str_replace(' ','_',strtolower(@$row->jobdetail->jobTitle)).'_'.str_replace(' ','_',strtolower(@$row->jobdetail->employer->employerCompany)).'/'.encrypt($row->jobId)}}">
                                                                                    <div class="dropdown-container">
                                                                                          <span class="dropdown-handle icon-material-outline-visibility"></span>
                              <!-- <ul class="dropdown-box">
                                                                                                <li><span class="icon-material-outline-visibility"></span> Edit</li>
                                                                                                <li><span class="icon-material-outline-visibility"></span> View</li>
                                                                                                <li><span class="icon-material-outline-visibility"></span> Withdraw</li>                    
                                                                                                <li><span class="icon-material-outline-visibility"></span> Message Notification</li>
                              </ul> -->
                                                                                    </div>
                                                                              </a>
                                                                        </div>
                                                                        <div class="utf-job-listing-footer">
                                                                              <ul>
                                                                                    <li><i class="icon-feather-briefcase"></i> {{@$row->jobdetail->jobTitle}}</li>              
                                                                                    <li><i class="icon-material-outline-location-on"></i> {{$locations}},{{$city}} </li>
                            <li> <?php if($row->status == 0){ ?>
                                                                                                Applied
                              <?php }else if($row->status == 1){ ?>
                                                                                                Shortlisted
                              <?php }else if($row->status == 2){ ?>
                                                                                                On Hold
                              <?php }else if($row->status == 3){ ?>
                                                                                                Selected
                              <?php }else if($row->status == 4){ ?>
                                                                                                Rejected
                              <?php } ?>
                                                                                    </li>
                                                                                    <li><i class="icon-material-outline-access-time"></i> {{ time_elapsed_string(strtotime($row->createdOn)) }}</li>
                                                                              </ul>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                </li>
                <?php } ?>
                                          </ul>   
              <?php }else{  ?>
                                            <div class="col-xl-12 d-flex justify-content-center align-items-center">
                                                  <div class="p-3">No job applied yet</div>
                                            </div>
              <?php } ?>
                                    </div>
                              </div>
          <!-- Pagination -->
          <?php if (count($arrAllRecords) > 0) { ?>
                                <input name="hdn_IsViewAll" id="hdn_IsViewAll" type="hidden">
          <?php
                                    if(count($arrAllRecords) > 0) {
                                      paginataion($arrAllRecords,$startrec); 
                                    }
                                  }
          ?>
          <!-- <div class="utf-pagination-container-aera my-4">
                                    <nav class="pagination d-flex justify-content-end">
                                          <ul>
                                                <li class="utf-pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li> 
                                                <li><a href="#" class="ripple-effect current-page">1</a></li>
                                                <li><a href="#" class="ripple-effect">2</a></li>
                                                <li><a href="#" class="ripple-effect">3</a></li>
                                                <li class="utf-pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                                          </ul>
                                    </nav>
          </div> -->
                              <div class="clearfix"></div>
                        </div>     
                        <div class="col-xl-6">
                               <div class="dashboard-box margin-top-0"> 
                                    <div class="headline d-flex justify-content-between align-items-center">
                                          <h3>Relevant Jobs</h3>
                                         <a class="btn btn-secondary py-0 px-3"  href="<?php echo ROOT_URL; ?>/jobsearch">View All</a> 

                                    </div>
                                    <div class="content">
                                        <ul class="utf-dashboard-box-list">
                                            <?php
                                        // echo '<pre>';print_r($variable);exit;
                                             if(!empty($variableRelevent) && count($variableRelevent) > 0){ 
     
                                              foreach ($variableRelevent as $row){
                                                // echo'<pre>';print_R($row);exit;
                                                ?>
                                          <li>
                                             <a href="{{ROOT_URL.'/jobdetails/'.str_replace(' ','_',strtolower(@$row->jobTitle)).'_'.str_replace(' ','_',strtolower($row->employerCompany)).'/'.encrypt($row->jobId)}}" class="utf-job-listing"> 
                                                <div class="utf-job-listing-details"> 
                                                  <div class="utf-job-listing-company-logo"> <img src="<?php echo STORAGE_PATH; ?>companylogo/{{ @$row->companyLogo }}" alt=""> </div>
                                                  <div class="utf-job-listing-description">
                                                      <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i>{{ $row->jobtypeName }}</span>

                                                                  <?php if(!empty($row->appliedJobId) && !empty(SESSION('candidate_session_data.userId'))){?>
              <span class="dashboard-status-button utf-job-status-item ml-1 blue">Applied</span>
           <?php  } ?>
                                                                 <h3 class="utf-job-listing-title">{{@$row->jobTitle}} <span class="utf-verified-badge" data-tippy-placement="top" data-tippy="" data-original-title="Verified Employer"></span></h3>
                                                      <div class="utf-job-listing-footer">
                                                        <ul>
                                                            <li><i class="icon-line-awesome-building"></i></li>
                                                            <li><i class="icon-material-outline-account-balance-wallet"></i><span class="icon-line-awesome-inr"></span>{{ indianCurrency($row->minSalary) }} -<span class="icon-line-awesome-inr"></span>{{ indianCurrency($row->maxSalary) }}</li>
                                                            <li><i class="icon-material-outline-location-on"></i> {{$row->location}},{{$row->city}}</li>
                                                            <li><i class="icon-material-outline-access-time"></i>{{ time_elapsed_string(strtotime($row->createdOn)) }} ago</li>
                                                            <li><i class="icon-feather-star"></i> Skills:  {{ $row->skillName }}</li>
                                                            <li><i class="icon-line-awesome-user"></i> Experience: {{ $row->minExp }} years</li>
                                                        </ul>
                                                      </div>
                                                  </div>
                                                  <span class="bookmark-icon <?php  if(!empty($row->liked) && $row->liked==1){ echo "bookmarked";} ?>"  id="bookmarked<?php echo !empty($row->jobId)? $row->jobId:0;?>" onclick="addfavourite(<?php echo !empty($row->jobId)? $row->jobId:0;?>,<?php echo !empty(SESSION('candidate_session_data.userId'))? SESSION('candidate_session_data.userId'):0;?>)"></span> 
                                                 </div>
                                            </a>
                                          </li>
                                        <?php }
                                         } else{ ?>
                                                <div class="col-xl-12 d-flex justify-content-center align-items-center">
                                                  <div class="p-3">No job Available</div>
                                            </div>

                                        <?php  }
                                         if (count($variableRelevent) > 0) { ?>
                                <input name="hdn_IsViewAll" id="hdn_IsViewAll" type="hidden">
          <?php
                                    if(count($variableRelevent) > 0) {
                                      paginataion($variableRelevent,$startrec); 
                                    }
                                  } ?>
                                       
                                          
                                        </ul>
                                    </div>     
                                </div>
                        </div>     
                  </div>
          </div>
    </div>    
  <!-- Dashboard Content End -->
</div>
@section('page-js')
<script
>
   $(document ).ready(function() {
var userid='<?php echo SESSION('candidate_session_data.userId');?>';
    loadnotifiation(userid,2);

    });

    function addfavourite(jobid,sessionid){
      //alert(11);
    if(jobid>0 && sessionid>0 ){
      if($("#bookmarked"+jobid).hasClass("bookmarked")==false){
      //  alert(12);

        var jobid=jobid;
        var liked=1;

        favourite(jobid,liked)

      }else{
        // alert(13);

        var jobid=jobid;
        var unliked=2;
        favourite(jobid,unliked)

      }
    }
  }
  function favourite(jobid,liked){
    $.ajax({
      type: 'POST',
      url: SITE_URL + "/website/ajax/addFavourite",
      data: {jobid:jobid,liked:liked},
      dataType: "json",
      async: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (res) {
       console.log(res);
     }
   });

  }
</script>
@endsection
@endsection
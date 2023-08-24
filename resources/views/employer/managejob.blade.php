  @extends('layouts.employerlayout')
  @section('page-content')
  <div class="utf-dashboard-content-container-aera" data-simplebar>
      <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
        <div class="row">
          <div class="col-xl-12"> 
            <h3>Manage Jobs</h3>
            <nav id="breadcrumbs">
              <ul>
                <li><a href="{{ROOT_URL}}/employer/dashboard">Home</a></li>
                <li>Manage Jobs</li>
              </ul>
            </nav>
          </div>
        </div>    
      </div>
    <div class="utf-dashboard-content-inner-aera"> 
      @include('components.admin-msg-tap')  
      <form id="listForm" method="post" enctype="multipart/form-data" novalidate>
      {{csrf_field()}}
        <div class="row"> 
          <div class="col-xl-12 d-md-flex justify-content-md-between align-items-md-center mb-3">
            <div class="postjob-filter">
              <a href="{{ROOT_URL}}/employer/job/managejob/all" class="btn <?php echo ($status == 'all')?'btn-primary':' btn-primary line-btn'; ?>">All</a>     
              <a href="{{ROOT_URL}}/employer/job/managejob/active" class="btn <?php echo ($status == 'active')?'btn-primary':' btn-primary line-btn'; ?> ml-2">Active ({{$activeJobCount}})</a>     
              <a href="{{ROOT_URL}}/employer/job/managejob/expired" class="btn <?php echo ($status == 'expired')?'btn-primary':' btn-primary line-btn'; ?> ml-2">Expired ({{$expiredJobCount}})</a>    
              <a href="{{ROOT_URL}}/employer/job/archivejob" class="btn btn-primary line-btn ml-2">Archived ({{$archivedJobCount}})</a>   
            </div>
            <a href="{{ROOT_URL}}/employer/job/postjob" class="btn btn-primary"><span class="icon-feather-plus"></span> Post a New Job</a>
          </div>

          

          <div class="col-xl-12">
            <div class="dashboard-box margin-top-0"> 
              <div class="content">
                  <?php if(count($arrAllRecords)>0){ ?>
                    <ul class="utf-dashboard-box-list">
                      <?php
                        foreach ($arrAllRecords as $row){ 
                          $skills = '';
                          if(!empty($row->jobskills)){
                            foreach ($row->jobskills as $key => $value) {
                              $skills .= !empty(@$value->skillname->skillName)?@$value->skillname->skillName.', ':'';
                            }
                          }
                          $skills = rtrim($skills,',');

                          $locations = '';
                          $city='';
                          if(!empty($row->joblocations)){
                        
                            foreach ($row->joblocations as $key => $value) {
                              //echo "<pre>"; print_R($value);exit;
                              $locations .= @$value->location->state.', ';
                               $city.= @$value->city->location.', ';
                            }
                          }
                          $locations = rtrim($locations,',');
                           $city = rtrim($city,',');

                           $disabilities = '';
                           if(!empty($row->jobdisabilities)){
                             foreach ($row->jobdisabilities as $key => $value) {
                               $disabilities .= !empty(@$value->jobdisable->disabilityName)?@$value->jobdisable->disabilityName.', ':'';
                             }
                           }
                           $disabilities = rtrim($disabilities,', ');
                       ?>
                      <li> 
                        <div class="utf-job-listing row"> 
                          <!-- <div class=""> -->
                            <div class="col-xl-8">
                              <div class="utf-job-listing-details"> 
                                <a href="#" class="utf-job-listing-company-logo"> <img src="<?php echo (!empty($row->employer->companyLogo))?STORAGE_PATH.'/companylogo/'.$row->employer->companyLogo:PUBLIC_PATH.'images/no-logo-images.png'; ?>" alt=""> </a> 
                                <div class="utf-job-listing-description">
                                  <?php if($row->job_status == 2){ ?> 
                                    <span class="dashboard-status-button utf-status-item red">Rejected</span>
                                  <?php }else if($row->job_status == 0){ ?> 
                                    <span class="dashboard-status-button utf-status-item red">Under Review</span>
                                  <?php }else{ ?>
                                  <?php if(strtotime($row->jobStartDate)>strtotime(date("Y-m-d"))){ ?>
                                    <span class="dashboard-status-button utf-status-item red">In-active</span>
                                  <?php }else if(strtotime(date("Y-m-d") >= strtotime($row->jobStartDate)) && strtotime(date("Y-m-d")) <= strtotime(date("d M Y",strtotime("-5 day", strtotime($row->jobExpiryDate))))){ ?>
                                    <span class="dashboard-status-button utf-status-item yellow">Expiring Soon</span>
                                  <?php }else if(strtotime(date("Y-m-d")) >= strtotime($row->jobStartDate) && strtotime(date("Y-m-d")) <= strtotime($row->jobExpiryDate)){ ?>
                                    <span class="dashboard-status-button utf-status-item green">Active</span>
                                  <?php }else if(strtotime($row->jobExpiryDate) < strtotime(date("Y-m-d"))){ ?>
                                    <span class="dashboard-status-button utf-status-item red">Expired</span>
                                  <?php }/*else{ ?> 
                                    <span class="dashboard-status-button utf-status-item red">Expired</span>
                                  <?php }*/ ?>
                                  <?php } ?>
                                  <?php if(!empty($disabilities)){ ?>
                                  <span class="dashboard-status-button utf-status-item blue">{{ $disabilities }}</span>
                                  <?php } ?>
                                  <div class="d-flex justify-content-between">
                                    <h3 class="utf-job-listing-title">{{$row->jobTitle}}</h3>
                                  </div>
                                  <div class="utf-job-listing-footer">
                                   <ul>
                                      <li><i class="icon-material-outline-account-balance-wallet"></i><span class="icon-line-awesome-inr"></span>{{ indianCurrency($row->minSalary) }} -<span class="icon-line-awesome-inr"></span>{{ indianCurrency($row->maxSalary) }}</li>
                                      <li><i class="icon-material-outline-location-on"></i> {{$locations}},{{$city}}</li>
                                      
                                      <li><i class="icon-material-outline-access-time"></i> {{ date("d M Y",strtotime($row->jobStartDate)) }}</li>
                                      <li style="display: none;"><i class="icon-material-outline-access-time"></i> {{ date("d M Y",strtotime($row->jobExpiryDate)) }}</li>
                                      <li><i class="icon-feather-star"></i> Skills: {{ $skills }}</li>
                                      <li><i class="icon-line-awesome-user"></i>Min Experience: {{$row->minExp}} Year(s)</li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-center justify-content-end">
                              <a href="{{ROOT_URL}}/employer/job/jobpreview/{{$row->jobId}}" class="btn btn-secondary">Preview</a>
                              <?php 
                                if($row->candidateapplied > 0){
                                   $href = ROOT_URL.'/employer/job/candidateapplied/'.$row->jobId; 
                                 }else{ 
                                   $href ="javascript:void(0)";
                                 }
                              ?> 
                              <a href="{{$href}}" class="btn btn-secondary ml-2">Candidate Applied({{$row->candidateapplied}})</a>
                            </div>
                          <!-- </div> -->
                        </div>
                      </li>
                      <?php } ?>
                    </ul>       
                  <?php }else{ ?>
                    <div class="col-xl-12 d-flex justify-content-center align-items-center">
                      <div class="p-3">No job posted yet</div>
                    </div>
                  <?php } ?>
              </div>
            </div>  
            <?php if (count($arrAllRecords) > 0) { ?>
                <input name="hdn_IsViewAll" id="hdn_IsViewAll" type="hidden">
                <?php
                    if(count($arrAllRecords) > 0) {
                      paginataion($arrAllRecords,$startrec); 
                    }
                  }
              ?>   
          </div>          
        </div>
      </form>
    </div>
  </div>    
  </div>
   @section('page-js')
  <script
>
   $(document ).ready(function() {
    var userid='<?php echo SESSION('employer_session_data.userId');?>';
    loadnotifiation(userid,1); 
    });
   </script>
@endsection
  @endsection
 


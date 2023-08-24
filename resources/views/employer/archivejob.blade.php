@extends('layouts.employerlayout')
@section('page-content')
<div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Archived Jobs</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/employer/dashboard">Home</a></li>
              <li>Archived Jobs</li>
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
        <div class="col-xl-12">
          <div class="text-right align-self-end">
            <a href="#!" onclick="history.back();" class="back-btn"><i class="icon-line-awesome-long-arrow-left"></i> Back</a>
          </div>
          <div class="dashboard-box margin-top-0"> 
            <div class="content">
            <?php if(count($arrAllRecords) > 0){ ?>
              <ul class="utf-dashboard-box-list">
                <?php
                if($startrec==1){
                  $ctr = $arrAllRecords->firstItem();
                }elseif($startrec==2){
                  $ctr = 1;
                 }

                foreach ($arrAllRecords as $row){ 
                  $skills = '';
                  if(!empty($row->jobskills)){
                    foreach ($row->jobskills as $key => $value) {
                      $skills .= @$value->skillname->skillName.',';
                    }
                  }
                  $skills = rtrim($skills,',');

                  $locations = '';
                  $city='';
                  if(!empty($row->joblocations)){
                    foreach ($row->joblocations as $key => $value) {
                      $locations .= @$value->location->state.',';
                       $city.= @$value->city->location.',';
                    }
                  }
                  $locations = rtrim($locations,',');
                    $city = rtrim($city,',');
                 // echo "<pre>";print_r($row->employer->companyLogo);exit;
                ?>
                  <li> 
                    <div class="utf-job-listing row"> 
                      <!-- <div class=""> -->
                        <div class="col-xl-8">
                          <div class="utf-job-listing-details"> 
                            <a href="#" class="utf-job-listing-company-logo"> <img src="<?php echo (!empty($row->employer->companyLogo))?STORAGE_PATH.'/companylogo/'.$row->employer->companyLogo:PUBLIC_PATH.'images/no-logo-images.png'; ?>" alt=""> </a> 
                            <div class="utf-job-listing-description">
                              <?php if(strtotime($row->jobStartDate)>strtotime(date("Y-m-d"))){ ?>
                                <span class="dashboard-status-button utf-status-item red">In-active</span>
                              <?php }else if(strtotime($row->jobStartDate) >= strtotime(date("Y-m-d")) && strtotime(date("Y-m-d")) <= strtotime(date("d M Y",strtotime("-5 day", strtotime($row->jobExpiryDate))))){ ?>
                                <span class="dashboard-status-button utf-status-item yellow">Expiring Soon</span>
                              <?php }else if(strtotime(date("Y-m-d")) >= strtotime($row->jobStartDate) && strtotime(date("Y-m-d")) <= strtotime($row->jobExpiryDate)){ ?>
                                <span class="dashboard-status-button utf-status-item green">Active</span>
                              <?php }else if(strtotime($row->jobExpiryDate) < strtotime(date("Y-m-d"))){ ?>
                                <span class="dashboard-status-button utf-status-item red">Expired</span>
                              <?php }/*else{ ?> 
                                <span class="dashboard-status-button utf-status-item red">Expired</span>
                              <?php }*/ ?>
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
                                  <li><i class="icon-line-awesome-user"></i>Min Experience: {{$row->minExp}} Years</li>
                                </ul>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="col-xl-4 d-flex align-items-center justify-content-end">
                          <a href="{{ROOT_URL}}/employer/job/jobpreview/{{$row->jobId}}" class="btn btn-secondary">Preview</a>
                          <a href="{{ROOT_URL}}/employer/dashboard/candidateapplied" class="btn btn-secondary ml-2">Candidate Applied(10)</a>
                        </div>
                      <!-- </div> -->
                    </div>
                  </li>
                <?php } ?>
              </ul>  
              <?php }else{  ?>
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
@endsection

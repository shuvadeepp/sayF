@extends('layouts.adminlayout')
@section('page-content')
@section('page-css')
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/jquery-ui.css">
@endsection
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Manage Job</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="javascript:void(0);">Home</a></li>
              <li>Manage Job</li>
              <li>Posted Job</li>
            </ul>
          </nav>
        </div>
      </div>    
    </div>
    @include('components.admin-msg-tap')
    <!-- Page Content -->
    <div class="utf-dashboard-content-inner-aera"> 
      <form id="frmTCP" method="post" enctype="multipart/form-data" novalidate>
      {{csrf_field()}}
      <div class="row">
        <div class="col-xl-12">
          <div class="utf-intro-banner-search-form-block mb-4"> 
            <div class="utf-intro-search-field-item">
              <input id="intro-keywords" name="srch_company_name" class="srch_company_name" type="text" placeholder="Company name" value="{{@$srch_job_status}}">
            </div>
           <div class="utf-input-with-icon">
              <input id="srch_post_date" name="srch_post_date" class="srch_post_date" type="text" placeholder="Post Date" value="{{@(strtotime($srch_post_date)>0)?date('d M Y',strtotime($srch_post_date)):''}}">
              <label for="srch_post_date" class="label-post-date"><i class="icon-feather-calendar"></i> </label>
            </div>
            <div class="utf-intro-search-field-item">
             <!--  <input id="intro-keywords" name="srch_post_date" class="srch_post_date" type="text" placeholder="Location"> -->
              <select class="selectpicker default srch_job_location" data-live-search="true"  data-size="7" name="srch_job_location" id="srch_job_location" title="Select Location">
                @if($location->isNotEmpty())
                @foreach($location as $lval)
                <option <?php echo ($lval->stateId == @$srch_job_location)?'selected':''; ?> value="{{$lval->stateId}}">{{$lval->state}}</option>
                @endforeach
                @endif
              </select>  
            </div>
            <div class="utf-intro-search-field-item">
              <select name="srch_job_status" class="selectpicker default srch_job_status">
                <option value="">Select Status</option>
                <option <?php echo (@$srch_job_status =='Active')?'selected':''; ?> value="Active">Active</option>
                <option <?php echo (@$srch_job_status =='Archived')?'selected':''; ?> value="Archived">Archived</option>
                <option <?php echo (@$srch_job_status =='Expired')?'selected':''; ?> value="Expired">Expired</option>
                <option <?php echo (@$srch_job_status =='Under Review')?'selected':''; ?> value="Under Review">Under Review</option>
              </select>
            </div>
            <div class="utf-intro-search-button">
              <button name="search_job" class="button ripple-effect"><i class="icon-feather-filter"></i> Filter</button>
            </div>
          </div>
        </div>

        <div class="col-xl-12">
            <div class="dashboard-box margin-top-0"> 
              <div class="content">
                <?php if(count($arrAllRecords) > 0){ ?>
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
                          <div class="col-9">
                            <div class="utf-job-listing-details"> 
                              <a href="#" class="utf-job-listing-company-logo"> <img src="<?php echo (!empty($row->employer->companyLogo))?STORAGE_PATH.'/companylogo/'.$row->employer->companyLogo:PUBLIC_PATH.'images/no-logo-images.png'; ?>" alt=""> </a> 
                              <div class="utf-job-listing-description">
                                <?php if($row->job_status == 2){ ?> 
                                  <span class="dashboard-status-button utf-status-item red">Rejected</span>
                                <?php }else if($row->job_status == 0){ ?> 
                                  <span class="dashboard-status-button utf-status-item red">Under Review</span>
                                <?php }else{ ?>
                                <?php if($row->deletedFlag == 1){?>
                                  <span class="dashboard-status-button utf-status-item red">Archived</span>
                                <?php }else if(strtotime($row->jobStartDate)>strtotime(date("Y-m-d"))){ ?>
                                  <span class="dashboard-status-button utf-status-item red">In-active</span>
                                <?php }else if(strtotime(date("Y-m-d") >= strtotime($row->jobStartDate)) && strtotime(date("Y-m-d")) <= strtotime(date("d M Y",strtotime("-5 day", strtotime($row->jobExpiryDate))))){ ?>
                                  <span class="dashboard-status-button utf-status-item yellow">Expiring Soon</span>
                                <?php }else if(strtotime(date("Y-m-d")) >= strtotime($row->jobStartDate) && strtotime(date("Y-m-d")) <= strtotime($row->jobExpiryDate)){ ?>
                                  <span class="dashboard-status-button utf-status-item green">Active</span>
                                <?php }else if(strtotime($row->jobExpiryDate) < strtotime(date("Y-m-d"))){ ?>
                                  <span class="dashboard-status-button utf-status-item red">Expired</span>
                                <?php } /*else{ ?> 
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
                                    <li><i class="icon-line-awesome-briefcase"></i>{{ @$row->employer->employerCompany}}</li>
                                    <li><i class="icon-material-outline-account-balance-wallet"></i><span class="icon-line-awesome-inr"></span>{{ indianCurrency($row->minSalary) }} -<span class="icon-line-awesome-inr"></span>{{ indianCurrency($row->maxSalary) }}</li>
                                    <li><i class="icon-material-outline-location-on"></i> {{$locations}},{{$city}}</li>
                                    <li><i class="icon-material-outline-access-time"></i> {{ date("d M Y",strtotime($row->createdOn)) }}</li>
                                    <li style="display: none;"><i class="icon-material-outline-access-time"></i> {{ date("d M Y",strtotime($row->jobExpiryDate)) }}</li>
                                    <li><i class="icon-feather-star"></i> Skills: {{ $skills }}</li>
                                    <li><i class="icon-line-awesome-user"></i>Min Experience: {{$row->minExp}} Year(s)</li>
                                  </ul>
                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="col-3 d-flex align-items-center justify-content-end">
                            <a href="{{ROOT_URL}}/employer/job/jobpreview/{{$row->jobId}}" class="btn btn-primary mr-2">Preview</a>  
                            <!-- <?php // if($row->job_status == 0){ ?>
                            <a href="javascript:void(0)" onclick="job_approval(1,<?php //echo $row->jobId ?>)" class="btn btn-secondary mr-2">Approve</a>                         
                            <a href="javascript:void(0)" onclick="job_approval(2,<?php //echo $row->jobId ?>)" class="btn btn-danger">Reject</a> 
                            <?php //} ?>                           -->
                          </div>
                        <!-- </div> -->
                      </div>
                    </li>
                    <?php } ?>
                  </ul>
                <?php }else{  ?>
                  <div class="col-xl-12 d-flex justify-content-center align-items-center">
                    <span>No job posted yet</span>
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
        <input type="hidden" name="hdnAction" id="hdnAction" value="">
        <input type="hidden" name="hdnIDs" id="hdnIDs" value="">
      </form>
      <!-- Footer -->
      @include('includes.application.footer') 
      <!-- Page Content ends -->
    </div>    
</div>
@include('components.admin-alert-modal')
@section('page-js')
<script src="<?php echo PUBLIC_PATH; ?>js/jquery-ui.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/custom-datepicker.js"></script>
<script
>
   $( function() {
    $( ".srch_post_date" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "d M y",
    });
  });
 /* function job_approval(status,jobId){
    if(jobId>0 && status>0){
     $('#confirmAlertModal').modal('show');
      $('#btnConfirmModalOK').on('click',function(){
          $.ajax({
            type        : 'POST',
            url         :  SITE_URL + "/application/managejob/job_approval",
            data        : {jobId:jobId,status:status},
            dataType    : "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                 //$(".loading-gif").hide();
            },
            success: function (res) {
              viewAlert(res.msg);
              if(res.status==200){
                location.reload();
              }
            }
          });
      });
    } 
  }*/
</script>
@endsection
@endsection



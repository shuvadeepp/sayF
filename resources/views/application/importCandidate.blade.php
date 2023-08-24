@extends('layouts.adminlayout')
@section('page-content')
@section('page-css')
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/jquery-ui.css">
@endsection
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Import Candidate</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="javascript:void(0);"> Home </a></li>
              <li> Manage Job </li>
              <li> Import Candidate </li>
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
          
           <div class="utf-input-with-icon">
              <input id="import_candidate" name="import_candidate" class="import_candidate" type="file" style="height: 68px;
    line-height: 38px;">
              <!-- <label for="import_job" class="label-post-date">Import File</label> -->
              <a href="<?php echo ROOT_URL.'/public/pdf/say-foundation-deck.pdf'; ?>" style="padding:0 0 0 42px;" target="_blank"> Download and check accepted format </a>
            </div>           
            
            <div class="utf-intro-search-button">
              <button name="importjobCandidate" class="button ripple-effect"> Import </button>
            </div>
            
          </div>          
        </div>
        </div>  
        <!-- <div class="col-xl-12">
            <div class="dashboard-box margin-top-0"> 
              <div class="content">
                <?php //if(count($arrAllRecords) > 0){ ?>
                  <ul class="utf-dashboard-box-list">
                   
                   
                    
                  </ul>
                <?php //}else{  ?>
                  <div class="col-xl-12 d-flex justify-content-center align-items-center">
                    <span>No job posted yet</span>
                  </div>
                <?php //} ?>
              </div>
            </div>  
             
        </div>        
      </div> -->
       
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



@extends('layouts.adminlayout')
@section('page-content')
  
  <!-- Add Service -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Add Service</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
              <li>Manage Master</li>
              <li>Add Service</li>
            </ul>
          </nav>
        </div>
      </div>    
    </div>
    @include('components.admin-msg-tap')
    <!-- Page Content -->
    <div class="utf-dashboard-content-inner-aera"> 
        <div class="row"> 
      <div class="col-xl-12">
        <div class="mb-2">
          <a href="<?php echo ROOT_URL.'/application/master/service'?>" class="button utf-ripple-effect-dark">View Service</a>      
        </div>
      </div>
      
      <div class="col-xl-12">
        <form method="post" id="listform" enctype="multipart/form-data">
          {{csrf_field()}}
            <div class="dashboard-box"> 
              <div class="content with-padding padding-bottom-10">
                  <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6">
                      <div class="utf-submit-field">
                        <h5>Service Name *</h5>
                        <input type="text" class="utf-with-border" placeholder="Service Name" name="serviceName" id="serviceName" value="{{!empty($editDetails['serviceName'])?(!empty(old('serviceName')))?old('serviceName'):$editDetails['serviceName']:old('serviceName')}}">
                        <span class="errMsg_serviceName errDiv"></span>
                      </div>
                    </div>
                    
                  </div>
                  <div class="utf-centered-button">
                    <a href="javascript:void(0);" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0" type="submit" onclick="return validator();">{{$buttonVal}}<i class="icon-feather-plus"></i></a> 
                  </div>
              </div>        
            </div>
            </form>
          </div>  
        </div>
        
        <!-- Footer -->
        @include('includes.application.footer') 
    <!-- Page Content ends -->
  </div>    
</div>
@include('components.admin-alert-modal')
@section('page-js')
<script
>
   function validator()
  {
      $('.errDiv').hide();
      if (!blankCheck('serviceName', 'Service name can not be left blank'))
          return false;

      $('#confirmAlertModal').modal('show');
          $('#btnConfirmModalOK').on('click',function(){
          $('#listform').submit(); 
         });
        
  }
</script>
@endsection
@endsection


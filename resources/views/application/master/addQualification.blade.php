@extends('layouts.adminlayout')
@section('page-content')
  
  <!-- Add Qualification -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>{{$tabTxt}} Job Qualification</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="javascript:void(0);">Home</a></li>
              <li>Manage Master</li>
              <li>{{$tabTxt}} Job Qualification</li>
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
          <a href="<?php echo ROOT_URL.'/application/master/qualification'?>" class="button utf-ripple-effect-dark">View Job Qualification</a>      
        </div>
      </div>
      
      <div class="col-xl-12">
        <form method="post" id="listform">
          {{csrf_field()}}
            <div class="dashboard-box"> 
              <div class="content with-padding padding-bottom-10">
                <div class="row">
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Qualification Name *</h5>
                      <input type="text" class="utf-with-border" placeholder="Qualification Name" name="txtQualification" id="txtQualification" maxlength="64" value="{{!empty($editQualification['qualification'])?(!empty(old('txtQualification')))?old('txtQualification'):$editQualification['qualification']:old('txtQualification')}}">
                      <span class="errMsg_txtQualification errDiv"></span>
                    </div>
                  </div>

        
                </div>
              <div class="utf-centered-button">
                <a href="javascript:void(0);" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0" type="submit" onclick="return validator();">{{$tabTxt}}<i class="icon-feather-plus"></i></a>  
              </div>
              </div>        
            </div>
            </form>
          </div>  
        </div>
        
        <!-- Footer -->
        @include('includes.application.footer')       
      </div>
    <!-- Page Content ends -->
  </div>    
</div>
@include('components.admin-alert-modal')
@section('page-js')
<script
>
  $(document).ready(function(){

  });
  function validator()
  {
      $('.errDiv').hide();
      $('.error-input').removeClass('error-input');
      if (!blankCheck('txtQualification', 'Qualification can not be left blank'))
          return false;

     $('#confirmAlertModal').modal('show');
      $('#btnConfirmModalOK').on('click',function(){
          $('#listform').submit(); 
      });
        
  }
</script>
@endsection
@endsection


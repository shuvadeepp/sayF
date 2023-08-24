@extends('layouts.adminlayout')
@section('page-content')
  
  <!-- Add Designation -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>{{$tabTxt}} Designation</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="javascript:void(0);">Home</a></li>
              <li>Manage Master</li>
              <li>{{$tabTxt}} Designation</li>
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
          <a href="<?php echo ROOT_URL.'/application/master/designation'?>" class="button utf-ripple-effect-dark">View Designation</a>      
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
                      <h5>Designation Name *</h5>
                      <input type="text" class="utf-with-border" placeholder="Designation Name" name="txtDesignation" id="txtDesignation" maxlength="64" value="{{!empty($editDesignation['designationName'])?(!empty(old('txtDesignation')))?old('txtDesignation'):$editDesignation['designationName']:old('txtDesignation')}}">
                      <span class="errMsg_txtDesignation errDiv"></span>
                    </div>
                  </div>

        
                </div>
              <div class="utf-centered-button">
                <a href="javascript:void(0);" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0" type="submit" onclick="return validator();">{{$tabTxt}} Designation<i class="icon-feather-plus"></i></a>  
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
      if (!blankCheck('txtDesignation', 'Designation can not be left blank'))
          return false;
           $('#confirmAlertModal').modal('show');
          $('#btnConfirmModalOK').on('click',function(){
              $('#listform').submit(); 
          });
          

      
        
  }
</script>
@endsection
@endsection


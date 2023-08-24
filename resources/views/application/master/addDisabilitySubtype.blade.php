@extends('layouts.adminlayout')
@section('page-content')
  
  <!-- Add Disability -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Add Disability Subtype</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
              <li>Manage Master</li>
              <li>Add Disability Subtype</li>
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
          <a href="<?php echo ROOT_URL.'/application/master/disabilitysubtype'?>" class="button utf-ripple-effect-dark">View Disability Subtype</a>      
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
                        <h5>Disability *</h5>
                        <select class="utf-with-border" name="disabilityId" id="disabilityId">
                          <option value="">--Select--</option>
                          <?php foreach($disability as $dval){
                            if(!empty($editDetails['disabilityId'])){
                              if(!empty(old('disabilityId'))){
                                $selectId=old('disabilityId');
                              }else{
                                $selectId=$editDetails['disabilityId'];
                              }
                            }else{
                              $selectId=old('disabilityId');
                            }
                            ?>
                            <option value="{{$dval->disabilityId}}" <?php if($selectId==$dval->disabilityId){ echo "selected";}?>>{{$dval->disabilityName}}</option>
                            
                          <?php }?>
                        </select>
                        <span class="errMsg_disabilityId errDiv"></span>
                      </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6">
                      <div class="utf-submit-field">
                        <h5>Disability Subtype *</h5>
                        <input type="text" class="utf-with-border" placeholder="Disability Subtype" name="disabilitySubType" id="disabilitySubType" value="{{!empty($editDetails['disabilitySubType'])?(!empty(old('disabilitySubType')))?old('disabilitySubType'):$editDetails['disabilitySubType']:old('disabilitySubType')}}">
                        <span class="errMsg_disabilitySubType errDiv"></span>
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

      if (!blankCheck('disabilityId', 'Disability can not be left blank'))
          return false;

      if (!blankCheck('disabilitySubType', 'Disability subtype can not be left blank'))
          return false;

       $('#confirmAlertModal').modal('show');
      $('#btnConfirmModalOK').on('click',function(){
          $('#listform').submit(); 
      });
        
  }
</script>
@endsection
@endsection


@extends('layouts.adminlayout')
@section('page-content')
  
  <!-- Add Education -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Add Candidate Education</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
              <li>Manage Master</li>
              <li>Add Candidate Education</li>
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
          <a href="<?php echo ROOT_URL.'/application/master/education'?>" class="button utf-ripple-effect-dark">View Candidate Education</a>      
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
                      <h5>Education Name *</h5>
                      <input type="text" class="utf-with-border" placeholder="Education Name" name="txtEducation" id="txtEducation" value="{{!empty($editDetails['educationName'])?(!empty(old('txtEducation')))?old('txtEducation'):$editDetails['educationName']:old('txtEducation')}}">
                      <span class="errMsg_txtEducation errDiv"></span>
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Type *</h5>
                      <select class="utf-with-border" name="selEducation" id="selEducation">
                        <option value="">--Select--</option>

                        <?php $eduTypeArr = json_decode(EDUCATION_TYPE,true);
                            foreach ($eduTypeArr as $eduTypeArrKey => $eduTypeArrVal) {
                          if(!empty($editDetails['educationType'])){
                            if(!empty(old('selEducation'))){
                              $selectId=old('selEducation');
                            }else{
                              $selectId=$editDetails['educationType'];
                            }
                          }else{
                            $selectId=old('selEducation');
                          }
                          ?>
                          <option value="{{$eduTypeArrKey}}" <?php if($selectId==$eduTypeArrKey){ echo "selected";}?>>{{$eduTypeArrVal}}</option>
                          
                        <?php }?>
                      </select>
                      <span class="errMsg_selEducation errDiv"></span>
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
      $('.error-input').removeClass('error-input');
      if (!blankCheck('txtEducation', 'Education name can not be left blank'))
          return false;

      if (!selectDropdown('selEducation', 'Select education type'))
            return false;

      $('#confirmAlertModal').modal('show');
          $('#btnConfirmModalOK').on('click',function(){
          $('#listform').submit(); 
         });
        
  }
  function readImageDisability(input, imgElement) {
      $('#' + imgElement).show();
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#' + imgElement).attr('src', e.target.result);

          }
          reader.readAsDataURL(input.files[0]);
      }
      $('#closeSI').show();
  }
</script>
@endsection
@endsection


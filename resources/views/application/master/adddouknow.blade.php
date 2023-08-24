@extends('layouts.adminlayout')
@section('page-content')
  
  <!-- Add Board -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Add Did you know</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
              <li>Manage Master</li>
              <li>Add Did you know</li>
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
          <a href="<?php echo ROOT_URL.'/application/master/douknow'?>" class="button utf-ripple-effect-dark">View Did you know</a>      
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
                            <h5>Twitter Link</h5>
                            <input type="text" class="utf-with-border" maxlength="152" placeholder="Enter Twitter Link"
                              name="twitterLink"
                              value="{{(!empty($editCatDetail))?$editCatDetail['twitterLink']:''}}"
                              id="twitterLink">
                            <span class="errMsg_twitterLink errDiv"></span>
                          </div>
                        </div>
                       <div class="col-xl-6 col-md-6 col-sm-6">
                          <div class="utf-submit-field">
                            <h5>Facebook Link</h5>
                            <input type="text" class="utf-with-border" maxlength="152" placeholder="Enter Facebook Link"
                              name="facebookLink"
                              value="{{(!empty($editCatDetail))?$editCatDetail['facebookLink']:''}}"
                              id="facebookLink">
                            <span class="errMsg_facebookLink errDiv"></span>
                          </div>
                        </div>
                    </div>
                <div class="row">
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Content *</h5>
                       <textarea cols="100" rows="2" class="utf-with-border" placeholder="Write a brief details about the Content..." id="Description" name="Description">{{!empty($editCatDetail['Description'])?(!empty(old('Description')))?old('Description'):$editCatDetail['Description']:old('Description')}}</textarea>
                     
                      <span class="errMsg_Description errDiv"></span>
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
        //if (!blankCheck('twitterLink', 'Twitter Link can not be left blank'))
         /// return false;
         //  if (!blankCheck('facebookLink', 'Facebook Link can not be left blank'))
          //return false;
      if (!blankCheck('Description', 'Content can not be left blank'))
          return false;
      $('#confirmAlertModal').modal('show');
          $('#btnConfirmModalOK').on('click',function(){
          $('#listform').submit(); 
         });
        
  }
</script>
@endsection
@endsection


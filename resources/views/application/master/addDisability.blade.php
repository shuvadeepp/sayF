@extends('layouts.adminlayout')
@section('page-content')
  
  <!-- Add Disability -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Add Disability</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
              <li>Manage Master</li>
              <li>Add Disability</li>
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
          <a href="<?php echo ROOT_URL.'/application/master/disability'?>" class="button utf-ripple-effect-dark">View Disability</a>      
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
                      <h5>Disability Name *</h5>
                      <input type="text" class="utf-with-border" placeholder="Disability Name" name="txtDisability" id="txtDisability" value="{{!empty($editDetails['disabilityName'])?(!empty(old('txtDisability')))?old('txtDisability'):$editDetails['disabilityName']:old('txtDisability')}}">
                      <span class="errMsg_txtDisability errDiv"></span>
                    </div>
                  </div>

               <!--    <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Icon</h5>
                      <input type="file" id="desabilityIcon" name="desabilityIcon" class="utf-with-border" placeholder="Upload Photo" onchange="readImageDisability(this,'imagemetaFileDesable');">
                      <label for="desabilityIcon">Upload Icon</label>
                      <input type="hidden" name="hdnIcon" id="hdnIcon" value="{{!empty($editDetails['image'])?$editDetails['image']:''}}">
                      <span class="errMsg_desabilityIcon errDiv"></span>
                    </div>
                    <div> <span class="help-inline"> <img src="<?php if(!empty($editDetails['image'])){ echo ROOT_URL.'/storage/uploads/disabilityicon/'.$editDetails['image']; } else{ echo ""; } ?>" alt="" width="52" height="65" border="0" align="absmiddle" id="imagemetaFileDesable" <?php if(empty($editDetails['image'])){ ?>style="display: none;" <?php } ?>> <a href="javascript:void(0);" id="closeS" class="imgClose" <?php if(empty($editDetails['image'])){ ?> style="display:none;" <?php } ?>><i class="fa fa-times-circle"></i></a> </span> </div>
                  </div> -->
        
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
      if (!blankCheck('txtDisability', 'Disability name can not be left blank'))
          return false;

      // if($('#desabilityIcon').val()=='' && $('#hdnIcon').val()==''){
      //     if (!blankCheck('desabilityIcon', 'Icon can not be left blank'))
      //     return false;
      // }

      // if ($('#desabilityIcon').val() != '')
      // {
      //     if (!IsCheckFile('desabilityIcon', 'Invalid file types. ', 'jpg,png,jpeg,gif'))
      //         return false;

      //     var fileSize_inKB = Math.round(($("#desabilityIcon")[0].files[0].size / 1024));
      //     if (fileSize_inKB > 1024)
      //     {
      //         $('.errMsg_desabilityIcon').html('File size exceeds 1MB').show();
      //         return false;
      //     }
      // }
       $('#confirmAlertModal').modal('show');
      $('#btnConfirmModalOK').on('click',function(){
          $('#listform').submit(); 
      });

    
        
  }
  // function readImageDisability(input, imgElement) {
  //     $('#' + imgElement).show();
  //     if (input.files && input.files[0]) {
  //         var reader = new FileReader();
  //         reader.onload = function (e) {
  //             $('#' + imgElement).attr('src', e.target.result);

  //         }
  //         reader.readAsDataURL(input.files[0]);
  //     }
  //     $('#closeSI').show();
  // }
</script>
@endsection
@endsection


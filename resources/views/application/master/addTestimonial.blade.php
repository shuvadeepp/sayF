@extends('layouts.adminlayout')
@section('page-content')
<?php //echo'<pre>';print_r($editDetails);exit;?>
<!-- Add Board -->
<div class="utf-dashboard-content-container-aera" data-simplebar>
   <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
         <div class="col-xl-12">
            <h3>Add Testimonial</h3>
            <nav id="breadcrumbs">
               <ul>
                  <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
                  <li>Manage Master</li>
                  <li>Add Testimonial</li>
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
               <a href="<?php echo ROOT_URL . '/application/master/Testimonial/viewTestimonial' ?>" class="button utf-ripple-effect-dark">View Testimonial</a>
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
                              <h5>Name *</h5>
                              <input type="text" class="utf-with-border" name="txtName" id="txtName" placeholder="Enter Your Name"  value="{{ !empty($editDetails['tsmName']) ? $editDetails['tsmName'] : '' }}">
                              <span class="errMsg_txtName errDiv"></span>
                           </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                           <div class="utf-submit-field">
                              <h5>Title *</h5>
                              <input type="text" class="utf-with-border" name="txtTitle" id="txtTitle" placeholder="Enter Title" value="{{ !empty($editDetails['tsmTtitle']) ? $editDetails['tsmTtitle'] : '' }}" >
                              <span class="errMsg_txtTitle errDiv"></span>
                           </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-sm-6">
                           <div class="utf-submit-field">
                              <h5>Designation *</h5>
                              <input type="text" name="txtDesignation" id="txtDesignation" class="utf-with-border" placeholder="Enter Designation"  value="{{ !empty($editDetails['tsmDesignation']) ? $editDetails['tsmDesignation'] : '' }}">
                              <span class="errMsg_txtDesignation errDiv"></span>
                           </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-sm-6">
                           <div class="utf-submit-field">
                              <h5>Address *</h5>
                              <input type="text" name="txtAdress" id="txtAdress" class="utf-with-border" placeholder="Enter Address"  value="{{ !empty($editDetails['tsmAddress']) ? $editDetails['tsmAddress'] : '' }}">
                              <span class="errMsg_txtAdress errDiv"></span>
                           </div>
                        </div>

                     </div>
                     <div class="utf-submit-field" id="pdfFile">
                        <h5>Upload Image *</h5>
                        <input type="file" id="uplodImg" name="uplodImg" class="utf-with-border" placeholder="Upload Photo" >
                        <label for="uplodImg">Upload Image</label>
                        <input type="hidden" name="hdnuplodImg" id="hdnuplodImg" value="{{!empty($editDetails['tsmImage']) ? $editDetails['tsmImage'] : '' }}">
                        <span class="errMsg_uplodImg errDiv"></span>
                     </div>
                     <div> <span class="help-inline"> <img src="<?php if(!empty($editDetails['tsmImage'])){ echo ROOT_URL.'/storage/app/uploads/testimonial/'.$editDetails['tsmImage']; } else{ echo ""; } ?>" alt="" width="52" height="65" border="0" align="absmiddle" id="imagemetaFileBlog" <?php if(empty($editDetails['tsmImage'])){ ?>style="display: none;" <?php } ?>> <a href="javascript:void(0);" id="closeS" class="imgClose" <?php if(empty($editDetails['tsmImage'])){ ?> style="display:none;" <?php } ?>></a> </span> 
                </div>
                     <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                           <div class="utf-submit-field">
                              <h5>Content *</h5>
                              <textarea cols="100" rows="2" class="utf-with-border" placeholder="Write a brief details about the Content..." id="txtContent" name="txtContent">{{ !empty($editDetails['tsmContent']) ? $editDetails['tsmContent'] : '' }}</textarea>

                              <span class="errMsg_txtContent errDiv"></span>
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
<script>
   function validator() {
      
      $('.errDiv').hide();
      $('.error-input').removeClass('error-input');
      if (!blankCheck('txtName', 'Name can not be left blank'))
         return false;
      if (!blankCheck('txtTitle', 'Title name can not be left blank'))
         return false;

      if (!blankCheck('txtDesignation', 'Designation can not be left blank'))
         return false;

      if (!blankCheck('txtAdress', 'Address can not be left blank'))
         return false;

      var thumbImage    = $('#uplodImg').val();
      var hdnthumbImage = $('#hdnuplodImg').val();
         if(thumbImage == '' && hdnthumbImage == ''){
            $('.errMsg_uplodImg').html("Upload Image can not left blank").show();
            $('#uplodImg').addClass('error-input');
            $('#uplodImg').focus();
            return false;
         }
        
        if (thumbImage != "") {
            if (!IsCheckFile('uplodImg', 'Invalid file types. Upload only ', 'jpg,png,jpeg'))
            {
                $("#uplodImg").focus();
                return false;
            }
        }

         if (!blankCheck('txtContent', 'Content can not be left blank'))
            return false;

      $('#confirmAlertModal').modal('show');
      $('#btnConfirmModalOK').on('click', function() {
         $('#listform').submit();
      });

   }
</script>
@endsection
@endsection
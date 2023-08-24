@extends('layouts.adminlayout')
@section('page-content')
@section('page-css')
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/jquery-ui.css">
@endsection
<!-- Add Banner -->
<?php //$pageArr = array('0'=>'','1'=>'Home','2'=>'About us','3'=>'Employers','4'=>'NGO-and-communities','5'=>'Persons with Disabilitie','6'=>'Policy advocacy','8'=>'Donate','9'=>'Volunteer','10'=>'Resource','11'=>'Connect','12'=>'Explore job','13'=>'Gallery', '14'=>'LetsSay-OurBlogs','15'=>'Press Release');
   $pageArrr = array('0'=>'Select Page Type','1'=>'Home','2'=>'About us','8'=>'Donate','9'=>'Volunteer','10'=>'Resource','11'=>'Contact','12'=>'Explore job', '14'=>'LetsSay-OurBlogs','15'=>'Press Release','16'=>'Job Details','17'=>'Blog Details','18'=>'User Login','19'=>'Register','20'=>'Forget Password');
   ?>
   <?php $docTypeArr = array(1 => "Documents & Reprots", 2 => "Websites & Social Media"); ?>
<div class="utf-dashboard-content-container-aera" data-simplebar>
   <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
         <div class="col-xl-12">
            <h3>Add Resource</h3>
            <nav id="breadcrumbs">
               <ul>
                  <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
                  <li>Manage Master</li>
                  <li>Add Resource</li>
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
               <a href="<?php echo ROOT_URL.'/application/master/Resource'?>" class="button utf-ripple-effect-dark">View Resource</a>      
            </div>
         </div>
         <div class="col-xl-12">
            <form method="post" id="resourceform" enctype="multipart/form-data">
               {{csrf_field()}}
              <div class="dashboard-box"> 
              <div class="content with-padding padding-bottom-10">
                <div class="row">

                  <div class="col-12">
                    <div class="utf-submit-field">
                      <h5>Document Name *</h5>
                      <input type="text" class="utf-with-border mb-1" placeholder="Title Name" name="documentName" id="documentName" value="{{ !empty($editDetails['docName']) ? $editDetails['docName'] : '' }}" maxlength="100">                     
                      <span class="errMsg_documentName errDiv"></span>
                    </div>
                  </div>
                              <?php //  echo'<pre>';print_r($docTypeArr);exit;?>   

                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Document Type *</h5>                    
                      <select name="docType" id="docType">  
                      <option value="0"> Select Type </option>  
                      @if(!empty($docTypeArr))                   
                        @foreach($docTypeArr as $key => $type)
                          <option {{(isset($editDetails['docType']) && $editDetails['docType'] == $key) ? "selected" : ''}} value='{{$key}}'> {{ !empty($type) ? $type : "" }} </option>
                        @endforeach
                      @endif
                      </select>                     
                      <span class="errMsg_docType errDiv"></span>
                    </div>                    
                  </div>              
                </div>
                
                <div class="utf-submit-field" id="pdfFile">
                  <h5>Documents & Reprots *</h5>
                  <input type="file" id="pdfImage" name="pdfImage" class="utf-with-border" placeholder="Upload Photo" >
                  <label for="pdfImage">Upload Pdf File</label>
                  <input type="hidden" name="hdnpdfImage" id="hdnpdfImage" value="{{!empty($editDetails['docFile']) ? $editDetails['docFile'] : '' }}">
                  <span class="errMsg_pdfImage errDiv"></span>
                </div>
                    
                </div>

                <div class="col-12" >
                  <div class="utf-submit-field" id="urlShow">
                    <h5>Websites & Social Media *</h5>
                    <input type="text" name="urlLink" id="urlLink" class="utf-with-border mb-1" placeholder="Site URL" value="{{!empty($editDetails['resourceUrl']) ? $editDetails['resourceUrl'] : ""}}" maxlength="100">                     
                    <span class="errMsg_urlLink errDiv"></span>
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
<script src="<?php echo PUBLIC_PATH; ?>js/jquery-ui.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/custom-datepicker.js"></script>
<script src="{{ROOT_URL}}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="{{ROOT_URL}}/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
  $(document).ready(function () {
    $('#pdfFile').hide();
    $('#urlShow').hide();

    // var updateCase = "<?php //echo (isset($editDetails['docType'])) ? $editDetails['docType'] : ''; ?>";
    // var updateCase = "<?php //echo $editDetails['docType']; ?>";
    var updateCase = $("#docType").val();
    // alert(updateCase);
      if(updateCase == "0"){ 
        $('#pdfFile').hide();
        $('#urlShow').hide();
      }else if(updateCase == "1"){ 
        $('#pdfFile').show();
      }else{
        $('#urlShow').show();
      }
  });

  $('#docType').on('change', function() {
    var selectedValue = $(this).val();
    if(selectedValue == 1) {
      $('#pdfFile').show();
      $('#urlShow').hide();
    }else {
      $('#urlShow').show();
      $('#pdfFile').hide();
    }
  }); 

  function validator() {

    $('.errDiv').hide();
    $('.error-input').removeClass('error-input');
    if (!blankCheck('documentName', 'Document Name can not be left blank'))
      return false;
      var docType = $('#docType').val();
      // alert(docType)
        if(docType == '0'){
          $('.errMsg_docType').html("Page Type can not be left blank").show();
          $('#docType').focus();
          return false;
        }else if(docType == '1'){
          var bannerImage     = $('#pdfImage').val();
          var hdnbannerImage  = $('#hdnpdfImage').val();
            if(bannerImage == '' && hdnbannerImage == '') {
              $('.errMsg_pdfImage').html("PDF File can not left blank").show();
              $('#pdfImage').addClass('error-input');
              $('#pdfImage').focus();
              return false;   
            }
        } else if(docType == '2'){
          if (!blankCheck('urlLink', 'Websites & Social Media can not be left blank'))
          return false;  
        }

    $('#confirmAlertModal').modal('show');
      $('#btnConfirmModalOK').on('click',function(){
      $('#resourceform').submit();           
    });
  }
</script>
@endsection
@endsection
@extends('layouts.adminlayout')
@section('page-content')
@section('page-css')
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/jquery-ui.css">
@endsection
  <!-- Add Banner -->
  <?php //$pageArr = array('0'=>'','1'=>'Home','2'=>'About us','3'=>'Employers','4'=>'NGO-and-communities','5'=>'Persons with Disabilitie','6'=>'Policy advocacy','8'=>'Donate','9'=>'Volunteer','10'=>'Resource','11'=>'Connect','12'=>'Explore job','13'=>'Gallery', '14'=>'LetsSay-OurBlogs','15'=>'Press Release');
  
  $pageArrr = array('0'=>'Select Page Type','1'=>'Home','2'=>'About us','8'=>'Donate','9'=>'Volunteer','10'=>'Resource','11'=>'Contact','12'=>'Explore job', '14'=>'LetsSay-OurBlogs','15'=>'Press Release','16'=>'Job Details','17'=>'Blog Details','18'=>'User Login','19'=>'Register','20'=>'Forget Password','21'=>'Linkedin feeds');
  ?>

  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Add Banner</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
              <li>Manage Master</li>
              <li>Add Banner</li>
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
          <a href="<?php echo ROOT_URL.'/application/master/banner'?>" class="button utf-ripple-effect-dark">View Banner</a>      
        </div>
      </div>
      
      <div class="col-xl-12">
        <form method="post" id="bannerform" enctype="multipart/form-data">
          {{csrf_field()}}
            <div class="dashboard-box"> 
              <div class="content with-padding padding-bottom-10">
                <div class="row">
                  <div class="col-12">
                    <div class="utf-submit-field">
                      <h5>Banner Title *</h5>
                      <input type="text" class="utf-with-border mb-1" placeholder="Title Name" name="bannerTitle" id="bannerTitle" value="{{!empty($editDetails['bannerTitle'])?(!empty(old('bannerTitle')))?old('bannerTitle'):$editDetails['bannerTitle']:old('bannerTitle')}}" maxlength="100">                     
                      <span class="errMsg_bannerTitle errDiv"></span>
                    </div>
                  </div>
                                 

                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Page Type *</h5>                    
                      <select name="pageType" id="pageType">                       
                        <?php foreach($pageArrr as $key=>$page) { ?>
                          <option <?php if(isset($editDetails['pageType']) && $editDetails['pageType'] == $key){ echo 'selected'; } else { echo ''; } ?> value='<?php echo $key; ?>'>{{$page}}</option>
                          <?php } ?>                        
                      </select>                     
                      <span class="errMsg_pageType errDiv"></span>
                    </div>                    
                  </div>              
                </div>
                
                <div class="utf-submit-field">
                      <h5>Image *</h5>
                      <input type="file" id="bannerImage" name="bannerImage" class="utf-with-border" placeholder="Upload Photo" onchange="readImageBanner(this,'imagemetaFileBlog');">
                      <label for="bannerImage">Upload Banner Image</label>
                      <input type="hidden" name="hdnbannerImage" id="hdnbannerImage" value="{{!empty($editDetails['bannerImage'])?$editDetails['bannerImage']:''}}">
                      <span class="errMsg_bannerImage errDiv"></span>
                    </div>
                    <div> <span class="help-inline"> <img src="<?php if(!empty($editDetails['bannerImage'])){ echo ROOT_URL.'/storage/app/uploads/banner/'.$editDetails['bannerImage']; } else{ echo ""; } ?>" alt="" width="52" height="65" border="0" align="absmiddle" id="imagemetaFileBlog" <?php if(empty($editDetails['bannerImage'])){ ?>style="display: none;" <?php } ?>> <a href="javascript:void(0);" id="closeS" class="imgClose" <?php if(empty($editDetails['bannerImage'])){ ?> style="display:none;" <?php } ?>><i class="fa fa-times-circle"></i></a> </span> 
                </div>

                <div class="utf-submit-field">
                    <h5>Banner Text *</h5>
                    <!-- <textarea cols="40" rows="2" class="utf-with-border" placeholder="Write a brief details about the banner..." id="bannerText" name="bannerText"> </textarea> -->
                    <input type="text" class="utf-with-border mb-1" placeholder="Title Name" name="bannerText" id="bannerText" value="{{!empty($editDetails['bannerText'])?(!empty(old('bannerText')))?old('bannerText'):$editDetails['bannerText']:old('bannerText')}}" />
                    <span class="errMsg_bannerText errDiv"></span>

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
<script
>
$(document).ready(function() {
   
});
   function validator()
  {   
      $('.errDiv').hide();
      $('.error-input').removeClass('error-input');
      if (!blankCheck('bannerTitle', 'Title can not be left blank'))
          return false;
          var bannertype=$('#pageType').val();
          if(bannertype == '0'){
            $('.errMsg_pageType').html("Page Type can not be left blank").show();
            $('#pageType').focus();
          return false;
          }
      // if (!blankCheck('pageType', 'Page Type can not be left blank'))
      //     return false;           
       
        
        var bannerImage = $('#bannerImage').val();
        var hdnbannerImage = $('#hdnbannerImage').val();
        if(bannerImage=='' && hdnbannerImage==''){
          $('.errMsg_bannerImage').html("Banner image can not left blank").show();
          $('#bannerImage').addClass('error-input');
          $('#bannerImage').focus();
          return false;
        }
        
        if (bannerImage != "") {
            if (!IsCheckFile('bannerImage', 'Invalid file types. Upload only ', 'jpg,png,jpeg'))
            {
                $("#bannerImage").focus();
                return false;
            }
        }
        if (!blankCheck('bannerText', 'Banner text can not be left blank'))
          return false;  

     $('#confirmAlertModal').modal('show');
         $('#btnConfirmModalOK').on('click',function(){
         $('#bannerform').submit();           
       });
        
  }
  function readImageBanner(input, imgElement) {   
    // alert(imgElement)
      $('#' + imgElement).show();
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#' + imgElement).attr('src', e.target.result);

          }
          reader.readAsDataURL(input.files[0]);
      }
      $('#closeS').show();
  }

  $('#closeS').on('click',function(){
    $('#bannerImage,#hdnbannerImage').val('');
    $('#imagemetaFileBlog').attr('src', '');
    $('#imagemetaFileBlog, #closeS').hide();
  });

  // function convertToSlug(Text, bindId)
  //   {
  //       var slug = Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
  //       //$("." + bindId).val(slug);

  //       // $(".hdnslugspan").text(slug);
  //   }
   
</script>
@endsection
@endsection


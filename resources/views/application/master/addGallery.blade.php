@extends('layouts.adminlayout')
@section('page-content')
@section('page-css')
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/jquery-ui.css">
@endsection
  <!-- Add Gallery -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Add Gallery</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
              <li>Manage Master</li>
              <li>Add Gallery</li>
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
            <a href="<?php echo ROOT_URL.'/application/master/gallery'?>" class="button utf-ripple-effect-dark">View Gallery</a>      
          </div>
        </div>
        
        <div class="col-xl-12">
          <form method="post" id="listform" enctype="multipart/form-data">
            {{csrf_field()}}
              <div class="dashboard-box"> 
                <div class="content with-padding padding-bottom-10">
                  <div class="row">
                    <div class="col-12">
                      <div class="utf-submit-field">
                        <h5>Media Type *</h5>
                        <select class="utf-with-border mtype" name="type" id="type">
                          <option <?php echo (@$editDetails['type'] == 'Photo')?'selected':''; ?> value="Photo">Photo</option>
                          <option <?php echo (@$editDetails['type'] == 'Video')?'selected':''; ?> value="Video">Video</option>
                        </select>
                        <span class="errMsg_type errDiv"></span>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="utf-submit-field">
                        <h5> Caption *</h5>
                        <input type="text" class="utf-with-border mb-2" placeholder="Caption" name="caption" id="caption" value="{{!empty($editDetails['caption'])?(!empty(old('caption')))?old('caption'):$editDetails['caption']:old('caption')}}">                      
                        <span class="errMsg_caption errDiv"></span>
                      </div>
                    </div>

                  </div>

                  <div class="mtypePhoto" style="display: <?php echo (@$editDetails['type'] == 'Video')?'none':'block'; ?>"> 

                    <div class="utf-submit-field">
                        <h5>Image *</h5>
                        <input type="file" id="galleryImage" name="galleryImage" class="utf-with-border" placeholder="Upload Photo" onchange="readImagegallery(this,'imagemetaFilegallery');">                       
                        <label for="galleryImage">Upload Gallery Image</label>
                        <input type="hidden" name="hdngalleryImage" id="hdngalleryImage" value="{{!empty($editDetails['galleryImage'])?$editDetails['galleryImage']:''}}">
                        <small class="text-danger">(Maximum image size is 1MB of type jpeg/jpg/png)</small>
                        <span class="errMsg_galleryImage errDiv"></span>

                    </div>


                    <div> <span class="help-inline"> <img src="<?php if(!empty($editDetails['galleryImage'])){ echo ROOT_URL.'/storage/app/uploads/gallery/'.$editDetails['galleryImage']; } else{ echo ""; } ?>" alt="" width="52" height="65" border="0" align="absmiddle" id="imagemetaFilegallery" <?php if(empty($editDetails['galleryImage'])){ ?>style="display: none;" <?php } ?>> <a href="javascript:void(0);" id="closeS" class=" remove imgClose" <?php if(empty($editDetails['galleryImage'])){ ?> style="display:none;" <?php } ?>><i class="icon-line-awesome-close"></i></a> </span> 
                    </div>  

                  </div>

                  <div class="row mtypeVideo" style="display: <?php echo (@$editDetails['type'] == 'Photo' || empty($editDetails['type']) == 'Photo')?'none':'block'; ?>"> 
                    <div class="col-12">
                      <div class="utf-submit-field">
                        <h5> Youtube Link *</h5>
                        <input type="text" class="utf-with-border mb-2" placeholder="Enter here" name="url" id="url" value="{{!empty($editDetails['url'])?(!empty(old('url')))?old('url'):$editDetails['url']:old('url')}}">                     
                        <span class="errMsg_url errDiv"></span>
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
<script src="<?php echo PUBLIC_PATH; ?>js/jquery-ui.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/custom-datepicker.js"></script>
<script src="{{ROOT_URL}}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="{{ROOT_URL}}/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script
>

$('.mtype').on('change',function(){

  if($('.mtype').val() == 'Photo'){
      $('.mtypePhoto').show();
      $('.mtypeVideo').hide();
  }else{
      $('.mtypePhoto').hide();
      $('.mtypeVideo').show();
  }

});


function validator(){

    $('.errDiv').hide();
    $('.error-input').removeClass('error-input');
    if (!blankCheck('caption', 'Caption can not be left blank'))
        return false;

      if($('.mtype').val() == 'Photo'){
        var galleryImage = $('#galleryImage').val();
        var hdngalleryImage = $('#hdngalleryImage').val();
        if(galleryImage=='' && hdngalleryImage==''){
          $('.errMsg_galleryImage').html("Image can not left blank").show();
          $('#galleryImage').addClass('error-input');
          $('#galleryImage').focus();
          return false;
        }
        
        if (galleryImage != "") {
            if (!IsCheckFile('galleryImage', 'Invalid file types. Upload only ', 'jpg,png,jpeg'))
            {
                $("#galleryImage").focus();
                return false;
            }
        }
      }else{
          if(!blankCheck('url','Youtube link can not be left blank'))
            return false;
      }
     $('#confirmAlertModal').modal('show');
          $('#btnConfirmModalOK').on('click',function(){
          $('#listform').submit(); 
         });
}

function readImagegallery(input, imgElement) {
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
  $('#galleryImage,#hdngalleryImage').val('');
  $('#imagemetaFilegallery').attr('src', '');
  $('#imagemetaFilegallery,#closeS').hide();
});

</script>
@endsection
@endsection


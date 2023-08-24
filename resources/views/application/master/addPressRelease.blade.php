@extends('layouts.adminlayout')
@section('page-content')
@section('page-css')
<?php //echo'<pre>';print_r($editDetails);exit;?>
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/jquery-ui.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!-- ::::: DATE TIME PICKER Dt-07-04-2023 ::::: -->
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/jquery.datetimepicker.min.css">
<!-- ::::: DATE TIME PICKER Dt-07-04-2023 END  ::::: -->
@endsection
<?php //echo'<pre>';print_r($editDetails);exit;?>
  <!-- Add Blog -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Add Press Release</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
              <li>Manage Master</li>
              <li>Add Press Release</li>
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
          <a href="<?php echo ROOT_URL.'/application/master/PressRelease'?>" class="button utf-ripple-effect-dark">View Press Release</a>      
        </div>
      </div>
      <?php //echo'<pre>';print_r($editDetails);exit;?>
      <div class="col-xl-12">
        <form method="post" id="listform" enctype="multipart/form-data">
          {{csrf_field()}}
            <div class="dashboard-box"> 
              <div class="content with-padding padding-bottom-10">
                <div class="row">
                  <div class="col-12">
                    <div class="utf-submit-field">
                      <h5>Title Name *</h5>
                      <input type="text" class="utf-with-border mb-1" placeholder="Title Name" name="txtTitle" id="txtTitle" value="{{ !empty($editDetails['pressTitle']) ? $editDetails['pressTitle'] : '' }}" onkeyup="convertToSlug(this.value,'hdnslug');" maxlength="100">
                      <small class="text-gray hdnslugspan"></small>
                      <span class="errMsg_txtTitle errDiv"></span>
                    </div>
                  </div>
                   <input type="hidden" class="utf-with-border hdnslug" placeholder="Slug Name" name="txtSlug" id="txtSlug" value="" maxlength="150" readonly>
                
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Publish Date *</h5>
                      <div class="utf-input-with-icon">
                        <input type="text" class="utf-with-border datetimepicker" placeholder="Publish Date" name="txtPressDate" id="txtPressDate" value="{{ !empty($editDetails['publishDate']) ? $editDetails['publishDate'] : '' }}" readonly >
                       <label for="txtPressDate"> <i class="icon-feather-calendar"></i> </label>
                        <span class="errMsg_txtPressDate errDiv"></span>
                      </div> 
                    </div>                    
                  </div>

                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Posted By *</h5>
                      <input type="text" class="utf-with-border" placeholder="Posted By" name="txtPostby" id="txtPostby" value="{{ !empty($editDetails['postedBy']) ? $editDetails['postedBy'] : '' }}" maxlength="50">
                      <span class="errMsg_txtPostby errDiv"></span>
                    </div>                    
                  </div>

                  <div class="col-xl-12 col-md-12 col-sm-12">
                    <div class="utf-submit-field">
                      <h5>Source *</h5>
                      <input type="text" class="utf-with-border" placeholder="Enter Source" name="txtSource" id="txtSource" value="{{ !empty($editDetails['source']) ? $editDetails['source'] : '' }}" >
                      <span class="errMsg_txtSource errDiv"></span>
                    </div>                    
                  </div>
                  
                 
                  <div class="col-12">
                  <div class="utf-submit-field">
                    <h5>Image *</h5>
                    <input type="file" id="pressImage" name="pressImage" class="utf-with-border" placeholder="Upload Photo" onchange="readImageBlog(this,'imagemetaFileBlog');">
                    <label for="pressImage">Upload Press Image</label>
                    <input type="hidden" name="hdnpressImage" id="hdnpressImage" value="{{ !empty($editDetails['pressImage']) ? $editDetails['pressImage'] : '' }}">
                    <span class="errMsg_pressImage errDiv"></span>
                  </div>
                  <div> <span class="help-inline"> <img src="<?php if(!empty($editDetails['pressImage'])){ echo ROOT_URL.'/storage/app/uploads/pressRelease/'.$editDetails['pressImage']; } else{ echo ""; } ?>" alt="" width="52" height="65" border="0" align="absmiddle" id="imagemetaFileBlog" <?php if(empty($editDetails['pressImage'])){ ?>style="display: none;" <?php } ?>> <a href="javascript:void(0);" id="closeS" class="imgClose" <?php if(empty($editDetails['pressImage'])){ ?> style="display:none;" <?php } ?>></a> </span> 
                </div>
                </div>
                
              <div class="col-12">
              <div class="utf-submit-field">
                  <h5>Content *</h5>
                  <textarea cols="40" rows="2" class="utf-with-border" placeholder="Write a brief details about the blog..." id="pressDetails" name="pressDetails">{{ !empty($editDetails['pressDetails']) ? $editDetails['pressDetails'] : '' }}</textarea>
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
<!-- ::::: DATE TIME PICKER Dt-07-04-2023 ::::: -->
<script src="<?php echo PUBLIC_PATH; ?>js/jquery.datetimepicker.full.min.js"></script> 
<script>
    $(document).ready(function() { 
      $(".datetimepicker").each(function () {
        $(this).datetimepicker(); 
      }); 
});
/* ::::: DATE TIME PICKER Dt-07-04-2023 END ::::: */
// $(document).ready(function() {
//     $( ".datepickerBlog" ).datepicker({
//         changeMonth: true,
//         changeYear: true,
//         dateFormat: "d M y",
//         });
// });
   function validator(){
      
      $('.errDiv').hide();
      $('.error-input').removeClass('error-input');
      if (!blankCheck('txtTitle', 'Title name can not be left blank'))
        return false;

      if (!blankCheck('txtPressDate', 'Date can not be left blank'))
        return false;

      if (!blankCheck('txtPostby', 'Post By can not be left blank'))
        return false;

      /* if (!blankCheck('txtSource', 'Source can not be left blank'))
        return false; */

        var pressImage    = $('#pressImage').val();
        var hdnpressImage = $('#hdnpressImage').val();
        if(pressImage == '' && hdnpressImage == ''){
          $('.errMsg_pressImage').html("Press Release Image can not left blank").show();
          $('#pressImage').addClass('error-input');
          $('#pressImage').focus();
          return false;
        }
        
        if (pressImage != "") {
            if (!IsCheckFile('pressImage', 'Invalid file types. Upload only ', 'jpg,png,jpeg'))
            {
                $("#pressImage").focus();
                return false;
            }
        }

      // if (!blankCheck('pressDetails', 'Content can not be left blank'))
      //   return false;

      $('#confirmAlertModal').modal('show');
          $('#btnConfirmModalOK').on('click',function(){
          $('#listform').submit(); 
         });
        
  }
  function readImageBlog(input, imgElement) {
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
    $('#thumbImage,#hdnthumbImage').val('');
    $('#thumbimagemetaFileBlog').attr('src', '');
    $('#thumbimagemetaFileBlog, #closeS').hide();
  });

  $('#closeS').on('click',function(){
    $('#blogImage,#hdnBlogImage').val('');
    $('#imagemetaFileBlog').attr('src', '');
    $('#imagemetaFileBlog, #closeS').hide();
  });

  function convertToSlug(Text, bindId)
    {
        var slug = Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        $("." + bindId).val(slug);

         $(".hdnslugspan").text(slug);
    }
    // CKEDITOR.replace('pressDetails', {
    //     toolbarGroups: [{
    //         "name": "basicstyles",
    //         "groups": ["basicstyles","links","list"]          
           
    //     }
    //     ],
    //     removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    // });
    // CKEDITOR.config.removePlugins = 'elementspath';

    CKEDITOR.replace( 'pressDetails', {
    
    toolbarGroups: [
          { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
          { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
          { name: 'editing', groups: [ 'find', 'selection', 'editing' ] },
          { name: 'forms', groups: [ 'forms' ] },
          { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup','link','list' ] },
          { name: 'styles', groups: [ 'styles' ] },
          { name: 'colors', groups: [ 'colors' ] },
          { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
          { name: 'links', groups: [ 'links' ] },
         
          { name: 'tools', groups: [ 'tools' ] },
          { name: 'others', groups: [ 'others' ] },
          { name: 'about', groups: [ 'about' ] },
          { name: 'insert', groups: [ 'Image'] }
    
    ],
    removeButtons: 'Strike,Subscript,Superscript,Anchor,RemoveFormat,SpecialChar,HorizontalRule,Outdent,Indent',
    // removeButtons: 'Strike,Subscript,Superscript,Anchor,Specialchar,SelectAll,ImageButton,Maximize,ShowBlocks,CreateDiv,Undo,Redo,RemoveFormat,PasteFromWord,PasteText,SpecialChar,About,PageBreak,HorizontalRule,Outdent,Indent',
  height: '35%'  }
  );
  CKEDITOR.config.removePlugins = 'elementspath';
</script>
@endsection
@endsection


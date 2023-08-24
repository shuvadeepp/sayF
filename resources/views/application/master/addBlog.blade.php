@extends('layouts.adminlayout')
@section('page-content')
@section('page-css')
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
          <h3>Add Blog</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
              <li>Manage Master</li>
              <li>Add Blog</li>
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
          <a href="<?php echo ROOT_URL.'/application/master/blog'?>" class="button utf-ripple-effect-dark">View Blog</a>      
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
                      <input type="text" class="utf-with-border mb-1" placeholder="Title Name" name="txtTitle" id="txtTitle" value="{{!empty($editDetails['blogTitle'])?(!empty(old('txtTitle')))?old('txtTitle'):$editDetails['blogTitle']:old('txtTitle')}}" onkeyup="convertToSlug(this.value,'hdnslug');" maxlength="100">
                      <small class="text-gray hdnslugspan">{{!empty($editDetails['blogSlug'])?(!empty(old('txtSlug')))?old('txtSlug'):$editDetails['blogSlug']:old('txtSlug')}}</small>
                      <span class="errMsg_txtTitle errDiv"></span>
                    </div>
                  </div>
                   <input type="hidden" class="utf-with-border hdnslug" placeholder="Slug Name" name="txtSlug" id="txtSlug" value="{{!empty($editDetails['blogSlug'])?(!empty(old('txtSlug')))?old('txtSlug'):$editDetails['blogSlug']:old('txtSlug')}}" maxlength="150" readonly>

                  <!-- <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Slug Name</h5>
                      <input type="text" class="utf-with-border hdnslug" placeholder="Slug Name" name="txtSlug" id="txtSlug" value="{{!empty($editDetails['blogSlug'])?(!empty(old('txtSlug')))?old('txtSlug'):$editDetails['blogSlug']:old('txtSlug')}}" maxlength="150" readonly>
                      <span class="errMsg_txtSlug errDiv"></span>
                    </div>                    
                  </div> -->
                  
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Publish Date *</h5>
                      <div class="utf-input-with-icon">
                        <input type="text" class="utf-with-border datetimepicker" placeholder="Publish Date" name="txtBlogDate" id="txtBlogDate" value="{{ (!empty($editDetails['publishDate']))?date('d M y H:i:s', strtotime($editDetails['publishDate'])):''}}" readonly >
                       <label for="txtBlogDate"> <i class="icon-feather-calendar"></i> </label>
                        <span class="errMsg_txtBlogDate errDiv"></span>
                      </div> 
                    </div>                    
                  </div>

                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Posted By *</h5>
                      <input type="text" class="utf-with-border" placeholder="Posted By" name="txtPostby" id="txtPostby" value="{{!empty($editDetails['postedBy'])?(!empty(old('txtPostby')))?old('txtPostby'):$editDetails['postedBy']:old('txtPostby')}}" maxlength="50">
                      <span class="errMsg_txtPostby errDiv"></span>
                    </div>                    
                  </div>
                  <!-- TIME FIELD -->
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Estimate Read Time *</h5>
                      <input type="text" class="utf-with-border" onkeypress="return isNumberKey(event);" placeholder="Estimate Read Time In Minutes" name="txtReadTime" id="txtReadTime" value="{{!empty($editDetails['intReadTime']) ? $editDetails['intReadTime'] : ''}}" maxlength="100">
                      <!-- <label for="txtReadTime"> <i>(In Minutes)</i> </label> -->
                      </div>
                      <span class="errMsg_txtReadTime errDiv"></span>      
                  </div>
                  </div>
                  <!-- TIME FIELD -->
                  <!-- THUMBNAIL IMAGE FIELD -->
                  <!-- <div class="col-xl-6 col-md-6 col-sm-6"> -->
                    <div class="utf-submit-field">
                        <h5>Thumbnail Image *</h5>
                        <input type="file" id="thumbImage" name="thumbImage" class="utf-with-border" placeholder="Upload Thumbnail Image" onchange="readImageBlog(this,'thumbimagemetaFileBlog');">
                        <label for="thumbImage">Upload Thumbnail Image</label>
                        <input type="hidden" name="hdnthumbImage" id="hdnthumbImage" value="{{!empty($editDetails['thumbnail_Image'])?$editDetails['thumbnail_Image']:''}}">
                        <span class="errMsg_thumbImage errDiv"></span>
                    <!-- </div> -->
                  <!-- </div> -->
                   <!-- THUMBNAIL IMAGE FIELD -->
                   <span class="help-inline"> <img src="<?php if(!empty($editDetails['thumbnail_Image'])){ echo ROOT_URL.'/storage/app/uploads/thumbnail/'.$editDetails['thumbnail_Image']; } else{ echo ""; } ?>" alt="" width="52" height="65" border="0" align="absmiddle" id="thumbimagemetaFileBlog" <?php if(empty($editDetails['thumbnail_Image'])){ ?>style="display: none;" <?php } ?>> <a href="javascript:void(0);" id="closeS" class="imgClose" <?php if(empty($editDetails['thumbnail_Image'])){ ?> style="display:none;" <?php } ?>></a> </span> 
                </div>
                
                <div class="utf-submit-field">
                      <h5>Image *</h5>
                      <input type="file" id="blogImage" name="blogImage" class="utf-with-border" placeholder="Upload Photo" onchange="readImageBlog(this,'imagemetaFileBlog');">
                      <label for="blogImage">Upload Blog Image</label>
                      <input type="hidden" name="hdnBlogImage" id="hdnBlogImage" value="{{!empty($editDetails['blogImage'])?$editDetails['blogImage']:''}}">
                      <span class="errMsg_blogImage errDiv"></span>
                    </div>
                    <div> <span class="help-inline"> <img src="<?php if(!empty($editDetails['blogImage'])){ echo ROOT_URL.'/storage/app/uploads/blog/'.$editDetails['blogImage']; } else{ echo ""; } ?>" alt="" width="52" height="65" border="0" align="absmiddle" id="imagemetaFileBlog" <?php if(empty($editDetails['blogImage'])){ ?>style="display: none;" <?php } ?>> <a href="javascript:void(0);" id="closeS" class="imgClose" <?php if(empty($editDetails['blogImage'])){ ?> style="display:none;" <?php } ?>></a> </span> 
                </div>

                <div class="utf-submit-field">
                    <h5>Details *</h5>
                    <textarea cols="40" rows="2" class="utf-with-border" placeholder="Write a brief details about the blog..." id="blogDetails" name="blogDetails">{{!empty($editDetails['blogDetails'])?(!empty(old('blogDetails')))?old('blogDetails'):$editDetails['blogDetails']:old('blogDetails')}} </textarea>
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
   function validator()
  {
      $('.errDiv').hide();
      $('.error-input').removeClass('error-input');
      if (!blankCheck('txtTitle', 'Title name can not be left blank'))
          return false;
      //  if (!blankCheck('txtSlug', 'Slug name can not be left blank'))
         // return false;
        if (!blankCheck('txtBlogDate', 'Blog publish date can not be left blank'))
          return false;
        if (!blankCheck('txtPostby', 'Post by can not be left blank'))
          return false;

        if(!blankCheck('txtReadTime','Estimated read time is required'))
          return false;
        if(!validateNumber('txtReadTime','Estimated read time required only Number'))
          return false;

        var thumbImage    = $('#thumbImage').val();
        var hdnthumbImage = $('#hdnthumbImage').val();
        if(thumbImage == '' && hdnthumbImage == ''){
          $('.errMsg_thumbImage').html("Thumbnail Image can not left blank").show();
          $('#thumbImage').addClass('error-input');
          $('#thumbImage').focus();
          return false;
        }
        
        if (thumbImage != "") {
            if (!IsCheckFile('thumbImage', 'Invalid file types. Upload only ', 'jpg,png,jpeg'))
            {
                $("#thumbImage").focus();
                return false;
            }
        }
        
        var blogImage = $('#blogImage').val();
        var hdnBlogImage = $('#hdnBlogImage').val();
        if(blogImage=='' && hdnBlogImage==''){
          $('.errMsg_blogImage').html("Blog image can not left blank").show();
          $('#blogImage').addClass('error-input');
          $('#blogImage').focus();
          return false;
        }
        
        if (blogImage != "") {
            if (!IsCheckFile('blogImage', 'Invalid file types. Upload only ', 'jpg,png,jpeg'))
            {
                $("#blogImage").focus();
                return false;
            }
        }


        
       

        if(!blankCheck('txtReadTime','Estimated read time is required'))
          return false;

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
    // CKEDITOR.replace('blogDetails', {
    //     toolbarGroups: [{
    //         "name": "basicstyles",
    //         "groups": ["basicstyles","links","list"]          
           
    //     }
    //     ],
    //     removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    // });
    // CKEDITOR.config.removePlugins = 'elementspath';

    CKEDITOR.replace( 'blogDetails', {
    
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


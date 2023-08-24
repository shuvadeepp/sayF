@extends('layouts.partnerlayout')
@section('page-css')
<link rel="stylesheet" href="{{PUBLIC_PATH}}css/cropper.css">
<style type="text/css">
  img {
    display: block;
    max-width: 100%;
  }

  .img-container img {
    display: block;
    max-width: 100%;
  }
</style>
@endsection
@section('page-content')
<?php 
  $logodirpath  = STORAGE_PATH.'partnerlogo';
  $servicesList   = collect($services)->map(function($x){ return (array) $x; })->toArray();
?>
<!-- Employer Profile -->
<!-- <div class="utf-dashboard-container-aera">  -->


<!-- Employer Profile -->
<div class="utf-dashboard-content-container-aera" data-simplebar>
  <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
    <div class="row">
      <div class="col-xl-12">
        <h3>NGO Profile</h3>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}/ngo/dashboard">Home</a></li>
            <li>NGO Profile</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <!-- Page Content -->
  <div class="utf-dashboard-content-inner-aera">
    <!-- <div class="row">
      <div class="col-xl-6"> -->
    @include('components.admin-msg-tap')
    <form method="post" id="employer-profile" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="dashboard-box margin-top-0 margin-bottom-30">
        <div class="headline">
          <h3> Organization Details</h3>
        </div>
        <div class="content with-padding padding-bottom-15">
          <div class="profile-details">
            <!-- <div class="col-xl-12"> -->
            <!-- <div class="row"> -->
              <div class="profile-details__img">
                <div class="utf-avatar-wrapper emp-profile-upload" data-tippy-placement="top" data-tippy=""
                  data-original-title="Company logo">
                  <img class="profile-pic"
                    src="<?php echo (!empty($existingProfile))?$logodirpath.'/'.$existingProfile->companyLogo:PUBLIC_PATH.'images/no-logo-images.png';?>"
                    alt="Company">
                  <div class="upload-button"></div>
                  <input class="file-upload image" type="file" name="companyLogo" id="companyLogo" accept="image/*">
                  <input type="hidden" name="hdncompanyLogo" id="companyLogo"
                    value="{{(!empty($existingProfile))?$existingProfile->companyLogo:''}}">
                  <input type="hidden" name="hdnbase64file" id="hdnbase64file" value="">
                </div>
                <small>(Logo size should be less than 10MB.)</small>
                <?php if(!empty($existingProfile->companyLogo)){ ?>
                <a href="javascript:void(0)" onclick="return removeProfileImage();" class="remove-upload-img">Remove
                  Image</a>
                <?php } ?>
                <span class="errMsg_companyLogo errDiv"></span>
              </div>
             
            <div class="profile-details__fields">
              <div class="row">
                <div class="col-xl-8">
                  <div class="row">
                    <div class="col-xl-6">
                      <div class="utf-submit-field">
                        <h5>NGO Name</h5>
                        <input type="text" class="utf-with-border" maxlength="64" placeholder="Enter your name"
                          name="partnerName" id="partnerName"
                          value="{{(!empty($existingProfile))?$existingProfile->partnerName:session()->get('partner_session_data.fullName')}}"
                          onkeypress="return isCharKey(event);">
                        <span class="errMsg_partnerName errDiv"></span>
                      </div>
                    </div>
                    <div class="col-xl-6">
                      <div class="utf-submit-field">
                        <h5>Designation</h5>
                        <input type="text" class="utf-with-border" placeholder="Enter your designation"
                          name="partnerDesignation" maxlength="64"
                          value="{{(!empty($existingProfile))?(!empty(old('partnerDesignation')))?old('partnerDesignation'):$existingProfile->partnerDesignation:old('partnerDesignation')}}"
                          id="partnerDesignation">
                        <span class="errMsg_partnerDesignation errDiv"></span>
                      </div>
                    </div>
                    <div class="col-xl-6">
                      <div class="utf-submit-field">
                        <h5>Organization Name</h5>
                        <input type="text" class="utf-with-border" maxlength="128" name="partnerCompany"
                          id="partnerCompany"
                          value="{{(!empty($existingProfile))?$existingProfile->partnerCompany:session()->get('partner_session_data.companyName')}}"
                          placeholder="Organization Name">
                        <span class="errMsg_partnerCompany errDiv"></span>
                      </div>
                    </div>
                    <div class="col-xl-6">
                      <div class="utf-submit-field">
                        <h5>Organization Website</h5>
                        <input type="text" class="utf-with-border" maxlength="152"
                          placeholder="Enter Organization Website" name="partnerWebsite"
                          value="{{(!empty($existingProfile))?(!empty(old('partnerWebsite')))?old('partnerWebsite'):$existingProfile->partnerWebsite:old('partnerWebsite')}}"
                          id="partnerWebsite">
                        <span class="errMsg_partnerWebsite errDiv"></span>
                      </div>
                    </div>
                  </div>
                  <div class="utf-submit-field">
                    <h5>State(s)</h5>
                    <div class="utf-submit-field utf-intro-search-field-item">
                      <?php 
                        $sel_locations = array();
                        if(!empty(@$existingProfile->partnerLocation)){
                          foreach(explode(',', $existingProfile->partnerLocation) as $key => $value) {
                            array_push($sel_locations,$value);
                          }
                        }
                      ?>
                      <select class="selectpicker default utf-with-border states" data-live-search="true" data-size="5"
                        name="partnerLocation[]" id="partnerLocation" title="Select Location" multiple="">
                        @if($locations->isNotEmpty())
                        @foreach($locations as $locvals)
                        <option value="{{$locvals->stateId}}" <?php echo in_array($locvals->stateId,
                          $sel_locations)?'selected':''; ?>>{{$locvals->state}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <span class="errMsg_partnerLocation errDiv"></span>
                  </div>
                  <div class="utf-submit-field">
                    <h5>city(s)</h5>
                      <select  class="selectpicker default utf-with-border" data-live-search="true" data-size="5"
                        name="selcity[]" id="selcity" title="Select City" multiple="">
                       <option value="0">--select--</option>
               
                  </select>

                       <span class="errMsg_selcity errDiv"></span>
                    </div>
                 
                  <div class="utf-submit-field">
                    <h5>Service(s)</h5>
                    <span class="label-info d-none d-lg-block">To add services, kindly type and hit 'ENTER'</span>
                    <div class="pos-relative">
                      <input type="text" name="" placeholder="Type your service . . ."
                        class="utf-with-border input-skill" onkeyup="return loadservices(this.value);">
                      <input type="hidden" name="partnerService" id="partnerService" value="">
                      <ul class="autofill-dropdown" style="display: none;">
                      </ul>
                    </div>
                    <ul class="selected-skill">
                      <?php $explvals = !empty($existingProfile)?explode(',',$existingProfile->partnerService):''; if(!empty($explvals)) { foreach ($explvals as $sk => $skval) {
                        # code..
                        $key  = array_search($skval, array_column($servicesList, 'serviceId'));
                        echo '<li data-id="'.$skval.'">'.$servicesList[$key]['serviceName'].'<span class="remove-skill"></span></li>';
                      } } ?>
                    </ul>
                    <span class="errMsg_partnerService errDiv"></span>
                  </div>
                  <div class="row">
                    <div class="col-12 col-xl-4">
                      <div class="utf-submit-field">
                        <h5>Organization Strength</h5>
                        <select class="selectpicker utf-with-border" data-size="7" name="partnerSize" id="partnerSize"
                          title="Select Organization Strength">
                          <option value="1-10" <?php if((!empty($existingProfile) && $existingProfile->partnerSize ==
                            '1-10') || old('partnerSize') == '1-10'){ echo 'selected';}?>>1-10</option>
                          <option value="10-50" <?php if((!empty($existingProfile) && $existingProfile->partnerSize ==
                            '10-50') || old('partnerSize') == '10-50'){ echo 'selected';}?>>10-50</option>
                          <option value="50-100" <?php if((!empty($existingProfile) && $existingProfile->partnerSize ==
                            '50-100') || old('partnerSize') == '50-100'){ echo 'selected';}?>>50-100</option>
                          <option value="100-200" <?php if((!empty($existingProfile) && $existingProfile->partnerSize ==
                            '100-200') || old('partnerSize') == '100-200'){ echo 'selected';}?>>100-200</option>
                          <option value="200-500" <?php if((!empty($existingProfile) && $existingProfile->partnerSize ==
                            '200-500') || old('partnerSize') == '200-500'){ echo 'selected';}?>>200-500</option>
                          <option value="500-1000" <?php if((!empty($existingProfile) && $existingProfile->partnerSize
                            == '500-1000') || old('partnerSize') == '500-1000'){ echo 'selected';}?>>500-1000</option>
                          <option value="1000" <?php if((!empty($existingProfile) && $existingProfile->partnerSize ==
                            '1000') || old('partnerSize') == '1000'){ echo 'selected';}?>>1000+</option>
                        </select>
                        <span class="errMsg_partnerSize errDiv"></span>
                      </div>
                    </div>

                  </div>
                  <div class="utf-submit-field">
                    <h5>Organization Introduction</h5>
                    <textarea class="utf-with-border" name="partnerCompanyintro" id="partnerCompanyintro" cols="20"
                      rows="3">{{(!empty($existingProfile))?(!empty(old('partnerCompanyintro')))?old('partnerCompanyintro'):$existingProfile->partnerCompanyintro:old('partnerCompanyintro')}}</textarea>
                    <span class="errMsg_partnerCompanyintro errDiv"></span>
                  </div>
                  <div class="utf-submit-field">
                    <h5>Registered Address</h5>
                    <textarea name="partnerCompanyaddr" id="partnerCompanyaddr" class="utf-with-border" cols="20"
                      rows="3">{{(!empty($existingProfile))?(!empty(old('partnerCompanyaddr')))?old('partnerCompanyaddr'):$existingProfile->partnerCompanyaddr:old('partnerCompanyaddr')}}</textarea>
                    <span class="errMsg_partnerCompanyaddr errDiv"></span>
                  </div>
                  <div class="utf-submit-field">
                    <h5>Service Offered</h5>
                    <textarea name="partnerServiceOffered" id="partnerServiceOffered" class="utf-with-border" cols="40"
                      rows="2">{{(!empty($existingProfile))?(!empty(old('partnerServiceOffered')))?old('partnerServiceOffered'):$existingProfile->partnerServiceOffered:old('partnerServiceOffered')}}</textarea>

                    <span class="errMsg_partnerServiceOffered errDiv"></span>
                  </div>
                  <div class="utf-centered-button mb-4">
                    <a href="javascript:void(0);" onclick="return validator();"
                      class="button utf-ripple-effect-dark margin-top-0">Update Profile</a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
    </form>
    <!-- </div>
    </div> -->

  </div>
  <!-- Page Content ends -->

</div>
<!-- </div> -->

@endsection
<!-- cropper modal-->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mb-0" id="modalLabel">
          Partner Image
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </h5>

      </div>
      <div class="modal-body">
        <div class="img-container">
          <div class="row">
            <div class="col-md-8">
              <img id="image" src="">
            </div>
            <div class="col-md-4">
              <div class="preview"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="crop">Crop</button>
      </div>
    </div>
  </div>
</div>
<!-- cropper modal end-->
@include('components.admin-alert-modal')

<script src="{{ROOT_URL}}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="{{ROOT_URL}}/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
@section('page-js')
<!--cropper  -->
<script src="{{PUBLIC_PATH}}js/cropper.js"></script>
<script>
  var userid = '<?php echo SESSION('partner_session_data.userId');?>';
  loadnotifiation(userid, 3);
    $(document).ready(function () {
var citys='<?php echo  !empty($existingProfile->partnerCity)?$existingProfile->partnerCity:0; ?>';
var states='<?php echo !empty($existingProfile->partnerLocation)?$existingProfile->partnerLocation:0; ?>';
if(citys!=0){
  loadmultiplecity(states,citys);
}
 $('.states').on('change', function(event) {
   var joblocation = [];
    $(".states :selected").each(function(){
      console.log($(this).val());
      joblocation.push($(this).val()); 
    });
   loadmultiplecity(joblocation,0);
  });
});
 function loadmultiplecity(jobmultiplelocation,cityval){
  var arrcity=[];
  if(cityval!=0){
   var arrcity = $.map(cityval.split(','), function(value){
    return parseInt(value, 10);
   });
   console.log(jobmultiplelocation);
   var jobmultiplelocation=jobmultiplelocation.split(',');
 }
   $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/website/ajax/loadmultiplecity",
      data        : {jobmultiplelocation:jobmultiplelocation},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      },
      beforeSend: function () {    
      },
      success: function (res) {
        if(res.status==200){
             var result   = res.result;
             var html='';
             var selected='';
            if(result!=null){
               $(result).each(function (i,val) {
                selected='';
                console.log(arrcity);
                if(arrcity!=null){
                if(jQuery.inArray(val.locationId,arrcity) != -1) {
                    selected='selected';
                }
              }
                html+='<option value="'+val.locationId+'" '+selected+'>'+val.location+'</option>';
                });
             }
             $('#selcity').html(html).selectpicker('refresh');;
           }
       }
   });
 }
  var $modal = $('#modal');
  var image = document.getElementById('image');
  var cropper;
  var _URL = window.URL || window.webkitURL;
  $("body").on("change", ".image", function (e) {
    var file, img;
    var ret = 0;
    if ((file = this.files[0])) {
      img = new Image();
      var objectUrl = _URL.createObjectURL(file);
      img.onload = function () {
<<<<<<< HEAD
        var imgwidth = this.width;
        var imgheight = this.height;
          if(imgwidth < 250 || imgheight < 250){
            ret = 1;
            viewAlert('Sorry!! Upload image dimention of more than 250X250');
          }
=======
        // var imgwidth = this.width;
        // var imgheight = this.height;
        // if(imgwidth < 250 || imgheight < 250){
        //     ret = 1;
        //     viewAlert('Sorry!! Upload image dimention of more than 250X250');
        //   }
>>>>>>> 981c9b1c945b80d58849f971e3bbd131389d37b9
        //alert(this.width + " " + this.height);
        _URL.revokeObjectURL(objectUrl);
      };
      img.src = objectUrl;
    }
    setTimeout(function () {
      //alert(ret)
      if (ret == 0) {
        var files = e.target.files;
        var done = function (url) {
          image.src = url;
          $modal.modal('show');
        };
        var reader;
        var file;
        var url;
        if (files && files.length > 0) {
          file = files[0];
          if (URL) {
            done(URL.createObjectURL(file));
          } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
              done(reader.result);
            };
            reader.readAsDataURL(file);
          }
        }
      }
    }, 700)
  });
  $modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
      cropBoxResizable: true,
      viewMode: 3,
      preview: '.preview'
    });
  }).on('hidden.bs.modal', function () {
    cropper.destroy();
    cropper = null;
  });
  $("#crop").click(function () {
    canvas = cropper.getCroppedCanvas({
      width: 160,
      height: 160,
    });
    canvas.toBlob(function (blob) {
      url = URL.createObjectURL(blob);
      var reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onloadend = function () {
        var base64data = reader.result;
        if (base64data != '') {
          $modal.modal('hide');
          $(".profile-pic").attr("src", base64data);
          $("#hdnbase64file").val(base64data);
        }
      }
    });
  });
</script>
<!-- cropper  end -->
<script
>
  $("#pwdSizeHead").on('change', function () {
    if ($(this).val() != 'None') {
      $("#pwdSize").show();
    } else {
      $("#pwdSize").hide();
    }
  });
  $(".remove-skill").on('click', function () {
    $(this).parent('li').remove();
  });


<<<<<<< HEAD
  /*  function ValidURL(str,controlId) {
    var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
    if(!regex .test(str)) {
      $('.errMsg_'+controlId).html('Please enter a valid Website URL.').show();
      $('#'+controlId).addClass('error-input');
      $('#'+controlId).focus();
      return false;
    } else {
      return true;
    }
  } */
  function ValidURL(str,controlId) {
    // var regex = /?\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
    $regex1      = /^[a-zA-Z0-9_\- \/+:,.!@&()\r\n]*$/;
    if(!regex .test(str)) {
      $('.errMsg_'+controlId).html('Please enter a valid Website URL.').show();
=======
   function ValidURL(str,controlId) {
    var regex      = /^[a-zA-Z0-9_\- \/+:,.\r\n]*$/;
   // var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
    if(!regex .test(str)) {
      $('.errMsg_'+controlId).html('Please enter a valid Website URL.').show();
>>>>>>> 981c9b1c945b80d58849f971e3bbd131389d37b9
      $('#'+controlId).addClass('error-input');
      $('#'+controlId).focus();
      return false;
    } else {
      return true;
    }
  }

  function validator() {
    $('.errDiv').hide();
    $('.error-input').removeClass('error-input');
      <?php if (!empty($existingProfile) && empty($existingProfile->companyLogo)) {?>
        if (!blankCheck('companyLogo', 'Please upload Company Logo '))
        return false;
      if (!IsCheckFile('companyLogo', 'Please upload a file of file type ', 'jpg,png,JPEG,PNG,svg,gif,GIF,SVG'))
        return false;
      <?php } else if (empty($existingProfile)) { ?>
        if (!blankCheck('companyLogo', 'Please upload Company Logo '))
        return false;
      if (!IsCheckFile('companyLogo', 'Please upload a file of file type ', 'jpg,png,JPEG,PNG,svg,gif,GIF,SVG'))
        return false;
      <?php } ?>        

    if (!blankCheck('partnerName', 'Name can not be left blank'))
      return false;

    if (!blankCheck('partnerDesignation', 'Designation can not be left blank'))
      return false;
    if (!checkSpecialChar('partnerDesignation', 'Designation can not be alphanumeric'))
      return false;



    if (!blankCheck('partnerCompany', 'Company Name can not be left blank'))
      return false;

    if (!blankCheck('partnerWebsite', 'Company Website can not be left blank'))
      return false;

    if (!ValidURL($('#partnerWebsite').val(), 'partnerWebsite'))
      return false;

    if (!blankCheck('partnerLocation', 'State can not be left blank'))
      return false;
     if (!blankCheck('selcity', 'City can not be left blank'))
      return false;
    

    if (!blankCheck('partnerCompanyintro', 'Organization Introduction can not be left blank'))
      return false;

    if (!blankCheck('partnerCompanyaddr', 'Company Address can not be left blank'))
      return false;

  //  if (!blankEditorCheck('partnerServiceOffered', 'Service Offered can not be left blank'))
     // return false;

    var finalservices = '';
    if ($('.selected-skill li').length > 0) {
      $('.selected-skill li').each(function () {
        var selval = $(this).data('id');
        finalservices += selval + ',';
        //finalservices.push(selval);
      });
    }

    $('#partnerService').val(finalservices.slice(0, -1));

    if (!blankCheck('partnerService', 'Service can not be left blank'))
      return false;
    //return false;
    $('#employer-profile').submit();

  }

  function removeProfileImage() {
    $('#confirmAlertModal').modal('show');
    $('#btnConfirmModalOK').on('click', function () {
      $.ajax({
        type: 'POST',
        url: SITE_URL + "/ngo/profile/removeProfileImage",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
          //$(".loading-gif").hide();
        },
        success: function (res) {
          viewAlert(res.msg);
          if (res.status == 200) {
            location.reload();
          }
        }
      });
    });
  }

  $('.input-skill').keypress(function (e) {
    var key = e.which;
    if (key == 13)  // the enter key code
    {
      var newText = $(".input-skill").val();
      pushnewService(newText);
    }
  });

  CKEDITOR.replace('partnerServiceOffered', {
    toolbarGroups: [{
      "name": "basicstyles",
      "groups": ["basicstyles", "links", "list"]
    }
    ],
    removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
  });
  CKEDITOR.config.removePlugins = 'elementspath';
</script>
@endsection
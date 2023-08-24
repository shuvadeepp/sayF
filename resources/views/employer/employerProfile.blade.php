@extends('layouts.employerlayout')
@section('page-css')
<link rel="stylesheet" href="{{PUBLIC_PATH}}css/cropper.css">
<!-- <style type="text/css">
  img {
    display: block;
    max-width: 100%;
  }
  .img-container img {
      display: block;
      max-width: 100%;
    }
</style> -->
@endsection
@section('page-content')
<?php 
  $logodirpath  = STORAGE_PATH.'companylogo';
  $skillsList   = collect($skills)->map(function($x){ return (array) $x; })->toArray(); 
  // echo'<pre>';print_r($skillsList[0]['skillName']);exit;
?>
<!-- Employer Profile -->
<!-- <div class="utf-dashboard-container-aera">  -->

<div class="utf-dashboard-content-container-aera" data-simplebar>
  <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
    <div class="row">
    <!-- validation -->
      <div class="col-xl-12">
        <h3>Employer Profile</h3>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}/employer/dashboard">Home</a></li>
            <li>Employer Profile</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <!-- Page Content -->
  <div class="utf-dashboard-content-inner-aera">
    <!-- <div class="row">
      <div class="col-xl-6"> -->

      
    <!-- validation - 13-05-22 -->
    <div class="notification error closeable errshow">  
      <div class="errorMsg" id="errorMsg">
        <ol></ol>
      </div>
    </div>
    <!-- end -->  
<?php //echo'<pre>';print_R($existingProfile->employerSkills);exit;?>
    @include('components.admin-msg-tap')
    <form method="post" id="employer-profile" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="dashboard-box margin-top-0 margin-bottom-30">
        <div class="headline">
          <h3> Company Details</h3>
        </div>
        <div class="content with-padding padding-bottom-15">
          <div class="profile-details">
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
              <?php if(!empty($existingProfile->companyLogo)){ ?>
              <a href="javascript:void(0)" onclick="return removeProfileImage();" class="remove-upload-img">
                <span>Remove Image</span><span class="icon-feather-trash pl-1"></span></a>
              <?php } ?>
              <small>(Maximum file size should be less than 10MB)</small>
              <span class="errMsg_companyLogo errDiv"></span>
            </div>
            <div class="profile-details__fields">
              <div class="row">
                <div class="col-xl-8">
                  <div class="row">
                    <div class="col-xl-6">
                      <div class="utf-submit-field">
                        <h5>Name</h5>
                        <input type="text" class="utf-with-border" maxlength="64" placeholder="Enter your name"
                          name="employerName" id="employerName"
                          value="{{(!empty($existingProfile))?$existingProfile->employerName:session()->get('employer_session_data.fullName')}}"
                          onkeypress="return isCharKey(event);">
                        <!-- <span class="errMsg_employerName errDiv"></span> -->
                      </div>
                    </div>
                    <div class="col-xl-6">
                      <div class="utf-submit-field">
                        <h5>Designation</h5>
                        <input type="text" class="utf-with-border" placeholder="Enter your designation"
                          name="employerDesignation" maxlength="64"
                          value="{{(!empty($existingProfile))?(!empty(old('employerDesignation')))?old('employerDesignation'):$existingProfile->employerDesignation:old('employerDesignation')}}"
                          id="employerDesignation">
                        <!-- <span class="errMsg_employerDesignation errDiv"></span> -->
                      </div>
                    </div>
                    <div class="col-xl-6">
                      <div class="utf-submit-field">
                        <h5>Company Name</h5>
                        <input type="text" class="utf-with-border" maxlength="128" name="employerCompany"
                          id="employerCompany"
                          value="{{(!empty($existingProfile))?$existingProfile->employerCompany:session()->get('employer_session_data.companyName')}}"
                          placeholder="Company Name">
                        <!-- <span class="errMsg_employerCompany errDiv"></span> -->
                      </div>
                    </div>
                    <div class="col-xl-6">
                      <div class="utf-submit-field">
                        <h5>Company Website</h5>
                        <input type="text" class="utf-with-border" maxlength="152" placeholder="Enter Company Website"
                          name="employerWebsite"
                          value="{{(!empty($existingProfile))?(!empty(old('employerWebsite')))?old('employerWebsite'):$existingProfile->employerWebsite:old('employerWebsite')}}"
                          id="employerWebsite">
                        <!-- <span class="errMsg_employerWebsite errDiv"></span> -->
                      </div>
                    </div>
                  </div>
                  <div class="utf-submit-field">
                    <h5>State(s)</h5>
                    <div class="utf-submit-field utf-intro-search-field-item">
                      <?php 
                      $sel_locations = array();
                      if(!empty(@$existingProfile->employerLocation)){
                        foreach(explode(',', $existingProfile->employerLocation) as $key => $value) {
                          array_push($sel_locations,$value);
                        }
                      }
                    ?>
                      <select class="selectpicker default utf-with-border states" data-live-search="true" data-size="5"
                        name="employerLocation[]" id="employerLocation" title="Select Location" multiple="">
                        @if($locations->isNotEmpty())
                        @foreach($locations as $locvals)
                        <option value="{{$locvals->stateId}}" <?php echo in_array($locvals->stateId,
                          $sel_locations)?'selected':''; ?>>{{$locvals->state}}</option>
                        @endforeach
                        @endif
                      </select>
                    

                    </div>
                    <span class="errMsg_employerLocation errDiv"></span>
                  </div>
                   <div class="utf-submit-field">
                     <div class="utf-submit-field utf-intro-search-field-item">
                    <h5>city(s)</h5>
                      <select  class="selectpicker default utf-with-border" data-live-search="true" data-size="5"
                        name="selcity[]" id="selcity" title="Select City"  multiple="">
                       <option value="0">--select--</option>
               
                  </select>
                </div>

                     <!-- <span class="errMsg_selcity errDiv"></span> -->
                    
                    </div>
                  
                <!--   </div> -->
                  <div class="utf-submit-field">
                    <h5>Skills that you hire for</h5>
                    <span class="label-info d-none d-lg-block">To add skills, kindly type and hit 'ENTER'</span>
                    <div class="pos-relative">
                      <input type="text" name="" placeholder="Type your skill . . ." class="utf-with-border input-skill"
                        onkeyup="return loadskills(this.value);">
                      <input type="hidden" name="emplskill" id="emplskill">
                      <ul class="autofill-dropdown" style="display: none;">
                      </ul>
                    </div><?php //echo'<pre>';print_R($existingProfile);exit; ?>
                    <ul class="selected-skill">
                    <?php 
                      $explvals = !empty($existingProfile->employerSkills)?explode('/',$existingProfile->employerSkills):''; 
                      
                      if(!empty($explvals)) { 
                        foreach ($explvals as $sk => $skval) {
                         // echo $skval;
                          if(!empty($skval)){
                            $key  = array_search($skval, array_column($skillsList, 'skillsId'));                                   
                            echo '<li data-id="'.$skval.'">'.$skillsList[$key]['skillName'].'<span class="remove-skill"></span></li>';  
                          } 
                        } 
                      } 
                  ?>
                    </ul>
                  </div>

                  <div class="row">
                    <div class="col-12 col-xl-4">
                      <div class="utf-submit-field">
                        <h5>Company Strength</h5>
                        <select class="selectpicker utf-with-border" data-size="7" name="employerSize" id="employerSize"
                          title="Select Employee Strength">
                          <option value="1-10" <?php if((!empty($existingProfile) && $existingProfile->employerSize ==
                            '1-10') || old('employerSize') == '1-10'){ echo 'selected';}?>>1-10</option>
                          <option value="10-50" <?php if((!empty($existingProfile) && $existingProfile->employerSize ==
                            '10-50') || old('employerSize') == '10-50'){ echo 'selected';}?>>10-50</option>
                          <option value="50-100" <?php if((!empty($existingProfile) && $existingProfile->employerSize ==
                            '50-100') || old('employerSize') == '50-100'){ echo 'selected';}?>>50-100</option>
                          <option value="100-200" <?php if((!empty($existingProfile) && $existingProfile->employerSize ==
                            '100-200') || old('employerSize') == '100-200'){ echo 'selected';}?>>100-200</option>
                          <option value="200-500" <?php if((!empty($existingProfile) && $existingProfile->employerSize ==
                            '200-500') || old('employerSize') == '200-500'){ echo 'selected';}?>>200-500</option>
                          <option value="500-1000" <?php if((!empty($existingProfile) && $existingProfile->employerSize
                            == '500-1000') || old('employerSize') == '500-1000'){ echo 'selected';}?>>500-1000</option>
                          <option value="1000" <?php if((!empty($existingProfile) && $existingProfile->employerSize ==
                            '1000') || old('employerSize') == '1000'){ echo 'selected';}?>>1000+</option>
                        </select>
                        <!-- <span class="errMsg_employerSize errDiv"></span> -->
                      </div>
                    </div>
                    <div class="col-12 col-xl-8">
                      <div class="utf-submit-field">
                        <h5>Your current workforce comprising of PwDs</h5>
                        <div class="row">
                          <div class="col-6 pr-0">
                            <select class="selectpicker utf-with-border" name="pwdSizeHead" id="pwdSizeHead">
                              <option <?php if((!empty($existingProfile) && $existingProfile->pwdSizeHead == 'None') || old('pwdSizeHead') == 'None'){
                                echo
                                'selected';}?> value="None">None</option>
                              <option <?php if((!empty($existingProfile) && $existingProfile->pwdSizeHead ==
                                'Percentage') || old('pwdSizeHead') == 'Percentage'){
                                echo 'selected';}?> value="Percentage">Percentage</option>
                              <option <?php if((!empty($existingProfile) && $existingProfile->pwdSizeHead == 'Nos') || old('pwdSizeHead') == 'Nos'){ echo
                                'selected';}?> value="Nos">Nos</option>
                            </select>
                          </div>

                          <div class="col-6">
                            <input type="text" class="utf-with-border" onkeypress="return isNumberKey(event);"
                              placeholder="Size" name="pwdSize" id="pwdSize"
                              value="{{(!empty($existingProfile))?(!empty(old('pwdSize')))?old('pwdSize'):$existingProfile->pwdSize:old('pwdSize')}}" maxlength="4"
                              style="display: {{(!empty($existingProfile))?'block':'none'}};">
                          </div>
                        </div>

                        <!-- <span class="errMsg_pwdSize errDiv"></span> -->
                      </div>
                    </div>
                  </div>

                  <div class="utf-submit-field">
                    <h5>Industry</h5>
                    <select class="selectpicker utf-with-border" data-size="7" name="employerIndustry"
                      id="employerIndustry" title="Select Industry">
                      @if($industries->isNotEmpty())
                      @foreach($industries as $indval)
                      <?php
                    $indselected = '';
                    if((!empty($existingProfile) && $existingProfile->employerIndustry == $indval->industryId) || old('employerIndustry') == $indval->industryId){ 
                        $indselected = 'selected="selected"';
                      }else{
                        $indselected = '';
                      }
                    ?>
                      <option value="{{$indval->industryId}}" {{$indselected}}>{{$indval->industryName}}</option>
                      @endforeach
                      @endif
                    </select>
                    <!-- <span class="errMsg_employerIndustry errDiv"></span> -->
                  </div>
                  <div class="utf-submit-field">
                    <h5>Company Introduction</h5>
                    <textarea class="utf-with-border" name="employerCompanyintro" id="employerCompanyintro" cols="20"
                      rows="3">{{(!empty($existingProfile))?(!empty(old('employerCompanyintro')))?old('employerCompanyintro'):$existingProfile->employerCompanyintro:old('employerCompanyintro')}}</textarea>
                    <!-- <span class="errMsg_employerCompanyintro errDiv"></span> -->
                  </div>
                  <div class="utf-submit-field">
                    <h5>Registered Address</h5>
                    <textarea name="employerCompanyaddr" id="employerCompanyaddr"
                      onkeypress="return blockspecialcharv2(event);" class="utf-with-border" cols="20"
                      rows="3">{{(!empty($existingProfile) && !empty($existingProfile->employerCompanyaddr))?(!empty(old('employerCompanyaddr')))?old('employerCompanyaddr'):$existingProfile->employerCompanyaddr:old('employerCompanyaddr')}}</textarea>
                    <!-- <span class="errMsg_employerCompanyaddr errDiv"></span> -->
                  </div>
                  <div class="utf-centered-button mb-4">                   
                    <a href="javascript:void(0);" onclick="return validatoremployerprofile();"
                      class="button utf-ripple-effect-dark margin-top-0">Update Profile</a>                  
                      
                    <input type="hidden" id="employerId" name="employerId" value= {{$employerId}} />
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
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true"
  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mb-0" id="modalLabel">
          Company Logo
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </h5>

      </div>
      <div class="modal-body">
        <div class="img-container">
          <div class="row">
            <div class="col">
              <img id="image" src="">
            </div>
            <div class="col">
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
@section('page-js')
<!--cropper  -->
<script src="{{PUBLIC_PATH}}js/cropper.js"></script>
<script>
  $(document).ready(function () {
    $('.errshow').hide();
       // $("#employer-profile").keyup(function(event){
       //          if(event.keyCode == 13){
       //             validatoremployerprofile();
       //          }
       //      });

    var userid = '<?php echo SESSION('employer_session_data.userId');?>';
    loadnotifiation(userid, 1);
var citys='<?php echo !empty($existingProfile->employerCity)?$existingProfile->employerCity:0 ?>';
var states='<?php echo !empty($existingProfile->employerLocation)?$existingProfile->employerLocation:0; ?>';
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
  // console.log(jobmultiplelocation);
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
               // console.log(arrcity);
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
        // var imgwidth = this.width;
        // var imgheight = this.height;
        // if(imgwidth < 250 || imgheight < 250){
        //     ret = 1;
        //     viewAlert('Sorry!! Upload image dimention of more than 250X250');
        //   }
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
        /*$.ajax({
            type: "POST",
            dataType: "json",
            url: "crop-image-upload.php",
            data: { '_token': $('meta[name="_token"]').attr('content'), 'image': base64data },
            success: function (data) {
                console.log(data);
                $modal.modal('hide');
                alert("Crop image successfully uploaded");
            }
        });*/
      }
    });
  });
</script>
<!-- cropper  end -->
<script>
    
    /* Hide Sidebar code */
    $( document ).ready(function() {
    
      let approvalUrl = '<?php echo $approvalUrl ?>';
      // console.log(approvalUrl);return false;
        if (approvalUrl == 1) {
          $(".utf-dashboard-sidebar-item").hide();
        }

    });


  $("#pwdSizeHead").on('change', function () {
    if ($(this).val() != 'None') {
      $("#pwdSize").show();
    } else {
      $("#pwdSize").val();
      $("#pwdSize").hide();
    }
  });
  $(".remove-skill").on('click', function () {
    $(this).parent('li').remove();
  });


  function ValidURL(str,controlId) {
    // var regex = /?\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
    $regex1      = /^[a-zA-Z0-9_\- \/+:,.!@&()\r\n]*$/;
    if(!regex .test(str)) {
      $('.errMsg_'+controlId).html('Please enter a valid Website URL.').show();
      $('#'+controlId).addClass('error-input');
      $('#'+controlId).focus();
      return false;
    } else {
      return true;
    }
  }


  function validatoremployerprofile() {
    $('.errDiv').hide();
    $('.error-input').removeClass('error-input');
      <?php if (!empty($existingProfile) && empty($existingProfile ->companyLogo)) { ?>
        if (!blankCheck('companyLogo', 'Please upload Company Logo '))
        return false;
      if (!IsCheckFile('companyLogo', 'Please upload a file of file type ', 'jpg,png,jpeg,JPG,JPEG,PNG,svg,gif,GIF,SVG'))
        return false;
      <?php } else if (empty($existingProfile)) { ?>
        if (!blankCheck('companyLogo', 'Please upload Company Logo '))
        return false;
      if (!IsCheckFile('companyLogo', 'Please upload a file of file type ', 'jpg,png,jpeg,JPG,JPEG,PNG,svg,gif,GIF,SVG'))
        return false;
      <?php }?>        


    //employee Validate Message:
    let validateMsg = [];

    if (!blankCheck('employerName', 'Name can not be left blank'))
      validateMsg.push("Name can not be left blank");
      // return false;
    /* if (!blankCheck('employerName', 'Name can not be left blank'))
      return false; */

    if (!blankCheck('employerDesignation', 'Designation can not be left blank'))
      validateMsg.push("Designation can not be left blank");
      // return false;

    if (!blankCheck('employerCompany', 'Company Name can not be left blank'))
      validateMsg.push("Company Name can not be left blank");
      // return false;

    if (!blankCheck('employerWebsite', 'Company Website can not be left blank'))
      validateMsg.push("Company Website can not be left blank");
      // return false;

    /* if (!ValidURL($('#employerWebsite').val(), 'employerWebsite'))
      return false; */

    if (!blankCheck('employerLocation', 'Location can not be left blank'))
      validateMsg.push("Location can not be left blank");
      // return false;

    if (!blankCheck('selcity', 'City can not be left blank'))
      validateMsg.push("City can not be left blank");
      // return false;

    if (!selectDropdown('employerSkills', 'Please select a skill'))
      validateMsg.push("Please select a skill.");
      // return false;

    if (!selectDropdown('employerIndustry', 'Please select an Industry.'))
      validateMsg.push("Please select an Industry");
      // return false;

    if (!blankCheck('employerCompanyaddr', 'Company Address can not be left blank'))
      validateMsg.push("Company Address can not be left blank");
      // return false;
      // console.log($validateMsg);

    if (!checkSpecialChar('employerCompanyaddr'))
      return false;

    var finalskills = '';
    if ($('.selected-skill li').length > 0) {
      $('.selected-skill li').each(function () {
        var selval = $(this).data('id');
        finalskills += selval + '/';
        // alert(finalskills)
        // finalskills.push(selval);
      });
      $('#emplskill').val(finalskills.slice(0, -1));
    }

    if (validateMsg.length > 0 ) {
      $('.errshow').show();
        $('.errorMsg ol').html('');
          $.each(validateMsg, function(ErrKey,ErrVal) {
              $('.errorMsg ol').append('<li>'+ ErrVal + '.' +'</li>');
              /* $('.errorMsg ul').append(ErrVal);
              console.log(ErrVal);
              validateMsg.push('<li>'+ ErrVal +'</li>'); */
          });
        return false;
      } else {
              $('#employer-profile').submit();
      }

    // $('#emplskill').val(finalskills.slice(0, -1));
    // console.log($('#emplskill').val());
    // return false;
    // $('#employer-profile').submit();

  }


  $('.input-skill').keypress(function (e) {
    var key = e.which;
    if (key == 13)  // the enter key code
    {
      var newText = $(".input-skill").val();
      pushnewSkill(newText);
    }
  });

  function removeProfileImage() {
    $('#confirmAlertModal').modal('show');
    $('#btnConfirmModalOK').on('click', function () {
      $.ajax({
        type: 'POST',
        url: SITE_URL + "/employer/employerprofile/removeProfileImage",
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


  // function employerApprovalStatus(status){
  //   var appStatus=status;
  //   var employerId=$('#employerId').val();
  
  //   $.ajax({
  //     type        : 'POST',
  //     url         : SITE_URL + "/employer/ajax/employerApprovalStatus",
  //     data        : {
  //       empStatus:appStatus,
  //       employerId:employerId
  //     //  _token: '{{csrf_token()}}'
  //     },
  //    // dataType    : "json",    
  //     processData: true, 
  //     cache:false, 
  //     headers: {
  //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     },
  //     beforeSend: function () { 
  //     },
  //   success: function (res) {
   
  //     if(res.status=='200'){
  //       viewAlert(res.msg);
  //       setTimeout(function(){ 
  //         location.reload();          
  //           }, 2000);       
  //     } else{
  //       viewAlert('Something went wrong!');         
  //     }
   
  //   }
  //   });
  //  }
</script>

@endsection
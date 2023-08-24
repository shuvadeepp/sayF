@extends('layouts.candidatelayout')
@section('page-content')
@section('page-css')
<!-- <link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/jquery-ui.css"> -->
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
<!-- candidateProfile -->
<div class="utf-dashboard-content-container-aera" data-simplebar>
  <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
    <div class="row">
      <div class="col-xl-12">
        <h3>Candidate Profile</h3>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="javascript:void(0);">Home</a></li>
            <li>Candidate Profile</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <!-- Page Content -->
  @include('components.admin-msg-tap')
  <div class="utf-dashboard-content-inner-aera">

   
    <div class="row">

      <div class="col-xl-12">
        <div class="dashboard-box">          
      
          <div class="content with-padding ">
            <form method="post" id="listform" enctype="multipart/form-data">
            <!-- candidate details -->
            <div class="candidate-details">
              <ul class="utf-popup-tabs-nav-item">
                <li id="liPersonal"><a href="#pinfo" id="lpinfo">Personal Information</a></li>
                <li id="liExperience"><a href="#wexp" id="lwexp">Work Experience</a></li>
                <li id="liEducation"><a href="#edu" id="ledu">Education</a></li>
                <li id="liSkill"><a href="#skills" id="lskills">Skills</a></li>                
                <li id="liDisability"><a href="#disability" id="ldisability">Disability Type</a></li>
              </ul>

              
              <div class="utf-popup-container-part-tabs"> 
                <!-- personal information -->                  
                @include('candidate.profile.personal-info')    
                <!-- personal information --> 
                <!-- work experience -->
                @include('candidate.profile.work-exp')    
                <!-- work experience -->
                <!-- education -->
                @include('candidate.profile.education')    
                <!-- education -->
                <!-- skills -->
                @include('candidate.profile.skill')    
                <!-- skills -->                
                <!-- Disability Type -->
                @include('candidate.profile.disable')
                <!-- Disability Type -->
              </div>
            </div>
            <!-- candidate details end -->   
          </form>
          </div>
        </div>
        {{-- <div class="utf-centered-button margin-bottom-30" id="finalSubmitBtn" style="display: none;">
          <a href="javascript:void(0);" class="button utf-ripple-effect-dark margin-top-0" type="submit" onclick="return validator(5);">Save</a>          --}}
        </div>
      </div>

    </div>
  </div>
  <!-- Page Content ends -->
</div>
</div>


<!-- cropper modal-->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mb-0" id="modalLabel">
          Candidate Profile Image
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </h5>

      </div>
      <div class="modal-body">
        <div class="img-container">
          <div class="row">
            <div class="col-md-8">
              <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
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
@section('page-js')
<!--cropper  -->
<script src="{{PUBLIC_PATH}}js/cropper.js"></script>
<!-- <script src="<?php echo PUBLIC_PATH; ?>js/jquery-ui.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/custom-datepicker.js"></script> -->
<script
> 
  $(document ).ready(function() {
     var userid='<?php echo SESSION('candidate_session_data.userId');?>';
    loadnotifiation(userid,2);
    var selState='<?php echo !empty( $personalInfo->state)? $personalInfo->state:0 ?>';
     var cityval='<?php echo !empty( $personalInfo->city)? $personalInfo->city:0 ?>';
    if(selState!=0 && cityval==0 ){
    loadcity(selState,0)
   }
   if(selState!=0 && cityval!=0){
    loadcity(selState,cityval)
   }
 
    });
$('#add-more-experience').on('click', function () {
 
  if(!validatorExperience()){
        return false;
    }

  var cl  = "<div class='row addExperience'><span class='remove removeExperience'></span></span><div class='col-xl-3 col-md-6'><div class='utf-submit-field'><h5>Designation</h5><input type='text' class='utf-with-border txtDesignation' placeholder='Designation' name='txtDesignation[]' id='txtDesignation' maxlength='50'><span class='errMsg_txtDesignation errDiv' id='errtxtDesignation'></span></div></div> <div class='col-xl-3 col-md-6'><div class='utf-submit-field'><h5>Company Name</h5><input type='text' class='utf-with-border txtCompany' placeholder='Company Name' name='txtCompany[]' id='txtCompany' maxlength='30'><span class='errMsg_txtCompany errDiv' id='errtxtCompany'></div></div><div class='col-xl-2 col-md-6'><div class='utf-submit-field'><h5>Start Date</h5><div class='utf-input-with-icon'><input type='text' class='utf-with-border datepicker txtStartDate' name='txtStartDate[]' id='txtStartDate'><i class='icon-feather-calendar'></i> <span class='errMsg_txtStartDate errDiv' id='errtxtStartDate'></div></div></div><div class='col-xl-2 col-md-6'><div class='utf-submit-field'><h5>End Date</h5><div class='utf-input-with-icon'><input type='text' class='utf-with-border datepicker txtEndDate' name='txtEndDate[]' id='txtEndDate'><i class='icon-feather-calendar'></i><span class='errMsg_txtEndDate errDiv' id='errtxtEndDate'> </div></div></div><div class='col-xl-2 col-md-6 d-flex mt-xl-5'> <input type='radio' class='chkCurrentJob mb-0 mt-1 mr-2' id='chkCurrentJob' name='chkCurrentJob' value='1' data-tippy-placement='top' title='Select this if you currently work here'><label for='chkCurrentJob' data-tippy-placement='top' title='Select this if you currently work here'>Current Job</label><input type='hidden' class='hidChkCuurrentjob' name='hidChkCuurrentjob[]' id='hidChkCuurrentjob' value='0'></div></div>";
    
    // <div class='checkbox mb-2'> <input type='checkbox' class='chkCurrentJob' name='chkCurrentJob[]'' id='chkCurrentJob' value='1'><label for='chkCurrentJob' class='lbchkCurrentJob'><span class='checkbox-icon'></span> Current Job</label><input type='hidden' class='hidChkCuurrentjob' name='hidChkCuurrentjob[]' id='hidChkCuurrentjob' value='0'>   </div>

  $('.appendExperience').append(cl);
  $(".addExperience").each(function(totRow) { 
    totRow++;
    var onclickFun    = "radioCurrentJob('"+totRow+"')";
    $( this ).find( '.txtDesignation' ).attr( 'id', 'txtDesignation' + totRow );
    $( this ).find( '.errMsg_txtDesignation' ).attr( 'class', 'errMsg_txtDesignation' + totRow +' errDiv');
    $( this ).find( '.txtCompany' ).attr( 'id', 'txtCompany' + totRow );
    $( this ).find( '.errMsg_txtCompany' ).attr( 'class', 'errMsg_txtCompany' + totRow +' errDiv');
    $( this ).find( '.txtStartDate' ).attr( 'id', 'txtStartDate' + totRow );
    $( this ).find( '.errMsg_txtStartDate' ).attr( 'class', 'errMsg_txtStartDate' + totRow +' errDiv');
    $( this ).find( '.txtEndDate' ).attr( 'id', 'txtEndDate' + totRow );
    $( this ).find( '.errMsg_txtEndDate' ).attr( 'class', 'errMsg_txtEndDate' + totRow +' errDiv');
    $( this ).find( '.chkCurrentJob' ).attr( 'id', 'chkCurrentJob' + totRow );
    $( this ).find( '.lbchkCurrentJob' ).attr( 'for', 'chkCurrentJob' + totRow );
    $(this).find('.chkCurrentJob').attr('onClick', onclickFun); 
    $( this ).find( '.hidChkCuurrentjob' ).attr( 'id', 'hidChkCuurrentjob' + totRow );
    $( this ).find( '.txtStartDate' ).datepicker({
      onSelect: function(dateText) {
            validExp(dateText,'txtStartDate',totRow)
        },
        changeMonth: true,
        changeYear: true,
        dateFormat: "d M y",
        maxDate: new Date()
    });
    $( this ).find( '.txtEndDate' ).datepicker({
      onSelect: function(dateText) {
            validExp(dateText,'txtEndDate',totRow)
        },
        changeMonth: true,
        changeYear: true,
        dateFormat: "d M y",
        maxDate: new Date()
    });
  });

  $('.removeExperience').on('click', function(){
   $(this).closest('.addExperience').remove();
   $(".addExperience").each(function(totRow) { 
    totRow++;
    var onclickFun    = "chkCurrentJob('"+totRow+"')";
    $( this ).find( '.txtDesignation' ).attr( 'id', 'txtDesignation' + totRow );
    $( this ).find( '#errtxtDesignation' ).attr( 'class', 'errMsg_txtDesignation' + totRow +' errDiv');
    $( this ).find( '.txtCompany' ).attr( 'id', 'txtCompany' + totRow );
    $( this ).find( '#errtxtCompany' ).attr( 'class', 'errMsg_txtCompany' + totRow +' errDiv');
    $( this ).find( '.txtStartDate' ).attr( 'id', 'txtStartDate' + totRow );
    $( this ).find( '#errtxtStartDate' ).attr( 'class', 'errMsg_txtStartDate' + totRow +' errDiv');
    $( this ).find( '.txtEndDate' ).attr( 'id', 'txtEndDate' + totRow );
    $( this ).find( '#errtxtEndDate' ).attr( 'class', 'errMsg_txtEndDate' + totRow +' errDiv');
    $( this ).find( '.chkCurrentJob' ).attr( 'id', 'chkCurrentJob' + totRow );
    $( this ).find( '.lbchkCurrentJob' ).attr( 'for', 'chkCurrentJob' + totRow );
    $(this).find('.chkCurrentJob').attr('onClick', onclickFun); 
    $( this ).find( '.hidChkCuurrentjob' ).attr( 'id', 'hidChkCuurrentjob' + totRow );
    $( this ).find( '.txtStartDate' ).datepicker({
      onSelect: function(dateText) {
            validExp(dateText,'txtStartDate',totRow)
        },
        changeMonth: true,
        changeYear: true,
        dateFormat: "d M y",
        maxDate: new Date()
    });
    $( this ).find( '.txtEndDate' ).datepicker({
      onSelect: function(dateText) {
            validExp(dateText,'txtEndDate',totRow)
        },
        changeMonth: true,
        changeYear: true,
        dateFormat: "d M y",
        maxDate: new Date()
    });
  });
  });
});




function validatorExperience(){
  $('.errDiv').hide();
  $('.error-input').removeClass('error-input');
  var totRowNumber = $('.txtDesignation').length;
    var flag = 0;
    for (var i = 1; i <= totRowNumber; i++) {
      if (!blankCheck('txtDesignation'+i, 'Designation can not be left blank')){
        flag = 1;
        return false;
      }
      if (!blankCheck('txtCompany'+i, 'Company can not be left blank')){
        flag = 1;
        return false;
      }
      if (!blankCheck('txtStartDate'+i, 'Start date can not be left blank')){
        flag = 1;
        return false;
      }
      if($("#hidChkCuurrentjob"+i).val()==0){
        if (!blankCheck('txtEndDate'+i, 'End date can not be left blank')){
          flag = 1;
          return false;
        }
      }
            
      StartDate=$('#txtStartDate'+i).val();
      EndDate=$('#txtEndDate'+i).val();
      var eDate = new Date(EndDate);
      var sDate = new Date(StartDate);
      if(sDate > eDate){
        $('.errMsg_txtEndDate'+i).html('End Date should be greater than start Date').show();
        $('#txtEndDate'+i).addClass('error-input');
        $('#txtEndDate'+i).focus();
        return false;
      }
    }
        if (flag == 0) {
            return true;
        }
        if (flag == 1) {
            return false;
        }
  
}

$('#add-more-education').on('click', function () {
  
  if(!validatorEducation()){
        return false;
    }

  var cl  = `<div class="row addEducation">
                        <span class="remove removeEducation"></span>
                        <div class="col-xl-2 col-lg-4 col-md-6">
                          <div class="utf-submit-field">
                            <h5>Education</h5>
                            <select class="utf-with-border selEducation" data-size="7" title="Select Board" name="selEducation[]" id="selEducation">
                              <option value="">Select Education</option>
                              <?php 
                                foreach($education as $educations){ ?>
                                  <option data-edutype="{{$educations->educationType}}" value="{{$educations->educationId}}">{{$educations->educationName}}</option>
                              <?php
                                }
                              ?>
                            </select>
                            <span class="errMsg_selEducation errDiv" id="errselEducation"></span>
                          </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 clsDivBoard" id="clsDivBoard">
                          <div class="utf-submit-field">
                            <h5>Board</h5>
                            <select class="utf-with-border selBoard" data-size="7" title="Select Board" name="selBoard[]" id="selBoard">
                              <option value="">Select Board</option>
                              <?php foreach($board as $boards){?>
                                <option value="{{$boards->boardId}}">{{$boards->boardName}}</option>
                              <?php } ?>
                            </select>
                            <span class="errMsg_selBoard errDiv" id="errselBoard"></span>
                          </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 clsDivCourse" id="clsDivCourse" style="display: none;">
                          <div class="utf-submit-field">
                            <h5>Course</h5>
                            <input type="text" class="utf-with-border txtCourse" name="txtCourse[]" id="txtCourse" maxlength="50">
                            <span class="errMsg_txtCourse errDiv" id="errtxtCourse"></span>
                          </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 clsDivMedium" id="clsDivMedium">
                          <div class="utf-submit-field">
                            <h5>Medium</h5>
                            <select class="utf-with-border selMedium" data-size="7" title="Select Medium" name="selMedium[]" id="selMedium">
                              <option value="">Select Medium</option>
                              <?php $mediumArr = json_decode(MEDIUM_TYPE,true);
                                foreach ($mediumArr as $mediumArrKey => $mediumArrVal) { ?>
                                  <option value="{{$mediumArrKey}}">{{$mediumArrVal}}</option>
                                <?php
                                }
                                ?>
                            </select>
                            <span class="errMsg_selMedium errDiv" id="errselMedium"></span>
                          </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 clsDivUniversity" style="display: none;" id="clsDivUniversity">
                          <div class="utf-submit-field">
                            <h5>University/Institute</h5>
                            <input type="text" class="utf-with-border txtUniversity" placeholder="University/Institute" name="txtUniversity[]" id="txtUniversity" maxlength="100">
                            <span class="errMsg_txtUniversity errDiv" id="errtxtUniversity"></span>
                          </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 pr-0">
                          <div class="utf-submit-field">
                            <h5>Score</h5>
                            <div class="utf-submit-field-group">
                              <div class="form-group-field-item">
                                <select class="selScoretype no-shadow mb-0" title="Score Type" name="selScoretype[]" id="selScoretype">
                                  <option value="">Score Type</option>
                                  <?php $scoreArr = json_decode(SCORE_TYPE,true);
                                    foreach ($scoreArr as $scoreArrKey => $scoreArrVal) { ?>
                                      <option value="{{$scoreArrKey}}">{{$scoreArrVal}}</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <span class="errMsg_selScoretype errDiv" id="errselScoretype"></span>
                              </div>
                              <div class="form-group-field-item b-r-0">
                                <input type="text" class="txtScore" placeholder="Score" name="txtScore[]" id="txtScore" maxlength="6">
                                <span class="errMsg_txtScore errDiv" id="errtxtScore"></span>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-2 col-lg-4 col-md-6">
                          <div class="utf-submit-field">
                            <h5>Year of Passing</h5>
                            <input type="text" class="utf-with-border txtPassout" placeholder="Passing Out" name="txtPassout[]" id="txtPassout" maxlength="4">
                            <span class="errMsg_txtPassout errDiv" id="errtxtPassout"></span>
                          </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6">
                          <div class="utf-submit-field">
                            <h5>Upload Certificate</h5>
                            <input type="file" id="upload-cert" class="utf-with-border txtCertificate" placeholder="Upload Photo" name="txtCertificate" id="txtCertificate">
                            <label class="lbtxtCertificate" for="txtCertificate">Upload Certificate</label>
                            <input type="hidden" class="hidEduCert" name="hidEduCert[]" id="hidEduCert" >
                            <input type="hidden" class="hiddbEduCert" name="hiddbEduCert[]" id="hiddbEduCert" >
                            <span class="errMsg_txtCertificate errDiv" id="errtxtCertificate"></span>
                            <div>
                              <span class="docLink">
                                <a class="btn btn-primary downLink" target="_blank" style="display: none;"><span class="icon-feather-eye"></span> </a>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>`;
      

  $('.appendEducation').append(cl);
  $(".addEducation").each(function(totRow) { 
    totRow++;
    var onchangeFun    = "selEducationType('"+totRow+"')";
    var onchangeFunFile    = "uploadcommonAjaxfile(this.id,'hidEduCert"+totRow+"')";
    $( this ).find( '.selEducation' ).attr( 'id', 'selEducation' + totRow );
    $( this ).find( '.errMsg_selEducation' ).attr( 'class', 'errMsg_selEducation' + totRow +' errDiv');
    $( this ).find( '.selBoard' ).attr( 'id', 'selBoard' + totRow );
    $( this ).find( '.clsDivBoard' ).attr( 'id', 'clsDivBoard' + totRow );
    $( this ).find( '.clsDivCourse' ).attr( 'id', 'clsDivCourse' + totRow );
    $( this ).find( '.clsDivMedium' ).attr( 'id', 'clsDivMedium' + totRow );
    $( this ).find( '.clsDivUniversity' ).attr( 'id', 'clsDivUniversity' + totRow );
    $( this ).find( '.errMsg_selBoard' ).attr( 'class', 'errMsg_selBoard' + totRow +' errDiv');
    $( this ).find( '.txtCourse' ).attr( 'id', 'txtCourse' + totRow );
    $( this ).find( '.errMsg_txtCourse' ).attr( 'class', 'errMsg_txtCourse' + totRow +' errDiv');
    $( this ).find( '.selMedium' ).attr( 'id', 'selMedium' + totRow );
    $( this ).find( '.errMsg_selMedium' ).attr( 'class', 'errMsg_selMedium' + totRow +' errDiv');
    $( this ).find( '.txtUniversity' ).attr( 'id', 'txtUniversity' + totRow );
    $( this ).find( '.errMsg_txtUniversity' ).attr( 'class', 'errMsg_txtUniversity' + totRow +' errDiv');
    $( this ).find( '.selScoretype' ).attr( 'id', 'selScoretype' + totRow );
    $( this ).find( '.errMsg_selScoretype' ).attr( 'class', 'errMsg_selScoretype' + totRow +' errDiv');
    $( this ).find( '.txtScore' ).attr( 'id', 'txtScore' + totRow );
    $( this ).find( '.errMsg_txtScore' ).attr( 'class', 'errMsg_txtScore' + totRow +' errDiv');
    $( this ).find( '.txtPassout' ).attr( 'id', 'txtPassout' + totRow );
    $( this ).find( '.errMsg_txtPassout' ).attr( 'class', 'errMsg_txtPassout' + totRow +' errDiv');  
    $( this ).find( '.txtCertificate' ).attr( 'id', 'txtCertificate' + totRow);  
    $( this ).find( '.txtCertificate' ).attr( 'name', 'txtCertificate' + totRow);  
    $( this ).find( '.hidEduCert' ).attr( 'id', 'hidEduCert' + totRow);  
    $( this ).find( '.hiddbEduCert' ).attr( 'id', 'hiddbEduCert' + totRow);  
    $( this ).find( '.errMsg_txtCertificate' ).attr( 'class', 'errMsg_txtCertificate' + totRow +' errDiv'); 
    $( this ).find( '.lbtxtCertificate' ).attr( 'for', 'txtCertificate' + totRow );
    $(this).find('.selEducation').attr('onchange', onchangeFun);  
    $(this).find('.txtCertificate').attr('onchange', onchangeFunFile);
  });

  $('.removeEducation').on('click', function(){
   $(this).closest('.addEducation').remove();
   $(".addEducation").each(function(totRow) { 
    totRow++;
    var onchangeFun    = "selEducationType('"+totRow+"')";
    var onchangeFunFile    = "uploadcommonAjaxfile(this.id,'hidEduCert"+totRow+"')";
    $( this ).find( '.selEducation' ).attr( 'id', 'selEducation' + totRow );
    $( this ).find( '#errselEducation' ).attr( 'class', 'errMsg_selEducation' + totRow +' errDiv');
    $( this ).find( '.selBoard' ).attr( 'id', 'selBoard' + totRow );
    $( this ).find( '.clsDivBoard' ).attr( 'id', 'clsDivBoard' + totRow );
    $( this ).find( '.clsDivCourse' ).attr( 'id', 'clsDivCourse' + totRow );
    $( this ).find( '.clsDivMedium' ).attr( 'id', 'clsDivMedium' + totRow );
    $( this ).find( '.clsDivUniversity' ).attr( 'id', 'clsDivUniversity' + totRow );
    $( this ).find( '#errselBoard' ).attr( 'class', 'errMsg_selBoard' + totRow +' errDiv');
    $( this ).find( '.txtCourse' ).attr( 'id', 'txtCourse' + totRow );
    $( this ).find( '#errtxtCourse' ).attr( 'class', 'errMsg_txtCourse' + totRow +' errDiv');
    $( this ).find( '.selMedium' ).attr( 'id', 'selMedium' + totRow );
    $( this ).find( '#errselMedium' ).attr( 'class', 'errMsg_selMedium' + totRow +' errDiv');
    $( this ).find( '.txtUniversity' ).attr( 'id', 'txtUniversity' + totRow );
    $( this ).find( '#errtxtUniversity' ).attr( 'class', 'errMsg_txtUniversity' + totRow +' errDiv');
    $( this ).find( '.selScoretype' ).attr( 'id', 'selScoretype' + totRow );
    $( this ).find( '#errselScoretype' ).attr( 'class', 'errMsg_selScoretype' + totRow +' errDiv');
    $( this ).find( '.txtScore' ).attr( 'id', 'txtScore' + totRow );
    $( this ).find( '#errtxtScore' ).attr( 'class', 'errMsg_txtScore' + totRow +' errDiv');
    $( this ).find( '.txtPassout' ).attr( 'id', 'txtPassout' + totRow );
    $( this ).find( '#errtxtPassout' ).attr( 'class', 'errMsg_txtPassout' + totRow +' errDiv');  
    $( this ).find( '.txtCertificate' ).attr( 'id', 'txtCertificate' + totRow);  
    $( this ).find( '.txtCertificate' ).attr( 'name', 'txtCertificate' + totRow);  
    $( this ).find( '.hidEduCert' ).attr( 'id', 'hidEduCert' + totRow);  
    $( this ).find( '.hiddbEduCert' ).attr( 'id', 'hiddbEduCert' + totRow);  
    $( this ).find( '#errtxtCertificate' ).attr( 'class', 'errMsg_txtCertificate' + totRow +' errDiv'); 
    $( this ).find( '.lbtxtCertificate' ).attr( 'for', 'txtCertificate' + totRow );
    $(this).find('.selEducation').attr('onchange', onchangeFun);  
    $(this).find('.txtCertificate').attr('onchange', onchangeFunFile);  
  });
  });
});

function validatorEducation(){
  $('.errDiv').hide();
  $('.error-input').removeClass('error-input');
  var totRowEdu = $('.txtPassout').length;
    var flag = 0;
    for (var j = 1; j <= totRowEdu; j++) {
      if (!selectDropdown('selEducation'+j, 'Select education')){ 
        flag = 1;
        return false;
      }
      var eduType=$('#selEducation'+j).find(':selected').data('edutype');
      if(eduType==1){
        if (!selectDropdown('selBoard'+j, 'Select board')){
          flag = 1;
          return false;
        }
        if (!selectDropdown('selMedium'+j, 'Select medium')){
          flag = 1;
          return false;
        }
      }else{
        if (!blankCheck('txtCourse'+j, 'Course can not be left blank')){
          flag = 1;
          return false;
        }
        if (!blankCheck('txtUniversity'+j, 'University can not be left blank')){
          flag = 1;
          return false;
        }
      }

      if (!selectDropdown('selScoretype'+j, 'Select score type')){
          flag = 1;
          return false;
      }
      if (!blankCheck('txtScore'+j, 'Score can not be left blank')){
        flag = 1;
        return false;
      }
      if (!blankCheck('txtPassout'+j, 'Passout year can not be left blank')){
        flag = 1;
        return false;
      }
      
    }
        if (flag == 0) {
            return true;
        }
        if (flag == 1) {
            return false;
        }
  
}

$('#add-more-skills').on('click', function () {
  
  if(!validatorSkill()){
        return false;
    }

  var cl  = `<div class="row addSkill">
                      <span class="remove removeSkill"></span>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                          <div class="utf-submit-field">
                            <h5>Skill Name/Certifications</h5>                            
                            <input type="text" name="" data-slno="" id="input-skill" placeholder="Type your skill . . ." class="utf-with-border input-skill">
                            <input type="hidden" class="txtSkill" name="txtSkill[]" id="txtSkill1" value="">
                            <ul class="autofill-dropdown" id="autofill-dropdown" style="display: none;">
                            </ul>
                            <ul class="selected-skill" id="selected-skill">
                            </ul>
                            <span class="errMsg_txtSkill errDiv" id="errtxtSkill"></span>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                          <div class="utf-submit-field">
                            <h5>Years of Experience</h5>
                            <input type="text" maxlength="2" class="utf-with-border txtSkillExp" placeholder="Years of Experience" name="txtSkillExp[]" id="txtSkillExp">
                            <span class="errMsg_txtSkillExp errDiv" id="errtxtSkillExp"></span>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                          <div class="utf-submit-field">
                            <h5>Upload Certificate</h5>
                            <input type="file" class="utf-with-border txtSkillCertificate" placeholder="Upload Photo" name="txtSkillCertificate1" id="txtSkillCertificate">
                            <label class="lbtxtSkillCertificate" for="txtSkillCertificate">Upload Certificate</label>
                            <input type="hidden" class="hidskillCert" name="hidskillCert[]" id="hidskillCert">
                            <input type="hidden" class="hiddbskillCert" name="hiddbskillCert[]" id="hiddbskillCert">
                            <span class="errMsg_txtSkillCertificate errDiv" id="errtxtSkillCertificate"></span>
                            <div>
                              <span class="docLink">
                                <a class="btn btn-primary downLink" target="_blank" style="display: none;"><span class="icon-feather-eye"></span> </a>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>`;
      

  $('.appendSkill').append(cl);
  $(".addSkill").each(function(totRow) { 
    totRow++;
    var onchangeFun    = "uploadcommonAjaxfile(this.id,'hidskillCert"+totRow+"')";
    var onkeyup    = "return loadskillsCand(this.value,"+totRow+");";
    $( this ).find( '.txtSkill' ).attr( 'id', 'txtSkill' + totRow );
    $( this ).find( '.input-skill' ).attr( 'id', 'input-skill' + totRow );
    $( this ).find( '.input-skill' ).attr( 'data-slno', totRow );
    $( this ).find( '.selected-skill' ).attr( 'id', 'selected-skill' + totRow );
    $( this ).find( '.autofill-dropdown' ).attr( 'id', 'autofill-dropdown' + totRow );
    $( this ).find( '.errMsg_txtSkill' ).attr( 'class', 'errMsg_txtSkill' + totRow +' errDiv');
    $( this ).find( '.txtSkillExp' ).attr( 'id', 'txtSkillExp' + totRow );
    $( this ).find( '.errMsg_txtSkillExp' ).attr( 'class', 'errMsg_txtSkillExp' + totRow +' errDiv');
    $( this ).find( '.txtSkillCertificate' ).attr( 'id', 'txtSkillCertificate' + totRow );
    $( this ).find( '.txtSkillCertificate' ).attr( 'name', 'txtSkillCertificate' + totRow );
    $( this ).find( '.hidskillCert' ).attr( 'id', 'hidskillCert' + totRow );
    $( this ).find( '.hiddbskillCert' ).attr( 'id', 'hiddbskillCert' + totRow );
    $( this ).find( '.errMsg_txtSkillCertificate' ).attr( 'class', 'errMsg_txtSkillCertificate' + totRow +' errDiv'); 
    $( this ).find( '.lbtxtSkillCertificate' ).attr( 'for', 'txtSkillCertificate' + totRow );
    $(this).find('.txtSkillCertificate').attr('onchange', onchangeFun); 
    $(this).find('.input-skill').attr('onkeyup', onkeyup); 
  });

  $('.removeSkill').on('click', function(){
   $(this).closest('.addSkill').remove();
   $(".addSkill").each(function(totRow) { 
    totRow++;
    var onchangeFun    = "uploadcommonAjaxfile(this.id,'hidskillCert"+totRow+"')";
    var onkeyup    = "return loadskillsCand(this.value,"+totRow+");";
    $( this ).find( '.txtSkill' ).attr( 'id', 'txtSkill' + totRow );
    $( this ).find( '.input-skill' ).attr( 'id', 'input-skill' + totRow );
    $( this ).find( '.input-skill' ).attr( 'data-slno', totRow );
    $( this ).find( '.selected-skill' ).attr( 'id', 'selected-skill' + totRow );
    $( this ).find( '.autofill-dropdown' ).attr( 'id', 'autofill-dropdown' + totRow );
    $( this ).find( '.errMsg_txtSkill' ).attr( 'class', 'errMsg_txtSkill' + totRow +' errDiv');
    $( this ).find( '.txtSkillExp' ).attr( 'id', 'txtSkillExp' + totRow );
    $( this ).find( '.errMsg_txtSkillExp' ).attr( 'class', 'errMsg_txtSkillExp' + totRow +' errDiv');
    $( this ).find( '.txtSkillCertificate' ).attr( 'id', 'txtSkillCertificate' + totRow );
    $( this ).find( '.txtSkillCertificate' ).attr( 'name', 'txtSkillCertificate' + totRow );
    $( this ).find( '.hidskillCert' ).attr( 'id', 'hidskillCert' + totRow );
    $( this ).find( '.hiddbskillCert' ).attr( 'id', 'hiddbskillCert' + totRow );
    $( this ).find( '.errMsg_txtSkillCertificate' ).attr( 'class', 'errMsg_txtSkillCertificate' + totRow +' errDiv'); 
    $( this ).find( '.lbtxtSkillCertificate' ).attr( 'for', 'txtSkillCertificate' + totRow );
    $(this).find('.txtSkillCertificate').attr('onchange', onchangeFun); 
    $(this).find('.input-skill').attr('onkeyup', onkeyup);  
  });
  });

  $('.input-skill').keypress(function (e) {
     var key = e.which;
     if(key == 13)  // the enter key code
      {
        var newText = $(this).val();
        var rowNo=$(this).attr("data-slno");
        pushnewSkillCand(newText,rowNo);        
      }
    });
});

function validatorSkill(){
  $('.errDiv').hide();
  $('.error-input').removeClass('error-input');
  var totRowSkill = $('.txtSkill').length;
    var flag = 0;
    for (var i = 1; i <= totRowSkill; i++) {
    
      if (!blankCheck('txtSkill'+i, 'Select skill')){
        flag = 1;
        return false;
      }
      if (!blankCheck('txtSkillExp'+i, 'Year of experience can not be left blank')){
        flag = 1;
        return false;
      }
      // if (!blankCheckHFile('hidskillCert'+i,'hiddbskillCert'+i,'txtSkillCertificate'+i, 'Certificate can not be left blank')){
      //   flag = 1;
      //   return false;
      // }
      
      
    }
        if (flag == 0) {
            return true;
        }
        if (flag == 1) {
            return false;
        }
  
}
        
function validator(typeId)
 {
    $('.errDiv').hide();
    $('.error-input').removeClass('error-input');
    if(typeId==2){
      if (!blankCheck('txtFName', 'First name can not be left blank'))
          return false;
      if (!blankCheck('txtLName', 'Last name can not be left blank'))
          return false;
      if (!blankCheck('txtAddress', 'Address name can not be left blank'))
          return false;
      if (!blankCheck('txtPin', 'Pin can not be left blank'))
          return false;
      if (!blankCheck('txtCity', 'City can not be left blank'))
          return false;          
      if (!selectDropdown('selState', 'Select state'))
          return false; 
      if (!blankCheck('txtMobile', 'Primary number can not be left blank'))
          return false;      
      if ($('#txtSecMobile').val() != '' && ($('#txtMobile').val() == $('#txtSecMobile').val())){
        $('.errMsg_txtSecMobile').html('Secondary number should not equal to primary number').show();
        $('#txtSecMobile').addClass('error-input');
        $('#txtSecMobile').focus();
        return false;
      }
      if (!blankCheckHFile('hdnbase64file','hiddbprofileImg','fileProfileImg', 'Profile image can not be left blank'))
          return false;
      if (!selectDropdown('selGender', 'Select gender'))
          return false;
      if (!blankCheck('txtDOBDate', 'Date of birth can not be left blank'))
          return false;  


      // var DOB=new Date($("#txtDOBDate").val());
      // var DOByear=DOB.getFullYear(DOB);
      // var DOBmonth=DOB.getMonth(DOB);
      // var DOBdate=DOB.getDate(DOB);
      
      // if(new Date(DOByear+16, DOBmonth-1, DOBdate) <= new Date())
      // {

      // }else{
      //   $('.errMsg_txtDOBDate').html('Age must be 16 +').show();
      //   $('#txtDOBDate').addClass('error-input');
      //   $('#txtDOBDate').focus();
      //   return false;
      // }

      var txtFName=$('#txtFName').val();
      var txtMName=$('#txtMName').val();
      var txtLName=$('#txtLName').val();
      var txtAddress=$('#txtAddress').val();
      var txtPin=$('#txtPin').val();
      var txtCity=$('#selcity').val();
      var selState=$('#selState').val();
      var txtMobile=$('#txtMobile').val();
      var txtSecMobile=$('#txtSecMobile').val();
      var hidprofileImg=$('#hidprofileImg').val();
      var hiddbprofileImg=$('#hiddbprofileImg').val();
      var selGender=$('#selGender').val();
      var txtDOBDate=$('#txtDOBDate').val();
      var hdnbase64file=$('#hdnbase64file').val();
      var hiddbprofileCV=$('#hiddbprofileCV').val();
        var hidprofileCV=$('#hidprofileCV').val();

      var sendData = {'txtFName': txtFName, 'txtMName': txtMName, 'txtLName': txtLName, 'txtAddress': txtAddress, 'txtPin': txtPin, 'txtCity':txtCity, 'selState':selState, 'txtMobile': txtMobile, 'txtSecMobile': txtSecMobile, 'hidprofileImg':hidprofileImg, 'hiddbprofileImg':hiddbprofileImg, 'selGender':selGender, 'txtDOBDate':txtDOBDate, 'hdnbase64file':hdnbase64file, 'hiddbprofileCV':hiddbprofileCV,'hidprofileCV':hidprofileCV};
      
        $.ajax({
        type: "POST",
        url: SITE_URL + "/candidate/ajax/candidatePersonalinfo",
        data: sendData,
        cache:false,
        dataType : "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.errFlag==0)
                {
                  $(".ajax-err").hide();
                  $("#liDisability").removeClass("active");
                  $("#liPersonal").removeClass("active");
                  $("#liExperience").addClass("active");
                  $("#liEducation").removeClass("active");
                  $("#liSkill").removeClass("active");
                  $("#finalSubmitBtn").hide();

                  $('#pinfo').css('display','none');
                  $('#wexp').css('display','block');
                  $('#edu').css('display','none');
                  $('#skills').css('display','none');
                  $('#disability').css('display','none');
                  
                }
                else if(data.errFlag == 1){
                  $(".ajax-err").show();
                  $(".ajax-err").html('<li>Error occured!!</li><a class="close"></a>');
                  return false;
                }
        },
        error: function(resp){
          if(resp.status == 406){
            var errorArray = [];
              var error = JSON.parse(resp.responseText);             
              $.each(error.errors,function(i,j) {
                  errorArray.push('<li>'+j+'</li><a class="close"></a>');
              });
              $(".ajax-err").show();
              $(".ajax-err").html(errorArray);
              return false;

          }
        }
        });
    }
    else if(typeId==3){  
      if (!blankChkRad('candType', 'Please select experience type'))
          return false;
      var radioValue = $("input[name='candType']:checked").val();
      if(radioValue==1){
        $.ajax({
            type: "POST",
            url: SITE_URL + "/candidate/ajax/candidateFresher",
            data: {'candType': 1},
            dataType : "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
              if (data.errFlag==0)
                  {
                    $(".ajax-err").hide();
                    $("#liDisability").removeClass("active");
                    $("#liPersonal").removeClass("active");
                    $("#liExperience").removeClass("active");
                    $("#liEducation").addClass("active");
                    $("#liSkill").removeClass("active");
                    $("#finalSubmitBtn").hide();

                    $('#pinfo').css('display','none');
                    $('#wexp').css('display','none');
                    $('#edu').css('display','block');
                    $('#skills').css('display','none');
                    $('#disability').css('display','none');
                  }
                  else if(data.errFlag == 1){
                    $(".ajax-err").show();
                    $(".ajax-err").html('<li>Error occured!!</li><a class="close"></a>');
                    return false;
                  }
          },
          error: function(resp){
            
          }
          });
      }else{
          if(!validatorExperience()){
          return false;
        } 
        $.ajax({
            type: "POST",
            url: SITE_URL + "/candidate/ajax/candidateExperience",
            data: $('#listform').serialize(),
            dataType : "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
              if (data.errFlag==0)
                  {
                    $(".ajax-err").hide();
                    $("#liDisability").removeClass("active");
                    $("#liPersonal").removeClass("active");
                    $("#liExperience").removeClass("active");
                    $("#liEducation").addClass("active");
                    $("#liSkill").removeClass("active");
                    $("#finalSubmitBtn").hide();

                    $('#pinfo').css('display','none');
                    $('#wexp').css('display','none');
                    $('#edu').css('display','block');
                    $('#skills').css('display','none');
                    $('#disability').css('display','none');
                  }
                  else if(data.errFlag == 1){
                    $(".ajax-err").show();
                    $(".ajax-err").html('<li>Error occured!!</li><a class="close"></a>');
                    return false;
                  }
          },
          error: function(resp){
            if(resp.status == 406){
                var errorArray = [];
                var error = JSON.parse(resp.responseText);
                $.each(error.errors,function(i,j) {
                    errorArray.push('<li>'+j+'</li><a class="close"></a>');
                });
                $(".ajax-err").show();
                $(".ajax-err").html(errorArray);
                return false;
            }
          }
          });
      }
      
    }

    else if(typeId==4){
      if(!validatorEducation()){
        return false;
      }   
      $.ajax({
          type: "POST",
          url: SITE_URL + "/candidate/ajax/candidateEducation",
          data: $('#listform').serialize(),
          dataType : "json",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (data) {
            if (data.errFlag==0)
                {
                  $(".ajax-err").hide();
                  $("#liDisability").removeClass("active");
                  $("#liPersonal").removeClass("active");
                  $("#liExperience").removeClass("active");
                  $("#liEducation").removeClass("active");
                  $("#liSkill").addClass("active");
                  $("#finalSubmitBtn").hide();

                  $('#pinfo').css('display','none');
                  $('#wexp').css('display','none');
                  $('#edu').css('display','none');
                  $('#skills').css('display','block');
                  $('#disability').css('display','none');
                }
                else if(data.errFlag == 1){
                    $(".ajax-err").show();
                    $(".ajax-err").html('<li>Error occured!!</li><a class="close"></a>');
                    return false;
                }
        },
        error: function(resp){
          if(resp.status == 406){
              var errorArray = [];
              var error = JSON.parse(resp.responseText);
              $.each(error.errors,function(i,j) {
                  errorArray.push('<li>'+j+'</li><a class="close"></a>');
              });
              $(".ajax-err").show();
              $(".ajax-err").html(errorArray);
              return false;
          }
        }
        });
    }

    else if(typeId==5){
      if(!validatorSkill()){
          return false;
      }
      $.ajax({
          type: "POST",
          url: SITE_URL + "/candidate/ajax/candidateSkill",
          data: $('#listform').serialize(),
          dataType : "json",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (data) {
              if (data.errFlag==0){
                $(".ajax-err").hide();
                $("#liPersonal").removeClass("active");
                $("#liExperience").removeClass("active");
                $("#liEducation").removeClass("active");
                $("#liSkill").removeClass("active");
                $("#liDisability").addClass("active");
                $("#finalSubmitBtn").show();

                $('#pinfo').css('display','none');
                $('#wexp').css('display','none');
                $('#edu').css('display','none');
                $('#skills').css('display','none');
                $('#disability').css('display','block');
                
              }
              // if (data.errFlag==0)
              //   {
              //     $(".ajax-err").hide();
              //     window.location.href=SITE_URL+"/candidate/success";
              //   }
              //   else if(data.errFlag == 1){
              //     $(".ajax-err").show();
              //     $(".ajax-err").html('<li>Error occured!!</li><a class="close"></a>');
              //     return false;
              //   }
        },
        error: function(resp){
          if(resp.status == 406){
            var errorArray = [];
              var error = JSON.parse(resp.responseText);             
              $.each(error.errors,function(i,j) {
                  errorArray.push('<li>'+j+'</li><a class="close"></a>');
              });
              $(".ajax-err").show();
              $(".ajax-err").html(errorArray);
              return false;

          } 
        }
        });
    }
    else if(typeId==1){
      // if (!blankChkRad('chkdisable[]', 'Please select disable type'))
      //     return false;
      if (!selectDropdown('selDisability', 'Select disable type'))
          return false;
      if (!selectDropdown('selPersentage', 'Select disable percentage'))
          return false;
      if (!blankCheck('txtDisableCert', 'Disability certificate can not be left blank'))
          return false;          
      
      $.ajax({
          type: "POST",
          url: SITE_URL + "/candidate/ajax/disabilityinfo",
          data: $('#listform').serialize(),
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (data) {
            // if(data.status == 200){
            //   $(".ajax-err").hide();
            //   $('#ldisability').parent('li').removeClass('active');  
            //   $('#lpinfo').parent('li').addClass('active');  
            //   $('#disability').css('display','none');
            //   $('#pinfo').css('display','block');
            //   //console.log(data.filelistArr);
            //   var fileArr = data.filelistArr;
            //   var filelen = $.map(fileArr, function(n, i) { return i; }).length;
            //   var bindFile = '';
            //   if(filelen > 0){
            //     $('.disable-doc-ul').html('');
            //     $(fileArr).each(function(f){
            //         bindFile +=`<li class="docli">
            //                       <input type="hidden" name="upldFiles[]" class="upldFiles" value="`+fileArr[f].docFile+`" id="upldFiles`+(f+1)+`"/>
            //                       <span class="icon-material-outline-attach-file"></span>
            //                       <a target="_blank" href="{{STORAGE_PATH.'disabilitydoc/'}}`+fileArr[f].docFile+`">View Document</a>
            //                       <a href="javascript:void(0);" onclick="return removeexistingfile('`+fileArr[f].docFile+`',`+fileArr[f].docId+`,`+(f+1)+`,$(this))" class="remove-file"><span class="icon-line-awesome-close"></span></a>
            //                     </li>`;
            //     });
            //     $('.disable-doc-ul').html(bindFile);
            //   }
            // }

            if(data.status == 200){
              $(".ajax-err").hide();                
              window.location.href=SITE_URL+"/candidate/success";
            }
            else{
              $(".ajax-err").show();
              $(".ajax-err").html('<li>Error occured!!</li><a class="close"></a>');
              return false;
            }
          },
          error: function(resp){
            if(resp.status == 406){
              var errorArray = [];
                var error = JSON.parse(resp.responseText);             
                $.each(error.errors,function(i,j) {
                    errorArray.push('<li>'+j+'</li><a class="close"></a>');
                });
                $(".ajax-err").show();
                $(".ajax-err").html(errorArray);
                return false;

            }
          }
      }); 
     
    }
      
    }  
    
function selEducationType(divId){
  var eduType=$('#selEducation'+divId).find(':selected').data('edutype');
  if(eduType==1){
    $('#clsDivBoard'+divId).show();
    $('#clsDivCourse'+divId).hide();
    $('#clsDivMedium'+divId).show();
    $('#clsDivUniversity'+divId).hide();
  }else{
    $('#clsDivBoard'+divId).hide();
    $('#clsDivCourse'+divId).show();
    $('#clsDivMedium'+divId).hide();
    $('#clsDivUniversity'+divId).show();
  }
}

function radioCurrentJob(rowId){
  var radioValue = $("input[name='chkCurrentJob']:checked").val();
  $(".hidChkCuurrentjob").each(function(totRow) { 
    totRow++;
    if(rowId==totRow){
      $( '#hidChkCuurrentjob'+totRow ).val('1');
    }
    else{
      $( '#hidChkCuurrentjob'+totRow ).val('0');
    }
  });
}
function chooseExp(){
  var radioValue = $("input[name='candType']:checked").val();
  if(radioValue==1){    
    $(".appendExperience *").attr("disabled", "disabled").off('click');
    $('#add-more-experience').prop('disabled', true);
    $(".appendExperience").css("opacity", "0.3");
  }else{
    $(".appendExperience *").prop('disabled',false);
    $('#add-more-experience').prop('disabled', false);
    $(".appendExperience").css("opacity", "");
  }
}
function removeCV(){
  $( '#hidprofileCV').val('');
  $( '#hiddbprofileCV').val('');
  $('.docLinkCV').hide();
}
function validExp(checkDate,controlId,rowId){
  $(".addExperience").each(function(totRow) { 
    totRow++;
    //console.log(new Date());
    StartDate=new Date($('#txtStartDate'+totRow).val());
    
    if($('#txtEndDate'+totRow).val()!=''){
      EndDate=new Date($('#txtEndDate'+totRow).val());
    }else{
      EndDate=new Date();      
    }
    console.log(EndDate);
    checkDate=new Date(checkDate);
    if(StartDate && EndDate){

      var Syear=StartDate.getFullYear(StartDate);
      var Smonth=StartDate.getMonth(StartDate);
      var Sdate=StartDate.getDate(StartDate);

      var Eyear=EndDate.getFullYear(EndDate);
      var Emonth=EndDate.getMonth(EndDate);
      var Edate=EndDate.getDate(EndDate);

      var Cyear=checkDate.getFullYear(checkDate);
      var Cmonth=checkDate.getMonth(checkDate);
      var Cdate=checkDate.getDate(checkDate);

      var from = new Date(Syear, parseInt(Smonth)-1, Sdate);  // -1 because months are from 0 to 11
      var to   = new Date(Eyear, parseInt(Emonth)-1, Edate);
      var check = new Date(Cyear, parseInt(Cmonth)-1, Cdate);
      if(check > from && check < to){

        $('.errMsg_'+controlId+rowId).html('Duplicate date entered').show();
        $('#'+controlId+rowId).addClass('error-input');
        $('#'+controlId+rowId).focus();
        $('#'+controlId+rowId).val('');
        return false;
        
      }else{
        $('.errMsg_'+controlId+rowId).html('');
        $('#'+controlId+rowId).removeClass('error-input');
        $('#'+controlId+rowId).blur();
      }
      
    }
    
  });
}
function removeCandidateImage(){
  $('#confirmAlertModal').modal('show');
  $('#btnConfirmModalOK').on('click', function () {
    $('#hiddbprofileImg').val('');
    $('#hdnbase64file').val('');
    $('.profile-pic').attr('src', '');
  });
}

/******************ajax file upload************************/
function uploadAjaxfile(){
    var formdata    = new FormData();
    var name        = $("#disability-cert").attr('name');
    formdata.append('title', name);
    formdata.append(name, $("#disability-cert").get(0).files[0]);
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/candidate/ajax/uploadfile",
      data        : formdata,
      processData : false,
      contentType : false,
      cache       : false,
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        //return res;
        if(res.status == 200){

          var fileName = res.fileOrg;
          let html = '';

          html     +=`<li class="docli">
                        <input type="hidden" name="upldFiles[]" class="upldFiles" value="`+res.file+`"/>
                        <span class="icon-material-outline-attach-file"></span>
                        <a target="_blank" href="`+res.fileTempUrl+`">View Document</a>
                        <a href="javascript:void(0);" onclick="return removeRow($(this))" class="remove-file"><span class="icon-line-awesome-close"></span></a>
                      </li>`;


          $('.disable-doc-ul').append(html);
        }
      }
    });
}

function removeRow(obj){
  var fileName = obj.closest('.upldFiles').val();
  $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/candidate/ajax/removetempfile",
      data        : {fileName:fileName},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        obj.parent('.docli').remove();
      }
    });
}


function removeexistingfile(filenme,fileId,rowId,obj){
  if(confirm('Are you sure to delete!!!!')){
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/candidate/ajax/removeexistingfile",
      data        : {filenme:filenme,fileId:fileId},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        if(res.status == 200){
          obj.parent('.docli').remove();
        }else{
          alert('something went wrong.');
        }
      }
    });
  }
}

// Added by MRD
// Remove Item
// $('.remove').on('click', function(){
//   $(this).parent(".addExperience").addClass("vanish").hide('slow', function(){ $(this).parent(".addExperience").remove(); });
// });

// $('.remove').on('click', function(){
//   $(this).parent(".addEducation").addClass("vanish").hide('slow', function(){ $(this).parent(".addEducation").remove(); });
// });
$(document).ready(function() {
  
  choosSubDisability('<?php if( !empty($personalInfo->disablityType) && ($personalInfo->disablityType)) { echo $personalInfo->disablityType; } else { echo ''; } ?>','selSubDisability',<?php if( !empty($personalInfo->disabilitySubType) && ($personalInfo->disabilitySubType) ) { echo $personalInfo->disabilitySubType; } else { echo ''; } ?>);
  
  var chooseExpType=<?php if(!empty($personalInfo->candidateType) && ($personalInfo->candidateType)) {echo $personalInfo->candidateType;}else{echo'';} ?>;
  if(chooseExpType==1){
    $(".appendExperience *").attr("disabled", "disabled").off('click');
    $('#add-more-experience').prop('disabled', true);
    $(".appendExperience").css("opacity", "0.3");
  }

  $( '.txtStartDate' ).datepicker({
      onSelect: function(dateText) {
        var rowNo=$(this).attr("data-row");
          validExp(dateText,'txtStartDate',rowNo)
      },
        changeMonth: true,
        changeYear: true,
        dateFormat: "d M y",
        maxDate: new Date()
    });
    $( '.txtEndDate' ).datepicker({
      onSelect: function(dateText) {
        var rowNo=$(this).attr("data-row");
          validExp(dateText,'txtEndDate',rowNo)
      },
        changeMonth: true,
        changeYear: true,
        dateFormat: "d M y",
        maxDate: new Date()
    });  

  $('.input-skill').keypress(function (e) {
     var key = e.which;
     if(key == 13)  // the enter key code
      {
        var newText = $(this).val();
        var rowNo=$(this).attr("data-slno");
        pushnewSkillCand(newText,rowNo);        
      }
    });

    $(".remove-skill").on('click', function(){      
        var skRow=$(this).attr("data-skRow");
        $(this).parent('li').remove();
        $("#txtSkill"+skRow).val('');
    });

  $('.removeEducation').on('click', function(){
   $(this).closest('.addEducation').remove();
   $(".addEducation").each(function(totRow) { 
    totRow++;
    var onchangeFun    = "selEducationType('"+totRow+"')";
    $( this ).find( '.selEducation' ).attr( 'id', 'selEducation' + totRow );
    $( this ).find( '#errselEducation' ).attr( 'class', 'errMsg_selEducation' + totRow +' errDiv');
    $( this ).find( '.selBoard' ).attr( 'id', 'selBoard' + totRow );
    $( this ).find( '.clsDivBoard' ).attr( 'id', 'clsDivBoard' + totRow );
    $( this ).find( '.clsDivCourse' ).attr( 'id', 'clsDivCourse' + totRow );
    $( this ).find( '.clsDivMedium' ).attr( 'id', 'clsDivMedium' + totRow );
    $( this ).find( '.clsDivUniversity' ).attr( 'id', 'clsDivUniversity' + totRow );
    $( this ).find( '#errselBoard' ).attr( 'class', 'errMsg_selBoard' + totRow +' errDiv');
    $( this ).find( '.txtCourse' ).attr( 'id', 'txtCourse' + totRow );
    $( this ).find( '#errtxtCourse' ).attr( 'class', 'errMsg_txtCourse' + totRow +' errDiv');
    $( this ).find( '.selMedium' ).attr( 'id', 'selMedium' + totRow );
    $( this ).find( '#errselMedium' ).attr( 'class', 'errMsg_selMedium' + totRow +' errDiv');
    $( this ).find( '.txtUniversity' ).attr( 'id', 'txtUniversity' + totRow );
    $( this ).find( '#errtxtUniversity' ).attr( 'class', 'errMsg_txtUniversity' + totRow +' errDiv');
    $( this ).find( '.selScoretype' ).attr( 'id', 'selScoretype' + totRow );
    $( this ).find( '#errselScoretype' ).attr( 'class', 'errMsg_selScoretype' + totRow +' errDiv');
    $( this ).find( '.txtScore' ).attr( 'id', 'txtScore' + totRow );
    $( this ).find( '#errtxtScore' ).attr( 'class', 'errMsg_txtScore' + totRow +' errDiv');
    $( this ).find( '.txtPassout' ).attr( 'id', 'txtPassout' + totRow );
    $( this ).find( '#errtxtPassout' ).attr( 'class', 'errMsg_txtPassout' + totRow +' errDiv');  
    $( this ).find( '.txtCertificate' ).attr( 'id', 'txtCertificate' + totRow);  
    $( this ).find( '.txtCertificate' ).attr( 'name', 'txtCertificate' + totRow);  
    $( this ).find( '.hidEduCert' ).attr( 'id', 'hidEduCert' + totRow);  
    $( this ).find( '.hiddbEduCert' ).attr( 'id', 'hiddbEduCert' + totRow);  
    $( this ).find( '#errtxtCertificate' ).attr( 'class', 'errMsg_txtCertificate' + totRow +' errDiv'); 
    $( this ).find( '.lbtxtCertificate' ).attr( 'for', 'txtCertificate' + totRow );
    $(this).find('.selEducation').attr('onchange', onchangeFun);  
  });
  });

  $('.removeExperience').on('click', function(){
   $(this).closest('.addExperience').remove();
   $(".addExperience").each(function(totRow) { 
    totRow++;
    var onclickFun    = "chkCurrentJob('"+totRow+"')";
    $( this ).find( '.txtDesignation' ).attr( 'id', 'txtDesignation' + totRow );
    $( this ).find( '#errtxtDesignation' ).attr( 'class', 'errMsg_txtDesignation' + totRow +' errDiv');
    $( this ).find( '.txtCompany' ).attr( 'id', 'txtCompany' + totRow );
    $( this ).find( '#errtxtCompany' ).attr( 'class', 'errMsg_txtCompany' + totRow +' errDiv');
    $( this ).find( '.txtStartDate' ).attr( 'id', 'txtStartDate' + totRow );
    $( this ).find( '#errtxtStartDate' ).attr( 'class', 'errMsg_txtStartDate' + totRow +' errDiv');
    $( this ).find( '.txtEndDate' ).attr( 'id', 'txtEndDate' + totRow );
    $( this ).find( '#errtxtEndDate' ).attr( 'class', 'errMsg_txtEndDate' + totRow +' errDiv');
    $( this ).find( '.chkCurrentJob' ).attr( 'id', 'chkCurrentJob' + totRow );
    $( this ).find( '.lbchkCurrentJob' ).attr( 'for', 'chkCurrentJob' + totRow );
    $(this).find('.chkCurrentJob').attr('onClick', onclickFun); 
    $( this ).find( '.hidChkCuurrentjob' ).attr( 'id', 'hidChkCuurrentjob' + totRow );
    $( this ).find( '.txtStartDate' ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "d M y",
        maxDate: new Date()
    });
    $( this ).find( '.txtEndDate' ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "d M y",
        maxDate: new Date()
    });
  });
  });

  $('.removeSkill').on('click', function(){
   $(this).closest('.addSkill').remove();
   $(".addSkill").each(function(totRow) { 
    totRow++;
    var onchangeFun    = "uploadcommonAjaxfile(this.id,'hidskillCert"+totRow+"')";
    $( this ).find( '.txtSkill' ).attr( 'id', 'txtSkill' + totRow );
    $( this ).find( '#errtxtSkill' ).attr( 'class', 'errMsg_txtSkill' + totRow +' errDiv');
    $( this ).find( '.txtSkillExp' ).attr( 'id', 'txtSkillExp' + totRow );
    $( this ).find( '#errtxtSkillExp' ).attr( 'class', 'errMsg_txtSkillExp' + totRow +' errDiv');
    $( this ).find( '.txtSkillCertificate' ).attr( 'id', 'txtSkillCertificate' + totRow );
    $( this ).find( '.txtSkillCertificate' ).attr( 'name', 'txtSkillCertificate' + totRow );
    $( this ).find( '.hidskillCert' ).attr( 'id', 'hidskillCert' + totRow );
    $( this ).find( '.hiddbskillCert' ).attr( 'id', 'hiddbskillCert' + totRow );
    $( this ).find( '#errtxtSkillCertificate' ).attr( 'class', 'errMsg_txtSkillCertificate' + totRow +' errDiv'); 
    $( this ).find( '.lbtxtSkillCertificate' ).attr( 'for', 'txtSkillCertificate' + totRow );
    $(this).find('.txtSkillCertificate').attr('onchange', onchangeFun); 
  });
  });

  $( function() {   
   $( ".datepickerdob" ).datepicker({
     changeMonth: true,
     changeYear: true,
     dateFormat: "d M y",
     maxDate: new Date('<?php echo $ageLimit?>')
   });
 } );
});

<!--cropper  -->

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
          // var imgwidth  = this.width;
          // var imgheight = this.height;
          // if(imgwidth < 250 || imgheight < 250){
          //   ret = 1;
          //   viewAlert('Sorry!! Upload image dimention of more than 250X250');
          // }
            //alert(this.width + " " + this.height);
            _URL.revokeObjectURL(objectUrl);
        };
        img.src = objectUrl;
    }
    setTimeout(function(){
      //alert(ret)
      if(ret == 0){
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
    },700)
  });
  $modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
      cropBoxResizable:true,
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
              if(base64data != ''){
                $modal.modal('hide');
                $(".profile-pic").attr("src",base64data);
                $("#hdnbase64file").val(base64data);
              }
              
          }
      });
  });
</script>
</script>
@endsection
@endsection
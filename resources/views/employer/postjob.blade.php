<?php  
$timeDifference='';
if(!empty($approvalTime)){
  $secondsDifference= strtotime(date('Y-m-d H:i:s'))-strtotime($approvalTime);
  $timeDifference =intval($secondsDifference/60);
}

?>
@extends('layouts.employerlayout')
@section('page-content')
@section('page-css')
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/jquery-ui.css">
@endsection

<div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Post Job</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/employer/dashboard">Home</a></li>
              <li>Post Job</li>
            </ul>
          </nav>
        </div>
      </div>    
    </div>
  <div class="utf-dashboard-content-inner-aera">
    <!-- Job post -->
    <form method="post" id="post-job" enctype="multipart/form-data">
    {{csrf_field()}}
        @include('components.admin-msg-tap')
        <?php // if($approveStatus == 0 && $timeDifference > 2880) {  ?>
          <div class="notification error closeable"> 
            Your profile has not been approved to Post a job. <a href="javascript:void(0);" class="sendLink" id="sendLink" onclick="return employerApprovalStatus();">Click here</a> to send approval request to admin.<a class="close"></a> 
          </div>
          <?php // } ?>
        <?php //if($approveStatus == 1) {// ?>
        <div class="row">
          <div class="col-xl-12">
            <div class="dashboard-box">
              <div class="content with-padding padding-bottom-10">
                <div class="utf-submit-field  job-title-field">
                  <!-- <h5 class="mb-2">Job Title</h5> -->
                  <input type="text" class="utf-with-border" id="jobTitle" name="jobTitle" placeholder="Job Title" value="{{@$jobData->jobTitle}}">
                  <span class="errMsg_jobTitle errDiv"></span>
                </div>
                <div class="utf-submit-field">
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Job State</h5>
                      <?php 
                        $sel_locations = array();
                        if(!empty(@$jobData->joblocations)){
                          foreach($jobData->joblocations as $key => $value) {
                            array_push($sel_locations,$value->location->stateId);

                          }
                       //  $city=$jobData->joblocations[0]['cityId'];
                        }
                            // print_r($sel_locations);exit;
                      ?>

                      <select class="selectpicker utf-with-border" data-live-search="true"  data-size="7" name="jobLocations[]" id="jobLocations" title="Select Location" onChange="loadcity(this.value,0);">
                        @if($location->isNotEmpty())
                        @foreach($location as $lval)
                        <option <?php echo in_array($lval->stateId, $sel_locations)?'selected':''; ?> value="{{$lval->stateId}}">{{$lval->state}}</option>
                        @endforeach
                        @endif
                      </select>    
                      <span class="errMsg_jobLocations errDiv"></span>  
                    </div>
                  </div>
                </div>
                  <div class="utf-submit-field">
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Job City</h5>
                     
                      <select  class="selectpicker utf-with-border" title="Select City" name="selcity"  title="Select city" data-size="7" data-live-search="true" title="Select City" id="selcity">
                       <option value="0">--select--</option>
                  </select>
                  <span class="errMsg_selcity errDiv"></span>  
                    
                    </div>

                  </div>
                </div>
                <div class="utf-submit-field">
                  <h5>No. of Vacancies</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="text" class="utf-with-border"  min="0" maxlength="4" id="jobVacancy" name="jobVacancy" value="{{@$jobData->jobVacancy}}">
                      <span class="errMsg_jobVacancy errDiv"></span>
                    </div>
                  </div>
                </div>

                <!--  -->
                <div class="utf-submit-field">
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Disability</h5>
                      <?php 
                        $sel_disable = array();
                        
                        if(!empty(@$jobData->jobdisabilities)){
                          foreach($jobData->jobdisabilities as $jdk => $jdv) {
                            array_push($sel_disable,$jdv->jobdisable->disabilityId);
                          }
                        }
                       // echo "<pre>";print_r($sel_industry);exit;
                      ?>
                      <select  class="selectpicker utf-with-border" title="Select disability" name="seldisable[]"  title="Select disability" data-size="7" data-live-search="true" title="Select Disable" id="seldisable" multiple>
                        <option value="0">--select--</option>
                        @if($disablity->isNotEmpty())
                          @foreach($disablity as $dval)
                            <option <?php echo in_array($dval->disabilityId, $sel_disable)?'selected':''; ?> value="{{$dval->disabilityId}}">{{$dval->disabilityName}}</option>
                          @endforeach
                        @endif
                  </select>
                  <span class="errMsg_seldisable errDiv"></span>  
                    
                    </div>

                  </div>
                </div>

                <!--  -->


                <div class="utf-submit-field">
                  <h5>Type of Employment </h5>
                  <div class="feedback-yes-no margin-bottom-30 margin-top-10">
                      @if($jobtypes->isNotEmpty())
                        @foreach($jobtypes as $jtky=>$jtval)
                        <div class="radio">
                          <?php 
                            $checked = '';
                            if($jtval->jobtypeId == @$jobData->employmentTypeId){
                              $checked = 'checked';
                            }else{
                              if($jtky==0){
                                $checked = 'checked';
                              }else{
                                $checked = '';
                              }
                            }
                          ?>
                          <input id="radio-{{$jtky+1}}" name="employmentTypeId" type="radio" <?php echo $checked; ?>  value="{{$jtval->jobtypeId}}">
                          <label for="radio-{{$jtky+1}}"><span class="radio-label"></span>{{$jtval->jobtypeName}}</label>
                        </div>
                        @endforeach
                      @endif
                  </div>
                </div>
                <div class="utf-submit-field">
                  <h5>Job Description</h5>
                  <textarea cols="40" rows="2" class="utf-with-border" placeholder="Write a brief details about the job..." id="jobDescription" name="jobDescription"> <?php echo htmlspecialchars_decode(@$jobData->jobDescription) ?></textarea>
                  <span class="errMsg_jobDescription errDiv"></span>
                </div>
                <div class="utf-submit-field">
                  <h5>Roles & Responsibilities</h5>
                      <textarea cols="40" rows="2" class="utf-with-border" placeholder="" id="jobRoleResponsibilities" name="jobRoleResponsibilities"><?php echo htmlspecialchars_decode(@$jobData->jobRoleResponsibilities); ?></textarea><span class="errMsg_jobRoleResponsibilities errDiv"></span>
                </div>

                <div class="utf-submit-field">
                  <div class="row">
                    <!-- <div class="col-md-6">
                      <h5>Key Skills <span class="text-light d-block">(Specify skills.These will be displayed in job and will help target a relevant pool of candidates)</span>
                      </h5>
                      <?php 
                        $sel_skills = array();
                        if(!empty(@$jobData->jobskills)){
                          foreach($jobData->jobskills as $key => $value) {
                            array_push($sel_skills,$value->skillname->skillsId);
                          }
                        }
                      ?>
                      <select class="selectpicker utf-with-border" data-live-search="true"  data-size="7" name="jobSkills[]" id="jobSkills" title="Select Skills" multiple>
                        @if($skills->isNotEmpty())
                        @foreach($skills as $skvals)
                        <option <?php echo in_array($skvals->skillsId, $sel_skills)?'selected':''; ?> value="{{$skvals->skillsId}}">{{$skvals->skillName}}</option>
                        @endforeach
                        @endif
                      </select>    
                      <span class="errMsg_jobSkills errDiv"></span>  
                    </div> -->
                    <div class="col-md-6">
                      <h5>Key Skills <!-- <span class="text-light d-block">(Specify skills.These will be displayed in job and will help target a relevant pool of candidates)</span> -->
                      </h5>
                      <span class="label-info">To add skills, kindly type and hit 'ENTER'</span>
                      <ul class="selected-skill">
                        <?php 
                          if(!empty(@$jobData->jobskills)){
                            foreach($jobData->jobskills as $key => $skval) {
                              echo '<li data-id="'.$skval->skillId.'">'.$skval->skillname->skillName.'<span class="remove-skill"></span></li>';
                            }
                          } 
                         ?>
                      </ul>
                      <div class="pos-relative">
                        <input type="text" name="" placeholder="Type key skills . . ." class="utf-with-border input-skill" onkeyup="return loadskills(this.value);">
                        <input type="hidden" name="jobSkills" id="jobSkills" value="">
                        <ul class="autofill-dropdown" style="display: none;">
                        </ul>
                      </div>   
                      <span class="errMsg_jobSkills errDiv"></span>  
                    </div>
                  </div>
                </div>

                <div class="utf-submit-field">
                  <h5>Minimum Work Experience</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="utf-input-with-icon">
                        <input type="text" class="utf-with-border"  id="minExp" name="minExp" onkeypress="return isNumberKey(event);" value="{{@$jobData->minExp}}">
                        <i>Year(s)</i>
                      </div>
                      <span class="errMsg_minExp errDiv"></span>
                    </div>
                  </div>
                </div>
                <div class="utf-submit-field">
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Annual Salary Range <span class="text-light d-block">(Specify correct salary to reach out the most relevant pool of candidates)</span></h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="utf-input-with-icon">
                        <i class="icon-line-awesome-inr"></i>
                        <input type="text" class="utf-with-border" placeholder="Minimum" id="minSalary" name="minSalary" onkeypress="return isNumberKey(event);" value="{{@$jobData->minSalary}}">                        
                      </div>
                      <span class="errMsg_minSalary errDiv"></span>
                    </div>
                    <div class="col-md-3">
                      <div class="utf-input-with-icon">
                        <i class="icon-line-awesome-inr"></i>
                        <input type="text" class="utf-with-border" placeholder="Maximum" id="maxSalary" name="maxSalary" onkeypress="return isNumberKey(event);" value="{{@$jobData->maxSalary}}">
                      </div>
                      <span class="errMsg_maxSalary errDiv"></span>
                    </div>
                  </div>
                </div>
                <div class="utf-submit-field">
                  <div class="row">
                    <div class="col-md-6">
                    <h5>Industry <span class="text-light d-block"></span></h5>
                      <select class="selectpicker utf-with-border" data-live-search="true" data-size="7" name="industryId[]" id="industryId" title="Select Industry" multiple>
                         <?php 
                          $sel_industry = array();
                          if(!empty(@$jobData->jobindustries)){
                            foreach($jobData->jobindustries as $key => $value) {
                              array_push($sel_industry,$value->industry->industryId);
                            }
                          }
                        //  echo "<pre>";print_r($sel_industry);exit;
                       
                        ?>
                        @if($industries->isNotEmpty())
                        @foreach($industries as $indval)
                        <option <?php echo in_array($indval->industryId, $sel_industry)?'selected':''; ?> value="{{$indval->industryId}}">{{$indval->industryName}}</option>
                        @endforeach
                        @endif
                      </select>
                      <span class="errMsg_employerIndustry errDiv"></span>
                    </div>
                  </div>
                </div>
                <div class="utf-submit-field">
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Minimum Education Qualification <span class="text-light d-block"></span></h5>
                      <?php 
                      // echo "<pre>";print_r($jobData->jobqualification[0]);exit;
                      // echo "<pre>";print_r($jobData->jobqualification[0]->jobminEduQual->qualification);exit;
                        $sel_minEduQual = array();
                        if(!empty(@$jobData->jobQualification)){
                          
                            foreach($jobData->jobqualification as $key => $value) {
                              array_push($sel_minEduQual,$value->jobminEduQual->qualificationId);
                            }                         
                        }
                        ?>
                      <select class="selectpicker utf-with-border" data-live-search="true" data-size="7" title="Select Education Qualification" id="qualificationId" name="qualificationId[]" multiple>
                        <?php //print_r($sel_minEduQual);exit; ?>
                        @if($qualifications->isNotEmpty())
                          @foreach($qualifications as $key => $qval) 
                            
                          <option <?php echo in_array($qval->qualificationId, $sel_minEduQual)?'selected':''; ?> value="{{$qval->qualificationId}}">{{$qval->qualification}}</option>
                            
                                                    
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                </div>
                <div class="utf-submit-field">
                  <h5>Company Details</h5>
                  <textarea cols="40" rows="2" class="utf-with-border" placeholder="" id="companyDetails" name="companyDetails"><?php echo (!empty($jobData->companyDetails))?htmlspecialchars_decode(@$jobData->companyDetails)
                  :session()->get('employer_session_data.employerCompanyintro'); ?></textarea>
                </div>
                <div class="utf-submit-field">
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Job Publish Schedule</h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="utf-input-with-icon">
                        <input type="text" class="utf-with-border" placeholder="Start Date" id="jobStartDate" name="jobStartDate" value="{{ (strtotime(@$jobData->jobStartDate)>0)?date('d M y',strtotime(@$jobData->jobStartDate)):'' }}" readonly>
                        <label for="jobStartDate"><i class="icon-feather-calendar" ></i> </label>
                      </div>
                      <span class="errMsg_jobStartDate errDiv"></span>
                    </div>
                    <div class="col-md-3">
                      <div class="utf-input-with-icon">
                        <input type="text" class="utf-with-border" placeholder="Expiry Date" id="jobExpiryDate" name="jobExpiryDate" value="{{ (strtotime(@$jobData->jobExpiryDate)>0)?date('d M y',strtotime(@$jobData->jobExpiryDate)):'' }}" readonly>
                        <label for="jobExpiryDate"><i class="icon-feather-calendar" ></i> </label>
                      </div>
                      <span class="errMsg_jobExpiryDate errDiv"></span>
                    </div>
                  </div>
                </div>

              </div>
              <div class="utf-centered-button margin-bottom-40">
                <a href="javascript:void(0);" onclick="return validator();"
                  class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0">{{$strSubmit}} <i
                    class="icon-feather-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
        <?php //} else { ?>
          <!-- <h5>Your Profile has not been approved to Post Job.</h5> -->
          <?php //} ?>
    </form>  
    </div>
  </div>
<!-- Job post  / End -->
@section('page-js')
<script src="<?php echo PUBLIC_PATH; ?>js/jquery-ui.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/custom-datepicker.js"></script>
<script src="{{ROOT_URL}}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="{{ROOT_URL}}/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
   $(document ).ready(function() {
      // $("#post-job").keyup(function(event){
      //           if(event.keyCode == 13){
      //              validator();
      //           }
      //       });
   var userid='<?php echo SESSION('employer_session_data.userId');?>';
    loadnotifiation(userid,1);
   var selState=$("#jobLocations").val();
      var cityval ='<?php echo !empty($jobData->joblocations[0]['cityId'])?$jobData->joblocations[0]['cityId']:0; ?>'
   if(cityval!=0){
    loadcity(selState,cityval)
   }
    });
  $( function() {
    $( "#jobStartDate,#jobExpiryDate" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "d M y",
    });
  } );
  //$('textarea').ckeditor();
  CKEDITOR.replace('jobDescription', {
    toolbarGroups: [{
        "name": "basicstyles",
        "groups": ["basicstyles","links","list"]
      }
    ],
    removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
  });
  CKEDITOR.replace('jobRoleResponsibilities', {
    toolbarGroups: [{
        "name": "basicstyles",
        "groups": ["basicstyles","links","list"]
      }
    ],
    removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
  });
  CKEDITOR.replace('companyDetails', {
    toolbarGroups: [{
        "name": "basicstyles",
        "groups": ["basicstyles","links","list"]
      }
    ],
    removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
  });
  CKEDITOR.config.removePlugins = 'elementspath';
  function validator()
  {
      $('.errDiv').hide();
      $('.error-input').removeClass('error-input');

      if(!blankCheck('jobTitle','Job title can not be left blank'))
          return false;  

      if(!blankCheck('jobLocations','Job State can not be left blank'))
          return false;  
       if(!blankCheck('selcity','Job City can not be left blank'))
          return false;  

      if(!blankCheck('jobVacancy','No. of vacancies can not be left blank'))
          return false;  

      if(!blankCheck('seldisable','Job disability can not be left blank'))
          return false;  

      if(!blankEditorCheck('jobDescription','Job description can not be left blank'))
          return false; 

      if(!blankEditorCheck('jobRoleResponsibilities','Job roles & responsibilities can not be left blank'))
          return false;  

      var finalskills = '';  
      if($('.selected-skill li').length > 0){
        $('.selected-skill li').each(function(){
          var selval = $(this).data('id');
          finalskills += selval+'/';
          //finalskills.push(selval);
        });
      }  

      $('#jobSkills').val(finalskills.slice(0,-1));

      if (!selectDropdown('jobSkills', 'Please select a skill.'))
          return false;

      if (!blankCheck('minExp', 'Minimum work experience can not be blank'))
          return false;

      if (!blankCheck('minSalary', 'Minimum annual salary range can not be blank'))
          return false;

      if (!blankCheck('maxSalary', 'Maximum annual salary range can not be blank'))
          return false;

      if(parseFloat($('#minSalary').val())>parseFloat($('#maxSalary').val())){
        $('.errMsg_maxSalary').html('Maximum salary range should be greater than minimum salary').show();
        $('#maxSalary').addClass('error-input');
        $('#maxSalary').focus();
        return false;
      }

      if (!selectDropdown('industryId', 'Please select an industry.'))
          return false;

      if (!selectDropdown('qualificationId', 'Please select an qualification.'))
          return false;

      if (!blankEditorCheck('companyDetails', 'Company details can not be blank'))
          return false;

      if (!blankCheck('jobStartDate', 'Start date can not be blank'))
          return false;

      if (!blankCheck('jobExpiryDate', 'Expiry date can not be blank'))
          return false;
            
      var jobStartDate  = $("#jobStartDate").val();
      var jobExpiryDate    = $("#jobExpiryDate").val();

      if(Date.parse(jobExpiryDate) <= Date.parse(jobStartDate)){
          $('.errMsg_jobExpiryDate').html('Expiry date should be greater than start date').show();
          $('#jobExpiryDate').addClass('error-input');
          $('#jobExpiryDate').focus();
          return false;
      }
      
      $('#post-job').submit();  
        
  }


  $('.input-skill').keypress(function (e) {
   var key = e.which;
   if(key == 13)  // the enter key code
    {
      var newText = $(".input-skill").val();
      pushnewSkill(newText);        
    }
  });
    
  $(".remove-skill").on('click', function(){
      $(this).parent('li').remove();
  });

  
    function employerApprovalStatus(status){
 
    var employerId = '<?php echo SESSION('employer_session_data.userId');?>'; 
  
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/employer/ajax/employerApprovalMail",
      data        : {       
        employerId:employerId
      },
     // dataType    : "json",    
      processData: true, 
      cache:false, 
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      },
      beforeSend: function () { 
      },
    success: function (res) {   
      if(res =='success'){
        viewAlert('Approval request has been sent!');
        setTimeout(function(){ 
          location.reload();          
            }, 3000);       
      } else{
        viewAlert('Something went wrong!');         
      }   
    }
    });
   }
  //});
</script>
@endsection
@endsection
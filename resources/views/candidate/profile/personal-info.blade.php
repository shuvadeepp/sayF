<div class="utf-popup-tab-content-item" id="pinfo">
  <div class="row flex-column-reverse flex-xl-row">
    <div class="col-xl-10 ">
      <div class="utf-submit-field">
        <h5>Full Name</h5>
        <div class="utf-submit-field-group">
          <div class="form-group-field-item">
            <input type="text" id="txtFName" name="txtFName" placeholder="First Name" value="{{$firstName}}" maxlength="20"
              onkeypress="return isCharKey(event);">
            <span class="errMsg_txtFName errDiv"></span>
          </div>
          <div class="form-group-field-item">
            <input type="text" id="txtMName" name="txtMName" placeholder="Middle Name" value="{{$middleName}}"
              maxlength="20" onkeypress="return isCharKey(event);">
            <span class="errMsg_txtMName errDiv"></span>
          </div>
          <div class="form-group-field-item b-r-0">
            <input type="text" id="txtLName" name="txtLName" placeholder="Last Name" value="{{$lastName}}" maxlength="20"
              onkeypress="return isCharKey(event);">
            <span class="errMsg_txtLName errDiv"></span>
          </div>
        </div>
      </div>
      <div class="utf-submit-field">
        <h5>Address</h5>
        <?php //print_r($personalInfo); exit; ?>
        <input type="text" class="utf-with-border" placeholder="Address" name="txtAddress" id="txtAddress"
        value="<?php if(!empty($personalInfo->address)){ echo $personalInfo->address; } else { echo ''; } ?>" >
        <span class="errMsg_txtAddress errDiv"></span>
      </div>
      <div class="row">
        <div class="col-xl-4 col-lg-4">
          <div class="utf-submit-field">
            <h5>Pincode</h5>
            <input class="utf-with-border" placeholder="Pincode" name="txtPin" id="txtPin" value="<?php if(!empty($personalInfo->pin)){ echo $personalInfo->pin; } else { echo ''; } ?>"
              maxlength="6">
            <span class="errMsg_txtPin errDiv"></span>
          </div>
        </div>
      <!--   <div class="col-xl-4 col-lg-4">
          <div class="utf-submit-field">
            <h5>City</h5>
            <input type="text" class="utf-with-border" placeholder="City" name="txtCity" id="txtCity"
              value=" <?php //if(!empty($personalInfo->city)){ echo $personalInfo->city; } else { echo ''; } ?>" maxlength="20">
            <span class="errMsg_txtCity errDiv"></span>
          </div>
        </div> -->
        

        <div class="col-xl-4 col-lg-4">
          <div class="utf-submit-field">
            <h5>State</h5>
            <select class="selectpicker utf-with-border" data-size="7" title="Select State" name="selState" id="selState" onChange="loadcity(this.value,0);">
              <?php
                  foreach($states as $state){?>
              <option 
                <?php 
                  if(!empty($state->state == $state->stateId) && ($personalInfo->state == $state->stateId)) { echo "selected";} else { echo ''; }
                ?>
                  value="<?php if(!empty($state->stateId)){ echo $state->stateId; } else { echo ''; } ?>"><?php if(!empty($state->state)) { echo $state->state; } else { echo ''; } ?>
              </option>
              <?php } ?>
              ?>
            </select>
            <span class="errMsg_selState errDiv"></span>
          </div>
        </div>


        <div class="col-xl-4 col-lg-4">
          <div class="utf-submit-field">
            <h5>City</h5>
            <select  class="selectpicker utf-with-border" title="Select City" name="selcity" data-size="7" data-live-search="true" id="selcity">
                       <option value="0">--select--</option>
               
                  </select>
            
            <span class="errMsg_txtCity errDiv"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-4 col-lg-4">
          <div class="utf-submit-field">
            <h5>Primary Number</h5>
            <input class="utf-with-border" placeholder="Primary Number" value="{{$candMobile}}" name="txtMobile"
              id="txtMobile" maxlength="16">
            <span class="errMsg_txtMobile errDiv"></span>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4">
          <div class="utf-submit-field">
            <h5>Secondary Number</h5>
            <input class="utf-with-border" placeholder="Secondary Number" name="txtSecMobile" id="txtSecMobile"
              value="<?php if(!empty($personalInfo->secondMob)){ echo $personalInfo->secondMob; } else { echo ''; } ?>" maxlength="16">
              <span class="errMsg_txtSecMobile errDiv"></span>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4">
          <div class="utf-submit-field">
            <h5>Email Id</h5>
            <input type="email" class="utf-with-border" placeholder="Email Id" value="{{$candEmail}}" readonly>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-6">
          <div class="utf-submit-field">
            <h5>Gender</h5>       
              <select class="selectpicker utf-with-border" title="Gender" name="selGender" id="selGender">
                <?php $genderArr = json_decode(GENDER_TYPE,true);
                  foreach ($genderArr as $genderArrKey => $genderArrVal) { ?>
                    <option <?php if($candGender==$genderArrKey){ echo "selected";}?> value="{{$genderArrKey}}">{{$genderArrVal}}</option>
                  <?php
                  }
                  ?>
              </select>
            <span class="errMsg_selGender errDiv"></span>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6">
          <div class="utf-submit-field">
            <h5>Date of Birth</h5>
            <div class="utf-input-with-icon">
              <input type="text" class="utf-with-border datepickerdob" name="txtDOBDate" id="txtDOBDate" value="{{ (!empty($candDOB))?date('d M y', strtotime($candDOB)):''}}">
              <label for="txtDOBDate"><i class="icon-feather-calendar"></i> </label>
              <span class="errMsg_txtDOBDate errDiv"></span>
            </div>
          </div>
        </div>        
      </div>
    </div>
    <div class="col-xl-2 ">
      <div class="utf-submit-field text-center text-md-left">
        <h5>Upload Your Photo</h5>
        <div class="utf-avatar-wrapper upload-photo-field mb-2" data-tippy-placement="top" title="Change Profile Picture">      
          <input type="hidden" name="hiddbprofileImg" id="hiddbprofileImg" value=" <?php if(!empty($personalInfo->profileImage)){ echo $personalInfo->profileImage; } else { echo ''; } ?>">
          
          <img class="profile-pic" src="<?php echo (!empty($personalInfo->profileImage))?ROOT_URL.'/storage/app/uploads/candidateProfile/'.$personalInfo->profileImage:PUBLIC_PATH.'images/user-avatar-placeholder.png';?>" alt="" />
          <div class="upload-button"></div>
          <input class="file-upload image" type="file" accept="image/*" id="fileProfileImg"/>
          <input type="hidden" name="hdnbase64file" id="hdnbase64file" value="">
        </div>
        <a href="javascript:void(0)" class="remove-upload-img mx-auto mr-md-auto ml-md-0" onclick="return removeCandidateImage();"><span>Remove Image</span><span class="icon-feather-trash pl-1"></span></a>
        <small>(Maximum file size should be less than 10MB)</small>
        <span class="errMsg_fileProfileImg errDiv"></span>
        <!-- <div class="upload-photo-field ">
          
         
        </div> -->
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <!-- Upload CV -->
      <div class="file-upload-custom">
        <div class="utf-submit-field margin-bottom-0">
          <h5>Upload CV</h5>
          <input type="file" name="profileCV" id="profileCV" class="utf-with-border" onchange="uploadcommonAjaxfileCV(this.id,'hidprofileCV')">
          <label for="profileCV" class="mb-0">
            <input type="hidden" name="hidprofileCV" id="hidprofileCV">
            <input type="hidden" name="hiddbprofileCV" id="hiddbprofileCV" value=" <?php if (!empty($personalInfo->profileCV)) { echo $personalInfo->profileCV; } else { echo ''; } ?>">
            <i class="icon-feather-upload-cloud"></i>
            Choose file</label>
            <small>Maximum file size is 1MB of type pdf png jpg.</small>
        </div>
      </div>
    </div>
  </div>
  
  <ul class="uploaded-files mt-4 docLinkCV" <?php if(!empty($personalInfo->profileCV)){ echo "style='display: block;'";} else { echo "style='display: none;'"; }?>>
      <li>
        <span class="icon-line-awesome-file-pdf-o"></span>
        <a href="{{ROOT_URL.'/storage/app/uploads/candidateProfile/'.!empty($personalInfo->profileCV)}}" class="uploaded__file-name downLinkCV" target="_blank" title="">Profile CV</a>
        <a href="#!" class="remove-file" onclick="removeCV();"><span class="icon-line-awesome-close"></span></a>
      </li>
  </ul>
  <div class="text-right">
    <a href="javascript: void(0);" title="Next" class="next-btn utf-ripple-effect-dark margin-top-50" type="submit"
      onclick="return validator(2);">
      Next
    </a>
  </div>
</div>
{{-- data-target="lwexp" --}}
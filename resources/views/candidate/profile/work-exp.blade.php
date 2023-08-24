<div class="utf-popup-tab-content-item" id="wexp"> 
  <div class="exp-box">
    <div class="row mb-2">
      <div class="col-12">
        <div class="radio">
          <input type="radio" id="fresher" name="candType" value="1" onchange="chooseExp();" <?php if(!empty($personalInfo->candidateType) && ($personalInfo->candidateType == 1) ){ echo "checked";}?>>
          <label for="fresher"><span class="radio-label"></span> Fresher</label>
        </div>
        <div class="radio ml-3">
          <input type="radio" id="experience" name="candType" value="2" onchange="chooseExp();" <?php if(!empty($personalInfo->candidateType) && ($personalInfo->candidateType == 2)){ echo "checked";}?>>
          <label for="experience"><span class="radio-label"></span> Experience</label>
        </div>
      </div>
      <div class="col-12 mt-2">
        <span class="errMsg_candType errDiv" id="errcandType"></span>
      </div>
    </div>
    <div class="add-more-box appendExperience pt-0 bor-none">
      <?php if(count($workDetls) > 0){      
        $i=1;  
          foreach($workDetls as $workDetl){ 
          ?>
          <div class="row addExperience">
            <span class="remove removeExperience"></span>
            <div class="col-xl-3 col-md-6">
              <div class="utf-submit-field">
                <h5>Designation</h5>
                <input type="text" class="utf-with-border txtDesignation" placeholder="Current Designation" name="txtDesignation[]" id="txtDesignation{{$i}}" value="{{$workDetl->designation}}" maxlength="50">
                <span class="errMsg_txtDesignation{{$i}} errDiv" id="errtxtDesignation"></span>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="utf-submit-field">
                <h5>Company Name</h5>
                <input type="text" class="utf-with-border txtCompany" placeholder="Company Name" name="txtCompany[]" id="txtCompany{{$i}}" value="{{$workDetl->companyName}}" maxlength="30">
                <span class="errMsg_txtCompany{{$i}} errDiv" id="errtxtCompany"></span>
              </div>
            </div>
            <div class="col-xl-2 col-md-6">
              <div class="utf-submit-field">
                <h5>Start Date</h5>
                <div class="utf-input-with-icon">
                  <input type="text" class="utf-with-border txtStartDate" placeholder="dd-mm-yy" name="txtStartDate[]" id="txtStartDate{{$i}}" value="{{($workDetl->startYear)?date('d M y', strtotime($workDetl->startYear)):''}}" data-row="{{$i}}">
                  <i class="icon-feather-calendar"></i> 
                  <span class="errMsg_txtStartDate{{$i}} errDiv" id="errtxtStartDate"></span>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-6">
              <div class="utf-submit-field">
                <h5>End Date</h5>
                <div class="utf-input-with-icon">
                  <input type="text" class="utf-with-border txtEndDate" name="txtEndDate[]" id="txtEndDate{{$i}}" value="{{($workDetl->endYear)?date('d M y', strtotime($workDetl->endYear)):''}}" data-row="{{$i}}">
                  <i class="icon-feather-calendar"></i> 
                  <span class="errMsg_txtEndDate{{$i}} errDiv" id="errtxtEndDate"></span>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-6 d-flex mt-xl-5">
              <input type="radio" class="mb-0 mt-1 mr-2"  data-tippy-placement="top" title="Select this if you currently work here" id="chkCurrentJob{{$i}}" name="chkCurrentJob" value="1" onclick="radioCurrentJob('{{$i}}');" <?php if($workDetl->currentJob ==1){ echo "checked";}?>>
              <label for="chkCurrentJob{{$i}}"  data-tippy-placement="top" title="Select this if you currently work here">Current Job</label>
              <input type="hidden" class="hidChkCuurrentjob" name="hidChkCuurrentjob[]" id="hidChkCuurrentjob{{$i}}" value="{{$workDetl->currentJob}}">
            </div>
          </div>
        <?php $i++;} 
        } else {
          ?>
      <!--Add-->
      <div class="row addExperience">
        <div class="col-xl-3 col-md-6">
          <div class="utf-submit-field">
            <h5>Designation</h5>
            <input type="text" class="utf-with-border txtDesignation" placeholder="Designation" name="txtDesignation[]" id="txtDesignation1" maxlength="50">
            <span class="errMsg_txtDesignation1 errDiv" id="errtxtDesignation"></span>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="utf-submit-field">
            <h5>Company Name</h5>
            <input type="text" class="utf-with-border txtCompany" placeholder="Company Name" name="txtCompany[]" id="txtCompany1" maxlength="30">
            <span class="errMsg_txtCompany1 errDiv" id="errtxtCompany"></span>
          </div>
        </div>
        <div class="col-xl-2 col-md-6">
          <div class="utf-submit-field">
            <h5>Start Date</h5>
            <div class="utf-input-with-icon">
              <input type="text" class="utf-with-border txtStartDate" placeholder="dd-mm-yy" name="txtStartDate[]" id="txtStartDate1" data-row="1">
              <i class="icon-feather-calendar"></i> 
              <span class="errMsg_txtStartDate1 errDiv" id="errtxtStartDate"></span>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-md-6">
          <div class="utf-submit-field">
            <h5>End Date</h5>
            <div class="utf-input-with-icon">
              <input type="text" class="utf-with-border txtEndDate" name="txtEndDate[]" id="txtEndDate1" data-row="1">
              <i class="icon-feather-calendar"></i> 
              <span class="errMsg_txtEndDate1 errDiv" id="errtxtEndDate"></span>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-md-6 align-self-end">
         
          <input type="radio" id="chkCurrentJob1" name="chkCurrentJob" value="1" data-tippy-placement="top" title="Select this if you currently work here" onclick="radioCurrentJob('1');" >
          <label for="chkCurrentJob1" data-tippy-placement="top" title="Select this if you currently work here">Current Job</label>
          <input type="hidden" class="hidChkCuurrentjob" name="hidChkCuurrentjob[]" id="hidChkCuurrentjob1" value="0">

        </div>
      </div>
      <!--End Add-->
      <?php } ?>
    </div>
  </div>
  <div class="text-right">
    <button class="button utf-ripple-effect-dark margin-top-0" type="button" id="add-more-experience"><i class="icon-line-awesome-plus"></i> Add More Experience</button>
  </div>
  <div class="text-right ">
    <a href="javascript: void(0);" title="Next"  class="next-btn utf-ripple-effect-dark margin-top-50" type="submit" onclick="return validator(3);">
      Next
    </a>
  </div>
</div>
{{-- data-target="ledu" --}}
<div class="utf-popup-tab-content-item" id="disability">
  
  <div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6">
      <div class="utf-submit-field">
        <h5>Type Of Disability</h5>       
          <select class="selectpicker utf-with-border" title="Disability Type" name="selDisability" id="selDisability" onchange="choosSubDisability(this.value,'selSubDisability',0);">
            <?php 
              foreach($disability as $disabilit) { ?>
                <option <?php if(!empty($personalInfo->disablityType) == !empty($disabilit->disabilityId)){ echo "selected";} else { echo ''; }?> value="{{$disabilit->disabilityId}}">{{$disabilit->disabilityName}}</option>
              <?php
              }
              ?>
          </select>
        <span class="errMsg_selDisability errDiv"></span>
      </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6">
      <div class="utf-submit-field">
        <h5>Disability Subtype</h5>
        <select class="utf-with-border" title="Disability Subtype" name="selSubDisability" id="selSubDisability">
          <option value="">Select</option>
        </select>
        <span class="errMsg_selSubDisability errDiv"></span>
      </div>
    </div>        
  </div>
  <div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6">
      <div class="utf-submit-field">
        <h5>Disability Percentage</h5>       
          <select class="selectpicker utf-with-border" title="Disability Percentage" name="selPersentage" id="selPersentage">
            <?php 
              for($p=40; $p<=100; $p++) { ?>
                <option <?php if(!empty($personalInfo->disabilityPercentage) && (!empty($personalInfo->disabilityPercentage==$p))){ echo "selected";} else { echo ''; }?> value="{{$p}}">{{$p}}</option>
              <?php
              }
              ?>
          </select>
        <span class="errMsg_selPersentage errDiv"></span>
      </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6">
      <div class="utf-submit-field">
        <h5>Disability Certificate No.</h5>
        <input class="utf-with-border" placeholder="Disability Certificate No." value="<?php if(!empty($personalInfo->disabilityCertificateNo)){ echo $personalInfo->disabilityCertificateNo; } else { echo ''; } ?> " name="txtDisableCert"
              id="txtDisableCert" maxlength="25">
        <span class="errMsg_txtDisableCert errDiv"></span>
      </div>
    </div>        
  </div>

  <!-- Disability Certificate-->
  <div class="file-upload-custom">
    <div class="utf-submit-field">
      <h5>Upload Government ID/Disability Certificate</h5>
      <input type="file" id="disability-cert" name="disability-cert" class="utf-with-border" >
      <label for="disability-cert" class="mb-0">
        <i class="icon-feather-upload-cloud"></i>
        Choose file</label>
        <small>Maximum file size is 1MB. of pdf jpg or png</small>
    </div>
  </div>

  <ul class="uploaded-files disable-doc-ul">
      <?php 
        if(!empty($docDetails)){
          foreach ($docDetails as $dkey => $dval) {
      ?>
      <li class="docli">
        <input type="hidden" name="upldFiles[]" class="upldFiles" value="{{$dval->docFile}}" id="upldFiles{{($dkey+1)}}"/>
        <span class="icon-material-outline-attach-file"></span>
        <a target="_blank" href="{{STORAGE_PATH.'disabilitydoc/'.$dval->docFile}}">View Document</a>
        <a href="javascript:void(0);" onclick="return removeexistingfile('{{$dval->docFile}}',{{$dval->docId}},{{($dkey+1)}},$(this))" class="remove-file"><span class="icon-line-awesome-close"></span></a>
      </li>
      <?php }}?>
  </ul>

  
  <div class="text-right">
    <?php if(!empty($personalInfo->finalSubmit) && ($personalInfo->finalSubmit==1)){?>
      <a href="{{ROOT_URL}}/candidate/candidatedetails/view/{{encrypt(SESSION('candidate_session_data.userId'))}}" title="Next" class="btn btn-primary utf-ripple-effect-dark">Preview</a>
    <?php } ?>
    {{-- <a href="#!" title="Next" class="btn btn-primary utf-ripple-effect-dark">Preview</a> --}}
    <a href="#!" title="Next" class="btn btn-secondary utf-ripple-effect-dark ml-2" type="submit" onclick="return validator(1);" id="finalSubmitBtn" style="display: none;">Finish & Submit</a>
  </div>
</div>
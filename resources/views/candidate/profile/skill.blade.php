<div class="utf-popup-tab-content-item" id="skills"> 
  <div class="skill-box">
    <div class="add-more-box appendSkill pt-0">
      <?php if(count($skillDetls) > 0){      
      $m=1;  
        foreach($skillDetls as $skillDetl){ 
        ?>
      <div class="row addSkill">
        <span class="remove removeSkill"></span>
        <div class="col-xl-3 col-md-6">
          <div class="utf-submit-field">
            <h5>Skill Name/Certifications</h5>            
            
            <input type="text" name="" data-slno="{{$m}}" id="input-skill{{$m}}" placeholder="Type your skill . . ." class="utf-with-border input-skill" onkeyup="return loadskillsCand(this.value,{{$m}});">
            <input type="hidden" class="txtSkill" name="txtSkill[]" id="txtSkill{{$m}}" value="{{$skillDetl->skillName}}">
            <ul class="autofill-dropdown" id="autofill-dropdown{{$m}}" style="display: none;">
            </ul>
            <ul class="selected-skill" id="selected-skill{{$m}}">
              <li data-id="{{$skillDetl->skillName}}">{{$skillDetl->skillnames}}<span class="remove-skill" data-skRow="{{$m}}"></span></li>
            </ul>
            <span class="errMsg_txtSkill{{$m}} errDiv" id="errtxtSkill"></span>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="utf-submit-field">
            <h5>Years of Experience</h5>
            <input type="text" maxlength="2" class="utf-with-border txtSkillExp" placeholder="Years of Experience" name="txtSkillExp[]" id="txtSkillExp{{$m}}" value="{{$skillDetl->experienceYear}}">
            <span class="errMsg_txtSkillExp{{$m}} errDiv" id="errtxtSkillExp"></span>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="utf-submit-field">
            <h5>Upload Certificate</h5>
            <input type="file" class="utf-with-border txtSkillCertificate" placeholder="Upload Photo" name="txtSkillCertificate{{$m}}" id="txtSkillCertificate{{$m}}" onchange="uploadcommonAjaxfile(this.id,'hidskillCert{{$m}}')">
            <label class="lbtxtSkillCertificate" for="txtSkillCertificate{{$m}}">Upload Certificate</label>
            <input type="hidden" class="hidskillCert" name="hidskillCert[]" id="hidskillCert{{$m}}">
            <input type="hidden" class="hiddbskillCert" name="hiddbskillCert[]" id="hiddbskillCert{{$m}}" value="{{$skillDetl->skillCertificate}}">
            <span class="errMsg_txtSkillCertificate{{$m}} errDiv" id="errtxtSkillCertificate"></span>
            <?php if($skillDetl->skillCertificate){ ?>
              <div>
                <span class="docLink">
                  <a href="{{ROOT_URL.'/storage/app/uploads/candidateSkill/'.$skillDetl->skillCertificate}}" class="btn btn-primary downLink" target="_blank" style="display: block;"><span class="icon-feather-eye"></span> </a>
                </span>
              </div>
            <?php } ?>
          </div>          
        </div>
        
      </div>
      <?php $m++;} 
        } else {
          ?>
        <div class="row addSkill">
          <div class="col-xl-3 col-md-6">
            <div class="utf-submit-field">
              <h5>Skill Name/Certifications</h5>
              <input type="text" name="" data-slno="1" id="input-skill1" placeholder="Type your skill . . ." class="utf-with-border input-skill" onkeyup="return loadskillsCand(this.value,1);">
              <input type="hidden" class="txtSkill" name="txtSkill[]" id="txtSkill1" value="">
              <ul class="autofill-dropdown" id="autofill-dropdown1" style="display: none;">
              </ul>
              <ul class="selected-skill" id="selected-skill1">
              </ul>
              <span class="errMsg_txtSkill1 errDiv" id="errtxtSkill"></span>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="utf-submit-field">
              <h5>Years of Experience</h5>
              <input type="text" maxlength="2" class="utf-with-border txtSkillExp" placeholder="Years of Experience" name="txtSkillExp[]" id="txtSkillExp1">
              <span class="errMsg_txtSkillExp1 errDiv" id="errtxtSkillExp"></span>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="utf-submit-field">
              <h5>Upload Certificate</h5>
              <input type="file" class="utf-with-border txtSkillCertificate" placeholder="Upload Photo" name="txtSkillCertificate1" id="txtSkillCertificate1" onchange="uploadcommonAjaxfile(this.id,'hidskillCert1')">
              <label class="lbtxtSkillCertificate" for="txtSkillCertificate1">Upload Certificate</label>
              <input type="hidden" class="hidskillCert" name="hidskillCert[]" id="hidskillCert1">
              <input type="hidden" class="hiddbskillCert" name="hiddbskillCert[]" id="hiddbskillCert1">
              <span class="errMsg_txtSkillCertificate1 errDiv" id="errtxtSkillCertificate"></span>
              
              <div>
                <span class="docLink">
                  <a class="btn btn-primary downLink" target="_blank" style="display: none;"><span class="icon-feather-eye"></span> </a>
                </span>
              </div>
            </div>
          </div>

        </div>
        <?php } ?>
    </div>
  </div>
  <div class="text-right">
    <button class="button utf-ripple-effect-dark margin-top-0" type="button" id="add-more-skills">
      <i class="icon-line-awesome-plus"></i> Add More Skill 
    </button>
  </div>

  <div class="d-flex justify-content-end mt-5">
    <a href="javascript:void(0);" title="Next" class="next-btn utf-ripple-effect-dark margin-top-50" type="submit" onclick="return validator(5);">
      Next
    </a>
  </div>

  {{-- <div class="text-right ">
    <a href="javascript: void(0);" title="Next" data-target="ldisability" class="next-btn utf-ripple-effect-dark margin-top-50" type="submit" onclick="return validator(5);">
      Next
    </a>
  </div> --}}
</div>
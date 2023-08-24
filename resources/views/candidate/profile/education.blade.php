<div class="utf-popup-tab-content-item" id="edu"> 
  <div class="edu-box">
    <div class="add-more-box appendEducation pt-0">      
      <?php if(count($educationdetls) > 0){      
        $k=1;  
          foreach($educationdetls as $educationdetl){ 
            if($educationdetl->board > 0 && $educationdetl->medium){
              $showBoardCls="style='display: block;'";
              $showCourseCls="style='display: none;'";
            }else{
              $showCourseCls="style='display: block;'";
              $showBoardCls="style='display: none;'";
            }
          ?>
      <div class="row addEducation">
        <span class='remove removeEducation'></span>
        <div class="col-xl-2 col-lg-4 col-md-6 pr-0">
          <div class="utf-submit-field">
            <h5>Education</h5>
            <select class="utf-with-border selEducation" data-size="7" title="Select Education" name="selEducation[]" id="selEducation{{$k}}" onchange="selEducationType('{{$k}}');">
              <option value="">Select Education</option>
              <?php 
                foreach($education as $educations){ ?>
                  <option <?php if($educationdetl->class == $educations->educationId){ echo "selected";}?> data-edutype="{{$educations->educationType}}" value="{{$educations->educationId}}">{{$educations->educationName}}</option>
              <?php
                }
              ?>
            </select>
            <span class="errMsg_selEducation{{$k}} errDiv" id="errselEducation"></span>
          </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-6 pr-0 clsDivBoard" id="clsDivBoard{{$k}}" <?php echo $showBoardCls; ?>>
          <div class="utf-submit-field">
            <h5>Board</h5>
            <select class="utf-with-border selBoard" data-size="7" title="Select Board" name="selBoard[]" id="selBoard{{$k}}">
              <option value="">Select Board</option>
              <?php foreach($board as $boards){?>
                <option <?php if($educationdetl->board == $boards->boardId){ echo "selected";}?> value="{{$boards->boardId}}">{{$boards->boardName}}</option>
              <?php } ?>
            </select>
            <span class="errMsg_selBoard{{$k}} errDiv" id="errselBoard"></span>
          </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-6 pr-0 clsDivCourse" id="clsDivCourse{{$k}}" <?php echo $showCourseCls;?>>
          <div class="utf-submit-field">
            <h5>Course</h5>
            <input type="text" class="utf-with-border txtCourse" name="txtCourse[]" id="txtCourse{{$k}}" value="{{$educationdetl->course}}" maxlength="50">
            <span class="errMsg_txtCourse{{$k}} errDiv" id="errtxtCourse"></span>
          </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-6 pr-0 clsDivMedium" id="clsDivMedium{{$k}}" <?php echo $showBoardCls;?>>
          <div class="utf-submit-field">
            <h5>Medium</h5>
            <select class="utf-with-border selMedium" data-size="7" title="Select Medium" name="selMedium[]" id="selMedium{{$k}}"> 
              <option value="">Select Medium</option>             
              <?php $mediumArr = json_decode(MEDIUM_TYPE,true);
                foreach ($mediumArr as $mediumArrKey => $mediumArrVal) { ?>
                  <option <?php if($educationdetl->medium==$mediumArrKey){ echo "selected";}?> value="{{$mediumArrKey}}">{{$mediumArrVal}}</option>
                <?php
                }
                ?>
            </select>
            <span class="errMsg_selMedium{{$k}} errDiv" id="errselMedium"></span>
          </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-6 pr-0 clsDivUniversity" id="clsDivUniversity{{$k}}" <?php echo $showCourseCls;?>>
          <div class="utf-submit-field">
            <h5>University/Institute</h5>
            <input type="text" class="utf-with-border txtUniversity" placeholder="University/Institute" name="txtUniversity[]" id="txtUniversity{{$k}}" value="{{$educationdetl->university}}" maxlength="100">
            <span class="errMsg_txtUniversity{{$k}} errDiv" id="errtxtUniversity"></span>
          </div>
        </div>
        
        <?php /*<div class="col-xl-2 col-lg-4 col-md-6 pr-0">
          <div class="utf-submit-field">
            <h5>Score Type</h5>
            <select class="utf-with-border selScoretype" title="Score Type" name="selScoretype[]" id="selScoretype{{$k}}">
              <option value="">Select Score Type</option>
              <?php $scoreArr = json_decode(SCORE_TYPE,true);
                foreach ($scoreArr as $scoreArrKey => $scoreArrVal) { ?>
                  <option <?php if($educationdetl->scoreType==$scoreArrKey){ echo "selected";}?> value="{{$scoreArrKey}}">{{$scoreArrVal}}</option>
                <?php
                }
                ?>
            </select>
            <span class="errMsg_selScoretype{{$k}} errDiv" id="errselScoretype"></span>
          </div>
        </div> <?php */?>
        <div class="col-xl-2 col-lg-4 col-md-6 pr-0">
          <div class="utf-submit-field">
            <h5>Score</h5>
            <div class="utf-submit-field-group">
              <div class="form-group-field-item">
                <select class="selScoretype no-shadow mb-0" title="Type" name="selScoretype[]" id="selScoretype{{$k}}">
                  <option value="">Type</option>
                  <?php $scoreArr = json_decode(SCORE_TYPE,true);
                    foreach ($scoreArr as $scoreArrKey => $scoreArrVal) { ?>
                      <option <?php if($educationdetl->scoreType==$scoreArrKey){ echo "selected";}?> value="{{$scoreArrKey}}">{{$scoreArrVal}}</option>
                    <?php
                    }
                    ?>
                </select>
                <span class="errMsg_selScoretype{{$k}} errDiv" id="errselScoretype"></span>
              </div>
              <div class="form-group-field-item b-r-0">
                <input type="text" class="txtScore" placeholder="Score" name="txtScore[]" id="txtScore{{$k}}" value="{{$educationdetl->score}}" maxlength="6">
                <span class="errMsg_txtScore{{$k}} errDiv" id="errtxtScore"></span>
              </div>
            </div>
          </div>
        </div>

       
        <div class="col-xl-2 col-lg-3 col-md-4 pr-0">
          <div class="utf-submit-field">
            <h5>Year of Passing</h5>
            <input type="text" class="utf-with-border txtPassout" placeholder="Passing Out" name="txtPassout[]" id="txtPassout{{$k}}" value="{{$educationdetl->passYear}}" maxlength="4">
            <span class="errMsg_txtPassout{{$k}} errDiv" id="errtxtPassout"></span>
          </div>
        </div>
        <div class="col-xl-2 col-lg-8 col-md-6">
          <div class="u-certificate">
            <div class="">
              <div class="utf-submit-field">
                <h5>Upload Certificate (pdf png jpg)</h5>
                <input type="file" class="utf-with-border txtCertificate upload-certicate" placeholder="Upload Photo" name="txtCertificate" id="txtCertificate{{$k}}" onchange="uploadcommonAjaxfile(this.id,'hidEduCert{{$k}}')">
                <label class="lbtxtCertificate" for="txtCertificate{{$k}}">Upload Certificate</label>
                <input type="hidden" class="hidEduCert" name="hidEduCert[]" id="hidEduCert{{$k}}" >
                <input type="hidden" class="hiddbEduCert" name="hiddbEduCert[]" id="hiddbEduCert{{$k}}" value="{{$educationdetl->certificate}}">
                <span class="errMsg_txtCertificate{{$k}} errDiv" id="errtxtCertificate"></span>
                <?php if($educationdetl->certificate){ ?>
                  <div>
                    <span class="docLink">
                      <a href="{{ROOT_URL.'/storage/app/uploads/candidateEducation/'.$educationdetl->certificate}}" class="btn btn-primary downLink" target="_blank" style="display: block;"><span class="icon-feather-eye"></span> </a>
                    </span>
                  </div>
                <?php } ?>
              </div>
            </div>
            
          </div>
        </div>

      </div>
      <?php $k++;} 
        } else {
          ?>
          <!--Add-->
        <div class="row addEducation">
          {{-- <span class='remove'></span> --}}
          <div class="col-xl-2 col-lg-4 col-md-6">
            <div class="utf-submit-field">
              <h5>Education</h5>
              <select class="utf-with-border selEducation" data-size="7" title="Select Education" name="selEducation[]" id="selEducation1" onchange="selEducationType('1');">
                <option value="">Select Education</option>
                <?php 
                  foreach($education as $educations){ ?>
                    <option data-edutype="{{$educations->educationType}}" value="{{$educations->educationId}}">{{$educations->educationName}}</option>
                <?php
                  }
                ?>
              </select>
              <span class="errMsg_selEducation1 errDiv" id="errselEducation"></span>
            </div>
          </div>
          <div class="col-xl-2 col-lg-4 col-md-6 clsDivBoard" id="clsDivBoard1">
            <div class="utf-submit-field">
              <h5>Board</h5>
              <select class="utf-with-border selBoard" data-size="7" title="Select Board" name="selBoard[]" id="selBoard1">
                <option value="">Select Board</option>
                <?php foreach($board as $boards){?>
                  <option value="{{$boards->boardId}}">{{$boards->boardName}}</option>
                <?php } ?>
              </select>
              <span class="errMsg_selBoard1 errDiv" id="errselBoard"></span>
            </div>
          </div>
          <div class="col-xl-2 col-lg-4 col-md-6 clsDivCourse" id="clsDivCourse1" style="display: none;">
            <div class="utf-submit-field">
              <h5>Course</h5>
              <input type="text" class="utf-with-border txtCourse" name="txtCourse[]" id="txtCourse1" maxlength="50">
              <span class="errMsg_txtCourse1 errDiv" id="errtxtCourse"></span>
            </div>
          </div>
          <div class="col-xl-2 col-lg-4 col-md-6 clsDivMedium" id="clsDivMedium1">
            <div class="utf-submit-field">
              <h5>Medium</h5>
              <select class="utf-with-border selMedium" data-size="7" title="Select Medium" name="selMedium[]" id="selMedium1">
                <option value="">Select Medium</option>
                <?php $mediumArr = json_decode(MEDIUM_TYPE,true);
                foreach ($mediumArr as $mediumArrKey => $mediumArrVal) { ?>
                  <option value="{{$mediumArrKey}}">{{$mediumArrVal}}</option>
                <?php
                }
                ?>
              </select>
              <span class="errMsg_selMedium1 errDiv" id="errselMedium"></span>
            </div>
          </div>
          <div class="col-xl-2 col-lg-4 col-md-6 clsDivUniversity" style="display: none;" id="clsDivUniversity1">
            <div class="utf-submit-field">
              <h5>University/Institute</h5>
              <input type="text" class="utf-with-border txtUniversity" placeholder="University/Institute" name="txtUniversity[]" id="txtUniversity1" maxlength="100">
              <span class="errMsg_txtUniversity1 errDiv" id="errtxtUniversity"></span>
            </div>
          </div>
          
          <div class="col-xl-2 col-lg-4 col-md-6 pr-0">
            <div class="utf-submit-field">
              <h5>Score</h5>
              <div class="utf-submit-field-group">
                <div class="form-group-field-item">
                  <select class="selScoretype no-shadow mb-0" title="Score Type" name="selScoretype[]" id="selScoretype1">
                    <option value="">Score Type</option>
                    <?php $scoreArr = json_decode(SCORE_TYPE,true);
                      foreach ($scoreArr as $scoreArrKey => $scoreArrVal) { ?>
                        <option value="{{$scoreArrKey}}">{{$scoreArrVal}}</option>
                      <?php
                      }
                      ?>
                  </select>
                  <span class="errMsg_selScoretype1 errDiv" id="errselScoretype"></span>
                </div>
                <div class="form-group-field-item b-r-0">
                  <input type="text" class="txtScore" placeholder="Score" name="txtScore[]" id="txtScore1" maxlength="6">
                  <span class="errMsg_txtScore1 errDiv" id="errtxtScore"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-2 col-lg-3 col-md-4">
            <div class="utf-submit-field">
              <h5>Year of Passing</h5>
              <input type="text" class="utf-with-border txtPassout" placeholder="Passing Out" name="txtPassout[]" id="txtPassout1" maxlength="4">
              <span class="errMsg_txtPassout1 errDiv" id="errtxtPassout"></span>
            </div>
          </div>
          <div class="col-xl-2 col-lg-4 col-md-6">
            <div class="utf-submit-field">
              <h5>Upload Certificate</h5>
              <input type="file" class="utf-with-border txtCertificate" placeholder="Upload Photo" name="txtCertificate1" id="txtCertificate1" onchange="uploadcommonAjaxfile(this.id,'hidEduCert1')">
              <label class="lbtxtCertificate" for="txtCertificate1">Upload Certificate</label>
              <input type="hidden" class="hidEduCert" name="hidEduCert[]" id="hidEduCert1" >
              <input type="hidden" class="hiddbEduCert" name="hiddbEduCert[]" id="hiddbEduCert1" >
              <span class="errMsg_txtCertificate1 errDiv" id="errtxtCertificate"></span>

              <div>
                <span class="docLink">
                  <a class="btn btn-primary downLink" target="_blank" style="display: none;"><span class="icon-feather-eye"></span> </a>
                </span>
              </div>

            </div>
          </div>
        </div>
        <!--End Add-->
        <?php } ?>
    </div>
  </div>
  <div class="text-right">
    <button class="button utf-ripple-effect-dark margin-top-0" type="button" id="add-more-education">
      <i class="icon-line-awesome-plus"></i> Add More Education
    </button>
  </div>

  
  <div class="text-right ">
    <a href="javascript: void(0);" title="Next" class="next-btn utf-ripple-effect-dark margin-top-50" type="submit" onclick="return validator(4);">
      Next
    </a>
  </div>
</div>
{{-- data-target="lskills" --}}
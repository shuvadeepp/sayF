@extends('layouts.adminlayout')
@section('page-content')

<div class="utf-dashboard-content-container-aera" data-simplebar>
  <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
    <div class="row">
      <div class="col-xl-12">
        <h3>Candidate Details</h3>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}/employer/dashboard">Home</a></li>
            <li>Candidate Details</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  @include('components.admin-msg-tap')
  <div class="utf-dashboard-content-inner-aera ">
    <div class="dashboard-box d-flex justify-content-between profile-header">
      <div>
        <!-- <h3 class="mb-2 headline">Candidate Profile</h3> -->
      </div>
      <div class="text-right align-self-end">
        <div class="applicant-no"></div>
        <a href="#!" onclick="history.back();" class="back-btn"><i class="icon-line-awesome-long-arrow-left"></i> Back</a>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6">
        <div class="dashboard-box  margin-bottom-30">
          <div class="headline">
            <h3>Personal Details</h3>
          </div>
          <div class="content with-padding personal-details">
            <div class="row">
              <div class="col-xl-3 col-sm-4">
                <div class="utf-avatar-wrapper mb-0">
                  <img class="profile-pic" src="<?php echo STORAGE_PATH; ?>candidateProfile/{{ $candidateData->profileImage }}" alt="" />
                  <!-- <div class="upload-button"></div> -->
                  <!-- <input class="file-upload" type="file" accept="image/*" /> -->
                </div>
              </div>
              <div class="col-xl-9 col-sm-8">
                <div class="utf-submit-field mb-0">
                  <h4 class="profile-name">{{$candidateData->firstName}} {{$candidateData->middleName}} {{$candidateData->lastName}}</h4>
                  @if(!empty($candidateData->address))
                  <p><i class="icon-material-outline-location-on"></i> {{$candidateData->address}} </p>
                  @else 
                  <p><i class="icon-material-outline-location-on"></i> None </p>
                  @endif
                  <p>
                    <i class="icon-feather-phone"></i> {{$candidateData->mobileNo}} , {{$candidateData->secondMob}}
                  </p>
                  <p>
                    <i class="icon-feather-mail"></i> {{$candidateData->emailId}}
                  </p>
                  <p>DOB : {{ (!empty($candidateData->DOB))?date('d M y', strtotime($candidateData->DOB)):''}}</p>
                  <?php if($candidateData->candidateType==2){ ?>
                    <p>Experience : {{ $candidateData->experience}}</p>                  
                    <?php } else {?>
                      <p>Experience : Fresher</p>
                      <?php } ?>
                      @if(!empty($candidateData->profileCV))
                  <p>CV : <a href="{{!empty($candidateData->profileCV)?STORAGE_PATH.'candidateProfile/'.$candidateData->profileCV:''}}" target="_blank"><span class="icon-line-awesome-file-pdf-o"></span> view</a></p>
                      @else 
                      <p>CV : None </p>
                      @endif
                </div>
              </div>
            </div>
           
          </div>
        </div>

        <div  class="dashboard-box">
            <div class="headline">
              <h3>Education Details</h3>
            </div>
            <div class="content with-padding">
              <ul class="experience-list">
                <?php             
                  if(!empty($candidateEdu)){ 
                    $Scorejson = json_decode(SCORE_TYPE, true);
                    $Mediumjson = json_decode(MEDIUM_TYPE, true);                  
                    foreach ($candidateEdu as $educationdetl) {  ?>
                <li>                  
                  <div class="experience-pos"><!-- Class : --> <strong>{{@$educationdetl->educationytpe->educationName}}</strong></div>
                  <?php if($educationdetl->board > 0 ){ ?>
                    <div class="experience-company">Board : <strong>{{ @$educationdetl->boarddetails->boardName }}</strong></div>
                    <div class="experience-company">Medium : <strong>{{@$Mediumjson[$educationdetl->medium]}}</strong></div>
                  <?php } else{ ?>                  
                    <div class="experience-company">Course : <strong>{{@$educationdetl->course}}</strong></div>
                    <div class="experience-company">University : <strong>{{@$educationdetl->university}}</strong></div>
                  <?php } ?>
                    <div class="experience-company">Score Type : <strong>{{$Scorejson[$educationdetl->scoreType]}}</strong></div>
                    <div class="experience-company">Score : <strong>{{$educationdetl->score}}</strong></div>
                    <div class="experience-company">Year of Passing : <strong>{{$educationdetl->passYear}}</strong></div>
                    <div class="experience-company">Certificate : <?php if(!empty($educationdetl->certificate)){?><a href="{{!empty($educationdetl->certificate)?ROOT_URL.'/storage/app/uploads/candidateEducation/'.$educationdetl->certificate:''}}" target="_blank">view</a><?php }else{echo 'None';}?></div>
                </li>
                <?php } }else{ ?>
                <li>
                  No record found
                </li>
                <?php } ?>
              </ul>
            </div>
        </div>

      </div>

      <div class="col-xl-6">
        <div  class="dashboard-box  disability-profile">
          <div class="headline">
            <h3>Disability Profile</h3>
          </div>
          <div class="content with-padding">
            <div class="row">
              <div class="col-md-6 col-lg-3">
                Disability Type
              </div>
              <?php 
                if(!empty($disablityTypes)){ 
                  foreach ($disablityTypes as $dtkey => $dtval) {
              ?>
              <div class="col-md-6 col-lg-3">
                <span class="disability-label">{{$dtval->disabilityName}}</span>
              </div>
              <?php } } ?>
            </div>
            <div class="row">
              <div class="col-md-6 col-lg">
                Documents Uploaded
              </div>
               <?php 
                if(!empty($candidateData->disabilitydocs)){ 
                  foreach ($candidateData->disabilitydocs as $dkey => $docs) {
              ?>
              <div class="col-md-6 col-lg">
                <a target="_blank" href="{{STORAGE_PATH.'disabilitydoc/'.$docs->docFile}}" >
                   <i class="icon-line-awesome-file-text-o"></i>
                   <p>Doc {{$dkey+1}}</p>
                </a>
              </div>
              <?php }} ?>
            </div>
          </div>
        </div>
        
        <div  class="dashboard-box">
          <div class="headline">
            <h3>Work Experience</h3>
          </div>
          <div class="content with-padding">
            <ul class="experience-list">
              <?php 
                if(!empty($candidateExp)){ 
                  foreach ($candidateExp as $exp) {
              ?>
              <li>
                <span class="experience-date">{{date("M Y",strtotime($exp->startYear))}} - <?php echo ($exp->currentJob > 0)?  'Current' : date("M Y",strtotime($exp->endYear)) ; ?></span>
                <div class="experience-pos">{{$exp->designation}}</div>
                <div class="experience-company">{{$exp->companyName}}</div>
              </li>
              <?php } }else{ ?>
              <li>
                No record found
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>

        <div  class="dashboard-box">
            <div class="headline">
              <h3>Skill Details</h3>
            </div>
            <div class="content with-padding">
              <ul class="experience-list">
                <?php 
                   if(!empty($candidateSkill)){ 
                    foreach ($candidateSkill as $skillDetl) {
                ?>
                <li>
                  
                  <div class="experience-pos">Name - {{$skillDetl->skilldetails->skillName}}</div>
                    <div class="experience-company">Experience -{{$skillDetl->experienceYear}} Year(s)</div>
                    <div class="experience-company">Certificate - <?php if(!empty($skillDetl->skillCertificate)){?><a href="{{!empty($skillDetl->skillCertificate)?ROOT_URL.'/storage/app/uploads/candidateSkill/'.$skillDetl->skillCertificate:''}}" target="_blank">view</a><?php }else{echo 'None';}?></div>
                </li>
                <?php } }else{ ?>
                <li>
                  <div class="experience-pos">No record found</div>
                </li>
                <?php } ?>
              </ul>
            </div>
        </div>

      </div>
    </div>
    <!-- Footer -->
   
  </div>
</div>

@endsection
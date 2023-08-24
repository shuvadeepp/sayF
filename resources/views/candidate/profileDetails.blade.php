@extends('layouts.candidatelayout')
@section('page-content')

<div class="utf-dashboard-content-container-aera" data-simplebar>
  <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
    <div class="row">
      <div class="col-xl-12">
        <h3>Candidate Details</h3>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="javascript:void(0);">Home</a></li>
            <li>Candidate Details</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  @include('components.admin-msg-tap')
  <div class="utf-dashboard-content-inner-aera ">
    
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
                  <img class="profile-pic" src="{{(!empty($personalInfo->profileImage))?ROOT_URL.'/storage/app/uploads/candidateProfile/'.$personalInfo->profileImage:PUBLIC_PATH.'images/user-avatar-placeholder.png'}}" alt="" />
                </div>
              </div>
              <div class="col-xl-9 col-sm-8">
                <div class="utf-submit-field mb-0">
                  <h4 class="profile-name">{{$personalInfo->firstName}} {{$personalInfo->middleName}} {{$personalInfo->lastName}}</h4>
                  <p><i class="icon-material-outline-location-on"></i> {{$personalInfo->address}} </p>
                  <p>
                    <i class="icon-feather-phone"></i> {{$candMobile}} {{($personalInfo->secondMob)?' , '.$personalInfo->secondMob:''}}
                  </p>
                  <p>
                    <i class="icon-feather-mail"></i> {{$candEmail}}
                  </p>
                  <p>DOB : {{ (!empty($candDOB))?date('d M y', strtotime($candDOB)):''}}</p>
                  <?php if($personalInfo->candidateType==2){ ?>
                  <p>Experience : {{ calcTotalExp($workDetls)}}</p>
                  <?php } else {?>
                    <p>Experience : Fresher</p>
                    <?php } ?>
                  <p>CV : <a href="{{!empty($personalInfo->profileCV)?ROOT_URL.'/storage/app/uploads/candidateProfile/'.$personalInfo->profileCV:''}}" target="_blank"><span class="icon-line-awesome-file-pdf-o"></span> view</a></p>
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
                  if(count($educationdetls) > 0){ 
                    $Scorejson = json_decode(SCORE_TYPE, true);
                    $Mediumjson = json_decode(MEDIUM_TYPE, true);
                    foreach ($educationdetls as $educationdetl) {
                ?>
                <li>
                  
                  <div class="experience-pos"><!-- Class : --> <strong>{{$educationdetl->educationName}}</strong></div>
                  <?php if($educationdetl->boardName){ ?>
                    <div class="experience-company">Board : <strong>{{$educationdetl->boardName}}</strong></div>
                    <div class="experience-company">Medium : <strong>{{$Mediumjson[$educationdetl->medium]}}</strong></div>
                  <?php } else{?>                  
                    <div class="experience-company">Course : <strong>{{$educationdetl->course}}</strong></div>
                    <div class="experience-company">University : <strong>{{$educationdetl->university}}</strong></div>
                  <?php } ?>
                    <div class="experience-company">Score Type : <strong>{{$Scorejson[$educationdetl->scoreType]}}</strong></div>
                    <div class="experience-company">Score : <strong>{{$educationdetl->score}}</strong></div>
                    <div class="experience-company">Year of Passing : <strong>{{$educationdetl->passYear}}</strong></div>
                    <div class="experience-company">Certificate : <?php if(!empty($educationdetl->certificate)){?><a href="{{!empty($educationdetl->certificate)?ROOT_URL.'/storage/app/uploads/candidateEducation/'.$educationdetl->certificate:''}}" target="_blank">view</a><?php }else{echo '--';}?></div>
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
            <div class="row mb-4">
              <div class="col-12 mb-2">
                Disability Type
              </div>
              <?php 
                if(!empty($disablityTypes)){ 
                  foreach ($disablityTypes as $dtkey => $dtval) {
              ?>
              <div class="col-md-6 col-lg-4">
                <span class="disability-label">{{$dtval->disabilityName}}</span>
              </div>
              <?php } } ?>
            </div>
            <div class="row">
              <div class="col-12 mb-2">
                Documents Uploaded
              </div>
               <?php 
                if(!empty($docDetails)){ 
                  foreach ($docDetails as $dkey => $docs) {
              ?>
              <div class="col-md-6 col-lg-2">
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
                if(count($workDetls) > 0){ 
                  foreach ($workDetls as $workDetl) {
              ?>
              <li>
                <span class="experience-date">{{date("M Y",strtotime($workDetl->startYear))}} - <?php echo ($workDetl->currentJob > 0)?  'Current' : date("M Y",strtotime($workDetl->endYear)) ; ?></span>
                <div class="experience-pos">{{$workDetl->designation}}</div>
                <div class="experience-company">{{$workDetl->companyName}}</div>
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
                  if(count($skillDetls) > 0){ 
                    foreach ($skillDetls as $skillDetl) {
                ?>
                <li>
                  
                  <div class="experience-pos">Name - {{$skillDetl->skName}}</div>
                  
                    <div class="experience-company">Experience -{{$skillDetl->experienceYear}} Year(s)</div>
                    <div class="experience-company">Certificate -<?php if(!empty($skillDetl->skillCertificate)){?><a href="{{!empty($skillDetl->skillCertificate)?ROOT_URL.'/storage/app/uploads/candidateSkill/'.$skillDetl->skillCertificate:''}}" target="_blank">view</a><?php }else{echo '--';}?></div>
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
    </div>
    <!-- Footer -->
   
  </div>
</div>

@endsection
@extends('layouts.employerlayout')
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
        <p class="mb-2">Candidate Profile for</p>
        <h2 class="profile-header-heading mb-2">
           {{$jobData->jobdetail->jobTitle}} [ {{$jobData->jobdetail->jobtype->jobtypeName}} ]
        </h2>
        <span class="profile-header-location">{{ $jobData->jobdetail->jobLocation }}</span>
      </div>
      <div class="text-right align-self-end">
        <div class="applicant-no mb-3">{{$candidateapplied}} Applicants</div>
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
                  <img class="profile-pic" src="<?php echo STORAGE_PATH; ?>candidateProfile/{{  $jobData->candidatedetail->profileImage }}" alt="" />
                  <!-- <div class="upload-button"></div> -->
                  <!-- <input class="file-upload" type="file" accept="image/*" /> -->
                </div>
              </div>
              <div class="col-xl-9 col-sm-8">
                <div class="utf-submit-field mb-0">
                  <h4 class="profile-name">{{$jobData->candidatedetail->firstName}} {{$jobData->candidatedetail->middleName}} {{$jobData->candidatedetail->lastName}}</h4>
                  <p><i class="icon-material-outline-location-on"></i> {{$jobData->candidatedetail->address}} </p>
                  <p>
                    <i class="icon-feather-phone"></i> {{$jobData->candidateuser->mobileNo}} , {{$jobData->candidatedetail->secondMob}}
                  </p>
                  <p>
                    <i class="icon-feather-mail"></i> {{$jobData->candidateuser->emailId}}
                  </p>
                  <p>DOB : {{ (!empty($jobData->candidateuser->DOB))?date('d M y', strtotime($jobData->candidateuser->DOB)):''}}</p>
                  <?php if($jobData->candidatedetail->candidateType==2){ ?>
                    <p>Experience : {{ calcTotalExp($jobData->candidatedetail->candidateexp)}}</p>
                    <?php } else {?>
                      <p>Experience : Fresher</p>
                      <?php } ?>
                  <p>CV : <a href="{{!empty($jobData->candidatedetail->profileCV)?ROOT_URL.'/storage/app/uploads/candidateProfile/'.$jobData->candidatedetail->profileCV:''}}" target="_blank"><span class="icon-line-awesome-file-pdf-o"></span> view</a></p>
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
                //echo "<pre>";print_r($jobData->candidatedetail->education);exit;
                  if(!empty($jobData->candidatedetail->education)){ 
                    $Scorejson = json_decode(SCORE_TYPE, true);
                    $Mediumjson = json_decode(MEDIUM_TYPE, true);
                    foreach ($jobData->candidatedetail->education as $educationdetl) {
                ?>
                <li>
                  
                  <div class="experience-pos"><!-- Class : --> <strong>{{$educationdetl->educationytpe->educationName}}</strong></div>
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
                if(!empty($jobData->candidatedetail->disabilitydocs)){ 
                  foreach ($jobData->candidatedetail->disabilitydocs as $dkey => $docs) {
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
                if(!empty($jobData->candidatedetail->candidateexp)){ 
                  foreach ($jobData->candidatedetail->candidateexp as $exp) {
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
                   if(!empty($jobData->candidatedetail->skill)){ 
                    foreach ($jobData->candidatedetail->skill as $skillDetl) {
                ?>
                <li>
                  
                  <div class="experience-pos">Name - {{$skillDetl->skilldetails->skillName}}</div>
                    <div class="experience-company">Experience -{{$skillDetl->experienceYear}} Year(s)</div>
                    <div class="experience-company">Certificate - <?php if(!empty($skillDetl->skillCertificate)){?><a href="{{!empty($skillDetl->skillCertificate)?ROOT_URL.'/storage/app/uploads/candidateSkill/'.$skillDetl->skillCertificate:''}}" target="_blank">view</a><?php }else{echo '--';}?></div>
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
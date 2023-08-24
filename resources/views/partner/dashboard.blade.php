@extends('layouts.partnerlayout')
@section('page-content')
<!-- Dashboard Container -->
<!-- <div class="utf-dashboard-container-aera">  -->
<!-- Dashboard Content -->
<div class="utf-dashboard-content-container-aera" data-simplebar>
  <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
    <div class="row">
      <div class="col-xl-12">
        <h3>Dashboard</h3>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}/ngo/dashboard">Home</a></li>
            <li>Dashboard</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  @include('components.admin-msg-tap')
  <div class="utf-dashboard-content-inner-aera">
    
    <div class="row">
      <div class="col-lg-2">
        <div class="utf-funfacts-container-aera d-block">
          <div class="fun-fact" data-fun-fact-color="#2a41e8">
            <div class="fun-fact-icon"><i class="icon-material-outline-movie"></i></div>
            <div class="fun-fact-text">
            <h4><?php echo !empty($JobViewsLast7days)?$JobViewsLast7days[0]->ngo7days:0; ?></h4>
              <span>Page Views <small>(Last 7 Days)</small></span>
            </div>
          </div>
          <div class="fun-fact" data-fun-fact-color="#36bd78">
            <div class="fun-fact-icon"><i class="icon-line-awesome-street-view"></i></div>
            <div class="fun-fact-text">
                  <h4><?php echo !empty($JobViews)?$JobViews[0]->ngoall:0; ?></h4>
                <span>Page Views <small>(Till Date)</small></span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-10">
        <div class="dashboard-box">
          <div class="headline">
            <h3>Message</h3>
          </div>
          <div class="content">
               <?php if(count($messageThreads) > 0){ ?>
            <ul class="utf-dashboard-box-list scroll-table">
                <?php 
                    $candidatelogodirpath  = STORAGE_PATH.'candidateProfile';
                    $partnerlogodirpath    = STORAGE_PATH.'partnerlogo';
                    $chartFilepath         = STORAGE_PATH.'chatFiles';    
                    foreach ($messageThreads as $ks => $vs) {
                        $leng          = count($vs->msgconv);
                        $lastMsg     = ($vs->msgconv[$leng-1]->msgText)?$vs->msgconv[$leng-1]->msgText:'Attachment';

                        $lastTime    = $vs->msgconv[$leng-1]->createdOn;
                        if($vs->respOne != session('partner_session_data.userId')){
                          if($vs->sender->tinUserType == 2){
                             $receiverId    = ($vs->sender->employer->employerId)?$vs->sender->employer->employerId:0;
                              $name          = (@$vs->sender->employer->employerCompany)?@$vs->sender->employer->employerCompany:'';
                              $img           = (@$vs->sender->employer->companyLogo)?@$vs->sender->employer->companyLogo:'';
                              if(Storage::disk('local')->exists('/uploads/companylogo/' . $img) && $img != ''){
                              $logofullpath= @$employerlogodirpath.'/'.$img;
                              }else{
                              $logofullpath= PUBLIC_PATH.'images/user-avatar-placeholder.png';
                              }
                          }else if($vs->sender->tinUserType == 3){
                            $receiverId    = ($vs->sender->candidate->userId)?$vs->sender->candidate->userId:0;
                            if($vs->sender->candidate->middleName != ''){
                              $name          = $vs->sender->candidate->firstName.' '.$vs->sender->candidate->middleName.' '.$vs->sender->candidate->lastName;
                            }else{
                              $name          = $vs->sender->candidate->firstName.' '.$vs->sender->candidate->lastName;
                            }
                            $img           = ($vs->sender->candidate->profileImage)?$vs->sender->candidate->profileImage:'';
                           
                          if(Storage::disk('local')->exists('/uploads/candidateProfile/' . $img) && $img != ''){
                              $logofullpath = $candidatelogodirpath.'/'.$img;
                            
                            }else{
                              $logofullpath = PUBLIC_PATH.'images/user-avatar-placeholder.png';
                            }
                          }
                       
                        }else{
                          if($vs->receiver->tinUserType == 2){
                          $receiverId    = ($vs->receiver->employer->employerId)?$vs->receiver->employer->employerId:0;
                          $name          = (@$vs->receiver->employer->employerCompany)?@$vs->receiver->employer->employerCompany:'';
                          $img           = (@$vs->receiver->employer->companyLogo)?@$vs->receiver->employer->companyLogo:'';
                          if(Storage::disk('local')->exists('/uploads/companylogo/' . $img) && $img != ''){
                          $logofullpath= $employerlogodirpath.'/'.$img;
                          }else{
                          $logofullpath= PUBLIC_PATH.'images/user-avatar-placeholder.png';
                          }
                          }else if($vs->receiver->tinUserType == 3){
                            $receiverId  = ($vs->receiver->candidate->userId)?$vs->receiver->candidate->userId:0;
                            if($vs->receiver->candidate->middleName != ''){
                              $name          = $vs->receiver->candidate->firstName.' '.$vs->receiver->candidate->middleName.' '.$vs->receiver->candidate->lastName;
                            }else{
                              $name          = $vs->receiver->candidate->firstName.' '.$vs->receiver->candidate->lastName;
                            }
                            $img         = ($vs->receiver->candidate->profileImage)?$vs->receiver->candidate->profileImage:'';
                          
                              if(Storage::disk('local')->exists('/uploads/candidateProfile/' . $img) && $img != ''){
                              $logofullpath = @$candidatelogodirpath.'/'.$img;
                            }else{
                              $logofullpath = PUBLIC_PATH.'images/user-avatar-placeholder.png';
                            }
                          }
                        }
                      ?>
              <li>
                <div class="utf-job-listing">
                  <div class="utf-job-listing-details">
                    <a href="#" class="utf-job-listing-company-logo"> <img src="<?php echo @$logofullpath; ?>" alt=""> </a>
                    <div class="utf-job-listing-description">
                      <div class="d-flex justify-content-between">
                        <h4 class="utf-job-listing-title">{{@$name}} <!-- <small class="badge badge-primary rounded-circle px-2">6</small> --> </h4>
                        
                      </div>
                          <span class="message-short-content"><a href="{{ROOT_URL.'/ngo/messages/index/'.encrypt($receiverId)}}"> {{@$lastMsg}}</a></span>
                      <div class="utf-job-listing-footer">
                        <ul>
                          <li><i class="icon-material-outline-access-time"></i>{{@date('h:iA',strtotime($lastTime))}}</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
                <?php } ?>
             <!--  <li>
                <div class="utf-job-listing">
                  <div class="utf-job-listing-details">
                    <a href="#" class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_2.png" alt=""> </a>
                    <div class="utf-job-listing-description">
                      <div class="d-flex justify-content-between">
                        <h4 class="utf-job-listing-title">Samir Mohapatra <small class="badge badge-primary rounded-circle px-2">4</small> </h3>
                        
                      </div>
                      <div class="utf-job-listing-footer">
                        <ul>
                          <li><i class="icon-material-outline-access-time"></i> 45 Minute Ago</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                
              </li>
              <li>
                <div class="utf-job-listing">
                  <div class="utf-job-listing-details">
                    <a href="#" class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_3.png" alt=""> </a>
                    <div class="utf-job-listing-description">
                      <div class="d-flex justify-content-between">
                        <h4 class="utf-job-listing-title">Samir Mohapatra <small class="badge badge-primary rounded-circle px-2">1</small> </h3>
                        
                      </div>
                      <div class="utf-job-listing-footer">
                        <ul>
                          <li><i class="icon-material-outline-access-time"></i> 1 Days Ago</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                
              </li>
              <li>
                <div class="utf-job-listing">
                  <div class="utf-job-listing-details">
                    <a href="#" class="utf-job-listing-company-logo"> <img src="<?php echo PUBLIC_PATH; ?>images/company_logo_4.png" alt=""> </a>
                    <div class="utf-job-listing-description">
                      <div class="d-flex justify-content-between">
                        <h4 class="utf-job-listing-title">Samir Mohapatra <small class="badge badge-primary rounded-circle px-2">3</small> </h3>
                        
                      </div>
                      <div class="utf-job-listing-footer">
                        <ul>
                          <li><i class="icon-material-outline-access-time"></i> 2 Days Ago</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                
              </li> -->
              
            </ul>
              <?php }else{ ?>
              <div class="no-data bor-none">No message</div>
              <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Dashboard Content End -->
</div>
@section('page-js')
<script
>
$(document ).ready(function() {
var userid='<?php echo SESSION('partner_session_data.userId');?>';
loadnotifiation(userid,3);
});
</script>
@endsection
@endsection
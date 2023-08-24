  @extends('layouts.employerlayout')
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
              <li><a href="{{ROOT_URL}}/employer/dashboard">Home</a></li>
              <li>Dashboard</li>
            </ul>
          </nav>
        </div>
      </div>    
    </div>
     @include('components.admin-msg-tap')
    <div class="utf-dashboard-content-inner-aera">   

      <div class="utf-funfacts-container-aera">
        <div class="fun-fact" data-fun-fact-color="#2a41e8">
          <div class="fun-fact-icon"><i class="icon-feather-home"></i></div>
          <div class="fun-fact-text"> 
            <h4><?php echo !empty($JobViewsLast7days)?$JobViewsLast7days[0]->viewscounter7days:0; ?></h4>
            <span>Job Views <small>(Last 7 Days)</small></span>
          </div>            
        </div>
        <div class="fun-fact" data-fun-fact-color="#36bd78">
          <div class="fun-fact-icon"><i class="icon-feather-briefcase"></i></div>
          <div class="fun-fact-text"> 
            <h4><?php echo !empty($JobViews)?$JobViews[0]->viewscounter:0; ?></h4>
             <span>Job Views <small>(Till Date)</small></span>
          </div>            
        </div>
        <div class="fun-fact" data-fun-fact-color="#efa80f">
          <div class="fun-fact-icon"><i class="icon-feather-heart"></i></div>
          <div class="fun-fact-text"> 
            <h4><?php echo !empty($candidateappliedlast7days)?$candidateappliedlast7days[0]->candidatlast7days:0; ?></h4>
            <span>Candidates Applied<small>(Last 7 Days)</small></span>
          </div>            
        </div>
        <div class="fun-fact" data-fun-fact-color="#0fc5bf">
          <div class="fun-fact-icon"><i class="icon-brand-telegram-plane"></i></div>
          <div class="fun-fact-text"> 
            <h4><?php echo !empty($candidateappliedall)?$candidateappliedall[0]->candidateapplied:0; ?></h4>
          <span>Candidates Applied<small>(Till Date)</small></span>
          </div>            
        </div>
        <div class="fun-fact" data-fun-fact-color="#f02727">
          <div class="fun-fact-icon"><i class="icon-feather-trending-up"></i></div>
          <div class="fun-fact-text"> 
            <h4><?php echo !empty($expiringlast7days)?$expiringlast7days[0]->expiring7days:0; ?></h4>
            <span>Job Expiring <small>(In 7 Days)</small></span>
          </div>            
        </div>
      </div>


      <div class="row"> 
        <div class="col-12 col-lg-8">
          <div class="dashboard-box margin-top-0"> 
            <div class="headline">
              <h3>Job Status</h3>
            </div>
            <div class="content">
              <?php if(count($arrAllRecords)>0){ ?>
              <ul class="utf-dashboard-box-list">
                <?php
                  foreach ($arrAllRecords as $row){
                    $skills = '';
                    if(!empty($row->jobskills)){
                      foreach ($row->jobskills as $key => $value) {

                        $skills .= !empty($value->skillname->skillName)?$value->skillname->skillName:''.',';
                      }
                    }
                    $skills = rtrim($skills,',');

                    $locations = '';
                    if(!empty($row->joblocations)){
                      foreach ($row->joblocations as $key => $value) {
                        $locations .= $value->location->location.',';
                      }
                    }
                    $locations = rtrim($locations,',');
                ?>
                <li> 
                  <div class="utf-job-listing row"> 
                    <!-- <div class=""> -->
                      <div class="col-xl-8">
                        <div class="utf-job-listing-details"> 
                          <a href="#" class="utf-job-listing-company-logo"> <img src="<?php echo (!empty($row->employer->companyLogo))?STORAGE_PATH.'/companylogo/'.$row->employer->companyLogo:PUBLIC_PATH.'images/no-logo-images.png'; ?>" alt=""> </a> 
                          <div class="utf-job-listing-description">
                            <?php if($row->job_status == 2){ ?> 
                              <span class="dashboard-status-button utf-status-item red">Rejected</span>
                            <?php }else if($row->job_status == 0){ ?> 
                              <span class="dashboard-status-button utf-status-item red">Under Review</span>
                            <?php }else{ ?>
                            <?php if(strtotime($row->jobStartDate)>strtotime(date("Y-m-d"))){ ?>
                              <span class="dashboard-status-button utf-status-item red">In-active</span>
                            <?php }else if(strtotime(date("Y-m-d") >= strtotime($row->jobStartDate)) && strtotime(date("Y-m-d")) <= strtotime(date("d M Y",strtotime("-5 day", strtotime($row->jobExpiryDate))))){ ?>
                              <span class="dashboard-status-button utf-status-item yellow">Expiring Soon</span>
                            <?php }else if(strtotime(date("Y-m-d")) >= strtotime($row->jobStartDate) && strtotime(date("Y-m-d")) <= strtotime($row->jobExpiryDate)){ ?>
                              <span class="dashboard-status-button utf-status-item green">Active</span>
                            <?php }else if(strtotime($row->jobExpiryDate) < strtotime(date("Y-m-d"))){ ?>
                              <span class="dashboard-status-button utf-status-item red">Expired</span>
                            <?php }/*else{ ?> 
                              <span class="dashboard-status-button utf-status-item red">Expired</span>
                            <?php }*/ ?>
                            <?php } ?>
                            <div class="d-flex justify-content-between">
                              <h3 class="utf-job-listing-title">{{$row->jobTitle}}</h3>
                            </div>
                            <div class="utf-job-listing-footer">
                             <ul>
                                <li><i class="icon-material-outline-account-balance-wallet"></i><span class="icon-line-awesome-inr"></span>{{ indianCurrency($row->minSalary) }} -<span class="icon-line-awesome-inr"></span>{{ indianCurrency($row->maxSalary) }}</li>
                                <li><i class="icon-material-outline-location-on"></i> {{$locations}}</li>
                                <li><i class="icon-material-outline-access-time"></i> {{ date("d M Y",strtotime($row->jobStartDate)) }}</li>
                                <li style="display: none;"><i class="icon-material-outline-access-time"></i> {{ date("d M Y",strtotime($row->jobExpiryDate)) }}</li>
                                <li><i class="icon-feather-star"></i> Skills: {{ $skills }}</li>
                                <li><i class="icon-line-awesome-user"></i>Min Experience: {{$row->minExp}} Year(s)</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 d-flex align-items-center justify-content-end">
                        <a href="{{ROOT_URL}}/employer/job/jobpreview/{{$row->jobId}}"><span class="dropdown-handle icon-material-outline-visibility"></span></a>
                        <!-- <?php /*
                          if($row->candidateapplied > 0){
                             $href = ROOT_URL.'/employer/job/candidateapplied/'.$row->jobId; 
                           }else{ 
                             $href ="javascript:void(0)";
                           }*/
                        ?> 
                        <a href="{{@$href}}" class="btn btn-secondary ml-2">Candidate Applied({{$row->candidateapplied}})</a> -->
                      </div>
                    <!-- </div> -->
                  </div>
                </li>
                <?php } ?>
                
              </ul>  
              <?php }else{ ?>
                <div class="col-xl-12 d-flex justify-content-center align-items-center">
                  <div class="no-data bor-none mb-0">No job posted yet</div>
                </div>
              <?php } ?>     
            </div>
          </div>
          <!-- Pagination -->
          <?php if (count($arrAllRecords) > 0) { ?>
          <input name="hdn_IsViewAll" id="hdn_IsViewAll" type="hidden">
          <?php
              if(count($arrAllRecords) > 0) {
                paginataion($arrAllRecords,$startrec); 
              }
            }
          ?>   
          <div class="clearfix"></div>
        </div>          
      
        <div class="col-xl-4 col-12">
          <div class="dashboard-box">
            <div class="headline">
              <h3>Message</h3>                
            </div>
            <div class="content">

              <?php if(count($getMessageThread) > 0){ ?>
              <ul class="utf-dashboard-box-list">
                <?php 
                    $candidatelogodirpath  = STORAGE_PATH.'candidateProfile';
                    $partnerlogodirpath    = STORAGE_PATH.'partnerlogo';
                    $chartFilepath         = STORAGE_PATH.'chatFiles';    
                    foreach ($getMessageThread as $ks => $vs) {
                        $leng          = count($vs->msgconv);
                        $lastMsg     = ($vs->msgconv[$leng-1]->msgText)?$vs->msgconv[$leng-1]->msgText:'Attachment';
                        $lastTime    = $vs->msgconv[$leng-1]->createdOn;
                        if($vs->respOne != session('employer_session_data.userId')){
                          if($vs->sender->tinUserType == 4){
                            $receiverId    = ($vs->sender->partner->partnerId)?$vs->sender->partner->partnerId:0;
                            $name          = ($vs->sender->partner->partnerName)?$vs->sender->partner->partnerName:'';
                            $img           = ($vs->sender->partner->companyLogo)?$vs->sender->partner->companyLogo:'';
                           
                              if(Storage::disk('local')->exists('/uploads/partnerlogo/' . $img) && $img != ''){
                              $logofullpath= $partnerlogodirpath.'/'.$img;
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
                          if($vs->receiver->tinUserType == 4){
                            $receiverId    = ($vs->receiver->partner->partnerId)?$vs->receiver->partner->partnerId:0;
                            $name          = ($vs->receiver->partner->partnerName)?$vs->receiver->partner->partnerName:'';
                            $img           = ($vs->receiver->partner->companyLogo)?$vs->receiver->partner->companyLogo:'';
                          if(Storage::disk('local')->exists('/uploads/partnerlogo/' . $img) && $img != ''){
                              $logofullpath= $partnerlogodirpath.'/'.$img;
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
                              $logofullpath = $candidatelogodirpath.'/'.$img;
                            }else{
                              $logofullpath = PUBLIC_PATH.'images/user-avatar-placeholder.png';
                            }
                          }
                        }
                      ?>
                    
                      <li>
                     
                        <div class="utf-job-listing"> 
                          <div class="utf-job-listing-details"> 
                            <a href="#" class="utf-job-listing-company-logo"> <img src="<?php echo $logofullpath; ?>" alt=""> </a> 
                            <div class="utf-job-listing-description">
                              <div class="d-flex justify-content-between">
                                <h4 class="utf-job-listing-title">{{$name}} <!-- <small class="badge badge-primary rounded-circle px-2">6</small> --> </h4>
                                
                              </div>

                                  <span class="message-short-content"> <a href="{{ROOT_URL.'/employer/messages/index/'.encrypt($receiverId)}}"> {{@$lastMsg}}</a></span>
                              <div class="utf-job-listing-footer">
                                <ul>
                                  <li><i class="icon-material-outline-access-time"></i> {{@date('h:iA',strtotime($lastTime))}}</li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      
                      </li>
                       
                    <?php } ?>
                  
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
       var userid='<?php echo SESSION('employer_session_data.userId');?>';
      loadnotifiation(userid,1);
      });

  </script>
  @endsection
  @endsection
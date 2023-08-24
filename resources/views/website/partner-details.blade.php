@extends('layouts.website')
@section('page-content')

<!-- Titlebar -->
<div id="titlebar" class="gradient">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>NGO Details</h2>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}">Home</a></li>
            <li>NGO Details</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="section padding-top-60 padding-bottom-60">
  <div class="container">
    <div class="row">
      <div class="col-12 col-xl-8">
        <div class="utf-sidebar-widget-item">
          <div class="recruiter">
            <div class="recruiter__img">
              <img src="<?php echo STORAGE_PATH; ?>partnerlogo/{{ @$partDetls->companyLogo }}" alt="">
            </div>
            <div class="recruiter__details">
              <h4>{{ @$partDetls->partnerCompany }}</h4>
              <p> {{@$partDetls->locationName}}</p>
              <h4>Introduction:</h4>
              <p>{{@$partDetls->partnerCompanyintro}}</p>

              <h4>Service offered:</h4>
              <?php echo htmlspecialchars_decode($partDetls->partnerServiceOffered,ENT_QUOTES);?>
              <?php 
                  if(!empty($partDetls->partnerService)){
              ?>
              <div class="recruiter__serices-list">
                <h3>Services</h3>
                <div class="task-tags">
                  <?php
                    foreach(explode(',', $partDetls->serviceName) as $key => $value) { ?>
                  <a href="#"><span>{{$value}} </span></a>
                  <?php } ?>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
          <div class="recruiter-action justify-content-between">
            <div class="">
              <h4><i class="icon-feather-user"></i> {{$partDetls->partnerName}}</h4>
              <h5 class="trans-text">{{$partDetls->partnerDesignation}}</h5>
              <h5 class="trans-text">{{$partDetls->partnerCompany}}</h5>
            </div>
            <div class="recruiter__sendMsg">
              <a href="{{($partDetls->partnermobile)?'tel:'.$partDetls->partnermobile:'javascript:void(0);'}}" class="btn line-btn btn-primary text-center mb-2">Contact</a>
                   <input type="hidden" id="encpartnerId" value="<?php echo encrypt($partDetls->partnerId) ?>">
              <?php 
                $senderId = 0;
                $type     = 0;
                if(!empty(SESSION('candidate_session_data.userId'))){
                  $type     = 1;
                  $senderId = SESSION('candidate_session_data.userId');
                }else if(!empty(SESSION('employer_session_data.userId'))){
                  $type     = 2;
                  $senderId = SESSION('employer_session_data.userId');
                }
               
                //$senderId = ?SESSION('candidate_session_data.userId'):
              ?>

       <?php if($type==1 || $type==2 ){//echo $senderId,$type;?>
              <a href="javascript:void(0);" onclick="return sendmessage(<?php echo $senderId;?>,<?php echo $type;?>);" class="btn line-btn btn-secondary text-center">Send Message</a>
            <?php } ?>
           
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@section('page-js')
<script
>
  function sendmessage(senderId,type)
  {
     var encpartnerId=$("#encpartnerId").val();
     if(senderId==0){
      $('.cand').magnificPopup().magnificPopup('open');
    }else{
      if(type == 1){
        window.location = SITE_URL+"/candidate/message/index/"+encpartnerId;
      }else if(type == 2){
        window.location = SITE_URL+"/employer/messages/index/"+encpartnerId;
      }
    }

  }
</script>
@endsection
@endsection
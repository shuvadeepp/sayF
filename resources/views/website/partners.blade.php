@extends('layouts.website')
@section('page-content')

<!-- Titlebar -->
<div id="titlebar" class="gradient">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>Non-Governmental Organization</h2>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}">Home</a></li>
            <li>Non-Governmental Organization</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="container container--partners">
  <div class="row">
    <?php if($existingProfile->isNotEmpty()){ ?>
    
       <div class="utf-companies-list-aera">
      <!-- <div class="col-xl-12 text-right">
        <a class="btn btn-primary d-inline-block mb-4 popup-with-zoom-anim partnerlogin" href="#small-dialog-2">NGO Login</a>
      </div> -->
      <div class="col-xl-12">
        <div class="row">  
             
          <?php   foreach ($existingProfile as $row){ ?>
          <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="utf-company-inner-alignment">
              <div class="company">
                <span class="company-logo"><img src="<?php echo STORAGE_PATH; ?>partnerlogo/{{ $row->companyLogo }}" alt=""></span>
                <h4>{{ $row->partnerName }}</h4>
                <p class="text-muted"><i class="icon-material-outline-location-on"></i> {{ $row->location }}</p>
                <p><?php echo htmlspecialchars_decode(wardWrap($row->partnerCompanyintro, 250),ENT_QUOTES);?></p>
                  <ul class="selected-services">
                <?php 
                  if(!empty($row->partnerService)){
                          foreach(explode(',', $row->serviceName) as $key => $value) {?>
              
                  <li><a href="#!" ><?php echo $value; ?></a> </li>
              <?php } } ?>
              </ul>
              </div>              
              <a href="{{ROOT_URL}}/ngo/details/{{encrypt($row->profileId)}}" class="stretched-link"></a>
            </div>            
          </div>
        <?php } ?>

        </div>
      </div>
   
    </div>
    <?php } else { ?>
      <div class="no-data">
        <p>No NGO available</p>
      </div>
    <?php } ?>
  </div>
</div>

@endsection

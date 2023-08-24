@extends('layouts.candidatelayout')
@section('page-content')
@section('page-css')
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/jquery-ui.css">
@endsection
<!-- candidateProfile -->
<div class="utf-dashboard-content-container-aera" data-simplebar>
  <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
    <div class="row">
      <div class="col-xl-12">
        <h3>Candidate Profile</h3>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}/candidate/dashboard">Home</a></li>
            <li>Candidate Profile</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <!-- Page Content -->
  <div class="utf-dashboard-content-inner-aera">

    <div class="dashboard-box d-flex justify-content-center align-items-center success-sec">
     <div class="success-sec-content">
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
        <circle class="path circle" fill="none" stroke="#25a144" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
        <polyline class="path check" fill="none" stroke="#25a144" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
      </svg>
        <p class="margin-top-40">Profile Updated Successfully</p>
        <a href="{{ROOT_URL}}/candidate/candidatedetails/view/{{encrypt(SESSION('candidate_session_data.userId'))}}" title="Next" class="btn btn-primary utf-ripple-effect-dark">Preview</a>
     </div>
     
    </div>
    

  </div>
  <!-- Page Content ends -->
</div>
</div>

@endsection
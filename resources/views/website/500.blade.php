@extends('layouts.website')
@section('page-content')
<div class="page-wrapper align-items-center d-flex">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-xl-9">
        <section id="utf-not-found-item" class="center">
          <div class="utf-error-img"><img src="<?php echo PUBLIC_PATH; ?>images/500_error.svg" alt=""></div>
          <h1>Internal Server Error</h1>
          <p>Retry the web page by clicking the refresh/reload button or trying the URL from the address bar again</p>
          <div class="utf-centered-button">
          <a href="{{ROOT_URL}}" class="button ripple-effect big margin-top-10 margin-bottom-20">Back to Home</a>
          </div>
        </section>        
      </div>
    </div>
  </div>  
</div>
<script src="{{ asset('public/js/validatorchklist.js') }}"></script>
@endsection

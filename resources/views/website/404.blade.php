@extends('layouts.website')
@section('page-content')
<div class="page-wrapper align-items-center d-flex">
	<div class="container">
    <div class="row justify-content-between">
      <div class="col-xl-9">
        <section id="utf-not-found-item" class="center">
          <div class="utf-error-img"><img src="<?php echo PUBLIC_PATH; ?>images/404_error.svg" alt=""></div>
          <h1>Page Not Found</h1>
          <p>Oops!!!! you tried to access a page which is not available. go back to Home</p>
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

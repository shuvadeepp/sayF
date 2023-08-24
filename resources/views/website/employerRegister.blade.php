@extends('layouts.website')
@section('page-content')
<div class="page-wrapper align-items-center d-flex">
	<div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3">
        <div class="utf-login-register-page-aera margin-bottom-50"> 
          <div class="utf-welcome-text-item">
            <h3>Create Your New Account!</h3>
            <span>Already Have an Account? <a href="#!">Log In!</a></span> 
      </div>
          <div class="utf-account-type">
            <div>
              <a href="http://192.168.103.209:8080/the-say-foundation/employerRegister"></a>
                <input type="radio" name="utf-account-type-radio" id="freelancer-radio" class="utf-account-type-radio" checked="">
              <label for="freelancer-radio" data-tippy-placement="top" class="utf-ripple-effect-dark" data-tippy="" data-original-title="Employer"><i class="icon-material-outline-business-center"></i> Employer</label>
            </div>
            <div>
              <a href="http://192.168.103.209:8080/the-say-foundation/employeeRegister"></a>
                <input type="radio" name="utf-account-type-radio" id="employer-radio" class="utf-account-type-radio">
                <label for="employer-radio" data-tippy-placement="top" class="utf-ripple-effect-dark" data-tippy="" data-original-title="Candidate"><i class="icon-material-outline-account-circle"></i> Candidate</label>
            </div>
          </div>
          
          <form method="post" id="utf-register-account-form">
            <div class="utf-no-border">
                <input type="text" class="utf-with-border" name="" 
 placeholder="Name" required="" autocomplete="off">
              </div>
              <div class="utf-no-border">
                <input type="text" class="utf-with-border" name="" 
 placeholder="Company Name" required="" autocomplete="off">
              </div>
              <div class="utf-no-border">
                <input type="text" class="utf-with-border" name="" 
 placeholder="Email Address" required="" autocomplete="off">
              </div>
              <div class="utf-no-border">
                <input type="text" class="utf-with-border" name="" 
 placeholder="Phone Number" required="" autocomplete="off">
              </div>
              <div class="utf-input-with-icon show-password">
                <input type="password" class="utf-with-border" name="password" id="password" placeholder="Password" required="">
                <i class="icon-feather-eye "></i>
              </div>
              <div class="checkbox mb-3">
                <input type="checkbox" id="two-step2">
                <label for="two-step2"><span class="checkbox-icon"></span> By Registering You Confirm That You Accept <a href="#">Terms &amp; Conditions</a></label>
                </div>
          </form>
          <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit" style="width: 545px;">Register Now<i class="icon-feather-chevrons-right"></i></button>
        </div>
      </div>
    </div>

  </div>  
</div>
<script src="{{ asset('public/js/validatorchklist.js') }}"></script>
@endsection

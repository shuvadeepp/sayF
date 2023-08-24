@extends('layouts.website')
@section('page-content')
<div class="page-wrapper align-items-center d-flex">
  <div class="container">
    <div class="row">
       <?php if($status==0){?>
      <div class="col-xl-6 offset-xl-3">
        <div class="utf-login-register-page-aera margin-bottom-50"> 
          @include('components.admin-msg-tap')
          <div class="utf-welcome-text-item mb-5">
            <h3 class="mb-2">Verify OTP</h3>
              <?php if($reenter==0){ ?>
            <p>Enter the 4-digit OTP you received in your Email.</p>
          <?php } ?>
          </div>
          
         
          <form method="post" id="reset-form" autocomplete="off">
            {{csrf_field()}}
              <div class="otp-container">
                <div class="otp-box">
                  <input type="text" maxlength="4" class="otp-input-field" maxlength="32" name="otppartner" id="otppartner" placeholder="">
                   <span class="errMsg_otppartner errDiv"></span>
                </div>
              </div>

              <div class="text-center">
                <p>Didn't receive OTP? <a href="javascript:void(0);" onclick="resendotp()">Resend OTP</a></p>
              </div>
              
          </form>
          <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit" style="width: 545px;" onclick="return validator();">Verify<i class="icon-feather-chevrons-right"></i></button>
          <input type="hidden" value="<?php echo  !empty($getPartnerData[0]['userId'])?$getPartnerData[0]['userId']:'';?>" id="userid">
        </div>
      </div>
       <?php }?>
    </div>

  </div>  
</div>
@section('page-js')
<script
>
   var status='<?php echo $status;?>';
  $(document ).ready(function() {
   $.magnificPopup.defaults.closeOnBgClick = false;
    if(status==1){

      $('.partnerlogin').magnificPopup().magnificPopup('open');
    }
  
  });
    $(document).on("click",".mfp-close",function(){
      window.location = SITE_URL+"/";
     });
  // OTP Field
  var obj = document.getElementById('otppartner');
  obj.addEventListener('keydown', stopCarret); 
  obj.addEventListener('keyup', stopCarret); 

  function stopCarret() {
    if (obj.value.length > 3){
      setCaretPosition(obj, 3);
    }
  }

  function setCaretPosition(elem, caretPos) {
      if(elem != null) {
          if(elem.createTextRange) {
              var range = elem.createTextRange();
              range.move('character', caretPos);
              range.select();
          }
          else {
              if(elem.selectionStart) {
                  elem.focus();
                  elem.setSelectionRange(caretPos, caretPos);
              }
            
                  // elem.focus();
          }
      }
  }


 
  function validator()
  {
      $('.errDiv').hide();
      $('.error-input').removeClass('error-input');
       if (!blankCheck('otppartner', 'OTP can not be left blank'))
          return false;
      $('#reset-form').submit();  
        
  }

  $('#resendotp').on("keyup", function(e){
  alert(1);
  });
  function resendotp()
  {
   var  userid=$("#userid").val();
      $.ajax({
          type: 'POST',
          url: SITE_URL + "/website/ajax/resendOtp",
          data: {userid,userid},
          dataType: "json",
          async: false,
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (res) {
             if(res.status=200)
             {
              viewAlert(res.msg);
             }
          }
      });
  }
</script>
@endsection
@endsection

@extends('layouts.website')
@section('page-content')

<!-- <div class="page-wrapper"> -->

<!-- Latest Jobs -->
<div class="container">
  <div class="inner-page-baner">
    <?php if(isset($banners) && $banners->isNotEmpty()){ ?>
    <img
      src="<?php if(!empty($banners[0]->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banners[0]->bannerImage; } else{ echo PUBLIC_PATH.'images/contact-us.png'; } ?>"
      class="d-block" alt="banner">
    <div class="inner-page-baner-content">
      <strong>{{$banners[0]->bannerTitle}}</strong> - <br> {{$banners[0]->bannerText}}
    </div>
    <?php } else { ?>
    <img src="<?php echo PUBLIC_PATH; ?>images/contact-us.png" class="d-block" alt="banner">
    <div class="inner-page-baner-content">
      <strong>Contact us</strong> - <br>
      We love listening to you
    </div>
    <?php } ?>
  </div>
  <div class="row justify-content-center mb-3">
    <div class="col-lg-6">
      <section id="contact">
        <!-- <h3 class="mb-3 text-primary">Contact</h3> -->
        <div class="utf-contact-form-item pb-4">
          <div class="col-12 mt-3">
            <div class="cfRes cfSuccessResponse notification success closeable" style="display: none;">
              <p></p><a class="close"></a>
            </div>
            <div class="cfRes cfErrorResponse notification error closeable" style="display: none;">
              <p></p><a class="close"></a>
            </div>
          </div>
          <form method="post" name="contactform" id="contactform">
            {{csrf_field()}}
            <div class="utf-no-border">
              <input class="utf-with-border" name="cname" id="cname" type="text" placeholder="Name" required="">
              <span class="errMsg_cname errDiv"></span>
            </div>
            <div class="utf-no-border">
              <input class="utf-with-border" name="cemail" id="cemail" type="email" placeholder="Email" required="">
              <span class="errMsg_cemail errDiv"></span>
            </div>
            <div class="utf-no-border">
              <input class="utf-with-border" name="cmobile" id="cmobile" onkeypress="return isNumberKey(event);"
                maxlength="10" type="text" placeholder="Mobile number" required="">
              <span class="errMsg_cmobile errDiv"></span>
            </div>
            <div>
              <textarea class="utf-with-border" name="ccomments" cols="40" rows="3" id="ccomments"
                placeholder="Message/Query..." required=""></textarea>
              <span class="errMsg_ccomments errDiv"></span>
            </div>
            <div class="form-group ">
              <div class="row">
                <!-- <div class="col-sm-6 no-padding-left">
                      <input type="text" maxlength="4" name="ccaptcha" id="ccaptchacode" onkeypress="return isNumberKey(event);" class="utf-with-border mb-0" placeholder="Enter Code">
                  </div>
                  <div class="col-sm-5 mt-3 mt-md-0 no-padding-right d-flex align-items-center">
                      <div class="d-flex align-items-center" >
                          <label class="form-control input-md no-padding text-center mb-0" style="padding: 0;">
                              <img src="{{url('/')."/captcha"}}" alt="captcha image" 
 class="captchaImage" 
>
                          </label>
                          <a href="javascript:void(0);" class="input-group-addon captchaRefresh ml-2" onClick="generateCaptcha()" ><span class="icon-feather-refresh-cw"></span></a>
                      </div>


                  </div> -->
                <div class="col-12">
                  <div id="contactcapt"></div>
                </div>
                <div class="col-12 mt-3"><span class="errMsg_ccaptchacode errDiv"></span></div>
                <div class="clearfix"></div>

              </div>
            </div>
            <div>
              <!-- <input type="submit" class="submit button" id="submit" value="Submit Message"> -->
              <button class="submit button ripple-effect cfSubmit" type="button" name="cfSubmit"
                onclick="return validatecontactform();">
                <span>Submit Message</span>
              </button>
            </div>
          </form>
        </div>
      </section>
    </div> 
    <div class="col-lg-4 mb-3">
      <div class="contact-card  pl-lg-3">
        <h4 class="text-primary">
           Contact
        </h4>
        <div class="contact-card-list">
          <i class="icon-line-awesome-envelope"></i>
          <span>
            <strong class="h5 text-primary">The Say Foundation:</strong> <br>
            <a href="mailto: contactus@thesayfoundation.com">contactus@thesayfoundation.com</a>
          </span>
        </div>
        <!-- <div class="contact-card-list">
           <i class="icon-feather-phone-call"></i>
            <span>
              <strong  class="h5 text-primary">Sign Medium Support Centre:</strong> <br>
              <a href="whatsapp: +917396492802">+917396492802 (WhatsApp)</a>
            </span>
        </div> -->
        <div class="contact-card-list">
           <i class="icon-material-outline-location-on"></i>
           <span>
              <strong  class="h5 text-primary">Address:</strong> <br>
              <span>D1 Block 1227 Vasant Kunj, New Delhi 110070</span>
           </span>
        </div>
        <h4 class="text-primary">
          Follow Us
        </h4>
        <div class="follow-link follow-link-circle mb-2">
          <a href="https://www.linkedin.com/company/the-say-foundation/" target="_blank" class="linkedin-link">
             <i class="icon-brand-linkedin"></i>
          </a>
          <a href="https://www.instagram.com/TheSAYFoundation/" target="_blank" class="instagram-link">
             <i class="icon-brand-instagram"></i>
          </a>
          <a href="https://www.facebook.com/TheSAYFoundation/" target="_blank" class="facebook-link">
             <i class="icon-brand-facebook"></i>
          </a>
          <a  href="https://twitter.com/TSAYFoundation" target="_blank" class="twitter-link">
             <i class="icon-brand-twitter"></i>
          </a>
       </div>
     </div>
    </div>
  </div>
</div>
@section('page-js')
<script>
  function validatecontactform() {
    $('.errDiv').hide();
    $('.cfRes').hide();
    $('.error-input').removeClass('error-input');
    if (!blankCheck('cname', 'Name can not be left blank'))
      return false;
    if (!blankCheck('cemail', 'Email id can not be left blank'))
      return false;
    if (!validEmail('cemail'))
      return false;
    if (!blankCheck('cmobile', 'Mobile no. can not be left blank'))
      return false;
    if (!blankCheck('ccomments', 'Messege can not be left blank'))
      return false;
    /*if (!blankCheck('ccaptchacode', 'Captcha can not be left blank'))
      return false;
    if (!maxLength('ccaptchacode', 4, 'Captcha')){
     return false;
    }*/
    // var response = grecaptcha.getResponse(contactcapt);
    // if (response.length == 0) {
    //   $('.errMsg_ccaptchacode').html('Please check captcha').show();
    //   return false;
    // }
    $.ajax({
      type: 'POST',
      url: SITE_URL + "/website/ajax/contactformsubmit",
      data: $('#contactform').serialize(),
      dataType: "json",
      processData: true,
      beforeSend: function () {
        $(".cfSubmit").attr('disabled', 'disabled');
        $(".cfSubmit span").text('Please wait...');
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (res) {
        $(".cfSubmit span").text('Submit');
        $(".cfSubmit").removeAttr('disabled');
        if (res.status == 200) {
          $('.cfSuccessResponse p').html(res.msg);
          $('.cfSuccessResponse').show();
          $('#cname,#cemail,#cmobile,#ccomments').val('');
        } else {
          $('.cfErrorResponse p').html(res.msg).show();
          $('.cfErrorResponse').show();
        }
      }
    });
  }
</script>
@endsection
<!-- Latest Jobs / End -->
@endsection
<!-- volunteer form modal -->
<div id="small-dialog-3" class="zoom-anim-dialog mfp-hide dialog-with-tabs ">
  <div class="utf-signin-form-part">
    <ul class="utf-popup-tabs-nav-item text-center">
      <li class="modal-title">Volunteer Form</li>
    </ul>
    <!-- <div class="utf-popup-container-part-tabs"> -->
      <div class="utf-popup-tab-content-item">
          <div class="vfRes vfSuccessResponse notification success closeable" style="display: none;"
            onclick="$('#small-dialog-3').magnificPopup('close');">
            <p></p><a class="close"></a>
          </div>
          <div class="vfRes vfErrorResponse notification error closeable" style="display: none;">
            <p></p><a class="close"></a>
          </div>
        <form method="post" id="volunteer-form">
          {{csrf_field()}}
          <div class="utf-no-border">
            <input class="utf-with-border" name="vfname" id="vfname" type="text" placeholder="Name" required="">
            <span class="errMsg_vfname errDiv"></span>
          </div>
          <div class="utf-no-border">
            <input class="utf-with-border" name="vfemail" id="vfemail" type="email" placeholder="Email" required="">
            <span class="errMsg_vfemail errDiv"></span>
          </div>
          <div class="utf-no-border">
            <input class="utf-with-border" name="vfmobile" id="vfmobile" type="text" placeholder="Mobile number"
              required="" onkeypress="return isNumberKey(event);" maxlength="10">
            <span class="errMsg_vfmobile errDiv"></span>
          </div>
          <div>
            <textarea class="utf-with-border" name="vfcomments" id="vfcomments" cols="40" rows="3"
              placeholder="why would you like to volunteer?" required=""></textarea>
            <span class="errMsg_vfcomments errDiv"></span>
          </div>
          <div class="form-group ">
            <div class="row">
              <div class="col-12">
                <div id="volunteercap"></div>
              </div>
              <!-- <div class="col-sm-6 no-padding-left">
                      <input type="text" maxlength="4" name="captcha" id="vcaptchacode" onkeypress="return isNumberKey(event);" class="utf-with-border mb-0" placeholder="Enter Code">
                  </div> -->
              <!-- <div class="col-sm-5 mt-3 mt-md-0 no-padding-right d-flex align-items-center">
                      <div class="d-flex align-items-center" >
                          <label class="form-control input-md no-padding text-center mb-0" style="padding: 0;">
                              <img src="{{url('/')."/captcha"}}" alt="captcha image" 
 class="captchaImage" 
>
                          </label>
                          <a href="javascript:void(0);" class="input-group-addon captchaRefresh ml-2" onClick="generateCaptcha()" ><span class="icon-feather-refresh-cw"></span></a>
                      </div>


                  </div> -->
              <div class="col-12 mt-3"><span class="errMsg_vcaptchacode errDiv"></span></div>
              <div class="clearfix"></div>

            </div>
          </div>

          <div class="utf-centered-button margin-top-10">
            <button class="button  vfSubmit" type="button" name="vfSubmit" onclick="return validatevolunteerform();">
              <span>Submit</span>
            </button>
          </div>
        </form>
      </div>
    <!-- </div> -->
  </div>
</div>

<!-- volunteer form modal / End -->
<!-- donate form  -->
<!-- <div id="small-dialog-4" class="zoom-anim-dialog mfp-hide dialog-with-tabs "> 
  <div class="utf-signin-form-part">   
    <ul class="utf-popup-tabs-nav-item text-center">
      <li class="modal-title">Donate Form</li>
    </ul>
    <div class="utf-popup-container-part-tabs"> 
      <div class="utf-popup-tab-content-item" > 
        <div class="col-12 mt-3">
          <div class="dfRes dfSuccessResponse notification success closeable" style="display: none;" onclick="$('#small-dialog-4').magnificPopup('close');"><p></p><a class="close"></a></div>
          <div class="dfRes dfErrorResponse notification error closeable" style="display: none;"><p></p><a class="close"></a></div>
        </div>
      </div>
    </div>
  </div>
</div> -->
<!-- donate form end -->
<!-- bootstrap Modal donate-->
<div class="modal fade modal--donate" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog  ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel">Donate Form

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="icon-line-awesome-close"></span>
          </button>
        </h5>
      </div>
      <div class="modal-body">
        <div class="dfRes dfSuccessResponse notification success closeable" style="display: none;"
          onclick="$('#exampleModal').modal('hide');">
          <p></p><a class="close"></a>
        </div>
        <div class="dfRes dfErrorResponse notification error closeable" style="display: none;">
          <p></p><a class="close"></a>
        </div>
        <h4 class="text-primary mb-4">Request a call back at your preferred time and date.</h4>
        <form method="post" id="donate-form">
          {{csrf_field()}}
          <div class="utf-no-border">
            <input class="utf-with-border" name="dname" id="dname" type="text" placeholder="Name" required="">
            <span class="errMsg_dname errDiv"></span>
          </div>
          <div class="utf-submit-field">
            <select class="utf-with-border selectpicker" data-live-search="true" data-size="7" title="Select Country"
              name="dcountry" id="dcountry">
              <option>Select Country</option>
            </select>
            <span class="errMsg_dcountry errDiv"></span>
          </div>
          <div class="utf-no-border">
            <input class="utf-with-border" name="dmobile" id="dmobile" type="text"
              onkeypress="return isNumberKey(event);" maxlength="10" placeholder="Mobile number" required="">
            <span class="errMsg_dmobile errDiv"></span>
          </div>
          <div class="utf-input-with-icon">
            <input type="text" class="utf-with-border" required="" placeholder="Call Back Date" id="ddate" name="ddate">
            <label for="ddate"><i class="icon-feather-calendar"></i> </label>
            <span class="errMsg_ddate errDiv"></span>
          </div>
          <div class="utf-submit-field">
            <select class="utf-with-border selectpicker" title="Call Back Time" name="dtime" id="dtime">
              <option value="">Select Time</option>
              <option value="01:00 AM">01:00 AM</option>
              <option value="02:00 AM">02:00 AM</option>
              <option value="03:00 AM">03:00 AM</option>
              <option value="04:00 AM">04:00 AM</option>
              <option value="05:00 AM">05:00 AM</option>
              <option value="06:00 AM">06:00 AM</option>
              <option value="07:00 AM">07:00 AM</option>
              <option value="08:00 AM">08:00 AM</option>
              <option value="09:00 AM">09:00 AM</option>
              <option value="10:00 AM">10:00 AM</option>
              <option value="11:00 AM">11:00 AM</option>
              <option value="12:00 AM">12:00 AM</option>
              <option value="01:00 PM">01:00 PM</option>
              <option value="02:00 PM">02:00 PM</option>
              <option value="03:00 PM">03:00 PM</option>
              <option value="04:00 PM">04:00 PM</option>
              <option value="05:00 PM">05:00 PM</option>
              <option value="06:00 PM">06:00 PM</option>
              <option value="07:00 PM">07:00 PM</option>
              <option value="08:00 PM">08:00 PM</option>
              <option value="09:00 PM">09:00 PM</option>
              <option value="10:00 PM">10:00 PM</option>
              <option value="11:00 PM">11:00 PM</option>
              <option value="12:00 PM">12:00 PM</option>

            </select>
            <span class="errMsg_dtime errDiv"></span>
          </div>
          <div class="utf-no-border">
            <input class="utf-with-border" name="demail" id="demail" type="email" placeholder="Email" required="">
            <span class="errMsg_demail errDiv"></span>
          </div>
          <div>
            <textarea class="utf-with-border" name="dcomments" id="dcomments" cols="40" rows="3"
              placeholder="Message..." required=""></textarea>
            <span class="errMsg_dcomments errDiv"></span>
          </div>
          <div class="form-group mb-3">
            <div class="row">
              <div class="col-12">
                <div id="donatecap"></div>
              </div>
              <!-- <div class="col-sm-6 no-padding-left">
                      <input type="text" maxlength="4" name="dcaptcha" id="dcaptchacode" onkeypress="return isNumberKey(event);" class="utf-with-border mb-0" placeholder="Enter Code">
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
              <div class="col-12 mt-3"><span class="errMsg_dcaptchacode errDiv"></span></div>
              <div class="clearfix"></div>

            </div>
          </div>
          <button class="button  dfSubmit" type="button" name="dfSubmit" onclick="return validatedonateform();">
            <span>Submit</span>
          </button>

        </form>
      </div>
    </div>
  </div>
</div>


<script>

  function validatevolunteerform() {
    // alert(1111)
    $('.errDiv').hide();
    $('.vfRes').hide();
    $('.error-input').removeClass('error-input');
    if (!blankCheck('vfname', 'First Name can not be left blank'))
      return false;
    if (!blankCheck('vlname', 'last Name can not be left blank'))
      return false;
    if (!blankCheck('vfmobile', 'Mobile no. can not be left blank'))
      return false;
    if (!blankCheck('vfemail', 'Email id can not be left blank'))
      return false;
    if (!validEmail('vfemail'))
      return false;
    
    if (!blankCheck('vfcomments', 'Messege can not be left blank'))
      return false;
    /*if (!blankCheck('vcaptchacode', 'Captcha can not be left blank'))
      return false;
    if (!maxLength('vcaptchacode', 4, 'Captcha')){
     return false;
    }*/
    /* var response = grecaptcha.getResponse(volunteercap);
    if (response.length == 0) {
      $('.errMsg_vcaptchacode').html('Please check captcha').show();
      return false;
    } */

    $.ajax({
      type: 'POST',
      url: SITE_URL + "/website/ajax/volunteerformsubmit",
      data: $('#volunteer-form').serialize(),
      dataType: "json",
      processData: true,
      beforeSend: function () {
        $(".vfSubmit").attr('disabled', 'disabled');
        $(".vfSubmit span").text('Please wait...');
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (res) {
        $(".vfSubmit span").text('Submit');
        $(".vfSubmit").removeAttr('disabled');
        if (res.status == 200) {
          $('.vfSuccessResponse p').html(res.msg);
          $('.vfSuccessResponse').show();
          $('#vfname,#vlname,#vfmobile,#vfemail,#vfcomments').val('');
          grecaptcha.reset(volunteercap);
        } else {
          $('.vfErrorResponse p').html(res.msg).show();
          $('.vfErrorResponse').show();
          grecaptcha.reset(volunteercap);
        }
      }
    });
  }


  function validatedonateform() {
    $('.errDiv').hide();
    $('.dfRes').hide();
    $('.error-input').removeClass('error-input');
    if (!blankCheck('dname', 'Name can not be left blank'))
      return false;
    if (!blankCheck('dcountry', 'Select a contry'))
      return false;
    if (!blankCheck('demail', 'Email id can not be left blank'))
      return false;
    if (!validEmail('demail'))
      return false;
    if (!blankCheck('dmobile', 'Mobile no. can not be left blank'))
      return false;
    if (!blankCheck('ddate', 'Select a date'))
      return false;
    if (!blankCheck('dtime', 'Select a contry'))
      return false;
    if (!blankCheck('dcomments', 'Messege can not be left blank'))
      return false;
    /*if (!blankCheck('dcaptchacode', 'Captcha can not be left blank'))
      return false;
    if (!maxLength('dcaptchacode', 4, 'Captcha')){
     return false;
    }*/

    /* var response = grecaptcha.getResponse(donatecap);
    if (response.length == 0) {
      $('.errMsg_dcaptchacode').html('Please check captcha').show();
      return false;
    } */

    $.ajax({
      type: 'POST',
      url: SITE_URL + "/website/ajax/donateformsubmit",
      data: $('#donate-form').serialize(),
      dataType: "json",
      processData: true,
      beforeSend: function () {
        $(".dfSubmit").attr('disabled', 'disabled');
        $(".dfSubmit span").text('Please wait...');
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (res) {
        $(".dfSubmit span").text('Submit');
        $(".dfSubmit").removeAttr('disabled');
        if (res.status == 200) {
          $('.dfSuccessResponse p').html(res.msg);
          $('.dfSuccessResponse').show();
          $('#dname,#demail,#dmobile,#dcomments,#dcountry,#ddate,#dtime').val('');
          $('#dcountry,#dtime').selectpicker('refresh');
          grecaptcha.reset(donatecap);
        } else {
          $('.dfErrorResponse p').html(res.msg).show();
          $('.dfErrorResponse').show();
          grecaptcha.reset(donatecap);
        }
      }
    });
  }
</script>
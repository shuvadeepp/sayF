@extends('layouts.website')
@section('page-content')

@section('page-css')
@endsection
<!-- <div class="section--content">  -->
    <div class="container donate-container">
        <div class="inner-page-baner">
        <?php if(isset($banners) && $banners->isNotEmpty()){ ?>
      <img src="<?php if(!empty($banners[0]->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banners[0]->bannerImage; } else{ echo PUBLIC_PATH.'images/donate-inner.png'; } ?>" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
          <strong>{{$banners[0]->bannerTitle}}</strong> - <br> {{$banners[0]->bannerText}}
      </div>
      <?php } else { ?>
            <img src="<?php echo PUBLIC_PATH; ?>images/donate-inner.png" class="d-block" alt="banner">
            <div class="inner-page-baner-content">
                <strong>Donate</strong> - <br> Joyful donations, meaningful impact
            </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="mx-lg-auto text-md-center col-lg-9">
            <p class="mb-4 mt-0 my-md-4">
                    Thank you for your interest in supporting SAY Foundation's mission to empower Persons with Disabilities (PwDs) and create a more inclusive society. Your donation can make a real difference in the lives of PwDs by providing access to education, training, and employment opportunities.
                    </p>
            </div>
        </div>
        <div class="row"> 
            <div class="col-lg-6">
                <h5 class="section-title">Why Donate to The SAY Foundation:</h5>
                <p>By donating to The SAY Foundation, you are contributing to a larger cause that helps build a more equitable and accessible world. Your donation can:</p>
                <ul class="section-list">
                    <li>Provide skill development and job training to PwDs</li>
                    <li>Offer mentorship and support for career advancement</li>
                    <li>Fund research and advocacy for disability-inclusive policies</li>
                    <li>Build accessible infrastructure and facilities</li>
                    <li>Your donation can help break down barriers and provide opportunities for PwDs to reach their full potential.</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h5 class="section-title">Ways to Donate:</h5>
                <p>We offer several ways to donate to SAY Foundation:</p>
                <p>
                    <strong>Bank Transfer:</strong> 
                    You can transfer funds directly to our bank account. Please email us at <a href="mailto:contactus@thesayfoundation.com">contactus@thesayfoundation.com</a> for more details.
                </p>
                <p>
                    <strong>Cheque Donation:</strong>
                    Send us an email on <a href="mailto:contactus@thesayfoundation.com"> contactus@thesayfoundation.com</a> with your contact details and we will reach out to you.
                </p> 
            </div>
            <!-- <div class="col-lg-6"> 
                <div class="dfRes dfSuccessResponse notification success closeable" style="display: none;"
                    onclick="$('#exampleModal').modal('hide');">
                    <p></p><a class="close"></a>
                </div>
                <div class="dfRes dfErrorResponse notification error closeable" style="display: none;">
                    <p></p><a class="close"></a>
                </div> 
            </div>  -->
        </div>
        <div class="request-form">
            <h5 class="section-title mb-3 mb-lg-4">Request a call back at your preferred time and date.</h5>
            <form method="post" id="donate-form">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="utf-no-border">
                            <input class="utf-with-border" name="dname" id="dname" type="text" placeholder="Name" required="">
                            <span class="errMsg_dname errDiv"></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="utf-submit-field">
                            <select class="utf-with-border selectpicker" data-live-search="true" data-size="7"
                                title="Select Country" name="dcountry" id="dcountry">
                                <option>Select Country</option>
                            </select>
                            <span class="errMsg_dcountry errDiv"></span>
                        </div>
                    </div>
                     <div class="col-lg-4 col-md-6">
                        <div class="utf-no-border">
                            <input class="utf-with-border" name="dmobile" id="dmobile" type="text"
                                onkeypress="return isNumberKey(event);" maxlength="10" placeholder="Mobile number" required="">
                            <span class="errMsg_dmobile errDiv"></span>
                        </div>
                    </div>
                     <div class="col-lg-4 col-md-6">
                        <div class="utf-no-border">
                            <input class="utf-with-border" name="demail" id="demail" type="email" placeholder="Email" required="">
                            <span class="errMsg_demail errDiv"></span>
                        </div>
                    </div>
                     <div class="col-lg-4 col-md-6">
                        <div class="utf-input-with-icon">
                            <input type="text" class="utf-with-border" required="" placeholder="Call Back Date" id="ddate"
                                name="ddate">
                            <label for="ddate"><i class="icon-feather-calendar"></i> </label>
                            <span class="errMsg_ddate errDiv"></span>
                        </div>
                    </div>
                     <div class="col-lg-4 col-md-6">
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
                    </div>
                    <div class="col-12">
                        <textarea class="utf-with-border" name="dcomments" id="dcomments" cols="40" rows="3"
                            placeholder="Message..." required=""></textarea>
                        <span class="errMsg_dcomments errDiv"></span>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-12">
                        <div id="donatecap"></div>
                    </div>
                    <div class="col-12"><span class="errMsg_dcaptchacode errDiv"></span></div>
                </div>
                <div class="text-center mt-4">
                    <button class="button ripple-effect" type="button" name="dfSubmit"
                        onclick="return validatedonateform();">
                        <span>Submit</span>
                    </button>
                </div>
            
            </form>
        </div>
        <div class="mb-4 mb-md-5">
            <h5 class="section-title">How Your Donation Helps:</h5>
            <p>
                At The SAY Foundation, we are committed to transparency and accountability. Your donation will go directly towards our programs and initiatives that support PwDs. We will provide regular updates  to keep our donors informed about the impact of their contribution. 
            </p>
            <p>
                Thank you for considering a donation to The SAY Foundation. Together, we can build a more inclusive and accessible world for all.
            </p>
            <p><strong>Bringing Joy to the world, one donation at a time</strong></p> 
        </div>
    </div>
<!-- </div> -->

@section('page-js')
@endsection

@endsection
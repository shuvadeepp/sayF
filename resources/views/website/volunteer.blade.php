@extends('layouts.website')
@section('page-content')

@section('page-css')

@endsection
<!-- <div class="section--content"> -->
    <div class="container">
        <div class="inner-page-baner">
        <?php if(isset($banners) && $banners->isNotEmpty()){ ?>
      <img src="<?php if(!empty($banners[0]->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banners[0]->bannerImage; } else{ echo PUBLIC_PATH.'images/banner1.png'; } ?>" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
          <strong>{{$banners[0]->bannerTitle}}</strong> - <br> {{$banners[0]->bannerText}}
      </div>
      <?php } else { ?>
            <img src="<?php echo PUBLIC_PATH; ?>images/banner1.png" class="d-block" alt="banner">
            <div class="inner-page-baner-content">
                <strong>Volunteer</strong> - <br>
                Join us in our mission to create an inclusive world
            </div>
            <?php } ?>
        </div>
        
        <div class="row">
            <div class="mx-lg-auto text-md-center col-lg-9">
                <p class="mb-4 mt-0 my-md-4">
                Thank you for your interest in volunteering with The SAY Foundation. Our volunteers play a crucial role in helping us achieve our mission of empowering Persons with Disabilities (PwDs) and creating a more inclusive society. We welcome individuals from all backgrounds who are passionate about disability rights and want to make a difference in the lives of PwDs.
                    </p>
            </div>
        </div>
        <div class="row"> 
            <div class="col-lg-6">
                <h5 class="section-title">Why Volunteer with The SAY Foundation:</h5>
                <p>Volunteering with The SAY Foundation is a rewarding experience that offers many benefits, including:</p>
                <ul class="section-list">
                    <li>The opportunity to contribute to a meaningful cause</li>
                    <li>The chance to make a positive impact on the lives of PwDs</li>
                    <li>The chance to gain valuable skills and experience</li>
                    <li>The opportunity to meet like-minded individuals and build your network</li>
                    <li>The satisfaction of giving back to your community</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h5 class="section-title">Volunteer Requirements:</h5>
                <p>To volunteer with The SAY Foundation, you must meet the following requirements:</p>
                <ul class="section-list">
                    <li>Be 18 years of age or older</li>
                    <li>Be passionate about disability rights and inclusion</li>
                    <li>Be willing to commit to a minimum of 10 hours per month</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h5 class="section-title">Ways to Volunteer:</h5>
                <p>We offer several ways to volunteer with SAY Foundation:</p>
                <p>
                    <strong>Volunteer at Events:</strong> We organize various events throughout the year, such as job fairs, skill development workshops, and awareness campaigns. Volunteers can help with event planning, set-up, registration, and other tasks.
                </p>
                <p>
                    <strong>Mentorship:</strong> We offer mentorship programs for PwDs to help them develop skills, gain confidence, and advance their careers. Volunteers can serve as mentors and offer guidance and support to our participants.
                </p>
                <p>
                    <strong>Online Volunteering:</strong> We also offer virtual volunteering opportunities that allow volunteers to contribute their skills and expertise remotely. This includes social media management, content creation, website development, and other tasks.
                </p> 
            </div> 
            <div class="col-lg-6">
                <h5 class="section-title">Benefits of Volunteering:</h5>
                <p>As a volunteer with SAY Foundation, you will receive the following benefits:</p>
                <ul class="section-list">
                    <li>Orientation and training for your specific role</li>
                    <li>Regular feedback and recognition for your contributions</li>
                    <li>Opportunities for professional development and networking</li>
                    <li>The chance to make a real difference in the lives of PwDs</li>              
                </ul>
            </div>
        </div>
        <div class="request-form">
            <h5 class="section-title mb-3 mb-lg-4">How to Apply</h5>
            <form method="post" id="volunteer-form">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="utf-no-border">
                            <input class="utf-with-border" name="vfname" id="vfname" type="text" placeholder="First name">
                            <span class="errMsg_vfname errDiv"></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="utf-no-border">
                            <input class="utf-with-border" name="vlname" id="vlname" type="text" placeholder="Last name">
                            <span class="errMsg_vlname errDiv"></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="utf-no-border">
                            <input class="utf-with-border" name="vfmobile" id="vfmobile" type="text"
                                onkeypress="return isNumberKey(event);" maxlength="10" placeholder="Mobile number">
                            <span class="errMsg_vfmobile errDiv"></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="utf-no-border">
                            <input class="utf-with-border" name="vfemail" id="vfemail" type="email" placeholder="Email">
                            <span class="errMsg_vfemail errDiv"></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <textarea class="utf-with-border" name="vfcomments" id="vfcomments" cols="40" rows="3"
                            placeholder="What motivates you to be a volunteer"></textarea>
                        <span class="errMsg_vfcomments errDiv"></span>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button class="button ripple-effect" type="button" name="vfSubmit"
                        onclick="return validatevolunteerform();">
                        <span>Submit</span>
                    </button>
                </div>
            </form>
        </div>
        <div class="mb-4 mb-md-5">
            <p class="thank-msg">Thank you for considering volunteering with SAY Foundation. Together, we can create a more inclusive and accessible world for all.</p>
        </div>
    </div>
<!-- </div> -->

@section('page-js')
@endsection

@endsection
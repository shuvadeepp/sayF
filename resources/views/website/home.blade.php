@extends('layouts.website')
@section('page-content')


<div class="partnership-section">
    <div class="container">
      <h1 class="mb-4"><span>&#128588;&#127996;</span>Announcing The Say Foundation - Yunikee Partnership<span>&#128588;&#127996;</span></h1>

      <p>The Say Foundation and Yunikee have entered into a partnership to enable job opportunities for Persons with Disabilities (PwDs). <br>
      This is exciting for both the organizations as we both have the common goal – of empowering PwDs and making them financially independent.</p>

      <div class="partnership-logo">
        <img src="<?php echo PUBLIC_PATH; ?>images/logoone.png" alt="say foundation logo">
        <img src="<?php echo PUBLIC_PATH; ?>images/yunikee.png" alt="yunikee logo">
       </div>

      <!-- <a href="{{ROOT_URL.'/partnership'}}" class="know-more">Know More</a> -->
       <a href="{{ROOT_URL.'/pressrelease'}}" class="know-more">Press Release</a>
    </div>
</div>
<!--section banner  -->
<section class="banner">
  <div class="container">
    <div class="row  justify-content-center">
      <div class="col-lg-7 col-xl-6">
        <div class="banner__card">
          <h4 class="section__heading banner__heading ">About Us</h4>
          <p>
            The SAY Foundation aim's to create an inclusive ecosystem for Persons with Disabilities (PwDs). SAY's
            mission is to empower the PwDs to become self-reliant, financially independent and productive contributors
            of the society.
          </p>
          <p>
            SAY's focus is to create a comprehensive ecosystem collaborating with a diverse set of stakeholders
            including Govt., Corporates, Non-Governmental Organizations, Associations, Communities to support PwDs
            become self-reliant.
          </p>
          <a href="{{ROOT_URL.'/about-us'}}" class="banner__link">Read more</a>
        </div>
        <br>
        <div style="text-align: center!important;">
        <a href="{{ROOT_URL.'/jobsearch'}}"><h4 class="section__heading what__heading">Explore Jobs</h4></a>
        </div>
      </div>
      <div class="col-md-4 mt-4 mt-lg-0 col-lg-5 offset-xl-1 ">
        <div class="banner__img">
          <img src="<?php echo PUBLIC_PATH; ?>images/workflow.png" alt="The say foundation workflow " class="img-fluid">
        </div>
      </div>
    </div>
  </div>
</section>
<!--section banner  end-->
<!-- what-we-do -->
<section class="what">
  <div class="container">
    <h4 class="section__heading what__heading">what we do</h4>
    <h4 class="what__sub-heading">Our goal is to achieve inclusive working environment for persons with disability
    </h4>
    <div class="row">
      <div class="col-xl-6">
        <div class="what__card">
          <div class="what__img">
            <img src="<?php echo PUBLIC_PATH; ?>images/employers.jpg" alt="Employers">
          </div>
          <div class="what__content">
            <h4 class="what__title">Employers</h4>
            <p>Enable Organizations including Govt. to become leaders in Diversity & Inclusion with special focus on
            Disability Index</p>
            <a href="{{ROOT_URL}}/employers" class="what__link">Read more</a>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="what__card">
          <div class="what__img">
            <img src="<?php echo PUBLIC_PATH; ?>images/pwds.jpg" alt="Persons with Disabilities">
          </div>
          <div class="what__content">
            <h4 class="what__title">Persons with Disabilities (PwDs) </h4>
            <p>Enable PwDs to realize their potential and promote a more inclusive world</p>
            <a href="{{ROOT_URL}}/persons-with-disabilities" class="what__link">Read more</a>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="what__card">
          <div class="what__img">
            <img src="<?php echo PUBLIC_PATH; ?>images/ngo-and-communities.jpg" alt="NGOs and Communities ">
          </div>
          <div class="what__content">
            <h4 class="what__title">NGOs and Communities </h4>
            <p>Collaborate with Associations and NGOs to create an inclusive eco-system to develop and upskill the PwDs
            for current and future market opportunities</p>
            <a href="{{ROOT_URL}}/ngo-and-communities" class="what__link">Read more</a>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="what__card">
          <div class="what__img">
            <img src="<?php echo PUBLIC_PATH; ?>images/policy-advocacy.jpg" alt="Policy Advocacy">
          </div>
          <div class="what__content">
            <h4 class="what__title">Policy Advocacy </h4>
            <p>Policy advocacy for the rights of PwDs to influence the decision makers in government, private sector and
            society at large</p>
            <a href="{{ROOT_URL}}/policy-advocacy" class="what__link">Read more</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- what-we-do end-->
<!-- take-action -->
<section class="take">
  <h4 class="section__heading take__heading">take action</h4>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="take__card">
          <h3 class="take__title">Learn</h3>
          <p class="take__para">Get the facts about PWDs and how we’re helping.</p>
          <a href="{{ROOT_URL}}/blog" class="take__link"></a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="take__card">
          <h3 class="take__title">Volunteer</h3>
          <p class="take__para">Find out how you can contribute to the cause.</p>
          <a href="#small-dialog-3" class="take__link popup-with-zoom-anim cand vlnter login"></a>
        </div>
      </div>
     
      <div class="col-md-4">
        <div class="take__card">
          <h3 class="take__title">Donate</h3>
          <p class="take__para">Help us raise money to make a big difference with this issue.</p>
          <a  href="#exampleModal" data-toggle="modal"  class="take__link donate"></a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- take-action end-->
<!-- did-you-know -->
<section class="know d-flex">
  <div class="container m-auto">
    <div class="row">
      <div class="col-lg-7 mt-5 mt-xl-0">
        <div class="know__card">
          <h4 class="section__heading know__heading ">did you know</h4>
         
          <div class="know__slider">
            <?php
                if(!empty($knowDetls)){
                foreach($knowDetls as $key=>$knowDetails){ 
            ?>
            <div class="know__slider__item">
              <div class="align-items-center d-flex flex-column flex-lg-row justify-content-center">
                <div class="know__msg">                
                 {{$knowDetails->Description}}
              </div>
                <div class="know__media mt-4 mt-lg-0 ml-0 ml-lg-4 mr-1">
                  <?php if(!empty($knowDetails->twitterLink)){ ?>
                  <a href="{{$knowDetails->twitterLink}}" target="_blank" class="know__link">
                    <i class="icon-brand-twitter"></i>
                  </a>
                  <?php } ?>
                  <?php if(!empty($knowDetails->facebookLink)){ ?>
                  <a href="{{$knowDetails->facebookLink}}" target="_blank" class="know__link ml-3 ml-lg-0">
                    <i class="icon-brand-facebook-f"></i>
                  </a>
                  <?php } ?>
                </div>
              </div>
            </div>
            <?php } }?>
          <!--   <div class="know__slider__item">
              2
            </div> -->
          </div>

        </div>
      </div>
      <div class="align-self-center col-lg-5 mb-5 mb-xl-0 pl-xl-5">
        <h2 class="know__title">Let's take action now for a better future</h2>
      </div>
    </div>
  </div>
</section>
<!-- did-you-know end-->
<!-- blogs -->
<?php if($blogDetls->isNotEmpty()){ ?>
<section class="blogs ">
  <div class="utf-testimonial-carousel-block">
    <?php foreach($blogDetls as $blogDetl){ ?>
    <div class="utf-carousel-review-item">
      <div class="d-flex align-items-center">
        <div class="blogs__card">
          <h4 class="section__heading blogs__heading">blog</h4>
          <p class="blogs__para">{{wardWrap($blogDetl->blogTitle,60)}}</p>
          <a href="{{ROOT_URL}}/blog/{{$blogDetl->blogSlug}}" class="blogs__link">Read more</a>
        </div>
        <div class="blogs__img">
          <img
          src="<?php if(!empty($blogDetl->blogImage)){ echo ROOT_URL.'/storage/app/uploads/blog/'.$blogDetl->blogImage; } else{ echo PUBLIC_PATH.'images/blog1.jpeg'; } ?>"
          alt="Blog">
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</section>
<?php } ?>
<!-- blogs end-->
<!-- video pannel -->
<div class="video-sec">
  <div class="container">
    <div class="video-sec__left">
      <div class="video-sec__videos mb-3 mb-md-4">
        <video controls id="tsf-video">
          <source src="" type="video/mp4">
        </video>
      </div>
      <!-- <p class="video-sec__msg">
        This year, the new Odisha State Schoralship Portal
        <a href="https://scholarship.odisha.gov.in" class="">(https://scholarship.odisha.gov.in) is being invited</a>
      </p> -->
    </div>
    <div class="video-sec__right">
      <div class="video-sec__card">
        <img src="<?php echo PUBLIC_PATH; ?>images/tsf-deck-pdf.png" alt="Download pdf" class="video-sec__img">
        <a href="<?php echo PUBLIC_PATH; ?>pdf/say-foundation-deck.pdf" target="_blank"
        class="video-sec__card__link stretched-link"></a>
        <div class="video-sec__card__text">
          <!-- This year, the new Odisha State Schoralship Portal -->
          <img src="<?php echo PUBLIC_PATH; ?>images/pdf-thumb.png" alt="Download pdf" class="d-block ml-auto">
        </div>
      </div>
    </div>
  </div>
</div>
<!-- video pannel end-->

@section('page-js')

<script src="<?php echo PUBLIC_PATH; ?>js/social-share.min.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/a076d05399.js"></script>

@endsection
@endsection
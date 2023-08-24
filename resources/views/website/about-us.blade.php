@extends('layouts.website')
@section('page-content')

<!-- <div class="inner-page-baner">
  <img src="<?php echo PUBLIC_PATH; ?>images/banner1.png" class="d-block" alt="banner">

</div> -->

<!-- <div id="titlebar" class="gradient">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>About Us</h2>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}">Home</a></li>
            <li>About Us</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div> -->

<!-- About List Start -->
<!-- <div class="section section--content "> -->
<div class="container">
  <div class="inner-page-baner">
  <?php if(isset($banners) && $banners->isNotEmpty()){ ?>
      <img src="<?php if(!empty($banners[0]->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banners[0]->bannerImage; } else{ echo PUBLIC_PATH.'images/about-us.png'; } ?>" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
          <strong>{{$banners[0]->bannerTitle}}</strong> - <br> {{$banners[0]->bannerText}}
      </div>
      <?php } else { ?>
    <img src="<?php echo PUBLIC_PATH; ?>images/about-us.png" class="d-block" alt="banner">
    <div class="inner-page-baner-content">
      <strong>Our Story</strong> - <br> Emergence of The Say Foundation
    </div>
    <?php } ?>
  </div>
  <div class="row">
    <div class="col-xl-8 col-md-12 mb-3">
      <p>The idea of <strong>SAY Foundation</strong> is a culmination of building foundation towards creating an ecosystem for Persons with Disabilities (PwDs).</p>
      <p>Initially, we were deliberating on the demand of hidden talent and addressing the needs of the institutions and organizations by building a solid workforce. We initially toyed with idea of carving out a niche for enabling the PwDs to the mainstream workforce, making them economically stable and consistently honing their skill set to become employable in today’s ever dynamic workplace.</p>
      <div class="img-left">
        <img src="<?php echo PUBLIC_PATH; ?>images/about-us-inner1.png" class="d-block img-fluid" alt="banner">
      </div>
      <p>With the goal set for enabling the disabled persons to explore job opportunities, get equipped with the right skill set and build a network of other PwDs, we decided to create an exclusive Job portal. The portal offers job opportunities to the PwDs, awareness about the possibilities to learn and grow with technological enablement. This will eventually lead the companies to devise their diversity, equity and inclusive policies with a focus beyond gender and ethnicity.</p>

      <p>On further deliberations with the key advocates, opinion leaders, PwDs themselves, we were amazed at the huge scope / potential available to nurture and shape this community which is about 2.2% of India’s population (under reported). This was a turning point and SAY was born with an aim to enable their inclusion to the vast workforce of Private and Government Organizations extending the support to access means towards their sustainability and financial stability along with access to education, medical support etc and list goes on. Even the minimal required support during the Pandemic have witnessed their struggles to even get vaccinated. The caretakers of the PwDs had to appeal to health agencies to create accessibility means to reach the health centers to get vaccinated. Frankly amidst covid where Humility was at peak, forgetfulness was too.</p>
      <div class="img-left">
      <img src="<?php echo PUBLIC_PATH; ?>images/about-us-inner2.png" class="d-block img-fluid" alt="banner">
      </div>
      <p>The deep seated need of enabling the PwDs to become an integral part of the workforce coined an innovative approach to develop an eco-system including exclusive job portal for PwDs, NGOs, Government and Private Organizations and Policy advocates.</p>
      <p> It emboldened our vision to create SAY to support the PwDs towards becoming financially capable and help them to manage not only their livelihood but also aspire them to grow by Integrating the community, corporates and NGOs under one platform.</p>
      
    </div>
    <div class="col-xl-4 col-md-12">
      <h4 class="mb-3 text-primary">Our Core Values & Philosophy </h4>
      <ul class="bg-light-list list-1">
        <li><strong>EQUITY :</strong>We strive to create an equitable work environment for the PwDs</li>
        <li><strong>EMPATHY :</strong> We work extensively to sensitize Org and Govt on the need and talent of PwDs
        </li>
        <li><strong>EMPOWERMENT :</strong>We enable PwDs through exclusive skill training
          to access career opportunities</li>
        <li><strong>ENGAGEMENT :</strong>We actively involve and influence the key stakeholders on the rights of PwDs
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- </div> -->
<!-- About List End -->

<!-- Icon Boxes -->
<div class="container mb-xl-5 mb-4 mt-xl-4">
  <h2 class="mb-2 mb-md-4 text-center text-md-left team-section-title">Our Team</h2>
  <div class="team__card d-md-flex  with-line text-md-left mb-4 text-center">
    <div class="team__img d-flex">
      <img src="<?php echo PUBLIC_PATH; ?>images/team-member-1.jpg" alt="Team Member" class="mb-2">
    </div>
    <div class="team__content">
      <h3>Swati Yadav</h3>
      <span class="team__designation">CEO, The Say Foundation</span>
      <p class="team__para">
        <strong>Swati Yadav</strong> is a multifaceted senior management professional with experience spanning across
        industries, geographies and cultures. She believes in pursuing her dreams and passion towards building a better
        future for self and others. Her experience working as HR expert has largely focused on building talent, diverse
        and highly inclusive workforce enabling Organizations to thrive. As a transformation HR Partner, Swati has
        always focused on learning new
        <a href="javascript:;" class="read-more-btn">Read More</a>
        <span id="more-content" class="d-none">
          skills and following the principles of change which are inevitable.
          Her association to various local and international forums for special needs, gender diversity, women
          international forums have ignited her interest to work for larger community such as Persons with Disabilities.
          Her passion to build an AI powered market place exclusively for PwDs has led to nurturing of The SAY
          Foundation to empower the PwDs to self-explore career opportunities, connect with NGOs to become job ready and
          work with employer of choice. This will also enable the Organizations to tap huge potential of PwDs,
          strengthen connect with extended communities of NGOs and provide a forum for PwDs to be a voice in Policy
          Advocacy.
          <a href="javascript:;" class="read-less-btn">Read Less</a>
        </span>
        <!-- <span class="team__read-more">Read more</span> -->
      </p>
    </div>
  </div>
  <!--  <div class="team__card d-md-flex icon-box with-line text-md-left">
      <div class="team__img d-flex">
        <img src="<?php echo PUBLIC_PATH; ?>images/team-member-2.jpg" alt="Team Member">
      </div>
      <div class="team__content">
        <h3>Vaani Yadav</h3>
        <p class="team__designation">Director <small>(The Say Foundation)</small></p>
        <p>
          <strong>Vaani Yadav</strong> is a commerce student studying in Sanskriti School, New Delhi. She’s currently in Grade 12 with a passion to study business management after graduating high school.She has worked with several NGOs with a motive to create a difference during such difficult times.She believes The SAY Foundation is an excellent step taken to move
           towards a future where people with disabilities will have ample number of opportunities to work in their dream jobs and be treated equally as any other employee. She hopes to see them becoming more empowered while moving towards a brighter future.
          <span class="team__read-more">Read more</span>
        </p>
      </div>
    </div> -->
  <div class="team__card d-md-flex  with-line text-md-left  text-center">
    <div class="team__img d-flex">
      <img src="<?php echo PUBLIC_PATH; ?>images/team-member-3.jpg" alt="Team Member" class="mb-2">
    </div>
    <div class="team__content">
      <h3>Sarthak Yadav</h3>
      <span class="team__designation">Director, The Say Foundation</span>
      <p>
        <strong>Sarthak Yadav</strong> is the Director of The Say Foundation. He is currently pursuing his Bachelor's
        degree in Economics & Mathematics from University of California, San Diego.He is passionate about The Say
        Foundation. He truly believes that The Say Foundation could revolutionise the workspace as it would produce an
        excellent platform for Persons with Disabilities to succeed in their careers and simultaneously companies would
        be able to uncover great talent.
        <!-- <span class="team__read-more">Read more</span> -->
      </p>
    </div>
  </div>


</div>
</div>
<!-- Icon Boxes / End -->
@section('page-js')
<script>
  $('document').ready(function () {
    $(".read-more-btn").click(function () {
      $("#more-content").removeClass("d-none")
      $(this).addClass("d-none")
    })
    $(".read-less-btn").click(function () {
      $("#more-content").addClass("d-none")
      $(".read-more-btn").removeClass("d-none")
    })
  });
</script>
@endsection
@endsection
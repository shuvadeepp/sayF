@extends('layouts.website')
@section('page-css')
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/bootstrap.min.css">
@endsection
@section('page-content')
<!-- bnner -->
<div class="container">
        <div id="banner-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <?php if(isset($banners) && $banners->isNotEmpty()){ 
                $bannerCount=count($banners); 
                    for($cnt=0;$cnt<$bannerCount;$cnt++) { ?>
                    <li data-target="#banner-carousel" data-slide-to="{{$cnt}}" class="{{$cnt == '0' ?'active':''}}"></li>
                <?php } } else { ?>
                <li data-target="#banner-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#banner-carousel" data-slide-to="1"></li>
                <li data-target="#banner-carousel" data-slide-to="2"></li>                
                <li data-target="#banner-carousel" data-slide-to="3"></li>
                <li data-target="#banner-carousel" data-slide-to="4"></li>
                <li data-target="#banner-carousel" data-slide-to="5"></li>
                <?php } ?>
            </ol>
            <?php if(isset($banners) && $banners->isNotEmpty()){ $i=1; ?>
            <div class="carousel-inner">
                <?php foreach($banners as $banner) { ?>
                <div class="carousel-item <?php echo $i == '1' ? 'active':''; ?>" data-interval="6000">
                    <img src="<?php if(!empty($banner->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banner->bannerImage; } else{ echo PUBLIC_PATH.'images/banner1.png'; } ?>" class="d-block" alt="banner">
                    <div class="carousel-content">
                        <h2>
                            <span class="banner-title1">{{$banner->bannerTitle}}</span> 
                        </h2>
                        <p>{{$banner->bannerText}}</p>
                    </div>
                </div>
                <?php $i++; } ?> 
            </div>
            <?php } else { ?>
                <div class="carousel-inner">               
                    <div class="carousel-item active" data-interval="6000">
                        <img src="<?php  echo PUBLIC_PATH ?>images/banner1.png" class="d-block" alt="banner">
                        <div class="carousel-content">
                            <h2>
                            <span class="banner-title1">We are on a quest</span>
                            <span class="banner-title2">to spread joy</span>
                            </h2>
                            <p>Creating an inclusive ecosystem <br>
                                for Persons with Disabilities</p>
                        </div>
                    </div> 
                    <div class="carousel-item" data-interval="6000">
                        <img src="<?php echo PUBLIC_PATH; ?>images/banner2.png" class="d-block" alt="banner">
                        <div class="carousel-content">
                            <h2>
                                <span class="banner-title1">We are on a quest</span>
                                <span class="banner-title2">to spread joy</span>
                            </h2>
                            <p>Creating an inclusive ecosystem <br>
                                for Persons with Disabilities</p>
                        </div>
                    </div>
                    <div class="carousel-item" data-interval="6000">
                        <img src="<?php echo PUBLIC_PATH; ?>images/banner3.png" class="d-block" alt="banner">
                        <div class="carousel-content">
                            <h2>
                                <span class="banner-title1">We are on a quest</span>
                                <span class="banner-title2">to spread joy</span>
                            </h2>
                            <p>Creating an inclusive ecosystem <br>
                                for Persons with Disabilities</p>
                        </div>
                    </div>
                    <div class="carousel-item" data-interval="6000">
                        <img src="<?php  echo PUBLIC_PATH ?>images/banner4.png" class="d-block" alt="banner">
                        <div class="carousel-content">
                            <h2>
                            <span class="banner-title1">We are on a quest</span>
                            <span class="banner-title2">to spread joy</span>
                            </h2>
                            <p>Creating an inclusive ecosystem <br>
                                for Persons with Disabilities</p>
                        </div>
                    </div> 
                    <div class="carousel-item" data-interval="6000">
                        <img src="<?php echo PUBLIC_PATH; ?>images/banner5.png" class="d-block" alt="banner">
                        <div class="carousel-content">
                            <h2>
                                <span class="banner-title1">We are on a quest</span>
                                <span class="banner-title2">to spread joy</span>
                            </h2>
                            <p>Creating an inclusive ecosystem <br>
                                for Persons with Disabilities</p>
                        </div>
                    </div>
                    <div class="carousel-item" data-interval="6000">
                        <img src="<?php echo PUBLIC_PATH; ?>images/banner6.png" class="d-block" alt="banner">
                        <div class="carousel-content">
                            <h2>
                                <span class="banner-title1">We are on a quest</span>
                                <span class="banner-title2">to spread joy</span>
                            </h2>
                            <p>Creating an inclusive ecosystem <br>
                                for Persons with Disabilities</p>
                        </div>
                    </div>
                </div> 
          <?php } ?>
        </div>
    </div>
    <!-- bnner end -->
    <!-- candidates, companies and ngos card-->
    <div class="container job-cards">
        <div class="row">
            <div class="col-sm-6 col-xl-3 mb-md-4 mb-3 mb-xl-0">
                <div class="card bg-green">
                    <div class="card-body">
                        <img src="<?php echo PUBLIC_PATH; ?>images/candidates.svg" alt="Candidate image">
                        <h5>For Candidates</h5>
                        <p>Build your career with us. Get support and apply for jobs.</p> 
                    </div>
                    <div>
                        <a href="{{ROOT_URL}}/user-login/2" class="btn btn-light">Apply Now</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 mb-md-4 mb-3 mb-xl-0">
                <div class="card bg-blue">
                    <div class="card-body">
                        <img src="<?php echo PUBLIC_PATH; ?>images/office-building.svg" alt="Company image">
                        <h5>For Companies</h5>
                        <p>Promote DEI by posting job requirements and adopting inclusive practices.</p> 
                    </div>
                    <div>
                        <a href="{{ROOT_URL}}/user-login/1" class="btn btn-light">I want to post Jobs</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 mb-md-4 mb-3 mb-xl-0">
                <div class="card bg-teal">
                    <div class="card-body">
                        <img src="<?php echo PUBLIC_PATH; ?>images/ngo-hand.svg" alt="NGO">
                        <h5>For NGOs</h5>
                        <p>Empower PwDs with skill training and job placement services.</p> 
                    </div>
                    <div>
                        <a href="{{ROOT_URL}}/user-login/3" class="btn btn-light">Lets Collaborate</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 mb-md-4 mb-3 mb-xl-0">
                <div class="card bg-light-blue">
                    <div class="card-body">
                        <img src="<?php echo PUBLIC_PATH; ?>images/gov-card.svg" alt="GOV.">
                        <h5>For  Government</h5>
                        <p>Join us to promote disability-inclusive policies and access to employment for persons with disabilities.</p> 
                    </div>
                    <div>
                        <a href="{{ROOT_URL}}/user-login/4" class="btn btn-light">Connect with Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- candidates, companies and ngos cardend-->
    <!-- take action -->
    <div class="container take-action-container">
        <div class="card flex-lg-row">
            <div class="card-left-img">
                <h4>Take Action</h4>
                <img src="<?php echo PUBLIC_PATH; ?>images/take-action-img.png"  alt="">
            </div>
            <div class="card-body">
                <a href="{{ROOT_URL}}/donate">
                    <span class="card-title">Donate</span>
                    <span>Joy. The three-letter word for donation</span>
                    <img src="<?php echo PUBLIC_PATH; ?>images/angle-arrow-right.svg" alt="">
                </a>
                <a href="{{ROOT_URL}}/volunteer">
                    <span class="card-title">Volunteer</span>
                    <span>Inclusive employment opportunities: Join us in promoting jobs for PwDs!</span>
                    <img src="<?php echo PUBLIC_PATH; ?>images/angle-arrow-right.svg" alt="">
                </a>
                <a href="{{ROOT_URL}}/pressrelease"> 
                    <span class="card-title">Press Release</span>
                    <span>Announcing The Say Foundation-Yunikee Partnership</span>
                    <img src="<?php echo PUBLIC_PATH; ?>images/angle-arrow-right.svg" alt="">
                </a>
            </div>
        </div>
    </div>
    <!-- take action end -->
    <!-- story -->
    <div class="container story-sec">
        <div class="row text-center text-lg-left">
            <div class="col-lg-4">
                <img src="<?php echo PUBLIC_PATH; ?>images/story-img.png" alt="story"
                    class="img-fluid d-block m-auto pr-lg-4 px-4   pl-lg-0">
            </div>
            <div class="col-lg">
                <h4 class="page-title">Emergence of The Say Foundation</h4>
                <p class="mb-1 mb-md-3">
                    The idea of SAY Foundation is a culmination of building foundation towards creating an ecosystem for Persons with Disabilities (PwDs).
                </p>
                <p class="mb-md-4 mb-2">
                    Initially, we were deliberating on the demand of hidden talent and addressing the needs of the institutions and organizations by building a solid workforce. We initially toyed with idea of carving out a niche for enabling the PwDs to the mainstream workforce, making them economically stable and consistently honing their skill set to become employable in today’s ever dynamic workplace. 
                </p>
                <a class="btn btn-outline-blue" href="{{ROOT_URL}}/about-us">Read More</a>
            </div>
        </div>
    </div>
    <!-- story end -->
 <!-- blogs -->
 <?php if($blogDetls->isNotEmpty()){ ?>
 <div class="container ">
        <h4 class="page-title text-center">The Say Blogs</h4>
        <div id="blog-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">   
            <?php $i=0; foreach($blogDetls as $blogDetl){ 
                // echo'<pre>';print_r($blogDetl);exit;
                ?>          
                <div class="carousel-item <?php echo $i=='0'?'active':''?>" data-interval="15000">                
                    <div class="carousel-card">                    
                       <div class="img">
                       <img src="<?php if(!empty($blogDetl->thumbnail_Image)){ echo ROOT_URL.'/storage/app/uploads/thumbnail/'.$blogDetl->thumbnail_Image; } else{ echo PUBLIC_PATH.'images/blog1.jpeg'; } ?>"
          class="d-block" alt="Blog">   
                       </div>                  
                        <div class="carousel-content">
                            <?php $blogTitle=wardWrap(htmlspecialchars_decode($blogDetl->blogTitle),50); ?>
                            <h5>{!!strip_tags($blogTitle)!!}</h5>
                            <?php $content=wardWrap(htmlspecialchars_decode($blogDetl->blogDetails),170); ?>
                            <p>{!!strip_tags($content)!!}</p>
                            <a href="{{ROOT_URL}}/LetsSay-OurBlogs/{{$blogDetl->blogSlug}}" class="btn btn-outline-light">Read More</a>
                        </div>                   
                    </div>
                </div>
                <?php $i++; } ?>
            </div>
            <a class="carousel-control-prev" href="#blog-carousel" role="button" data-slide="prev">
                <img src="<?php echo PUBLIC_PATH; ?>images/angle-arrow-left.svg" alt="">
            </a>
            <a class="carousel-control-next" href="#blog-carousel" role="button" data-slide="next">
                <img src="<?php echo PUBLIC_PATH; ?>images/angle-arrow-right.svg" alt="">
            </a>
        </div>
    </div>
<?php } ?>
    <!-- blogs end -->

   
    <!-- testimonial -->
    <!-- <div class="testimonial-sec">
        <div class="container">
            <div id="testimonial-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#testimonial-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#testimonial-carousel" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-interval="5000">
                        <div class="carousel-card">
                            <div class="carousel-item-img">
                                <img src="<?php //echo PUBLIC_PATH; ?>images/testimonial-img.png"
                                    class="img-fluid d-block" alt="Blog">
                            </div>
                            <div class="carousel-content"> 
                                <div class="text-left">
                                    <i class="icon-line-awesome-quote-left"></i>
                                </div>
                                <h5> 
                                    The standard Lorem Ipsum passage, used since the 1500s
                                </h5>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                                </p>
                                <div class="testimonial-name">John O'Neill</div>
                                <div class="testimonial-position text-muted">General Manager, Hickorys Smokehouse</div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" data-interval="5000">
                        <div class="carousel-card">
                            <div class="carousel-item-img">
                                <img src="<?php //echo PUBLIC_PATH; ?>images/testimonial-img.png"
                                    class="img-fluid d-block" alt="Blog">
                            </div>
                            <div class="carousel-content">
                                <div class="text-left">
                                    <i class="icon-line-awesome-quote-left"></i>
                                </div>
                                <h5> 
                                    The standard Lorem Ipsum passage, used since the 1500s
                                </h5>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                                </p>
                                <div class="testimonial-name">John O'Neill</div>
                                <div class="testimonial-position text-muted">General Manager, Hickorys Smokehouse</div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#testimonial-carousel" role="button" data-slide="prev">
                    <img src="<--?php //echo PUBLIC_PATH; ?>images/angle-arrow-left.svg" alt="">
                </a>
                <a class="carousel-control-next" href="#testimonial-carousel" role="button" data-slide="next">
                    <img src="<--?php //echo PUBLIC_PATH; ?>images/angle-arrow-right.svg" alt="">
                </a>
            </div>

        </div>
    </div> -->
    <!-- testimonial end -->
    <?php if(isset($testimonials) && $testimonials->isNotEmpty()){ ?>
        <div class="testimonial-sec">
        <div class="container">
            <div id="testimonial-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                <?php if(isset($testimonials) && $testimonials->isNotEmpty()){ 
                $tsmCount=count($testimonials); 
                    for($cnt=0;$cnt<$tsmCount;$cnt++) { ?>
                    <li data-target="#testimonial-carousel" data-slide-to="{{$cnt}}" class="{{$cnt == '0' ?'active':''}}"></li>                   
                <?php } } ?>  
                </ol>
                <div class="carousel-inner">
                    <?php $cntt=1; foreach($testimonials as $testimonial){  ?>
                    <div class="carousel-item <?php echo $cntt == '1' ? 'active':''; ?>" data-interval="5000">
                        <div class="carousel-card">
                            <div class="carousel-item-img">
                                <img src="<?php if(!empty($testimonial->tsmImage)){ echo ROOT_URL.'/storage/app/uploads/testimonial/'.$testimonial->tsmImage; } else{ echo PUBLIC_PATH.'images/testimonial-img.png'; } ?>"                                   class="img-fluid d-block" alt="Testimonial">
                            </div>
                            <div class="carousel-content"> 
                                <div class="text-left">
                                    <i class="icon-line-awesome-quote-left"></i>
                                </div>
                                <h5>{{$testimonial->tsmTtitle?$testimonial->tsmTtitle:''}}</h5>                                   
                                <p>{{$testimonial->tsmContent?$testimonial->tsmContent:''}}</p>                                     
                                <div class="testimonial-name">{{$testimonial->tsmName?$testimonial->tsmName:''}}</div>
                                <div class="testimonial-position text-muted">{{$testimonial->tsmDesignation?$testimonial->tsmDesignation:''}}, {{$testimonial->tsmAddress?$testimonial->tsmAddress:''}}</div>
                            </div>                                                        
                        </div>
                    </div>
                    <?php $cntt++; } ?>
                </div>
                <a class="carousel-control-prev" href="#testimonial-carousel" role="button" data-slide="prev">
                    <img src="<?php echo PUBLIC_PATH; ?>images/angle-arrow-left.svg" alt="">
                </a>
                <a class="carousel-control-next" href="#testimonial-carousel" role="button" data-slide="next">
                    <img src="<?php echo PUBLIC_PATH; ?>images/angle-arrow-right.svg" alt="">
                </a>
            </div>

        </div>
    </div>

  <?php  } ?>
    <!-- activities -->
    <!-- <div class="container text-center activities-container">
        <h4 class="page-title">Say Activities</h4>
        <div class="row">
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card">
                    <img src="<?php echo PUBLIC_PATH; ?>images/employers.jpg" class="card-img-top" alt="Employers">
                    <div class="card-body">
                        <h5 class="card-title">Employers</h5>
                        <p class="card-text">Enable Organizations including Govt. to become leaders in Diversity &
                            Inclusion with special focus on Disability Index</p>
                        <a href="{{ROOT_URL}}/employers" class="btn btn-outline-blue">Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card">
                    <img src="<?php echo PUBLIC_PATH; ?>images/pwds.jpg" class="card-img-top"
                        alt="Persons with Disabilities">
                    <div class="card-body">
                        <h5 class="card-title">Persons with Disabilities <small>(PwDs)</small></h5>
                        <p class="card-text">Enable PwDs to realize their potential and promote a more inclusive world
                        </p>
                        <a href="{{ROOT_URL}}/persons-with-disabilities" class="btn btn-outline-blue">Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card">
                    <img src="<?php echo PUBLIC_PATH; ?>images/ngo-and-communities.jpg" class="card-img-top"
                        alt="NGOs and Communities ">
                    <div class="card-body">
                        <h5 class="card-title">NGOs and Communities</h5>
                        <p class="card-text">Collaborate with Associations and NGOs to create an inclusive eco-system to
                            develop and upskill...</p>
                        <a href="{{ROOT_URL}}/ngo-and-communities" class="btn btn-outline-blue">Read more</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- activities end -->
    <!-- signup section -->
    <div class="signup-sec text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-8">
                    <h4 class="page-title mb-1">Sign Up to hear our latest developments</h4>
                    <p class="mb-4">Stay updated with the latest developments in policy, new jobs etc, signup for our
                        newsletter</p>
                </div>
                <div class="col-md-8 col-lg-6 d-flex">
                    <form action="" method="post" class="flex-grow-1 mb-0">
                            {{csrf_field()}} 
                        <input type="email" class="form-control" placeholder="Your Email Id" name="emailSubscription" id="emailSubscription">
                        <span class="errMsg_emailSubscription errDiv"></span> 
                        <!-- <span class="succMsg_emailSubscription errDiv"></span>                                          -->
                    </form>
                    <button class="btn btn-light ml-md-4 ml-2 mb-3 text-nowrap userSubscription" type="button" onclick="return validateSubscriber();"><span>Sign Up</span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="social-sec text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-8">                   
                    <iframe src='https://widgets.sociablekit.com/linkedin-page-posts/iframe/130625' frameborder='0'
                        width='100%' height='400px'></iframe>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="signup-sec text-center">
        <div class="container">
            <div class="row justify-content-center">
            <div class='sk-ww-linkedin-page-post' data-embed-id='130625'></div><script src='https://widgets.sociablekit.com/linkedin-page-posts/widget.js' async defer></script> 
            </div>
            </div>
    </div> -->
   
    <!-- signup section end -->

    <!-- signup section end -->
    @section('page-js')
    <script src="<?php echo PUBLIC_PATH; ?>js/popper.min.js"></script>
    <script src="<?php echo PUBLIC_PATH; ?>js/bootstrap.min.js"></script>

    <script>
 function validateSubscriber(){   
   $('.errDiv').hide();
   $('.error-input').removeClass('error-input');
   if (!blankCheck('emailSubscription', 'Email Id can not be left blank'))
       return false;
   if (!validEmail('emailSubscription'))
       return false;   

     var emailSubscription=$("#emailSubscription").val();
    
     $.ajax({
       type: 'POST',
       url: SITE_URL + "/website/ajax/newsletterSubscription",
       data: {emailid:emailSubscription},
       //data:  $('#employeerlogin-form').serialize(),
      // async: false,
       dataType:"json",
        processData: true,
        beforeSend: function() {
             $(".userSubscription").attr('disabled','disabled');
            $(".userSubscription span").text('Signing Up...');              
         },
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       success: function (res) {      
          $(".userSubscription span").text('Sign Up');
           $(".userSubscription").removeAttr('disabled');       
          if(res.status==200){
            $('.errDiv').show();
            $(".errMsg_emailSubscription").text(res.msg); 
            $("#emailSubscription").val('');     
         } else if(res.status==500) {
            $('.errDiv').show();
            $(".errMsg_emailSubscription").text(res.msg);         
          return false;          
        } else {
            $('.errDiv').show();
            $(".errMsg_emailSubscription").text("Subscription Failed");         
          return false; 
         }     
         
       } 
         });
  }
  </script>

    @endsection
@endsection


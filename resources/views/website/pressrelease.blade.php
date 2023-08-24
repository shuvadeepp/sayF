@extends('layouts.website')
@section('page-content')
@section('page-css')
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/press-release.css">
@endsection

<!-- Titlebar -->
<!-- <div id="titlebar" class="gradient">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h2>Press Release</h2>
            <nav id="breadcrumbs">
               <ul>
                  <li><a href="{{ROOT_URL}}">Home</a></li>
                  <li>Press Release</li>
               </ul>
            </nav>
         </div>
      </div>
   </div>
</div> -->
<!-- <div class="section section--content"> -->
   <div class="container mb-md-4 mb-3">
      <div class="inner-page-baner">
      <?php if(isset($banners) && $banners->isNotEmpty()){ ?>
      <img src="<?php if(!empty($banners[0]->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banners[0]->bannerImage; } else{ echo PUBLIC_PATH.'images/press-release.png'; } ?>" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
          <strong>{{$banners[0]->bannerTitle}}</strong> - <br> {{$banners[0]->bannerText}}
      </div>
      <?php } else { ?>
         <img src="<?php echo PUBLIC_PATH; ?>images/press-release.png" class="d-block" alt="banner">
         <div class="inner-page-baner-content">
            <strong>Press Release</strong> - <br> Stay up-to-date with our press releases
         </div>
         <?php } ?>
      </div>
      <div class="row">
         <div class="col-lg order-lg-2">
            <div class="utf-sidebar-container-aera"> 
               <div class="utf-sidebar-widget-item">
                 <h3>Latest</h3>
                 <ul class="press-release-list">                 
                    <?php if($latestData->isNotEmpty()){ 
                        foreach($latestData as $latest) { ?>
                    <li class="{{$activeContentId==$latest->preleaseId ?'active':''}}">
                       <span class="press-date">
                          <span class="day">{{date('d',strtotime($latest->publishDate))}}</span>
                          <span> {{date('M',strtotime($latest->publishDate))}}</span>
                          <span>{{date('Y',strtotime($latest->publishDate))}}</span>
                       </span>
                       <span>
                          <a href="{{ROOT_URL}}/pressrelease/{{$latest->pressSlug}}" data-url="{{ROOT_URL}}/pressrelease/{{$latest->pressSlug}}" class="press-release-list-title">
                             {{$latest->pressTitle}}
                          </a> 
                          <small class="press-release-time">
                        <?php 
                         $datediff = strtotime($latest->publishDate) - strtotime(date('Y-m-d H:i:s'));
                              $dayDifference= round($datediff / 86400);                             
                             ?>
                             <span>{{abs($dayDifference)!='0'?abs($dayDifference):''}} <?php if(abs($dayDifference) == '1'){ echo 'day ago';} else if(abs($dayDifference) == '0'){ echo 'Today';} else { echo'days ago';} ?></span>  
                             @if(!empty($latest->source))
                             <span>,</span><strong class="pl-2"> Source : </strong>
                             <a href="javascript:;" target="_blank">{{$latest->source}}</a>
                             @endif
                          </small>
                       </span>
                    </li>
                    <?php } } else { ?>
                     <p>No record found</p>
                     <?php } ?>
                 </ul>
               </div>
            </div>
         </div>
         <div class="col-lg-8 order-lg-1">
            <div class="Yunikee-page">
               <?php if(isset($pressDetls) && !empty($pressDetls)) { //print_r($pressDetls); echo $pressDetls[0]->source; ?>
                  <h3 class="text-primary">{{$pressDetls->pressTitle}}</h3>
               <div class="mb-3">Published On {{date('d M, Y',strtotime($pressDetls->publishDate))}}</div>               
               <p> <?php echo htmlspecialchars_decode($pressDetls->pressDetails); ?> </p>
                  <?php } else { ?>
                     <p>No record found</p>
              <!-- <h3 class="text-primary">Announcing The Say Foundation-Yunikee Partnership</h3>
               <div class="mb-3">Published On December 3rd, 2022</div>
               <h4 class="mb-3">The Say Foundation Partners with Yunikee to enable job opportunities for Persons with Disabilities (PwDs)</h4>
               <div class="partner-img-container">
                  <img src="<?php //echo PUBLIC_PATH; ?>images/logoone.png" alt="say foundation logo">
                  <img src="<?php //echo PUBLIC_PATH; ?>images/yunikee.png" alt="yunikee logo">
               </div>
               <p>Today, The Say foundation announced its partnership with Yunikee to enable jobs with Persons with Disabilities in India. The Say Foundation will collaborate with Yunikee to identify jobs, source talent & opportunities for Persons with Disabilities, especially the deaf.</p>
               <p>The Say Foundation has initiated a registration drive for the deaf on their website, so that they can be intimated about the job opportunities available in different organisations across sectors. The registration drive is for Sign Medium participants who have already completed their certification with Yunikee-Sign Medium.</p>
               <p>"This collaboration with Yunikee is very exciting and provides us the right foot hold to create an inclusive eco-system for the Persons with Disabilities. We will be working closely with the Yunikee team to empower the deaf and make them self-reliant, financially independent and productive contributors of the society." - said Swati Yadav, CEO of The Say Foundation</p>
               <p>The aim of Say Foundation is to provide Persons with Disabilities with the right jobs, collaborate with NGOs by providing them a platform to share the skills of their associates and promote their organisation.</p>
               <p>In additon, Say Foundation works closely with the Government by accurately informing them about the happenings in the world of Persons with Disabilities, recommending/influencing policies that will create a positive impact on the lives of the Persons with Disabilities.</p>
               <p>Chaithanya, Co-Founder of Yunikee said "We are the preferred partners for the Deaf community. We have trained over 5,500+ deaf candidates in over 30+ skills in India. Our focus is on digital and in-demand skills that help the deaf community secure a high quality of life.</p>
               <p>The fundamental objective of our collaboration with Say Foundation is to provide employment for these skilled deaf associates and promote our programs to more Persons with Disabilities through the network of Say Foundation.</p>
               <p>The Say Foundation and Yunikee have entered into a partnership to enable job opportunities for Persons with Disabilities. This is exciting for both the organizations as we both have the common goal – of empowering Persons with Disabilities and making them financially independent.</p> -->
           <?php } ?>
            </div>

         </div> 
      </div>
      
      <div class="row mt-4 mb-4 mb-md-5">
         <div class="col-lg-6 col-xl-8">
            <div class="light-green-card">
               <h4 class="text-primary">
                  Follow Us
               </h4>
               <p>Stay up-to-date with SAY Foundation's latest news and events by following us on social media.</p>
               <div class="follow-link">
                  <a href="https://www.linkedin.com/company/the-say-foundation/" target="_blank" class="linkedin-link">
                     <i class="icon-brand-linkedin"></i>
                     <span>LinkedIn</span>
                  </a>
                  <a href="https://www.instagram.com/TheSAYFoundation/" target="_blank" class="instagram-link">
                     <i class="icon-brand-instagram"></i>
                     <span>Instagram</span>
                  </a>
                  <a href="https://www.facebook.com/TheSAYFoundation/" target="_blank" class="facebook-link">
                     <i class="icon-brand-facebook"></i>
                     <span>Facebook</span>
                  </a>
                  <a  href="https://twitter.com/TSAYFoundation" target="_blank" class="twitter-link">
                     <i class="icon-brand-twitter"></i>
                     <span>Twitter</span>
                  </a>
               </div>
               <p>Thank you for your interest in SAY Foundation and our mission to empower PwDs. We look forward to working with you
                  to create a more inclusive and accessible world for all.</p>
            </div>
         </div>
         <div class="col-lg-6 col-xl-4"> 
            <div class="light-green-card contact-card">
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
            </div>
         </div>
      </div>
   </div>
<!-- </div> -->
@endsection

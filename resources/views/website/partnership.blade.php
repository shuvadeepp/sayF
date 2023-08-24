@extends('layouts.website')
@section('page-content')
@section('page-css')
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/lightgallery.min.css">
@endsection
<!-- Titlebar -->
<div id="titlebar" class="gradient">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h2>Announcing The Say Foundation - Yunikee Partnership</h2>
            <nav id="breadcrumbs">
               <ul>
                  <li><a href="{{ROOT_URL}}">Home</a></li>
                  <li>Announcing The Say Foundation - Yunikee Partnership</li>
               </ul>
            </nav>
         </div>
      </div>
   </div>
</div>
<div class="section section--content">
   <div class="container">
      <div class="Yunikee-page">
         <div class="one-section text-center">
            <h1 class="mb-5">Announcing The Say Foundation - Yunikee Partnership</h1>
            <div class="row ">
               <div class="col-lg-6 col-md-12 col-sm-12">
                  <img src="<?php echo PUBLIC_PATH; ?>images/logoone.png" alt="say foundation logo">
                  <p class="mt-4"><strong>Say Foundation</strong> aims to create an inclusive ecosystem for Persons with Disabilities (PwDs). Say’s mission is to empower PwDs to become self-reliant, financially independent    and productive contributors of the society.</p>
               </div>
               <div class="col-lg-6 col-md-12 col-sm-12">
                  <img src="<?php echo PUBLIC_PATH; ?>images/yunikee.png" alt="yunikee logo">
                  <p class="mt-4 mb-0"><strong>Yunikee</strong> is founded by a team which comprises of 95% of deaf people.</p>
                  <p >Yunikee’s flagship learning solution “Sign Medium” - the only learning platform that provides accessible skill-building programs in Indian Sign Language.</p>
               </div>
            </div>
         </div>
         <div class="video-section">
            <video controls id="the_say_foundation">
               <source src="" type="video/mp4">
            </video>
         </div>
         <div class="two-section">
            <h1 class="mb-5">Bringing JOY to all stakeholders</h1>
            <div class="row">
               <div class="col-lg-8 col-md-12 col-sm-12">
                  <p>The SAY Foundation is providing JOY to all stakeholders in the PwD space.</p>
                  <p>Joy to the PwDs by providing them appropriate jobs to live a fulfilled life.</p>
                  <p>Joy to the Employers by giving them an opportunity to hire PwDs who would lift the whole office environment by mixing abled bodied people with PwDs. It’s a Joy that can only be experienced.</p>
                  <p>Joy to the NGOs by providing them a platform to share their skills and promote their organization. They work hard in training and placing the PwDs in different organizations.</p>
                  <p>Joy to the Government by accurately informing them about the happenings in the world of PwDs and recommend/ influence what should be done to improve the lives of PwDs. This in turn would uplift society at large and the country specifically. </p>
               </div>
               <div class="col-lg-4 col-md-12 col-sm-12">
                  <img src="<?php echo PUBLIC_PATH; ?>images/joyfreedom.jpg" alt="Towards Finance Freedom" class="freedom">
               </div>
            </div>
         </div>
         <div class="three-section">
            <h1 class="mb-5">Key Objectives of The Say Foundation</h1>
            <div class="row">
               <div class="col-lg-4 col-md-12 col-sm-12">
                  <img src="<?php echo PUBLIC_PATH; ?>images/ourvalues.jpg" alt="Our Values" >
               </div>
               <div class="col-lg-8 col-md-12 col-sm-12">
                  <div class="box-parent">
                     <div class="box">
                        <strong>Persons with Disabilities (PwDs)</strong>
                        <p>Provide a platform for job opportunities</p>
                     </div>
                     <div class="box">
                        <strong>Employers </strong> 
                        <p> Assist them with a pool of PwDs for them to hire and leverage this excellent set of people to build their organization</p>
                     </div>
                     <div class="box">
                        <strong>NGOs </strong>
                        <p> A Create a sharing platform and combine together to assist PwDs get jobs and lead an independent life</p>
                     </div>
                     <div class="box">
                        <strong>Government</strong>
                        <p> Provide information to make policy changes and influence leaders in the Government to improve lives of PwDs</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="section-three-sub">
            <h1 class="mb-5">Our website accessible to everyone. Just like us</h1>
            <div class="row">
               <div class="col-lg-6 col-md-12 col-sm-12">
                  <p>Our website, <a href="{{ROOT_URL.'/'}}" target="_blank">www.thesayfoundation.com</a> has all the accessible features with which all types of PwDs can navigate our site, register themselves as a candidate and even share the link / print the form which would convert to a resume for submission to different job opportunities.</p>
               </div>
               <div class="col-lg-6 col-md-12 col-sm-12">
                  <img src="<?php echo PUBLIC_PATH; ?>images/navigationleftright.jpg" alt="accessible features" class="navigation">
               </div>
            </div>
         </div>
         <div class="four-section">
            <h1 class="mb-5">Why is Yunikee the preferred learning partner for the Deaf community?</h1>
            <div class="row">
               <div class="col-lg-9 col-md-12 col-sm-12">
                  <p>Since its inception in 2018, Yunikee has trained over 5,500+ deaf candidates in over 30+ skills and enabled them to be financially self-reliant.</p>
                  <p>Our courses are in the process of accreditation from NIOS, Gallaudet University (USA) & Rochester University (USA).</p>
                  <div class="focus">
                     <p>Our focus is on digital and in-demand skills that help the deaf community secure a high quality of life. Listed below are a few courses for your reference. </p>
                     <ol >
                        <li>Web Development</li>
                        <li>Graphic Design</li>
                        <li>Animation</li>
                        <li>Video Editing</li>
                        <li>Interior Designing</li>
                        <li>Stock Trading</li>
                        <li>Photography</li>
                     </ol>
                  </div>
               </div>
               <div class="col-lg-3 col-md-12 col-sm-12">
                  <ul class="courses">
                  <li>
                     <span class="img-rounder"><img src="<?php echo PUBLIC_PATH; ?>images/onlinecouse.png" alt="50+ Online courses"> </span>
                     <span class="text"><strong>50+  </strong><br> Online courses</span>
                  </li>
                  <li>
                     <span class="img-rounder"> <img src="<?php echo PUBLIC_PATH; ?>images/student.png" alt="5000+ Students"></span>
                     <span class="text"><strong>5000+</strong> <br>  Students</span>
                  </li>
                  <li>
                     <span class="img-rounder"><img src="<?php echo PUBLIC_PATH; ?>images/lifecontent.png" alt="Lifetime Content"></span>
                     <span class="text"><strong>Lifetime </strong><br>  Content</span>
                  </li>
               </div>
            </div>
         </div>
         <div class="five-section">
            <h1 class="mb-5">Champions League - Premier Entrepreneurship Program for Deaf Young Adults</h1>
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12">
                  <p class="mb-0">This is a program that we are currently running through our platform sign medium.
                     A custom-designed ‘start-up incubator’ for aspiring entrepreneurs from the deaf community. The program evaluates prospective applicants on their business ideas, mentors them to create business plans, set up the infrastructure, connect with key stakeholders, and help create the eco-system required to kick-start their business. 
                  <p>
                  <p>We have already helped over 20 deaf young entrepreneurs & freelancers and this includes, being a video editor on fiverr, photoshop & graphic designer on freelancer, and an online bakery.</p>
               </div>
               <div class="col-lg-12 col-md-12 col-sm-12">
                  <p>Use the link to register yourself so that we can share your profiles with organizations across the country who are hiring deaf people.</p>
                  <h3 class="mb-2 mt-4">Resources</h3>
                  <p class="sign-midus">Sign Medium participants can log in <a href="https://signmedium.in/account/login" target="_blank">https://signmedium.in/account/login</a> to continue accessing the resources. Feel free to connect with us for more specific help in your quest for finding jobs for yourself.
                  <p>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12">
                  <section class="blogs">
                     <div class="utf-testimonial-carousel-block">
                        <div class="utf-carousel-review-item">
                           <div class="testiminial">
                              <img src="<?php echo PUBLIC_PATH; ?>images/testimonialone.png" alt="Amol Changole image">
                              <span>
                                 <h6>Testimonials</h6>
                                 <p> The start up business weekend workshop has helped me define by own business goals and I am now ready to start my own business soon!</p>
                              </span>
                           </div>
                           <p class="title">Amol Changole</p>
                        </div>
                        <div class="utf-carousel-review-item">
                           <div class="testiminial">
                              <img src="<?php echo PUBLIC_PATH; ?>images/testimonialtwo.png" alt="Renu Ahuja image">
                              <span>
                                 <h6>Testimonials</h6>
                                 <p>  The things l learned in the business courses have given me a clear line of sight on what it takes. I learnt about BMC, SWOT & Business Plan.</p>
                              </span>
                           </div>
                           <p class="title">Renu Ahuja</p>
                        </div>
                        <div class="utf-carousel-review-item">
                           <div class="testiminial">
                              <img src="<?php echo PUBLIC_PATH; ?>images/testimonialthree.png" alt="Sagar Ali Khan image">
                              <span>
                                 <h6>Testimonials</h6>
                                 <p> This is the first time that exam coaching for bank exam and SBI exam is now available in sign language. I am thankful for all the help!</p>
                              </span>
                           </div>
                           <p class="title">Sagar Ali Khan</p>
                        </div>
                     </div>
                  </section>
               </div>
            </div>
         </div>
         <div class="six-section">
            <h1 class="mb-5 text-center">The Story of Our 1<sup>st </sup> Hire Via The Say Foundation’s Partnership and Yunikee </h1>
           <!--  <section class="timeline">
               <ul>
                  <li>
                     <div class="card">
                        <div class="row">
                           <div class="col-lg-4 col-md-12 col-sm-12"> <img src="<?php echo PUBLIC_PATH; ?>images/puneet.jpg" alt="puneet" class="timeline-one-img"> </div>
                           <div class="col-lg-8 col-md-12 col-sm-12">
                              <p>
                                 <strong>Puneeth Kumar –</strong> 
                              deaf by birth - had tried everything to get a job. While he was not brilliant in the 10<sup>th</sup> grade, he slowly understood the value of education. This increased focus on studies translated into good grades – 12<sup>th</sup>, then graduation in Commerce along with Computer Science from Hyderabad.
                              </p>
                           </div>
                        </div>
                     </div>
                  </li>

                  <li>
                     <div class="card">
                        <div class="row">
                           <div class="col-lg-8 col-md-12 col-sm-12">
                              <p>But still no Job.</p>
                  <p>Via his own network, he did apprenticeship training at Electronic Corporation of India Limited, Hyderabad. Unfortunately, he still did not get a full-time job.</p>
                  <p>Puneeth was definitely at his wit’s end.</p>
                           </div>
                           <div class="col-lg-4 col-md-12 col-sm-12"> <img src="<?php echo PUBLIC_PATH; ?>images/job.jpg" alt="International" class="timeline-two-img"></div>
                        </div>
                     </div>
                  </li>

                  <li>
                     <div class="card">

                         <div class="row">
                           <div class="col-lg-4 col-md-12 col-sm-12"> <img src="<?php echo PUBLIC_PATH; ?>images/sign_medium.jpg" alt="sign medium"  class="timeline-three-img">   </div>
                           <div class="col-lg-8 col-md-12 col-sm-12">
                              <p>Someone suggested that he invest in a certification course by Yunikee’s Sign Medium*.</p>  
                  <p>This is a specialized course for Deaf students/candidates across India.</p> 
                  <p>99% of the 25-member Yunikee team is deaf (including 2 founders) and hence have designed the course to get the deaf job ready.</p>
                  <p>Puneeth got certified by Sign Medium and all set for interviews –armed with this new certification.</p>
                           </div>
                        </div>
                      
                        
                     </div>
                  </li>

                  <li>
                     <div class="card">
                        <div class="row">
                           <div class="col-lg-8 col-md-12 col-sm-12">
                              <p><strong>Yunikee-Say Foundation Partnership</strong> </p>
                  <p class="mb-3">The Say Foundation & Yunikee came together for partnership** . Yunikee will certify the deaf students after the course and The Say Foundation will have its job portal accessible for <strong>free to Employers and all PwDs across the country.</strong> </p>
                           </div>
                           <div class="col-lg-4 col-md-12 col-sm-12">
                              <img src="<?php echo PUBLIC_PATH; ?>images/yunikee.png" alt="yunikee" >
                  <img src="<?php echo PUBLIC_PATH; ?>images/logoone.png" alt="the say foundation" > </div>
                        </div>

                        
                         
                     </div>
                  </li>

                  <li>
                     <div class="card">
                        <div class="row">
                           <div class="col-lg-4 col-md-12 col-sm-12"> <img src="<?php echo PUBLIC_PATH; ?>images/VisionTek.jpg" alt="VisionTekn" >  </div>
                           <div class="col-lg-8 col-md-12 col-sm-12">
                               <p><strong>VisionTek (Linkwell Telesystems) – The Say Foundation Partnership</strong></p>
                  <p>Swati Yadav, the founder of The Say Foundation, and Ramesh, CEO of Visiontek connected and had discussions. Ramesh ji was more than willing to explore hiring of PwDs for his organization. This would be their 1<sup>st </sup>  PwD hire.</p>
                  <p>2 weeks after the Yunikee course, and 1 week after The Say Foundation shared the portal / CV with Visiontek’s HR, Geetha, Puneeth was immediately contacted. </p>
                           </div>
                        </div>
                       
                        
                     </div>
                  </li>

                  <li>
                     <div class="card">
                         <div class="row">
                           <div class="col-lg-8 col-md-12 col-sm-12">
                               <p> Excited at the opportunity, he went to the corporate office the next day, was interviewed by Geetha and a couple of others and gave Puneeth the job offer.</p>

<p>Since this was the 1<sup>st </sup> job offer to a PwD that was meant for the “regular” folks, they modified the job description.</p>
                           </div>
                           <div class="col-lg-4 col-md-12 col-sm-12">
                              <img src="<?php echo PUBLIC_PATH; ?>images/corporate_office.jpg" alt="corporate office"> </div>
                        </div>

                     
                       
                     </div>
                  </li>

                  <li>
                     <div class="card">
                         <div class="row">
                           <div class="col-lg-4 col-md-12 col-sm-12">  <img src="<?php echo PUBLIC_PATH; ?>images/puneet_joy.jpg" alt="Puneeth accepted the offer gleefully and joined the office">  </div>
                           <div class="col-lg-8 col-md-12 col-sm-12">
                                <p>Puneeth accepted the offer gleefully and joined the office the next day after celebrating the news with his parents and wife.</p>
                           </div>
                        </div>
                        
                      
                     </div>
                  </li>
               </ul>
            </section>
 -->

 <img src="<?php echo PUBLIC_PATH; ?>images/timeline-story-compose.jpg" alt="The Story of Our 1st Hire Via The Say Foundation’s Partnership and Yunikee">



           
         </div>
         <div class="seven-section">
            <h1 class="mb-5">How should you maximize benefit from this partnership between The Say Foundation and Yunikee?</h1>
            <p>All Sign Medium participants can login to <a href="https://thesayfoundation.com/jobsearch" target="_blank">https://thesayfoundation.com/jobsearch</a>  , register themselves.</p>
            <ol class="pl-3">
               <li>Get regular job updates </li>
               <li>Apply for relevant jobs </li>
               <li>Allow their CVs to potential employers – both Government and Private .</li>
            </ol>
            <p>For more information or queries - write to <strong><a href="javascript:void(0);">contactus@thesayfoundation.com</a></strong></p>
            <p class="mb-1">
               <a href="https://signmedium.in/" target="_blank" class="sign-btn">Sign Medium</a>
               <a href="{{ROOT_URL.'/pressrelease'}}" class="link-btn" >Press Release</a>
            </p>
         </div>
          
      </div>
   </div>
</div>
@section('page-js')
@endsection
@endsection
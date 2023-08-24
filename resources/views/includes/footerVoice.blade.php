<!-- Footer -->
<footer>
  <div class="utf-footer-section-item-block">
    <div class="container ">
      <div class="row">
        <div class="col-lg-4 col-xl-5">
          <a href="{{ ROOT_URL }}">
              <img class="footer-logo" src="<?php echo PUBLIC_PATH; ?>images/logo.svg" alt="The Say Foundation">
            </a>
            <p>The SAY Foundation aim is to create an inclusive ecosystem for Persons with Disabilities (PwDs). SAY’s mission is to empower the PwDs to become self-reliant, financially independent and productive contributors of the society.(footer)</p>
            <hr class="d-lg-none">
        </div>

        <div class="col-lg col-6 col-md-4 mb-2 mb-md-0">
          <div class="utf-footer-item-links mt-lg-5">
            <ul>
              <!-- <li><a href="javascript:;"><span>Sensitizing Corporates</span></a></li>
              <li><a href="javascript:;"><span>Policy Advocacy</span></a></li>
              <li><a href="javascript:;"><span>Job Portal</span></a></li> -->
              <li><a href="#small-dialog-2" class="popup-with-zoom-anim partnerlogin"><span>NGO Login</span></a></li>
              <li><a href="#small-dialog" class="popup-with-zoom-anim"><span>Candidate Login</span></a></li>
              <li><a href="#utf-signin-dialog-block" class="popup-with-zoom-anim"><span>Employer Login</span></a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg col-6 col-md-4">
          <div class="utf-footer-item-links mt-lg-5">
            <ul>
             <!--  <li><a href="javascript:;"><span>Success Stories</span></a></li> -->
              <li><a  href="{{ROOT_URL.'/blog'}}"><span>Our Blogs</span></a></li>
              <li><a href="{{ROOT_URL.'/connect'}}"><span>Contact Us</span></a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg col-6 col-md-4">
          <div class="utf-footer-item-links mt-lg-5">
            <ul>
              <!-- <li><a href="javascript:;"><span>Share</span></a></li> -->
              <li><a href="#small-dialog-3" class="take__link popup-with-zoom-anim cand login"><span>Volunteer</span></a></li>
             <!--  <li><a href="#small-dialog-4" class="take__link popup-with-zoom-anim cand login"><span>Donate</span></a></li> -->
             <li><a href="#exampleModal" data-toggle="modal" ><span>Donate</span></a></li>
            </ul>
          </div>
        </div>

        
      </div>
    </div>
  </div>

  <!-- Footer Copyrights -->
  <div class="footer-copyright px-3">
    <div class="container ">
    <div class="d-md-flex justify-content-md-between align-items-md-center ">
       <div> Copyright &copy; <?php echo date('Y');?> All Rights Reserved. W3C Compliant.</div>
       <div class="mt-1 mt-md-0 footer__followus-link">
            <a class="ss-btn ss-btn-facebook" href="https://www.facebook.com/TheSAYFoundation/" target="_blank" title="Facebook">
              <i class="icon-brand-facebook-f" ></i>
            </a>
            <a class="ss-btn ss-btn-twitter" title="Twitter" href="https://twitter.com/TSAYFoundation" target="_blank" >
              <i class="icon-feather-twitter"></i>
            </a>
            <a class="ss-btn ss-btn-linkedin" title="Linkedin" href="https://www.linkedin.com/company/the-say-foundation" target="_blank" >
              <i class="icon-brand-linkedin-in" ></i>
            </a>
            <a class="ss-btn ss-btn-instagram" title="Instagram" href="https://www.instagram.com/TheSAYFoundation/" target="_blank" >
              <i class="icon-feather-instagram" ></i>
            </a>
          </div>
      </div>  
      </div>
    </div>
  <!-- Footer Copyrights / End -->
</footer>

<!-- share media -->
<div class="share-media">
  <span class="icon-feather-share-2 share-media__share"></span>
  <div class="ss-box ss-circle share-media__media" data-ss-content="false" data-ss-social="facebook, twitter, linkedin, whatsapp"></div>
</div>
<!-- share media end-->
<!-- cookies -->
<div class="cookies" >
    <span>We collect and use cookies to give you the best and most relevant website experience.</span>
    <a href="javascript:void(0)" class="cookies__close">Accept</a>
</div>
<!-- cookies end-->

<!-- Footer / End -->
@include('components.website-home-modal')


<!-- code for voicebot -->

<link rel="stylesheet" href="<?php echo ROOT_URL; ?>/voicebot/styles.a04c886c1a9c73d4d80a.css">
  <app-root></app-root>
<script src="<?php echo ROOT_URL; ?>/voicebot/runtime-es2015.0dae8cbc97194c7caed4.js" type="module"></script>
<script src="<?php echo ROOT_URL; ?>/voicebot/runtime-es5.0dae8cbc97194c7caed4.js" nomodule defer></script>
<script src="<?php echo ROOT_URL; ?>/voicebot/polyfills-es5.2237b5d0d7a85091411d.js" nomodule defer></script>
<script src="<?php echo ROOT_URL; ?>/voicebot/polyfills-es2015.f332a089ad1600448873.js" type="module"></script>
<script src="<?php echo ROOT_URL; ?>/voicebot/main-es2015.7b47d6def9eb4ce8477e.js" type="module"></script>
<script src="<?php echo ROOT_URL; ?>/voicebot/main-es5.7b47d6def9eb4ce8477e.js" nomodule defer></script>

<!-- voicebot code ends here -->
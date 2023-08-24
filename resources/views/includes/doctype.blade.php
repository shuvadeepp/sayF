<meta charset="UTF-8">
<base href="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">    
<title>The Say Foundation : Cause creates competence & character</title>
<!--  Favicon -->
<link rel="shortcut icon" href="<?php echo PUBLIC_PATH; ?>images/favicon.png">
<meta name="keywords" content="The Say Foundation, DISCOVER THE JOY, NGO PARTNERSHIPS, GET INSPIRED, INCREASED GOVERNMENT PARTICIPATION, DONATE, VOLUNTEER">
<meta name="description" content="The Say Foundation,Discover the joy of inclusion in the workplace through jobs for persons with disabilities,Empowering disabled individuals, transforming the community. Join forces with The Say Foundation, create opportunities for all,People with disabilities can teach the importance of adaptability and flexibility to a team, similar to how sports teams adapt to differents,Jobs for disabled, progress for all,Donate, bring Joy to the lives of persons with disabilities. Experience Joy yourself,Empower PwDs, volunteer for inclusive job opportunities. Join us now!">
<!-- datepicker -->
<!-- <link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/jquery-ui.css"> -->



<!-- CSS -->
<!-- <link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/bootstrap-grid.css"> -->
<!-- <link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/icons.css"> -->
<!-- preload fonts,css-->
<link rel="preload"  href="<?php echo PUBLIC_PATH; ?>fonts/Brand-Icons.ttf" as="font" type="font/ttf" crossorigin> 
<link rel="preload"  href="<?php echo PUBLIC_PATH; ?>fonts/Brand-Icons.woff" as="font" type="font/woff" crossorigin> 
<link rel="preload"  href="<?php echo PUBLIC_PATH; ?>fonts/Feather-Icons.ttf" as="font" type="font/ttf" crossorigin> 
<link rel="preload"  href="<?php echo PUBLIC_PATH; ?>fonts/Feather-Icons.woff" as="font" type="font/woff" crossorigin> 
<link rel="preload"  href="<?php echo PUBLIC_PATH; ?>fonts/Line-Awesome.ttf" as="font" type="font/ttf" crossorigin> 
<link rel="preload"  href="<?php echo PUBLIC_PATH; ?>fonts/Line-Awesome.woff" as="font" type="font/woff" crossorigin> 

<!-- included by deepak pandey -->
<!-- <link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/fa-all.min.css"> -->
<!-- <link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/bootstrap.min.css"> -->
<!-- included by deepak pandey end -->


@yield('page-css')
<!-- Google Fonts -->
<!-- <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">    -->

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Lato:wght@400;700&display=swap" rel="stylesheet">
<!-- included by deepak pandey -->
<!-- <link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/style-minified.css">  -->
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/style.css"> 
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/new-home.css">
 <!-- included by deepak pandey end -->
<script>
    SITE_URL = '{{ ROOT_URL }}';
    csrftoken = '{{csrf_token()}}';
</script>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-FPKSQMKK67"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-FPKSQMKK67');
</script>

<!-- Added UserWay :- https://userway.org/ -->

<!-- <script>
  
  (function(d){var s = d.createElement("script");s.setAttribute("data-account", "Mk5KJTJr42");s.setAttribute("src", "https://cdn.userway.org/widget.js");(d.body || d.head).appendChild(s);})(document)
</script>
<noscript>Please ensure Javascript is enabled for purposes of 
    <a href="https://userway.org">website accessibility</a>
</noscript> -->


<!-- Hotjar Tracking Code for https://thesayfoundation.com/ -->
  <script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2928766,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>



<script>
  /**********************google re captcha initiated by :: samir kumar**************************************************/

  var verifyCallback = function(response) {
    //alert(response);
  };
  var volunteercap;
  var donatecap;
  var admincap;
  var contactcapt;
  var candidatelogincap;
  var employerlogincap;
  var ngologincap;
  var candidateregcap;
  var employerregcap;
  var ngoregcap;
  var myCallBack = function() {
    // Renders the HTML element with id 'example1' as a reCAPTCHA widget.
    // The id of the reCAPTCHA widget is assigned to 'widgetId1'.
    /* $('.cand').click(function(){
      candidatelogincap = grecaptcha.render('candidatelogincap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }); */


    /* $('.emp').click(function(){
      employerlogincap = grecaptcha.render('employerlogincap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }); */


    /* $('.ngo').click(function(){
      ngologincap = grecaptcha.render('ngologincap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }); */

    /* $('.vlnter').click(function(){
      volunteercap = grecaptcha.render('volunteercap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        'theme' : 'light'
      });
    });

    $('.donate').click(function(){
      donatecap = grecaptcha.render('donatecap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    });


    if ($('#contactcapt').length > 0) {
      contactcapt = grecaptcha.render('contactcapt', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }

    if ($('#admincap').length > 0) {
      admincap = grecaptcha.render('admincap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }



    if ($('#candidateregcap').length > 0) {
      candidateregcap = grecaptcha.render('candidateregcap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }

    if ($('#employerregcap').length > 0) {
      employerregcap = grecaptcha.render('employerregcap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }

    if ($('#ngoregcap').length > 0) {
      ngoregcap = grecaptcha.render('ngoregcap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    } */

    /*if ($('#volunteercap').length > 0) {
      volunteercap = grecaptcha.render('volunteercap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        'theme' : 'light'
      });
    }

    if ($('#donatecap').length > 0) {
      donatecap = grecaptcha.render('donatecap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }


    if ($('#contactcapt').length > 0) {
      contactcapt = grecaptcha.render('contactcapt', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }

    if ($('#admincap').length > 0) {
      admincap = grecaptcha.render('admincap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }

    if ($('#candidatelogincap').length > 0) {
      candidatelogincap = grecaptcha.render('candidatelogincap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }

    if ($('#employerlogincap').length > 0) {
      employerlogincap = grecaptcha.render('employerlogincap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }


    if ($('#ngologincap').length > 0) {
      ngologincap = grecaptcha.render('ngologincap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }


    if ($('#candidateregcap').length > 0) {
      candidateregcap = grecaptcha.render('candidateregcap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }

    if ($('#employerregcap').length > 0) {
      employerregcap = grecaptcha.render('employerregcap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }

    if ($('#ngoregcap').length > 0) {
      ngoregcap = grecaptcha.render('ngoregcap', {
        'sitekey' : '<?php //echo env('RE_CAPTCHA_CLIENT');?>',
        //'callback' : verifyCallback,
        'theme' : 'light'
      });
    }*/
  };
  
</script>
<style>
    
  /* Added by Deepak Pandey dt: 19/04/2022 */

  body .uwy .uai {
    width:  32px !important;
      height:  32px !important;
      min-width:  32px !important;
      min-height:  32px !important;
      max-width:  32px !important;
      max-height:  32px !important;
  }  
  body .uwy.userway_p1 .uai {
      top: 22px !important;
      left: auto !important;
      right: 70px !important;
  } 
  .uwy .uai img:not(.check_on), body .uwy .uai img:not(.check_on) {
      height: 32px !important;
      width: 32px !important;
  }
  @media  (min-width: 1200px) and (max-width:1500px) {
    body .uwy.userway_p1 .uai {
        /* top: 40px !important; */
        left: auto !important;
        right: 40px !important;
    }
  }
  @media (max-width: 1099px) {
    body .uwy.userway_p1 .uai { 
        right: -20px !important;
        top: 16px !important;
    }
  }
  @media (max-width: 576px) {
    body .uwy.userway_p1 .uai {
      right: -24px !important;
    }
    body .uwy {
      z-index: 2 !important;
    }
    .uwy .uai img:not(.check_on), body .uwy .uai img:not(.check_on) {
        height: 24px !important;
        width: 24px !important;
    }
    body .uwy.userway_p1 .uai {
      top: 15px !important;
    }
    body .uwy .uai {
        width: 24px !important;
        height: 24px !important;
        min-width: 24px !important;
        min-height: 24px !important;
        max-width: 24px !important;
        max-height: 24px !important;
    }
  }
  /* main.userway-widget-container.p1.userway_overflow {
    padding: 20px 120px;
} */
  /* Added by Deepak Pandey dt: 19/04/2022 end*/
</style>
@extends('layouts.website')
@section('page-content')
@section('page-css')
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/social-share.min.css">
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/blog-inner.css">
@endsection

<!-- new -->
<div class="container mb-5">
<div class="inner-page-baner">
  <?php //echo'<pre>';print_r($BlogDetls->thumbnail_Image);exit;?>
<?php if(isset($banners) && $banners->isNotEmpty()){ ?>
      <img src="<?php if(!empty($banners[0]->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banners[0]->bannerImage; } else{ echo PUBLIC_PATH.'images/lets-say-our-blogs.png'; } ?>" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
          <strong>{{$banners[0]->bannerTitle}}</strong> - <br> {{$banners[0]->bannerText}}
      </div>
      <?php } else { ?>
        <img src="<?php echo PUBLIC_PATH; ?>images/lets-say-our-blogs.png" class="d-block" alt="banner">
            <div class="inner-page-baner-content">
                <strong>Blog Details</strong> - <br> Insights on inclusivity
            </div>
            <?php } ?>
        </div>
  <div class="py-3">
    <strong class="badge-green">Blog Topic Category</strong>
    <!-- <span class="mx-3"> 
      <img src="" alt="">
      Follow
    </span> -->
  </div> 
  <h2 class="inner-page-title">
  {{$BlogDetls->blogTitle}}
  </h2>
  <!-- <p>
  <?php //echo htmlspecialchars_decode($BlogDetls->blogDetails); ?>
  </p> -->
  <ul class="blog-updated-time pl-0 d-md-flex align-items-md-center">
    <li>
      Last Updated  {{date('d M, Y',strtotime($BlogDetls->publishDate))}}
    </li>
    <li>
    {{date('h:i:s A',strtotime($BlogDetls->publishDate))}}   
    </li>
    <?php if($BlogDetls->intReadTime > 0) { ?>
    <li>
    {{$BlogDetls->intReadTime}} min read 
    </li>
    <?php } ?>
    <!-- <li>
      <i class="fa fa-play-circle pr-1" aria-hidden="true"></i>
      Listen
    </li> -->
  </ul>
  <div class="row mb-3">
    <div class="col-sm-8 d-flex align-items-center">
      <img src="<?php echo PUBLIC_PATH; ?>images/person-fill.svg" alt="" class="blog-profile-img">
      <strong class="mx-md-3 mx-2 h5 mb-0">By, {{$BlogDetls->postedBy}}</strong>
      <span class="profile-checked d-flex align-items-center justify-content-center">
        <img src="<?php echo PUBLIC_PATH; ?>images/person-checked.svg" alt="">
      </span>
    </div>
    <!-- <div class="col-sm-4 text-right">
      <div class="sharing-media">
        <a  href="https://www.facebook.com/TheSAYFoundation/" target="_blank" title="Facebook">
          <i class="icon-brand-facebook-square"></i>
        </a> 
        <a title="Twitter" href="https://twitter.com/TSAYFoundation" target="_blank" >
          <i class="icon-brand-twitter" aria-hidden="true"></i>
        </a> 
        <a title="Instagram" href="https://www.instagram.com/TheSAYFoundation/" target="_blank" >
          <i class="icon-brand-instagram" aria-hidden="true"></i>
        </a> 
        <a title="Linkedin" href="https://www.linkedin.com/company/the-say-foundation" target="_blank" >
          <i class="icon-brand-linkedin-in" aria-hidden="true"></i>
        </a> 
        <a href="javascript:;">
          <i class="icon-brand-whatsapp" aria-hidden="true"></i>
        </a>
      </div>   
    </div> -->
  </div>  
  <div class="row"> 
    <div class="col-lg order-lg-2">
      <div class="blog-conent"> 
        <div class="img">
          <img src="<?php if(!empty($BlogDetls->blogImage)){ echo ROOT_URL.'/storage/app/uploads/blog/'.$BlogDetls->blogImage; } else { echo PUBLIC_PATH.'images/lets-say-our-blogs.png'; } ?>"  alt="banner">
        </div>
        <?php echo htmlspecialchars_decode($BlogDetls->blogDetails); ?> 
      </div>
    </div>
    <div class="col-lg-2 order-lg-1 text-right">
      <div class="sharing-media">
        <a  href="https://www.facebook.com/TheSAYFoundation/" target="_blank" title="Facebook">
          <i class="icon-brand-facebook-square"></i>
        </a> 
        <a title="Twitter" href="https://twitter.com/TSAYFoundation" target="_blank" >
          <i class="icon-brand-twitter" aria-hidden="true"></i>
        </a> 
        <a title="Instagram" href="https://www.instagram.com/TheSAYFoundation/" target="_blank" >
          <i class="icon-brand-instagram" aria-hidden="true"></i>
        </a> 
        <a title="Linkedin" href="https://www.linkedin.com/company/the-say-foundation" target="_blank" >
          <i class="icon-brand-linkedin-in" aria-hidden="true"></i>
        </a> 
        <a href="javascript:;">
          <i class="icon-brand-whatsapp" aria-hidden="true"></i>
        </a>
      </div>  
    </div>
  </div>
  <h4 class="article-heading">
        <span>Related Articles</span>
      </h4>
      <div class="utf-blog-carousel-block-related article-slider"> 
        <?php if($randomBlog->isNotEmpty()){ 
          foreach($randomBlog as $random) { ?>
          <a href="{{ROOT_URL}}/LetsSay-OurBlogs/{{$random->blogSlug}}" class="utf-blog-item-container-part">
            <div class="utf-blog-compact-item"> 
              <img src="<?php if(!empty($random->blogImage)){ echo ROOT_URL.'/storage/app/uploads/blog/'.$random->blogImage; } else{ echo PUBLIC_PATH.'images/quote_bg.jpg'; } ?>" alt=""> 
              <?php $blogTitle=wardWrap(htmlspecialchars_decode($random->blogTitle),60); ?> 
              <div class="article-slider-desc"> 
              {!!strip_tags($blogTitle)!!}
              </div>
              <!-- <div class="utf-blog-compact-item-content">
                <ul class="utf-blog-post-tags">
                  <li>By, {{$random->postedBy}}</li>  
                  <li>{{date('d M, Y',strtotime($random->publishDate))}}</li>
                </ul> 
              </div> -->
            </div>
            <div class="px-3">
              <span>By, {{$random->postedBy}}</span> <span class="px-2">|</span> <span>{{date('d M, Y',strtotime($random->publishDate))}}</span>
            </div>
          </a> 
        <?php } } ?>
        
      </div>
</div>  
<!-- new end -->


<!-- <div id="titlebar" class="gradient">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>Blog Details</h2>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}">Home</a></li>
            <li>Blog Details</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div> -->

<!-- Post Content -->

</div>
@section('page-js')


<script src="<?php echo PUBLIC_PATH; ?>js/social-share.min.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/a076d05399.js"></script>
@endsection
@endsection

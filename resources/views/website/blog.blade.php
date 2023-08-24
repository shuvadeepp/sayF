@extends('layouts.website')
@section('page-content')
@section('page-css')
<link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>css/blog.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker-standalone.css"/>
@endsection
<?php //print_r($banners); echo $banners[0]->bannerTitle; exit; //echo date('d M y',strtotime($fdate)) . '==' . date('d M y',strtotime($tdate)); exit;?>
<div class="section">
  <!-- new design -->
  <div class="container">
  <div class="inner-page-baner">
    <?php if(isset($banners) && $banners->isNotEmpty()){ ?>
      <img src="<?php if(!empty($banners[0]->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banners[0]->bannerImage; } else{ echo PUBLIC_PATH.'images/lets-say-our-blogs.png'; } ?>" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
          <strong>{{$banners[0]->bannerTitle}}</strong> - <br> {{$banners[0]->bannerText}}
      </div>
      <?php } else { ?>
      <img src="<?php echo PUBLIC_PATH; ?>images/lets-say-our-blogs.png" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
          <strong>Let's Say - Our Blogs</strong> - <br> Insights on inclusivity
      </div>
      <?php } ?>
  </div>
    <form method="post" id="blogsearch">
    {{csrf_field()}}
      <div class="filterbox">
        <div class="row">
          <div class="col-md-4">
            <label for="">From Date</label>
            <div class="utf-input-with-icon">
              <input type="text" class="utf-with-border srch_post_date" placeholder="From Date" name="fdate" id="fdate" value="{{@(strtotime($fdate)>0)?date('d M y',strtotime($fdate)):''}}">
              <label for="fdate"><i class="icon-feather-calendar"></i> </label>
              <span class="errMsg_fdate errDiv"></span>
            </div>
          </div>
          <div class="col-md-4">
            <label for="">To Date</label>
            <div class="utf-input-with-icon">
              <input type="text" class="utf-with-border srch_post_date" placeholder="To Date" name="tdate" id="tdate" value="{{@(strtotime($tdate)>0)?date('d M y',strtotime($tdate)):''}}"> 
              <label for="tdate"><i class="icon-feather-calendar"></i> </label>
              <span class="errMsg_tdate errDiv"></span>
            </div> 
          </div> 
          <div class="col mt-sm-4 mb-3"> 
            <label for=""></label>
            <button class="button" type="button" onclick="validation_blog_search()">Search</button>  
          </div>
        </div>
      </div>
    </form>
         <?php if($arrBlog->isNotEmpty()){  $cnt=1;          
             ?>
    <div class="row blog-list">
      <?php  foreach($arrBlog as $blogs) { 
        //echo'<pre>';print_r($blogs);exit;
        ?>
      <div class="col-md-6 col-lg-4">
        <div class="card">
          <!-- <?php if($cnt <= 5) { ?><span class="new-post">New</span><?php } ?> -->
          <div class="card-img-top">
            <img src="<?php if(!empty($blogs->thumbnail_Image)){ echo ROOT_URL.'/storage/app/uploads/thumbnail/'.$blogs->thumbnail_Image; } else{ echo PUBLIC_PATH.'images/user_big_1.jpg'; } ?>"  alt="blog">
          </div>
          <div class="card-body">
            <h4 class="card-title">{{$blogs->blogTitle}}</h4>
            <div>
              <small class="text-muted">By, {{$blogs->postedBy}}</small>
              <small class="text-muted px-2 d-none d-md-inline">|</small>
              <small class="text-muted">{{date('d M, Y',strtotime($blogs->publishDate))}}</small> 
              <?php if($cnt <= 5) { ?><span class="new-post">New</span><?php } ?>
            </div>
            <p class="card-text"><?php echo htmlspecialchars_decode(wardWrap($blogs->blogDetails, 250),ENT_QUOTES);?></p>
            </div>
            <div class="card-footer">
            <a href="{{ROOT_URL}}/LetsSay-OurBlogs/{{$blogs->blogSlug}}" class="btn btn-primary">Read More</a>
            
          </div>
        </div>
      </div>
      <?php $cnt++; } ?>
     
    </div>
    <?php }else{ ?>
      <div class="no-data">
        <p>No Blogs Available</p>
      </div>
      <?php } ?>
  </div>
  <!-- new design -->


</div>
@section('page-js')
<script src="<?php echo PUBLIC_PATH; ?>js/custom-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script>
  
  function validation_blog_search() {
    // alert(111)
    $('.errDiv').hide();
    $('.error-input').removeClass('error-input');
    if (!blankCheck('fdate', 'From Date can not be left blank'))
      return false;
    if (!blankCheck('tdate', 'To Date can not be left blank'))
      return false;

    if(!compareDatenew('fdate', 'tdate', 'From Date', 'To Date','To Date should not be less than From Date.')){
      return false;
    }
    $("#blogsearch").submit();
  }

  $('document').ready(function () {
    if (screen.width <= 576 || screen.width > 991) {
      $('.small-screen').show();
      $('.large-screen').hide();
    } else {
      $('.small-screen').hide();
      $('.large-screen').show();
    }
  });

  $( function() {
    $( ".srch_post_date" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "d M y",
    });
  });
</script>
@endsection
@endsection
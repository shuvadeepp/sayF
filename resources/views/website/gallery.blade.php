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
        <h2>Gallery</h2>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}">Home</a></li>
            <li>Gallery</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="section section--content ">
  <div class="container">
    <div class="dashboard-box gallery">
      <div class="content p-3 padding-top-30">
        <div class="mb-4 px-2">
          <a href="javascript:;" title="Photo" class="btn  tab-photo active" onclick="loadGalleryData(0,'Photo')">Photo</a>
          <a href="javascript:;" title="Video" class="btn tab-video" onclick="loadGalleryData(0,'Video')">Video</a>
        </div>


        <div id="galleryData">
          @include('website.galleryData')
        </div>

        <!--  Gallery Photos-->
        <!-- <div class="row px-3 gallery__photo"  id="g-photo">
          <?php if(!empty(@$galleryPhotos)){ foreach ($galleryPhotos as $photoval) { ?>         
          <div class="col-md-6 col-xl-4 mb-3 px-2 gallery__photo__link" href="<?php if(!empty($photoval->galleryImage)){ echo ROOT_URL.'/storage/app/uploads/gallery/'.$photoval->galleryImage; } else{ echo PUBLIC_PATH.'images/video-img.png'; } ?>">
            <img src="<?php if(!empty($photoval->galleryImage)){ echo ROOT_URL.'/storage/app/uploads/gallery/'.$photoval->galleryImage; } else{ echo PUBLIC_PATH.'images/video-img.png'; } ?>" alt="<?php echo $photoval->caption; ?>" class="gallery__photo__img">
          </div> 
          <?php } }else{ ?>
            No gallery image available
          <?php } ?>
        </div> -->
       
        <!-- Gallery Videos -->
        <!-- <div class="gallery__video">
          <div class="d-flex flex-wrap" id="video-gallery">
            <?php if(!empty(@$galleryVideos)){ foreach ($galleryVideos as $videoval) { if(!empty($videoval->url)){ ?>    
              <a target="_blank" href="https://www.youtube.com/embed/<?php echo $videoval->url; ?>">
                <img src="https://img.youtube.com/vi/<?php echo $videoval->url; ?>/0.jpg" alt="<?php echo $videoval->caption; ?>">
                <p class="text-capitalize"><?php echo $videoval->caption; ?></p>
                <img src="<?php echo PUBLIC_PATH; ?>images/video-play.png" class="play-icon" alt="<?php echo $videoval->caption; ?>">
              </a>
              <?php } } }else{ ?>
                No video available
              <?php } ?>   
          </div>
        </div> -->

    </div>

  </div>
</div>
@section('page-js')
  <script src="<?php echo PUBLIC_PATH; ?>js/lightgallery.min.js"></script>
  <script src="<?php echo PUBLIC_PATH; ?>js/lightgallery-all.min.js"></script>
  <script>
    $(document).ready(function() {
      //loadGallery('Photo');
      loadGalleryData(0,'Photo');
      // $('#g-photo').lightGallery();
      // $('#video-gallery').lightGallery(); 
      $(document).on('click', '.photo-page .pagination a', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        loadGalleryData(page,'Photo');
      });


      $(document).on('click', '.video-page .pagination a', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        loadGalleryData(page,'Video');
      });
    });
    function loadGallery(type){
      if(type == 'Photo'){
           $('#g-photo').html('Please wait...');             
      }else{
           $('#video-gallery').html('Please wait...');                
      }
      $.ajax({
        type        : 'POST',
        url         : SITE_URL + "/website/ajax/loadGallery",
        data        : {type:type},
        dataType    : "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {      
        },
        success: function (res) {
          if(res.status==200){
            var result = res.result;
            var html='';
            if(result.length==0){              
              if(type == 'Photo'){
                $('#g-photo').html('No gallery image available');             
              }else{
                $('#video-gallery').html('No video available');             
              }
            }else{
              $(result).each(function (i,val){
                console.log(val);
                var img = (val.galleryImage != '' || val.galleryImage != null) ? "<?php echo ROOT_URL.'/storage/app/uploads/gallery/' ?>"+val.galleryImage : "<?php echo PUBLIC_PATH.'images/video-img.png' ?>";
                var caption = val.caption;
                var link = (val.url != '' || val.url != null)?val.url:'';
                if(type == 'Photo'){
                  html += `<div class="col-md-6 col-xl-4 mb-3 px-2 gallery__photo__link" href="`+img+`">
                          <img src="`+img+`" alt="`+caption+`" class="gallery__photo__img">
                        </div>`;
                }else{
                  html += `<a target="_blank" href="https://www.youtube.com/embed/`+link+`">
                  <img src="https://img.youtube.com/vi/`+link+`/0.jpg" alt="`+caption+`">
                  <p class="text-capitalize">`+caption+`</p>
                  <img src="`+SITE_URL+`/public/images/video-play.png" class="play-icon" alt="`+caption+`">
                </a>`;
                }
              });
              if(type == 'Photo'){
                $('#g-photo').html(html);
                setTimeout(function(){ $('#g-photo').lightGallery(); },3000);               
              }else{
                $('#video-gallery').html(html); 
                setTimeout(function(){ $('#video-gallery').lightGallery();}, 3000);               
              }
           }
         }
        }
     });

    }

    function loadGalleryData(page,type){
      $('#galleryData').html('Please wait...');
      $.ajax({
      type: 'POST',
      data : {type:type},
      url: SITE_URL + "/website/ajax/loadGalleryData?page="+page,
      async: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (res) {
     // console.log(res.intStartRec);
      // $("#pagination").show();
      // if(res.totalrec==0){
      //   $("#pagination").hide();
      // }
        // $("#strrc").text('');
        // $("#strrc").text(res.intStartRec);
        // $("#endrec").text('');
        // $("#endrec").text(res.intEndRec);
        // $("#totare").text('');
        // $("#totare").text(res.totalrec);
        $('#galleryData').html(res.html);
        if(type == 'Photo'){
           $('#g-photo').lightGallery();             
        }else{
          $('#video-gallery').lightGallery();               
        }
      }
    }); 
    }
  </script>
@endsection
@endsection
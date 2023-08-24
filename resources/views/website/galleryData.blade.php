  <!--  Gallery Photos-->
  <?php if(!empty(@$data)){ ?>
  <div class="row px-3 gallery__photo"  id="g-photo">
    <?php foreach ($data as $photoval) { ?>         
    <div class="col-md-6 col-xl-4 mb-3 px-2 gallery__photo__link" href="<?php if(!empty($photoval->galleryImage)){ echo ROOT_URL.'/storage/app/uploads/gallery/'.$photoval->galleryImage; } else{ echo PUBLIC_PATH.'images/video-img.png'; } ?>">
      <img src="<?php if(!empty($photoval->galleryImage)){ echo ROOT_URL.'/storage/app/uploads/gallery/'.$photoval->galleryImage; } else{ echo PUBLIC_PATH.'images/video-img.png'; } ?>" alt="<?php echo $photoval->caption; ?>" class="gallery__photo__img">
    </div> 
    <?php } ?>
  </div>
  <?php if($type == 'Photo'){ ?>
    <div class="photo-page">
      <div class="pagination">
        {!! $data->links() !!}
      </div>
    </div>
  <?php } ?>
    <?php }else{ ?>
      No gallery image available
    <?php } ?>
 
  <!-- Gallery Videos -->
  <div class="gallery__video">
    <?php if(!empty(@$data)){ ?>
    <div class="d-flex flex-wrap" id="video-gallery">
      <?php foreach ($data as $videoval) { if(!empty($videoval->url)){ ?>    
        <a target="_blank" href="https://www.youtube.com/embed/<?php echo $videoval->url; ?>">
          <img src="https://img.youtube.com/vi/<?php echo $videoval->url; ?>/0.jpg" alt="<?php echo $videoval->caption; ?>">
          <p class="text-capitalize"><?php echo $videoval->caption; ?></p>
          <img src="<?php echo PUBLIC_PATH; ?>images/video-play.png" class="play-icon" alt="<?php echo $videoval->caption; ?>">
        </a>
        <?php } } ?> 
    </div>
    <?php if($type == 'Video'){ ?>
    <div class="video-page">
      <div class="pagination">
        {!! $data->links() !!}
      </div>
    </div>
    <?php }}else{ ?>
      No video available
    <?php } ?>   
  </div>
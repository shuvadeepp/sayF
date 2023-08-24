@extends('layouts.website')
@section('page-content')

<div class="container">
    <div class="inner-page-baner">
        <?php if(isset($banners) && $banners->isNotEmpty()){ ?>
        <img src="<?php if(!empty($banners[0]->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banners[0]->bannerImage; } else{ echo PUBLIC_PATH.'images/banner1.png'; } ?>" class="d-block" alt="banner">
        <div class="inner-page-baner-content">
            <strong>{{$banners[0]->bannerTitle}}</strong> - <br> {{$banners[0]->bannerText}}
        </div>
        <?php } else { ?>
        <img src="<?php echo PUBLIC_PATH; ?>images/banner1.png" class="d-block" alt="banner">
        <div class="inner-page-baner-content">
            <strong>LinkedIn Feeds</strong> - <br> Insights on inclusivity
        </div>
        <?php } ?>
    </div>
    <div class="mb-4">
        <iframe src='https://widgets.sociablekit.com/linkedin-page-posts/iframe/132955' frameborder='0' width='100%' height='400'></iframe> 
    </div>
</div>

@endsection
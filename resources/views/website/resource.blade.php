<?php //echo'<pre>';print_r($arrayWithType2);exit; ?>
@extends('layouts.website')
@section('page-content')
@section('page-css')

@endsection
<div class="container">
    <div class="inner-page-baner">
        <img src="<?php echo PUBLIC_PATH; ?>images/banner1.png" class="d-block" alt="banner">
        <div class="inner-page-baner-content">
            <strong>Resource</strong> - <br> We are on a quest <br>to <strong>spread joy</strong>
        </div>
    </div>
    <p class="text-center">The SAY Foundation aims to create an inclusive ecosystem for Persons with Disabilities (PwDs). Say’s mission is to empower PwDs to become self-reliant, financially independent and productive contributors of the society.
    </p>

    <div class="row mt-xl-5 mt-4">
        <div class="col-lg-6">
            <h4 class="mb-3 text-center inner-section-title">
                <strong>Documents & Reprots</strong>
            </h3>
            <ul class="bg-light-link-list list-1">
                <?php if(!empty($arrayWithType1)){ ?>
                    <?php foreach($arrayWithType1 as $document){?>
                        <?php //echo'<pre>';print_r($document);?>
                        <li>
                            <a href="<?php echo ROOT_URL.'/storage/app/uploads/resource/' . $document['docFile']; ?>" download>
                                <?php echo $document['docName'];?>
                                <i class="icon-feather-download"></i>
                            </a>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                        <p>No Record Found</p>
                <?php } ?>
            </ul>
        </div>
        <div class="col-lg-6">
            <h4 class="mb-3 text-center inner-section-title">
                <strong>Websites & Social Media</strong>
            </h3>
            <ul class="bg-light-link-list list-1">
                <?php if(!empty($arrayWithType2)){ ?>
                    <?php foreach($arrayWithType2 as $siteLink){?>
                        <?php //echo'<pre>';print_r($siteLink);?>
                        <li>
                            <a href="<?php echo $siteLink['resourceUrl'];?>" target="_blank">
                                <?php echo $siteLink['docName']?>
                                <i class="icon-feather-external-link"></i>
                            </a>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <p>No Record Found</p>
                <?php } ?>
                <!-- <li>
                    <a href="javscript:;">
                        We work extensively to sensitize Org and Govt on the need and talent of PwDs
                        <i class="icon-feather-external-link"></i>
                    </a>
                </li>
                <li>
                    <a href="javscript:;">
                        We enable PwDs through exclusive skill training to access career opportunities
                        <i class="icon-feather-external-link"></i>
                    </a>
                </li>
                <li>
                    <a href="javscript:;">
                        We actively involve and influence the key stakeholders on the rights of PwDs
                        <i class="icon-feather-external-link"></i>
                    </a>
                </li> -->
            </ul>
        </div> 
    </div>
</div>


@section('page-js')
@endsection
@endsection
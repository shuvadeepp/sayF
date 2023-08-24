<?php

/* * ******************************************
  File Name     : PageController.php
  Description   : Controller file for managing all the ajax requests of Website and employer and employee
  Created By    : Samir Kumar
  Created On    : 05-Apr-2021

  ======================================================================
  |Update History                                                      |
  ======================================================================
  |<Updated by>                 |<Updated On> |<Remarks>
  ----------------------------------------------------------------------
  |Name Goes Here               |DD-MMM-YYYY  |Remark goes here
  ----------------------------------------------------------------------
  |                             |             |
  ----------------------------------------------------------------------

 * ****************************************** */

namespace App\Http\Controllers\Website;

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Mail;
use Session;
use App\Models\BlogModel;
use App\Models\BannerModel;
use App\Models\DouknowModel;
use App\Models\GalleryModel;
use App\Models\ResourceModel;
use App\Models\TestimonialModel;


class PageController extends AppController {
    function index($page='', $subpage=''){
      if(empty($page)){
        $blogDetls=BlogModel::where([['deletedflag',0],['publishStatus',0]])->orderBy('blogId','DESC')->get();
        $this->viewVars['blogDetls']=$blogDetls;
         // $knowDetls=DouknowModel::where([['deletedflag',0],['publishStatus',0]])->orderBy('douknowId','DESC')->get();
           //$knowDetls=DouknowModel::where([['deletedflag',0],['publishStatus',0]])->inRandomOrder()->limit(1)->get();
           $knowDetls=DouknowModel::where([['deletedflag',0],['publishStatus',0]])->orderBy('douknowId','DESC')->get();
           //$knowData=DouknowModel::where([['deletedflag',0],['publishStatus',0]])->get();
           $this->viewVars['knowDetls']=$knowDetls;         
        // return view('website.home',$this->viewVars);
        $testimonials=TestimonialModel::where([['deletedflag',0],['publishStatus',0]])->orderBy('testimonial_id','DESC')->get();
        $this->viewVars['testimonials']=$testimonials;
        $this->viewVars['banners'] = $this->getBanners($page); 
        return view('website.newhome',$this->viewVars);
      }else if($page == 'about-us'){
        $this->viewVars['banners'] = $this->getBanners($page);       
        return view('website.about-us',$this->viewVars);
      }
      // else if($page == 'partners'){
      //   return view('website.partners');
      // }
      // else if($page == 'partner-details'){
      //   return view('website.partner-details');
      // }else if($page == 'blog'){
      //   return view('website.blog');
      // }else if($page == 'single-blog'){
      //   return view('website.single-blog');
      // }
      else if($page == 'employers'){
        return view('website.employers');
      }else if($page == 'ngo-and-communities'){
        return view('website.ngo-and-communities');
      }else if($page == 'persons-with-disabilities'){
        return view('website.persons-with-disabilities');
      }else if($page == 'policy-advocacy'){
        return view('website.policy-advocacy');
      }else if($page == 'services'){
        return view('website.services');
      }else if($page == 'success-stories'){
        return view('website.success-stories');
      }else if($page == 'connect'){
        $this->viewVars['banners'] = $this->getBanners($page); 
        return view('website.connect',$this->viewVars);
       // return view('website.connect');
      }else if($page == 'jobdetails'){
        // $this->viewVars['banners'] = $this->getBanners($page); 
        //  return view('website.jobdetails',$this->viewVars);
         return view('website.jobdetails');
      }else if($page == 'explorejob'){
        return view('website.exploreJob');
      }else if($page == 'user-login'){
        // echo $subpage;exit;
        $this->viewVars['val']     = $subpage; 
        $this->viewVars['banners'] = $this->getBanners($page); 
        return view('website.user-login',$this->viewVars);
      }else if($page == 'gallery'){

        // $galleryPhotos=GalleryModel::where([['deletedflag',0],['publishStatus',0],['type','Photo']])->orderBy('sequence','ASC')->get();
        // $galleryVideos=GalleryModel::where([['deletedflag',0],['publishStatus',0],['type','Video']])->orderBy('sequence','ASC')->get();
        // $this->viewVars['galleryPhotos']=$galleryPhotos;
        // $this->viewVars['galleryVideos']=$galleryVideos;
        // return view('website.gallery',$this->viewVars);
        return view('website.gallery');
      }else if($page == 'new-home'){
        $blogDetls=BlogModel::where([['deletedflag',0],['publishStatus',0]])->orderBy('blogId','DESC')->get();
        $this->viewVars['blogDetls']=$blogDetls;
         // $knowDetls=DouknowModel::where([['deletedflag',0],['publishStatus',0]])->orderBy('douknowId','DESC')->get();
           //$knowDetls=DouknowModel::where([['deletedflag',0],['publishStatus',0]])->inRandomOrder()->limit(1)->get();
        $knowDetls=DouknowModel::where([['deletedflag',0],['publishStatus',0]])->orderBy('douknowId','DESC')->get();
           //$knowData=DouknowModel::where([['deletedflag',0],['publishStatus',0]])->get();
        $this->viewVars['knowDetls']=$knowDetls;
       
        $this->viewVars['banners'] = $this->getBanners($page);      
        return view('website.newhome',$this->viewVars);
     // }else if($page == 'pressrelease'){
      //  $this->viewVars['banners'] = $this->getBanners($page); 
      //  return view('website.pressrelease',$this->viewVars);
      }else if($page == 'donate'){
        $this->viewVars['banners'] = $this->getBanners($page); 
        return view('website.donate',$this->viewVars);
      }else if($page == 'volunteer'){
        $this->viewVars['banners'] = $this->getBanners($page); 
        return view('website.volunteer',$this->viewVars);
      }else if($page == 'linkedin-feeds'){
        $this->viewVars['banners'] = $this->getBanners($page); 
        return view('website.linkedin-feeds',$this->viewVars);
      }else if($page == 'resource'){
        /* ::::: Resource Page Dynamic added By - Shuvadeep Podder ::::: */
        $resourceDetls = ResourceModel::where([['deletedflag',0],['publishStatus',0]])->orderBy('resourceId','DESC')->get()->toArray();

        $arrayWithType1 = array_filter($resourceDetls, function ($item) {
          return $item['docType'] == 1;
        });
      
        $arrayWithType2 = array_filter($resourceDetls, function ($item) {
            return $item['docType'] == 2;
        });

        if(!empty($arrayWithType1) && count($arrayWithType1) > 0){
          $arrayWithType1 = array_map(function ($item) {
              return array_intersect_key($item, array_flip(array('resourceId', 'docName', 'docFile', 'resourceUrl', 'docType')));
          }, $arrayWithType1);
        }
        if(!empty($arrayWithType2) && count($arrayWithType2) > 0){
          $arrayWithType2 = array_map(function ($item) {
              return array_intersect_key($item, array_flip(array('resourceId', 'docName', 'docFile', 'resourceUrl', 'docType')));
          }, $arrayWithType2);
        }
        
        $this->viewVars['arrayWithType1'] = $arrayWithType1;
        $this->viewVars['arrayWithType2'] = $arrayWithType2;
        /* ::::: Resource Page Dynamic added End By - Shuvadeep Podder ::::: */
        return view('website.resource', $this->viewVars);

      }else{
        return view('website.404');
      }
    }
    
    /* Function to get banners for each page. -- Sangita | 30-03-2023 -- */
    function getBanners($pageName=''){
      $pageName=!empty($pageName)?$pageName:'home';

      $pageArr = array('home'=>'1','new-home'=>'1','about-us'=>'2','employers'=>'3','ngo-and-communities'=>'4','persons-with-disabilitie'=>'5','policy-advocacy'=>'6','jobdetails'=>'7','donate'=>'8','volunteer'=>'9','resource'=>'10','connect'=>'11','explorejob'=>'12','gallery'=>'13','pressrelease'=>'15','user-login'=>'18','linkedin-feeds'=>'21');
      
      $pageType = $pageArr[$pageName];
      $bannerList=BannerModel::where([['deletedflag',0],['publishStatus',0],['pageType',$pageType]])->orderBy('bannerId','ASC')->get();
      return $bannerList;
    }
}

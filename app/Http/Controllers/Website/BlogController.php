<?php

/* * ******************************************
  File Name     : BlogController.php
  Description   : Controller file for managing all the blogs in Website 
  Created By    : Sandeep Kumar Senapati
  Created On    : 28-Apr-2021

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
use Session;
use DB;
use App\Models\BlogModel;
use App\Models\BannerModel;


class BlogController extends AppController {
  function index() {
    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
      $arrBlog=BlogModel::where([['deletedflag',0],['publishStatus',0]])->paginate(10);

    //   if($isViewAll==2){
    //     $arrBlog=$arrBlog->get();
    //   }elseif($isViewAll==1){
    //     $arrBlog=$arrBlog->paginate(5);
    //   }
    $pageType ='14';
    $bannerList=BannerModel::where([['deletedflag',0],['publishStatus',0],['pageType',$pageType]])->orderBy('bannerId','ASC')->get();

    /* :::::::::: Search Date Filter - by Shuvadeep Podder - Dt-31-03-2023 :::::::::: */
    if(!empty(request()->all()) && request()->isMethod('post')){
      $requestData = request()->all();

      $arrConditions['fdate']     = (request('fdate')!='')?date('Y-m-d',strtotime(request('fdate'))):'';
      $arrConditions['tdate']     = (request('tdate')!='')?date('Y-m-d',strtotime(request('tdate'))):'';

      if(!empty($arrConditions['fdate']) && !empty($arrConditions['tdate'])){
        $arrBlog = BlogModel::whereBetween('publishDate', $arrConditions)->get();
      } 

      $this->viewVars['fdate'] = $arrConditions['fdate'];
      $this->viewVars['tdate'] = $arrConditions['tdate'];
    }
    /* :::::::::: End :::::::::: */


      $latestBlog=BlogModel::where([['deletedflag',0],['publishStatus',0]])->orderBy('blogId','DESC')->limit(3)->get();
      
      $this->viewVars['arrBlog']=$arrBlog;
      $this->viewVars['latestBlog']=$latestBlog;
      $this->viewVars['startrec']  = $isViewAll; 
      $this->viewVars['banners']  = $bannerList; 
     return view('website.blog',$this->viewVars);
  }
  public function bloginner($alias){
    $BlogDetls=BlogModel::where([['deletedflag',0],['blogSlug',$alias],['publishStatus',0]])->first();
    $latestBlog=BlogModel::where([['deletedflag',0],['publishStatus',0]])->orderBy('blogId','DESC')->limit(3)->get();

    $randomBlog=BlogModel::where([['deletedflag',0],['publishStatus',0]])->inRandomOrder()->limit(5)->get();
/* For banner image */
    $pageType ='17';
    $bannerList=BannerModel::where([['deletedflag',0],['publishStatus',0],['pageType',$pageType]])->orderBy('bannerId','ASC')->get();
    
    $this->viewVars['BlogDetls']=$BlogDetls;
    $this->viewVars['latestBlog']=$latestBlog;
    $this->viewVars['randomBlog']=$randomBlog;
    $this->viewVars['banners']=$bannerList;
    return view('website.single-blog',$this->viewVars);
  }
   
}
?>
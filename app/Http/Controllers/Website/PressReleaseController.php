<?php

/* * ******************************************
  File Name     : PressReleaseController.php
  Description   : Controller file for managing all the PressRelease in Website 
  Created By    : Sangita Pratap
  Created On    : 13-Apr-2023

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
use App\Models\PressReleaseModel;
use App\Models\BannerModel;


class PressReleaseController extends AppController {

    function pressreleaseinner($alias){
   // $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $pressDetls='';
    $activeContentId='';

    if($alias=='pressreleaseinner' || $alias == ''){
		// echo 111;exit;
      $pressDetls=PressReleaseModel::where([['deletedflag',0],['publishStatus',0]])->orderBy('publishDate','DESC')->first();     
    } else {
		// echo 222;exit;
      $pressDetls=PressReleaseModel::where([['deletedflag',0],['pressSlug','=',$alias],['publishStatus',0]])->first();   
    }  
    if(!empty($pressDetls)){
      $activeContentId = $pressDetls->preleaseId;
    }      

    $latestData=PressReleaseModel::where([['deletedflag',0],['publishStatus',0]])->orderBy('publishDate','DESC')->limit(3)->get();
    $pageArr = array('home'=>'1','new-home'=>'1','about-us'=>'2','employers'=>'3','ngo-and-communities'=>'4','persons-with-disabilitie'=>'5','policy-advocacy'=>'6','jobdetails'=>'7','donate'=>'8','volunteer'=>'9','resource'=>'10','connect'=>'11','explorejob'=>'12','gallery'=>'13','pressrelease'=>'15','user-login'=>'18');
    $pageType =$pageArr['pressrelease'];
    $bannerList=BannerModel::where([['deletedflag',0],['publishStatus',0],['pageType',$pageType]])->orderBy('bannerId','ASC')->get();
      
      $this->viewVars['pressDetls']=$pressDetls;
      $this->viewVars['latestData']=$latestData;
      $this->viewVars['activeContentId']=$activeContentId;
     // $this->viewVars['startrec']  = $isViewAll; 
      $this->viewVars['banners']  = $bannerList; 
     return view('website.pressrelease',$this->viewVars);
  
  }
 
   
}
?>
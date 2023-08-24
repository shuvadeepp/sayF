<?php

/* * ******************************************
  File Name     : bannerController.php
  Description   : Controller file for managing the banner
  Created By    : Sangita Pratap
  Created On    : 28-Mar-2023

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

namespace App\Http\Controllers\Application\Master;

use App\Http\Controllers\AppController;
use App\Models\BannerModel;
use App\Models\BlogModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;
use Storage;

class BannerController extends AppController {
  public function index(){
      if(!empty(request()->all()) && request()->isMethod('post')) {
       
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
     // print_r(request('hdnAction')); exit;
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          BannerModel::whereIn('bannerId',$IdsArr)->update(['deletedflag' => 1]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          BannerModel::whereIn('bannerId',$IdsArr)->update(['publishStatus' => 0]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          BannerModel::whereIn('bannerId',$IdsArr)->update(['publishStatus' => 1]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery=BannerModel::where([['deletedflag',0]]);
    
    if($isViewAll==2){
        $arrResQuery=$arrResQuery->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
      } 
      
    $this->viewVars['startrec']  = $isViewAll; 
    $this->viewVars['arrAllRecords'] = $arrResQuery;

    if(request('hidIds') > 0){
        $bId=request('hidIds');
        BannerModel::where('bannerId', $bId)
                ->update([
                    'deletedFlag'=>1,
                    'updatedOn' => now()
                ]);
            request()->session()->flash('success', 'Record deleted successfully');                  
            return redirect::to('application/master/banner');
    }
    return view('application.master.viewBanner',$this->viewVars);
  }

  /*Function for add and edit education*/
  public function add($bannerId){
  
    $bannerId=($bannerId)?decrypt($bannerId):0;
    $this->viewVars['buttonVal'] = ($bannerId > 0)?'Update Banner':'Add Banner';
    $redirectUrl     = ($bannerId)?'application/master/banner/add/'.encrypt($bannerId):'application/master/banner/add';

    $BannerModel = new BannerModel();
    $this->viewVars['editDetails'] = '';
    if($bannerId>0){
      $editDetails = BannerModel::find($bannerId)->toArray();
      $this->viewVars['editDetails'] = $editDetails;
    }
   //echo $redirectUrl; print_r(request()->all());exit;
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
    //  echo '111'; print_r($requestData); exit;
      $validator   = \Validator::make($requestData, [
                  'bannerTitle' => 'bail|required|max:100',
                  //'txtSlug' => 'bail|required',
                  'pageType' => 'bail|required',
                 // 'txtPostby' => 'bail|required',
                  'bannerImage' => 'image|mimes:jpg,png,jpeg|max:1024|required_without:hdnbannerImage',
                 // 'bannerText' => 'bail|required',
                      ], 
                      ['bannerTitle.required' => 'Title Name is required',
                       // 'txtSlug.required' => 'Slug is required',                            
                        'pageType.required' => 'Publish date is required',                            
                       // 'txtPostby.required' => 'Posted by is required', 
                        'bannerImage.required_without' => 'Image is required', 
                        'bannerImage.mimes' => 'Image should be jpg,png,jpeg',
                        'bannerImage.max' => 'Image should not be more than 1 mb',                         
                        'bannerText.required' => 'Banner Text is required',                            
      ]);
      if ($validator->fails()) {
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        } else {
          /*Update Record*/
          if($bannerId > 0){
            // $chkDup = BannerModel::where([['bannerTitle', $requestData['bannerTitle']], ['bannerId','!=',$bannerId], ['deletedflag','=',0]])->first();
            // if($chkDup){
            //   request()->session()->flash('error', 'Duplicate record exist');
            // }else{
                $hdnBannerImage=$requestData['hdnbannerImage'];  
                $image       = request()->file('bannerImage');
                // echo'<pre>';print_r($image->getClientOriginalExtension() );exit;
                if($image) {
                    if($hdnBannerImage && $image->getClientOriginalName()!='') 
                    {
                        @unlink('storage/app/uploads/banner/'.$hdnBannerImage);
                    }
                    $image       = request()->file('bannerImage');
                    $newFlName                  = 'banner'.time().'.'.$image->getClientOriginalExtension();
                    request()->file('bannerImage')->move('storage/app/uploads/banner/',$newFlName);
                }else{
                    $newFlName=$hdnBannerImage;
                }
                BannerModel::where('bannerId', $bannerId)
                ->update([
                    'bannerTitle' => $requestData['bannerTitle'],
                    'pageType' => $requestData['pageType'],
                    'bannerImage' => $newFlName,
                    'bannerText' => htmlspecialchars($requestData['bannerText'],ENT_QUOTES),
                  //  'publishDate' => date('Y-m-d', strtotime($requestData['txtBlogDate'])),
                   // 'postedBy' => $requestData['txtPostby'],
                   // 'updatedBy' => session('admin_session_data.userId'),
                    'updatedOn' => now(),
                ]);

              request()->session()->flash('success', 'Record updated successfully');
           // }
          }
          /*Insert Record*/
          else{
            // $chkDup = BannerModel::where([['bannerTitle', $requestData['bannerTitle']],['deletedflag','=',0]])->first();
            // if($chkDup){
            //   request()->session()->flash('error', 'Duplicate record exist');
            // }else{
                $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                $blogPath  = $storagePath.'uploads/banner';
                if(!file_exists($blogPath)){
                    \mkdir($blogPath, 0755);
                }
                $image       = request()->file('bannerImage');
                $newFlName                  = 'banner'.time().'.'.$image->getClientOriginalExtension();
  
                if(request()->file('bannerImage')->move('storage/app/uploads/banner/',$newFlName)) 
                {
                    $BannerModel->bannerTitle = $requestData['bannerTitle'];
                    $BannerModel->pageType = $requestData['pageType'];
                    $BannerModel->bannerImage = $newFlName;
                    $BannerModel->bannerText = htmlspecialchars($requestData['bannerText'],ENT_QUOTES);
                   // $BlogModel->publishDate = date('Y-m-d', strtotime($requestData['txtBlogDate']));
                  //  $BlogModel->postedBy = $requestData['txtPostby'];
                   // $BlogModel->createdBy = session('admin_session_data.userId');
                    $BannerModel->save();              
                }
              request()->session()->flash('success', 'Record added successfully');
           // }
            
          }          
          return redirect::to('application/master/banner');
        }
    }

    return view('application.master.addBanner',$this->viewVars);
  }

 
}

<?php

/* * ******************************************
  File Name     : GalleryController.php
  Description   : Controller file for managing all the gallery
  Created By    : Swagatika
  Created On    : 28-Jun-2021

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
use App\Models\GalleryModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;
use Storage;

class GalleryController extends AppController {
  public function index(){
      if(!empty(request()->all()) && request()->isMethod('post')) {
       
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          GalleryModel::whereIn('galleryId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          GalleryModel::whereIn('galleryId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          GalleryModel::whereIn('galleryId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='USEQ'){ //echo "<pre>";print_r($requestData);exit;
        if(!empty($requestData['seq'])){
          foreach ($requestData['seq'] as $key => $val) {
            $val = ($val>0)?$val:0;
            GalleryModel::where('galleryId',$key)->update(['sequence' => $val,'updatedBy' => session('admin_session_data.userId')]);
          }  
          request()->session()->flash('success', 'Sequence updated successfully');
        }
      }
    }
    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery=GalleryModel::where([['deletedflag',0]]);
    
    if($isViewAll==2){
        $arrResQuery=$arrResQuery->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
      } 
      
    $this->viewVars['startrec']  = $isViewAll; 
    $this->viewVars['arrAllRecords'] = $arrResQuery;

    if(request('hidIds') > 0){
        $bId=request('hidIds');
        GalleryModel::where('galleryId', $bId)
                ->update([
                    'deletedFlag'=>1,
                    'updatedOn' => now()
                ]);
            request()->session()->flash('success', 'Record deleted successfully');                  
            return redirect::to('application/master/gallery');
    }
    return view('application.master.viewGallery',$this->viewVars);
  }

  /*Function for add and edit Gallery*/
  public function add($galleryId){
    $galleryId=($galleryId)?decrypt($galleryId):0;
    $this->viewVars['buttonVal'] = ($galleryId > 0)?'Update Gallery':'Add Gallery';
    $redirectUrl     = ($galleryId)?'application/master/gallery/add/'.encrypt($galleryId):'application/master/gallery/add';

    $GalleryModel = new GalleryModel();
    $this->viewVars['editDetails'] = '';
    if($galleryId>0){
      $editDetails = GalleryModel::find($galleryId)->toArray();
      $this->viewVars['editDetails'] = $editDetails;
    }
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $validator   = \Validator::make($requestData, [
          'caption'    => 'bail|required|max:256',
          'type'    => 'bail|required',
          //'galleryImage' => 'image|mimes:jpg,png,jpeg|max:1024|required_without:hdngalleryImage',
          'galleryImage' => 'image|mimes:jpg,png,jpeg|max:1024',
          'url' => 'bail|required_if:type,Video',
        ],[ 
          'caption.required'     => 'Caption Name is required',
          'type.required'        => 'Media type is required',
          //'galleryImage.required_without' => 'Image is required', 
          'galleryImage.mimes'      => 'Image should be jpg,png,jpeg',
          'galleryImage.max'        => 'Image should not be more than 1 mb',                         
          'url.required' => 'Youtube link is required',                            
        ]
      );
      if($validator->fails()) {
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        } else {
          /*Update Record*/
          if($galleryId > 0){
            // $chkDup = GalleryModel::where([['caption', $requestData['caption']], ['galleryId','!=',$galleryId], ['deletedflag','=',0]])->first();
            // if($chkDup){
            //   request()->session()->flash('error', 'Duplicate record exist');
            // }else{

                if($requestData['type'] == 'Photo'){

                  $hdngalleryImage=$requestData['hdngalleryImage'];  
                  $image       = request()->file('galleryImage');
                  if($image) {
                      if($hdngalleryImage && $image->getClientOriginalName()!='') 
                      {
                          @unlink('storage/app/uploads/gallery/'.$hdngalleryImage);
                      }
                      $image       = request()->file('galleryImage');
                      $newFlName                  = 'gallery'.time().'.'.$image->getClientOriginalExtension();
                      request()->file('galleryImage')->move('storage/app/uploads/gallery/',$newFlName);
                  }else{
                      $newFlName=$hdngalleryImage;
                  }

                }else{
                  $newFlName = '';
                }
                
                GalleryModel::where('galleryId', $galleryId)->update([
                    'caption' => $requestData['caption'],
                    'galleryImage' => $newFlName,
                    'type' => $requestData['type'],
                    'url' => $requestData['url'],
                    'createdBy' => session('admin_session_data.userId'),
                    'createdOn' => date('Y-m-d'),
                ]);

                request()->session()->flash('success', 'Record updated successfully');
           // }
          }
          /*Insert Record*/
          else{
            // $chkDup = GalleryModel::where([['caption', $requestData['caption']],['deletedflag','=',0]])->first();
            // if($chkDup){
            //   request()->session()->flash('error', 'Duplicate record exist');
            // }else{
                if(!empty(request()->file('galleryImage'))){

                  $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                  $galleryPath  = $storagePath.'uploads/gallery';
                  if(!file_exists($galleryPath)){
                      \mkdir($galleryPath, 0755);
                  }
                  $image       = request()->file('galleryImage');
                  $newFlName   = 'gallery'.time().'.'.$image->getClientOriginalExtension();
    
                }
                
                if($requestData['type'] == 'Photo' && request()->file('galleryImage')->move('storage/app/uploads/gallery/',$newFlName)){
                  $GalleryModel->galleryImage = $newFlName;       
                }else{
                  $GalleryModel->url = $requestData['url'];
                }

                $GalleryModel->caption = $requestData['caption'];
                $GalleryModel->type = $requestData['type'];
                $GalleryModel->createdOn = date('Y-m-d');
                $GalleryModel->publishStatus = 1;
                $GalleryModel->createdBy = session('admin_session_data.userId');
                if($GalleryModel->save()){
                  request()->session()->flash('success', 'Record added successfully');
                }else{
                  request()->session()->flash('error', 'Something went wrong.Please try later.');
                }              
           // }
            
          }          
          return redirect::to('application/master/gallery');
        }
    }

    return view('application.master.addGallery',$this->viewVars);
  }

 
}

<?php

/* * ******************************************
  File Name     : ResourceController.php
  Description   : Controller file for managing the banner
  Created By    : Shuvadeep Podder
  Created On    : 11-Apr-2023

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
use App\Models\PressReleaseModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;
use Storage;

class PressReleaseController extends AppController {
  public function index(){ 

    if(!empty(request()->all()) && request()->isMethod('post')) {
       
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          PressReleaseModel::whereIn('preleaseId',$IdsArr)->update(['deletedFlag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          PressReleaseModel::whereIn('preleaseId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          PressReleaseModel::whereIn('preleaseId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }

    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery = PressReleaseModel::where([['deletedFlag',0]]);
    
    if($isViewAll==2){
      $arrResQuery=$arrResQuery->get();
    }elseif($isViewAll==1){
      $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
    } 
    // echo'<pre>';print_r($arrResQuery);exit;
    $this->viewVars['startrec']  = $isViewAll; 
    $this->viewVars['arrAllRecords'] = $arrResQuery;
    return view('application.master.viewPressRelease', $this->viewVars);
  }
    
  /*Function for add and edit resource*/
  public function add($preleaseId){
    // echo $preleaseId;exit;
    $preleaseId = ($preleaseId) ? decrypt($preleaseId) : 0;
    $this->viewVars['buttonVal'] = ($preleaseId > 0) ? 'Update Press Release' : 'Add Press Release';
    $redirectUrl = ($preleaseId)?'application/master/PressRelease/add/'.encrypt($preleaseId):'application/master/PressRelease/add';
    $this->viewVars['editDetails'] = '';
    if($preleaseId > 0){
      $editDetails = PressReleaseModel::find($preleaseId)->toArray();
      $this->viewVars['editDetails'] = $editDetails;
      // print_r($this->viewVars['editDetails']);exit;
    }

    $PressReleaseModel = new PressReleaseModel();
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      // echo'<pre>';print_r($requestData);exit;
      $validator   = \Validator::make($requestData, [
        'txtTitle'        => 'bail|required|max:100',
        // 'txtSlug'         => 'bail|required',
        'txtPressDate'    => 'bail|required',
        'txtPostby'       => 'bail|required',
        'pressImage'      => 'image|mimes:jpg,png,jpeg|max:1024|required_without:hdnpressImage',
        // 'pressDetails'    => 'bail|required',
      ],[
        'txtTitle.required'           => 'Title Name is required',
        // 'txtSlug.required'            => 'Slug is required',
        'txtPressDate.required'       => 'Publish date is required',                            
        'txtPostby.required'          => 'Posted by is required',  
        'pressImage.required_without' => 'Image is required', 
        'pressImage.mimes'            => 'Image should be jpg,png,jpeg',
        'pressImage.max'              => 'Image should not be more than 1 mb',                         
        // 'pressDetails.required'       => 'press Release details is required',                   
      ]);
      if ($validator->fails()) {
        return redirect($redirectUrl)->withErrors($validator)->withInput();
      } else {
        if($preleaseId > 0){
          /* :::::::::: UPDATE CODE START :::::::::: */
          $chkDup = PressReleaseModel::where([['pressTitle', $requestData['txtTitle']], ['preleaseId','!=',$preleaseId], ['deletedFlag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            } else {
              $hdnpressImage = $requestData['hdnpressImage'];  
              $image         = request()->file('pressImage');
              // echo'<pre>';print_r($image);exit; 
              if($image) {
                if($hdnpressImage && $image->getClientOriginalName() != '') 
                {
                    @unlink('storage/app/uploads/pressRelease/'.$hdnpressImage );
                }
                $image       = request()->file('pressImage');
                $newFlName                  = 'pressRelease'.time().'.'.$image->getClientOriginalExtension();
                request()->file('pressImage')->move('storage/app/uploads/pressRelease/', $newFlName);
              } else {
                $newFlName = $hdnpressImage;
              }
              PressReleaseModel::where('preleaseId', $preleaseId)
                ->update([
                    'pressTitle'            => $requestData['txtTitle'],
                    'pressSlug'             => $requestData['txtSlug'],
                    'pressImage'            => $newFlName,
                    'publishDate'           => date('Y-m-d H:i:s', strtotime($requestData['txtPressDate'])),
                    'postedBy'              => $requestData['txtPressDate'],
                    'source'                => $requestData['txtSource'],
                    'pressDetails'          => htmlspecialchars($requestData['pressDetails'],ENT_QUOTES),
                    'updatedBy'             => session('admin_session_data.userId'),
                    'updatedOn'             => now(),
                ]);

              request()->session()->flash('success', 'Record updated successfully');
            }
          /* :::::::::: UPDATE CODE END :::::::::: */
        } else {
          $chkDup = PressReleaseModel::where([['pressTitle', $requestData['txtTitle']],['deletedFlag','=',0]])->first();
          /* :::::::::: INSERT CODE START :::::::::: */
          if($chkDup){
            request()->session()->flash('error', 'Duplicate record exist');
          } else {
              $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
              $pressPath  = $storagePath.'uploads/pressRelease';
              if(!file_exists($pressPath)){
                  \mkdir($pressPath, 0755);
              }
              $image       = request()->file('pressImage');
              $newFlName   = 'pressRelease'.time().'.'.$image->getClientOriginalExtension();

              if(request()->file('pressImage')->move('storage/app/uploads/pressRelease/',$newFlName)) {
                  $PressReleaseModel->pressTitle          = $requestData['txtTitle'];
                  $PressReleaseModel->pressSlug           = $requestData['txtSlug'];
                  $PressReleaseModel->publishDate         = date('Y-m-d H:i:s', strtotime($requestData['txtPressDate']));
                  $PressReleaseModel->pressImage          = $newFlName;
                  $PressReleaseModel->postedBy            = $requestData['txtPostby'];
                  $PressReleaseModel->source              = $requestData['txtSource'];
                  $PressReleaseModel->pressDetails        = htmlspecialchars($requestData['pressDetails'],ENT_QUOTES);
                  $PressReleaseModel->createdBy           = session('admin_session_data.userId');
                  // $PressReleaseModel->save();
                  if($PressReleaseModel->save()){
                    request()->session()->flash('success', 'Record added successfully');
                  }else{
                    request()->session()->flash('error', 'Something went wrong.Please try later.');
                  }
              }
          }
          /* :::::::::: INSERT CODE END :::::::::: */
        }
        return redirect::to('application/master/PressRelease');
      }
    }
    return view('application.master.addPressRelease', $this->viewVars);
  }
}

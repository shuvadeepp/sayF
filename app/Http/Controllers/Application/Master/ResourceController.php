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
use App\Models\ResourceModel;
use App\Models\BlogModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;
use Storage;

class ResourceController extends AppController {
  public function index(){ 
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  

      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }

      if(request('hdnAction') == 'D'){
        if(!empty($IdsArr)){
          ResourceModel::whereIn('resourceId',$IdsArr)->update(['deletedflag' => 1]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      }
      if(request('hdnAction') == 'P'){
        if(!empty($IdsArr)){
          ResourceModel::whereIn('resourceId',$IdsArr)->update(['publishStatus' => 0]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      } 
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          ResourceModel::whereIn('resourceId',$IdsArr)->update(['publishStatus' => 1]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }

    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery = ResourceModel::where([['deletedFlag', 0]]);
      // echo'<pre>';print_r($arrResQuery);exit;
      if($isViewAll==2){
        $arrResQuery=$arrResQuery->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
      } 
      $this->viewVars['arrAllRecords']  = $arrResQuery;
      $this->viewVars['startrec']       = $isViewAll; 
      // echo'<pre>';print_r($this->viewVars);exit;
    return view('application.master.viewResource', $this->viewVars);
  }

  /*Function for add and edit resource*/
  public function add($ResourceId){
    
    // echo $ResourceId;exit;
    $ResourceId = ($ResourceId) ? decrypt($ResourceId) : 0;
    $this->viewVars['buttonVal'] = ($ResourceId > 0) ? 'Update Resource' : 'Add Resource';
    $redirectUrl = ($ResourceId)?'application/master/Resource/add/'.encrypt($ResourceId):'application/master/Resource/add';
    $this->viewVars['editDetails'] = '';
    if($ResourceId > 0){
      $editDetails = ResourceModel::find($ResourceId)->toArray();
      $this->viewVars['editDetails'] = $editDetails;
    }

    $ResourceModel = new ResourceModel();
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      // echo '<pre>'; print_r($requestData); exit;
      $validator   = \Validator::make($requestData, [
        'documentName'  => 'bail|required|max:100',
        'docType'       => 'bail|required',
        'pdfImage'      => 'required_if:docType,==,1|mimes:pdf',
        'urlLink'       => 'required_if:docType,==,2|max:100|bail'
      ],[
        'documentName.required'   => 'Document Name is required',
        'docType.required'        => 'Please select Document type',
        'pdfFile.required_if'     => 'Please upload a PDF file.',
        'pdfFile.mimes'           => 'The uploaded file must be a PDF.',
        'urlLink.required_if'     => 'URL Link is required',   
      ]);
      if ($validator->fails()) {
        return redirect($redirectUrl)->withErrors($validator)->withInput();
         
      } else {
          if($ResourceId > 0){
            /* :::::::::: Update Resource Data :::::::::: */
            // echo $ResourceId;exit;
            if($requestData['docType'] == 1){
              
              $hdnpdfImage = $requestData['hdnpdfImage'];  
              $image       = request()->file('pdfImage');
              // echo'<pre>';print_r($image);exit;
                if($image){
                  if($hdnpdfImage && $image->getClientOriginalName()!=''){
                    @unlink('storage/app/uploads/resource/'.$hdnpdfImage);
                  }
                  $image       = request()->file('pdfImage');
                  $newFlName   = 'resource'.time().'.'.$image->getClientOriginalExtension();
                  // echo $newFlName;exit;
                  request()->file('pdfImage')->move('storage/app/uploads/resource/',$newFlName);
                } else {
                  $newFlName = $hdnpdfImage;
                }
            } else {
              $newFlName = '';
            }
            ResourceModel::where('resourceId', $ResourceId)->update([
              "docName"     => $requestData['documentName'],
              "docType"     => $requestData['docType'],
              "resourceUrl" => $requestData['urlLink'],
              "docFile"     => $newFlName,
              'updatedOn'   => now(),
            ]);
            request()->session()->flash('success', 'Record updated successfully');
            /* :::::::::: END :::::::::: */
          } else {
            /* :::::::::: Insert Resource Data :::::::::: */
            if(!empty(request()->file('pdfImage'))){
              $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
              $galleryPath  = $storagePath.'uploads/resource';
              if(!file_exists($galleryPath)){
                  \mkdir($galleryPath, 0755);
              }
              $image       = request()->file('pdfImage');
              $newFlName   = 'resource'.time().'.'.$image->getClientOriginalExtension();
            }

            if($requestData['docType'] == 1 && request()->file('pdfImage')->move('storage/app/uploads/resource/', $newFlName)){
              $ResourceModel->docFile = $newFlName;       
            }else{
              $ResourceModel->resourceUrl = $requestData['urlLink'];
            }
            $ResourceModel->docName = $requestData['documentName'];
            $ResourceModel->docType = $requestData['docType'];
            $ResourceModel->publishStatus = 1;
            $ResourceModel->createdOn = date('Y-m-d');
            $ResourceModel->createdBy = session('admin_session_data.userId');
            if($ResourceModel->save()){
              request()->session()->flash('success', 'Record added successfully');
            }else{
              request()->session()->flash('error', 'Something went wrong.Please try later.');
            }

            /* :::::::::: END :::::::::: */
          }
      }
      return redirect::to('application/master/Resource');
    }

    return view('application.master.addResource', $this->viewVars);
  }

 
}

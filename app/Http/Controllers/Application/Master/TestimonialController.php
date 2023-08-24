<?php

/* * ******************************************
  File Name     : TestimonialController.php
  Description   : Controller file for managing the banner
  Created By    : Shuvadeep Podder
  Created On    : 14-Apr-2023

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
use App\Models\TestimonialModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;
use Storage;

class TestimonialController extends AppController {
    public function viewTestimonial(){

      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        // echo'<pre>';print_r($requestData);exit;
        $Ids = $requestData['hdnIDs'];
        if(!empty($Ids)){
          $IdsArr = explode(',', $Ids);
        }
  
        if(request('hdnAction') == 'D'){
          if(!empty($IdsArr)){
            TestimonialModel::whereIn('testimonial_id',$IdsArr)->update(['deletedFlag' => 1]);
            request()->session()->flash('success', 'Record deleted successfully');
          }       
        }
        if(request('hdnAction') == 'P'){
          if(!empty($IdsArr)){
            TestimonialModel::whereIn('testimonial_id',$IdsArr)->update(['publishStatus' => 0]);
            request()->session()->flash('success', 'Record updated successfully');
          }       
        } 
        if(request('hdnAction') == 'UP'){
          if(!empty($IdsArr)){
            TestimonialModel::whereIn('testimonial_id',$IdsArr)->update(['publishStatus' => 1]);
            request()->session()->flash('success', 'Record updated successfully');
          }       
        }
      }

      $isViewAll   = (request('hdn_IsViewAll') != '' || request('hdn_IsViewAll') > 0) ? request('hdn_IsViewAll') : 1;
      $arrResQuery = TestimonialModel::where([['deletedFlag', 0]]);
      if ($isViewAll == 2) {
        $arrResQuery = $arrResQuery->get();
      } elseif ($isViewAll == 1) {
        $arrResQuery = $arrResQuery->paginate(TOTPAGINATE);
      }
      // echo "<pre>";print_r($arrResQuery);exit;
      $this->viewVars['arrAllRecords']  = $arrResQuery;
      $this->viewVars['startrec']       = $isViewAll;
      return view('application.master.viewTestimonial', $this->viewVars);
    }

    public function add($testimonial_id) {
      // echo $testimonial_id;exit;
      $testimonial_id = ($testimonial_id) ? decrypt($testimonial_id) : 0;
      $this->viewVars['buttonVal'] = ($testimonial_id > 0) ? 'Update Testimonial' : 'Add Testimonial';
      $redirectUrl = ($testimonial_id)?'application/master/Testimonial/add/'.encrypt($testimonial_id):'application/master/Testimonial/add';
      $this->viewVars['editDetails'] = '';

      if($testimonial_id > 0){
        $editDetails = TestimonialModel::find($testimonial_id)->toArray();
        $this->viewVars['editDetails'] = $editDetails;
      }


      $TestimonialModel = new TestimonialModel();

      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        // echo '<pre>'; print_r($requestData); exit;
        $validator   = \Validator::make($requestData, [
          'txtName'         => 'bail|required',
          'txtTitle'        => 'bail|required',
          'txtDesignation'  => 'bail|required',
          'txtAdress'       => 'bail|required',
          'uplodImg'        => 'image|mimes:jpg,png,jpeg|max:1024|required_without:hdnuplodImg',
          'txtContent'      => 'bail|required'
        ],[
          'txtName.required'            => 'Name is required',
          'txtTitle.required'           => 'Title is required',
          'txtDesignation.required'     => 'Designation is required',
          'txtAdress.required'          => 'Address is required',
          'uplodImg.required_without'   => 'Image is required', 
          'uplodImg.mimes'              => 'Image should be jpg,png,jpeg',
          'uplodImg.max'                => 'Image should not be more than 1 mb',
          'txtContent.required'         => 'Content details is required'
        ]);

        if ($validator->fails()) {
          return redirect($redirectUrl)->withErrors($validator)->withInput();
        } else {
          if($testimonial_id > 0){
            /* :::::::::: UPDATE TESTIMONIAL CODE START :::::::::: */
              // echo $testimonial_id;exit; 
              $chkDup = TestimonialModel::where([['tsmTtitle', $requestData['txtTitle']], ['testimonial_id','!=',$testimonial_id], ['deletedFlag','=',0]])->first();
                if($chkDup){
                  request()->session()->flash('error', 'Duplicate record exist');
                } else {
                  $hdnuplodImg = $requestData['hdnuplodImg'];  
                  // echo'<pre>';print_r($hdnuplodImg);exit; 
                  $image       = request()->file('uplodImg');
                    if($image){
                      print_r($image);
                      if($hdnuplodImg && $image->getClientOriginalName() != ''){
                        @unlink('storage/app/uploads/testimonial/'. $hdnuplodImg);
                      }
                      $image       = request()->file('uplodImg');
                      $newFlName   = 'testimonial'.time().'.'.$image->getClientOriginalExtension();
                      // echo'<pre>';print_r($newFlName);exit; 
                      request()->file('uplodImg')->move('storage/app/uploads/testimonial/', $newFlName);
                    }else{
                      $newFlName = $hdnuplodImg;
                    }

                    TestimonialModel::where('testimonial_id', $testimonial_id)
                    ->update([
                      'tsmName'             => $requestData['txtName'],
                      'tsmTtitle'           => $requestData['txtTitle'],
                      'tsmDesignation'      => $requestData['txtDesignation'],
                      'tsmAddress'          => $requestData['txtAdress'],
                      'tsmContent'          => $requestData['txtContent'],
                      'tsmImage'            => $newFlName,
                      'updatedOn'           => now(),
                      'updatedBy'           => session('admin_session_data.userId'),
                    ]);
                    request()->session()->flash('success', 'Record updated successfully');
                }
            /* :::::::::: UPDATE TESTIMONIAL CODE END   :::::::::: */
          } else {
            /* :::::::::: INSERT TESTIMONIAL CODE START :::::::::: */
            if(!empty(request()->file('uplodImg'))){
              $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
              $galleryPath  = $storagePath.'uploads/testimonial';
              if(!file_exists($galleryPath)){
                  \mkdir($galleryPath, 0755);
              }
              $image       = request()->file('uplodImg');
              $newFlName   = 'testimonial'.time().'.'.$image->getClientOriginalExtension();
            }
            if(request()->file('uplodImg')->move('storage/app/uploads/testimonial/', $newFlName)){
              $TestimonialModel->tsmImage = $newFlName;

              $TestimonialModel->tsmName            = $requestData['txtName'];
              $TestimonialModel->tsmTtitle          = $requestData['txtTitle'];
              $TestimonialModel->tsmDesignation     = $requestData['txtDesignation'];
              $TestimonialModel->tsmAddress         = $requestData['txtAdress'];
              $TestimonialModel->tsmContent         = $requestData['txtContent'];

              if($TestimonialModel->save()){
                request()->session()->flash('success', 'Record added successfully');
              }else{
                request()->session()->flash('error', 'Something went wrong.Please try later.');
              }

            }
            /* :::::::::: INSERT TESTIMONIAL CODE END   :::::::::: */
          }
        }
        return redirect::to('application/master/Testimonial/viewTestimonial');

    }
    return view('application.master.addTestimonial', $this->viewVars);
    
  }
}
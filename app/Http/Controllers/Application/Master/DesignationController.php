<?php

/* * ******************************************
  File Name     : MasterController.php
  Description   : Controller file for managing all the master modules
  Created By    : Samir Kumar
  Created On    : 06-Apr-2021

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
use App\Models\DesignationModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;

class DesignationController extends AppController {
    /*****************************view designation*****************************************/
    public function index(){
        if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          DesignationModel::whereIn('designationId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          DesignationModel::whereIn('designationId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          DesignationModel::whereIn('designationId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
      $isViewAll        = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
      $arrResQuery      =DesignationModel::where([['deletedflag',0]]);
      
      if($isViewAll == 2){
        $arrResQuery  =$arrResQuery->get();
      }elseif($isViewAll == 1){
        $arrResQuery  =$arrResQuery->paginate(TOTPAGINATE);
      } 

      $this->viewVars['startrec']  = $isViewAll; 
      $this->viewVars['arrAllRecords'] = $arrResQuery;

      return view('application.master.viewDesignation',$this->viewVars);
    }


    /*****************************add update designation*****************************************/
    public function add($designationId){
      $designationId                       = ($designationId)?decrypt($designationId):0;
      $this->viewVars['tabTxt']            = ($designationId)?'Update':'Add';         
      $redirectUrl                         = ($designationId)?'application/master/designation/add/'.encrypt($designationId):'application/master/designation/add';
      $DesignationModel                    = new DesignationModel();
      $this->viewVars['editDesignation']   = '';
      if($designationId > 0){
        $editDesignation                   = DesignationModel::find($designationId)->toArray();
        $this->viewVars['editDesignation'] = $editDesignation;
      }
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData  = request()->all();  
        $validator    = \Validator::make($requestData, [
                                  'txtDesignation' => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:64'
                                  ],[
                                    'txtDesignation.required' =>'Designation is required',
                                    'txtDesignation.regex'    =>'Designation should be alphanumeric'
                                  ]);
        if($validator->fails()){
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        }else{
            if($designationId > 0){
              $chkDup = DesignationModel::where([['designationName', $requestData['txtDesignation']],['designationId','!=',$designationId],['deletedFlag','=',0]])->first();
              if($chkDup){
                request()->session()->flash('error', 'Duplicate record exist');
                //echo 'application/master/designation/add/'.encrypt($designationId);exit;
                return redirect::to($redirectUrl)->withInput();
              }else{
                DesignationModel::where('designationId', $designationId)
                      ->update([
                          'designationName' => $requestData['txtDesignation'],
                          'updatedBy'       => session('admin_session_data.userId')
                      ]);
                request()->session()->flash('success', 'Record updated successfully');
              }
            }else{
              $chkDup = DesignationModel::where([['designationName', $requestData['txtDesignation']],['deletedFlag','=',0]])->first();
              if($chkDup){
                request()->session()->flash('error', 'Duplicate record exist');
                return redirect::to($redirectUrl)->withInput();
              }else{
                $DesignationModel->designationName = $requestData['txtDesignation'];
                $DesignationModel->createdBy       = session('admin_session_data.userId');
                $DesignationModel->save();
                request()->session()->flash('success', 'Record added successfully');
              }
            }          
          return redirect::to('application/master/designation');
        }
      }
      return view('application.master.addDesignation',$this->viewVars);
    }

 
}

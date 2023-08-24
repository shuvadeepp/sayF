<?php

/* * ******************************************
  File Name     : QualificationController.php
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
use App\Models\QualificationModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;

class QualificationController extends AppController {
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
          QualificationModel::whereIn('qualificationId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          QualificationModel::whereIn('qualificationId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          QualificationModel::whereIn('qualificationId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
      $isViewAll        = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
      $arrResQuery      =QualificationModel::where([['deletedFlag',0]]);
      
      if($isViewAll == 2){
        $arrResQuery  =$arrResQuery->get();
      }elseif($isViewAll == 1){
        $arrResQuery  =$arrResQuery->paginate(TOTPAGINATE);
      } 

      $this->viewVars['startrec']  = $isViewAll; 
      $this->viewVars['arrAllRecords'] = $arrResQuery;

      return view('application.master.viewQualification',$this->viewVars);
    }


    /*****************************add update qualification*****************************************/
    public function add($qualificationId){
      $qualificationId                       = ($qualificationId)?decrypt($qualificationId):0;
      $this->viewVars['tabTxt']              = ($qualificationId)?'Update':'Submit';         
      $redirectUrl                           = ($qualificationId)?'application/master/qualification/add/'.encrypt($qualificationId):'application/master/qualification/add';
      $QualificationModel                    = new QualificationModel();
      $this->viewVars['editQualification']   = '';
      if($qualificationId > 0){
        $editQualification                   = QualificationModel::find($qualificationId)->toArray();
        $this->viewVars['editQualification'] = $editQualification;
      }
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData  = request()->all();  
        $validator    = \Validator::make($requestData, [
                                  'txtQualification' => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:64'
                                  ],[
                                    'txtQualification.required' =>'Qualification is required',
                                    'txtQualification.regex'    =>'Qualification should be alphanumeric'
                                  ]);
        if($validator->fails()){
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        }else{
            if($qualificationId > 0){
              $chkDup = QualificationModel::where([['qualification', $requestData['txtQualification']],['qualificationId','!=',$qualificationId],['deletedFlag','=',0]])->first();
              if($chkDup){
                request()->session()->flash('error', 'Duplicate record exist');
                //echo 'application/master/designation/add/'.encrypt($qualificationId);exit;
                return redirect::to($redirectUrl)->withInput();
              }else{
                QualificationModel::where('qualificationId', $qualificationId)
                      ->update([
                          'qualification' => $requestData['txtQualification'],
                          'updatedBy'       => session('admin_session_data.userId')
                      ]);
                request()->session()->flash('success', 'Record updated successfully');
              }
            }else{
              $chkDup = QualificationModel::where([['qualification', $requestData['txtQualification']],['deletedFlag','=',0]])->first();
              if($chkDup){
                request()->session()->flash('error', 'Duplicate record exist');
                return redirect::to($redirectUrl)->withInput();
              }else{
                $QualificationModel->qualification = $requestData['txtQualification'];
                $QualificationModel->createdBy       = session('admin_session_data.userId');
                $QualificationModel->save();
                request()->session()->flash('success', 'Record added successfully');
              }
            }          
          return redirect::to('application/master/qualification');
        }
      }
      return view('application.master.addQualification',$this->viewVars);
    }

 
}

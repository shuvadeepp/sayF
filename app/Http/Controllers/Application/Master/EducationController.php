<?php

/* * ******************************************
  File Name     : educationController.php
  Description   : Controller file for managing all the education type
  Created By    : Sandeep Kumar Senapati
  Created On    : 12-Apr-2021

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
use App\Models\EducationModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;

class EducationController extends AppController {
  public function index(){
     if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          EducationModel::whereIn('educationId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          EducationModel::whereIn('educationId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          EducationModel::whereIn('educationId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery=EducationModel::where([['deletedflag',0]]);
    
    if($isViewAll==2){
        $arrResQuery=$arrResQuery->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
      } 
      
    $this->viewVars['startrec']  = $isViewAll; 
    $this->viewVars['arrAllRecords'] = $arrResQuery;
    return view('application.master.viewEducation',$this->viewVars);
  }

  /*Function for add and edit education*/
  public function add($educationId){
    $educationId=($educationId)?decrypt($educationId):0;
    $this->viewVars['buttonVal'] = ($educationId > 0)?'Update':'Submit';
    $redirectUrl     = ($educationId)?'application/master/education/add/'.encrypt($educationId):'application/master/education/add';

    $EducationModel = new EducationModel();
    $this->viewVars['editDetails'] = '';
    if($educationId>0){
      $editDetails = EducationModel::find($educationId)->toArray();
      $this->viewVars['editDetails'] = $editDetails;
    }
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $validator   = \Validator::make($requestData, [
                  'txtEducation' => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:50',
                  'selEducation' => 'bail|required',
                      ], 
                      ['txtEducation.required' => 'Education Name is required',
                        'txtEducation.regex'=>'Education name should be alphanumeric',
                        'selEducation.required' => 'Education type is required',                            
      ]);
      if ($validator->fails()) {
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        } else {
          /*Update Record*/
          if($educationId > 0){
            $chkDup = EducationModel::where([['educationName', $requestData['txtEducation']], ['educationId','!=',$educationId],['deletedflag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
                    
                EducationModel::where('educationId', $educationId)
                ->update([
                    'educationName' => $requestData['txtEducation'],
                    'educationType' => $requestData['selEducation'],
                    'updatedBy' => session('admin_session_data.userId')
                ]);

              request()->session()->flash('success', 'Record updated successfully');
            }
          }
          /*Insert Record*/
          else{
            $chkDup = EducationModel::where([['educationName', $requestData['txtEducation']],['deletedflag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
              
                $EducationModel->educationName = $requestData['txtEducation'];
                $EducationModel->educationType = $requestData['selEducation'];
                $EducationModel->createdBy = session('admin_session_data.userId');
                $EducationModel->save();              
              
              request()->session()->flash('success', 'Record added successfully');
            }
            
          }          
          return redirect::to('application/master/education');
        }
    }

    return view('application.master.addEducation',$this->viewVars);
  }

 
}

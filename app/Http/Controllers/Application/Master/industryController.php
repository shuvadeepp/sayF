<?php

/* * ******************************************
  File Name     : industryController.php
  Description   : Controller file for managing all the industry type
  Created By    : Sandeep Kumar Senapati
  Created On    : 09-Apr-2021

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
use App\Models\IndustryModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;

class IndustryController extends AppController {
  public function index(){
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          IndustryModel::whereIn('industryId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          IndustryModel::whereIn('industryId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          IndustryModel::whereIn('industryId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery=IndustryModel::where([['deletedflag',0]]);
    
    if($isViewAll==2){
        $arrResQuery=$arrResQuery->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
      } 
      
    $this->viewVars['startrec']  = $isViewAll; 
    $this->viewVars['arrAllRecords'] = $arrResQuery;
    return view('application.master.viewIndustrytype',$this->viewVars);
  }

  /*Function for add and edit industry type*/
  public function add($industryId){
    $industryId=($industryId)?decrypt($industryId):0;
    $this->viewVars['buttonVal'] = ($industryId > 0)?'Update Industry Type':'Add Industry Type';
    $redirectUrl     = ($industryId)?'application/master/industry/add/'.encrypt($industryId):'application/master/industry/add';

    $IndustryModel = new IndustryModel();
    $this->viewVars['editDetails'] = '';
    if($industryId>0){
      $editDetails = IndustryModel::find($industryId)->toArray();
      //print_r($editDetails);exit;
      $this->viewVars['editDetails'] = $editDetails;
    }
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $validator   = \Validator::make($requestData, [
                  'txtIndType' => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:50'
                      ], 
                      ['txtIndType.required' => 'Industry Type is required',
                        'txtIndType.regex'=>'Skill name should be alphanumeric'
                        
      ]);
      if ($validator->fails()) {
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        } else {
          /*Update Record*/
          if($industryId > 0){
            $chkDup = IndustryModel::where([['industryName', $requestData['txtIndType']], ['industryId','!=',$industryId],['deletedFlag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
            
              IndustryModel::where('industryId', $industryId)
                    ->update([
                        'industryName' => $requestData['txtIndType'],
                        'updatedBy' => session('admin_session_data.userId')
                    ]);

              request()->session()->flash('success', 'Record updated successfully');
            }
          }
          /*Insert Record*/
          else{
            $chkDup = IndustryModel::where([['industryName', $requestData['txtIndType']],['deletedFlag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
              
                $IndustryModel->industryName = $requestData['txtIndType'];
                $IndustryModel->createdBy = session('admin_session_data.userId');
                $IndustryModel->save();
              
              request()->session()->flash('success', 'Record added successfully');
            }
            
          }          
          return redirect::to('application/master/industry');
        }
    }

    return view('application.master.addIndustrytype',$this->viewVars);
  }

 
}

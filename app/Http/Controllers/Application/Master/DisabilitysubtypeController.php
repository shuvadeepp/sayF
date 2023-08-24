<?php

/* * ******************************************
  File Name     : disabilityController.php
  Description   : Controller file for managing all the DisabilitysubtypeController type
  Created By    : Sandeep Kumar Senapati
  Created On    : 07-Apr-2021

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
use App\Models\DisabilityModel;
use App\Models\DisabilitySubtypeModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;

class DisabilitysubtypeController extends AppController {
  public function index(){
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          DisabilitySubtypeModel::whereIn('disabilitySubtypeId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          DisabilitySubtypeModel::whereIn('disabilitySubtypeId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          DisabilitySubtypeModel::whereIn('disabilitySubtypeId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery=DisabilitySubtypeModel::where([['deletedflag',0]]);
    
    if($isViewAll==2){
        $arrResQuery=$arrResQuery->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
      } 
      
    $this->viewVars['startrec']  = $isViewAll; 
    $this->viewVars['arrAllRecords'] = $arrResQuery;
    return view('application.master.viewDisabilitySubtype',$this->viewVars);
  }

  /*Function for add and edit disability subtype*/
  public function add($disabilitySubtypeId){
    $disabilitySubtypeId=($disabilitySubtypeId)?decrypt($disabilitySubtypeId):0;
     $disability = DB::table('m_disabilitytype')
                    ->select('disabilityId','disabilityName')
                    ->where('deletedFlag',0)->get();
      $this->viewVars['disability']  = $disability;

    $this->viewVars['buttonVal'] = ($disabilitySubtypeId > 0)?'Update':'Submit';
    $redirectUrl     = ($disabilitySubtypeId)?'application/master/disabilitysubtype/add/'.encrypt($disabilitySubtypeId):'application/master/disabilitysubtype/add';

    $DisabilitySubtypeModel = new DisabilitySubtypeModel();
    $this->viewVars['editDetails'] = '';
    if($disabilitySubtypeId>0){
      $editDetails = DisabilitySubtypeModel::find($disabilitySubtypeId)->toArray();
      //print_r($editDetails);exit;
      $this->viewVars['editDetails'] = $editDetails;
    }
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $validator   = \Validator::make($requestData, [
                  'disabilityId' => 'bail|required|numeric',
                  'disabilitySubType' => 'bail|required|max:64',
                  ],
                  [
                    'disabilityId.required' => 'Disability is required',
                    'disabilityId.numeric' => 'Disability should be numeric',
                    'disabilitySubType.required' => 'Disability subtype is required',
                  ]
      );
      if ($validator->fails()) {
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        } else {
          /*Update Record*/
          if($disabilitySubtypeId > 0){            
            $chkDup = DisabilitySubtypeModel::where([['disabilitySubType', $requestData['disabilitySubType']],['disabilityId',$requestData['disabilityId']],['disabilitySubtypeId','!=',$disabilitySubtypeId],['deletedFlag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
              DisabilitySubtypeModel::where('disabilitySubtypeId', $disabilitySubtypeId)
                        ->update([
                            'disabilityId' => $requestData['disabilityId'],
                            'disabilitySubType' => $requestData['disabilitySubType'],
                            'updatedBy' => session('admin_session_data.userId')
                        ]);
              request()->session()->flash('success', 'Record updated successfully');
            }
          }
          /*Insert Record*/
          else{
            $chkDup = DisabilitySubtypeModel::where([['disabilitySubType', $requestData['disabilitySubType']],['disabilityId',$requestData['disabilityId']],['deletedFlag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
              
                $DisabilitySubtypeModel->disabilityId = $requestData['disabilityId'];
                $DisabilitySubtypeModel->disabilitySubType = $requestData['disabilitySubType'];
                $DisabilitySubtypeModel->createdBy = session('admin_session_data.userId');
                $DisabilitySubtypeModel->save();
              request()->session()->flash('success', 'Record added successfully');
            }
            
          }          
          return redirect::to('application/master/disabilitysubtype');
        }
    }
    return view('application.master.addDisabilitySubtype',$this->viewVars);
  }

 
}

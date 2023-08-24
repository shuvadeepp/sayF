<?php

/* * ******************************************
  File Name     : serviceController.php
  Description   : Controller file for managing all the DisabilitysubtypeController type
  Created By    : Sandeep Kumar Senapati
  Created On    : 04-May-2021

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
use App\Models\ServiceModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;

class ServiceController extends AppController {
  public function index(){
    
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          ServiceModel::whereIn('serviceId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          ServiceModel::whereIn('serviceId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          ServiceModel::whereIn('serviceId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery=ServiceModel::where([['deletedflag',0]]);
    
    if($isViewAll==2){
        $arrResQuery=$arrResQuery->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
      } 
      
    $this->viewVars['startrec']  = $isViewAll; 
    $this->viewVars['arrAllRecords'] = $arrResQuery;
    return view('application.master.viewService',$this->viewVars);
  }

  /*Function for add and edit disability subtype*/
  public function add($serviceId){
    $serviceId=($serviceId)?decrypt($serviceId):0;
     
    $this->viewVars['buttonVal'] = ($serviceId > 0)?'Update Service':'Add Service';
    $redirectUrl     = ($serviceId)?'application/master/service/add/'.encrypt($serviceId):'application/master/service/add';

    $ServiceModel = new ServiceModel();
    $this->viewVars['editDetails'] = '';
    if($serviceId>0){
      $editDetails = ServiceModel::find($serviceId)->toArray();
      //print_r($editDetails);exit;
      $this->viewVars['editDetails'] = $editDetails;
    }
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $validator   = \Validator::make($requestData, [
                  'serviceName' => 'bail|required|max:64',
                  ],
                  [
                    'serviceName.required' => 'Disability subtype is required',
                  ]
      );
      if ($validator->fails()) {
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        } else {
          /*Update Record*/
          if($serviceId > 0){            
            $chkDup = ServiceModel::where([['serviceName', $requestData['serviceName']],['serviceId','!=',$serviceId],['deletedflag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
              ServiceModel::where('serviceId', $serviceId)
                        ->update([
                            'serviceName' => $requestData['serviceName'],
                            'updatedBy' => session('admin_session_data.userId')
                        ]);
              request()->session()->flash('success', 'Record updated successfully');
            }
          }
          /*Insert Record*/
          else{
            $chkDup = ServiceModel::where([['serviceName', $requestData['serviceName']],['deletedflag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
              
                $ServiceModel->serviceName = $requestData['serviceName'];
                $ServiceModel->createdBy = session('admin_session_data.userId');
                $ServiceModel->save();
              request()->session()->flash('success', 'Record added successfully');
            }
            
          }          
          return redirect::to('application/master/service');
        }
    }
    return view('application.master.addService',$this->viewVars);
  }

 
}

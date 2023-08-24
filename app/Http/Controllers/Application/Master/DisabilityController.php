<?php

/* * ******************************************
  File Name     : disabilityController.php
  Description   : Controller file for managing all the disability type
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
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;

class DisabilityController extends AppController {
  public function index(){
     if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          DisabilityModel::whereIn('disabilityId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          DisabilityModel::whereIn('disabilityId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          DisabilityModel::whereIn('disabilityId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery=DisabilityModel::where([['deletedflag',0]]);
    
    if($isViewAll==2){
        $arrResQuery=$arrResQuery->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
      } 
      
    $this->viewVars['startrec']  = $isViewAll; 
    $this->viewVars['arrAllRecords'] = $arrResQuery;
    return view('application.master.viewDisability',$this->viewVars);
  }

  /*Function for add and edit disability*/
  public function add($disabilityId){
    $disabilityId=($disabilityId)?decrypt($disabilityId):0;
    $this->viewVars['buttonVal'] = ($disabilityId > 0)?'Update Disability':'Add Disability';
    $redirectUrl     = ($disabilityId)?'application/master/disability/add/'.encrypt($disabilityId):'application/master/disability/add';

    $DisabilityModel = new DisabilityModel();
    $this->viewVars['editDetails'] = '';
    if($disabilityId>0){
      $editDetails = DisabilityModel::find($disabilityId)->toArray();
      //print_r($editDetails);exit;
      $this->viewVars['editDetails'] = $editDetails;
    }
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      if($disabilityId > 0){
        $validator   = \Validator::make($requestData, [
            'txtDisability' => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:50'
        ], 
        ['txtDisability.required' => 'Disability is required',
          'txtDisability.regex'=>'Skill name should be alphanumeric',                      
        ]);
      }else{
        $validator   = \Validator::make($requestData, [
                  'txtDisability' => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:50',
                 // 'desabilityIcon' => 'required|image|mimes:jpg,png,jpeg,gif|max:1024',
                      ], 
                      ['txtDisability.required' => 'Disability is required',
                        'txtDisability.regex'=>'Skill name should be alphanumeric',
                       // 'desabilityIcon.required' => 'Icon is required',
                       // 'desabilityIcon.mimes' => 'Icon should be jpg,png,jpeg,gif',
                       // 'desabilityIcon.max' => 'Icon should not be more than 1 mb',
                        
      ]);
      }      
      if ($validator->fails()) {
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        } else {
          /*Update Record*/
          if($disabilityId > 0){
            $chkDup = DisabilityModel::where([['disabilityName', $requestData['txtDisability']], ['disabilityId','!=',$disabilityId],['deletedFlag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
            
            //  $hdnIcon=$requestData['hdnIcon'];  
             // $image       = request()->file('desabilityIcon');
             /* if($image) {
                    if($hdnIcon && $image->getClientOriginalName()!='') 
                    {
                        @unlink('storage/uploads/disabilityicon/'.$hdnIcon);
                    }

                    $image       = request()->file('desabilityIcon');
                    $newFlName                  = 'desabilityIcon'.time().'.'.$image->getClientOriginalExtension();

                    if(request()->file('desabilityIcon')->move('storage/uploads/disabilityicon/',$newFlName)) {
                        DisabilityModel::where('disabilityId', $disabilityId)
                        ->update([
                            'disabilityName' => $requestData['txtDisability'],
                            'image' => $newFlName,
                            'updatedBy' => session('admin_session_data.userId')
                        ]);
                    }

                }*/
                  DisabilityModel::where('disabilityId', $disabilityId)
                        ->update([
                            'disabilityName' => $requestData['txtDisability'],
                          
                            'updatedBy' => session('admin_session_data.userId')
                        ]);

              request()->session()->flash('success', 'Record updated successfully');
            }
          }
          /*Insert Record*/
          else{
            $chkDup = DisabilityModel::where([['disabilityName', $requestData['txtDisability']],['deletedFlag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
             /* $image       = request()->file('desabilityIcon');
              $newFlName                  = 'desabilityIcon'.time().'.'.$image->getClientOriginalExtension();

              if(request()->file('desabilityIcon')->move('storage/uploads/disabilityicon/',$newFlName)) 
              {
                $DisabilityModel->disabilityName = $requestData['txtDisability'];
                $DisabilityModel->image = $newFlName;
                $DisabilityModel->createdBy = session('admin_session_data.userId');
                $DisabilityModel->save();
              }*/

                $DisabilityModel->disabilityName = $requestData['txtDisability'];
              
                $DisabilityModel->createdBy = session('admin_session_data.userId');
                $DisabilityModel->save();
              
              
              request()->session()->flash('success', 'Record added successfully');
            }
            
          }          
          return redirect::to('application/master/disability');
        }
    }

    return view('application.master.addDisability',$this->viewVars);
  }

 
}

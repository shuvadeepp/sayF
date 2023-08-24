<?php

/* * ******************************************
  File Name     : SkillController.php
  Description   : Controller file for managing all the skills
  Created By    : Sandeep Kumar Senapati
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
use App\Models\SkillModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;

class SkillController extends AppController {
  public function index(){
     if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          SkillModel::whereIn('skillsId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          SkillModel::whereIn('skillsId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){

        if(!empty($IdsArr)){
          SkillModel::whereIn('skillsId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery=SkillModel::from('m_skills as a')
                  ->selectRaw('a.skillsId,a.designationId,a.skillName,a.publishStatus,b.designationName')
                  ->leftjoin('m_designation as b','a.designationId','=','b.designationId')
                  ->where([['a.deletedflag',0]]);
    
    if($isViewAll==2){
        $arrResQuery=$arrResQuery->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
      } 
      
    $this->viewVars['startrec']  = $isViewAll; 
    $this->viewVars['arrAllRecords'] = $arrResQuery;
    return view('application.master.viewSkill',$this->viewVars);
  }

  /*Function for add and edit skill*/
  public function add($skillId){
    $desigDetls=DB::table('m_designation')
                  ->select('designationId','designationName')
                  ->where([['deletedflag',0],['publishStatus',0]])->get();
    $this->viewVars['desigDetls']=$desigDetls;
    $skillId=($skillId)?decrypt($skillId):0;
    $this->viewVars['buttonVal'] = ($skillId > 0)?'Update Skill':'Add Skill';
    $redirectUrl     = ($skillId)?'application/master/skill/add/'.encrypt($skillId):'application/master/skill/add';

    $SkillModel = new SkillModel();
    $this->viewVars['editDetails'] = '';
    if($skillId>0){
      $editDetails = SkillModel::find($skillId)->toArray();
      $this->viewVars['editDetails'] = $editDetails;
    }
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all(); 
      $validator   = \Validator::make($requestData, [
                  'selDesignation' => 'bail|required',
                  'txtSkill' => 'bail|required|regex:/^[a-zA-Z0-9_\- \/, ]*$/|max:50'
                      ], 
                      ['selDesignation.required' => 'Select designation',
                        'txtSkill.required' => 'Skill is required',
                        'txtSkill.regex'=>'Skill name should be alphanumeric'
      ]);
      if ($validator->fails()) {
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        } else {
          /*Update Record*/
          if($skillId > 0){
            $chkDup = SkillModel::where([['skillName', $requestData['txtSkill']], ['designationId', $requestData['selDesignation']], ['skillsId','!=',$skillId],['deletedFlag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
            SkillModel::where('skillsId', $skillId)
                    ->update([
                        'designationId' => $requestData['selDesignation'],
                        'skillName' => $requestData['txtSkill'],
                        'updatedBy' => session('admin_session_data.userId')
                    ]);
              request()->session()->flash('success', 'Record updated successfully');
            }
          }
          /*Insert Record*/
          else{
            $chkDup = SkillModel::where([['skillName', $requestData['txtSkill']],['designationId', $requestData['selDesignation']],['deletedFlag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
              $SkillModel->designationId = $requestData['selDesignation'];
              $SkillModel->skillName = $requestData['txtSkill'];
              $SkillModel->createdBy = session('admin_session_data.userId');
              $SkillModel->save();
              request()->session()->flash('success', 'Record added successfully');
            }
            
          }          
          return redirect::to('application/master/skill');
        }
    }

    return view('application.master.addSkill',$this->viewVars);
  }

 
}

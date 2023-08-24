<?php

/* * ******************************************
  File Name     : QualificationsubcategoryController.php
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
use App\Models\QualificationsubcategoryModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;

class QualificationsubcategoryController extends AppController {
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
          QualificationsubcategoryModel::whereIn('subCatId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          QualificationsubcategoryModel::whereIn('subCatId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          QualificationsubcategoryModel::whereIn('subCatId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
      $isViewAll        = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
      $arrResQuery=QualificationsubcategoryModel::from('m_qualification_subcategory AS A')
                  ->selectRaw('A.subCatId,A.subcategoryName,B.qualification,A.publishStatus')
                  ->leftjoin('m_qualification AS B','A.qualificationId','=','B.qualificationId','B.deletedFlag','=',0)
                  ->where([['A.deletedFlag',0]]);
      
      if($isViewAll == 2){
        $arrResQuery  =$arrResQuery->get();
      }elseif($isViewAll == 1){
        $arrResQuery  =$arrResQuery->paginate(TOTPAGINATE);
      } 

      $this->viewVars['startrec']  = $isViewAll; 
      $this->viewVars['arrAllRecords'] = $arrResQuery;

      return view('application.master.viewQualificationsubcat',$this->viewVars);
    }


    /*****************************add update qualification*****************************************/
    public function add($subCatId){
      $qualification                        =DB::table('m_qualification')
                                            ->select('qualificationId','qualification')
                                            ->where('deletedFlag',0)->get();
      $this->viewVars['qualification']       = $qualification;
      $subCatId                              = ($subCatId)?decrypt($subCatId):0;
      $this->viewVars['tabTxt']              = ($subCatId)?'Update':'Add';         
      $redirectUrl                           = ($subCatId)?'application/master/qualification/add/'.encrypt($subCatId):'application/master/qualification/add';
      $QualificationsubcategoryModel         = new QualificationsubcategoryModel();
      $this->viewVars['editSubcategory']     = '';
      if($subCatId > 0){
        $editSubcategory                     = QualificationsubcategoryModel::find($subCatId)->toArray();
        $this->viewVars['editSubcategory']   = $editSubcategory;
      }
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData  = request()->all();  
        $validator    = \Validator::make($requestData, [
                                  'selQualification' => 'bail|required|integer',
                                  'txtSubcategory'   => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:128'
                                  ],[
                                    'selQualification.required' =>'Qualification is required',
                                    'txtSubcategory.required'   =>'Sub category should is required',
                                    'txtSubcategory.regex'      =>'Sub category should be alphanumeric'
                                  ]);
        if($validator->fails()){
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        }else{
            if($subCatId > 0){
              $chkDup = QualificationsubcategoryModel::where([['subcategoryName', $requestData['txtSubcategory']],['subCatId','!=',$subCatId]])->first();
              if($chkDup){
                request()->session()->flash('error', 'Duplicate record exist');
                //echo 'application/master/designation/add/'.encrypt($subCatId);exit;
                return redirect::to($redirectUrl)->withInput();
              }else{
                QualificationsubcategoryModel::where('subCatId', $subCatId)
                      ->update([
                          'qualificationId' => $requestData['selQualification'],
                          'subcategoryName' => $requestData['txtSubcategory'],
                          'updatedBy'       => session('admin_session_data.userId')
                      ]);
                request()->session()->flash('success', 'Record updated successfully');
              }
            }else{
              $chkDup = QualificationsubcategoryModel::where('subcategoryName', $requestData['txtSubcategory'])->first();
              if($chkDup){
                request()->session()->flash('error', 'Duplicate record exist');
                return redirect::to($redirectUrl)->withInput();
              }else{
                $QualificationsubcategoryModel->qualificationId   = $requestData['selQualification'];
                $QualificationsubcategoryModel->subcategoryName   = $requestData['txtSubcategory'];
                $QualificationsubcategoryModel->createdBy         = session('admin_session_data.userId');
                $QualificationsubcategoryModel->save();
                request()->session()->flash('success', 'Record added successfully');
              }
            }          
          return redirect::to('application/master/qualificationsubcategory');
        }
      }
      return view('application.master.addQualificationsubcat',$this->viewVars);
    }

 
}

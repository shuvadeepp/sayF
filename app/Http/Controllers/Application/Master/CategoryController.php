<?php

/* * ******************************************
  File Name     : CategoryController.php
  Description   : Controller file for managing all the master modules
  Created By    : Sandeep Kumar Senapati
  Created On    : 05-Apr-2021

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
use App\Models\CategoryModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;

class CategoryController extends AppController {
  public function index(){
      if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          CategoryModel::whereIn('categoryId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          CategoryModel::whereIn('categoryId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          CategoryModel::whereIn('categoryId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery=CategoryModel::where([['deletedflag',0]]);
    
    if($isViewAll==2){
        $arrResQuery=$arrResQuery->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
      } 

    $this->viewVars['startrec']  = $isViewAll; 
    $this->viewVars['arrAllRecords'] = $arrResQuery;
    return view('application.master.viewCategory',$this->viewVars);
  }


  
  /*Function for add and edit category*/
  public function add($catId){
    $catId=($catId)?decrypt($catId):0;    
    $redirectUrl                         = ($catId)?'application/master/category/add/'.encrypt($catId):'application/master/category/add';
    $this->viewVars['buttonVal'] = ($catId > 0)?'Update Category':'Add Category';

    $CategoryModel = new CategoryModel();
    $this->viewVars['editCatDetail'] = '';
    if($catId>0){
      $editCatDetail = CategoryModel::find($catId)->toArray();
      $this->viewVars['editCatDetail'] = $editCatDetail;
    }
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $validator   = Validator::make($requestData, [
                  'txtCategory' => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:50'
                      ], 
                      ['txtCategory.required' => 'Category name should not left blank',
                        'txtCategory.regex'=>'Category name should be alphanumeric'
      ]);
      if ($validator->fails()) {
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        } else {
          /*Update Record*/
          if($catId > 0){

            $chkDup = CategoryModel::where([['categoryName', $requestData['txtCategory']],['categoryId','!=',$catId]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
            CategoryModel::where('categoryId', $catId)
                    ->update([
                        'categoryName' => $requestData['txtCategory'],
                        'updatedBy' => session('admin_session_data.userId')
                    ]);
              request()->session()->flash('success', 'Record updated successfully');
            }
          }
          /*Insert Record*/
          else{
            $chkDup = CategoryModel::where('categoryName', $requestData['txtCategory'])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
              $CategoryModel->categoryName = $requestData['txtCategory'];
              $CategoryModel->createdBy = session('admin_session_data.userId');
              $CategoryModel->save();
              request()->session()->flash('success', 'Record added successfully');
            }
            
          }          
          return redirect::to('application/master/category');
        }
    }

    return view('application.master.addCategory',$this->viewVars);
  }

 
}

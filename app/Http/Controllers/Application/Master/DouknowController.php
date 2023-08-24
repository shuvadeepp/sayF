<?php

/* * ******************************************
  File Name     : BoardController.php
  Description   : Controller file for managing  Board modules
  Created By    : Ananya Dash
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
use App\Models\DouknowModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;

class DouknowController  extends AppController {
  public function index(){

      if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }

      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          DouknowModel::whereIn('douknowId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          DouknowModel::whereIn('douknowId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          //print_R($IdsArr);exit;
          DouknowModel::whereIn('douknowId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery=DouknowModel::where([['deletedflag',0]]);
    
    if($isViewAll==2){
        $arrResQuery=$arrResQuery->orderBy('douknowId', 'desc')->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->orderBy('douknowId', 'desc')->paginate(TOTPAGINATE);
      } 

    $this->viewVars['startrec']  = $isViewAll; 
    $this->viewVars['arrAllRecords'] = $arrResQuery;
    return view('application.master.viewDouknow',$this->viewVars);
  }


  
  /*Function for add and edit category*/
  public function add($douknowId){
    $douknowId=($douknowId)?decrypt($douknowId):0;    
    $redirectUrl                         = ($douknowId)?'application/master/douknow/add/'.encrypt($douknowId):'application/master/douknow/add';
    $this->viewVars['buttonVal'] = ($douknowId > 0)?'Update Do u know':'Add Do u know';

    $DouknowModel = new DouknowModel();
    $this->viewVars['editCatDetail'] = '';
    if($douknowId>0){
      $editCatDetail = DouknowModel::find($douknowId)->toArray();
      $this->viewVars['editCatDetail'] = $editCatDetail;
    }
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  

       $regex       = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
      $validator   = Validator::make($requestData, [
                  'Description' => 'bail|required',
                  // 'twitterLink' => 'bail|regex:'.$regex.'|max:50',
                 //   'facebookLink' => 'bail|regex:'.$regex.'|max:50'
                      ], 
                      ['Description.required' => 'Content should not left blank',
                      
                        // 'twitterLink.required' => 'Twitter Link should not left blank',
                        //  'twitterLink.regex'         => 'Please enter a valid website URL',
                        // 'facebookLink.required' => 'Facebbok Link should not left blank',
                        //  'facebookLink.regex'         => 'Please enter a valid website URL',
      ]);
      if ($validator->fails()) {
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        } else {
          /*Update Record*/
          if($douknowId > 0){

            $chkDup = DouknowModel::where([['Description', $requestData['Description']],['douknowId','!=',$douknowId],['deletedflag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
            DouknowModel::where('douknowId', $douknowId)
                    ->update([
                      'twitterLink'=>$requestData['twitterLink'],
                      'facebookLink'=>$requestData['facebookLink'],
                        'Description' => $requestData['Description'],
                        'updatedBy' => session('admin_session_data.userId')
                    ]);
              request()->session()->flash('success', 'Record updated successfully');
            }
          }
          /*Insert Record*/
          else{
            $chkDup = DouknowModel::where([['Description', $requestData['Description']],['deletedflag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
              $DouknowModel->Description = $requestData['Description'];
                 $DouknowModel->twitterLink = $requestData['twitterLink'];
                    $DouknowModel->facebookLink = $requestData['facebookLink'];
              $DouknowModel->createdBy = session('admin_session_data.userId');
              $DouknowModel->save();
              request()->session()->flash('success', 'Record added successfully');
            }
            
          }          
          return redirect::to('application/master/douknow');
        }
    }

    return view('application.master.adddouknow',$this->viewVars);
  }

 
}

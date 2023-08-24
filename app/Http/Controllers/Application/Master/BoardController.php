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
use App\Models\BoardModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;

class BoardController extends AppController {
  public function index(){

      if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          BoardModel::whereIn('boardId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          BoardModel::whereIn('boardId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          BoardModel::whereIn('boardId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery=BoardModel::where([['deletedflag',0]]);
    
    if($isViewAll==2){
        $arrResQuery=$arrResQuery->orderBy('boardId', 'desc')->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->orderBy('boardId', 'desc')->paginate(TOTPAGINATE);
      } 

    $this->viewVars['startrec']  = $isViewAll; 
    $this->viewVars['arrAllRecords'] = $arrResQuery;
    return view('application.master.viewBoard',$this->viewVars);
  }


  
  /*Function for add and edit board*/
  public function add($boardId){
    $boardId=($boardId)?decrypt($boardId):0;    
    $redirectUrl                         = ($boardId)?'application/master/board/add/'.encrypt($boardId):'application/master/board/add';
    $this->viewVars['buttonVal'] = ($boardId > 0)?'Update Board':'Add Board';

    $BoardModel = new BoardModel();
    $this->viewVars['editCatDetail'] = '';
    if($boardId>0){
      $editCatDetail = BoardModel::find($boardId)->toArray();
      $this->viewVars['editCatDetail'] = $editCatDetail;
    }
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $validator   = Validator::make($requestData, [
                  'txtBoard' => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:50'
                      ], 
                      ['txtBoard.required' => 'Board name should not left blank',
                        'txtBoard.regex'=>'Board name should be alphanumeric'
      ]);
      if ($validator->fails()) {
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        } else {
          /*Update Record*/
          if($boardId > 0){

            $chkDup = BoardModel::where([['boardName', $requestData['txtBoard']],['boardId','!=',$boardId],['deletedflag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
            BoardModel::where('boardId', $boardId)
                    ->update([
                        'boardName' => $requestData['txtBoard'],
                        'updatedBy' => session('admin_session_data.userId')
                    ]);
              request()->session()->flash('success', 'Record updated successfully');
            }
          }
          /*Insert Record*/
          else{
            $chkDup = BoardModel::where([['boardName', $requestData['txtBoard']],['deletedflag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
              $BoardModel->boardName = $requestData['txtBoard'];
              $BoardModel->createdBy = session('admin_session_data.userId');
              $BoardModel->save();
              request()->session()->flash('success', 'Record added successfully');
            }
            
          }          
          return redirect::to('application/master/board');
        }
    }

    return view('application.master.addBoard',$this->viewVars);
  }

 
}

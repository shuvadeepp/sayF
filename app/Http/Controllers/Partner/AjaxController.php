<?php

/* * ******************************************
  File Name     : AjaxController.php
  Description   : Controller file for managing all the ajax requests of Website and partner  Created By    : Ananya Dash
  Created On    : 07-May-2021

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

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\AppController;
use Session;
use Illuminate\Http\Request;
use App\Models\ServiceModel;
use Validator;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Support\Facades\Response;

class AjaxController extends AppController {
    public function loadservices(){
   
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        $validator   = \Validator::make($requestData, [
                          'typedStr'            => 'bail|required|regex:/[A-Za-z0-9 ]/'
                        ]);
        if($validator->fails()) {
          $respArr    = array('status' => 500, 'msg' => $validator->errors());
          return response()->json($respArr);
        }else{
          $typedStr        = $requestData['typedStr'];
          $getservices       = \DB::table('m_service')
                                      ->select('serviceId','serviceName')
                                      ->where('serviceName', 'like', $typedStr . '%');
                                      
        //   if(!empty($selectedskill)){
        //     $getservices = $getservices->whereNotIn('serviceId', $selectedskill);
        //   }
          $getservices   = $getservices->where([['deletedflag',0],['publishStatus',0]])->get();
          $data        = collect($getservices)->map(function($x){ return (array) $x; })->toArray(); 

          //echo '<pre>';print_r($data);exit;     
          $respArr      = array('status' => 200, 'result' => $getservices);
          return response()->json($respArr);                       
        }
      }else{
        $respArr      = array('status' => 500, 'msg' => 'Sorry!! something went wrong');
        return response()->json($respArr);
      }
    }
    

    public function pushnewService(){
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        $validator   = \Validator::make($requestData, [
                          'newText'            => 'bail|required|regex:/[A-Za-z0-9 ]/'
                        ]);
        if($validator->fails()) {
          $respArr    = array('status' => 500, 'msg' => $validator->errors());
          return response()->json($respArr);
        }else{
          $newText        = $requestData['newText'];
          $chkDup         = \DB::table('m_service')->where('serviceName', '=', $newText)->count();
          //echo '<pre>';print_r($chkDup);exit;
          if(empty($chkDup)){
            $id = DB::table('m_service')-> insertGetId(array(
                    'serviceName'     => $newText,
                    'createdBy'     => session('partner_session_data.userId')
            ));
          }    
          $respArr      = array('status' => 200, 'resultid' => $id);
          return response()->json($respArr);                       
        }
      }else{
        $respArr      = array('status' => 500, 'msg' => 'Sorry!! something went wrong');
        return response()->json($respArr);
      }
    }
  
}
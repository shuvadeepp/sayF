<?php

/* * ******************************************
  File Name     : JobController.php
  Description   : Controller file for managing all job requests
  Created By    : Swagatika Sahoo
  Created On    : 14-Apr-2021

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

namespace App\Http\Controllers\Application;

use App\Http\Controllers\AppController;
use App\Models\JobModel;
use App\Models\JobSkillModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use DB;
use Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;


class ManageJobController extends AppController {

    public function postedjob(){
      $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        //echo "<pre>";print_r($requestData);exit;
        $srch_company_name = $requestData['srch_company_name'];
        $srch_post_date    = $requestData['srch_post_date'];
        $srch_job_location = $requestData['srch_job_location'];
        $srch_job_status   = $requestData['srch_job_status'];

        $this->viewVars['srch_company_name']  = $srch_company_name; 
        $this->viewVars['srch_post_date']  = $srch_post_date; 
        $this->viewVars['srch_job_location']  = $srch_job_location; 
        $this->viewVars['srch_job_status']  = $srch_job_status; 

        $arrResQuery = JobModel::select('*');
        if(!empty($srch_company_name)){
          $arrResQuery = $arrResQuery->whereHas('employer',
              function ($query) use ($srch_company_name) {
                  $query->where('employerCompany', 'LIKE', "%{$srch_company_name}%");
              }
          );
        }
        if(!empty($srch_post_date)){
          $post_date = date('Y-m-d',strtotime($srch_post_date));
          $arrResQuery = $arrResQuery->whereDate('createdOn', '=', $post_date);
        }

        if(!empty($srch_job_location)){
          $arrResQuery = $arrResQuery->whereHas('joblocations',
              function ($query) use ($srch_job_location) {
                  $query->where('locationId', '=', $srch_job_location);
              }
          );
        }



        if(!empty($srch_job_status)){

          if($srch_job_status == 'Active'){
            $arrResQuery = $arrResQuery->where('jobStartDate','<=',date("Y-m-d"));
            $arrResQuery = $arrResQuery->where('jobExpiryDate','>=',date("Y-m-d"));
            $arrResQuery = $arrResQuery->where('job_status',1);
          }else if($srch_job_status == 'Archived'){
            $arrResQuery = $arrResQuery->where('job_status',1);
            $arrResQuery = $arrResQuery->where('deletedFlag',1);
          }else if($srch_job_status == 'Expired'){
            $arrResQuery = $arrResQuery->where('jobExpiryDate','<',date("Y-m-d"));
            $arrResQuery = $arrResQuery->where('job_status',1);
          }else if($srch_job_status == 'Under Review'){
            $arrResQuery = $arrResQuery->where('job_status',0);
          }

      }

        $arrResQuery = $arrResQuery->with('employer','joblocations')->orderBy('createdOn','DESC');

        // $arrResQuery = JobModel::select('*')->whereHas('employer', function ($query) {
        //                     $query->where('employerCompany','=','CSM');
        //                 })
        //                 ->with('employer')
        //                 ->orderBy('createdOn','DESC')
        //                 ->get(); 

        //  echo "<pre>";print_r($arrResQuery[0]->employer->companyLogo);exit;   
      }else{
        $arrResQuery = JobModel::orderBy('createdOn','DESC');
      }

      if($isViewAll==2){
        $arrResQuery=$arrResQuery->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
      }       
      $this->viewVars['startrec']  = $isViewAll; 
      $this->viewVars['arrAllRecords'] = $arrResQuery; 

      // $location  = DB::table('m_location')
      //           ->select('locationId','location')
      //           ->where('deletedflag',0)
      //           ->orderBy('location','ASC')
      //           ->get();
                $location  = DB::table('m_location')
                ->select('stateId','state')
                ->where('deletedflag',0)
                ->orderBy('state','ASC')
                ->groupBy('stateId','state')
                ->get();

      $this->viewVars['location']         = $location;  
      return view('application.postedjob',$this->viewVars);      
    }

   /* public function job_approval(){
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        $validator   = \Validator::make($requestData, [
                          'jobId'  => 'bail|required|numeric',
                          'status' => 'bail|required|numeric'
                        ]);
        if($validator->fails()) {
          $respArr    = array('status' => 500, 'msg' => $validator->errors());
        }else{
          $jobId = $requestData['jobId'];
          $status = $requestData['status'];
          if(DB::table('t_job')->where('jobId', $jobId)->update(array('job_status' => $status))){
            $respArr    = array('status' => 200, 'msg' => 'Record updated successfully');
          }else{
            $respArr    = array('status' => 500, 'msg' => 'Something went wrong!Please try later.');
          }
        }
        return response()->json($respArr);
      }
    } */

}
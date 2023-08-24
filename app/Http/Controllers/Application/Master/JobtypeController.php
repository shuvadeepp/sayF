<?php
/********************************************
  File Name     : JobtypeController.php
  Description   : Controller file for managing all the Job Type 
  Created By    : Ananya Dash
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
 ********************************************/

namespace App\Http\Controllers\Application\Master;
use App\Http\Controllers\AppController;
use App\Models\JobTypeModel;
use DB;
use Validator;
use Redirect;

class JobtypeController extends AppController
{
    public function index($jobId = 0){
        if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          JobTypeModel::whereIn('jobtypeId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          JobTypeModel::whereIn('jobtypeId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){

        if(!empty($IdsArr)){
          JobTypeModel::whereIn('jobtypeId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
       $jobid = ($jobId) ? decrypt($jobId) : 0;
       if ($jobid > 0) {
           
            JobTypeModel::where('jobtypeId', $jobid)->update(['deletedflag' => 1, 'updatedBy' => session('admin_session_data.userId') ]);
            request()->session()->flash('success', 'Record deleted successfully');
        }
        $isViewAll = (request('hdn_IsViewAll') != '' || request('hdn_IsViewAll') > 0) ? request('hdn_IsViewAll') : 1;
        $arrResQuery = JobTypeModel::where([['deletedflag', 0]]);
        if ($isViewAll == 2){
            $arrResQuery = $arrResQuery->orderBy('jobtypeId', 'desc')->get();
        }elseif ($isViewAll == 1){
            $arrResQuery = $arrResQuery->orderBy('jobtypeId', 'desc')->paginate(TOTPAGINATE);
        }
        $this->viewVars['startrec'] = $isViewAll;
        $this->viewVars['arrAllRecords'] = $arrResQuery;
        return view('application.master.viewJobType', $this->viewVars);
    }

    public function add($jobid){
        $jobid = ($jobid) ? decrypt($jobid) : 0;
        $JobTypeModel = new JobTypeModel();
        $this->viewVars['editJobDetail'] = '';
          $this->viewVars['buttonVal'] = ($jobid > 0)?'Update Job Type':'Add Job Type';
        if ($jobid > 0) {
            $editJobDetail = JobTypeModel::find($jobid);
            $this->viewVars['editJobDetail'] = $editJobDetail;
        }if (!empty(request()->all()) && request()->isMethod('post')){
            $requestData = request()->all();
            $validator    = \Validator::make($requestData, [
                                  'txtJobtype' => 'bail|required|regex:/^[a-zA-Z0-9_\- \/, ]*$/|max:64'
                                  ],[
                                    'txtJobtype.required' =>'Job Type is required',
                                    'txtJobtype.regex'    =>'Job Type should be alphanumeric'
                                  ]);
            if ($validator->fails()) {
                return redirect('application/master/jobtype/add')->withErrors($validator)->withInput();
            }else{ 
                if ($jobid > 0) {

                    $chkDup = JobTypeModel::where([['jobtypeName', $requestData['txtJobtype']], ['jobtypeId', '!=', $jobid],['deletedflag', '=',0]])->first();
                    if ($chkDup){
                        request()->session()->flash('error', 'Duplicate record exist!!');
                    }else{

                        JobTypeModel::where('jobtypeId', $jobid)->update(['jobtypeName' => $requestData['txtJobtype'], 'updatedBy' => session('admin_session_data.userId') ]);
                        request()->session()->flash('success', 'Record updated successfully');

                    }
                }else{
                    $chkDup = JobTypeModel::where([['jobtypeName', $requestData['txtJobtype']],['deletedflag', '=',0]])->first();
                    if ($chkDup){
                        request()->session()
                            ->flash('error', 'Duplicate record exist!!');
                    } else{
                        $JobTypeModel->jobtypeName = $requestData['txtJobtype'];
                        $JobTypeModel->createdBy = session('admin_session_data.userId');
                        $JobTypeModel->save();
                        request()
                            ->session()
                            ->flash('success', 'Record added successfully!');
                    }
                }
                return redirect::to('application/master/jobtype');
            }
        }
        return view('application.master.addJobType', $this->viewVars);
    }
}


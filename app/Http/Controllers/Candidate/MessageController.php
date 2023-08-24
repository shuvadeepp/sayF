<?php

/* * ******************************************
  File Name     : MessageController.php
  Description   : Controller file for managing all the ajax requests of Website and employer and employee
  Created By    : Samir Kumar
  Created On    : 27-Apr-2021

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

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\AppController;
use App\Models\MessageModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use DB;
use Storage;

class MessageController extends AppController {
    public function index($receiver=''){
      $this->viewVars['receiver']         = ($receiver)?decrypt($receiver):0; 
      $candidateId                        = session('candidate_session_data.userId');
      $getMessageThread                   = MessageModel::select('*')
                                            //->where([['deletedFlag',0],['msgTo',$candidateId]])->get();
                                            ->where([['respOne',$candidateId]])
                                            ->orwhere([['respTwo',$candidateId]])
                                            ->where([['deletedFlag',0]])->orderBy('updatedOn','DESC')->get();
      //$getMessageThread                   = DB::SELECT("SELECT A.convHeadId, A.respOne, A.respTwo,B.msgText,B.msgFile,B.readStatus,B.msgFrom,B.createdOn,B.updatedOn,C.tinUserType,CASE WHEN(C.tinUserType = 2) THEN D.employerCompany ELSE CONCAT(E.firstName,' ',E.middleName,' ',E.lastName) END AS respName FROM t_msg_convo_head A LEFT JOIN t_msg_convo B ON (A.convHeadId = B.convoHead AND B.msgId = (SELECT msgId FROM t_msg_convo WHERE t_msg_convo.convoHead = A.convHeadId AND t_msg_convo.deletedFlag = 0 ORDER BY createdOn DESC LIMIT 1)) LEFT JOIN m_user_master C ON (C.userId = B.msgFrom) LEFT JOIN t_employer_profile D ON (D.employerId = B.msgFrom) LEFT JOIN t_candidate_details E ON (E.userId = B.msgFrom) WHERE (A.respOne = ".$candidateId." OR A.respTwo = ".$candidateId.") AND A.deletedFlag = 0"); 
                                //echo '<pre>';print_r($getMessageThread);exit;
      $this->viewVars['getMessageThread'] = $getMessageThread;                          
      return view('candidate.message',$this->viewVars);      
    }
}
<?php

/* * ******************************************
  File Name     : SavedjobController.php
  Description   : Controller file for managing all the ajax requests of Website and employer and employee
  Created By    : Ananya Dash
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

namespace App\Http\Controllers\Website;

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Mail;
use Session;
use DB;

class SavedjobController extends AppController {
  function index() {
    
  	 $data   = DB::table('t_job as A')
              ->select('A.jobId','A.jobTitle','A.jobLocation','A.jobVacancy','A.employmentTypeId','A.jobDescription','A.jobRoleResponsibilities','A.minExp','A.minSalary','A.maxSalary','A.industryId','A.qualificationId','A.companyDetails','A.createdOn','B.jobtypeName','C.industryName','D.qualification','E.employerCompany','E.companyLogo','H.liked','K.appliedJobId',
                    DB::raw('group_concat(distinct(G.skillName)) as skillName'),
                    DB::raw('group_concat(distinct(G.skillsId)) as skillsId'),
                     DB::raw('group_concat(distinct(J.state)) as location'),
                       DB::raw('group_concat(distinct(L.location)) as city')
                )
              ->leftjoin('m_jobtype AS B','A.employmentTypeId','=','B.jobtypeId','B.deletedflag','=',0)
              ->leftjoin('m_industrytype AS C','A.industryId','=','C.industryId','C.deletedflag','=',0)
              ->leftjoin('m_qualification AS D','A.qualificationId','=','D.qualificationId','D.deletedflag','=',0)
              ->leftjoin('t_employer_profile AS E','A.createdBy','=','E.employerId','D.deletedflag','=',0)
              ->leftjoin('t_jobskills AS F','F.jobId','=','A.jobId','F.deletedFlag','=',0)
              ->leftjoin('m_skills AS G','G.skillsId','=','F.skillId','G.deletedFlag','=',0)
              ->leftjoin('t_bookmarked AS H','H.jobId','=','A.jobId','H.candidateUserId','=','A.createdBy')
              ->leftjoin('t_job_location AS I','I.jobId','=','A.jobId','I.deletedFlag','=',0)
              ->leftjoin('m_location AS J','J.stateId','=','I.locationId','J.deletedFlag','=',0)
            ->leftjoin('m_location AS L','L.locationId','=','I.cityId','L.deletedFlag','=',0)
              ->leftjoin('t_applied_job AS K','K.jobId','=','A.jobId','K.candidateId','=','A.createdBy')
              ->groupBy('A.jobId','A.jobTitle','A.jobLocation','A.jobVacancy','A.employmentTypeId','A.jobDescription','A.jobRoleResponsibilities','A.minExp','A.minSalary','A.maxSalary','A.industryId','A.qualificationId','A.companyDetails','A.createdOn','B.jobtypeName','C.industryName','D.qualification','E.employerCompany','E.companyLogo','H.liked','K.appliedJobId')
              // ->where('A.deletedFlag', '=', '0')
              // ->where('H.deletedFlag', '=', '0')
              // ->where('H.liked', '=', '1');
             ->where([['A.deletedFlag',0],['H.deletedFlag',0],['H.liked',1]]);
             $data=$data->paginate(15);
         
     return view('website.savedjob', compact('data'));
  }
   
}
?>
<?php
/**
 * The JobModel use for job add,edit,view
 * Created On   : 13-Apr-2021
 * Note         : Do not modify code in this file without the consent of the author
 * 
 * ======================================================================
 * |Update History                                                      |
 * ======================================================================
 * |<Updated by>             |<Updated On> |<Remarks>                   |
 * ----------------------------------------------------------------------
 * |                         |             |      
 * ----------------------------------------------------------------------
 * 
 * ----------------------------------------------------------------------
 *  
 * @package JobModel
 * @author  Swagatika Sahoo
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class JobModel extends AppModel{
	protected $table      = 't_job';
	protected $primaryKey = 'jobId';


	public function employer()
    {
        return $this->hasOne(EmployerprofileModel::class,'employerId','createdBy');
    }
    public function jobskills()
    {
       
        return $this->hasMany(JobSkillModel::class,'jobId','jobId');
    }
    public function jobtype()
    {
        return $this->hasOne(JobTypeModel::class,'jobtypeId','employmentTypeId');
    }
    public function qualification()
    {
        return $this->hasOne(QualificationModel::class,'qualificationId','qualificationId');
    }
    public function joblocations()
    {
        return $this->hasMany(JobLocationModel::class,'jobId','jobId');
    }
    public function jobindustries()
    {
        return $this->hasMany(JobIndustriesModel::class,'jobId','jobId');
    }
    public function jobdisabilities()
    {
        return $this->hasMany(JobDisabilityModel::class,'jobId','jobId');
    }
    public function jobqualification()
    {
        return $this->hasMany(JobQualificationModel::class,'jobId','jobId');
    }
}
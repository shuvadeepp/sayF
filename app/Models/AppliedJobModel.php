<?php
/**
 * The AppliedJobModel use for manage applied job
 * Created On   : 18-Apr-2021
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
 * @package AppliedJobModel
 * @author  Swagatika Sahoo
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class AppliedJobModel extends AppModel{
	protected $table      = 't_applied_job';
	protected $primaryKey = 'appliedJobId';

	public function jobdetail()
    {
       
        return $this->hasOne(JobModel::class,'jobId','jobId');
    }

    public function candidatedetail()
    {
        return $this->hasOne(CandidateModel::class,'userId','candidateId');
    }

    public function candidateuser()
    {
        return $this->hasOne(AdminModel::class,'userId','candidateId');
    }

}
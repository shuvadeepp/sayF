<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class JobQualificationModel extends Model
{
    //
    protected $table      = 't_job_minEdu_Quealification';
	protected $primaryKey = 'educationQualificationId';

	public function jobminEduQual()
    {
        return $this->hasOne(QualificationModel::class,'qualificationId','qualificationType');
    }

}

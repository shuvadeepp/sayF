<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class JobDisabilityModel extends AppModel
{
    protected $table      = 't_job_disable';
	protected $primaryKey = 'jobDisableId';

	public function jobdisable()
    {
        return $this->hasOne(DisabilityModel::class,'disabilityId','disabilityType');
    }
}

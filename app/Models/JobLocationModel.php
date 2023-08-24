<?php
/**
 * The JobSkillModel use for job location add,edit,view
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
 * @package JobLocationModel
 * @author  Swagatika Sahoo
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class JobLocationModel extends AppModel{
	protected $table      = 't_job_location';
	protected $primaryKey = 'jobLocationId';

	public function location()
    {
        return $this->hasOne(LocationModel::class,'stateId','locationId');
    }
    public function city()
    {
    	//echo 111;exit;
        return $this->hasOne(LocationModel::class,'locationId','cityId');
    }
 
}
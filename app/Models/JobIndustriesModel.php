<?php
/**
 * The JobIndustriesModel use for job industries add,edit,view
 * Created On   : 21-Apr-2021
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
 * @package JobIndustriesModel
 * @author  Swagatika Sahoo
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class JobIndustriesModel extends AppModel{
	protected $table      = 't_job_industries';
	protected $primaryKey = 'jobIndustriesId';

	public function industry()
    {
        return $this->hasOne(IndustryModel::class,'industryId','industryId');
    }
}
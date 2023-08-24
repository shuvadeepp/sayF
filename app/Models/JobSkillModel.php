<?php
/**
 * The JobSkillModel use for job skills add,edit,view
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
 * @package JobSkillModel
 * @author  Swagatika Sahoo
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class JobSkillModel extends AppModel{
	protected $table      = 't_jobskills';
	protected $primaryKey = 'jobskillsId';

	public function skillname()
    {
        return $this->hasOne(SkillModel::class,'skillsId','skillId');
    }
}
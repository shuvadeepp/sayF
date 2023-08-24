<?php
/**
 * The base CandidateSkillModel file for geting Candidate Skill Details
 * Created On   : 28-Apr-2021
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
 * @package CandidateSkillModel
 * @author  Swaagtika Sahoo
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CandidateSkillModel extends AppModel
{
	protected $table      = 't_candidate_skill';
	protected $primaryKey = 'skillId';

	public function skilldetails()
    {
        return $this->hasOne(SkillModel::class,'skillsId','skillName');
    }
}
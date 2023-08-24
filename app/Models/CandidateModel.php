<?php
/**
 * The base AppModel file for other models to extend and use
 * Created On   : 05-Apr-2021
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
 * @package AdminModel
 * @author  CSM
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CandidateModel extends AppModel
{
	protected $table      = 't_candidate_details';
	protected $primaryKey = 'employeeId';

	public function candidateexp()
    {
        return $this->hasMany(CandidateExperienceModel::class,'userId','userId');
    }

    public function disabilitydocs()
    {
        return $this->hasMany(DisabledocModel::class,'candidateId','userId');
    }

    public function education()
    {
        return $this->hasMany(CandidateEducationModel::class,'userId','userId');
    }
    
    public function skill(){
        return $this->hasMany(CandidateSkillModel::class,'userId','userId');
    }

     
}
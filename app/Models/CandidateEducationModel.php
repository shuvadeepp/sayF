<?php
/**
 * The base CandidateEducationModel file for geting Candidate Education Details
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
 * @package CandidateEducationModel
 * @author  Swaagtika Sahoo
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CandidateEducationModel extends AppModel
{
	protected $table      = 't_candidate_education';
	protected $primaryKey = 'educationId';

	public function educationytpe()
    {
        return $this->hasOne(EducationModel::class,'educationId','class');
    }

    public function boarddetails()
    {
        return $this->hasOne(BoardModel::class,'boardId','board');
    }
}
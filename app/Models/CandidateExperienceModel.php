<?php
/**
 * The base CandidateExperienceModel file for other models to extend and use
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
 * @package CandidateExperienceModel
 * @author  CSM
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CandidateExperienceModel extends AppModel
{
	protected $table      = 't_candidate_experience';
	protected $primaryKey = 'experienceId';
}
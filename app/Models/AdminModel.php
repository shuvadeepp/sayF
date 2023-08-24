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

class AdminModel extends AppModel
{
	protected $table      = 'm_user_master';
	protected $primaryKey = 'userId';


	public function candidate()
    {
        return $this->hasOne(CandidateModel::class,'userId','userId');
    }
    public function document()
    {
        return $this->hasMany(DisabledocModel::class,'candidateId','userId');
    }
    public function employer()
    {
        return $this->hasOne(EmployerprofileModel::class,'employerId','userId');
    }
    public function partner()
    {
        return $this->hasOne(PartnerprofileModel::class,'partnerId','userId');
    }
}



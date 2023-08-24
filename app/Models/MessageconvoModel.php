<?php
/**
 * The JobSkillModel use for job skills add,edit,view
 * Created On   : 27-Apr-2021
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
 * @author  Samir Kumar
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class MessageconvoModel extends AppModel{
	protected $table      = 't_msg_convo';
	protected $primaryKey = 'msgId';

	public function senderdtls()
    {
        return $this->hasOne(AdminModel::class,'userId','msgFrom');
    }


    public function receiverdtls()
    {
        return $this->hasOne(AdminModel::class,'userId','msgTo');
    }
}
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

class MessageModel extends AppModel{
	protected $table      = 't_msg_convo_head';
	protected $primaryKey = 'convHeadId';


	public function msgconv()
    {
        return $this->hasMany(MessageconvoModel::class,'convoHead','convHeadId');
    }

    public function sender()
    {
        return $this->hasOne(AdminModel::class,'userId','respOne');
    }

    public function receiver()
    {
        return $this->hasOne(AdminModel::class,'userId','respTwo');
    }
}
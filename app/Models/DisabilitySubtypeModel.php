<?php
/**
 * The DisabilityModel use for disability sub type add,edit,view
 * Created On   : 03-May-2021
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
 * @package DisabilitySubtypeModel
 * @author  Swagatika Sahoo
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class DisabilitySubtypeModel extends AppModel
{
	protected $table      = 'm_disabilitysubtype';
	protected $primaryKey = 'disabilitySubtypeId';

	public function disabilitydetails()
    {
        return $this->hasOne(DisabilityModel::class,'disabilityId','disabilityId');
    }
}
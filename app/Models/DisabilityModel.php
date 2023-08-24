<?php
/**
 * The DisabilityModel use for disability type add,edit,view
 * Created On   : 07-Apr-2021
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
 * @package DisabilityModel
 * @author  Sandeep Kumar Senapati
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class DisabilityModel extends AppModel
{
	protected $table      = 'm_disabilitytype';
	protected $primaryKey = 'disabilityId';
}
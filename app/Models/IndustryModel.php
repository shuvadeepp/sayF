<?php
/**
 * The DisabilityModel use for industry type type add,edit,view
 * Created On   : 09-Apr-2021
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
 * @package IndustryModel
 * @author  Sandeep Kumar Senapati
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class IndustryModel extends AppModel
{
	protected $table      = 'm_industrytype';
	protected $primaryKey = 'industryId';
}
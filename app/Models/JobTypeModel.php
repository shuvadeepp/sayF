<?php
/**
 * The CategoryModel use for catagory add,edit,view
 * Created On   : 06-Apr-2021
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
 * @package CategoryModel
 * @author  Sandeep Kumar Senapati
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class JobTypeModel extends AppModel
{
	protected $table      = 'm_jobtype';
	protected $primaryKey = 'jobtypeId';
}
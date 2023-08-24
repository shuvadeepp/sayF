<?php
/**
 * The BoardModel use for catagory add,edit,view
 * Created On   : 12-Apr-2021
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
 * @author  Ananya Dash
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class BoardModel extends AppModel
{
	protected $table      = 'm_board';
	protected $primaryKey = 'boardId';
}
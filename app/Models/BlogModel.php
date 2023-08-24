<?php
/**
 * The BlogModel use for blog add,edit,view
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
 * @package BlogModel
 * @author  Sandeep Kumar Senapati
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class BlogModel extends AppModel
{
	protected $table      = 'm_blog';
	protected $primaryKey = 'blogId';
}
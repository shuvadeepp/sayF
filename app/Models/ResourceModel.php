<?php
/**
 * The ResourceModel use for Resource add,edit,view
 * Created On   : 11-Apr-2023
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
 * @package BannerModel
 * @author  Sandeep Kumar Senapati
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ResourceModel extends AppModel
{
	protected $table      = 'm_resource';
	protected $primaryKey = 'resourceId';
}
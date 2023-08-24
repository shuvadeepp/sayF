<?php
/**
 * The BookmarkedModel use for catagory add,edit,view
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
 * @package CategoryModel
 * @author  Ananya Dash
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class PartnerDetailsCounterModel extends AppModel
{
	protected $table      = 't_partner_details_counter';
	protected $primaryKey = 'detailsPartnerCounterId';
}
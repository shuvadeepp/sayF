<?php
/**
 * The PartnerprofileModel use for partner add,edit,view
 * Created On   : 05-May-2021
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
 * @package PartnerprofileModel
 * @author  Sandeep Kumar Senapati
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class PartnerprofileModel extends AppModel{
	protected $table      = 't_partner_profile';
	protected $primaryKey = 'profileId';
}
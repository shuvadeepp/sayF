<?php
/**
 * The CountryModel use for manage Country
 * Created On   : 23-JUN-2021
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
 * @package CountryModel
 * @author  Swagatika
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CountryModel extends AppModel
{
	protected $table      = 'm_country';
	protected $primaryKey = 'countryId';
}
<?php
/**
 * The PressReleaseModel use for PressRelease add,edit,view
 * Created On   : 13-Apr-2023
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
 * @package PressReleaseModel
 * @author  Sangita Pratap
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class PressReleaseModel extends AppModel
{
	protected $table      = 'm_pressrelease';
	protected $primaryKey = 'preleaseId';
}
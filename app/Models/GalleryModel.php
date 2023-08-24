<?php
/**
 * The BlogModel use for manage gallary
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
 * @package GalleryModel
 * @author  Swagatika
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class GalleryModel extends AppModel
{
	protected $table      = 'm_gallery';
	protected $primaryKey = 'galleryId';
}
<?php
/**
 * The TestimonialModel use for Testimonial add,edit,view
 * Created On   : 14-Apr-2023
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
 * @package TestimonialModel
 * @author  Shuvadeep Podder
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class TestimonialModel extends AppModel
{
	protected $table      = 'm_testimonial_One';
	protected $primaryKey = 'testimonial_id';
}
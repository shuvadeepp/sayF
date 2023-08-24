<?php

/**
 * The RegistrationController file for frontend portal pages
 * Created On   : 07-Mar-2018
 * 
 * ======================================================================
 * |Update History                                                      |
 * ======================================================================
 * |<Updated by>            |<Updated On> |<Remarks>                    |
 * ----------------------------------------------------------------------
 * |Ravindra Ravidas       |07-Mar-2018  |Captcha File       
 * ----------------------------------------------------------------------
 * |         |             |                  
 * ----------------------------------------------------------------------
 * 
 * @package CaptchaController
 * @author  Ravindra Ravidas
 */

namespace App\Http\Controllers;

use App\Http\Controllers\AppController;
use App\Captcha\Securimage;

class CaptchaController extends AppController {

    public function index() {
        $img = new Securimage();
        $img->num_lines = 0;
        if (!empty($_GET['namespace']))
            $img->setNamespace($_GET['namespace']);


        return $img->show();
    }

}

?>

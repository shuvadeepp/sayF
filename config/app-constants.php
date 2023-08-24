<?php
/* ================================================
  File Name         	  : app-constants.php
  Description		      : This is use to define constants.
  Designed By		      : Samir Kumar
  Designed On		      : Samir Kumar
  Devloped By		      : Samir Kumar
  Devloped On		      : 01-Apr-2021
  Update History		  :	<Updated by>		<Updated On>		<Remarks>

  ================================================== */
$url = env('APP_URL');
echo APP_URL
define('PUBLIC_PATH', $url.'/public/');
define('ROOT_URL', $url);
define('APP_URL', $url.'/application/');
define('CANDID_URL', $url.'/candidate/');
define('EMPLR_URL', $url.'/employer/');
define('STORAGE_PATH', $url.'/storage/app/uploads/');
define('ENVIRONMENT', env('APP_ENV'));
define ("SENDSMS", 1);
define ("SENDEMAIL", 1);
/*******************Basic Authentication : Credentials*************/
define('BASE_AUTH_TOKEN','');
define('AUTH_USER','');
define('AUTH_PASS','');
define('TOTPAGINATE',10);
$experienceType = array('1'=>"1 Year","2"=>"2 Year","3"=>"3 Year","4"=>"4 Year","5"=>"5 Year","6"=>"6 Year");
define("EXPERIENCE_TYPE",json_encode($experienceType));
$educationType = array("1"=>"Board","2"=>"University");
define("EDUCATION_TYPE",json_encode($educationType));
$genderType = array("1"=>"Male","2"=>"Female","3"=>"I prefer not to disclose");
define("GENDER_TYPE",json_encode($genderType));
$scoreType = array("1"=>"Percentage","2"=>"CGPA","3"=>"SGPA","4"=>"Grade","5"=>"Other");
define("SCORE_TYPE",json_encode($scoreType));
$mediumType = array("1"=>"English","2"=>"Hindi","3"=>"Regional Language");
define("MEDIUM_TYPE",json_encode($mediumType));
define("SMS_API_URL",'');
define("SMS_API_USERNAME",'');
define("SMS_API_PASSWORD",'');
define("SMS_API_SENDER_ID",'');
// define("SAY_FND_EMAIL",'contact@thesayfoundation.com');
define("SAY_FND_EMAIL",'developmentsayfoundation@gmail.com');

/* define("APPROVAL_ADMIN",'contactus@thesayfoundation.com');
define("APPROVAL_ADMIN_CC",'swati@thesayfoundation.com'); */

define("APPROVAL_ADMIN",'shuvadeep.podder@csm.tech');
define("APPROVAL_ADMIN_CC",'shuvadeep.podder@csm.tech');

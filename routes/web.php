<?php
/* ================================================  File Name         	  : web.php
  Description		      : This is use to route through different URL(s).
  Designed By		      : Samir Kumar
  Designed On		      : Samir Kumar
  Devloped By		      : Samir Kumar
  Devloped On		      : 01-Apr-2021
  Update History		  :	<Updated by>		<Updated On>		<Remarks>

  ================================================== */
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*************header params goes here*******************************/
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, X-Auth-Token, 'X-CSRF-TOKEN'");
header("Cache-Control: max-age=2592000");
header('X-Frame-Options: DENY');
header('Cache-Control','Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Pragma','no-cache');
header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
header('X-Powered-By: JOBPORTAL'); 

$domains = array("localhost", "192.168.103.209","192.168.103.93","192.168.43.155");
$domains = array("localhost", "192.168.103.209", "192.168.103.188", "192.168.102.176");
// if (!in_array($_SERVER['SERVER_NAME'], $domains)) {
// 	if(env('APP_ENV') == 'live'){
// 		return response()->view('errors.'.'404');
// 	}else{
// 		die('Illegal Access');
// 	}
// }

// $data['start_date'] = '2021-07-02 20:00';
// $data['messsage'] = 'test message';

// \Mail::send('mailer.say_foundation_email_template', $data, function($message) use($data)
//     {
//         $message->from(SAY_FND_EMAIL, 'SAY FOUNDATION');
//         //$message->to($maildata['receiverMail'], '')->subject($maildata['subject']);
//         $filename = "invite.ics";
//         $meeting_duration = (3600 * 1); // 2 hours 
//         $meetingstamp       = strtotime( $data['start_date']);
//         $dtstart = gmdate('Ymd\THis\Z', $meetingstamp);
//         $dtend =  gmdate('Ymd\THis\Z', $meetingstamp + $meeting_duration);
//         $todaystamp = gmdate('Ymd\THis\Z');

//         $uid = date('Ymd').'T'.date('His').'-'.rand().'@thesayfoundation.com';
//         $description = 'Demo description';
//         $location = "India";
//         $titulo_invite = "Your meeting title";
//         $organizer = "CN=The Say Foundation:samir.muduli@csm.co.in";
        
//         // ICS
//         $mail[0] = "BEGIN:VCALENDAR";
//         $mail[1] = "TZID:Asia/Kolkata";
//         $mail[2] = "TZNAME:IST";
//        // $mail[3] = "TZOFFSETFROM:+0530";
//        // $mail[4] = "TZOFFSETTO:+0530";
//         $mail[5] = "PRODID:-//Google Inc//Google Calendar 70.9054//EN";
//         $mail[6] = "VERSION:2.0";
//         $mail[7] = "CALSCALE:GREGORIAN";
//         $mail[8] = "METHOD:REQUEST";
//         $mail[9] = "BEGIN:VEVENT";

//         //$mail[6] = "DTSTART;TZID=Asia/Kolkata:" . $dtstart;
//         //$mail[7] = "DTEND;TZID=Asia/Kolkata:" . $dtend;

//         //$mail[10]  = "DTSTART:" . $dtstart;
//         //$mail[11]  = "DTEND:" . $dtend;
//         $mail[10]  = "DTSTART:".$dtstart;
//         $mail[11]  = "DTEND:".$dtend;
//         $mail[12]  = "DTSTAMP:" . $todaystamp;
//         $mail[13]  = "UID:" . $uid;
//         $mail[14] = "ORGANIZER;" . $organizer;
//         $mail[15] = "CREATED:" . $todaystamp;
//         $mail[16] = "DESCRIPTION:" . $description;
//         $mail[17] = "LAST-MODIFIED:" . $todaystamp;
//         $mail[18] = "LOCATION:" . $location;
//         $mail[19] = "SEQUENCE:0";
//         $mail[20] = "STATUS:CONFIRMED";
//         $mail[21] = "SUMMARY:" . $titulo_invite;
//         $mail[22] = "TRANSP:OPAQUE";
//         $mail[23] = "END:VEVENT";
//         $mail[24] = "END:VCALENDAR";
        
//         $mail = implode("\r\n", $mail);
//         header("text/calendar");
//         file_put_contents($filename, $mail);
        
//         $message->subject('dummy calendar subject');
//         $message->to('sahoo.swagatika99@gmail.com');
//         $message->attach($filename, array('mime' => "text/calendar"));
//     });

// exit;

Route::get('/mailchk', function () {
    return view('mailer.say_foundation_email_template');
});


/************Static page list************** */
//Route::match(['get', 'post'], '/new-home', 'Website\PageController@newhome');
/************************** */


Route::match(['get', 'post'], '/home-voice', 'Website\PageController@index');

/****************************home route****************************/
Route::get('/candidate/success', function () {
    return view('candidate.profile.successPage');
});


Route::get('/mailtemp', function () {
    return view('mailer.say_foundation_email_template');
});

Route::get('/employeeRegister', function () {
    return view('website.employeeRegister');
});
Route::get('/employerRegister', function () {
    return view('website.employerRegister');
}); 

Route::get('/account', function () {
    return view('candidate.account');
});
Route::get('/message', function () {
    return view('candidate.message');
});

Route::get('/candidateProfile', function () {
    return view('candidate.candidateProfile');
});

Route::get('/postJobs', function () {
    return view('candidate.postJobs');
});
Route::get('/jobStatus', function () {
    return view('candidate.jobStatus');
});
Route::get('/exploreJob', function () {
    return view('website.exploreJob');
});
Route::get('/partnership', function () {
    return view('website.partnership');
});
// Route::get('/pressrelease', function () {
//     return view('website.pressrelease');
// });
// Route::get('/resource', function () {
//     return view('website.resource');
// });
// Route::get('/donate', function () {
//     return view('website.donate');
// });
// Route::get('/volunteer', function () {
//     return view('website.volunteer');
// });
// Route::get('/user-login', function () {
//     return view('website.user-login');
// });
// Route::get('/pressrelease-list', function () {
//     return view('website.pressrelease-list');
// });

Route::match(['get', 'post'], '/pressrelease/{alias?}', function ($alias,$action='pressreleaseinner') {
    $app = app();
    $controller = $app->make("\App\Http\Controllers\Website\PressReleaseController");
    $arrParms = [ "alias" => $alias];
    return $controller->callAction($action, $arrParms);
});



Route::match(['get', 'post'], '/candidateCv/{params}', 'Website\CandidateCvController@index')->where('params', '[A-Za-z0-9-_ =]+');
Route::match(['get', 'post'], '/downloadCv/{params}', 'Website\CandidateCvController@downloadCv')->where('params', '[A-Za-z0-9-_ =]+');

Route::match(['get', 'post'], '/LetsSay-OurBlogs', 'Website\BlogController@index');
Route::match(['get', 'post'], '/LetsSay-OurBlogs/{alias?}', function ($alias,$action='bloginner') {
    $app = app();
    $controller = $app->make("\App\Http\Controllers\Website\BlogController");
    $arrParms = [ "alias" => $alias];
    return $controller->callAction($action, $arrParms);
});

Route::match(['get', 'post'], '/ngo/details/{paramId?}', function ($paramId,$action='details') {
    $app = app();
    $controller = $app->make("\App\Http\Controllers\Website\PartnerController");
    $arrParms = [ "paramId" => $paramId];
    return $controller->callAction($action, $arrParms);
});

// Route::match(['get', 'post'], '/jobsearch', 'Website\JobsearchController@index');
/**************************for admin login************************/
Route::match(['get', 'post'], '/jobsearch', 'Website\JobsearchController@index');
Route::match(['get', 'post'], '/savedjob', 'Website\SavedjobController@index')->middleware(['candidateauth', 'nocache'])->where('params', '[A-Za-z0-9-_ =]+');
Route::match(['get', 'post'], '/jobdetails/{jobtitle}/{action}', 'Website\JobsearchController@jobdetails');
Route::match(['get', 'post'], '/ngo', 'Website\PartnerController@index');

Route::match(['get', 'post'], '/application', 'Application\LoginController@index');

Route::match(['get', 'post'], '/application/logout', 'Application\LoginController@logout');

Route::match(['get', 'post'], '/employer/employerprofile/{action}', 'Employer\EmployerprofileController@index');

Route::match(['get', 'post'], '/profileapproval/{action}', 'Website\ProfileApprovalController@index');

/**************************for employer login*********************/
Route::match(['get', 'post'], '/employer/register', 'Employer\LoginController@register');
Route::match(['get', 'post'], '/employer/login', 'Employer\LoginController@index');
Route::match(['get', 'post'], '/employer/logout', 'Employer\LoginController@logout');
Route::match(['get', 'post'], '/employer/forgetpassword', 'Employer\LoginController@forgetpassword');
Route::match(['get', 'post'], '/employer/resetpassword/{action}', 'Employer\LoginController@resetpassword');
Route::match(['get', 'post'], '/employer/changepassword', 'Employer\LoginController@changepassword')->middleware(['employerauth', 'nocache'])->where('params', '[A-Za-z0-9-_ =]+');
Route::match(['get', 'post'], '/employer/verifyOtp/{action}', 'Employer\LoginController@verifyOtp');



/**************************for candidate Registration*********************/
Route::match(['get', 'post'], '/candidate/register', 'Candidate\LoginController@register');
Route::match(['get', 'post'], '/candidate/login', 'Candidate\LoginController@index');
Route::match(['get', 'post'], '/candidate/logout', 'Candidate\LoginController@logout');
Route::match(['get', 'post'], '/candidate/forgetpassword', 'Candidate\LoginController@forgetpassword');
Route::match(['get', 'post'], '/candidate/resetpassword/{action}', 'Candidate\LoginController@resetpassword');
Route::match(['get', 'post'], '/candidate/changepassword', 'Candidate\LoginController@changepassword')->middleware(['candidateauth', 'nocache'])->where('params', '[A-Za-z0-9-_ =]+');
Route::match(['get', 'post'], '/candidate/verifyOtp/{action}', 'Candidate\LoginController@verifyOtp');

/**************************for Partner Registration*********************/
Route::match(['get', 'post'], '/ngo/register', 'Partner\LoginController@register');
Route::match(['get', 'post'], '/ngo/login', 'Partner\LoginController@index');
Route::match(['get', 'post'], '/ngo/verifyOtp/{action}', 'Partner\LoginController@verifyOtp');
Route::match(['get', 'post'], '/ngo/logout', 'Partner\LoginController@logout');
Route::match(['get', 'post'], '/ngo/changepassword', 'Partner\LoginController@changepassword')->middleware(['partnerauth', 'nocache'])->where('params', '[A-Za-z0-9-_ =]+');
Route::match(['get', 'post'], '/ngo/forgetpassword', 'Partner\LoginController@forgetpassword');
Route::match(['get', 'post'], '/ngo/resetpassword/{action}', 'Partner\LoginController@resetpassword');

/***********************captcha***********************************/
Route::get('/captcha', 'CaptchaController@index');


/************************for website ajax request****************/
Route::match(['get', 'post'], '/website/ajax/{action}', function ($action) {
    $app = app();
    $controller = $app->make("\App\Http\Controllers\Website\AjaxController");
    return $controller->callAction($action, []);
})->middleware(['cors']);


/******************for admin master application**************************/
Route::match(['get', 'post'], '/application/master/{controller}/{action?}/{params?}', function ($controller, $action = 'index', $params = '') {
    $params = explode('/', $params);
    $app = app();
    $controller = $app->make("\App\Http\Controllers\Application\Master\\" . ucwords($controller) . 'Controller');
    return $controller->callAction($action, $params);
})->middleware(['adminauth', 'nocache'])->where('params', '[A-Za-z0-9-_ =]+');
//});

/******************for admin application**************************/
Route::match(['get', 'post'], '/application/{controller}/{action?}/{params?}', function ($controller, $action = 'index', $params = '') {
    $params = explode('/', $params);
    $app = app();
    $controller = $app->make("\App\Http\Controllers\Application\\" . ucwords($controller) . 'Controller');
    return $controller->callAction($action, $params);
})->middleware(['adminauth', 'nocache'])->where('params', '[A-Za-z0-9-_ =]+');
//});

/****************************for employer*************************/
Route::match(['get', 'post'], '/employer/{controller}/{action?}/{params?}', function ($controller, $action = 'index', $params = '') {
    $params = explode('/', $params);
    $app = app();
    $controller = $app->make("\App\Http\Controllers\Employer\\" . ucwords($controller) . 'Controller');
    return $controller->callAction($action, $params);
})->middleware(['employerauth', 'nocache'])->where('params', '[A-Za-z0-9-_ =]+');
//});


/****************************for candidate*************************/
Route::match(['get', 'post'], '/candidate/{controller}/{action?}/{params?}', function ($controller, $action = 'index', $params = '') {
    $params = explode('/', $params);
    $app = app();
    $controller = $app->make("\App\Http\Controllers\Candidate\\" . ucwords($controller) . 'Controller');
    return $controller->callAction($action, $params);
})->middleware(['candidateauth', 'nocache'])->where('params', '[A-Za-z0-9-_ =]+');

Route::match(['get', 'post'], '/application/importjobCandidate', 'Application\ManageJobController@importjobCandidate');

/****************************for ngo*************************/
Route::match(['get', 'post'], '/ngo/{controller}/{action?}/{params?}', function ($controller, $action = 'index', $params = '') {
    $params = explode('/', $params);
    $app = app();
    $controller = $app->make("\App\Http\Controllers\Partner\\" . ucwords($controller) . 'Controller');
    return $controller->callAction($action, $params);
})->middleware(['partnerauth', 'nocache'])->where('params', '[A-Za-z0-9-_ =]+');
//});

/****************************For Social Login/Register*************************/
Route::match(['get', 'post'], '/sociallogin/{controller}/{action?}/{params?}', function ($controller, $action = 'index', $params = '') {
    $params = explode('/', $params);
    $app = app();
    $controller = $app->make("\App\Http\Controllers\Sociallogin\\" . ucwords($controller) . 'Controller');
    return $controller->callAction($action, $params);
});



/*****************************for website CMS*************************/
Route::match(['get','post'],'/{page?}/{subpage?}/{action?}', function ($page='', $subpage='', $action='index') {
    //print_r($page);exit;
    //$params = explode('/', $params);
    $app = app();
    $controller = $app->make("\App\Http\Controllers\Website\\PageController" );
    $arrParms = [ "page" => $page, 'subpage' => $subpage, 'action' => $action];

    return $controller->callAction($action, $arrParms);
})->where('subpage', '[A-Za-z0-9-_]+');

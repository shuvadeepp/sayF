<?php

/* * ******************************************
  File Name    : common.php
  Description    : File for common functions
  Created By    : Sandeep Kumar Senapati
  Created On    : 06-Apr-2021
 * ****************************************** */
//To get The Paginate Result Created By:Sandeep Kumar Senapati
use Illuminate\Support\Facades\Mail;

use App\Models\NotificationModel;
use App\Models\CountryModel;


function paginataion($result,$currentPg)
  {                 
   if (count($result)> 0) {  
                    if($currentPg==2)
                    {
                       $currentPg = $currentPg+1;
                        echo "<div style='float:left;'>".'Showing 1 to '. count($result) . ' of ' . count($result) . ' records '."</div>";
                        echo "<div  style='float:left;'>".' / <a href="javascript:void(0)" onClick="viewall(1);">Show Paginated</a>'."</div>";
                    }
                    else
                    {
                    $currentPg= ($result->currentPage()*TOTPAGINATE)-9;
                    if(count($result)==$result->total()){
                        $rangeCt = ($currentPg+count($result)-1);
                                           
                          echo "<div style='float:left;'>".'Showing '  .$currentPg. ' to '. $rangeCt . ' of ' . $result->total() . ' records '."</div>";
                    }  
                    else
                    {

                      $rangeCt = ($currentPg+count($result)-1);                           
                          echo "<div class='d-flex justify-content-end ml-4 mt-5 mb-4 noPrint' style='float:left;'><div >".'Showing '  .$currentPg. ' to '. $rangeCt . ' of ' . $result->total() . ' records '."</div>";
                          echo "<div >".' / <a href="javascript:void(0)" onClick="viewall(2);">Show All</a>'."</div></div>";
                          echo "<div class='pagination d-flex justify-content-end mr-4 mt-5 mb-4'>" .$result->appends(request()->except('page'))->links()."</div>";   
                        }
                     }  
                 }
                             
    }  


  function time_elapsed_string($ptime)
  {
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}

function indianCurrency($num)
{
    // if(setlocale(LC_MONETARY, 'en_IN'))
    //   return money_format('%.0n', $num);
    // else {
      $explrestunits = "" ;
      if(strlen($num)>3){
          $lastthree = substr($num, strlen($num)-3, strlen($num));
          $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
          $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
          $expunit = str_split($restunits, 2);
          for($i=0; $i<sizeof($expunit); $i++){
              // creates each of the 2's group and adds a comma to the end
              if($i==0)
              {
                  $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
              }else{
                  $explrestunits .= $expunit[$i].",";
              }
          }
          $thecash = $explrestunits.$lastthree;
      } else {
          $thecash = $num;
      }
      return $thecash;
    //}
}

function wardWrap($ward, $minNum) {
    $returnWard = $ward;
    if (strlen($ward) > $minNum) {
        $remainText = substr($ward, 0, $minNum);
        $string = $remainText;
        $string = explode(' ', $string);
        array_pop($string);
        $string = implode(' ', $string);

        $returnWard = $string . ' ...';
    }

    return $returnWard;
}

function calcTotalExp($workDetls){

    if($workDetls){
        $dayDiff=0;
        foreach($workDetls as $workDetl){            
            $startDate=date('Y-m-d',strtotime($workDetl->startYear));
            $endDate=($workDetl->endYear)?date('Y-m-d',strtotime($workDetl->endYear)):date('Y-m-d');
            
            $datediff = strtotime($startDate) - strtotime($endDate);
            $dayDifference= round($datediff / 86400);
            $dayDiff=$dayDiff+$dayDifference;
            
        }
        $years = floor($dayDiff / 365);
        $months = floor(($dayDiff - ($years * 365))/30.5);
        //$days = ($dayDiff - ($years * 365) - ($months * 30.5));
        $totExp= $years . " Year(s), " . $months . " Month(s) ";
    }
    return $totExp;
}




/*******************************send SMS ******************************************/
function sendSMS($mobile, $message,$template_id) {
    $url = SMS_API_URL."?user=skillod&password=Skill@2018&senderid=BA-BBSRME&channel=Trans&DCS=0&flashsms=0&number=" . urlencode($mobile) . "&text=" . urlencode($message) . "&route=1042";
        try {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($response) {
                $resAry = json_decode($response, true);
                if ($resAry['ErrorCode'] == '000')
                    return 1;
                else
                    return 0;
            } else
                return 0;
        } catch (Exception $e) {

            return 0;
        }
}



function sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo){

    $mailsendStatus = 1;
    if (!empty($attachment)) {
        $fileurl    = $attachment[0]->url;
        $as         = $attachment[0]->as;
        $mimeType   = $attachment[0]->mime;
    }

    if (!empty($sendTo) && !empty($mailContent)) {

        $maildata['messsage']   = $mailContent;
        $maildata['receiverMail'] = explode(',', $sendTo);
       
        $maildata['subject']    = $subject;

        $maildata['fileurl']    = (!empty($fileurl)) ? $fileurl : '';
        $maildata['as']         = (!empty($as)) ? $as : '';
        $maildata['mimeType']   = (!empty($mimeType)) ? $mimeType : '';

        if (!empty($ccAddress)){
          $maildata['ccAddress']  = explode(',', $ccAddress);
        }
        if (!empty($bccAddress)){
          $maildata['bccAddress'] = explode(',', $bccAddress);
        }

        $mail_template = 'say_foundation_email_template';

        \Mail::send('mailer.'.$mail_template, $maildata, function ($message) use($maildata) {
            $message->from(SAY_FND_EMAIL, 'SAY FOUNDATION');
            $message->to($maildata['receiverMail'], '')->subject($maildata['subject']);

            if (!empty($maildata['ccAddress']))
                $message->cc($maildata['ccAddress'], null);
            if (!empty($maildata['bccAddress']))
                $message->bcc($maildata['bccAddress'], null);

            if (!empty($maildata['fileurl'])) {

                $message->attach($maildata['fileurl'], [
                    'as'    => $maildata['as'],
                    'mime'  => $maildata['mimeType'],
                ]);
            }
        });
        // check for failures
        if (\Mail::failures()) {
            // return response showing failed emails
            $mailsendStatus = 0;
        }
    }

    return $mailsendStatus;
}

function sendMailWithGoogleCalender($data){

\Mail::send('mailer.say_foundation_email_template', $data, function($message) use($data)
    {
        $filename = "invite.ics";
        $meeting_duration = (3600 * 1); // 2 hours 
        $meetingstamp       = strtotime($data['start_date']);
        $dtstart = gmdate('Ymd\THis\Z', $meetingstamp);
        $dtend =  gmdate('Ymd\THis\Z', $meetingstamp + $meeting_duration);
        $todaystamp = gmdate('Ymd\THis\Z');

        $uid = date('Ymd').'T'.date('His').'-'.rand().'@thesayfoundation.com';
        $description = $data['description'];
        $location = $data['location'];
        $summary = $data['description'];
        $organizer = "CN=Samir:".SAY_FND_EMAIL;
        
        // ICS
        $mail[0] = "BEGIN:VCALENDAR";
        $mail[1] = "TZID:Asia/Kolkata";
        $mail[2] = "TZNAME:IST";
       // $mail[3] = "TZOFFSETFROM:+0530";
       // $mail[4] = "TZOFFSETTO:+0530";
        $mail[5] = "PRODID:-//Google Inc//Google Calendar 70.9054//EN";
        $mail[6] = "VERSION:2.0";
        $mail[7] = "CALSCALE:GREGORIAN";
        $mail[8] = "METHOD:REQUEST";
        $mail[9] = "BEGIN:VEVENT";

        //$mail[6] = "DTSTART;TZID=Asia/Kolkata:" . $dtstart;
        //$mail[7] = "DTEND;TZID=Asia/Kolkata:" . $dtend;

        //$mail[10]  = "DTSTART:" . $dtstart;
        //$mail[11]  = "DTEND:" . $dtend;
        $mail[10]  = "DTSTART:".$dtstart;
        $mail[11]  = "DTEND:".$dtend;
        $mail[12]  = "DTSTAMP:" . $todaystamp;
        $mail[13]  = "UID:" . $uid;
        $mail[14] = "ORGANIZER:" . $organizer;
        $mail[15] = "CREATED:" . $todaystamp;
        $mail[16] = "DESCRIPTION:" . $description;
        $mail[17] = "LAST-MODIFIED:" . $todaystamp;
        $mail[18] = "LOCATION:" . $location;
        $mail[19] = "SEQUENCE:0";
        $mail[20] = "STATUS:CONFIRMED";
        $mail[21] = "SUMMARY:" . $summary;
        $mail[22] = "TRANSP:OPAQUE";
        $mail[23] = "END:VEVENT";
        $mail[24] = "END:VCALENDAR";
        
        $mail = implode("\r\n", $mail);
        header("text/calendar");
        file_put_contents($filename, $mail);
        
        $message->subject($data['subject']);
        $message->to($data['sendTo']);
        $message->from(SAY_FND_EMAIL, 'SAY FOUNDATION');
        $message->attach($filename, array('mime' => "text/calendar"));
    });

}


function sendNotification($notificationDesc,$notificationType,$notificationFrom,$notificationTo,$notifycommonId=0){
    $NotificationModel=new NotificationModel();
    $NotificationModel->notificationDesc = $notificationDesc;
    $NotificationModel->notificationType = $notificationType;
    $NotificationModel->notificationFrom = $notificationFrom;
    $NotificationModel->notificationTo = $notificationTo;
    $NotificationModel->notifyCommonId = $notifycommonId;
    $NotificationModel->save();   
  }

function getCountryList(){
  $country =  CountryModel::where('deletedFlag',0)->get();
  return $country;
}
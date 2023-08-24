<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
<?php  
  
$candidateExp = json_decode(json_encode($candidateExp), TRUE);

/* foreach ($candidateEdu as $Edu) {
  echo $Edu->educationytpe->educationName;
  // ->educationytpe->educationName
}exit; */
// echo'<pre>';print_r($candidateEdu);exit;

$EduCount = 1;
$SkillCount = 1;
$disablityCount = 1;
$WorkExpCount = 1;
$htmlHead = '
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <style type="text/css" media="All">
  .heading {
    text-indent: 10px;
  }
  .pdfContainer .certName h3 {width: 35%}
  .pdfContainer .certName h3 {color:#0b4666; border:#0b4666 solid 2px; height:auto; padding:8px 30px; margin-bottom:20px; -webkit-border-radius:20px; -moz-border-radius:20px; border-radius:20px; display: inline-block;width:auto;}
  .mgn-20{margin:0px 10px 0px 20px;}
  .underline{border-bottom:#000 1px solid;}
  .outBorder{border: #0b4666 solid 8px;}
 
  .bdrBox{border: #0b4666 solid 8px; background-color:#fff; position:absolute;  height:20px; width:20px; display:inline-block;}
  .topLeft{top:-3px; left:-3px;}
  .topRight{top:-3px; right:-3px;}
  .btmLeft{bottom:-3px; left:-3px;}
  .btmRight{bottom:-3px; right:-3px;}
  .pdfContainer table tr td {padding: 5px;}
/*  .pdfContainer table td{font-family:Gotham-Book;font-size:13px;line-height:22px;}*/
  .pdfContainer .certName h3 {margin: 10px auto;width: auto;color: #0b4666;border: #0b4666 solid 2px;height: auto;padding: 8px 30px;-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;display: block;}
.planTable td{padding:3px!important;}
.planTable1 td{padding:3px!important;line-height:0;}
.list{margin:0px 0px 0px 15px; padding:0px;}
.list li{margin-bottom:8px;line-height:28px;}
.para{line-height:28px; padding:0px; margin:0px; text-align:justify;}
.container table tr td{padding: 5px;}
.table{padding:0px;line-height: 1.22857143;vertical-align: top;width: 100%;max-width: 100%;margin-bottom: 5px;border-collapse: collapse;}
.table-tab{margin-left:20px; margin-bottom: 2px; padding:3px;}
.golden{border-bottom:#d6ac31 2px solid; padding-top:50px;}
#adjHeight{height:100px;}
.pageBreak{page-break-after: always;}
table tr td{ text-align: left;}
.table th {
    background: #eaeaea;
}
#container .table-bordered, #container .table-bordered td, #container .table-bordered th {
    border-color: rgba(0, 0, 0, 0.23);
}
</style>
</head>'; 
$gender = ($candidateData[0]-> gender == 1) ? 'Male': 'Female';
$htmlBody = '<body>
<div id="page-content">

<div class="tab-base" style="margin-top:20px;">
<div class="tab-content">
<div class="tab-pane pad-btm fade active in" id="demo-bsc-tab-1">





<div id="toPrint" class="box-body table-responsive">
    <div id="divPrint" class="print-area"> 
        <div class="pdfContainer" style="height: auto;">
            <div class="outBorder2" style="border: #0b4666 solid 2px;">
                <div class="inBorder2" style="border: #0b4666 solid 1px;margin: 10px;">
                    <div style="padding: 15px 0px 15px 0px;">
                        <div style="text-align:center; padding: 5px 0px 0px 0px;">
                          
                          <img src=' . STORAGE_PATH . 'candidateProfile/' . $candidateData[0]->profileImage . ' border="0" align="right" height="110" width="120" style="padding: 0 41px 0px 0px; float:right;">
                         
                          <h2 style="margin: 15px 10px 0px 10px; font-size: 20px;text-transform:uppercase"> ' .   $candidateData[0]->fullName   . ' </h2>
                          <h3 style="text-transform:uppercase; margin-bottom:0; margin-top:10px;">' .   $candidateData[0]->emailId   . '</h3>
                          <h4 style="margin-top:5px;"> +91' .   $candidateData[0]->mobileNo   . ' </h4>
                          
                        </div>
						            <hr>
                        <h3 class="heading"> Personal Information:  </h3>
                        <table style="width:98%;margin:auto;">
                          <tr>
                            <td width="130"><strong>Address:  </strong></td>
							                  <td width="10" align="center">:</td>
                            <td> ' .   ($candidateData[0]->address ? $candidateData[0]->address: '--')  . ' </td>
                            <td width="150"><strong>City </strong></td>
							                  <td width="10" align="center">:</td>
                            <td> ' .   ($candidateData[0]->location ? $candidateData[0]->location: '--') . ' </td>
                          </tr>
                          <tr>
                            <td><strong>Primary Number </strong></td>
							                  <td align="center">:</td>
                            <td>' .  ($candidateData[0]->mobileNo ? $candidateData[0]->mobileNo: '--') . '</td>
                            <td><strong>Secondary Number </strong></td>
							                  <td align="center">:</td>
                            <td>' .  ($candidateData[0]->secondMob ? $candidateData[0]->secondMob: '--') . '</td>
                          </tr>
                        
                          <tr>
                            <td><strong>Gender </strong></td>
							                  <td align="center">:</td>
                            <td> ' . ($gender ? $gender: '--') . ' </td>
                          </tr>
                          <tr>
                            <td><strong>Date of Birth </strong></td>
							                  <td align="center">:</td>
                            <td> ' . (date('d M y', strtotime($candidateData[0]->DOB)) ? date('d M y', strtotime($candidateData[0]->DOB)): '--') . ' </td>
                          </tr>
                        </table>';
                        /* <== Work Experience Details ==> */
                      $htmlBody .='<hr> <h3 class="heading"> Work Experience Details:  </h3>';               
                      $htmlBody .='<table border="1" cellpadding="0" cellspacing="0" width="200px" style="width:98%;margin:auto;" >
                            <tr>
                              <th> Sl No. </th>
                              <th> Designation </th>
                              <th> Company Name  </th>
                              <th> Start Date </th>
                              <th> End Date </th>
                              <th> Current Job </th>
                            </tr>';
                            if(!empty($candidateExp)) {
                              foreach($candidateExp as $WorkExp){ 
                                // echo '<pre>';print_r($WorkExp);
                         $htmlBody .='<tr>
                                        <td style="text-align: center;"><b> ' . $WorkExpCount++ .' </b></td>
                                        <td style="text-align: center;"> ' . $WorkExp['designation'] .' </td>
                                        <td style="text-align: center;"> ' . $WorkExp['companyName'] .' </td>
                                        <td style="text-align: center;"> ' . date('d M y', strtotime($WorkExp['startYear'])) .' </td>
                                        <td style="text-align: center;"> ' . date('d M y', strtotime($WorkExp['endYear']))   .' </td>';
                                          if ($WorkExp['currentJob'] > 0 && $WorkExp['currentJob'] == 1) {
                          $htmlBody .='  <td style="text-align: center;"><b> Current Work At - '. $WorkExp['companyName'] . '</b></td>';
                                        } else {
                          $htmlBody .='  <td style="text-align: center;"> -- </td>';
                                        }
                          $htmlBody .='</tr>';
                              }
                            }  
                        $htmlBody .='</table>';
                        /* <== Work Experience Details ==> */
                        /* <== Education Details ==> */
                      $htmlBody .='<hr> <h3 class="heading"> Education Details:  </h3>';               
                      $htmlBody .='<table border="1" cellpadding="0" cellspacing="0" width="200px" style="width:98%;margin:auto;" >
                            <tr>
                              <th> Sl No. </th>
                              <th> Education Name </th>
                              <th> Board  </th>
                              <th> Medium </th>
                              <th> Year of Passing </th>
                              <th> Score </th>
                            </tr>';
                                if(!empty($candidateEdu)){
                                  $Scorejson  = json_decode(SCORE_TYPE, true);
                                  $Mediumjson = json_decode(MEDIUM_TYPE, true);
                                    foreach($candidateEdu as $Edu) { //echo '<pre>';print_r($candidateEdu);
                         $htmlBody .='<tr>
                                        <td style="text-align: center;"><b> ' . $EduCount++ .' </b></td>
                                        <td style="text-align: center;"> ' . $Edu->educationytpe->educationName .' </td>';
                                        if ($Edu->board > 0) {
                         $htmlBody .='    <td style="text-align: center;"> ' . $Edu->boarddetails->boardName .' </td>
                                          <td style="text-align: center;"> ' . $Mediumjson[$Edu->medium] .' </td>' ;
                                        } else {
                         $htmlBody .='    <td style="text-align: center;"> -- </td>
                                          <td style="text-align: center;"> -- </td>' ; 
                                        }
                                        $htmlBody .='
                                          <td style="text-align: center;"> ' . $Edu->passYear .' </td>
                                          <td style="text-align: center;"> ' . $Edu->score .' </td>
                                      </tr>';
                                      
                                    }
                                }
                         $htmlBody .='</table>';
                          /* <== Education Details ==> */
                          /* <== Skill Details ==> */
                      $htmlBody .='<hr> <h3 class="heading"> Skill Details:  </h3>';
                      $htmlBody .='<table border="1" cellpadding="0" cellspacing="0" width="200px" style="width:98%;margin:auto;" >
                                  <tr>
                                    <th> Sl No. </th>
                                    <th> Skill /Certifications </th>
                                    <th> Years of Experience  </th>
                                  </tr>';
                                    if (!empty($candidateSkill)) {
                                      foreach ($candidateSkill as $skill) {
                          $htmlBody .='<tr>
                                        <td style="text-align: center;"><b> ' . $SkillCount++ .' </b></td>
                                        <td style="text-align: center;"> ' . $skill->skilldetails->skillName .' </td>
                                        <td style="text-align: center;"> ' . $skill->experienceYear .' </td>
                                      </tr>  
                                      ';
                                      }
                                    }
                        $htmlBody .='</table>';
                          /* <== Skill Details ==> */
                          /* <== Disable Details ==> */ 
                    $htmlBody .='<hr> <h3 class="heading"> Disablity Details:  </h3>';     
                    $htmlBody .='<table border="1" cellpadding="0" cellspacing="0" width="200px" style="width:98%;margin:auto;" >
                                  <tr>
                                    <th> Sl No. </th>
                                    <th> Disability Name </th>
                                  </tr>';
                                    if (!empty($disablityTypes)) {
                                      foreach ($disablityTypes as $disablity) {
                        $htmlBody .='<tr>
                                        <td style="text-align: center;"><b> ' . $disablityCount++ .' </b></td>
                                        <td style="text-align: center;"> ' . $disablity->disabilityName .' </td>
                                      </tr>  
                                      ';
                                      }
                                    }
                          /* <== Disable Details ==> */
                    $htmlBody .= ' 
                      </div>
                    </div>    
                </div>
            </div>
       </div> 
       <small>
            <p>
            
            </p>
       <small>      
    </div>
</div>
</div>
</div>
</div>
</div>';
$htmlFooter = '</body></html>';
$strPdfcontent = $htmlHead . $htmlBody . $htmlFooter; //exit;
echo $strPdfcontent;
?>                               

<script>

/* Print page */
function printDiv(divName) {

  // alert(divName);
  
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    // document.body.innerHTML = header+printContents;
    window.print();
    document.body.innerHTML = originalContents;

    setTimeout(function() {
                location.reload();
    },2);

}
</script>

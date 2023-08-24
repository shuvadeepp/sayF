<?php  
  /* include_once('generate-trade-provisional-certificateInner.php'); 
  $allWard  = $objTrdScrutiny->getWards($OrgId = ORG_ID, $LevelId=3, $ParentId=0);
  //echo "<pre>"; print_r($appresult);exit;

  $address  = (!empty($appresult['vchLocation'])) ? (ucfirst($appresult['vchLocation'])) : ''; 
  $address .= (!empty($appresult['vchPermntAddress'])) ? ','.(ucfirst($appresult['vchPermntAddress'])) : '';
  $address .= (!empty($appresult['vchLandmark'])) ? ','.(ucfirst($appresult['vchLandmark'])) : ''; 
  $address .= (!empty($appresult['vchPermntPinNo'])) ? ','.(ucfirst($appresult['vchPermntPinNo'])) : ''; 
  $qrName = str_replace("/","_",$appresult['vchReferenceNo']);
  //$vchFinancialYear = !empty($appresult['vchFinancialYear'])?$appresult['vchFinancialYear']:$vchFinancialYear;


$vchProfilePhoto =(!empty($appresult['vchProfilePhoto']) && file_exists(APP_PATH.'uploadDocuments/TRADING/'.$appresult['vchProfilePhoto']))?APP_PATH.'uploadDocuments/TRADING/'.$appresult['vchProfilePhoto']:APP_PATH.'img/default.png'; */


$htmlHead = '
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <style type="text/css" media="All">
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
$htmlBody = '<body>
<div id="page-content">

    <div class="tab-base" style="margin-top:20px;">
<div class="tab-content">
            <div class="tab-pane pad-btm fade active in" id="demo-bsc-tab-1">
<div id="viewTable" class="box-body table-responsive">
    <div id="divPrint" class="print-area"> 
        <div class="pdfContainer" style="height: auto;">
            <div class="outBorder2" style="border: #0b4666 solid 2px;">
                <div class="inBorder2" style="border: #0b4666 solid 1px;margin: 10px;">
                    <div style="padding: 15px 0px 15px 0px;">
                        <div style="text-align:center; padding: 5px 0px 0px 0px;">
                          
                          <img src="public/images/Remove.jpg" border="0" align="right" height="80" width="80" style="padding: 25px;">
                          <img src="" border="0" align="right" style="height: 70px;text-align:center;  padding: 15px 15px 0px 0px; float:right;">
                          <h2 style="margin: 15px 10px 0px 10px; font-size: 20px;text-transform:uppercase"> SAMBIT KUMAR SENAPATI </h2>
                          <h3 style="text-transform:uppercase; margin-bottom:0; margin-top:10px;">SAMBIT@gmail.com</h3>
                          <h4 style="margin-top:5px;"> <u>+91 999999999</U> </h4>
                          
                        </div>
						<hr>
                        <table style="width:98%;margin:auto;">
                          <tr>
                          <div style="padding:0 10px; margin-top:20px;">
                            <h3> Personal Information:  </h3>
                            <td width="130"><strong>State:  </strong></td>
							                  <td width="10" align="center">:</td>
                            <td>1111111111</td>
                            <td width="150"><strong>City </strong></td>
							                  <td width="10" align="center">:</td>
                            <td>111111111</td>
                          </tr>
                          <tr>
                            <td><strong>Secondary Number </strong></td>
							                  <td align="center">:</td>
                            <td>111111111111111</td>
                            <td><strong>Primary Number </strong></td>
							                  <td align="center">:</td>
                            <td>11111111111111</td>
                          </tr>
                        
                          <tr>
                            <td><strong>Gender </strong></td>
							                  <td align="center">:</td>
                            <td>1111111111111</td>
                            <td><strong>Date of Birth </strong></td>
							                  <td align="center">:</td>
                            <td>111111111111111</td>
                          </tr>
                          <tr>
                            
                            <td><strong>Date of Issue </strong></td>
							                  <td align="center">:</td>
                            <td>11111111111111</td>
                          </tr>

                        </table>
                      <table style="width:98%;margin:auto;">
                        <div style="padding:0 10px; margin-top:20px;">
                        <h3> Work Experience:  </h3>
                        <tr>
                            <td width="150"><strong> 
                            Fresher Or Experience: </strong></td>
							                  <td width="10" align="center">:</td>
                            <td>111111111</td>
                          </tr>
                        
                          <tr>
                            <td width="150"><strong> Designation: </strong></td>
							                  <td width="10" align="center">:</td>
                            <td>111111111</td>
                          </tr>
                          
                          <tr>
                            <td><strong>Start Date </strong></td>
							                  <td align="center">:</td>
                            <td>111111111111111</td>
                            <td><strong>End Date </strong></td>
							                  <td align="center">:</td>
                            <td>11111111111111</td>
                          </tr>   
                      </table>

                      <table style="width:98%;margin:auto;">
                        <div style="padding:0 10px; margin-top:20px;">
                        <h3> Education:  </h3>
                        <tr>
                            <td width="150"><strong> Education: </strong></td>
							              <td width="10" align="center">:</td>
                            <td>10th</td>
                          </tr>
                        
                          <tr>
                            <td width="150"><strong> Board: </strong></td>
							                  <td width="10" align="center">:</td>
                            <td>CBSE</td>
                          </tr>
                          
                          <tr>
                            <td><strong> Medium </strong></td>
							                  <td align="center">:</td>
                            <td>English</td>
                          </tr> 
                          <tr> 
                            <td><strong>Year of Passing </strong></td>
							                  <td align="center">:</td>
                            <td>11111111111111</td>
                          </tr>   
                          <td><strong>Score </strong></td>
							                  <td align="center">:</td>
                            <td>10.9</td>
                          </tr>   
                      </table>

                      <table style="width:98%;margin:auto;">
                        <div style="padding:0 10px; margin-top:20px;">
                        <h3> Skill:  </h3>
                        <tr>
                            <td width="150"><strong> Skill Name/Certifications: </strong></td>
							              <td width="10" align="center">:</td>
                            <td> PHP </td>
                          </tr>
                        
                          <tr>
                            <td width="150"><strong> Years of Experience: </strong></td>
							                  <td width="10" align="center">:</td>
                            <td> 2 </td>
                          </tr>
                          
                          <tr>
                            <td><strong> Upload Certificate
                            </strong></td>
							                  <td align="center">:</td>
                            <td>English</td>
                          </tr> 
                      </table>

                      

                      <table style="width:98%;margin:auto;">
                        <div style="padding:0 10px; margin-top:20px;">
                        <h3> Disability:  </h3>
                        <tr>
                            <td width="150"><strong> Type Of Disability: </strong></td>
							              <td width="10" align="center">:</td>
                            <td> Muscular Dystrophy </td>
                          </tr>
                        
                          <tr>
                            <td width="150"><strong> Disability Subtype: </strong></td>
							                  <td width="10" align="center">:</td>
                            <td> HSN2 </td>
                          </tr>
                          
                          <tr>
                            <td><strong> Disability Percentage
                            </strong></td>
							                  <td align="center">:</td>
                            <td>41</td>
                          </tr> 

                          <tr>
                            <td><strong> Disability Certificate No.
                            </strong></td>
							                  <td align="center">:</td>
                            <td>27467578687376374</td>
                          </tr> 
                      </table>';
                            

                             /* for ($j = 0; $j < count($appresult['qualsArrLi']); $j++) { 
                              if($appresult['qualsArrLi'][$j]['intItemTotalAmount']>0){
                                $htmlBody .= '<tr>
                                    <td>'.$appresult['qualsArrLi'][$j]['vchLicenseType'].'</td>
                                    <td>'.$appresult['qualsArrLi'][$j]['vchLicenseSubtype'].'</td>
                                    <td>'.$appresult['qualsArrLi'][$j]['vchNoitem'].'</td>
                                    <td style="text-align:right;">Rs.'.$objTraderLice->custom_money_format($appresult['qualsArrLi'][$j]['intItemUnitAmount']).'</td>
                                    <td style="text-align:right;">Rs.'.$objTraderLice->custom_money_format($appresult['qualsArrLi'][$j]['intItemTotalAmount']).' </td>
                                </tr>'; 
                              }
                            } */
                                
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
// $uploadPath = DOC_SERVER_UPLOAD_PATH . "notification/";
/* $objTrdScrutiny->mkDir($uploadPath, 0777);
$objTrdScrutiny->generatePdfP('',$strPdfcontent,DOC_SERVER_UPLOAD_PATH."notification/",$strGeneratedDocNm,'');  */
echo $strPdfcontent;exit;
/* if($_SESSION['certificateDownload']==1){
  $_SESSION['certificateDownload'] = 0;
  
  $filename=$strGeneratedDocName; // YOUR File name retrive from database
  $file= DOC_SERVER_UPLOAD_PATH.'notification/'.$strGeneratedDocName; // YOUR Root path for pdf folder storage
  $len = filesize($file); // Calculate File Size
  ob_clean();
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: public"); 
  header("Content-Description: File Transfer");
  header("Content-Type:application/pdf"); // Send type of file
  $header="Content-Disposition: attachment; filename=$filename;"; // Send File Name
  header($header );
  header("Content-Transfer-Encoding: binary");
  header("Content-Length: ".$len); // Send File Size
  @readfile($file);
  //exit;
} */

/*$htmlFooter = '</body></html>';
$strPdfcontent = $htmlHead . $htmlBody . $htmlFooter; //exit;
$uploadPath = DOC_SERVER_UPLOAD_PATH . "notification/";
$objTrdScrutiny->mkDir($uploadPath, 0777);
$objTrdScrutiny->generatePdfP('',$strPdfcontent,DOC_SERVER_UPLOAD_PATH."notification/",$strGeneratedDocNm,''); */

/*$filename=$strGeneratedDocName; // YOUR File name retrive from database
$file= DOC_SERVER_UPLOAD_PATH.'notification/'.$strGeneratedDocName; // YOUR Root path for pdf folder storage
$len = filesize($file); // Calculate File Size
ob_clean();
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public"); 
header("Content-Description: File Transfer");
header("Content-Type:application/pdf"); // Send type of file
$header="Content-Disposition: attachment; filename=$filename;"; // Send File Name
header($header );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".$len); // Send File Size
@readfile($file);*/
//exit;
//$outMsg = "Certificate generated successfully.";
//$redirectLoc = APPURL. "issue-trade-licence";
//header("Location:" .APPURL. "issue-trade-licence");
?>                               

 
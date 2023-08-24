<?php

/* * ******************************************
  File Name     : AjaxController.php
  Description   : Controller file for managing all the ajax requests of Website and employer and employee
  Created By    : Ananya Dash
  Created On    : 05-Apr-2021

  ======================================================================
  |Update History                                                      |
  ======================================================================
  |<Updated by>                 |<Updated On> |<Remarks>
  ----------------------------------------------------------------------
  |Name Goes Here               |DD-MMM-YYYY  |Remark goes here
  ----------------------------------------------------------------------
  |                             |             |
  ----------------------------------------------------------------------

 * ****************************************** */

namespace App\Http\Controllers\Website;

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Mail;
use Session;
use DB;
use App\Models\CategoryModel;
use App\Models\JobTypeModel;
use App\Models\SkillModel;
use App\Models\LocationModel;
use App\Models\JobModel;
use App\Models\AppliedJobModel;
use App\Models\BookmarkedModel;
use App\Models\EmployerprofileModel;
use App\Models\PartnerprofileModel;
use App\Models\PartnerDetailsCounterModel;




class PartnerController extends AppController {
  function index() {
    $this->viewVars[]='';  

      $existingProfile = PartnerprofileModel::select("t_partner_profile.*",
                  DB::raw("(select group_concat(m.serviceName) FROM m_service m
                  WHERE find_in_set(m.serviceId,t_partner_profile.partnerService) ) as serviceName"),
                  DB::raw("(select group_concat(t.location) FROM m_location t
                  WHERE find_in_set(t.locationId,t_partner_profile.partnerCity) ) as location"))
                  ->where('deletedFlag',0)->get();
        $this->viewVars['existingProfile'] = $existingProfile;
     return view('website.partners',$this->viewVars);
  }

  public function details($paramId){
    if($paramId){
      $paramId=decrypt($paramId);
      $cookie_names_partner = 'PartnerCookies_'.$paramId;
    if(!isset($_COOKIE[$cookie_names_partner])){
      $date=date('Y-m-d');
      $tocount = PartnerDetailsCounterModel::select("t_partner_details_counter.*")
                  ->whereDate('createdOn',$date)
                    ->where('partnerId', '=',$paramId )
                  ->get()->toArray();
   if(!empty($tocount)){
     PartnerDetailsCounterModel::where([['partnerId',$paramId]])
              ->update([
                  'counter' => DB::raw('counter+1')
              ]);
 }else{
      setcookie($cookie_names_partner,"1",'360');
      $counter=1;
      $PartnerDetailsCounterModel = new PartnerDetailsCounterModel();
      $PartnerDetailsCounterModel->partnerId = $paramId;
      $PartnerDetailsCounterModel->counter =$counter;                                              
      $PartnerDetailsCounterModel->save();
   }
    }
      $partDetls=PartnerprofileModel::select('companyLogo','partnerId','partnerCompany','partnerLocation','partnerCompanyintro','partnerServiceOffered','partnerName','partnerDesignation','partnerCompany','partnerService',
      DB::raw("(select mobileNo FROM m_user_master u
                  WHERE u.userId =  t_partner_profile.partnerId) as partnermobile"),
       DB::raw("(select tinUserType FROM m_user_master u
                  WHERE u.userId =  t_partner_profile.partnerId) as tinUserType"),
      DB::raw("(select group_concat(m.serviceName) FROM m_service m
                  WHERE find_in_set(m.serviceId,t_partner_profile.partnerService) ) as serviceName"),
      DB::raw("(select group_concat(L.location) FROM m_location L
                   WHERE find_in_set(L.locationId,t_partner_profile.partnerCity) ) as locationName"))
                  ->where([['deletedFlag',0],['profileId',$paramId]])->first();
      
      $this->viewVars['partDetls'] = $partDetls;
      return view('website.partner-details',$this->viewVars);
    }
  }
}

?>
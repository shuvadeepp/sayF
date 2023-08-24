<?php

/* * ******************************************
  File Name     : ProfileController.php
  Description   : Controller file for managing partner profile details
  Created By    : Sandeep Kumar Senapati
  Created On    : 05-May-2021

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

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\AppController;
use App\Models\PartnerprofileModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use DB;
use Storage;

class ProfileController extends AppController {
    public function index(){
      $partnerId    = session()->get('partner_session_data.userId');     
      //echo '<pre>';print_r(session('employer_session_data'));exit;
      if(!empty(request()->all()) && request()->isMethod('post')) {
        $requestData = request()->all();  
        $PartnerprofileModel = new PartnerprofileModel();
        //echo '<pre>';print_r($requestData);exit;
        $regex       = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $regex1      = '/^[a-zA-Z0-9_\- \/+:,.\r\n]*$/';
        $validator   = \Validator::make($requestData, [
                          'partnerName'           => 'bail|required|regex:/^[a-zA-Z ]*$/|max:64',
                          'partnerDesignation'    => 'nullable|max:128',
                          'partnerCompany'        => 'nullable|regex:/^[a-zA-Z ]*$/|max:128',
                          'partnerWebsite'        => 'nullable|regex:'.$regex1.'|max:128',
                          //'partnerLocation'     => 'nullable|regex:/^[0-9]*$/',
                         
                          'partnerLocation'       => 'bail|required',
                          'selcity'       => 'bail|required',
                          'partnerService'       => 'bail|required',
                          'partnerSize'           => 'nullable|regex:/^[a-zA-Z0-9 -]*$/',
                          'partnerCompanyintro'   => 'nullable',
                          'partnerCompanyaddr'    => 'nullable|regex:'.$regex1,
                          'companyLogo'            => 'nullable|image|mimes:jpg,png,jpeg,gif|max:1024',
                        ], 
                        [
                          'partnerName.required'         => 'Partner Name is required',
                          'partnerName.regex'            => 'Partner Name should be alphabetic',
                         // 'partnerDesignation.regex'     => 'Partner Designation should be alphabetic',
                          'partnerCompany.regex'         => 'Partner Company should be alphabetic',
                          'partnerWebsite.regex'         => 'Please enter a valid website URL',
                          'partnerLocation.required'     => 'Partner State is required',
                           'selcity.required'            => 'Partner city is required',
                          'partnerService.required'     => 'Partner service is required',
                          'partnerCompanyintro.regex'    => 'Please enter a valid company intro',
                          'partnerCompanyaddr.regex'     => 'Please enter a valid company address',
                          'companyLogo.mimes'             => 'Logo should be jpg,png,jpeg,gif',
                          'companyLogo.max'               => 'Logo should not be more than 10 Mb',
                        ]);
        if ($validator->fails()) {
            return redirect('ngo/profile')->withErrors($validator)->withInput();
        }else{
          $chkExisting      = PartnerprofileModel::where([['partnerId', $partnerId]])->first();
          $partnerLocation = '';
          //$partnerService = '';
          if(!empty($requestData['partnerLocation'])){
            $partnerLocation = implode(",",$requestData['partnerLocation']);
          }  
           $selcity='';
            if(!empty($requestData['selcity'])){
            $selcity = implode(",",$requestData['selcity']);
          }      
        //   if(!empty($requestData['partnerService'])){
        //     $partnerService = implode(",",$requestData['partnerService']);
        //   }         
          if($chkExisting){
              if(!empty($requestData['hdnbase64file'])){
                
                /***************create dir*******************/
                $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                $mainParentDir= $storagePath.'uploads';
                if(!file_exists($mainParentDir)){
                    \mkdir($mainParentDir, 0755);
                }
                $logodirpath  = $storagePath.'uploads/partnerlogo';
                if(!file_exists($logodirpath)){
                    \mkdir($logodirpath, 0755);
                }
                /**********************************/
                if($requestData['hdncompanyLogo'] && $requestData['hdncompanyLogo'] !=''){
                    @unlink('storage/app/uploads/partnerlogo/'.$requestData['hdncompanyLogo']);
                }
                
                $image_parts        = explode(";base64,", $requestData['hdnbase64file']);
                $image_type_aux     = explode("image/", $image_parts[0]);
                $image_type         = $image_type_aux[1];
                $image_base64       = base64_decode($image_parts[1]);
         
                $modifiylogonme     = 'companyLogo'.time().'.png';
         
                $imageFullPath      = $logodirpath.'/'.$modifiylogonme;
         
                file_put_contents($imageFullPath, $image_base64);
                session(['partner_session_data.companyLogo' => $modifiylogonme]);
              }else{
                $modifiylogonme = (!empty($requestData['hdncompanyLogo']))?$requestData['hdncompanyLogo']:'';
              }

              
              PartnerprofileModel::where('partnerId', $partnerId)
                  ->update([
                      'companyLogo'           => $modifiylogonme,
                      'partnerName'          => $requestData['partnerName'],
                      'partnerDesignation'   => $requestData['partnerDesignation'],
                      'partnerCompany'       => $requestData['partnerCompany'],
                      'partnerWebsite'       => $requestData['partnerWebsite'],
                      'partnerLocation'      => $partnerLocation,
                        'partnerCity'      => $selcity,
                      'partnerService'       => $requestData['partnerService'],
                      'partnerSize'          => $requestData['partnerSize'],
                      'partnerCompanyintro'  => $requestData['partnerCompanyintro'],
                      'partnerCompanyaddr'   => $requestData['partnerCompanyaddr'],
                      'partnerServiceOffered'   =>  htmlspecialchars($requestData['partnerServiceOffered'],ENT_QUOTES),
                      'updatedBy'             => $partnerId
                  ]);
                  DB::table('m_user_master')
                    ->where('userId', $partnerId)
                    ->update(['fullName' => $requestData['partnerName'],'companyName' =>$requestData['partnerCompany']]);
                  request()->session()->flash('success', 'Record updated successfully');
                  return redirect('ngo/profile');
          }else{
            if(!empty($requestData['hdnbase64file'])){
              /***************create dir*******************/
              $storagePath        = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
              $mainParentDir      = $storagePath.'uploads';
              if(!file_exists($mainParentDir)){
                  \mkdir($mainParentDir, 0755);
              }
              $logodirpath        = $storagePath.'uploads/partnerlogo';
              if(!file_exists($logodirpath)){
                  \mkdir($logodirpath, 0755);
              }
              /**********************************/
              $image_parts        = explode(";base64,", $requestData['hdnbase64file']);
              $image_type_aux     = explode("image/", $image_parts[0]);
              $image_type         = $image_type_aux[1];
              $image_base64       = base64_decode($image_parts[1]);
       
              $modifiylogonme     = 'companyLogo'.time().'.png';
       
              $imageFullPath      = $logodirpath.'/'.$modifiylogonme;
       
              file_put_contents($imageFullPath, $image_base64);
              session(['partner_session_data.companyLogo' => $modifiylogonme]);
            }else{
              $modifiylogonme     = '';
            }

            
            $PartnerprofileModel->partnerId           = $partnerId;
            $PartnerprofileModel->companyLogo         = $modifiylogonme;
            $PartnerprofileModel->partnerName         = $requestData['partnerName'];
            $PartnerprofileModel->partnerDesignation  = $requestData['partnerDesignation'];
            $PartnerprofileModel->partnerCompany      = $requestData['partnerCompany'];
            $PartnerprofileModel->partnerWebsite      = $requestData['partnerWebsite'];
            $PartnerprofileModel->partnerLocation     = $partnerLocation;
              $PartnerprofileModel->partnerCity     = $selcity;
            $PartnerprofileModel->partnerService      = $requestData['partnerService'];
            $PartnerprofileModel->partnerSize         = $requestData['partnerSize'];
            $PartnerprofileModel->partnerCompanyintro = $requestData['partnerCompanyintro'];
            $PartnerprofileModel->partnerCompanyaddr  = $requestData['partnerCompanyaddr'];
            $PartnerprofileModel->partnerServiceOffered   = htmlspecialchars($requestData['partnerServiceOffered'],ENT_QUOTES);
            $PartnerprofileModel->createdBy            = $partnerId;
            if($PartnerprofileModel->save()){
                DB::table('m_user_master')
                    ->where('userId', $partnerId)
                    ->update(['fullName' => $requestData['partnerName'],'companyName' =>$requestData['partnerCompany']]);
              request()->session()->flash('success', 'Record updated successfully');
              return redirect('ngo/profile');
            }else{
              request()->session()->flash('error', 'Sorry!!! something went wrong');
              return redirect('ngo/profile');
            }
          }
        }
      }
      
      $existingProfile              = DB::table('t_partner_profile')
                                      ->where([['deletedflag',0],['partnerId', $partnerId]])->get()->first();    

      // $locations                    = DB::table('m_location')
      //                                 ->select('locationId','location')
      //                                 ->where('deletedFlag',0)->orderBy('location', 'asc')->get();
      $locations  = DB::table('m_location')
                ->select('stateId','state')
                ->where('deletedflag',0)
                ->orderBy('state','ASC')
                ->groupBy('stateId','state')
                ->get();                                                                                               
      $services                      = DB::table('m_service')
                                        ->select('serviceId','serviceName')
                                        ->where('deletedflag',0)->get();
      $this->viewVars['services']  = $services;
      $this->viewVars['locations']  = $locations;
      $this->viewVars['existingProfile'] = $existingProfile;
      return view('partner.partnerProfile',$this->viewVars);      
    }

    public function removeProfileImage(){
      $empData  = PartnerprofileModel::where([['partnerId', session()->get('partner_session_data.userId')]])->first();
      if(DB::table('t_partner_profile')->where('partnerId', session()->get('partner_session_data.userId'))->update(array('companyLogo' => ''))){
        if($empData->companyLogo){
           @unlink('storage/app/uploads/partnerlogo/'.$empData->companyLogo);
        }
        echo json_encode(array('status'=>200,'msg'=>'Image removed successfully.'));
        
      }else{
        echo json_encode(array('status'=>400,'msg'=>'Something went wrong!try later.'));
      }
    }
}

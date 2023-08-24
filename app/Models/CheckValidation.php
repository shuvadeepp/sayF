<?php

namespace App\app\models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class CheckValidation extends Model
{
    //
public function CheckValidation($arrPageData,$id){

    $regex       = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
    $regex1      = '/^[a-zA-Z0-9_\- \/+:,.!@&()\r\n]*$/';
    $empValidationRule = [
    //'vchCategory' => 'bail|required|max:60|unique:m_admin_category,vchCategory,'.$id.',intCategoryId,bitDeletedFlag,0',

        'employerName'              => 'bail|required|regex:/^[a-zA-Z ]*$/|max:64',
        'employerDesignation'       => 'nullable|regex:/^[a-zA-Z ]*$/|max:128',
        'employerCompany'           => 'nullable|regex:/^[a-zA-Z ]*$/|max:128',
        // 'employerWebsite'        => 'nullable|regex:'.$regex.'|max:128',
        'employerWebsite'           => 'nullable|regex:'.$regex1,
        //'employerLocation'        => 'nullable|regex:/^[0-9]*$/',
        'employerLocation'          => 'bail|required',
        'selcity'                   => 'bail|required',
        'employerSize'              => 'nullable|regex:/^[a-zA-Z0-9 -]*$/',
        'pwdSizeHead'               => 'bail|required',
        'pwdSize'                   => 'nullable|numeric',
        'employerIndustry'          => 'nullable|numeric',
        //'employerPannumber'       => 'nullable|regex:/(^([a-zA-Z]{5})([0-9]{4})([a-zA-Z]{1})$)/|max:10',
        'employerCompanyintro'      => 'nullable',
        'employerCompanyaddr'       => 'nullable|regex:'.$regex1,
        'companyLogo'               => 'nullable|image|mimes:jpg,png,jpeg,gif|max:10240',
    ];

    $empvalidationMsg = [
        'employerName.required'         => 'Employer Name is required',
        'employerName.regex'            => 'Employer Name should be alphabetic',
        'employerDesignation.regex'     => 'Employer Designation should be alphabetic',
        'employerCompany.regex'         => 'Employer Company should be alphabetic',
        'employerWebsite.regex'         => 'Please enter a valid website URL',
        'employerLocation.required'     => 'Employer State is required',
        'selcity.required'              => 'Employer City is required',
        'employerPannumber.regex'       => 'Please enter a valid pan number',
        'employerCompanyintro.regex'    => 'Please enter a valid company intro',
        'employerCompanyaddr.regex'     => 'Please enter a valid registered address',
        'companyLogo.mimes'             => 'Logo should be jpg,png,jpeg,gif',
        'companyLogo.max'               => 'Logo should not be more than 10 Mb',
    ];

    $validator = \Validator::make($arrPageData, $empValidationRule, $empvalidationMsg);
        return $validator;

  }
}

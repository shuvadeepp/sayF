<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, X-Auth-Token, 'X-CSRF-TOKEN'");
header("Cache-Control: max-age=2592000");
use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Models\JobModel;
use App\Models\AppliedJobModel;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/



Route::post('apiServices', function (Request $request) {
	$data       = json_decode(file_get_contents('php://input'));
    $methodCase = $data->{'method'};
    switch ($methodCase) {
    	case "getalllocationbackup":
    		$location  = DB::table('m_location')
                		 ->select('locationId','location')
                		 ->where('deletedflag',0)
                		 ->orderBy('location','ASC')
                		 ->get()->toArray();
		    if(!empty($location)){
		      	$respArr      = array('status' => 200, 'result' => $location);
            	return response()->json($respArr);exit;
		    }else{
		    	$respArr      = array('status' => 404, 'msg' => 'No record found!!');
            	return response()->json($respArr);exit;
		    }
        break;
        case "getalllocation":
    		$location  = DB::table('m_location')
                		 ->where('deletedflag',0)
                		 ->orderBy('state','ASC')
                		 ->get()->toArray();
            $stateData = array();
		    if(!empty($location)){ 
		    	foreach ($location as $lkey => $lval) { //echo "<pre>";print_r($lval);exit;
	            	if(array_search($lval->stateId, array_column($stateData, 'state_id')) !== FALSE){
	            		$key = array_search($lval->stateId, array_column($stateData, 'state_id')); 
	            		array_push($stateData[$key]['city'],array('city_id'=>$lval->locationId,'city_name'=>$lval->location));	
	            	}else{
					  $tmp['state_id'] = $lval->stateId;
	            	  $tmp['state'] = $lval->state;
	            	  $tmp['city'][] = array('city_id'=>$lval->locationId,'city_name'=>$lval->location);
	            	  array_push($stateData, $tmp);
		    		  $tmp = array();
					}	            	
	            }
		      	$respArr      = array('status' => 200, 'result' => $stateData);
		    }else{
		    	$respArr      = array('status' => 404, 'msg' => 'No record found!!');
		    }

            return response()->json($respArr);exit;
        break;
        case "getDisability":
    		$disability=DB::table('m_disabilitytype')
                    ->select('disabilityId','disabilityName')
                    ->where([['deletedflag',0],['publishStatus',0]])->get();
		    if($disability->isNotEmpty()){
		      	$respArr      = array('status' => 200, 'result' => $disability);
		    }else{
		    	$respArr      = array('status' => 404, 'msg' => 'No record found!!');
		    }
            return response()->json($respArr);exit;
        break;
        case "getDisabilitySubtype":
        	$requestData = json_decode(json_encode($data),true); 
        	$validator   = \Validator::make($requestData, [
              'disabilityId' => 'bail|required|numeric'
              ], 
              [
                'disabilityId.required' => 'Disability Id is required.'
      		  ]
      		);
	      	if ($validator->fails()) {
	      		$errors 	  = $validator->errors();
	      		$respArr      = array('status' => 403, 'msg' => 'Validation error', 'error' => $errors);
	        }else{	        	
	    		$disabilitysubtypes=DB::table('m_disabilitysubtype')
                ->select('disabilitySubtypeId','disabilitySubType')
	    		->where([['deletedflag',0],['publishStatus',0],['disabilityId',$requestData['disabilityId']]])->get();
			    if($disabilitysubtypes->isNotEmpty()){
			      	$respArr      = array('status' => 200, 'result' => $disabilitysubtypes);
			    }else{
			    	$respArr      = array('status' => 404, 'msg' => 'No record found!!');
			    }
			}
            return response()->json($respArr);exit;
        break;
        case "candidateregistration":
        	$requestData = json_decode(json_encode($data),true); 
        	$AdminModel  = new AdminModel();
	      	$validator   = \Validator::make($requestData, [
	                  'txtName' 			=> 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:128',
	                  'txtEmail' 			=> 'bail|required|email|max:128',
	                  'txtPhone' 			=> 'bail|required|numeric',
	                  'txtPassword' 		=> 'bail|required|required_with:cpassword|same:cpassword',
	                  'cpassword'   		=> 'bail|required',
	                  'stateId'     		=> 'bail|required|numeric',
	                  'cityId'      		=> 'bail|required|numeric',
	                  'selExperience' 		=> 'bail|required|numeric'
	                      ], 
	                  ['txtName.required' 		=> 'Name is required',
	                    'txtName.regex'   		=> 'Name should be alphanumeric',
	                    'txtName.max'     		=> 'Name should be 128 character',
	                    'txtEmail.required' 	=> 'Email is required',
	                    'txtEmail.email'    	=> 'Please enter a valid email address',
	                    'txtEmail.max'       	=> 'Email should be 128 character',
	                    'txtPhone.required' 	=> 'Phone is required',
	                    'txtPhone.numeric'  	=> 'Please enter a valid phone number',
	                    'txtPassword.required'	=> 'Password is required',
	                    'txtPassword.same'     	=> 'Password and confirm password must match',
	                    'cpassword.required'   	=> 'Confirm password is required',
	                    'stateId.required' 		=> 'Please select a state',
	                    'cityId.required' 		=> 'Please select a city',
	                    'selExperience.required'=> 'Experience is required'
	      	]);
	      	if ($validator->fails()) {
	      		$errors 	  = $validator->errors();
	      		$respArr      = array('status' => 403, 'msg' => 'Validation error', 'error' => $errors);
            	return response()->json($respArr);exit;
	        } else {
	        	$chkDup = AdminModel::where([['emailId',$requestData['txtEmail']],['tinUserType',3]])->orWhere('loginId', $requestData['txtEmail'])->orWhere('mobileNo', $requestData['txtPhone'])->first();

               // if(!empty($chkDup) && $chkDup->mobileVerifyFlag==0){
				if(!empty($chkDup) && $chkDup->emailVerifyFlag==0){
                   $respArr      = array('status' => 403, 'msg' => 'Account waiting for activation');
            	   return response()->json($respArr);exit;
               // }else if(!empty($chkDup) && $chkDup->mobileVerifyFlag==1){
				}else if(!empty($chkDup) && $chkDup->emailVerifyFlag==1){
	               $respArr      = array('status' => 409, 'msg' => 'Account already registered');
            	   return response()->json($respArr);exit;
                }else{
                	$otp=rand(1000,9999);
	                $AdminModel->fullName 	 	= $requestData['txtName'];
	                $AdminModel->mobileNo 	 	= $requestData['txtPhone'];
	                $AdminModel->emailId  	 	= $requestData['txtEmail'];
	                $AdminModel->loginId  	 	= $requestData['txtEmail'];
	                $AdminModel->password 	 	= md5($requestData['txtPassword']);
	                $AdminModel->tinUserType 	= 3;
	                $AdminModel->register_from  = 1;
	                $AdminModel->otp  			= $otp;
	                $AdminModel->save();
	                $lastInsertedId 		    = $AdminModel->userId;
	                DB::table('t_candidate_details')
	                    	->insert(['userId'=>$lastInsertedId,
	                      	'state'=>$requestData['stateId'],
	                      	'city'=>$requestData['cityId'],
	                      	'experience'=>$requestData['selExperience'],
	                      	'createdBy'=>$lastInsertedId
	                ]);
	                if($AdminModel->save()){
	                	$mailContent='Your one time otp for registration is '.$otp;
		                $ccmailAddress='';
		                $bccmailAddress='';
		                $subject='Registration as Candidate';
		                $attachment='';
		                $sendTo=$requestData['txtEmail'];
		                sendMail($mailContent,$ccmailAddress,$bccmailAddress,$subject,$attachment,$sendTo);

	                	$respArr = array('status' => 200, 'msg' => 'Account registered successfully,An OTP sent to your mail for verification.');
            	   		return response()->json($respArr);exit;
	                }
                }    
	        }
        break;

        case "verifyOtp":
    		$requestData = json_decode(json_encode($data),true); 
        	$AdminModel  = new AdminModel();
	      	$validator   = \Validator::make($requestData, [
              'email' => 'bail|required|email|max:128',
              'otp'   => 'bail|required'
              ], 
              [
                'email.required' => 'Email is required',
                'email.email'    => 'Please enter a valid email address',
                'email.max'      => 'Email should be 128 character',
                'otp.required' 		=> 'OTP is required'
      		]);
	      	if ($validator->fails()) {
	      		$errors 	  = $validator->errors();
	      		$respArr      = array('status' => 403, 'msg' => 'Validation error', 'error' => $errors);
	      		return response()->json($respArr);exit;
	        }else{	        	
			  $adminModel = new AdminModel();
			  $getUserData = $adminModel->where([['emailId', $requestData['email']],['otp', $requestData['otp']],['deletedFlag',0]])->first()->toArray();
			  if(count($getUserData)>0){
			  	$updatedata=AdminModel::where([['userId',$getUserData['userId']],['otp',$requestData['otp']]])
		          ->update([
		            'publishStatus' => 1 ,
		           // 'mobileVerifyFlag' => 1,
					'emailVerifyFlag' => 1
		          ]);

		         if(!empty($updatedata)){
		         	$respArr  = array('status' => 200, 'msg' => 'OTP verified successfully');
		          }else{
		          	$respArr  = array('status' => 403, 'msg' => 'Something went wrong.Try later');
		          }

			  }else{
			  	$respArr      = array('status' => 403, 'msg' => 'Invalid OTP');
			  }
              return response()->json($respArr);exit;
	        }
        break;

        case "candidateProfileUpdate":
        	$errFlag  = 0;
        	$requestData = json_decode(json_encode($data),true); 
        	$AdminModel  = new AdminModel();
	      	$validator   = \Validator::make($requestData, [
	      		'txtName' 				 => 'bail|required|regex:/^[a-zA-Z0-9_\- ]*$/|max:128',
	            'txtEmail' 				 => 'bail|required|email|max:128',
	            'gender'  		 		 => 'bail|required|numeric',
	            'disabilityId'  		 => 'bail|required|numeric',
	            'disabilitySubtypeId'    => 'bail|required|numeric',
	            'disabilityPercentage'   => 'bail|required|numeric',
	            'disabilityCertificateNo'=> 'bail|required',
	            'stateId'                => 'bail|required|numeric',
	            'cityId'                 => 'bail|required|numeric',
	            'selExperience' 		=> 'bail|required|numeric'
              ], 
              [
              	'txtName.required' 				   => 'Name is required',
                'txtName.regex'   				   => 'Name should be alphanumeric',
                'txtName.max'     				   => 'Name should be 128 character',
                'txtEmail.required'      		   => 'Email is required',
                'txtEmail.email'         		   => 'Please enter a valid email address',
                'txtEmail.max'          		   => 'Email should be 128 character',
                'gender.required' 		   		   => 'Please select gender',
                'disabilityId.required' 		   => 'Please select a Disability',
                'disabilitySubtypeId.required' 	   => 'Please select a Disability Subtype',
                'disabilityPercentage.required'    => 'Please select a Disability Percentage',
                'disabilityCertificateNo.required' => 'Please select a state',
                'stateId.required' 		 		   => 'Please select a state',
                'cityId.required' 		 		   => 'Please select a city',
                'selExperience.required'           => 'Experience is required'
	      	]);
	      	if ($validator->fails()) {
	      		$errors 	  = $validator->errors();
	      		$respArr      = array('status' => 403, 'msg' => 'Validation error', 'error' => $errors);
	        }else{	        	
        		$getUserData = $AdminModel->where([['emailId', $requestData['txtEmail']]])->first();
        		//echo "<pre>";print_r($getUserData);exit;
        		if($getUserData->userId>0){

	                $candidateId  = $getUserData->userId;
	                DB::beginTransaction();
            		try{
		                DB::table('m_user_master')
		                	->where([['userId',$candidateId]])
		               		->update(['fullName'=>$requestData['txtName'],
		                    'gender'=>$requestData['gender']
		                ]);

		                DB::table('t_candidate_details')
	                		->where([['userId',$candidateId]])
	                    	->update([
		                      	'state'=>$requestData['stateId'],
			                    'city'=>$requestData['cityId'],
			                    'experience'=>$requestData['selExperience'],
			                    'disablityType' => $requestData['disabilityId'],
		                        'disabilitySubType'=>$requestData['disabilitySubtypeId'],
		                        'disabilityPercentage'=>$requestData['disabilityPercentage'],
		                        'disabilityCertificateNo'=>$requestData['disabilityCertificateNo']
			                ]);
			            $errFlag  = 0;
                		DB::commit(); 
			        }catch(\Exception $e){ 
			        	//dd($e);exit;
		                DB::rollBack();
		                $errFlag  = 1;
		            } 
	                if($errFlag  == 0){
	                	$respArr = array('status' => 200, 'msg' => 'Profile updated successfully.');
                	}else{
                		$respArr = array('status' => 403, 'msg' => 'Something went wrong while updating profile.');
                	}    
        		}else{
        			$respArr = array('status' => 403, 'msg' => 'Please enter your registered email id.');
        		}                	
	        }
	        return response()->json($respArr);exit;
        break;

        case "candidateLogin":
    		$requestData = json_decode(json_encode($data),true); 
        	$AdminModel  = new AdminModel();
	      	$validator   = \Validator::make($requestData, [
              'email' 		=> 'bail|required|email|max:128',
              'password' => 'bail|required',
              ], 
              [
                'email.required'       	=> 'Email is required',
                'email.email'    		=> 'Please enter a valid email address',
                'email.max'      		=> 'Email should be 128 character',
                'password.required' 	=> 'Password is required'
      		]);
	      	if ($validator->fails()) {
	      		$errors 	  = $validator->errors();
	      		$respArr      = array('status' => 403, 'msg' => 'Validation error', 'error' => $errors);
	        }else{	
	          	$userName = $requestData['email'];
	            $password = md5($requestData['password']);
	            $getCandidateData = $AdminModel->where([['loginId',$userName],['password',$password],['tinUserType',3],['publishStatus',1]])->first();
	            if(!empty($getCandidateData)){
	               $respArr = array('status' => 200, 'msg' => 'Login successfully.', 'userData'=>$getCandidateData);
	            }else{
	              $respArr  = array('status' => 403,  'msg' => 'Invalid User Credential');
	            } 
	        }      	

              return response()->json($respArr);exit;
        break;

        case "candidateJob":
        	$response = array();
    		$requestData = json_decode(json_encode($data),true); 
        	$AdminModel  = new AdminModel();
	      	$validator   = \Validator::make($requestData, [
              'userId' 		=> 'bail|required|numeric',
              ],
              [
                'userId.required' => 'User id is required'
	      	  ]
	      	);
	      	if($validator->fails()){
	      		$errors 	  = $validator->errors();
	      		$respArr      = array('status' => 403, 'msg' => 'Validation error', 'error' => $errors);
	        }else{	
	        	$getCandidateData = $AdminModel->where([['userId',$requestData['userId']]])->first();

		        if(!empty($getCandidateData)){

		          $stateId = $getCandidateData->candidate->state;
		          $cityId = $getCandidateData->candidate->city;

	        	  $arrResQuery = JobModel::select("t_job.*",
                  DB::raw("(SELECT count(1) FROM t_applied_job
                          WHERE t_applied_job.jobId = t_job.jobId AND candidateId = $requestData[userId]
                        ) as candidateapplied"))->where('deletedFlag',0);

	        	  // if($stateId>0){
			         //  $arrResQuery = $arrResQuery->whereHas('joblocations',
			         //      function ($query) use ($stateId) {
			         //          $query->where('locationId', '=', $stateId);
			         //      }
			         //  );
	        	  // }

	        // 	  if($cityId>0){
			      //     $arrResQuery = $arrResQuery->whereHas('joblocations',
			      //         function ($query) use ($cityId) {
			      //             $query->where('cityId', '=', $cityId);
			      //         }
			      //     );
			      // }
	        	   if(!empty($requestData['jobTitle'])){
	        	  	$jobTitle = $requestData['jobTitle'];
	        	  	$arrResQuery = $arrResQuery->where('jobTitle', 'LIKE', "%{$jobTitle}%");
	        	   }
		           $arrResQuery = $arrResQuery->where('job_status',1);
		           $arrResQuery = $arrResQuery->with('employer','joblocations')->orderBy('createdOn','DESC');
		           $arrResQuery = $arrResQuery->get();

		           //echo "<pre>";print_r($arrResQuery);exit;

		           if(count($arrResQuery) > 0){
		           		foreach ($arrResQuery as $row){
		           		  $skills = '';
                          if(!empty($row->jobskills)){
                            foreach ($row->jobskills as $key => $value) {
                              $skills .= $value->skillname->skillName.',';
                            }
                          }
                          $skills = rtrim($skills,',');

                          $locations = '';
	                      $city='';
	                      if(!empty($row->joblocations)){
	                        foreach ($row->joblocations as $key => $value) {
	                         // $locations .= $value->location->location.',';
	                        	if(!empty(@$value->location->state)){

	                          		$locations .= $value->location->state.',';
	                        	}
	                        	if(!empty(@$value->city->location)){

	                          		$locations .= $value->city->location.',';
	                        	}
	                        }
	                      }
	                      $locations = rtrim($locations,',');
	                      $city = rtrim($city,',');


			           		if($row->job_status == 2){ 
		                        $status = 'Rejected';
		                    }else if($row->job_status == 0){  
		                        $status = 'Under Review';
		                    }else{ 
			                  if(strtotime($row->jobStartDate)>strtotime(date("Y-m-d"))){ 
		                      	$status = 'In-active';
		                      }else if(strtotime(date("Y-m-d") >= strtotime($row->jobStartDate)) && strtotime(date("Y-m-d")) <= strtotime(date("d M Y",strtotime("-5 day", strtotime($row->jobExpiryDate))))){ 
		                      	$status = 'Expiring Soon';	                       
		                      }else if(strtotime(date("Y-m-d")) >= strtotime($row->jobStartDate) && strtotime(date("Y-m-d")) <= strtotime($row->jobExpiryDate)){ 
		                      	$status = 'Active';	
		                      }else if(strtotime($row->jobExpiryDate) < strtotime(date("Y-m-d"))){ 
		                      	$status = 'Expired';	
		                      }
		                    } 

			           		$tmp['jobId']              = $row->jobId;
			           		$tmp['jobTitle']           = $row->jobTitle;
			           		$tmp['jobLocation']        = $locations.','.$city;
			           		$tmp['jobVacancy']         = $row->jobVacancy;
			           		//$tmp['jobStatus']        = $status;
			           		$tmp['minSalary']          = $row->minSalary;
			           		$tmp['maxSalary']          = $row->maxSalary;
			           		$tmp['jobStartDate']       = date("d M Y",strtotime($row->jobStartDate));
			           		$tmp['jobExpiryDate']      = date("d M Y",strtotime($row->jobExpiryDate));
			           		$tmp['minExp']         	   = $row->minExp." Year(s)";
			           		$tmp['jobskills']          = $skills;
			           		$tmp['jobType']            = @$row->jobtype->jobtypeName;
			           		$tmp['jobDescription']     = htmlspecialchars_decode($row->jobDescription);
			           		$tmp['jobRole']     	   = htmlspecialchars_decode($row->jobRoleResponsibilities);
			           		$tmp['jobDescription']     = htmlspecialchars_decode($row->jobDescription);
			           		$tmp['jobAppliedStatus']   = ($row->candidateapplied > 0)?'Applied':'Not Applied';
			           		$tmp['jobQualification']   = (!empty(@$row->qualification->qualification))?$row->qualification->qualification:'';
			           		$tmp['companyName']        = (!empty(@$row->employer->employerCompany))?$row->employer->employerCompany:'';
			           		$tmp['companyLogo']        = (!empty(@$row->employer->companyLogo))?STORAGE_PATH.'/companylogo/'.$row->employer->companyLogo:"";
			           		array_push($response, $tmp);
			           }
			       	}

			        $respArr  = array('status' => 200,  'result' => $response);

		        }else{
		        	$respArr  = array('status' => 403,  'msg' => 'Invalid User');
		        }
	        }
            return response()->json($respArr);exit;
        break;


        case "applyJob":
    		$requestData = json_decode(json_encode($data),true); 
        	$AppliedJobModel  = new AppliedJobModel();
	      	$validator   = \Validator::make($requestData, [
              'userId' 		=> 'bail|required|numeric',
              'jobId' 		=> 'bail|required|numeric',
              ],
              [
                'userId.required' => 'User id is required',
                'jobId.required'  =>  'Job id is required'
	      	  ]
	      	);
	      	if ($validator->fails()) {
	      		$errors 	  = $validator->errors();
	      		$respArr      = array('status' => 403, 'msg' => 'Validation error', 'error' => $errors);
	        }else{	
	        	 $applyCount = AppliedJobModel::where('deletedFlag',0)
			       ->where('jobId',$requestData['jobId'])
			       ->where('candidateId',$requestData['userId'])
			       ->count();

			     if($applyCount == 0){

	          	 $AppliedJobModel->jobId = $requestData['jobId'];
			     $AppliedJobModel->candidateId =$requestData['userId']; 
			      if($AppliedJobModel->save()){

			          $jobData = AppliedJobModel::find($AppliedJobModel->appliedJobId);
			          $cname = $jobData->candidateuser->fullName;
			          //echo "<pre>";print_r($jobData->candidatedetail);exit;

			          /********* Send Notification to Candidate *********/
			          $notificationDesc = 'You have successfully applied for '.$jobData->jobdetail->jobTitle;
			          $notificationType = 6; 
			          $notificationFrom = $requestData['userId'];
			          $notificationTo   = $requestData['userId'];
			          $notifycommonId  = $jobData->jobId;
			          sendNotification($notificationDesc,$notificationType,$notificationFrom,$notificationTo,$notifycommonId);

			          /********* Send Notification to Candidate *********/

			          /********* Send Notification to Employer *********/
			          $notificationDesc = $cname.' applied for '.$jobData->jobdetail->jobTitle;
			          $notificationType = 2; 
			          $notificationFrom = $requestData['userId'];
			          $notificationTo   = $jobData->jobdetail->createdBy;
			          $notifycommonId   = $jobData->jobId;
			          sendNotification($notificationDesc,$notificationType,$notificationFrom,$notificationTo,$notifycommonId);

			          /********* Send Notification to Employer *********/
			          $respArr  = array('status' => 200,  'msg' => 'You have successfully applied for this job.');
			      }else{
			      	 $respArr  = array('status' => 403,  'msg' => 'Something went wrong,Please try later.');
			      }
			  }else{
			  	$respArr  = array('status' => 403,  'msg' => 'You have already applied for this job.');
			  }
	        }      	

              return response()->json($respArr);exit;
        break;


        default :
        	$respArr      = array('status' => 404, 'msg' => 'Method not found!!');
            return response()->json($respArr);exit;
        break;

    }
})->middleware('basic_auth');

@extends('layouts.adminlayout')
@section('page-content')

<?php 
  $listEmpDetails = json_decode(json_encode($listEmpDetails),TRUE);
  // echo'<pre>';print_r($listEmpDetails);exit;
?>

<div class="utf-dashboard-content-container-aera" data-simplebar>
  <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
    <div class="row">
      <div class="col-xl-12">
        <h3>Employer Profile</h3>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}/employer/dashboard">Home</a></li>
            <li>Candidate Details</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  @include('components.admin-msg-tap')
  <div class="utf-dashboard-content-inner-aera ">
    <div class="dashboard-box d-flex justify-content-between profile-header">
      <div>
        <!-- <h3 class="mb-2 headline">Candidate Profile</h3> -->
      </div>
      <div class="text-right align-self-end">
        <div class="applicant-no"></div>
        <a href="#!" onclick="history.back();" class="back-btn"><i class="icon-line-awesome-long-arrow-left"></i> Back</a>
      </div>
    </div>
    

    <div class="container">
  <div class="row">
      <div class="col-xl-6">
        <div class="dashboard-box  margin-bottom-30">
          <div class="headline">
            <h3>Personal Details</h3>
          </div>
          <div class="content with-padding personal-details">
            <div class="row">
              <div class="col-xl-3 col-sm-4">
                <div class="utf-avatar-wrapper mb-0">
                  <img class="profile-pic" src="<?php echo STORAGE_PATH; ?>candidateProfile/ <?php if(!empty($listEmpDetails->companyLogo)) {echo $listEmpDetails->companyLogo; } else {echo 'None'; } ?>" alt="" />
                  <!-- <div class="upload-button"></div> -->
                  <!-- <input class="file-upload" type="file" accept="image/*" /> -->
                </div>
              </div>
              <div class="col-xl-9 col-sm-8">
                <div class="utf-submit-field mb-0">
                  <h4 class="profile-name"><?php if(!empty($listEmpDetails['fullname'])) { echo $listEmpDetails['fullname']; }else { echo 'None'; } ?></h4>
                  <p><i class="icon-material-outline-location-on"></i> <?php if(!empty($listEmpDetails['address'])) { echo $listEmpDetails['address']; }else {echo 'None'; } ?> </p>
                  <p>
                    <i class="icon-feather-phone"></i> <?php if(!empty($listEmpDetails['phoneno'])) {echo $listEmpDetails['phoneno']; } else {echo 'None';} ?>
                  </p>
                  <p>
                    <i class="icon-feather-mail"></i><?php if(!empty($listEmpDetails['emailid'])) {echo $listEmpDetails['emailid']; } else {echo 'None';} ?>
                  </p>
                  <p>DOB : {{ (!empty($listEmpDetails['dob']))?date('d M y', strtotime($listEmpDetails['dob'])):''}}</p>
                 
                  <p>Company Logo : <a href="{{!empty($listEmpDetails['companylogo'])?STORAGE_PATH.'candidateProfile/'.$listEmpDetails['companylogo']:''}}" target="_blank"><span class="icon-line-awesome-file-pdf-o"></span> view</a></p>
                </div>
              </div>
            </div>
           
          </div>
        </div>
    </div>
    
      
    <div class="col-xl-6" >
        <div class="dashboard-box  disability-profile">
          <div class="headline">
            <h3> Details </h3>
          </div>
          <div class="content with-padding">
            
            <div class="row">
              <div class="col-md-6 col-lg">
                Designation: 
              </div>
              <div class="col-md-6 col-lg">
                <h4 class="profile-name"><?php if(!empty($listEmpDetails['employerdesignation'])){ echo $listEmpDetails['employerdesignation']; } else { echo 'None'; } ?></h4>
              </div>
              
              </div>

              <div class="row">
                <div class="col-md-6 col-lg">
                  Company: 
                </div>
                <div class="col-md-6 col-lg">
                  <h4 class="profile-name"><?php if(!empty($listEmpDetails['employercompany'])){ echo $listEmpDetails['employercompany']; } else { echo 'None'; } ?></h4>
                </div>
              </div>  

              <div class="row">
                <div class="col-md-6 col-lg">
                  Website: 
                </div>
                <div class="col-md-6 col-lg">
                  <h4 class="profile-name"><?php if(!empty($listEmpDetails['employerwebsite'])){ echo $listEmpDetails['employerwebsite']; } else { echo 'None'; } ?></h4>
                </div>
              </div> 

              <div class="row">
                <div class="col-md-6 col-lg">
                  Location: 
                </div>
                <div class="col-md-6 col-lg">
                  <h4 class="profile-name"><?php if(!empty($listEmpDetails['location'])){ echo $listEmpDetails['location']; } else { echo 'None'; } ?></h4>
                </div>
              </div> 

              <div class="row">
                <div class="col-md-6 col-lg">
                  Employer Skill: 
                </div>
                <div class="col-md-6 col-lg">
                  <h4 class="profile-name"><?php if(!empty($skills)){ echo $skills; } else { echo 'None'; } ?></h4>
                </div>
              </div> 

              <div class="row">
                <div class="col-md-6 col-lg">
                  Company Size: 
                </div>
                <div class="col-md-6 col-lg">
                  <h4 class="profile-name"><?php if(!empty($listEmpDetails['employersize'])){ echo $listEmpDetails['employersize']; } else { echo 'None'; } ?></h4>
                </div>
              </div> 

              

              <div class="row">
                <div class="col-md-6 col-lg">
                Employer Industry: 
                </div>
                <div class="col-md-6 col-lg">
                  <h4 class="profile-name"><?php if(!empty($listEmpDetails['industryName'])){ echo $listEmpDetails['industryName']; } else { echo 'None'; } ?></h4>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 col-lg">
                   Pan Number: 
                </div>
                <div class="col-md-6 col-lg">
                  <h4 class="profile-name"><?php if(!empty($listEmpDetails['employerpannumber'])){ echo $listEmpDetails['employerpannumber']; } else { echo 'None'; } ?></h4>
                </div>
              </div>

              

              

              <div class="row">
                <div class="col-md-6 col-lg">
                   Company Address: 
                </div>
                <div class="col-md-6 col-lg">
                  <h4 class="profile-name"><?php if(!empty($listEmpDetails['employercompanyaddr'])){ echo $listEmpDetails['employercompanyaddr']; } else { echo 'None'; } ?></h4>
                </div>
              </div>

              

              <div class="row">
                <div class="col-md-6 col-lg">
                  Approval Status: 
                </div>
                @if(!empty($listEmpDetails['approvestatus']))
                <div class="col-md-6 col-lg">
                  <h4 class="profile-name"><?php 
                    if($listEmpDetails['approvestatus'] == 0){ 
                        echo 'Applied'; 
                    } elseif($listEmpDetails['approvestatus'] == 1) { 
                        echo 'Shortlisted'; 
                    } elseif($listEmpDetails['approvestatus'] == 2) {
                        echo 'Onhold'; 
                    } elseif($listEmpDetails['approvestatus'] == 3){
                        echo 'Selected'; 
                    } elseif($listEmpDetails['approvestatus'] == 4){
                      echo 'Rejected';
                    } else {
                      echo ' -- ';
                    }
                    ?>
                  </h4>
                </div>
                @endif
              </div>

              <div class="row">
                <div class="col-md-6 col-lg">
                  Approval Time: 
                </div>
                <div class="col-md-6 col-lg">
                  <h4 class="profile-name"><?php if(!empty($listEmpDetails['approvaltime'])){ echo date('d M y', strtotime($listEmpDetails['approvaltime'])); } else { echo 'None'; } ?></h4>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
  </div>
    <!-- Footer -->
  </div>
</div>

@endsection
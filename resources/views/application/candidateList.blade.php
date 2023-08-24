@extends('layouts.adminlayout')
@section('page-content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- View Skill -->
  <style>
    #excelsheet:hover {
      font-size: 107%;
    }
  </style>
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Candidate List</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>    
              <li>Candidate List</li>
              <!-- <li> <a class="btn btn-warning" id="excelsheet" target="_blank" href="http://localhost:7001/the-say-foundation/application/candidate/exportCandidates" title="Export"><i class='far fa-file-excel fa-2x'></i></a> -->
              <li> <a class="btn btn-warning" id="excelsheet" target="_blank" href="{{ APP_URL. 'candidate/exportCandidates'}}" title="Export"><i class='fas fa-file-excel fa-2x'></i></a>
        </li>
            </ul>
          </nav>
        </div>
      </div>    
    </div>
    @include('components.admin-msg-tap')
    <!-- Page Content -->
    <div class="utf-dashboard-content-inner-aera"> 
      <div class="row">        
      </div>
      <form id="listForm" method="post" enctype="multipart/form-data" novalidate>
   {{ csrf_field() }}
      <div class="row">
      <div class="col-xl-12">
        <div class="utf_dashboard_list_box table-responsive recent_booking dashboard-box">
        <div class="dashboard-list-box table-responsive invoices with-icons">
         <table class="table table-hover">
          <thead>
            <tr>           
            <th class="width-80">Sl No.</th>
            <th> Name </th>
            <th> Email </th>
            <th> Phone </th>
            <th> DOB </th>
            <!-- <th> Company Name </th>      -->
            <th> Date of registration </th>     
            <th> Download CV </th>     
            <th> Download Certificate </th>     
            <th class="text-center width-100">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if(count($userList) > 0){            
            if($startrec==1){             
              $ctr = $userList->firstItem();       
            }elseif($startrec==2){
              $ctr = 1;
             }
            foreach ($userList as $row){ ?>
            <tr>         
            <?php 
              // echo'<pre>';print_r($row);exit;
            
            ?>
              <td>{{ $ctr }}</td>
              <td>{{$row->fullName}}</td>
              <td>{{$row->emailId}}</td>
              <td>{{$row->mobileNo}}</td>             
              <td>{{ (!empty($row->DOB))?date('d M y', strtotime($row->DOB)):'--'}}</td>
              <td>{{ (!empty($row->createdOn))?date('d M y', strtotime($row->createdOn)):'--'}}</td>
              <!-- <td>{{ (!empty($row->companyName))?$row->companyName:'--'}}</td> -->
              <td class="text-center">
			  <?php if(!empty($row->profileCV)){ ?>
                <a href="<?php echo STORAGE_PATH.'candidateProfile/'.$row->profileCV; ?>" target="_blank"  class="btn btn-primary btn-xs" style="position: relative;top: 4px;"> <i class="fa-solid fa-circle-down"></i> </a>
			  <?php } else { ?>
			   <a href="javascript:void(0);" class="btn btn-primary btn-xs" style="position: relative;top: 4px;"> <i class="fa-solid fa-circle-down"></i> </a>
			  <?php } ?>
              </td> 
              <td class="text-center">
                <a href="<?php echo ROOT_URL.'/downloadCv/' . encrypt($row->userId); ?>"   class="btn btn-primary btn-xs" style="position: relative;top: 4px;"> <i class="fa-solid fa-circle-down"></i>  </a>
              </td>             
                   
              <td class="text-center"><a href="<?php echo ROOT_URL.'/application/Candidate/candidateDetails/'.encrypt($row->userId)?>" class="btn btn-primary btn-xs" style="position: relative;top: 4px;">View</a></td>  
            </tr>
          <?php $ctr++ ;
        } } else { ?>
            <tr><td colspan="4">No Record Found</td></tr>
        <?php } ?>
          </tbody>
          </table>
        </div>
        <?php if (count($userList) > 0) { ?>
          <input name="hdn_IsViewAll" id="hdn_IsViewAll" type="hidden">
              <?php
              if(count($userList) > 0) {
                  paginataion($userList,$startrec); 
                  }
              } 
              ?>            
        </div>
      </div>
    </div>
      <input type="hidden" name="hdnAction" id="hdnAction" value="">
    <input type="hidden" name="hdnIDs" id="hdnIDs" value=""> 
   </form>    
        @include('includes.application.footer') 
  </div>    
</div>    
</div>
@include('components.admin-alert-modal')
@section('page-js')

@endsection
@endsection

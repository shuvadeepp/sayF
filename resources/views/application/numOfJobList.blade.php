@extends('layouts.adminlayout')
@section('page-content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- View Skill -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Job Lists</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>             
              <li> Job Lists</li>
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
            <th> job Title                      </th>
            <th> job Location                   </th>
            <th> job Vacancy                    </th>
            <th> job Description                </th>
            <th> job Role Responsibilities      </th>     
            <th> Minimum Exp                    </th>     
            <th> Min Salary                     </th>     
            <th> Max Salary                     </th>    
            <th> Company Details                </th>     
            <th> job Start Date                 </th>     
            <th> job Expiry Date                </th>     
            <!-- <th class="text-center width-100">Action</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            // echo'<pre>';print_R($numOfJobQuery);exit;
            $startrec = '';
            $ctr = '';
            if(count($numOfJobQuery) > 0){            
            if($startrec==1){             
              $ctr = $numOfJobQuery->firstItem();       
            }elseif($startrec==2){
              $ctr = 0;
             }
            foreach ($numOfJobQuery as $row){ ?>
            <tr>         
            <?php 
              // echo'<pre>';print_r($row);exit;
            
            ?>
              <td style="font-weight: bold;"> {{ ++$ctr }} </td>
              <td>{{ (!empty($row->jobTitle))?$row->jobTitle:'--'}}</td>
              <td>{{ (!empty($row->jobLocation))?$row->jobLocation:'--'}}</td>
              <td>{{ (!empty($row->jobVacancy))?$row->jobVacancy:'--'}}</td>
              <td>{{ (!empty($row->jobDescription))?strip_tags(htmlspecialchars_decode($row->jobDescription)):'--'}}</td>
              <td>{{ (!empty($row->jobRoleResponsibilities))?strip_tags(htmlspecialchars_decode($row->jobRoleResponsibilities)):'--'}}</td>
              <td>{{ (!empty($row->minExp))?$row->minExp:'--'}}</td>
              <td>{{ (!empty($row->minSalary))?$row->minSalary:'--'}}</td>
              <td>{{ (!empty($row->maxSalary))?$row->maxSalary:'--'}}</td>
              <td>{{ (!empty($row->companyDetails))?strip_tags(htmlspecialchars_decode($row->companyDetails)): '--'}}</td>
              <td>{{ (!empty($row->jobStartDate))?$row->jobStartDate:'--'}}</td>
              <td>{{ (!empty($row->jobExpiryDate))?$row->jobExpiryDate:'--'}}</td>
                         
                   
              
            </tr>
          <?php //$ctr++ ;
        } } else { ?>
            <tr><td colspan="4">No Record Found</td></tr>
        <?php } ?>
          </tbody>
          </table>
        </div>
        <?php if (count($numOfJobQuery) > 0) { ?>
          <input name="hdn_IsViewAll" id="hdn_IsViewAll" type="hidden">
              <?php
              if(count($numOfJobQuery) > 0) {
                  paginataion($numOfJobQuery,$startrec); 
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

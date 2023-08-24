@extends('layouts.candidatelayout')
@section('page-content')
  
  <!-- Job Status -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Job Status</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/candidate/dashboard">Home</a></li>
              <li>Job Status</li>
            </ul>
          </nav>
        </div>
      </div>    
    </div>

    <!-- Page Content -->
    <div class="utf-dashboard-content-inner-aera"> 
      <form id="listForm" method="post" enctype="multipart/form-data" novalidate>
        {{csrf_field()}}
      <div class="row">
      <div class="col-xl-12">
        <div class="utf_dashboard_list_box table-responsive recent_booking dashboard-box">
        <div class="dashboard-list-box table-responsive invoices with-icons">
          <table class="table table-hover">
          <thead>
            <tr>
            <th>sl #</th>
            <th>Job Title</th>
            <th>Company Name</th>
            <th>Job Applied On</th>
            <th>Location</th>
            <th>Status</th>
            <th>View Job Details</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($startrec==1){
              $ctr = $jobStatus->firstItem();
            }elseif($startrec==2){
              $ctr = 1;
             }
            if($jobStatus->isNotEmpty()){
            foreach ($jobStatus as $row){ 
              // if($row->status==0){
              //   $status='Applied';
              //   $styleCls="badge-primary";
              // }else if($row->status==1){                
              //   $status='Shortlisted';
              //   $styleCls="badge-danger";
              // }else if($row->status==2){
              //   $status='Onhold';
              //   $styleCls="badge-danger";
              // }else if($row->status==3){
              //   $status='Selected';
              //   $styleCls="badge-primary";
              // }else if($row->status==4){
              //   $status='Rejected';
              //   $styleCls="badge-canceled";
              // }
              ?>
            <tr>
            <td>{{$ctr}}</td>
            <td>{{$row->jobTitle}}</td>
            <td>{{$row->employerCompany}}</td>
            <td>{{date('d M Y',strtotime($row->appliedDate))}}</td>
            <td>{{$row->jobLocation}}</td>
            <td>
           
            <?php if($row->status == 0){ ?>
                <span class="badge btn btn-default">Applied</span>
                <?php }else if($row->status == 1){ ?>
                <span class="badge btn btn-primary ">Shortlisted</span>
                <?php }else if($row->status == 2){ ?>
                <span class="badge btn btn-info ">On Hold</span>
                <?php }else if($row->status == 3){ ?>
                <span class="badge btn btn-secondary ">Selected</span>
                <?php }else if($row->status == 4){ ?>
                <span class="badge btn btn-danger ">Rejected</span>
                <?php } ?>
              </td> 
            <td><a href="{{ROOT_URL}}/candidate/jobstatus/jobpreview/{{encrypt($row->jobId)}}" class="button gray"><i class="icon-feather-eye"></i> View Detail</a></td>
            </tr>
            <?php $ctr++ ;}} else{ echo '<tr><td colspan="7" align="center">Sorry !!! No Record Found.</td></tr>';} ?>
          </tbody>
          </table>
        </div>
        <?php if (count($jobStatus) > 0) { ?>
          <input name="hdn_IsViewAll" id="hdn_IsViewAll" type="hidden">
              <?php
              if(count($jobStatus) > 0) {
                  paginataion($jobStatus,$startrec); 
                  }
              }
              ?>
        </div>
      </div>
    </div>
  </form>
      </div>
    <!-- Page Content ends -->
  </div>    
</div>
@section('page-js')
  <script
>
   $(document ).ready(function() {
     var userid='<?php echo SESSION('candidate_session_data.userId');?>';
    loadnotifiation(userid,2);
    });

</script>
@endsection
@endsection

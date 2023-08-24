@extends('layouts.adminlayout')
@section('page-content')
  
  <!-- View Category -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>View Job Type</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
              <li>Manage Master</li>
              <li>View Job Type</li>
            </ul>
          </nav>
        </div>
      </div>    
    </div>
    @include('components.admin-msg-tap')
    <!-- Page Content -->
    <div class="utf-dashboard-content-inner-aera"> 
      <div class="row"> 
        <div class="col-xl-12">
          <div class="mb-2">
            <a href="<?php echo ROOT_URL.'/application/master/jobtype/add/'?>" class="button utf-ripple-effect-dark">Add Job Type</a>      
          </div>
        </div>
      </div>
      <form id="listForm" method="post" enctype="multipart/form-data" novalidate>
      {{csrf_field()}}
         @include('components.publishUnpublish')
      <div class="row">
      <div class="col-xl-12">
        <div class="utf_dashboard_list_box table-responsive recent_booking dashboard-box">
        <div class="dashboard-list-box table-responsive invoices with-icons">
          <table class="table table-hover">
          <thead>
            <tr>
            <th  class="width-50">
<input type="checkbox" name="" id="chkAll" value="" class="mb-0 chkAll"></th>
            <th  class="width-80">
Sl No.</th>
            <th>Job Type Name</th>
            <th class="text-center width-100">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($startrec==1){
              $ctr = $arrAllRecords->firstItem();
            }elseif($startrec==2){
              $ctr = 1;
             }
               $ctr=1;
             if(!empty($arrAllRecords)){
            foreach ($arrAllRecords as $row){ ?>
            <tr <?php if($row->publishStatus==1){ ?>class="unpublish" <?php }else {?>class="publish"<?php } ?>>
              <td><input type="checkbox" name="chkItem[]" class="mb-0 chkItem" value="{{$row->jobtypeId}}"></td>
              <td>{{$ctr}}</td>
              <td>{{$row->jobtypeName}}</td>
              <td class="text-center"><a href="<?php echo ROOT_URL.'/application/master/jobtype/add/'.encrypt($row->jobtypeId)?>" class="btn btn-primary btn-xs" style="position: relative;top: 4px;">Edit</a></td>
            </tr>
          <?php $ctr++ ;} } ?>
          </tbody>
          </table>
        </div>
        <?php  if (count($arrAllRecords) > 0) { ?>
          <input name="hdn_IsViewAll" id="hdn_IsViewAll" type="hidden">
              <?php
              if(count($arrAllRecords) > 0) {
                  paginataion($arrAllRecords,$startrec); 
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
<script
>
  $(document).ready(function(){
    $('#btnConfirmModalOK').on('click',function(){
        $('#listForm').submit();
    });
  });
</script>
@endsection
@endsection

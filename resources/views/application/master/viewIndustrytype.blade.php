@extends('layouts.adminlayout')
@section('page-content')
  
  <!-- View Industry Type -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>View Industry Type</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
              <li>Manage Master</li>
              <li>View Industry Type</li>
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
            <a href="<?php echo ROOT_URL.'/application/master/industry/add/'?>" class="button utf-ripple-effect-dark">Add Industry Type</a>      
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
            <th  width="70">Sl No.</th>
            <th>Industry type Name</th>
            <th  width="100" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($startrec==1){
              $ctr = $arrAllRecords->firstItem();
            }elseif($startrec==2){
              $ctr = 1;
             }
            if($arrAllRecords->isNotEmpty()){
            foreach ($arrAllRecords as $row){ ?>
             <tr  <?php if($row->publishStatus==1){ ?>class="unpublish" <?php }else {?>class="publish"<?php } ?>>
              <td><input type="checkbox" name="chkItem[]" class="mb-0 chkItem" value="{{$row->industryId}}"></td>
              <td>{{$ctr}}</td>
              <td>{{$row->industryName}}</td>
              <td class="text-center"><a href="<?php echo ROOT_URL.'/application/master/industry/add/'.encrypt($row->industryId)?>" class="btn btn-primary btn-xs" style="position: relative;top: 4px;">Edit</a></td>
            </tr>
          <?php $ctr++ ;}} else { echo '<tr><td colspan="3" align="center">Sorry !!! No Record Found.</td></tr>';}  ?>
          </tbody>
          </table>
        </div>
        <?php if (count($arrAllRecords) > 0) { ?>
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


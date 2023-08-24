@extends('layouts.adminlayout')
@section('page-content')
  
  <!-- View Category -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>View Category</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="javascript:void(0);">Home</a></li>
              <li>Manage Master</li>
              <li>View Category</li>
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
            <a href="<?php echo ROOT_URL.'/application/master/category/add/'?>" class="button utf-ripple-effect-dark">Add Category</a>      
          </div>
        </div>
      </div>
      <form id="listForm" method="post" enctype="multipart/form-data" novalidate>
      {{csrf_field()}}
        @include('components.publishUnpublish')
   
      <!--   <div class="row mb-4"> 
        <div class="col-xl-12">
          <a href="javascript:void(0)" class="btn btn-info"  onclick="return update_multiple_status('P');">Publish</a>
          <a href="javascript:void(0)" class="btn btn-danger ml-2" onclick="return update_multiple_status('UP');">Unpublish</a>
        </div>          
      </div> -->
      <div class="row">
      <div class="col-xl-12">
        <div class="utf_dashboard_list_box table-responsive recent_booking dashboard-box">
        <div class="dashboard-list-box table-responsive invoices with-icons">
          <table class="table table-hover">
          <thead>
            <tr>
            <th><input type="checkbox" name="" id="chkAll" value="" class="mb-0 chkAll"></th>
            <th>Sl No.</th>
            <th>Category Name</th>
            <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($startrec==1){
              $ctr = $arrAllRecords->firstItem();
            }elseif($startrec==2){
              $ctr = 1;
             }
            foreach ($arrAllRecords as $row){ ?>
            <tr <?php if($row->publishStatus==1){ ?>class="unpublish" <?php }else {?>class="publish"<?php } ?>>
               <td><input type="checkbox" name="chkItem[]" class="mb-0 chkItem" value="{{$row->categoryId}}"></td>
              <td>{{$ctr}}</td>
              <td>{{$row->categoryName}}</td>
              <td><a href="<?php echo ROOT_URL.'/application/master/category/add/'.encrypt($row->categoryId)?>" class="btn btn-primary btn-xs" style="position: relative;top: 4px;">Edit</a>
              <a data-target="#confirmAlertModal" data-toggle="modal" class="btn btn-danger btn-xs" onclick="return deleteIndividual({{$row->categoryId}});" style="position: relative;top: 4px;">Delete</a>
              </td>
            </tr>
          <?php $ctr++ ;} ?>
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

       
       
        
        <!-- Footer -->
         @include('includes.application.footer') 
    <!-- Page Content ends -->
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

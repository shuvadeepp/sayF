@extends('layouts.adminlayout')
@section('page-content')
<!-- View Banner -->
<?php $pageArrr = array('0'=>'','1'=>'Home','2'=>'About us','3'=>'Employers','4'=>'NGO-and-communities','5'=>'Persons with Disabilitie','6'=>'Policy advocacy','8'=>'Donate','9'=>'Volunteer','10'=>'Resource','11'=>'Connect','12'=>'Explore job','13'=>'Gallery', '14'=>'LetsSay-OurBlogs','15'=>'Press Release','16'=>'Job Details','17'=>'Blog Details','18'=>'User Login','19'=>'Register','20'=>'Forget Password'); ?>
<div class="utf-dashboard-content-container-aera" data-simplebar>
   <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
         <div class="col-xl-12">
            <h3>View Resource</h3>
            <nav id="breadcrumbs">
               <ul>
                  <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
                  <li>Manage Master</li>
                  <li>View Resource</li>
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
               <a href="<?php echo ROOT_URL.'/application/master/Resource/add/'?>" class="button utf-ripple-effect-dark">Add Resource</a>      
            </div>
         </div>
      </div>
      <?php //echo'<pre>';print_r($arrAllRecords);exit;?>
      <form id="listForm" method="post"  enctype="multipart/form-data">
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
                                 <input type="checkbox" name="" id="chkAll" value="" class="mb-0 chkAll">
                              </th>
                              <th  class="width-80">
                                 Sl No.
                              </th>
                              <th>Document Name</th>
                              <th>Document File/ Links</th>
                              <th>Document Type</th>
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
                          if($arrAllRecords->isNotEmpty()) {
                          foreach ($arrAllRecords as $row) { 
                           // echo'<pre>';print_r($row);exit;
                        ?>
                        <tr <?php if($row->publishStatus==1){ ?>class="unpublish" <?php }else {?>class="publish"<?php } ?>>
                          <td><input type="checkbox" name="chkItem[]" class="mb-0 chkItem" value="{{$row->resourceId}}"></td>
                          <td>{{ $ctr }}</td>
                          <td>{{ $row->docName }}</td>
                          <td>{{ !empty($row->docType == 1) ? $row->docFile : $row->resourceUrl}}</td>
                          <td>{{ !empty($row->docType == 1) ? "Documents & Reprots" : "Websites & Social Media" }}</td>
                          <td class="text-center"><a href="<?php echo ROOT_URL.'/application/master/Resource/add/'.encrypt($row->resourceId)?>" class="btn btn-primary btn-xs" style="position: relative;top: 4px;">Edit</a></td>
                        </tr>
                        <?php $ctr++ ;} } else{ echo '<tr><td colspan="7" align="center">Sorry !!! No Record Found.</td></tr>';}?>
                        </tbody>
                     </table>
                  </div>
                  <!-- Pagination Code -->
                  <?php if (count($arrAllRecords) > 0) { ?>
                    <input name="hdn_IsViewAll" id="hdn_IsViewAll" type="hidden">
                  <?php
                    if(count($arrAllRecords) > 0) {
                        paginataion($arrAllRecords,$startrec); 
                        }
                    }
                  ?>
                  <!-- Pagination Code -->
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
<script>
  $(document).ready(function(){
    $('#btnConfirmModalOK').on('click',function(){
        $('#listForm').submit();
    });
  });
</script>
@endsection
@endsection
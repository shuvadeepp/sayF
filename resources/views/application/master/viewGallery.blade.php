@extends('layouts.adminlayout')
@section('page-content')
  
  <!-- View gallery -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>View Gallery</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
              <li>Manage Master</li>
              <li>View Gallery</li>
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
            <a href="<?php echo ROOT_URL.'/application/master/gallery/add/'?>" class="button utf-ripple-effect-dark">Add Gallery</a> 

          </div>
        </div>
      </div>
      <form id="listForm" method="post"  enctype="multipart/form-data">
      {{csrf_field()}}
         @include('components.publishUnpublish')
      <div class="row">      
      <div class="col-xl-12"> 
        <a href="javascript:void(0)" class="btn btn-sm next-btn utf-ripple-effect-dark" onclick="return update_sequence('USEQ');"> Update Sequence </a>
        <div class="utf_dashboard_list_box table-responsive recent_booking dashboard-box mt-3">
        <div class="dashboard-list-box table-responsive invoices with-icons">
          <table class="table table-hover">
          <thead>
            <tr>
              <th  class="width-50">
              <input type="checkbox" name="" id="chkAll" value="" class="mb-0 chkAll"></th>
              <th  class="width-80">Sl No.</th>
              <th class="width-100">Sequence</th>
              <th>Caption</th>
              <th>Media Type</th>
              <th>Image / Youtube Link</th>
              <th>Publish Date</th>
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
            if($arrAllRecords->isNotEmpty()){
            foreach ($arrAllRecords as $row){ ?>
            <tr <?php if($row->publishStatus==1){ ?>class="unpublish" <?php }else {?>class="publish"<?php } ?>>
              <td><input type="checkbox" name="chkItem[]" class="mb-0 chkItem" value="{{$row->galleryId}}"></td>
              <td>{{$ctr}}</td>
              <td><input type="text" name="seq[{{$row->galleryId}}]" class="mb-0 utf-with-border seq" onkeypress="return isNumberKey(event);" value="{{$row->sequence}}"></td>
              <td>{{$row->caption}}</td>
              <td>{{$row->type}}</td>
              <td>
                <?php if($row->type == 'Photo'){ ?> <img width="100" src="<?php if(!empty($row->galleryImage)){ echo ROOT_URL.'/storage/app/uploads/gallery/'.$row->galleryImage; }else{ echo PUBLIC_PATH.'images/video-img.png'; } ?>" alt="{{$row->caption}}">
                <?php }else{ ?>
                  <a target="_blank" href="https://www.youtube.com/embed/<?php echo $row->url; ?>">
                    <img width="100" src="https://img.youtube.com/vi/<?php echo $row->url; ?>/0.jpg" alt="<?php echo $row->caption; ?>"><!-- 
                    <img width="20" src="<?php echo PUBLIC_PATH; ?>images/video-play.png" class="play-icon" alt="<?php echo $row->caption; ?>"> -->
                  </a>
                <?php } ?>
              </td>
              <td>{{date('d M Y',strtotime($row->createdOn))}}</td>
              <td class="text-center"><a href="<?php echo ROOT_URL.'/application/master/gallery/add/'.encrypt($row->galleryId)?>" class="btn btn-primary btn-xs" style="position: relative;top: 4px;">Edit</a></td>
             
            </tr>
          <?php $ctr++ ;} } else{ echo '<tr><td colspan="7" align="center">Sorry !!! No Record Found.</td></tr>';}?>
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
<script>
  $(document).ready(function(){
    $('#btnConfirmModalOK').on('click',function(){
        $('#listForm').submit();
    });
  });
  function update_sequence(action){
    var cnt = 0;
    $('.seq').each(function(){
      if($(this).val()!=''){
         cnt++;        
      }
    });
    if(cnt>0){
      confirmAlert('Are you sure to update the sequence of selected record(s)');
      $("#hdnAction").val(action);
    }else{
      viewAlert('Please enter the sequence number');
      return false;
    } 
  }
</script>
@endsection
@endsection
@extends('layouts.adminlayout')
@section('page-content')
  
  <!-- Add Category -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Add Category</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
              <li>Manage Master</li>
              <li>Add Category</li>
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
          <a href="<?php echo ROOT_URL.'/application/master/category'?>" class="button utf-ripple-effect-dark">View Category</a>      
        </div>
      </div>
      
      <div class="col-xl-12">
        <form method="post" id="listform" enctype="multipart/form-data">
          {{csrf_field()}}
            <div class="dashboard-box"> 
              <div class="content with-padding padding-bottom-10">
                <div class="row">
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Category Name</h5>
                      <input type="text" class="utf-with-border" placeholder="Category Name" name="txtCategory" id="txtCategory" value="{{!empty($editCatDetail['categoryName'])?(!empty(old('txtCategory')))?old('txtCategory'):$editCatDetail['categoryName']:old('txtCategory')}}">
                      <span class="errMsg_txtCategory errDiv"></span>
                    </div>
                  </div>

        
                </div>
              <div class="utf-centered-button">
                <a href="javascript:void(0);" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0" type="submit" onclick="return validator();">{{$buttonVal}}<i class="icon-feather-plus"></i></a>  
              </div>
              </div>        
            </div>
            </form>
          </div>  
        </div>
        
        <!-- Footer -->
        @include('includes.application.footer') 
    <!-- Page Content ends -->
  </div>    
</div>
@section('page-js')
<script
>
   function validator()
  {
      $('.errDiv').hide();
      if (!blankCheck('txtCategory', 'Catagory can not be left blank'))
          return false;

      $('#listform').submit();  
        
  }
</script>
@endsection
@endsection


@extends('layouts.adminlayout')
@section('page-content')
  
  <!-- Add Qualification Sub category -->
  <div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>{{$tabTxt}} Qualification Sub category</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="javascript:void(0);">Home</a></li>
              <li>Manage Master</li>
              <li>{{$tabTxt}} Qualification Sub category</li>
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
          <a href="<?php echo ROOT_URL.'/application/master/qualificationsubcategory'?>" class="button utf-ripple-effect-dark">View Qualification Sub category</a>      
        </div>
      </div>
      
      <div class="col-xl-12">
        <form method="post" id="listform">
          {{csrf_field()}}
            <div class="dashboard-box"> 
              <div class="content with-padding padding-bottom-10">
                <div class="row">
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Qualification</h5>
                      <select class="utf-with-border" name="selQualification" id="selQualification">
                        <option value="">--Select--</option>
                        <?php foreach($qualification as $quali){
                          if(!empty($editSubcategory['qualificationId'])){
                            if(!empty(old('selQualification'))){
                              $selectId=old('selQualification');
                            }else{
                              $selectId=$editSubcategory['qualificationId'];
                            }
                          }else{
                            $selectId=old('selQualification');
                          }
                          ?>
                          <option value="{{$quali->qualificationId}}" <?php if($selectId==$quali->qualificationId){ echo "selected";}?>>{{$quali->qualification}}</option>
                          
                        <?php }?>
                      </select>
                      <span class="errMsg_selQualification errDiv"></span>
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="utf-submit-field">
                      <h5>Sub Category</h5>
                      <input type="text" class="utf-with-border" placeholder="Sub Category Name" name="txtSubcategory" id="txtSubcategory" value="{{!empty($editSubcategory['subcategoryName'])?(!empty(old('txtSubcategory')))?old('txtSubcategory'):$editSubcategory['subcategoryName']:old('txtSubcategory')}}">
                      <span class="errMsg_txtSubcategory errDiv"></span>
                    </div>
                  </div>

        
                </div>
              <div class="utf-centered-button">
                <a href="javascript:void(0);" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0" type="submit" onclick="return validator();">{{$tabTxt}} Sub Category<i class="icon-feather-plus"></i></a>  
              </div>
              </div>        
            </div>
            </form>
          </div>  
        </div>
        
        <!-- Footer -->
        @include('includes.application.footer')       
      </div>
    <!-- Page Content ends -->
  </div>    
</div>
@section('page-js')
<script
>
  $(document).ready(function(){

  });
  function validator()
  {
      $('.errDiv').hide();
      $('.error-input').removeClass('error-input');
      if (!selectDropdown('selQualification', 'Please Select Qualification'))
          return false;

      if (!blankCheck('txtSubcategory', 'Qualification Subcategory can not be left blank'))
          return false;  

      $('#listform').submit();  
        
  }
</script>
@endsection
@endsection


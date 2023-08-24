  @extends('layouts.employerlayout')
  @section('page-content')
  <!-- Dashboard Container -->
  <!-- <div class="utf-dashboard-container-aera">  -->
  <!-- Dashboard Content -->

  <div class="utf-dashboard-content-container-aera" data-simplebar>
      <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
        <div class="row">
          <div class="col-xl-12"> 
            <h3>Candidate Applied({{count($appliedJob)}})</h3>
            <nav id="breadcrumbs">
              <ul>
                <li><a href="javascript:void(0);">Home</a></li>
                <li>Candidate Applied</li>
              </ul>
            </nav>
          </div>
        </div>    
      </div>
    <div class="utf-dashboard-content-inner-aera"> 

      @include('components.admin-msg-tap') 

      <div class="dashboard-box d-flex justify-content-between profile-header">
        <div>
          <p class="mb-2">Candidate Profile for</p>
          <h2 class="profile-header-heading mb-2">
            {{$jobData->jobTitle}} [{{$jobData->jobtype->jobtypeName}}]
          </h2>
          <?php
            $locations = '';
            if(!empty($jobData->joblocations)){
              foreach ($jobData->joblocations as $key => $value) {
                $locations .= $value->location->location.',';
              }
            }
            $locations = rtrim($locations,',');
          ?>
          <span class="profile-header-location">{{$locations}}</span>
        </div>
        <div class="text-right align-self-end">
          <div class="applicant-no ">{{count($appliedJob)}} Applicants</div>
        </div>
      </div> 
      <form method="post" id="frmTCP" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row mb-6"> 
          <div class="col-xl-12" style="text-align: right;">
            <a href="javascript:void(0)" class="btn btn-secondary"  onclick="return updateappliedjobs(1);">Shortlist</a>
            <a href="javascript:void(0)" class="btn btn-info ml-2"  onclick="return updateappliedjobs(2);">On hold</a>
            <a href="javascript:void(0)" class="btn btn-danger ml-2" onclick="return updateappliedjobs(4);">Reject</a>
              
          </div>       
        </div>
        <div class="row mb-6">
        <input class="form-check-input" type="checkbox" name="filterSign" id="filterSign" value="1" <?php if(isset($filterData) && $filterData == 1) echo 'checked'; ?>>&nbsp;&nbsp;
            <label for="filterSign">Filter By Sign Medium</label>
            <button type="submit" class="btn btn-xs btn-primary ml-2" name="filterSignMedium" id="filterSignMedium">Search</button>
        </div>

        <div class="row">
          <div class="col-xl-12">
            <div class="utf_dashboard_list_box table-responsive recent_booking dashboard-box">
            <div class="dashboard-list-box table-responsive invoices with-icons">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th><input type="checkbox" name="" id="chkAll" value="" class="mb-0 chkAll"></th>
                    <th>Candidate</th>
                    <th>Name</th>
                    <th>Applied Date</th>
                    <th>Total Experience</th>
                    <th>Status</th>
                    <th>Download CV </th>
                    <th>Download Cartificate </th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                   if(count($appliedJob) > 0 && $filterData == 0){
                      foreach ($appliedJob as $row){             
                  ?>
                  <tr>
                    <td><input type="checkbox" name="chkItem[]" class="mb-0 chkItem" value="{{$row->appliedJobId}}"></td>
                    <td><img alt="" class="img-fluid rounded-circle shadow-lg" src="<?php echo STORAGE_PATH; ?>candidateProfile/{{  $row->candidatedetail->profileImage }}" width="50" height="50" data-tippy-placement="top" title="John Williams" data-tippy=""></td>
                    <td>
                      {{ $row->candidatedetail->firstName }} {{ $row->candidatedetail->middleName }} {{ $row->candidatedetail->lastName }}
                      <br/>
                       {{ $row->candidateuser->mobileNo }}l 
                      <br/>
                       {{ $row->candidateuser->emailId }}
                    </td>
                    <td> {{ date("d M Y",strtotime($row->createdOn)) }}</td>
                    <td> {{$row->candidatedetail->experience}} yr(s)</td>
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
                    <?php if(!empty($row->candidatedetail->profileCV)){ ?>
                     <td><a href="{{ROOT_URL.'/storage/app/uploads/candidateProfile/'.$row->candidatedetail->profileCV}}" target="_blank" class="button gray"> Download </a></td>
                     <?php } else { ?>
                      <td><a href="javascript:void(0);"  class="button gray"> Not Available </a></td>
                      <?php } ?>
                     <td><a href="<?php echo ROOT_URL.'/downloadCv/' . encrypt($row->candidateId); ?>" class="button gray"> Download </a></td>
                     <!-- <td><input type="button" name="download" value="Download" onclick="return download();" class="button gray" /></td> -->
                    <td><a href="{{ROOT_URL}}/employer/job/candidatedetails/{{ $row->appliedJobId }}" class="button gray"><i class="icon-feather-eye"></i> View Detail</a></td>
                  </tr>
                <?php }  ?>
                <?php // ! Added in candidateapplied page Filter Sign Medium checkbox for filtering. (21-06-2023) ?>
                <?php } else if(count($appliedJob) > 0 && $filterData == '1') { ?>
                  <?php $appliedJob = json_decode(json_encode($appliedJob), true); ?>
                    @foreach($appliedJob as $filterRows)
                  <tr>
                      <td>
                      <input type="checkbox" name="chkItem[]" class="mb-0 chkItem" value="{{$filterRows["appliedJobId"]}}"></td>
                      </td>

                      <td>
                        <img alt="" class="img-fluid rounded-circle shadow-lg" src="<?php echo STORAGE_PATH; ?>candidateProfile/{{  $filterRows["profileImage"] }}" width="50" height="50" data-tippy-placement="top" title="John Williams" data-tippy="">
                      </td>

                      <td>
                          {{ $filterRows["firstName"] }} {{ $filterRows["middleName"] }}  {{ $filterRows["lastName"] }}
                        <br/>
                          {{ $filterRows["mobileNo"] }}
                        <br/>
                          {{ $filterRows["emailId"] }}
                      </td>

                      <td> {{ date("d M Y",strtotime($filterRows["createdOn"])) }} </td>
                      <td> {{ $filterRows["experience"] }} yr(s) </td>

                      <td>
                        <?php if($filterRows["status"] == 0){ ?>
                          <span class="badge btn btn-default">Applied</span>
                        <?php }else if($filterRows["status"] == 1){ ?>
                          <span class="badge btn btn-primary ">Shortlisted</span>
                        <?php }else if($filterRows["status"] == 2){ ?>
                          <span class="badge btn btn-info ">On Hold</span>
                        <?php }else if($filterRows["status"] == 3){ ?>
                          <span class="badge btn btn-secondary ">Selected</span>
                        <?php }else if($filterRows["status"] == 4){ ?>
                          <span class="badge btn btn-danger ">Rejected</span>
                        <?php } ?>
                    </td>

                      <?php if(!empty($filterRows["profileCV"])){ ?>
                    <td><a href="{{ROOT_URL.'/storage/app/uploads/candidateProfile/'.$filterRows["profileCV"]}}" target="_blank" class="button gray"> Download </a></td>
                      <?php } else { ?>
                    <td><a href="javascript:void(0);"  class="button gray"> Not Available </a></td>
                      <?php } ?>
                    

                    <td>
                      <a href="<?php echo ROOT_URL.'/downloadCv/' . encrypt($filterRows["candidateId"]); ?>" class="button gray"> Download </a>
                    </td>

                    <td>
                      <a href="{{ROOT_URL}}/employer/job/candidatedetails/{{ $filterRows["appliedJobId"] }}" class="button gray"><i class="icon-feather-eye"></i> View Detail</a>
                    </td>
                  </tr>
                    @endforeach
                <?php } else{ ?>
                  <tr>
                    <td colspan="7">No record found</td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>

        <div class="row mt-4"> 
          <div class="col-xl-12">
            <a href="javascript:void(0)" class="btn btn-secondary" onclick="return updateappliedjobs(1);">Shortlist</a>
            <a href="javascript:void(0)" class="btn btn-info ml-2" onclick="return updateappliedjobs(2);" >On hold</a>
            <a href="javascript:void(0)" class="btn btn-danger ml-2" onclick="return updateappliedjobs(4);">Reject</a>
          </div>          
        </div>

        <input type="hidden" name="hdnAction" id="hdnAction" value="">
        <input type="hidden" name="hdnIDs" id="hdnIDs" value="">
        <!-- <input type="hidden" name="dwnldStatus" id="dwnldStatus" value=""> -->
      </form>

    </div>
  </div>    
</div>
<!-- <a style="display: none;" href="#small-dialog-2"  class="btn btn-alert-modal">open modal</a> -->
@include('components.admin-alert-modal')
@section('page-js')
<script
>
  $(document).ready(function(){
  });
  function updateappliedjobs(status){
    var PIds='';
    $('.chkItem').each(function(){
      if($(this).is(':checked'))
        PIds  += $(this).val()+',';
    });
    if(PIds.length>0){
    // $('.btn-alert-modal').magnificPopup().magnificPopup('open');
     $('#confirmAlertModal').modal('show');
          $("#hdnIDs").val(PIds);
          if(status == 1){
           $("#hdnAction").val('shortlist');
          }else if(status == 2){
            $("#hdnAction").val('onhold');
          }else if(status == 4){
            $("#hdnAction").val('reject');
          }
          $('#btnConfirmModalOK').on('click',function(){
              $('#frmTCP').submit();
          });
    }else{
      viewAlert('Please select a record!');
      return false;
    }  
  }

  function dismisArchivePopup(){
     $('#small-dialog').magnificPopup('close');
  }
  function archiveJob(){
    $('#archive-job').submit(); 
  }

  // function download(){
  //   $('#dwnldStatus').val('Y');
  //   $('#frmTCP').submit();
  // }

</script>
@endsection
@endsection

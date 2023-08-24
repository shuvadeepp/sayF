


<?php  if($data->total()>0){ ?>
  <div class="utf-listings-container-part compact-list-layout margin-top-35">  
   
 	<?php   foreach ($data as $row){ 
    // echo'<pre>';print_R($row);exit;
    ?>
 <a href="{{ROOT_URL.'/jobdetails/'.str_replace(' ','_',strtolower($row->jobTitle)).'_'.str_replace(' ','_',strtolower($row->employerCompany)).'/'.encrypt($row->jobId)}}" class="utf-job-listing"> 
          <div class="utf-job-listing-details"> 
          <div class="utf-job-listing-company-logo"> <img src="<?php echo STORAGE_PATH; ?>companylogo/{{ $row->companyLogo }}" alt=""> </div>
          <div class="utf-job-listing-description">
            <span class="dashboard-status-button utf-job-status-item green"><i class="icon-material-outline-business-center"></i>{{ $row->jobtypeName }} </span>
              <?php if($row->appliedJobId && !empty(SESSION('candidate_session_data.userId'))){?>
              <span class="dashboard-status-button utf-job-status-item ml-1 blue">Applied</span>
           <?php  } ?>
            <h3 class="utf-job-listing-title">{{ $row->jobTitle }} <span class="utf-verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h3>
            <div class="utf-job-listing-footer">
            <ul>
              <li><i class="icon-line-awesome-building"></i>{{ $row->employerCompany }}</li>
              <li><i class="icon-material-outline-account-balance-wallet"></i><span class="icon-line-awesome-inr"></span>{{ indianCurrency($row->minSalary) }} -<span class="icon-line-awesome-inr"></span>{{ indianCurrency($row->maxSalary) }}</li>
              <li><i class="icon-material-outline-location-on"></i> {{$row->location}},{{$row->city}}</li>
              <li><i class="icon-material-outline-access-time"></i>{{ time_elapsed_string(strtotime($row->createdOn)) }}</li>
              <li><i class="icon-feather-star"></i> Skills: {{ $row->skillName }}</li>
              <li><i class="icon-line-awesome-user"></i> Experience: {{ $row->minExp }} years</li>
            </ul>
            </div>
          </div>
          <span class="bookmark-icon <?php  if(!empty($row->liked) && $row->liked==1){ echo "bookmarked";} ?>"  id="bookmarked<?php echo !empty($row->jobId)? $row->jobId:0;?>" onclick="addfavourite(<?php echo !empty($row->jobId)? $row->jobId:0;?>,<?php echo !empty(SESSION('candidate_session_data.userId'))? SESSION('candidate_session_data.userId'):0;?>)"></span> 
           </div>
        </a>  

 <?php } ?>
</div>
 <div class="pagination">
 {!! $data->links() !!}
</div>
<?php }else{?>
          <div class="utf-listings-container-part compact-list-layout margin-top-35">    
 <div class="no-data">
  <p>No jobs available</p>
</div>
</div>

       <?php }?>


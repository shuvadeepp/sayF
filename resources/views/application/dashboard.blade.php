@extends('layouts.adminlayout')
@section('page-content')
<!-- Dashboard Container -->
<!-- <div class="utf-dashboard-container-aera">  -->
<!-- Dashboard Content -->
<style>
  a:hover {
    font-size: 110%;
    color: green;
    font-weight: bold;
  }
</style>
<div class="utf-dashboard-content-container-aera" data-simplebar>
  <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
    <div class="row">
      <div class="col-xl-12">
        <h3>Application Dashboard</h3>
        <nav id="breadcrumbs">
          <ul>
            <li><a href="{{ROOT_URL}}/application/dashboard">Home</a></li>
            <li>Dashboard</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <div class="utf-dashboard-content-inner-aera">
    <!-- <div class="notification success closeable">
      <p>You are Currently Signed in as <strong>John Williams</strong> Has Been Approved!</p>
      <a class="close" href="#"></a>
    </div> -->
    <div class="utf-funfacts-container-aera">
      <div class="fun-fact" data-fun-fact-color="#2a41e8">
        <div class="fun-fact-icon"><i class="icon-feather-users"></i></div>
        <div class="fun-fact-text">
          <h4>{{(!empty($empjobseekerdata))?$empjobseekerdata[0]->TOTALEMPLOYER:0}}</h4>
          <span><a href=" {{APP_URL.'Dashboard/viewTotalEmployees'}} "> Employers </a></span>
        </div>
      </div>
      <div class="fun-fact" data-fun-fact-color="#36bd78">
        <div class="fun-fact-icon"><i class="icon-feather-user-plus"></i></div>
        <div class="fun-fact-text">
          <h4>{{(!empty($empjobseekerdata))?$empjobseekerdata[0]->TOTALJOBSEEKER:0}}</h4>
          <span><a href=" {{APP_URL.'Dashboard/viewTotalJobSeeker'}} "> Job Seekers </a></span>
        </div>
      </div>
      <div class="fun-fact" data-fun-fact-color="#efa80f">
        <div class="fun-fact-icon"><i class="icon-feather-briefcase"></i></div>
        <div class="fun-fact-text">
          <h4>{{(!empty($noofjobs))?$noofjobs[0]->NOOFJOBS:0}}</h4>
          <span><a href=" {{ROOT_URL.'/jobsearch'}} "> No. of Jobs </a> </span>
        </div>
      </div>
      <div class="fun-fact" data-fun-fact-color="#0fc5bf">
        <div class="fun-fact-icon"><i class="icon-brand-telegram-plane"></i></div>
        <div class="fun-fact-text">
          <h4>{{(!empty($totalrecruit))?$totalrecruit[0]->TOTALRECRUITED:0}}</h4>
          <span><a href=" {{APP_URL.'Dashboard/TotalRecruited'}} "> Total Recruited </a> </span>
        </div>
      </div>
      <!-- <div class="fun-fact" data-fun-fact-color="#f02727">
        <div class="fun-fact-icon"><i class="icon-feather-trending-up"></i></div>
        <div class="fun-fact-text">
          <h4>2250</h4>
          <span>Month Views</span>
        </div>
      </div> -->
    </div>
    <!-- top 10 jobs -->
    <div class=" table-responsive dashboard-box mb-4 top-job-employer">
      <div class="headline d-flex justify-content-between align-items-center">
        <h3 >Top 10 Jobs</h3>
        <div class="tab-view" role="group" aria-label="Basic example">
          <a href="javascript:;" title="Show in Table" class="btn btn-secondary btn-sm togle-g-btn">
            <i class="icon-line-awesome-table"></i>
          </a>
        </div>
      </div>
      <div class="dashboard-list-box table-responsive invoices with-icons ">
          <table class="table table-hover">
          <thead>
            <tr>
              <th>Job Title</th>
              <th>Vacancies</th>
              <th>Candidates Applied</th>
              <th width="120">Recruited</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($top10job)){ 
                    $jobTitles        = array();
                    $jobVacancy       = array();
                    $jobTotalapplied  = array();
                    $jobTotalrecruit  = array();
                    foreach ($top10job as $jb => $vals) {
                      array_push($jobTitles, $vals->jobTitle);
                      array_push($jobVacancy, $vals->jobVacancy);
                      array_push($jobTotalapplied, $vals->TOTALAPPLIED);
                      array_push($jobTotalrecruit, $vals->TOTALRECRUITED);
            ?>
                      <tr>
                        <td>{{$vals->jobTitle}}</td>
                        <td>{{$vals->jobVacancy}}</td>
                        <td>{{$vals->TOTALAPPLIED}}</td>
                        <td>{{$vals->TOTALRECRUITED}}</td>
                      </tr>
            <?php 
                    }
                  }else{
            ?>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Sorry!! No record found.</td>
                        <td></td>
                      </tr>
            <?php }?>
          </tbody>
        </table>
        <div id="top-job" class="chart-view"></div>
        
      </div>
    </div>
    <!-- top 10 jobs end -->
    <!-- top 10 employers -->
    <div class="utf_dashboard_list_box table-responsive recent_booking dashboard-box top-job-employer">
      
       <div class="headline d-flex justify-content-between align-items-center">
          <h3>Top 10 Employers</h3>
         <div class="tab-view" role="group" aria-label="Basic example">
          <a href="javascript:;" class="btn btn-secondary btn-sm togle-g-btn">
            <i class="icon-line-awesome-table"></i>
          </a>
        </div>
      </div>
      <div class="dashboard-list-box table-responsive invoices with-icons ">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Employer Name</th>
              <th>No. of Jobs Posted</th>
              <th>No. of Vacancies</th>
              <th>Total Recruited</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($top10emp)){ 
                    $empName          = array();
                    $jobPosted        = array();
                    $totVacancy       = array();
                    $totalrecruit     = array();
                    foreach ($top10emp as $emp => $emval) {
                      array_push($empName, $emval->employerCompany);
                      array_push($jobPosted, $emval->TOTALJOBPOST);
                      array_push($totVacancy, $emval->TOTALVACANCIES);
                      array_push($totalrecruit, $emval->TOTALRECRUITED);
            ?>
                      <tr>
                        <td>{{$emval->employerCompany}}</td>
                        <td>{{$emval->TOTALJOBPOST}}</td>
                        <td>{{$emval->TOTALVACANCIES}}</td>
                        <td>{{$emval->TOTALRECRUITED}}</td>
                      </tr>
            <?php 
                    }
                  }else{
            ?>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Sorry!! No record found.</td>
                        <td></td>
                      </tr>
            <?php }?>
          </tbody>
        </table>
        <div id="top-employer" class="chart-view"></div>
      </div>
      
    </div>
    <!-- top 10 employers end -->
  </div>
</div>
</div>
<!-- Dashboard Content End -->
</div>
@section('page-js')
<!-- <script src="<?php echo PUBLIC_PATH; ?>js/social-share.min.js"></script> -->
<script  src="<?php echo PUBLIC_PATH; ?>js/highcharts.js"></script>
<!-- <script  src="<?php //echo PUBLIC_PATH; ?>js/charts.js"></script> -->
<script
>
  $(document).ready(function(){
    /******************************top 10 job column chart***********************************************/
    <?php if(!empty($top10job)){  ?>
              var vertical_bar = Highcharts.chart('top-job', {
                  chart: {
                      backgroundColor: '',
                      type: 'column'
                  },
                  title: {
                      text: ''
                  },
                  xAxis: {
                      categories: <?php echo json_encode($jobTitles);?>
                  },
                  colors: [ "#1aa86e"," #003a6c","#feb953"],
                  series: [
                      {
                          name: ['Vacancies'],
                          data: <?php echo json_encode($jobVacancy);?>
                      },
                      {
                          name: ['Candidates Applied'],
                          data: <?php echo json_encode($jobTotalapplied);?>
                      },  {
                          name: ['Recruited'],
                          data: <?php echo json_encode($jobTotalrecruit);?>
                      },
                  ]
              });
    <?php } ?>          
    /************************************************************************/

    /******************************top 10 employer column chart***********************************************/
    var vertical_bar = Highcharts.chart('top-employer', {
        chart: {
            backgroundColor: '',
            type: 'column'
        },
        title: {
            text: ''
        },        
        xAxis: {
            categories: <?php echo json_encode($empName);?>
        },
        colors: [ "#1aa86e"," #003a6c","#feb953"],
        series: [
            {
                name: ['No. of Jobs Posted'],
                data: <?php echo json_encode($jobPosted);?>
            }, {
                name: ['No. of Vacancies'],
                data: <?php echo json_encode($totVacancy);?>
            }, {
                name: ['Total Recruited'],
                data: <?php echo json_encode($totalrecruit);?>
            },
        ]
    });
    /************************************************************************/


  });
</script>
@endsection
@endsection
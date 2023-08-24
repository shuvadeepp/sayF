@extends('layouts.website')
@section('page-content')
@section('page-css')

@endsection
<!-- Latest Jobs -->
<div class="section webjoblist">
  <div class="container">
      <div class="inner-page-baner">
      <?php if(isset($banners) && $banners->isNotEmpty()){ ?>
      <img src="<?php if(!empty($banners[0]->bannerImage)){ echo ROOT_URL.'/storage/app/uploads/banner/'.$banners[0]->bannerImage; } else{ echo PUBLIC_PATH.'images/banner1.png'; } ?>" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
          <strong>{{$banners[0]->bannerTitle}}</strong> - <br> {{$banners[0]->bannerText}}
      </div>
      <?php } else { ?>
      <img src="<?php echo PUBLIC_PATH; ?>images/explore-jobs.png" class="d-block" alt="banner">
      <div class="inner-page-baner-content">
        <strong>Explore Jobs</strong> - <br> Discover Inclusive Job Opportunities
      </div>
      <?php } ?>
    </div>
     
    <div class="row">
      <div class="col-xl-3 col-lg-4">
        <div class="utf-sidebar-container-aera">

          <div class="utf-sidebar-widget-item">
            <h3>Select Capability</h3>
            <div class="utf-radio-btn-list">

              <?php if(!empty($arrDisableRec)) { foreach($arrDisableRec as $disableInfo){ ?>
              <div class="checkbox">
                <input type="checkbox" id="disablityType{{$disableInfo->disabilityId}}"
                  value="{{$disableInfo->disabilityId}}" class="disablityType" name=disablityType[]>
                <label for="disablityType{{$disableInfo->disabilityId}}"><span class="checkbox-icon"></span>
                  {{$disableInfo['disabilityName']}}</label>
              </div>
              <?php } }  ?>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="utf-sidebar-widget-item">
            <h3>Search Keywords</h3>
            <div class="utf-input-with-icon">
              <input type="text" placeholder="Search Keywords..." id="searchkeyword">
              <i class="icon-material-outline-search clicksearch"></i>
            </div>
          </div>

          <div class="utf-sidebar-widget-item">
            <h3>States</h3>
            <select class="selectpicker Locations" id="Locations" data-live-search="true"
              data-selected-text-format="count" data-size="7" title="All Locations" name=Locations[] multiple>
              <?php if(!empty($arrResLocation)) { foreach($arrResLocation as $arrResLocation){?>
              <option value="{{$arrResLocation->stateId}}">{{$arrResLocation->state}}</option>
              <?php } }?>
            </select>
          </div>
          <div class="utf-sidebar-widget-item">
            <h3>City</h3>
            <select class="selectpicker default utf-with-border selcity" id="selcity" data-live-search="true"
              data-size="5" name="selcity[]" id="selcity" title="Select City" multiple>
              <option value="0">--select--</option>
            </select>
          </div>

          <div class="utf-sidebar-widget-item">
            <h3>Experience</h3>
            <div class="utf-radio-btn-list">
              <div class="checkbox">
                <input type="checkbox" id="chekcbox01" value="0,1" class="experiencval" name="experience[]">
                <label for="chekcbox01"><span class="checkbox-icon"></span> 0 to 1Year</label>
              </div>
              <div class="checkbox">
                <input type="checkbox" id="chekcbox02" value="2,5" class="experiencval" name="experience[]">
                <label for="chekcbox02"><span class="checkbox-icon"></span> 2 to 5Years</label>
              </div>
              <div class="checkbox">
                <input type="checkbox" id="chekcbox03" value="5,8" name="experience[]" class="experiencval">
                <label for="chekcbox03"><span class="checkbox-icon"></span> 5 to 8Years</label>
              </div>
              <div class="checkbox">
                <input type="checkbox" id="chekcbox04" value="10,15" name="experience[]" class="experiencval">
                <label for="chekcbox04"><span class="checkbox-icon"></span> 10 to 15Years</label>
              </div>
              <div class="checkbox">
                <input type="checkbox" id="chekcbox05" value="15,100" name="experience[]" class="experiencval">
                <label for="chekcbox05"><span class="checkbox-icon"></span>15Years+</label>
              </div>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="utf-sidebar-widget-item">
            <h3>Job Type</h3>
            <div class="utf-radio-btn-list">

              <?php if(!empty($arrJobtypeRec)) { foreach($arrJobtypeRec as $JobtypeRec){?>
              <div class="checkbox">
                <input type="checkbox" id="chekcbox{{$JobtypeRec->jobtypeId}}" value="{{$JobtypeRec->jobtypeId}}"
                  class="jobTypes" name=jobTypes[]>
                <label for="chekcbox{{$JobtypeRec->jobtypeId}}"><span class="checkbox-icon"></span>
                  {{$JobtypeRec->jobtypeName}}</label>
              </div>
              <?php } } ?>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="utf-sidebar-widget-item">
            <h3>Skills</h3>
            <div class="utf-submit-field mb-0">
              <span class="label-info">To add skills, kindly type and select </span>
              <ul class="selected-skill"></ul>
              <div class="pos-relative">
                <input type="text" name="" placeholder="Type your skill . . ." class="utf-with-border input-skil"
                  onkeyup="return loadskillsas(this.value);">
                <ul class="autofill-dropdown" style="display: none;">

                  <!--  <input type="hidden" name="emplskill" id="emplskill" value="">
                      <ul class="autofill-dropdown" style="display: none;"> -->
                </ul>
              </div>
            </div>
          </div>
          <!--     <div class="utf-sidebar-widget-item">
        <h3>Skills</h3>
        <div class="utf-submit-field mb-0">
          <span class="label-info">To add skills, kindly type and select </span>
          <ul class="selected-skill"></ul>
          <div class="pos-relative">
            <input type="text" name="" placeholder="Type your skill . . ." class="utf-with-border input-skill" >
            <ul class="autofill-dropdown" style="display: none;">

              <?php if(!empty($arrSkillRec)) { foreach($arrSkillRec as $SkillRec){?>
                <li data-val="{{$SkillRec->skillsId}}">{{$SkillRec->skillName}}</li>

              <?php } } ?>
            </ul>
          </div>
        </div>
      </div> -->


          <div class="utf-sidebar-widget-item">
            <h3>Annual Salary</h3>
            <div class="margin-top-55"></div>
            <input class="range-slider slidersalaray" id="slidersalaray" type="text" value="" data-slider-currency="₹"
              data-slider-min="100000" data-slider-max="1500000" data-slider-step="100"
              data-slider-value="[100000,1500000]" />
          </div>
        </div>
      </div>
      <input type="hidden" id="rangleslider" value="">
      <input type="hidden" id="sortby" value="">
      <div class="col-xl-9 col-lg-8 mt-3 mt-lg-0">
        <?php  if($data->total()>0)
      { ?>
        <div class="utf-notify-box-aera">
          <div class="utf-switch-container-item">
            <?php 
     

       $intCurrPage = $data->currentPage();
      $intPagecount   = ceil($data->total()/$data->perPage());
    if($data->currentPage()>$intPagecount)
       $intCurrPage  = $intPagecount;
       $intRecNext     = $intCurrPage * $data->perPage();
       $intStartRec =  ($data->currentPage()-1)*$data->perPage()+1;  
       $intRecNext     = $intCurrPage * $data->perPage();
       $intEndRec    = $intRecNext;
      if($intEndRec>$data->total())
        $intEndRec  = $data->total();
     

    ?>
            <input type="hidden" id="intStartRec" value="<?php echo $intStartRec;?>">
            <input type="hidden" id="intEndRec" value="<?php echo $intEndRec;?>">
            <input type="hidden" id="totalrec" value="<?php  echo $data->total();?>">
            <input type="hidden" id="candidateid" value="<?php echo $candidateid; ?>">
            <?php if(!empty($candidateid)){ ?>
            <input type="hidden" id="candState" name="candState"
              value="<?php if (!empty($userPersonalInfo->state)) { echo $userPersonalInfo->state; } else { echo ''; } ?> ">
            <input type="hidden" id="candCity" name="candCity"
              value="<?php if (!empty($userPersonalInfo->city)) { echo $userPersonalInfo->city; } else { echo ''; } ?>">
            <input type="hidden" id="candDisability" name="candDisability"
              value="<?php if (!empty($userPersonalInfo->disablityType)) { echo $userPersonalInfo->disablityType; } else { echo ''; } ?>">
            <input type="hidden" id="candTotalExp" name="candTotalExp" value="{{ $totalExp }}">

            <?php if(!empty($userSkillDetls)){
            foreach($userSkillDetls as $key=>$userSkillName){ ?>
            <input type="hidden" id="candSkill" name="candSkill[]" data-id="<?php echo $userSkillName->skillName ?>"
              value="<?php echo $userSkillName->skillnames ?>">
            <?php } } ?>
            <!-- <input type="hidden" id="candSkill2" name="candSkill2[]"  value="<?php //echo serialize($userSkillNameDetls); ?>"> -->
            <?php } ?>

            <span id="pagination">Showing <span id="strrc"></span>–<span id="endrec"></span> of <span
                id="totare"></span> Jobs Results </span>

          </div>
          <div class="sort-by">
            <span>Sort By:</span>
            <select class="selectpicker hide-tick sortby" id="sortbyVal" onchange="changesortby(this.value);"
              tabindex="-98">
              <option value="1">A to Z</option>
              <option value="2">Newest</option>
              <option value="3">Oldest</option>
              <option value="4">Favourite</option>
              <?php if(!empty($candidateid)){ ?>
              <option value="5">Relevant Category</option>
              <?php } ?>
            </select>
          </div>
        </div>
        <?php } ?>

        <div id="jobdetails">
          @include('website.jobdetails_data')
        </div>
      </div>
    </div>
  </div>
  <!-- Latest Jobs / End -->
  @section('page-js')
  <script>
    $(window).load(function () {
      var candidateLogin = $('#candidateid').val();
      /* Checking if candidate is login then selecting the filter box data as per Candidate's profile -- Sangita Pratap -- 30-03-2022 */
      if (candidateLogin != '') {
        // $('.sortby option[value="5"]').attr("selected", "selected"); 
        $('#sortbyVal').val(5);
        var candiDisability = $('#candDisability').val();
        var candiState = $('#candState').val();
        var candiCity = $('#candCity').val();
        var candiDisability = $('#candDisability').val();
        var candiTotalExp = $('#candTotalExp').val();

        var jobstates = [];
        jobstates.push(candiState);
        $("#disablityType" + candiDisability).prop('checked', true);
        $("#Locations").val(candiState).selectpicker('refresh');
        selectCandiExperience(candiTotalExp);
        loadmultiplecity(jobstates, 0);

        setTimeout(function () {
          $('#selcity').val(candiCity).selectpicker('refresh');
        }, 2000);

        $('input[name="candSkill[]"]').each(function (index) {
          var selectval = $(this).val();
          var selectId = $(this).attr("data-id");
          $(".selected-skill").append("<li data-val='" + selectId + "'>" + selectval + "<span class='remove-skill'></span></li>");
        });

        bindjobsearch(0);
      }
    });
    $(document).ready(function () {

      var intStartRec = $("#intStartRec").val();
      $("#strrc").text(intStartRec);
      var intEndRec = $("#intEndRec").val();
      $("#endrec").text(intEndRec);
      var totalrec = $("#totalrec").val();
      $("#totare").text(totalrec);


      $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        bindjobsearch(page);
      });

      // $(document).on('click', '.skillval', function(){
      //   $(this).parent('li').remove();
      //   bindjobsearch(0);
      // });
    });
    //  $('.input-skill').on("keyup", function(e){
    //   alert(12);
    //   $(".autofill-dropdown").show();
    // });

    //  $(".autofill-dropdown li").on("click", function(){
    //   var selectval = $(this).text();
    //   var skillid= $(this).data("val");
    //   $(".autofill-dropdown").hide();
    //   $(".selected-skill").append("<li data-val="+skillid+">"+selectval+"<span class='remove-skill skillval'></span></li>");
    //   $(this).remove();
    //   bindjobsearch(0); 
    // });
    var salaryRange = $(".range-slider").slider();
    salaryRange.on('slideStop', function (val) {
      minmaxval(val.value);
    });

    $('.remove-skill').on('click', function () {
      $(this).parent('li').remove();
      bindjobsearch(0, 1);
    });

    $('.jobTypes').on('click', function (event) {
      bindjobsearch(0, 1);
    });

    $('.experiencval').on('click', function (event) {
      //$(this).attr('checked','checked');
      // $(this).prop('checked', true);

      bindjobsearch(0, 1);
    });
    $('.clicksearch').on('click', function (event) {
      bindjobsearch(0, 1);
    });
    $('#searchkeyword').keypress(function (event) {
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if (keycode == '13') {
        bindjobsearch(0, 1);
      }
    });

    $('.disablityType').on('click', function (event) {
      bindjobsearch(0, 1);
    });

    function changesortby(val) {
      /* set timeout to clear previously loaded data */
      clearSelectedFields();
      setTimeout(function () {
        $("#sortby").val(val);
      }, 4000);

      /* Checking if candidate is login then selecting the Relevant Category option from Sorting option & 
          auto-populate the filter box data as per Candidate's profile -- Sangita Pratap -- 30-03-2022 */
      setTimeout(function () {
        if (val == '5') {
          var candiState = $('#candState').val();
          var candiCity = $('#candCity').val();
          var candiDisability = $('#candDisability').val();
          var candiTotalExp = $('#candTotalExp').val();

          var jobstates = [];
          jobstates.push(candiState);

          loadmultiplecity(jobstates, 0);
          $("#disablityType" + candiDisability).prop('checked', true);
          $("#Locations").val(candiState).selectpicker('refresh');
          selectCandiExperience(candiTotalExp);
          /* set timeout to clear previously loaded data */
          setTimeout(function () {
            $("#selcity").val(candiCity).selectpicker('refresh');
          }, 3500);

          $('input[name="candSkill[]"]').each(function (index) {
            var selectval = $(this).val();
            var selectId = $(this).attr("data-id");
            $(".selected-skill").append("<li data-val='" + selectId + "'>" + selectval + "<span class='remove-skill'></span></li>");
          });
        }
        bindjobsearch(0, 1);
      }, 4500);

    }


    $('.Locations').on('change', function (event) {
      var jobstates = [];
      $(".Locations :selected").each(function () {
        // console.log($(this).val());
        jobstates.push($(this).val());
      });
      // console.log(jobstates);
      // $('#selcity').selectpicker('refresh');
      $("#selcity").val('').selectpicker('refresh');
      loadmultiplecity(jobstates, 0);
      bindjobsearch(0, 1);
    });

    $('.selcity').on('change', function (event) {
      bindjobsearch(0, 1);
    });

    function loadmultiplecity(jobmultiplelocation, cityval) {
      var arrcity = [];
      if (cityval != 0) {
        var arrcity = $.map(cityval.split(','), function (value) {
          return parseInt(value, 10);
        });
        // console.log(jobmultiplelocation);
        var jobmultiplelocation = jobmultiplelocation.split(',');
      }
      $.ajax({
        type: 'POST',
        url: SITE_URL + "/website/ajax/loadmultiplecity",
        data: { jobmultiplelocation: jobmultiplelocation },
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        },
        beforeSend: function () {
        },
        success: function (res) {
          if (res.status == 200) {
            var result = res.result;
            var html = '';
            var selected = '';
            if (result != null) {
              $(result).each(function (i, val) {
                selected = '';
                // console.log(arrcity);
                if (arrcity != null) {
                  if (jQuery.inArray(val.locationId, arrcity) != -1) {
                    selected = 'selected';
                  }
                }
                html += '<option value="' + val.locationId + '" ' + selected + '>' + val.location + '</option>';
              });
            }
            $('#selcity').html(html).selectpicker('refresh');
          }
        }
      });
    }


    function minmaxval(val) {
      $("#rangleslider").val(val);
      bindjobsearch(0, 1);
    }
    function addfavourite(jobid, sessionid) {
      if (jobid > 0 && sessionid > 0) {
        if ($("#bookmarked" + jobid).hasClass("bookmarked") == false) {

          var jobid = jobid;
          var liked = 1;

          favourite(jobid, liked)

        } else {

          var jobid = jobid;
          var unliked = 2;
          favourite(jobid, unliked)

        }
      }
    }
    function favourite(jobid, liked) {
      $.ajax({
        type: 'POST',
        url: SITE_URL + "/website/ajax/addFavourite",
        data: { jobid: jobid, liked: liked },
        dataType: "json",
        async: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
          // console.log(res);
        }
      });

    }
    function bindjobsearch(page, manualClick = 0) {
      var selsortby = '';
      var selsortby = $("#sortby").val();
      var selJobValues = [];
      $('.jobTypes:checked').each(function (i) {
        selJobValues[i] = $(this).val();
      });
      var selExperiencevals = [];
      $('.experiencval:checked').each(function (i) {
        selExperiencevals[i] = $(this).val();
      });
      var searchkeyword = '';
      var searchkeyword = $("#searchkeyword").val();
      var joblocation = [];

      $(".Locations :selected").each(function () {
        joblocation.push($(this).val());
      });
      var city = [];
      $(".selcity :selected").each(function () {
        city.push($(this).val());
      });

      var skillexample = [];
      $(".selected-skill li").each(function () {

        skillexample.push($(this).data("val"));
      });
      var selDisablityType = [];
      $('.disablityType:checked').each(function (i) {
        selDisablityType[i] = $(this).val();
      });
      var rangleslider = '';
      var rangleslider = $("#rangleslider").val();
      var minsalary = '';
      var maxsalary = '';
      $.ajax({
        type: 'POST',
        url: SITE_URL + "/website/ajax/jobsearch?page=" + page,
        data: { sel: selsortby, selJobValues: selJobValues, selExperiencevals: selExperiencevals, searchkeyword: searchkeyword, skillTypes: skillexample, rangleslider: rangleslider, joblocation: joblocation, city: city, selDisablityType: selDisablityType },
        async: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
          $("#pagination").show();

          if (res.totalrec == 0) {
            if (manualClick == 1) {
              // No record Found
            } else {
              var candidateLogin = $('#candidateid').val();
              var sortByVal = $("#sortby").val();
              if (candidateLogin != '' && sortByVal == '5') {

              } else {
                clearCandiSearch();
              }
            }

            $("#pagination").hide();

          }


          $("#strrc").text('');
          $("#strrc").text(res.intStartRec);
          $("#endrec").text('');
          $("#endrec").text(res.intEndRec);
          $("#totare").text('');
          $("#totare").text(res.totalrec);
          $('#jobdetails').html(res.html);
        }
      });
    }
    function loadskillsas(typedStr) {
      $('.autofill-dropdown').hide();
      if (typedStr != '') {
        var selectedskill = [];
        if ($('.selected-skill li').length > 0) {
          $('.selected-skill li').each(function () {
            var selval = $(this).data('id');
            selectedskill.push(selval);
          });
        }
        selectedskill = JSON.stringify(selectedskill);
        $.ajax({
          type: 'POST',
          url: SITE_URL + "/website/ajax/loadskills",
          data: { typedStr: typedStr, selectedskill: selectedskill },
          dataType: "json",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          beforeSend: function () {
            //$(".loading-gif").hide();
          },
          success: function (res) {
            if (res.status == 200) {
              var result = res.result;
              var bindData = '';
              if (result.length > 0) {
                $('.autofill-dropdown').html('');
                $('.autofill-dropdown').show();
                $(result).each(function (i) {
                  //console.log(result[i].skillsId);
                  bindData += '<li data-val="' + result[i].skillsId + '">' + result[i].skillName + '</li>';
                });
                $('.autofill-dropdown').html(bindData);
                $(".autofill-dropdown li").on("click", function () {
                  var selectval = $(this).text();
                  var selectid = $(this).data('val');
                  $(".autofill-dropdown").hide();
                  $(".selected-skill").append("<li data-val='" + selectid + "'>" + selectval + "<span class='remove-skill'></span></li>");
                  bindjobsearch(0);
                  $(this).remove();
                  $('.input-skill').val('');
                  $(".remove-skill").on('click', function () {
                    $(this).parent('li').remove();
                    bindjobsearch(0);
                  });
                });
              }
            }
          }
        });
      }
    }

    /* Function to clear candidates selected filter data -- Sangita Pratap -- 31-03-2022 */

    function clearCandiSearch() {
      $('#sortbyVal').val('');
      var candiState = $('#candState').val();
      var candiCity = $('#candCity').val();
      var candiDisability = $('#candDisability').val();
      var candiTotalExp = $('#candTotalExp').val();

      // var jobstates = [];  
      // jobstates.push(candiState);

      $("#disablityType" + candiDisability).prop('checked', false);
      $("#Locations").val('').selectpicker('refresh');
      // $('[id^="checkbox"]').prop('checked', false);
      $('.experiencval').prop('checked', false);
      // loadmultiplecity(jobstates,0);
      setTimeout(function () {
        $("#selcity").val('').selectpicker('refresh');
      }, 1800);

      $(".selected-skill").html('');
      $('#sortbyVal').val(1);
      //  $('.sortby option[value="1"]').attr("selected", "selected"); 
      setTimeout(function () {
        bindjobsearch(0);
      }, 2200);
    }
    /* Function to clear selected filter fields -- Sangita Pratap -- 31-03-2022 */

    function clearSelectedFields() {
      $('[id^="disablityType"]').prop('checked', false);
      $("#Locations").val('').selectpicker('refresh');
      setTimeout(function () {
        $("#selcity").val('').selectpicker('refresh');
      }, 1800);
      $(".selected-skill").html('');
      // $('[id^="checkbox"]').prop('checked', false);
      $('.experiencval').prop('checked', false);
    }
    /* Function to select candidates experience checkbox -- Sangita Pratap -- 31-03-2022 */
    function selectCandiExperience(exp) {
      var checkbox1 = new Array(0, 1);
      if (exp >= '0' && exp <= '1') {
        $("#checkbox01").prop('checked', true);
      }

      var checkbox2 = new Array(2, 5);
      if (exp > '2' && exp <= '5') {
        $("#checkbox02").prop('checked', true);
      }
      var checkbox3 = new Array(5, 8);
      if (exp > '5' && exp <= '8') {
        $("#checkbox03").prop('checked', true);
      }
      var checkbox4 = new Array(10, 15);
      if (exp > '10' && exp <= '15') {
        $("#chekcbox04").prop('checked', true);
      }
      var checkbox5 = new Array(15);
      if (exp > '15') {
        $("#checkbox05").prop('checked', true);
      }
    }
  </script>
  @endsection
  @endsection
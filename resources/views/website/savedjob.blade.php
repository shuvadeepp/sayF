@extends('layouts.website')
@section('page-content')
@section('page-css')

@endsection
<!-- <div class="page-wrapper"> -->

  <!-- Latest Jobs -->
  <div class="section padding-top-60 padding-bottom-60">
    <div class="container">
      <div class="row">
          <div class="col-12">
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
    <span id="pagination">Showing <span id="strrc"></span>–<span id="endrec"></span> of <span id="totare"></span> Jobs Results </span>   
              </div>          
                <div class="sort-by">
                  <span>Sort By:</span>
                  <div class="btn-group bootstrap-select hide-tick sortby">
                  
                   <select class="selectpicker hide-tick sortby" onchange="changesortby(this.value);" tabindex="-98">
                    <option value="1">A to Z</option>
                    <option value="2">Newest</option>
                    <option value="3">Oldest</option>
                   
                  </select></div>
                </div>
                <input type="hidden" id="sortby" value="">
                  </div>
                <?php } ?>
                  <div id="savedjob"> 
              
                    @include('website.savedjob_data')
          

            </div>
          </div>
      </div>
    </div>
  </div>

<!-- Latest Jobs / End -->
@section('page-js')
<script>
 $(document ).ready(function() {
   var intStartRec=$("#intStartRec").val();
 $("#strrc").text(intStartRec);
  var intEndRec=$("#intEndRec").val();
 $("#endrec").text(intEndRec);
  var totalrec=$("#totalrec").val();
 $("#totare").text(totalrec);
   $(document).on('click', '.pagination a', function(event){
    event.preventDefault(); 
    var pages = $(this).attr('href').split('page=')[1];
    bindsavedjob(pages);
   });
});
  function changesortby(val){
    $("#sortby").val(val);
    bindsavedjob(0);
  }
  function addfavourite(jobid,liked){
    $.ajax({
      type: 'POST',
      url: SITE_URL + "/website/ajax/addFavourite",
      data: {jobid:jobid,liked:liked},
      dataType: "json",
      async: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (res) {
       console.log(res);
       location.reload();
     }
   });

  }
  function bindsavedjob(pages){ 
      var selsortby='';
      var selsortby=$("#sortby").val();
     
     $.ajax({
          type: 'POST',
          url: SITE_URL + "/website/ajax/savedjob?page="+pages,
          data: {sel:selsortby},
          async: false,
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (res) {
              $("#pagination").show();
      if(res.totalrec==0){
        $("#pagination").hide();
      }
        $("#strrc").text('');
        $("#strrc").text(res.intStartRec);
        $("#endrec").text('');
        $("#endrec").text(res.intEndRec);
        $("#totare").text('');
        $("#totare").text(res.totalrec);
        $('#savedjob').html(res.html);
           
          }
      });
 }

 </script>
@endsection
@endsection

<!-- Scripts --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>
<!-- <script src="<?php// echo PUBLIC_PATH; ?>js/jquery-3.3.1.min.js"></script>  -->

<!-- <script src="<?php //echo PUBLIC_PATH; ?>js/jquery-3.3.1.min.js"></script> -->
<!-- <script src="<?php echo PUBLIC_PATH; ?>js/popper.min.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/bootstrap.min.js"></script> -->
<script src="<?php echo PUBLIC_PATH; ?>js/new-custom.js"></script> 

<script src="<?php echo PUBLIC_PATH; ?>js/jquery-migrate-3.0.0.min.js"></script> 
<script src="<?php echo PUBLIC_PATH; ?>js/bootstrap-modal.js"></script> 
<script src="<?php echo PUBLIC_PATH; ?>js/mmenu.min.js"></script> 
<script  src="<?php echo PUBLIC_PATH; ?>js/tippy.all.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplebar/2.6.1/simplebar.min.js" ></script>
<!-- <script src="<?php echo PUBLIC_PATH; ?>js/simplebar.min.js"></script>  -->
<script src="<?php echo PUBLIC_PATH; ?>js/bootstrap-slider.min.js"></script> 
<script src="<?php echo PUBLIC_PATH; ?>js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/snackbarjs/1.1.0/snackbar.min.js"></script> 
<!-- <script src="<?php echo PUBLIC_PATH; ?>js/snackbar.js"></script>  -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script> -->
<!-- <script src="<?php echo PUBLIC_PATH; ?>js/clipboard.min.js"></script>  -->
<!-- <script src="<?php echo PUBLIC_PATH; ?>js/counterup.min.js"></script>  -->
<script defer src="<?php echo PUBLIC_PATH; ?>js/magnific-popup.min.js"></script> 
<script defer src="<?php echo PUBLIC_PATH; ?>js/slick.min.js"></script> 
<script defer src="<?php echo PUBLIC_PATH; ?>js/typed.js"></script>
<script defer src="<?php echo PUBLIC_PATH; ?>js/custom_jquery.js"></script> 
<script  src="<?php echo PUBLIC_PATH; ?>js/validatorchklist.js"></script> 
<script src="<?php echo PUBLIC_PATH; ?>js/commonAjax.js"></script> 

<!-- <script src="<?php echo PUBLIC_PATH; ?>js/jquery-ui.css"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/cropper.css"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/cropper.js"></script> -->

<script   src="<?php echo PUBLIC_PATH; ?>js/jquery-ui.js"></script>
<script   src="<?php echo PUBLIC_PATH; ?>js/custom-datepicker.js"></script>


<script>  
  $(document).ready(function() {
    
    $(document).on("click","#ddate",function(){
      $(this).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "d M y",
        minDate:new Date(),
      });

    });
    /*****************fill country data**************************/
    if ($('#dcountry').length > 0) {
      loadcountryAjax('dcountry');
    }
    /**********************************************************/
  });
</script>

<script
>
	$(window).load(function(){
      $.magnificPopup.defaults.closeOnBgClick = false;
    });
	
     $("#employeerlogin-form").keyup(function(event){
                if(event.keyCode == 13){
                   validatoremployeer();
                }
            });
	  $("#candidatelogin-form").keyup(function(event){
                if(event.keyCode == 13){
                   validatorcandidate();
                }
            });
     $("#partnerlogin-form").keyup(function(event){
                if(event.keyCode == 13){
                   validatorpartnerlogin();
                }
            });
    
       $("#volunteer-form").keyup(function(event){
                if(event.keyCode == 13){
                   validatevolunteerform();
                }
            });
         $("#donate-form").keyup(function(event){
                if(event.keyCode == 13){
                   validatedonateform();
                }
            });
        
        
          

	$(function($) {
	  if ($('.chkAll').length > 0) {
	      $('.chkAll').on('click', function() {
	          if ($(this).is(':checked')) {
	              $('.chkItem').prop('checked', true);
	          } else {
	              $('.chkItem').prop('checked', false);
	          }
	      });
	  }
	  $('.chkItem').on('click', function() {
	      var chkAllFlag = 0;
	      $('.chkItem').each(function() {
	          if ($(this).is(':checked'))
	              chkAllFlag++;
	      });
	      if (Number(chkAllFlag) == Number($('.chkItem').length))
	          $('.chkAll').prop('checked', true);
	      else
	          $('.chkAll').prop('checked', false);
	  });
	  $('#btnConfirmOK').on('click', function() {
	      $('#frmTCP').submit();
	  });
	  $('#btnConfirmModalOK').on('click', function() {
	     $('#confirmAlertModal').modal('hide');
	  });
	});
	function viewAlert(msg, ctrlId,redLoc)
	{	
		$('#btnAlertOk').off('click');
		if(typeof(ctrlId)=='undefined')
		{
			ctrlId	= '';
		}
		if(typeof(redLoc)=='undefined')
		{
			redLoc	= '';
		}
		$('#alertModal').modal({backdrop: 'static', keyboard: false});
		$('.alertMessage').html(msg);
		$('#alertModal').on('hidden.bs.modal',function(){
			$('#alertModal').modal('hide');
            $('#alertModal').hide();
			if(ctrlId !='')
			{
				$('#'+ctrlId).addClass('vfail').focus();
			}
			if(redLoc!='')
			{
				window.location.href =redLoc;
			}
            if(redLoc=='pr'){ //page reload
                window.location.reload();
            }
		});		
	}

	function confirmAlert(msg){
        $('#confirmAlertModal').modal('show');
        $('.confirmMessage').html(msg);
    }

	function deleteIndividual(Id){
      $("#hdnAction").val('D');
	  $("#hdnIDs").val(Id);
	}

	function update_multiple_status(action){
		var PIds='';
		$('.chkItem').each(function(){
		  if($(this).is(':checked'))
			PIds	+= $(this).val()+',';
		});
	  	if(PIds.length>0){
			PIds = PIds.substring(0,PIds.length - 1);
			if(action=='D')
			{
				confirmAlert('Are you sure to delete selected record(s)');
			}
			if(action=='P')
			{
				confirmAlert('Are you sure to publish selected record(s)');
			}
			if(action=='UP')
			{
	            confirmAlert('Are you sure to change the position of selected record(s)');
			}
			$("#hdnAction").val(action);
			$("#hdnIDs").val(PIds);
	  	}else{
			viewAlert('Please select a record!');
			return false;
		}	
	}
	 function loadnotifiation(userid,typeoflogin)
   {
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/website/ajax/loadnotifiation",
      data        : {userid:userid},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      },
      beforeSend: function () {
           
      },
      success: function (res) {
      	  var j=0;
         if(res.status==200){
           var result   = res.result;
          var html='';
         
         if(result!=null){
            $(result).each(function(i){	
              if(result[i].notificationId!=null){
              	j++;
              	var primary=result[i].notificationId;
            html+='<li class="notifications-not-read" onclick="addnotification(\''+result[i].notificationId+'\','+result[i].notificationType+','+userid+','+typeoflogin+')"><a href="javascript:void(0)"><span class="notification-icon" ><i class="icon-material-outline-group"></i></span> <span class="notification-text">'+result[i].notificationDesc+'</span></a></li>';

              }
              else
              {
              	html+='<li class="notifications-not-read no-data">No record Found</li>';
              }
             
            });
          }else{
            html+='<li class="notifications-not-read no-data">No record Found</li>';
          }
           

            $("#notification").html(html);

        


         }
          $("#countnotification").text(j);

      }
         });
   }
    function addnotification(notificationId,type,userid,typeoflogin)
   {
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/website/ajax/addnotification",
      data        : {notificationId:notificationId,type:type},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
         if(res.status==200){
         	var type=res.types;
         if(type==1){
          		window.location = SITE_URL+"/employer/job/managejob";
         }else if(type==2){
        		window.location = SITE_URL+"/employer/job/managejob";
        }
         else if(type==3 && typeoflogin==1){
          	  window.location = SITE_URL+"/employer/Messages";
         }
         else if(type==3 && typeoflogin==2){
          	  window.location = SITE_URL+"/candidate/Messages";
         }
         else if(type==3 && typeoflogin==3){
          	  window.location = SITE_URL+"/ngo/Messages";
         }
         else if(type==4){
         	  window.location = SITE_URL+"/employer/job/managejob";
         }else if(type==5){
         	  window.location = SITE_URL+"/employer/job/managejob";
         }else if(type==6){
         	  window.location = SITE_URL+"/candidate/Dashboard";
         }else if(type==7){
         	  window.location = SITE_URL+"/candidate/Dashboard";
         }else{
         	$(".utf-header-notifications-dropdown-block").hide();
         loadnotifiation(userid,typeoflogin);
         }



         }

      }
         });
   }


  var cuckiepolicy = getCookie('cuckiepolicy');
  // alert(cuckiepolicy)
 //S removeCookie(cuckiepolicy)
        
  if(cuckiepolicy=='SAYFCOOKIE')
  {
      $('.cookies').hide();
  }
  else{
      $('.cookies').show();
  }
  $('.cookies__close').click(function(){
          $(".cookies").hide();
          setCookie('cuckiepolicy','SAYFCOOKIE','360');
  })

   function loadcity(stateid,cityval){

    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/website/ajax/loadcity",
      data        : {stateid:stateid},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      },
      beforeSend: function () {    
      },
      success: function (res) {
        if(res.status==200){
             var result   = res.result;
             var html='';
             var selected='';
            if(result!=null){
               $(result).each(function (i,val) {
                selected='';
                if(cityval==val.locationId){
                     selected='selected';
                }
                html+='<option value="'+val.locationId+'" '+selected+'>'+val.location+'</option>';
                });
             }
             $('#selcity').html(html).selectpicker('refresh');
           }
       }
   });
  }
  
</script>

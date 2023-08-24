/* * ******************************************
  File Name     : commonAjax.js
  Description   : Controller file for managing all the ajax requests of Website and employer and employee
  Created By    : Samir kUmar
  Created On    : 14-Apr-2021

  ======================================================================
  |Update History                                                      |
  ======================================================================
  |<Updated by>                 |<Updated On> |<Remarks>
  ----------------------------------------------------------------------
  |Name Goes Here               |DD-MMM-YYYY  |Remark goes here
  ----------------------------------------------------------------------
  |                             |             |
  ----------------------------------------------------------------------

 * *******************function to upload file through ajax*********************** */
 function uploadcommonAjaxfile(inputFieldname,filenameField){
    var formdata = new FormData();
    var name=$("#"+inputFieldname).attr('name');
    formdata.append('title', name);
    formdata.append(name, $("#"+inputFieldname).get(0).files[0]);
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/candidate/ajax/uploadfile",
      data        : formdata,
      processData : false,
      contentType : false,
      cache       : false,
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        if(res.status == 200){
          console.log(inputFieldname);
          $("#"+inputFieldname).closest('div').find('.docLink').show();
          $("#"+inputFieldname).closest('div').find('.downLink').show();
          $("#"+inputFieldname).closest('div').find('.downLink').attr("href",SITE_URL+'/storage/app/uploads/temp/'+ res.file);
          $('#'+filenameField).val(res.file);
        }
      }
    });
}

function uploadcommonAjaxfileCV(inputFieldname,filenameField){
  var formdata = new FormData();
  var name=$("#"+inputFieldname).attr('name');
  formdata.append('title', name);
  formdata.append(name, $("#"+inputFieldname).get(0).files[0]);
  $.ajax({
    type        : 'POST',
    url         : SITE_URL + "/candidate/ajax/uploadfile",
    data        : formdata,
    processData : false,
    contentType : false,
    cache       : false,
    dataType    : "json",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function () {
         //$(".loading-gif").hide();
    },
    success: function (res) {
      if(res.status == 200){
        $('.docLinkCV').show();
        $('.downLinkCV').show();
        $('.downLinkCV').attr("href",SITE_URL+'/storage/app/uploads/temp/'+ res.file);
        $('#'+filenameField).val(res.file);
      }
    }
  });
}


function loadskillsCand(typedStr,rowId){
  $('#autofill-dropdown'+rowId).hide();
  $('#selected-skill'+rowId).html('');
  $.ajax({
    type        : 'POST',
    url         : SITE_URL + "/candidate/ajax/loadskillsCand",
    data        : {typedStr:typedStr},
    dataType    : "json",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function () {
         //$(".loading-gif").hide();
    },
    success: function (res) {
      if(res.status == 200){
        var result   = res.result;
        var bindData = '';
        if(res.status == 200){
          var result   = res.result;
          var bindData = '';
          if(result.length > 0){
            $('#autofill-dropdown'+rowId).html('');
            $('#autofill-dropdown'+rowId).show();
            $(result).each(function(i){
              //console.log(result[i].skillsId);
              bindData +='<li data-val="'+result[i].skillsId+'">'+result[i].skillName+'</li>';
            });
            $('#autofill-dropdown'+rowId).html(bindData);
            $("#autofill-dropdown"+rowId+" li").on("click", function(){
                var selectval = $(this).text();
                var selectid  = $(this).data('val');
                $("#autofill-dropdown"+rowId).hide();
                $("#selected-skill"+rowId).append("<li data-id='"+selectid+"'>"+selectval+"<span class='remove-skill'></span></li>");
                $("#txtSkill"+rowId).val(selectid);
                $(this).remove();
                $('.input-skill').val('');
                $(".remove-skill").on('click', function(){
                    $(this).parent('li').remove();
                    $("#txtSkill"+rowId).val('');
                });
            });
          }
        }
      }
    }
  });
}
function loadskills(typedStr){
  $('.autofill-dropdown').hide();
  if(typedStr != ''){
    var selectedskill = [];
    if($('.selected-skill li').length > 0){
      $('.selected-skill li').each(function(){
        var selval = $(this).data('id');
        selectedskill.push(selval);
      });
    }
    selectedskill = JSON.stringify(selectedskill);
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/employer/ajax/loadskills",
      data        : {typedStr:typedStr,selectedskill:selectedskill},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        if(res.status == 200){
          var result   = res.result;
          var bindData = '';
          if(result.length > 0){
            $('.autofill-dropdown').html('');
            $('.autofill-dropdown').show();
            $(result).each(function(i){
              //console.log(result[i].skillsId);
              bindData +='<li data-val="'+result[i].skillsId+'">'+result[i].skillName+'</li>';
            });
            $('.autofill-dropdown').html(bindData);
            $(".autofill-dropdown li").on("click", function(){
                var selectval = $(this).text();
                var selectid  = $(this).data('val');
                $(".autofill-dropdown").hide();
                $(".selected-skill").append("<li data-id='"+selectid+"'>"+selectval+"<span class='remove-skill'></span></li>");
                $(this).remove();
                $('.input-skill').val('');
                $(".remove-skill").on('click', function(){
                    $(this).parent('li').remove();
                });
            });
          }
        }
      }
    });
  }
}


function pushnewSkillCand(newText,rowNo){
  if(newText != ''){
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/candidate/ajax/pushnewSkillCand",
      data        : {newText:newText},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        //console.log(res)
        var retval = 0;
        if(res.status == 200){
          retval = res.resultid;
          $("#selected-skill"+rowNo).append("<li data-id='"+retval+"'>"+newText+"<span class='remove-skill'></span></li>");
          $("#txtSkill"+rowNo).val(retval);
          $(".input-skill").val("");
          $(".remove-skill").on('click', function(){
              $(this).parent('li').remove();
              $("#txtSkill"+rowNo).val('');
          });
        }
      }
    });
  }
}


function pushnewSkill(newText){
  if(newText != ''){
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/employer/ajax/pushnewSkill",
      data        : {newText:newText},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        //console.log(res)
        var retval = 0;
        if(res.status == 200){
          retval = res.resultid;
          $(".selected-skill").append("<li data-id='"+retval+"'>"+newText+"<span class='remove-skill'></span></li>");
          $(".input-skill").val("");
          $(".remove-skill").on('click', function(){
              $(this).parent('li').remove();
          });
        }
      }
    });
  }
}



function loadMessagehistory(msgHead,userId,companyid){
  //alert(msgHead+'======='+userId);
  $('#msgarea').focus();
  var chartFilepath = SITE_URL+'/storage/app/uploads/chatFiles';
  $('.message-trails').addClass('loading');
  $.ajax({
    type        : 'POST',
    url         : SITE_URL + "/candidate/ajax/loadMessagehistory",
    data        : {msgHead:msgHead,userId:userId},
    dataType    : "json",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function () {
         //$(".loading-gif").hide();
    },
    success: function (res) {
      //console.log(res)
      var retval     = 0;
      if(res.status == 200){
        $('.message-trails').removeClass('loading');
        var result   = res.result;
        var bindData = '';
        $('#hdnTorecp').val(companyid);
        $('#hdnChathead').val(msgHead);
        $(result).each(function(i){
            if(result[i].msgFrom == userId){
              if(result[i].msgText != ''){
                bindData +=`<div class="message-trail-item candidate">
                              <div class="message-container">
                                  <span class="messages-person-name">`+result[i].candidateName+`</span>
                                  <div class="message-full-content">
                                    <p>`+result[i].msgText+`</p>
                                  </div>
                              </div>
                            </div>`;
              }else if(result[i].msgFile != ''){
                bindData +=`<div class="message-trail-item candidate">
                              <div class="message-container">
                                  <span class="messages-person-name">`+result[i].candidateName+`</span>
                                  <div class="message-full-content">
                                    <div class="msg-attach">
                                      <span class="icon-line-awesome-file-word-o"></span>
                                      <a download href="`+chartFilepath+'/'+result[i].msgFile+`" title="Click to download">
                                        <p>`+result[i].msgFileName+`</p>
                                        <span class="icon-line-awesome-download"></span> 
                                      </a>
                                    </div>
                                  </div>
                              </div>
                            </div>`;          
              }
            }else{
              if(result[i].msgText != ''){
                bindData +=`<div class="message-trail-item">
                              <div class="message-container">
                                  <span class="messages-person-name">`+result[i].companyName+`</span>
                                  <div class="message-full-content">
                                    <p>`+result[i].msgText+`</p>
                                  </div>
                              </div>
                            </div>`;
              }else{
                bindData +=`<div class="message-trail-item">
                              <div class="message-container">
                                  <span class="messages-person-name">`+result[i].companyName+`</span>
                                  <div class="message-full-content">
                                    <div class="msg-attach">
                                      <span class="icon-line-awesome-file-word-o"></span>
                                      <a download href="`+chartFilepath+'/'+result[i].msgFile+`" title="Click to download">
                                        <p>`+result[i].msgFileName+`</p>
                                        <span class="icon-line-awesome-download"></span> 
                                      </a>
                                    </div>
                                  </div>
                              </div>
                            </div>`; 
              }
            }
        }); 

        $('.message-trails').html(bindData);
        $(".message-trails").animate({ scrollTop: $(document).height() * 5 }, 1000);
      }
    }
  });
}



function submitchat(){
  var hdnFromrecp = $('#hdnFromrecp').val();
  var hdnTorecp   = $('#hdnTorecp').val();
  var hdnChathead = $('#hdnChathead').val();
  var msgarea     = $('#msgarea').val();
  var hdnChatFile = $('#hdnChatFile').val();
  var hdnChatFileName = $('#hdnChatFileName').val();
  if(hdnFromrecp > 0 && hdnTorecp > 0 && msgarea != ''){
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/candidate/ajax/submitchat",
      data        : {hdnFromrecp:hdnFromrecp,hdnTorecp:hdnTorecp,hdnChathead:hdnChathead,msgarea:msgarea,hdnChatFile:hdnChatFile,hdnChatFileName:hdnChatFileName},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        //console.log(res)
        if(res.status == 200){
          if(hdnChathead == 0){
            $('#hdnChathead').val(res.convoHead);
            loadMessagehistory(res.convoHead,hdnFromrecp,hdnTorecp);
            $('#msgarea').val('');
            return false;
          }
          loadMessagehistory(hdnChathead,hdnFromrecp,hdnTorecp);
          
          $('#msgarea').val('');
        }
      }
    });
  }
}




function initiatechathead(senderId,receiverId){
  if(senderId > 0 && receiverId > 0){
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/candidate/ajax/initiatechathead",
      data        : {senderId:senderId,receiverId:receiverId},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        //console.log(res)
        if(res.status == 200){
          var bindData = '';
          var cnt = $.map(res.result, function(n, i) { return i; }).length;
          //console.log(len);
          if(cnt > 0){
            bindData += `<div class="message-item" data-messageid="0" data-company="`+receiverId+`">
                              <div class="messages-person-img">
                                <img src="`+res.result.profileImage+`" alt="">
                              </div>
                              <div class="messages-person-details">
                                <div class="messages-person">
                                  <h4>`+res.result.receiver+`</h4>
                                  <span class="message-time"></span>
                                </div>
                                <span class="message-short-content"></span>
                              </div>
                            </div>`;
          }
          $('#hdnTorecp').val(receiverId);
          $('.messages').prepend(bindData);
        }       
      }
    });
  }
}

function choosSubDisability(disableId,controlId,selectId){
  if(disableId != ''){
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/candidate/ajax/choosSubDisability",
      data        : {disableId:disableId,selectId:selectId},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        //console.log(res)
        if(res.status == 'success'){
          
          $("#"+controlId).html(res.subType);
          
        }
      }
    });
  }
}

function loadservices(typedStr){
  $('.autofill-dropdown').hide();
  if(typedStr != ''){
    var selectedservice = [];
    if($('.selected-skill li').length > 0){
      $('.selected-skill li').each(function(){
        var selval = $(this).data('id');
        selectedservice.push(selval);
      });
    }
    selectedservice = JSON.stringify(selectedservice);
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/ngo/ajax/loadservices",
      data        : {typedStr:typedStr,selectedservice:selectedservice},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        if(res.status == 200){
          var result   = res.result;
          var bindData = '';
          if(result.length > 0){
            $('.autofill-dropdown').html('');
            $('.autofill-dropdown').show();
            $(result).each(function(i){
              bindData +='<li data-val="'+result[i].serviceId+'">'+result[i].serviceName+'</li>';
            });
            $('.autofill-dropdown').html(bindData);
            $(".autofill-dropdown li").on("click", function(){
                var selectval = $(this).text();
                var selectid  = $(this).data('val');
                $(".autofill-dropdown").hide();
                $(".selected-skill").append("<li data-id='"+selectid+"'>"+selectval+"<span class='remove-skill'></span></li>");
                $(this).remove();
                $('.input-skill').val('');
                $(".remove-skill").on('click', function(){
                    $(this).parent('li').remove();
                });
            });
          }
        }
      }
    });
  }
}

function pushnewService(newText){
  if(newText != ''){
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/ngo/ajax/pushnewService",
      data        : {newText:newText},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        //console.log(res)
        var retval = 0;
        if(res.status == 200){
          retval = res.resultid;
          $(".selected-skill").append("<li data-id='"+retval+"'>"+newText+"<span class='remove-skill'></span></li>");
          $(".input-skill").val("");
          $(".remove-skill").on('click', function(){
              $(this).parent('li').remove();
          });
        }
      }
    });
  }
}




function loadcountryAjax(controlId){
  $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/website/ajax/loadcountryAjax",
      data        : {},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        //console.log(res.result[0].countryId)
        var bindData = '<option>Select Country</option>';
        if(res.status == 200){
          var result = res.result;
          if(result.length > 0){
            $(result).each(function(i){
              bindData += '<option value="'+result[i].country_name+'">'+result[i].country_name+'</option>';
            });
          }
        }
        $('#'+controlId).html(bindData).selectpicker('refresh');
      }
    });
}
@extends('layouts.partnerlayout')
@section('page-content')
<?php 
  $candidatelogodirpath  = STORAGE_PATH.'candidateProfile';
  $employerlogodirpath   = STORAGE_PATH.'companylogo';
  $chartFilepath         = STORAGE_PATH.'chatFiles';
?>  
<div class="utf-dashboard-content-container-aera" data-simplebar>
    <div id="dashboard-titlebar" class="utf-dashboard-headline-item">
      <div class="row">
        <div class="col-xl-12"> 
          <h3>Message</h3>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{ROOT_URL}}/ngo/dashboard">Home</a></li>
              <li>Message</li>
            </ul>
          </nav>
        </div>
      </div>    
    </div>
    <?php if(count($getMessageThread) > 0 || !empty($reqSenderId)){ ?>
    <div class="utf-dashboard-content-inner-aera"> 
      <div class="messages-container"> 
          <div class="message-person-list"> 
              <div class="content">
                <div class="messages">
                  <?php  
                    foreach ($getMessageThread as $ks => $vs) {
                      $leng          = count($vs->msgconv);
                        $lastMsg     = ($vs->msgconv[$leng-1]->msgText)?$vs->msgconv[$leng-1]->msgText:'Attachment';
                        $lastTime    = $vs->msgconv[$leng-1]->createdOn;
                        if($vs->respOne != session('partner_session_data.userId')){
                          if($vs->sender->tinUserType == 2){
                            $receiverId    = ($vs->sender->employer->employerId)?$vs->sender->employer->employerId:0;
                            $name          = ($vs->sender->employer->employerCompany)?$vs->sender->employer->employerCompany:'';
                            $img           = ($vs->sender->employer->companyLogo)?$vs->sender->employer->companyLogo:'';
                            if(Storage::disk('local')->exists('/uploads/companylogo/' . $img) && $img != ''){
                              $logofullpath= $employerlogodirpath.'/'.$img;
                            }else{
                              $logofullpath= PUBLIC_PATH.'images/user-avatar-placeholder.png';
                            }
                          }else if($vs->sender->tinUserType == 3){
                            $receiverId    = ($vs->sender->candidate->userId)?$vs->sender->candidate->userId:0;
                            if($vs->sender->candidate->middleName != ''){
                              $name        = $vs->sender->candidate->firstName.' '.$vs->sender->candidate->middleName.' '.$vs->sender->candidate->lastName;
                            }else{
                              $name        = $vs->sender->candidate->firstName.' '.$vs->sender->candidate->lastName;
                            }
                            $img           = ($vs->sender->candidate->profileImage)?$vs->sender->candidate->profileImage:'';
                            if(Storage::disk('local')->exists('/uploads/candidateProfile/' . $img) && $img != ''){
                              $logofullpath= $candidatelogodirpath.'/'.$img;
                            }else{
                              $logofullpath= PUBLIC_PATH.'images/user-avatar-placeholder.png';
                            }
                          }
                        }else{
                          if($vs->receiver->tinUserType == 2){
                            $receiverId    = ($vs->receiver->employer->employerId)?$vs->receiver->employer->employerId:0;
                            $name          = ($vs->receiver->employer->employerCompany)?$vs->receiver->employer->employerCompany:'';
                            $img           = ($vs->receiver->employer->companyLogo)?$vs->receiver->employer->companyLogo:'';
                            if(Storage::disk('local')->exists('/uploads/companylogo/' . $img) && $img != ''){
                              $logofullpath= $employerlogodirpath.'/'.$img;
                            }else{
                              $logofullpath= PUBLIC_PATH.'images/user-avatar-placeholder.png';
                            }
                          }else if($vs->receiver->tinUserType == 3){
                            $receiverId  = ($vs->receiver->candidate->userId)?$vs->receiver->candidate->userId:0;
                            if($vs->receiver->candidate->middleName != ''){
                              $name          = $vs->receiver->candidate->firstName.' '.$vs->receiver->candidate->middleName.' '.$vs->receiver->candidate->lastName;
                            }else{
                              $name          = $vs->receiver->candidate->firstName.' '.$vs->receiver->candidate->lastName;
                            }
                            $img         = ($vs->receiver->candidate->profileImage)?$vs->receiver->candidate->profileImage:'';
                            if(Storage::disk('local')->exists('/uploads/candidateProfile/' . $img) && $img != ''){
                              $logofullpath= $candidatelogodirpath.'/'.$img;
                            }else{
                              $logofullpath= PUBLIC_PATH.'images/user-avatar-placeholder.png';
                            }
                          }
                        }
                      ?>
                      <div class="message-item" data-messageid="{{$vs->convHeadId}}" data-candidateid="{{$receiverId}}">
                        <div class="messages-person-img">
                          <img src="<?php echo $logofullpath; ?>" alt="">
                        </div>
                        <div class="messages-person-details">
                          <div class="messages-person">
                            <h4>{{$name}}</h4>
                            <small class="message-time">{{@date('h:iA',strtotime($lastTime))}}</small>
                          </div>
                          <span class="message-short-content">{{@$lastMsg}}</span>
                        </div>
                      </div>
                    <?php  }  ?>

                </div>
              </div>        
            </div>
      
            <div class="message-trail-container"> 
                <div class="message-trails">
                  <div class="loading"></div>
                </div>

                <div class="message-input-container">
                  <div class="message-files">
                    <input type="file" name="chat_attach_file" id="chat_attach_file">
                    <span class="icon-material-outline-attach-file"></span>
                  </div>
                  <textarea id="msgarea" placeholder="Type here..."></textarea>                  
                  <input type="hidden" name="hdnFromrecp" id="hdnFromrecp" value="{{session('partner_session_data.userId')}}">
                  <input type="hidden" name="hdnTorecp" id="hdnTorecp" value="0">
                  <input type="hidden" name="hdnChathead" id="hdnChathead" value="0">
                  <input type="hidden" name="hdnChatFile" id="hdnChatFile" value="">
                  <input type="hidden" name="hdnChatFileName" id="hdnChatFileName" value="">
                  <a href="javascript:void(0);" class="button" onclick="return sendMessage();"><span class="icon-feather-send"></span></a>      
                </div>
              </div>        
            </div>
        </div>
        <?php }else if(empty($reqSenderId)){ ?>
          <!-- Section to show when there is no message available -->
            <div class="no-message">
              <div class="no-message__card">
                <svg viewBox="-5 0 512 512"><path d="m158.304688 451.371094h-81.351563s-38.308594 27.214844-38.308594 60.628906h63.972657l15.011718-8.101562 15.011719 8.101562h63.972656c0-33.414062-38.308593-60.628906-38.308593-60.628906zm0 0" fill="#efedee"/><path d="m357.867188 451.371094h-13.445313s-38.316406 27.214844-38.316406 60.628906h51.761719l27.230468-30.3125zm0 0" fill="#fb7073"/><path d="m412.320312 451.371094h13.445313s38.3125 27.214844 38.3125 60.628906h-51.757813l-27.230468-30.3125zm0 0" fill="#fb7073"/><path d="m172.382812 0c50.652344 0 91.71875 32.488281 91.71875 72.5625 0 27.246094-18.984374 50.980469-47.054687 63.386719 0 0-10.5 34.953125-40.84375 42.929687 0 0 3.6875-21.601562-3.820313-33.75-50.65625 0-91.71875-32.488281-91.71875-72.566406 0-40.074219 41.0625-72.5625 91.71875-72.5625zm0 0" fill="#e5ca61"/><path d="m0 344.53125c0-110.359375 55.742188-126.824219 117.628906-126.824219 28.925782 0 54.703125-2.117187 73.949219-4.371093 20.785156-2.433594 39.378906 12.925781 40.925781 33.796874 1.515625 20.511719 2.753906 51.355469 2.753906 97.398438zm0 0" fill="#e98f5e"/><path d="m132.640625 512-4.988281-34.15625h-20.050782l-4.984374 34.15625zm0 0" fill="#e16567"/><path d="m102.617188 455.292969v11.382812c0 8.289063 6.71875 15.011719 15.011718 15.011719 8.289063 0 15.011719-6.722656 15.011719-15.011719v-11.382812zm0 0" fill="#fb7073"/><path d="m357.867188 451.371094h54.453124v60.628906h-54.453124zm0 0" fill="#efedee"/><path d="m267.46875 344.539062c0-60.914062 49.421875-110.636718 111.570312-113.6875h12.109376c62.148437 3.046876 111.570312 52.773438 111.570312 113.6875zm0 0" fill="#596673"/><path d="m400.546875 231.683594c-3.097656-.394532-6.230469-.675782-9.398437-.832032h-12.109376c-62.148437 3.046876-111.570312 52.773438-111.570312 113.6875h30.90625c0-57.808593 44.511719-105.535156 102.171875-112.855468zm0 0" fill="#4b5866"/><path d="m292.835938 444.835938h184.515624c14.007813 0 25.367188-11.355469 25.367188-25.367188v-74.929688h-235.25v74.929688c0 14.007812 11.359375 25.367188 25.367188 25.367188zm0 0" fill="#596673"/><path d="m298.375 419.46875v-74.929688h-30.90625v74.929688c0 14.011719 11.355469 25.367188 25.367188 25.367188h30.90625c-14.011719 0-25.367188-11.355469-25.367188-25.367188zm0 0" fill="#4b5866"/><path d="m117.628906 278.804688c116.992188 0 117.628906 65.726562 117.628906 65.726562 0 62.867188-52.664062 113.832031-117.628906 113.832031s-117.628906-50.964843-117.628906-113.832031c0 0 .632812-65.726562 117.628906-65.726562zm0 0" fill="#fac4ae"/><path d="m0 344.53125h30.90625c0-110.359375 55.742188-126.824219 117.628906-126.824219 0 0-30.894531 0-30.90625 0-21.273437 0-41.820312 1.945313-59.625 8.980469-7.253906 2.867188-14.15625 6.644531-20.339844 11.40625-22.84375 17.59375-37.664062 49.53125-37.664062 106.4375zm0 0" fill="#de8250"/><path d="m502.71875 344.539062c0 62.855469-52.664062 113.828126-117.625 113.828126-64.964844 0-117.625-50.972657-117.625-113.828126 0 0 49.25-19.722656 78.246094-57.695312 3.414062-4.453125 9.539062-5.769531 14.460937-3.066406 21.921875 12.078125 81.527344 43.273437 142.542969 60.761718zm0 0" fill="#fac4ae"/><path d="m267.46875 344.539062c0 62.855469 52.660156 113.828126 117.625 113.828126 4.738281 0 9.414062-.28125 14.007812-.808594-57.582031-5.609375-104.542968-41.390625-100.726562-129.265625zm0 0" fill="#e2b09a"/><g fill="#464c51"><path d="m61.578125 360.046875c-4.265625 0-7.726563-3.460937-7.726563-7.726563v-10.898437c0-4.269531 3.460938-7.726563 7.726563-7.726563 4.269531 0 7.726563 3.457032 7.726563 7.726563v10.898437c0 4.265626-3.457032 7.726563-7.726563 7.726563zm0 0"/><path d="m173.679688 360.046875c-4.269532 0-7.726563-3.460937-7.726563-7.726563v-10.898437c0-4.269531 3.457031-7.726563 7.726563-7.726563 4.265624 0 7.726562 3.457032 7.726562 7.726563v10.898437c0 4.265626-3.460938 7.726563-7.726562 7.726563zm0 0"/><path d="m117.628906 375.449219c-6.136718 0-11.910156-2.582031-15.84375-7.078125-2.804687-3.214844-2.480468-8.09375.734375-10.902344 3.210938-2.808594 8.09375-2.480469 10.902344.734375.996094 1.136719 2.53125 1.792969 4.207031 1.792969 1.675782 0 3.210938-.65625 4.207032-1.792969 2.808593-3.214844 7.691406-3.542969 10.902343-.734375 3.214844 2.808594 3.542969 7.6875.734375 10.902344-3.933594 4.496094-9.707031 7.078125-15.84375 7.078125zm0 0"/><path d="m329.046875 360.046875c-4.265625 0-7.726563-3.460937-7.726563-7.726563v-10.898437c0-4.269531 3.460938-7.726563 7.726563-7.726563s7.726563 3.457032 7.726563 7.726563v10.898437c0 4.265626-3.460938 7.726563-7.726563 7.726563zm0 0"/><path d="m441.144531 360.046875c-4.265625 0-7.726562-3.460937-7.726562-7.726563v-10.898437c0-4.269531 3.460937-7.726563 7.726562-7.726563 4.269531 0 7.726563 3.457032 7.726563 7.726563v10.898437c0 4.265626-3.457032 7.726563-7.726563 7.726563zm0 0"/><path d="m385.097656 375.449219c-6.136718 0-11.914062-2.582031-15.84375-7.078125-2.808594-3.214844-2.480468-8.09375.734375-10.902344 3.210938-2.808594 8.089844-2.480469 10.902344.734375.996094 1.136719 2.527344 1.792969 4.207031 1.792969 1.675782 0 3.210938-.65625 4.207032-1.792969 2.804687-3.214844 7.6875-3.542969 10.902343-.734375 3.210938 2.808594 3.539063 7.6875.730469 10.902344-3.929688 4.496094-9.703125 7.078125-15.839844 7.078125zm0 0"/></g><path d="m330.84375 37.464844c-50.65625 0-91.71875 32.488281-91.71875 72.5625 0 27.246094 18.984375 50.980468 47.050781 63.386718 0 0 10.503907 34.953126 40.847657 42.929688 0 0-3.691407-21.601562 3.820312-33.753906 50.652344 0 91.71875-32.484375 91.71875-72.5625 0-40.074219-41.066406-72.5625-91.71875-72.5625zm0 0" fill="#f9db69"/><path d="m121.214844 458.300781c3.96875-.128906 7.925781-.414062 11.867187-.914062-57.664062-7.324219-102.175781-55.058594-102.175781-112.855469 0-18.949219 1.640625-35.125 4.675781-48.929688-35.289062 19.472657-35.582031 48.925782-35.582031 48.929688 0 27.503906 10.082031 52.730469 26.859375 72.410156 22.484375 26.363282 56.207031 41.421875 90.769531 41.421875 1.195313 0 2.390625-.023437 3.585938-.0625zm0 0" fill="#e2b09a"/></svg>
                <h5>You don't have any thread/messages till now.</h5>
                <p>No worries, <a href="<?php echo ROOT_URL.'/jobsearch'?>" title="">Explore New Jobs</a></p>
              </div>
            </div>
        <?php }?>

</div>    
</div>

@section('page-js')
<script
>
  $(document ).ready(function() {
     var userid='<?php echo SESSION('partner_session_data.userId');?>';
    loadnotifiation(userid,3);
    });
  $(function(){ 

    $('#msgarea').focus();
    $(".simplebar-scroll-content").animate({ scrollTop: $(".simplebar-scroll-content")[0].scrollHeight }, 1000);
    $(".message-trails").animate({ scrollTop: $(".message-trails")[0].scrollHeight }, 1000);

    $('#msgarea').keypress(function (e) {
     var key = e.which;
     if(key == 13)  // the enter key code
      {
        var text = $("#msgarea").val();
        if(text.trim().length>0){
           sendMessage();
        }else{
           $('#msgarea').focus();
        }   
      }
    });
   
    $('input[type=file]').change(function(e) { 
        var fileName = e.target.files[0].name;
        $('#msgarea').val(fileName);
        $('#msgarea').prop('readonly', true);
        var myFormData = new FormData();
        myFormData.append('chat_attach_file', e.target.files[0]);
        var name=$("#chat_attach_file").attr('name');
        myFormData.append('title', name);
        myFormData.append(name, $("#chat_attach_file").get(0).files[0]);
        $.ajax({
          url: SITE_URL + "/ngo/messages/uploadTempChatFile",
          type: 'POST',
          processData: false, // important
          contentType: false, // important
          dataType : 'json',
          data: myFormData,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(res){
            if(res.status == 200){
              $('#hdnChatFile').val(res.file);
              $('#hdnChatFileName').val(res.fileOrg);
            }
          }
        });
    });

    <?php if(!empty($reqSenderId)){ ?>
      var chklength = $('.message-item').length;
      if(chklength > 0){
        var compArr = [];
        $('.message-item').each(function(){
          var existinguser = $(this).data('candidateid');
          var msgId       = $(this).data('messageid');
          compArr.push(existinguser);
          if(existinguser == {{$reqSenderId}}){
            $('.message-item').removeClass('active');
            $(this).addClass('active');
            loadMessageshistory(msgId,<?php echo session('partner_session_data.userId') ?>,existinguser);
            return false;
          }
        });
        if($.inArray({{$reqSenderId}}, compArr) < 0){
          initiateChat(<?php echo session('partner_session_data.userId') ?>,<?php echo $reqSenderId; ?>);
          return false;
        }
      }else{
        initiateChat(<?php echo session('partner_session_data.userId') ?>,<?php echo $reqSenderId; ?>);
        return false;
      }  
    <?php }else{ ?>
      $('.message-item:first-child').click();  
    <?php } ?>
  })
  $('.message-item').click(function(){
    $('.message-item').removeClass('active');
    var messageid = $(this).data('messageid');    
    var candidateid = $(this).data('candidateid');
    $(this).addClass('active');
    loadMessageshistory(messageid,<?php echo session('partner_session_data.userId'); ?>,candidateid);
  });

  

  function loadMessageshistory(msgHead,userId,candidateId){
    
    var chartFilepath = '<?php echo $chartFilepath; ?>';
    $('.message-trails').addClass('loading');
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/ngo/messages/loadMessagehistory",
      data        : {msgHead:msgHead,userId:userId},
      dataType    : "json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
           //$(".loading-gif").hide();
      },
      success: function (res) {
        $('.message-trails').removeClass('loading');
        var retval     = 0;
        if(res.status == 200){
          var result   = res.result;
          var bindData = '';
          $('#hdnTorecp').val(candidateId);
          $('#hdnChathead').val(msgHead);
          $(result).each(function(i){
              if(result[i].msgFrom == userId){

                if(result[i].msgText != ''){
                    bindData +=`<div class="message-trail-item candidate">
                      <div class="message-container">
                          <span class="messages-person-name">`+result[i].companyName+`</span>
                          <div class="message-full-content">
                            <p>`+result[i].msgText+`</p>
                          </div>
                      </div>
                    </div>`;

                }else{                  
                  bindData +=`<div class="message-trail-item candidate">
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

              }else{

                if(result[i].msgText != ''){

                  bindData +=`<div class="message-trail-item ">
                                <div class="message-container">
                                    <span class="messages-person-name">`+result[i].candidateName+`</span>
                                    <div class="message-full-content">
                                      <p>`+result[i].msgText+`</p>
                                    </div>
                                </div>
                              </div>`;
                  }else{

                    bindData +=`<div class="message-trail-item">
                            <div class="message-container">
                                <span class="messages-person-name">`+result[i].candidateName+`</span>
                                <div class="message-full-content">
                                  <div class="msg-attach">
                                    <span class="icon-feather-file"></span>
                                    <a href="`+chartFilepath+'/'+result[i].msgFile+`" download title="Click to download">
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

  function sendMessage(){
    var hdnFromrecp = $('#hdnFromrecp').val();
    var hdnTorecp   = $('#hdnTorecp').val();
    var hdnChathead = $('#hdnChathead').val();
    var msgarea     = $('#msgarea').val();
    var hdnChatFile = $('#hdnChatFile').val();
    var hdnChatFileName = $('#hdnChatFileName').val();
    if(hdnFromrecp > 0 && hdnTorecp > 0 && msgarea != ''){
      $.ajax({
        type        : 'POST',
        url         : SITE_URL + "/ngo/messages/sendMessage",
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
              loadMessageshistory(res.convoHead,hdnFromrecp,hdnTorecp);
              $('#hdnChathead').val(res.convoHead);
            }else{
              loadMessageshistory(hdnChathead,hdnFromrecp,hdnTorecp);
            }
            $('#msgarea').val('');
          }
        }
      });
    }else{
      $('#msgarea').focus();
    }
  }

  function initiateChat(senderId,receiverId){
  if(senderId > 0 && receiverId > 0){
    $.ajax({
      type        : 'POST',
      url         : SITE_URL + "/ngo/messages/initiateChat",
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
            bindData += `<div class="message-item" data-messageid="0" data-candidateid="`+receiverId+`">
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

</script>
@endsection
@endsection

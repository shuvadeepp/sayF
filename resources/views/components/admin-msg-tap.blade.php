@if(session()->has('error'))
<div class="notification error closeable">
          <p>{{ session()->get('error') }}</p>
          <a class="close"></a> </div>
@endif
@if(session()->has('success'))

<?php
$successmsg=session()->get('success');
if(!empty(strpos($successmsg,'<br>')))
{
  $sMsg=explode('<br>',$successmsg);
  foreach( $sMsg as $msglist)
  {
    ?>
          <div class="notification success closeable">
          <p><?php echo $msglist ?></p>
          <a class="close"></a> </div>
    <?php
  }

}else{
  ?>
          <div class="notification success closeable">
          <p><?php echo session()->get('success') ?></p>
          <a class="close"></a> </div>
  <?php
}
?>


@endif

@if ($errors->any())
<div class="notification error closeable">
	
          @foreach ($errors->all() as $error)
        <li>{{ $error }}</li><a class="close"></a>
         @endforeach
   
         </div>
@endif



<div class="notification error closeable ajax-err" style="display: none;"></div>
<?php

/********************************************
  File Name	    : website.blade.php
  Description	: This file is used for Website Layout
  Created By	: Samir
  Created On	: 02-04-2021

  ======================================================================
  |Update History                                                      |
  ======================================================================
  |<Updated by>                 |<Updated On> |<Remarks>         
  ----------------------------------------------------------------------
  |Name Goes Here               |02-Apr-2021  |Remark goes here        
  ----------------------------------------------------------------------
  |                             |             |                  
  ----------------------------------------------------------------------

 ********************************************/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.doctype')

</head>

<body>
    <!--Loader-->
    <div class="vfx-loader">
        <div class="loader-wrapper">
            <div class="loader-content">
                <div class="loader-dot dot-1"></div>
                <div class="loader-dot dot-2"></div>
                <div class="loader-dot dot-3"></div>
                <div class="loader-dot dot-4"></div>
                <div class="loader-dot dot-5"></div>
                <div class="loader-dot dot-6"></div>
                <div class="loader-dot dot-7"></div>
                <div class="loader-dot dot-8"></div>
                <div class="loader-dot dot-center"></div>
            </div>
        </div>
    </div>
    <!-- Loader end -->
    <div id="wrapper" class="{{(request()->is('/')) ? 'pt-0' : ''}}">
      @include('includes.header')
      @yield('page-content')
      <?php if(request()->is('home-voice')){ ?>
      @include('includes.footerVoice')
      <?php }else{ ?> 
      @include('includes.footer')
      <?php } ?>
    </div>
    <!-- Wrapper / End --> 
    
    @include('includes.jselement')
    @include('includes.viewAlert')
    @yield('page-js')
    <script>

    </script>
</body>
</html>
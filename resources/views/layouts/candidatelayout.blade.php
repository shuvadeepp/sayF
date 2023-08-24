<?php

/********************************************
  File Name	  : adminlayout.blade.php
  Description	: This file is used for Website Layout
  Created By	: Sandeep Kumar Senapati
  Created On	: 05-04-2021

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
    <div id="wrapper" class="application">
      @include('includes.candidate.candidateHeader')

      <!-- Dashboard Container -->
        <div class="utf-dashboard-container-aera">
        @include('includes.candidate.candidateLeftSidebar')
        @yield('page-content')
    </div>
    <!-- Wrapper / End --> 
    
    <!-- @include('includes.application.footer') -->
    @include('includes.jselement')
    @include('includes.viewAlert')
    @yield('page-js')
    <script>

    </script>
</body>
</html>
<?php

?>
<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.12
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
  <head>
      <script src="/assets/dist/external.dist.js" type="text/javascript" charset="utf-8"></script>

      <!-- <link rel="stylesheet" href="/assets/xterm/xterm.css" /> -->

      <!-- Main styles for this application-->
      <link href="/assets/dist/external.dist.css" rel="stylesheet">

      <link rel="stylesheet" href="/assets/styles.css">

      <base href="./">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Snap Mosaic</title>

      <link rel="stylesheet" href="/assets/dist/external.fontawesome.css">

      <script src="/assets/snapMosaic/globalFunctions.js"></script>
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed">
      <form style="display: none;" method="POST" id="downloadContainerFileForm" action="/api/Instances/Files/GetPathController/get">
          <input value="" name="hostId"/>
          <input value="" name="path"/>
          <input value="" name="container"/>
          <input value="1" type="number" name="download"/>
      </form>
    <header class="app-header navbar navbar-dark bg-dark">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <i class="fas fa-bars" style="color: #dd4814;"></i>
      </button>
      <a class="navbar-brand" href="#">
             <img src="/assets/lxdMosaic/logo.png" style="width: 25px; height: 25px; margin-left: 1px; margin-right: 5px;" alt="">
             Snap Mosaic
      </a>
      <ul class="navbar-nav mr-auto d-md-down-none" id="mainNav">
          <li class="nav-item active">
            <a class="nav-link overview">
              <i class="fas fa-tachometer-alt"></i>
              <span class="hideNavText"> Dashboard </span>
            </a>
          </li>
        </ul>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav" id="sidebar-ul">

          </ul>
        </nav>
      </div>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb" id="mainBreadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
          <div id="dashboard" class="animated fadeIn">
            <div class="row">
                <div class="col-md-12" id="boxHolder">
                    <?php
                    require __DIR__ . "/boxes/overview.php";
                    require __DIR__ . "/boxes/snap.php";
                    ?>
                </div>
            </div>
            <!-- /.row-->
          </div>
        </div>
      </main>
    </div>
    <script type='text/javascript'>
    $(".boxSlide").hide();
    $(function(){
        $("#overviewBox").show();
        loadOverview();
    });

    </script>
  </body>
</html>

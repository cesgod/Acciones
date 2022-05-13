
<?php
session_start();


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Resumen de Movimiento de Acciones | CLYFSA</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link href="../../images/favicon.png" rel="icon" type="image/x-icon"/>
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  <link rel="stylesheet" href="./style.css">

  <script type="text/javascript" src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
  
  
<style type="text/css">

.bgdata{
	z-index: -100;
}
.qrdata{
	z-index: 100;
	position: absolute;
	bottom: -215px;
	left: 46px;
}

</style>
</head>
<body class="bg-theme bg-theme2">
 
<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="control.php">
       <img src="logo.png" class="logo-icon" alt="logo icon" width="50%">
       <h5 class="logo-text">Dashboard</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      <li>
        <a href="control.php">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="generarpdf.php">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Generar PDF</span>
        </a>
      </li>
    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item">
      <form class="search-bar">
        <input type="text" class="form-control" placeholder="Enter keywords">
         <a href="javascript:void();"><i class="icon-magnifier"></i></a>
      </form>
    </li>
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
      <span class="user-profile"><img src="assets/images/logo_clip.png" class="img-circle" alt="user avatar"></span>
      </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item user-details">
          <a href="javaScript:void();">
            <div class="media">
              <div class="avatar"><img class="align-self-start mr-3" src="assets/images/logo_clip.png" alt="user avatar"></div>
              <div class="media-body">
                <h6 class="mt-2 user-title">Admin</h6>
              </div>
            </div>
          </a>
          </li>
          <li class="dropdown-divider"></li>
          <li class="dropdown-item"><i class="icon-power mr-2"><a href="index.php"></i>Salir</li></a>
        </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
  
  <div class="content-wrapper">
    <div class="container-fluid">






          <div class="row mt-3">
            <div class="col-lg-12">
               <div class="card profile-card-2">                
                <div class="card-body pt-5">
                   <img src="assets/images/logo_clip.png"  style="margin: auto;display: block;">
                    <div class="text-center"><button class="btn btn-light"><h1 class="">DESCARGAR TÍTULO</h1></button></div><br><br>
                    <form>
                      
                      <!--<p class="text-center">Periodo:</p>
                        <input name="startDate" id="startDate" class="form-control date-picker" style="width: 500px; margin: auto;display: block;">-->
                      <br>
                      <h5><a href="assets/pdf/titulopdf.PDF" class="btn btn-info" style="margin: auto; display: block;" download><h3><b>PDF</b></h3></a></h5>
                    </form>
                      
                    </div>
                </div>                
         
          </div>
        </div>	
</div>
</div>
</div>
</div>





</body>
</html>
<script>
if(document.getElementById('ftnt_topbar_script')) {
    document.getElementById('ftnt_topbar_script').remove()
} else {
   var pluginHolder = document.createElement('div');
   document.body.appendChild(pluginHolder);
}

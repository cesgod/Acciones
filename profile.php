<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include 'conexion.php';

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}
$user=$_SESSION['user'];
$name=$_SESSION['nombres'];
$lastname=$_SESSION['apellidos'];
$titulo=$_POST['transfered'];
$cont=0;
$acc = mysqli_query($conexion, "SELECT * FROM accion");
$sql = mysqli_query($conexion, "SELECT * FROM titulo WHERE T_NUM = '".$titulo."'");
  while ($r = mysqli_fetch_assoc($sql)) {
    $owner=$r['OWNER'];
    $_SESSION['OWNER']=$owner;
    while ($ac = mysqli_fetch_assoc($acc)) {
      if ($ac['T_NUM']==$titulo) {
        $cont=$cont+1;
      }
    }
  }
$lsql = mysqli_query($conexion, "SELECT * FROM login WHERE OWNER = '".$owner."'");
  while ($ls = mysqli_fetch_assoc($lsql)) {
    $personan=$ls['NOMBRES'];
    $personal=$ls['APELLIDOS'];
    $personat=$personan.' '.$personal;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Dashboard Acciones | CLYFSA</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
   <link href="../images/favicon.png" rel="icon" type="image/x-icon"/>
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
<br><br><br>
<div class="row">
  <div class="col-lg-12">
  

    <div class="container">
      
      <div class="stepwizard col-md-offset-3">
          <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
              <a href="#step-1" type="button" class="btn btn-info">1</a>
              <p style="color: #ffffff;">PASO 1</p>
            </div>
            <div class="stepwizard-step">
              <a href="#step-2" type="button" class="btn btn-success" disabled="disabled">2</a>
              <p style="color: #ffffff;">PASO 2</p>
            </div>
            <div class="stepwizard-step">
              <a href="#step-3" type="button" class="btn btn-info" disabled="disabled">3</a>
               <p style="color: #ffffff;">PASO 3</p>
            </div>
            <div class="stepwizard-step">
              <a href="#step-4" type="button" class="btn btn-info" disabled="disabled">4</a>
               <p style="color: #ffffff;">PASO 4</p>
            </div>
          </div>
      </div>
      
     
    </div>

  </div>
</div>
  <div class="content-wrapper">
    <div class="container-fluid">

      <div class="row mt-3">
        <div class="col-lg-4">
           <div class="card profile-card-2">
            
            <div class="card-body pt-5">
               
                <div class="text-center"><button class="btn btn-light"><h1 class="">Título <?php echo "".$titulo.""; ?></h1></button></div><br><br>
                <div class="text-center"><p class="card-text"><h4><?php $owner=number_format($owner, 0,",",".");  echo $personat." C.I.: ".$owner."</h4></div><hr><div class='text-center'><h4>Acciones:</h4></div><div class='text-center' style='width=: 100%; margin: 0 auto;'> <b><h1><input readonly style='font-size: 44px; width: 300px;' value='".$cont."' class='btn btn-success in' style='width: 50%;'></input></h1><input class='inn' type='hidden' value='".$cont."'></input></b></div>"; ?></p>
                <div class="icon-block">
                  
                </div>
            </div>

            
        </div>

        </div>

        <div class="col-lg-8">
          
           <div class="card">
            <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                <li class="nav-item">
                     <span class="hidden-xs"></span>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-note"></i> <span class="hidden-xs">EXISTENTE</span></a>
                </li>
                <li class="nav-item">
                     <span class="hidden-xs"></span>
                </li>
            </ul>
            <form action="tdonelocal.php" method="POST">
            <div class="tab-content p-3 container1">
                
                
                
                <div class="tab-pane active" id="profile">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Usuario</label>
                            <div class="col-lg-9">
                              <select class="custom-select myselect" name="userdata"  id="myselect">
                                <option value=""></option>

                                 <?php

                                  $accq=0;
                                  $reg = mysqli_query($conexion, "SELECT * FROM login");
                                  $usern='';
                                  $userln='';
                                  $userci=0;
                                  $userid=0;
                                    while ($r   = mysqli_fetch_assoc($reg)) {
                                      $usern    = $r['NOMBRES'];
                                      $userln   = $r['APELLIDOS'];
                                      $userci   = $r['OWNER'];
                                      $userid   = $r['ID'];
                                      echo '<option name="userdata" value="'.$userid.'">'.$userid['ID'].' | '.$usern.' '.$userln.' | '.$userci.'</option>';
                                    }
                                ?>
                              </select>
                            </div>
                        </div>
                        <input class="count" name="count" type="hidden" value="1" readonly>  
                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Acciones</label>
                            <div class="col-lg-9">

                              <?php
                                $accq=0;
                                $acc = mysqli_query($conexion, "SELECT * FROM accion");
                                $sql = mysqli_query($conexion, "SELECT * FROM titulo WHERE T_NUM = '".$titulo."'");

                                  while ($r = mysqli_fetch_assoc($sql)) {
                                    while ($ac = mysqli_fetch_assoc($acc)) {
                                      if ($ac['T_NUM']==$titulo) {
                                        $accq=$accq+1;      
                                        #$owner=$accq['OWNER'];                                                                             
                                      }
                                    }
                                  }
                                  echo '    <input class="form-control out" type="number" value="" name="n_accion1" placeholder="Limite ('.$accq.')" min="1" max="'.$accq.'"  > 
                                            <input type="hidden" name="titulo" value="'.$titulo.'">
                                            ';
                              ?>
                            
                            </div>
                        </div>
                       
                        

                        
                       
                       

                       
                   
                </div>

            </div>
             <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"><button class="add_form_field btn btn-info cloneBtn">Agregar Propietario &nbsp; 
                              <span style="font-size:16px; font-weight:bold;">+ </span>
                            </button></label>
                            <div class="col-lg-9">
                             
                               
                            
                            </div>
                        </div>
             <div class="form-group row">
                <label class="col-lg-3 col-form-label form-control-label"></label>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                  <label class="form-check-label" for="flexCheckDefault">
                   Acepto los términos de los <a href="assets/docs/estatutos_sociales.pdf" target="_blank">Estatutos Sociales</a>
                  </label>
                </div>
                <div class="col-lg-9">
                    <input type="reset" class="btn btn-info" value="Reset">
                    <input type="submit" class="btn btn-success" value="Transferir">
                </div>
            </div>
             </form>
        </div>
      </div>
      </div>
        
    </div>

	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->
	
    </div>
    <!-- End container-fluid-->
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2018 Dashtreme Admin
        </div>
      </div>
    </footer>
	<!--End footer-->
	
	<!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
		<li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>
      
     </div>
   </div>
  <!--end color switcher-->
   
  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
	
</body>
</html>

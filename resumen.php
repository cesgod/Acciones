                            <?php
session_start();
include 'conexion.php';

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}
$user=$_SESSION['user'];
$name=$_SESSION['nombres'];
$lastname=$_SESSION['apellidos'];

?>
<!DOCTYPE html>
<html lang="en">
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
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

  <script type="text/javascript">
    function getPDF(){

    var HTML_Width = $(".canvas_div_pdf").width();
    var HTML_Height = $(".canvas_div_pdf").height();
    var top_left_margin = 5;
    var PDF_Width = HTML_Width+(top_left_margin*2);
    var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;
    
    var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
    

    html2canvas($(".canvas_div_pdf")[0],{allowTaint:true}).then(function(canvas) {
      canvas.getContext('2d');
      
      console.log(canvas.height+"  "+canvas.width);
      
      
      var imgData = canvas.toDataURL("image/jpeg", 1.0);
      var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
      
      
      for (var i = 1; i <= totalPDFPages; i++) { 
        pdf.addPage(PDF_Width, PDF_Height);
        pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
      }
      
        pdf.save("HTML-Document.pdf");
        });
  };
  </script>
  
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
      <!--<li>
        <a href="profile.php">
          <i class="zmdi zmdi-format-list-bulleted"></i> <span>Transferir</span>
        </a>
      </li> -->
      <li>
        <a href="https://pdfgeneratorapi.com/">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Generar PDF</span>
        </a>
      </li>
      
<!--
       <li>
        <a href="register.html" target="_blank">
          <i class="zmdi zmdi-account-circle"></i> <span>Registration</span>
        </a>
      </li>

      <li class="sidebar-header">LABELS</li>
      <li><a href="javaScript:void();"><i class="zmdi zmdi-coffee text-danger"></i> <span>Important</span></a></li>
      <li><a href="javaScript:void();"><i class="zmdi zmdi-chart-donut text-success"></i> <span>Warning</span></a></li>
      <li><a href="javaScript:void();"><i class="zmdi zmdi-share text-info"></i> <span>Information</span></a></li>
    -->
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
              <a href="#step-2" type="button" class="btn btn-info" disabled="disabled">2</a>
              <p style="color: #ffffff;">PASO 2</p>
            </div>
            <div class="stepwizard-step">
              <a href="#step-3" type="button" class="btn btn-success" disabled="disabled">3</a>
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

<div class="row">
        <div class="col-lg-6">
          <h5><button class="btn btn-info" onclick="getPDF()">Descargar</button></h5>
            <div class="card-body canvas_div_pdf" style="background: #ffffff; color: #000000; padding: 50px; text-align: justify;">
              <h5 class="card-title" style="color: #000000; text-align: center;">COMPAÑÍA DE LUZ Y FUERZA S.A.</h5> <br>
              <p style="text-align: right;">Villarrica <?php echo " " . date("l"); echo " " . date("d/m/Y") . ""; ?></p><br>
                  <!--<div class="cards">-->
                    <div> 


Señor<br>
Presidente del Directorio de la CLYFSA<br>
<u>Presente</u><br><br><br>

De mi mayor consideración:<br>
  Por medio de la presente nota me dirijo a Ud. y por su digno intermedio al Directorio de la Compañía de Luz y Fuerza S.A. a fin de dejar expresa constancia y el registro respectivo de la entrega por parte de la empresa CLYFSA de:<br>
<b>1.</b>  Acciones Nominativas individualizadas como: <br>
<ul>
  <li>Titulo No: <b><?php echo "".$_SESSION['FTITLE']?></b></li>
  <li>Serie: <b><?php echo "".$_SESSION['FSERIE']?></b></li>
  <li>Cantidad de Acciones: <b><?php echo "".$_SESSION['FACCIONES']?></b></li>
  <li>Acción No. <b><?php echo "".$_SESSION['FPACCION']?></b> a la Acción No. <b><?php echo "".$_SESSION['FUACCION']?></b> </li>
</ul>

<b>2.</b>  Estatuto Social de la CLYFSA modificado por Asamblea Extraordinaria de fechas 15 y 27 de Junio de 2020 y vigente desde su inscripción en los registros públicos respectivos en fecha 04 de febrero del año 2021.-<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Esta comunicación es válida y vinculante para el accionista, por lo que solicito el correspondiente acuse de recibo de la CLYFSA.-

<p class="text-center">Sin otro particular me despido de Ud. saludándole muy atte.</p><br><br><br>
  <div style="margin-left: 250px;">
      <?php 
        $tuname=$_SESSION['tuname'];
        $tulname=$_SESSION['tulname'];
        $tuowner=$_SESSION['tuowner'];
        for ($i=0; $i < $_SESSION['tutotransfer']; $i++) { 
          echo '<p class=""></p><p class="">....................................</p> <p class="">Accionista:';
          echo $tuname[$i]." ";
          echo $tulname[$i];
          echo '<p class="">C.I. No.: '.$tuowner[$i].'</p>';
        }
      ?>


    
    
  </div>

</div>
                 <!-- </div>-->        
                </div>
          </div>
      </div><!--End Row-->
  </div><!--End Row-->
  <br><br>
 <h5><button class="btn btn-info"> <a href="fileup.php">SIGUIENTE</a></button></h5>
    
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
  <!--<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2021 Dashboard Admin
        </div>
      </div>
    </footer>-->
  <!--End footer-->
  
  <!--start color switcher-->
   <div class="right-sidebar">
   
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
  <!-- Bootstrap core JavaScript
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>-->
  <script src="assets/js/bootstrap.min.js"></script>
  
  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->

  <script type="text/javascript">
          $(document).ready( function () {
          $('#Mytable').DataTable({
              dom: 'Bfrtip',
              "pageLength": 100,
              buttons: [
              'copyHtml5',
              'excelHtml5',
              'csvHtml5',
              'pdfHtml5'
              ]
            });
      } );    
  </script>
  <script src="./script.js"></script>
  <!-- Index js -->
  <!--<script src="assets/js/index.js"></script>-->
  <!--<script src="chartdata.js"> </script>-->

  
</body>
</html>
<script>
if(document.getElementById('ftnt_topbar_script')) {
    document.getElementById('ftnt_topbar_script').remove()
} else {
   var pluginHolder = document.createElement('div');
   document.body.appendChild(pluginHolder);
}
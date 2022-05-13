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
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Expanding Card Grid With Flexbox</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Slabo+27px|Yesteryear'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="./style.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style type="text/css">
  .bt{
    width: 500px;
  }
  .keyp{
    font-family: sans-serif;
    font-size: 8pt;
  }
</style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="wrapper">

  <div class="header">
    <h2 class="header__subtitle"><img src="logo.png" width="80px"></h2><br><br>
    <h1 class="header__title"><b>Acciones | CLYFSA</b></h1><br><br><br><br>
    <h2 class="header__subtitle"><?php echo "Titular: ".$name." ".$lastname." ".$user; ?></h2>
    
  </div>

  <div class="cards">
<?php

include 'conexion.php';

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}


$sql = mysqli_query($conexion, "SELECT * FROM titulo WHERE OWNER = '$user'");
$acc = mysqli_query($conexion, "SELECT * FROM accion");
#$rangept = mysqli_query($conexion, 'SELECT * FROM potencia_range');
#echo "<h2>Usuario: ".$user."</h2>";
$qtt=0;
$f='';
    while ($r = mysqli_fetch_assoc($sql)) {

      $titulos  = $r['T_NUM'];
      $serie    = $r['SERIE'];
      echo '<div class=" card [ is-collapsed ] ">
              <div class="card__inner [ js-expander ]">
                <span>Título '.$titulos.'</span>
                <i class="fa fa-folder-o"></i>
              </div>
             <div class="card__expander">
                    <i class="fa fa-close [ js-collapser ]"></i>
                   
              ';
      #echo "<br><br><h4>Titulos: ".$titulos."</h4>";
      
        while ($a = mysqli_fetch_assoc($acc)) {
          if ($a['T_NUM']==$titulos) {
            $qtt=$qtt+1;
            $acciones  = $a['ID'];
            $A_KEY  = $a['A_KEY'];
            #echo "<button class='btn btn-info bt'>Accion: <b>".$acciones."</b>   <p class='keyp'>(".$a['A_KEY'].")</p></button><br><br>";
            #$f = new NumberFormatter("es", NumberFormatter::SPELLOUT);
            #var_dump($f->format($qtt));
            $f = preg_replace('/[0-9]+/', '', $a['A_KEY']);
            echo ' <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#'.$f.'">
                      Acción: <b>'.$acciones.'</b>
                 | </button>';
            $a=0;
          }
        }
      $acc = mysqli_query($conexion, "SELECT * FROM accion");
      echo '
      </div>
      Acciones: '.$qtt.'
      </div>';
      $qtt=0;
    }
    #echo $modals;

 ?>
   

    

  </div>

</div>
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>-->

<!-- Modal -->
<div class="modal fade" id="bedcfdfbbffedeedaedcfd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $user; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">   changes</button>
      </div>
    </div>
  </div>
</div>

<!-- partial -->
  
  <script src="./script.js"></script>
  
  

</body>
</html>

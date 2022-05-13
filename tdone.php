<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include 'conexion.php';

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}


$titulo=$_POST['titulo'];
echo "Titulo: ".$titulo;
#die();
$f_titulo=$titulo.'.1';
$s_titulo=$titulo.'.2';
$accion=$_POST['n_accion'];
$name=$_POST['name'];
$lastname=$_POST['lastname'];
$cedula=$_POST['cedula'];
$ruc=$_POST['ruc'];
$celular=$_POST['celular'];
$email=$_POST['email'];

#$owner=$_SESSION['OWNER'];

$sql = mysqli_query($conexion, "SELECT * FROM titulo WHERE T_NUM = '".$titulo."'");
  while ($r = mysqli_fetch_assoc($sql)) {
    $owner=$r['OWNER'];
    echo "OWNER: ".$owner;
    $serie=$r['SERIE'];
  }
$qlg=0;
$lg = mysqli_query($conexion, "SELECT * FROM login");
  while ($l = mysqli_fetch_assoc($lg)) {
    #$qlg=$qlg=1;
    $lgid=$lgid+1;
    echo("<br>ID: ".$lgid);
  }
#$qlg=$qlg-1;
$nid=$lgid;
echo "<br> LAST ID: ".$nid."<br>";
$upda = "UPDATE accion SET OWNER = '".$owner."', T_NUM = '".$f_titulo."' WHERE accion.T_NUM = ".$titulo."";
$updf = "UPDATE accion SET OWNER = '".$cedula."', T_NUM = '".$s_titulo."' WHERE accion.T_NUM = ".$f_titulo."  LIMIT ".$accion." ";
$upds = "UPDATE titulo SET OWNER = '".$owner."', SERIE = '".$serie."', ESTADO = 'Inactivo'  WHERE titulo.T_NUM = ".$titulo."";
$ntitle = "INSERT INTO titulo (T_NUM, SERIE, OWNER, ESTADO) VALUES ('".$f_titulo."', '".$serie."', '".$owner."', 'Activo' )";
$stitle = "INSERT INTO titulo (T_NUM, SERIE, OWNER, ESTADO) VALUES ('".$s_titulo."', '".$serie."', '".$cedula."', 'Activo' )";
#$nuser = 'INSERT INTO login (ID, OWNER, PSSW, NOMBRES, APELLIDOS) VALUES ("", "'.$cedula'", "asdfasdfasdfasdf", "'.$name.'", "'.$lastname.'" )';
$nuser = "INSERT INTO login (ID, OWNER, PSSW, NOMBRES, APELLIDOS, RUC, TELEFONO, EMAIL) VALUES ('".$nid."', '".$cedula."', 'asdf', '".$name."', '".$lastname."', '".$ruc."', '".$celular."', '".$email."' )";

#$updf = "UPDATE accion SET OWNER = '".$owner."', T_NUM = '".$f_titulo."' WHERE accion.T_NUM = ".$titulo."";
#$oldtitle = "INSERT INTO titulo VALUES (".$titulo.", ".$serie.", ".$owner.", Inactivo )";
#$upd = "UPDATE accion SET OWNER = '".$owner."', T_NUM = '".$titulo."' WHERE accion.ID = ".$accion."";
#$sql = "INSERT INTO users (username, password, email)
 #   VALUES ('".$_POST["username"]."','".$_POST["password"]."','".$_POST["email"]."')";
#var_dump($nuser);
#die();
mysqli_query($conexion, $upda);
mysqli_query($conexion, $updf);
mysqli_query($conexion, $upds);
mysqli_query($conexion, $ntitle);
mysqli_query($conexion, $stitle);
mysqli_query($conexion, $nuser);



echo "accion: ".$accion;
var_dump($nuser);
#die();
header('Location: resumen.php')

?>
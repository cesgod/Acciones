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


$naccion=$_POST['n_accion1'];
$ncount=$_POST['count'];
$f_titulo=$titulo.'.1';
$nc=0;
$na=0;
$tacc=0;
$s_titulo=array();
$accion=array();
for ($i=0; $i <$ncount ; $i++) { 
	$nc=$i+1;
	$s_titulo[]=$titulo.'.'.$nc;
}
for ($j=0; $j < $ncount ; $j++) { 
	$na=$j+1;
	$accion[]=$_POST['n_accion'.$na];
	$tacc=$tacc+$_POST['n_accion'.$na];

}
#$tacc=$tacc+$naccion;
$accionest=array();

echo "<br>Acciones: ".$tacc."<br>Propietarios: ".$ncount;
$apu=round($tacc/$ncount);


echo "<br>Acciones por Propietario: ".$apu;
$tapu=$apu*$ncount;
echo "<br>Acciones por Propietario T: ".$tapu;
$greater=0;
if ($tapu>$tacc) {
	$greater=1;
	$tapu=$tapu-$tacc;
}else if ($tapu<$tacc) {
	$greater=2;
	$tapu=$tacc-$tapu;
}



if ($tapu<$tacc) {
	$greater=2;
	$tapu=$tacc-$tapu;
}

$tapu=round($tapu/$ncount);
$rest=$tacc-($tapu*$ncount);

echo "<br>Acciones por Propietario F: ".$tapu;
echo "<br>Acciones por Propietario R: ".$rest;

for ($k=0; $k <$ncount ; $k++) {
	if ($k==0) {
		$accionest[]=$tapu+$rest;
	}else{
		$accionest[]=$tapu;
	}
}

echo "<br><pre>"; print_r($accionest);echo "</pre>";

echo "<br>Titulo: ".$f_titulo;
echo "<br><pre>"; print_r($s_titulo);echo "</pre>";


$udata=$_POST['userdata'];

$tudata=array();
$tuowner=array();
$tuname=array();
$tulname=array();

$tudata[] = $_POST['userdata'];
for ($i=2; $i <= $ncount; $i++) { 
	$tudata[] = $_POST['userdata'.$i];
	
	//
}
#echo "<br>UserData: ".$_POST['userdata'.$i]."<br>";
echo "<br>UserData: <pre>"; print_r($tudata);echo "</pre><br>";

$f_titulo=$titulo.'.1';
$s_titulo=$titulo.'.2';
$accn=0;

for ($i=0; $i < $ncount; $i++) { 
	$tusers = mysqli_query($conexion, "SELECT * FROM login WHERE ID = '".$tudata[$i]."' ");	
	while ($r = mysqli_fetch_assoc($tusers)) {
    $tuowner[]=$r['OWNER'];
    $tuname[]=$r['NOMBRES'];
    $tulname[]=$r['APELLIDOS'];
    
  }
}

echo "<br>Cedulas: <pre>"; print_r($tuowner);echo "</pre><br>";
echo "<br>Nombres: <pre>"; print_r($tuname);echo "</pre><br>";
echo "<br>Apellidos: <pre>"; print_r($tulname);echo "</pre><br>";

$_SESSION['tuowner']=$tuowner;
$_SESSION['tuname']=$tuname;
$_SESSION['tulname']=$tulname;
$_SESSION['tutotransfer']=$ncount;


#$owner=$_SESSION['OWNER'];
$sqla= mysqli_query($conexion, "SELECT * FROM accion WHERE T_NUM = '".$titulo."'");
	while ($acc=mysqli_fetch_assoc($sqla)) {
		$accn=$accn+1;
	  	if ($accn==1) {
	  		$_SESSION['FPACCION']=$acc['ID'];
	  	}
	  	echo "acc: ".$accn." - Current: ".$acc['ID']."<br>";
	  	if ($accn==$tacc) {
	  		$_SESSION['FUACCION']=$acc['ID'];
	  	}
	}

$sql = mysqli_query($conexion, "SELECT * FROM titulo WHERE T_NUM = '".$titulo."'");
  while ($r = mysqli_fetch_assoc($sql)) {
    $owner=$r['OWNER'];
    echo "OWNER: ".$owner;
    $serie=$r['SERIE'];
  }
 $_SESSION['FTITLE']=$titulo;
 $_SESSION['FSERIE']=$serie;
 $_SESSION['FACCIONES']=$tacc;

$flg = mysqli_query($conexion, "SELECT * FROM login WHERE OWNER = '".$udata."' ");
  while ($fl = mysqli_fetch_assoc($flg)) {
  	 $_SESSION['FACCIONES']=$fl['OWNER'];
  }


$lg = mysqli_query($conexion, "SELECT * FROM login WHERE ID = '".$udata."' ");
  while ($l = mysqli_fetch_assoc($lg)) {
  	$cedula=$l['OWNER'];
  }
  echo "<br>UserID:".$udata;

$qacc= mysqli_query($conexion, "SELECT * FROM accion WHERE T_NUM = '".$titulo."' ");

echo "<br> Accion desde: ".$_SESSION['FPACCION']."<br> Accion hasta: ".$_SESSION['FUACCION']."<br>Titulo: ".$_SESSION['FTITLE']."<br> Serie: ".$_SESSION['FSERIE']."<br> Acciones: ".$_SESSION['FACCIONES'] ;





#die();


header('Location: resumen.php');
die();


$upda = "UPDATE accion SET OWNER = '".$owner."', T_NUM = '".$f_titulo."' WHERE accion.T_NUM = ".$titulo."";
$updf = "UPDATE accion SET OWNER = '".$cedula."', T_NUM = '".$s_titulo."' WHERE accion.T_NUM = ".$f_titulo."  LIMIT ".$accion." ";
$upds = "UPDATE titulo SET OWNER = '".$owner."', SERIE = '".$serie."', ESTADO = 'Inactivo'  WHERE titulo.T_NUM = ".$titulo."";
$ntitle = "INSERT INTO titulo (T_NUM, SERIE, OWNER, ESTADO) VALUES ('".$f_titulo."', '".$serie."', '".$owner."', 'Activo' )";
$stitle = "INSERT INTO titulo (T_NUM, SERIE, OWNER, ESTADO) VALUES ('".$s_titulo."', '".$serie."', '".$cedula."', 'Activo' )";
#$nuser = 'INSERT INTO login (ID, OWNER, PSSW, NOMBRES, APELLIDOS) VALUES ("", "'.$cedula'", "asdfasdfasdfasdf", "'.$name.'", "'.$lastname.'" )';
#$nuser = "INSERT INTO login (ID, OWNER, PSSW, NOMBRES, APELLIDOS, RUC, TELEFONO, EMAIL) VALUES ('".$nid."', '".$cedula."', 'asdf', '".$name."', '".$lastname."', '".$ruc."', '".$celular."', '".$email."' )";

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
#mysqli_query($conexion, $nuser);



echo "accion: ".$accion;
var_dump($nuser);
#die();
header('Location: resumen.php')

?>
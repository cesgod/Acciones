
<?php
session_start();
?>

<?php

include 'conexion.php';

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}



$user = $_POST['user'];
$password = $_POST['password'];
echo "user: ".$user;
echo "<br>Pass01: ".$password;
$password = hash('sha256', $password);
echo "<br>Pass02: ".$password; 
$sql = "SELECT * FROM $tbl_name WHERE OWNER = '$user'";


$result = $conexion->query($sql);


if ($result->num_rows > 0) {  echo "string";   }
	
 
  $row = $result->fetch_array(MYSQLI_ASSOC);
 // if (password_verify($password, $row['password'])) { 
echo "<br>User:".$user."<br>Pass: ".$password;
#die();
if ($password==$row['PSSW']) { 

 
    $_SESSION['loggedin'] = true;
    $_SESSION['user'] = $user;
    $_SESSION['apellidos'] = $row['APELLIDOS'];
    $_SESSION['nombres'] = $row['NOMBRES'];
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (20 * 6000);

    echo "Bienvenido! " . $_SESSION['user'];
    echo "<br><br><a href=inicio.php>Panel de Control</a>"; 
    
    

     # header('Location: acciones.php');
      header('Location: control.php');

    

  }else { 
    header('Location: index.php');//redirecciona a la pagina del usuario
   }
 mysqli_close($conexion); 
 ?>
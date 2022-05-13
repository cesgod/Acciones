<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include 'conexion.php';

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);



 if(isset($_FILES['pic'])){
      $errors= array();
      $file_name = $_FILES['pic']['name'];
      $file_size = $_FILES['pic']['size'];
      $file_tmp = $_FILES['pic']['tmp_name'];
      $file_type = $_FILES['pic']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['pic']['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
   
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"assets/docs/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }else{
   	echo "Not an image";
   }
die();

#$nuser = 'INSERT INTO login (ID, OWNER, PSSW, NOMBRES, APELLIDOS) VALUES ("", "'.$cedula'", "asdfasdfasdfasdf", "'.$name.'", "'.$lastname.'" )';
#$nuser = "INSERT INTO login (ID, OWNER, PSSW, NOMBRES, APELLIDOS, RUC, TELEFONO, EMAIL) VALUES ('".$nid."', '".$cedula."', 'asdf', '".$name."', '".$lastname."', '".$ruc."', '".$celular."', '".$email."' )";

#$updf = "UPDATE accion SET OWNER = '".$owner."', T_NUM = '".$f_titulo."' WHERE accion.T_NUM = ".$titulo."";
#$oldtitle = "INSERT INTO titulo VALUES (".$titulo.", ".$serie.", ".$owner.", Inactivo )";
#$upd = "UPDATE accion SET OWNER = '".$owner."', T_NUM = '".$titulo."' WHERE accion.ID = ".$accion."";
#$sql = "INSERT INTO users (username, password, email)
 #   VALUES ('".$_POST["username"]."','".$_POST["password"]."','".$_POST["email"]."')";
#var_dump($nuser);
#die();






header('Location: control.php')

?>
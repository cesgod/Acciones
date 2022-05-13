
<?php
session_start();
include 'conexion.php';

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$tnum=$_POST['pdfdata'];
$name=0;
$lname=0;
$ci=0;

$gnames = array();
$glnames = array();
$gci = array();
$gruc = array();
$gltel = array();
$gemail = array();
$gcont = 0;

$ti = mysqli_query($conexion, "SELECT * FROM titulo where T_NUM = $tnum");
  while ($t = mysqli_fetch_assoc($ti)) {
    #$qlg=$qlg=1;
    $serie    = $t['SERIE'];
    $owner    = $t['OWNER'];
    $status   = $t['ESTADO'];
    $gacc     = $t['GROUP_ACC'];
    #$id=$t['ID'];
    
    #echo("<br>ID: ".$lgid);
  }

if ($status=='Activo') {
  if ($gacc == 1) {
    #echo "trueeeeeeeeeee    ". $tnum;
     $gc = mysqli_query($conexion, "SELECT * FROM group_acc WHERE T_NUM = $tnum ");
      while ($ga = mysqli_fetch_assoc($gc)) {
        $gcont=$gcont+1;
        $gp = mysqli_query($conexion, "SELECT * FROM login WHERE OWNER = '".$ga['OWNER']."' ");
        while ($gg = mysqli_fetch_assoc($gp)) {
          #echo $ga['OWNER']. " "."<br>";
          if ($gg['OWNER']<>$gci[$gcont-1]){
            $gci[] = $gg['OWNER'];
            $gnames[] = $gg['NOMBRES'];
            $glnames[] = $gg['APELLIDOS'];

          }
        }
      }
  }
}  
#echo "<pre>";print_r($gci);echo "</pre>";
#echo "<pre>";print_r($gnames);echo "</pre>";
#die();  
$lg = mysqli_query($conexion, "SELECT * FROM login where OWNER = $owner");
  while ($l = mysqli_fetch_assoc($lg)) {
    #$qlg=$qlg=1;
    $name=$l['NOMBRES'];
    $lname=$l['APELLIDOS'];
    $ci=$l['OWNER'];
    #echo("<br>ID: ".$lgid);
  }




$first=0;
$last=0;
$cont=0;
$ac = mysqli_query($conexion, "SELECT * FROM accion where T_NUM = $tnum");
  while ($a = mysqli_fetch_assoc($ac)) {
    $cont=$cont+1;
    if($first == 0){
      $first=$a['ID'];
      #echo 'asdfasdfasdf: '. $first;
    }
    $last=$a['ID'];

  }

$gs=$cont*20000;
$tcont = $cont;
$gs= number_format($gs,0,",",".");
$cont=number_format($cont,0,",",".");
$first = number_format($first,0,",",".");
$last = number_format($last,0,",",".");
$ci = number_format($ci,0,",",".");
$accdata=array();

$accdata['acciones'][]=$cont;
$accdata['guaranies'][]=$gs;
$accdata['desde'][]=$first;
$accdata['hasta'][]=$last;
$accdata['serie'][]=$serie;
$accdata['titulo'][]=$tnum;
$accdata['tacciones'][]=$tcont;
$accdata['group'][]=$gacc;
$accdataname="";
$glim = count($gci);
if ($gacc == 1) {
  for ($i=0; $i < $glim; $i++) { 
    #$accdataname=$accdataname." ".$gnames[$i]." ".$glnames[$i]." - C.I.No. ".number_format($gci[$i],0,",",".").".-<br>";
    #$accdataci=$accdataci." ".$gci[$i];
    $accdata['name'][$i]=$gnames[$i]." ".$glnames[$i];
    $accdata['ci'][$i]=number_format($gci[$i],0,",",".");
  }
  #$accdata['name']=$accdataname;
}else{
  $accdata['name'][]=$name." ".$lname;
  $accdata['ci'][]=$ci;
}


#echo "<pre>"; print_r($accdata); echo "</pre>";

$fp = fopen('accdata.json', 'w');
fwrite($fp, json_encode($accdata, JSON_UNESCAPED_UNICODE));
fclose($fp);

#$commands = escapeshellcmd('/var/www/html/dashboard/Acciones/assets/pdf/add.py');
$commands = escapeshellcmd('/var/www/html/dashboard/Acciones/assets/pdf/add.py');
        $outputs = shell_exec($commands);

#echo "<pre>"; print_r($outputs); echo "</pre>";
#die();
header("Location: svgyopdf.php");


?>
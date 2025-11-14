<?php
ini_set("session.gc_maxlifetime","14400");
session_start();
?>
<?php
//Llamando objetos
$director="../../";
include("../../cfgclases/config.php");
include("../../cfgclases/clases.php");
//Conexion a la base de datos



 if($objvalidacion->validarID($_POST["pruc"])=='NO')
 {
   echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FF0000">CEDULA O RUC INCORRECTO</div>';
   
  }

  
   
 
 
 
?>


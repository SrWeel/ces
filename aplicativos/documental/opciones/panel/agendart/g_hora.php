<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
     
     /* echo $_POST["fecha_x"]."<br>";
	  echo $_POST["atenc_hc"]."<br>";
	  echo $_POST["especi_idagt"]."<br>";
	  echo $_POST["usua_idagt"]."<br>";
	  echo $_POST["val_hora"]."<br>";
	  echo $_POST["clie_id"]."<br>";*/
	  
	  
$inserta_datos="insert into faesa_terapiasregistro (atenc_hc,clie_id,terap_fecha,terap_hora,terap_autorizacion,especi_id,usua_id,centro_id,usuar_id) 
values ('".$_POST["atenc_hc"]."','".$_POST["clie_id"]."','".$_POST["fecha_x"]."','".$_POST["val_hora"]."','','".$_POST["especi_idagt"]."','".$_POST["usua_idagt"]."','".$_POST["centro_id"]."','".$_POST["usuar_id"]."')";

$rs_okinserta = $DB_gogess->executec($inserta_datos,array());

?>
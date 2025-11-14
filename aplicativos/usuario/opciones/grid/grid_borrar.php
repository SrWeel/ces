<?php
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director="../../../../";
include ("../../../../cfgclases/clases.php");

 $_POST["ptabla"];
 $_POST["pcampo"];
 $_POST["pvalor"];
 
 $creascripborrado="delete from ".$_POST["ptabla"]." where ".$_POST["pcampo"]."=".$_POST["pvalor"];
 
$ok=$DB_gogess->Execute($creascripborrado);
 

 if($ok)
 {
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro borrado con exito...</div>';
 }
 else
 {
  echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro bloqueado intente nuevamente...</div>';
 }
?>

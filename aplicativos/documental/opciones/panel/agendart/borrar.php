<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';

include("../../../../../cfg/clases.php");

include("../../../../../cfg/declaracion.php");

 //$_POST["ptabla"];

 //$_POST["pcampo"];

// $_POST["pvalor"];

 $creascripborrado="delete from ".$_POST["ptabla"]." where ".$_POST["pcampo"]."=".$_POST["pvalor"];

$ok=$DB_gogess->executec($creascripborrado);

 if($ok)
 {
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro borrado con exito...</div>';
 }
 else
 {
  echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro bloqueado intente nuevamente...</div>';
echo '<script type="text/javascript">

<!--

 mensaje_borrado("No se puede borrar")

//-->

</script> ';

 

 }

 

 }

 else

 {

 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Sesi&oacute;n ha caducado F5 para continuar...</div>';

 

 }

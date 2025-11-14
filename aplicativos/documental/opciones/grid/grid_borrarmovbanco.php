<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
 //$_POST["ptabla"];
 //$_POST["pcampo"];
// $_POST["pvalor"];

$busca_registroaborra="select * from ".$_POST["ptabla"]." where movban_id='".$_POST["pvalor"]."'";
$busca_reg=$DB_gogess->executec($busca_registroaborra);

$file = fopen("log/e_borrarbanco".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$busca_registroaborra."-->".date("Y-m-d H:i:s"). PHP_EOL);
fclose($file);


	   
	   //borra comporbante contable
	  $borra_detallescc="delete from lpin_detallecomprobantecontable where comcont_enlace in (select comcont_enlace from lpin_comprobantecontable where comcont_tabla='app_movimientobancos' and comcont_idtabla='".$_POST["pvalor"]."')";
	  $ok_b1=$DB_gogess->executec($borra_detallescc);
	  
	  $file = fopen("log/e_borrarbanco".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
      fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$borra_detallescc."-->".date("Y-m-d H:i:s"). PHP_EOL);
      fclose($file);
	  
	  $borra_data1="delete from lpin_comprobantecontable where comcont_tabla='app_movimientobancos' and comcont_idtabla='".$_POST["pvalor"]."'";
	  $ok_b2=$DB_gogess->executec($borra_data1);
	  
	  $file = fopen("log/e_borrarbanco".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
      fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$borra_data1."-->".date("Y-m-d H:i:s"). PHP_EOL);
      fclose($file);
	   //borra comporbante contable
	  

$borrar_detalles="delete  from lpin_movbancos where movban_enlace='".$busca_reg->fields["movban_enlace"]."'";
$ok_b3=$DB_gogess->executec($borrar_detalles);

$file = fopen("log/e_borrarbanco".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$borrar_detalles."-->".date("Y-m-d H:i:s"). PHP_EOL);
fclose($file);

	  
 
$creascripborrado="delete from ".$_POST["ptabla"]." where ".$_POST["pcampo"]."=".$_POST["pvalor"];
 echo $_POST["pvalor"];
$ok=$DB_gogess->executec($creascripborrado);
 
$file = fopen("log/e_borrarbanco".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$creascripborrado."-->".date("Y-m-d H:i:s"). PHP_EOL);
fclose($file);


 //borra detalles
 
 //borra detalles
 
 

 if($ok)
 {
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro borrado con exito...</div>';
 }
 else
 {
  echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro bloqueado intente nuevamente...</div>';
 }
 
 }
 else
 {
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Sesi&oacute;n ha caducado F5 para continuar...</div>';
 
 }
?>

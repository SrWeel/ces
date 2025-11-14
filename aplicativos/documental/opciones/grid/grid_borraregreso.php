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

//busca si tiene detalles

$busc_cantidad="select count(*) as ntmp from dns_temporaldespacho where egrec_id='".$_POST["pvalor"]."'";
$rs_bcantidad = $DB_gogess->executec($busc_cantidad,array());

$cantida_ing=0;
$cantida_ing=$rs_bcantidad->fields["ntmp"];
//busca si tiene detalles

if($cantida_ing>0)
{

?>
<script type="text/javascript">
<!--
alert("Registro no pude ser borrado, borre los items internos antes...");
//  End -->
</script>
<?php

}
else
{
 
 //================================================================================
 $creascripborrado="delete from ".$_POST["ptabla"]." where ".$_POST["pcampo"]."=".$_POST["pvalor"];
// echo $_POST["pvalor"];
 $ok=$DB_gogess->executec($creascripborrado);
 
 if(@$ok)
 {
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro borrado con exito...</div>';
 
 ?>
<script type="text/javascript">
<!--

listado_despachos();

//  End -->
</script>
<?php
 
 }
 else
 {
  echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro bloqueado intente nuevamente...</div>';
 } 
 //================================================================================
  
 
}
 
 
 
 }
 else
 {
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Sesi&oacute;n ha caducado F5 para continuar...</div>';
 
 }
?>

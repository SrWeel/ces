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




//busca si ya fue procesado

$busca_procesado="select count(*) top from dns_movimientoinventario where tempdspcent_id='".$_POST["pvalor"]."'";
$ok_bp=$DB_gogess->executec($busca_procesado);

$top=$ok_bp->fields["top"];

//busca si ya fue procesado

if($top>0)
{

?>
<script type="text/javascript">
<!--
alert("Registro no pude ser borrado, ya fue procesado...");
//  End -->
</script>
<?php

}
else
{

//============================================================== 
$creascripborrado="delete from ".$_POST["ptabla"]." where ".$_POST["pcampo"]."=".$_POST["pvalor"];
 echo $_POST["pvalor"];
$ok=$DB_gogess->executec($creascripborrado);
 

 if($ok)
 {
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro borrado con exito...</div>';
 
  ?>
<script type="text/javascript">
<!--

   lista_agregadosproducto();
   busca_producto();

//  End -->
</script>
<?php
 
 }
 else
 {
  echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro bloqueado intente nuevamente...</div>';
 }
//=============================================================== 


}



 
 
 }
 else
 {
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Sesi&oacute;n ha caducado F5 para continuar...</div>';
 
 }
?>
